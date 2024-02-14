<?php

    namespace SEVENAJJY\Controllers ;

    use SEVENAJJY\LIBRARY\Messenger;
    use SEVENAJJY\LIBRARY\GeneratePDF;
    use SEVENAJJY\Models\ClientInvoiceDetailsModel;
    use SEVENAJJY\Models\ClientInvoiceModel;
    use SEVENAJJY\Models\ClientModel;
    use SEVENAJJY\Models\ProductModel;

    class SalesController extends AbstractController
    {
        private $_createActionRoles = 
        [
            'ClientId'        => 'req|alphanum',
            'PaymentType'       => 'req|num'
        ];

        public function defaultAction()
        {
            $this->language->load('template.common');
            $this->language->load('sales.default');
            $this->language->load('sales.labels');

            $this->_data['invoices'] = ClientInvoiceModel::getAll();

            $this->_renderView();
        }


        public function createAction()
        {
            $this->language->load('template.common');
            $this->language->load('sales.create');
            $this->language->load('sales.labels');
            $this->language->load('sales.messages');
            $this->language->load('validation.errors');

            $this->_data['clients'] = ClientModel::getAll();

            $this->_data['products'] = ProductModel::getAll();

            if (isset($_POST['submit'])) {

                $sales = new ClientInvoiceModel();
                $sales->ClientId = $this->filterInt($_POST["ClientId"]) ;
                $sales->PaymentType = $this->filterInt($_POST["PaymentType"]) ;
                $sales->PaymentStatus = $this->filterInt($_POST["PaymentStatus"]) ;
                $sales->Created = date("Y-m-d") ;
                $sales->Discount = isset($_POST['Discount']) ? $this->filterFloat($_POST["Discount"]) : "";
                $sales->UserId = $this->session->u->UserId;
                $sales->ProductsDelivery = 0;
                
                $productsIds = $this->filterStringArray($_POST["productv"]) ;
                $productsPrices = $this->filterStringArray($_POST["productp"]) ;
                $productsQuantities = $this->filterStringArray($_POST["productq"]) ;
            // var_dump($productsQuantities);
            // exit;
                if ($sales->save()) {
                    for ($i=0; $i < count($productsIds); $i++) { 
                        $details = new ClientInvoiceDetailsModel();
                        $details->InvoiceId = $sales->InvoiceId ;
                        $details->ProductId = $productsIds[$i] ;
                        $details->Quantity = $productsQuantities[$i] ;
                        $details->ProductPrice = $productsPrices[$i] ;
                        $details->save();
                    }
                    $this->messenger->add($this->language->get('message_create_success'));
                }
                else {
                    $this->messenger->add($this->language->get('message_create_failed') , Messenger::APP_MESSAGE_ERROR);
                }
                $this->redirect('/sales') ;
            }

            $this->_renderView();
        }

        public function editAction()
        {
                $id = $this->_getParams(0, 'int');
                $invoice = ClientInvoiceModel::getByKey($id);
                if($invoice === false || $invoice->ProductsDelivery == 1) {
                    $this->redirectBack('/sales');
                }
        
                $this->_data['invoice'] = $invoice;
                
                $details = $this->_data['details'] = ClientInvoiceDetailsModel::getInvoiceById($invoice);
                $this->language->load('template.common');
                $this->language->load('sales.edit');
                $this->language->load('sales.labels');
                $this->language->load('sales.messages');
                $this->language->load('validation.errors');
                
                $this->_data['clients'] = ClientModel::get(
                    'SELECT ClientId, Name from app_clients'
                );
                // var_dump($details);exit;
        
                $products = ProductModel::getAll();
                foreach ($products as &$product) {
                    foreach ($details as $detail) {
                        if($detail->ProductId == @$product->ProductId) {
                            $product = false;
                        }
                    }
                }
        
                $productsIterator = iterator_to_array($products);
                $newProducts = [];
                foreach ($productsIterator as $item) {
                    if(false !== $item) {
                        $newProducts[] = $item;
                    }
                }

                $products = $newProducts;
                $this->_data['products'] = $products;

                if(isset($_POST['submit'])) {

                        $invoice->ClientId = $this->filterInt($_POST["ClientId"]) ;
                        $invoice->PaymentType = $this->filterInt($_POST["PaymentType"]) ;
                        $invoice->PaymentStatus = $this->filterInt($_POST["PaymentStatus"]) ;
                        $invoice->Discount = isset($_POST['Discount']) ? $this->filterFloat($_POST["Discount"]) : "";

                        $productsIds = $this->filterStringArray($_POST['productv']);
                        $productsPrices = $this->filterStringArray($_POST['productp']);
                        $productsQuantities = $this->filterStringArray($_POST['productq']);
        
                        if($invoice->save()) {

                            foreach ($details as $detail) {
                                $detail->delete();
                            }

                            for ( $i = 0, $ii = count($productsIds); $i < $ii; $i++ ) {
                                $details = new ClientInvoiceDetailsModel();
                                $details->InvoiceId = $invoice->InvoiceId;
                                $details->ProductId = $productsIds[$i];
                                $details->Quantity = $productsQuantities[$i];
                                $details->ProductPrice = $productsPrices[$i];
                                $details->save();
                            }
                            $this->messenger->add($this->language->get('message_edit_success'));
                        }else {
                            $this->messenger->add($this->language->get('message_edit_failed') , Messenger::APP_MESSAGE_ERROR);
                        }
                        $this->redirect('/sales') ;
                }
            $this->_renderView();
        }


        public function deleteAction()
        {
            $id = $this->_getParams(0, 'int');
            $invoice = ClientInvoiceModel::getByKey($id);
            if($invoice === false || $invoice->ProductsDelivery == 1) {
                $this->redirectBack('/sales');
            }

            $details = ClientInvoiceDetailsModel::getInvoiceById($invoice);
            foreach ($details as $detail) {
                $detail->delete();
            }

            $this->language->load('sales.messages');

            if($invoice->delete()){
                $this->messenger->add($this->language->get('message_delete_success'));
            } 
            else {
                $this->messenger->add($this->language->get('message_delete_failed') , Messenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/sales') ;

        }

        public function viewAction()
        {
            $id = $this->_getParams(0, 'int');
    
            $invoice = ClientInvoiceModel::getOne(
                'SELECT *, 
                (SELECT Name FROM app_clients WHERE app_clients.ClientId = app_sales_invoices.ClientId) Name,
                (SELECT CodFISC FROM app_clients WHERE app_clients.ClientId = app_sales_invoices.ClientId) CodFISC,
                (SELECT PartitaIVA FROM app_clients WHERE app_clients.ClientId = app_sales_invoices.ClientId) PartitaIVA
                FROM app_sales_invoices
                WHERE InvoiceId = ' . $id
            );
            if($invoice === false) {
                $this->redirectBack('/sales');
            }

            $this->language->load('template.common');
            $this->language->load('sales.view');
            $this->language->load('sales.labels');
            $this->language->load('sales.units');
    
            $this->_data['invoice'] = $invoice;
            $this->_data['productDetails'] = ClientInvoiceDetailsModel::getInvoiceById($invoice);

            $this->_data['title'] = 'عرض بيانات فاتورة ' . (new \DateTime($invoice->Created))->format('ym') . $invoice->InvoiceId;
            $this->_data['text_header'] = 'عرض بيانات فاتورة ' . (new \DateTime($invoice->Created))->format('ym') . $invoice->InvoiceId;
            $this->_data['text_footer'] = 'عرض بيانات فاتورة ' . (new \DateTime($invoice->Created))->format('ym') . $invoice->InvoiceId;
    


            $this->_renderView();
        }

        public function deliverProductsAction()
        {
            $id = $this->_getParams(0, 'int');
    
            $invoice = ClientInvoiceModel::getByKey($id);
    
            if($invoice === false || $invoice->ProductsDelivery == 1) {
                $this->redirectBack('/sales');
            }
    
            $details = ClientInvoiceDetailsModel::getInvoiceById($invoice);
            if($details !== false) {
                foreach ($details as $detail) {
                    $product = ProductModel::getByKey($detail->ProductId);
                    $product->Quantity -= $detail->Quantity;
                    $product->save();
                }
                $invoice->ProductsDelivery = 1;
                if($invoice->save()) {
                    $this->messenger->add($this->language->get('message_added_to_store_success'));
                }
            }
            $this->redirect('/sales');
        }

        public function downloadbillAction(){
            $this->_template->swapTemplate(
                [':VIEW' => ':actionView' ]
            );
    
            $this->language->load("auth.login");
            $gpdf = new GeneratePDF();
            $gpdf->generate();

            
            $this->_renderView();
        }

    }