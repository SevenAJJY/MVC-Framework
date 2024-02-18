<?php

    namespace SEVENAJJY\Controllers ;

    use SEVENAJJY\LIBRARY\Messenger;
    use SEVENAJJY\Models\ClientInvoiceDetailsModel;
    use SEVENAJJY\Models\ClientInvoiceModel;
    use SEVENAJJY\Models\ClientInvoiceReceiptModel;

    class ReceiptVoucherController extends AbstractController
    {
        private $_createActionRoles = 
        [
            'SupplierId'        => 'req|alphanum',
            'PaymentType'       => 'req|num'
        ];

        public function defaultAction()
        {
            $this->language->load('template.common');
            $this->language->load('receiptvoucher.default');
            $this->language->load('receiptvoucher.labels');

            $id = $this->_getParams(0, 'int');
            $invoice = ClientInvoiceModel::getByKey($id);
            if(false !== $id && false !== $invoice) {
                $this->_data['vouchers'] = ClientInvoiceReceiptModel::getForInvoice($invoice);
            } 
            else {
                $this->_data['vouchers'] = ClientInvoiceReceiptModel::getAll();
            }

            $this->_renderView();
        }


        public function createAction()
        {
            $id = $this->_getParams(0, 'int');
            $invoice = ClientInvoiceModel::getByKey($id);

    
            if(false === $invoice){
                $this->redirectBack('/receiptvoucher');
            }
    
            if(ClientInvoiceReceiptModel::invoiceIsSettled($invoice)) {
                $this->redirectBack('/receiptvoucher');
            }

            $this->language->load('template.common');
            $this->language->load('receiptvoucher.create');
            $this->language->load('receiptvoucher.labels');
            $this->language->load('receiptvoucher.messages');


            $this->language->feed('title', [$invoice->InvoiceId]);
            $this->language->feed('text_header', [$invoice->InvoiceId]);
            $this->language->feed('text_footer', [$invoice->InvoiceId]);

            if(isset($_POST['submit'])) {
                $voucher = new ClientInvoiceReceiptModel();
                $voucher->UserId            = $this->session->u->UserId;
                $voucher->InvoiceId         = $invoice->InvoiceId;
                $voucher->PaymentType       = $this->filterInt($_POST['PaymentType']);
                $voucher->PaymentAmount     = $this->filterFloat($_POST['PaymentAmount']);
                $voucher->PaymentLiteral    = $this->filterString($_POST['PaymentLiteral']);
                $voucher->BankName          = isset($_POST['BankName']) ? $this->filterString($_POST['BankName']) : '';
                $voucher->BankAccountNumber = isset($_POST['BankAccountNumber']) ? $this->filterString($_POST['BankAccountNumber']) : '';
                $voucher->CheckNumber       = isset($_POST['CheckNumber']) ? $this->filterString($_POST['CheckNumber']) : '';
                $voucher->TransferedTo      = isset($_POST['TransferedTo']) ? $this->filterString($_POST['TransferedTo']) : '';
                $voucher->Created           = date('Y-m-d H:i:s');
                if($voucher->invoiceCanAdd()) {
                    if($voucher->save()) {
                        $this->messenger->add($this->language->get('message_create_success'));
                        $this->redirect('/receiptvoucher');
                    } else {
                        $this->messenger->add($this->language->get('message_create_failed') , Messenger::APP_MESSAGE_ERROR);
                    }
                } else {
                    $this->messenger->add($this->language->get('message_over_payment') , Messenger::APP_MESSAGE_ERROR);
                }
            }
            
            $this->_renderView();
        }

        public function editAction()
        {        
            $id = $this->_getParams(0, 'int');
            $voucher = ClientInvoiceReceiptModel::getByKey($id);
    
            if(false === $voucher)
            {
                $this->redirectBack('/receiptvoucher');
            }
    
            $this->_data['voucher'] = $voucher;
    
            $invoice = ClientInvoiceModel::getByKey($voucher->InvoiceId);
    
            $this->language->load('template.common');
            $this->language->load('receiptvoucher.edit');
            $this->language->load('receiptvoucher.labels');
            $this->language->load('receiptvoucher.messages');
    
            $this->language->feed('title', [$invoice->InvoiceId]);
            $this->language->feed('text_header', [$invoice->InvoiceId]);
            $this->language->feed('text_footer', [$invoice->InvoiceId]);

            if(isset($_POST['submit'])) {

                $oldPayment = $voucher->PaymentAmount;
                $voucher->PaymentType = $this->filterInt($_POST['PaymentType']);
                $voucher->PaymentAmount = $this->filterInt($_POST['PaymentAmount']);
                $voucher->PaymentLiteral = $this->filterString($_POST['PaymentLiteral']);
                $voucher->BankName = isset($_POST['BankName']) ? $this->filterString($_POST['BankName']) : '';
                $voucher->BankAccountNumber = isset($_POST['BankAccountNumber']) ? $this->filterString($_POST['BankAccountNumber']) : '';
                $voucher->CheckNumber = isset($_POST['CheckNumber']) ? $this->filterString($_POST['CheckNumber']) : '';
                $voucher->TransferedTo = isset($_POST['TransferedTo']) ? $this->filterString($_POST['TransferedTo']) : '';

                if($voucher->invoiceCanAdd($oldPayment)) {
                    if($voucher->save()) {
                        $this->messenger->add($this->language->get('message_edit_success'));
                        $this->redirect('/receiptvoucher');
                    } else {
                        $this->messenger->add($this->language->get('message_edit_failed') , Messenger::APP_MESSAGE_ERROR);
                    }
                } else {
                    $this->messenger->add($this->language->get('message_over_payment') , Messenger::APP_MESSAGE_ERROR);
                }
                $this->redirect('/sales') ;
            }

            $this->_renderView();
        }


        public function deleteAction()
        {
            $id = $this->_getParams(0, 'int');
            $voucher = ClientInvoiceReceiptModel::getByKey($id);

            // var_dump($voucher);exit;
    
            if(false === $voucher)
            {
                $this->redirectBack('/receiptvoucher');
            }
    
            if($voucher->delete()) {
                $this->messenger->add($this->language->get('message_delete_success'));
                $this->redirect('/receiptvoucher');
            } else {
                $this->messenger->add($this->language->get('message_delete_failed') , Messenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/sales') ;

        }

        public function viewAction()
        {
            $id = $this->_getParams(0, 'int');
    
            $invoice = ClientInvoiceModel::getOne(
                'SELECT *, (SELECT Name FROM app_suppliers WHERE app_suppliers.SupplierId = app_purchases_invoices.SupplierId) Name
                    FROM app_purchases_invoices
                    WHERE InvoiceId = ' . $id
            );
    
            if($invoice === false) {
                $this->redirectBack('/purchases');
            }

            $this->language->load('template.common');
            $this->language->load('purchases.view');
            $this->language->load('purchases.labels');
    
            $this->_data['invoice'] = $invoice;
            $this->_data['details'] = ClientInvoiceDetailsModel::getInvoiceById($invoice);

            $this->_data['title'] = 'عرض بيانات فاتورة ' . (new \DateTime($invoice->Created))->format('ym') . $invoice->InvoiceId;
            $this->_data['text_header'] = 'عرض بيانات فاتورة ' . (new \DateTime($invoice->Created))->format('ym') . $invoice->InvoiceId;
            $this->_data['text_footer'] = 'عرض بيانات فاتورة ' . (new \DateTime($invoice->Created))->format('ym') . $invoice->InvoiceId;
    


            $this->_renderView();
        }

    }