<?php

    namespace SEVENAJJY\Controllers ;

use SEVENAJJY\Library\Messenger;
use SEVENAJJY\Models\SupplierModel;

    class SuppliersController extends AbstractController
    {
        /**
         * Here we put an Array $_createActionRoles in it the name of each of the fields we want to check with Type validate . 
         * that you need and it will be called Trait(Validate) and exactly method isValid
         *
         * @var array
         */
        private $_createActionRoles = 
        [
            'Name'           => 'req|alpha|between(3,40)',
            'Email'          => 'req|email',
            'PhoneNumber'    => 'alphanum|max(15)',
            'Address'        => 'req|alphanum|max(100)',
        ];

        public function defaultAction()
        {
            $this->language->load('template.common');
            $this->language->load('suppliers.default');

            $this->_data['suppliers'] = SupplierModel::getAll();

            $this->_renderView();
        }


        public function createAction()
        {
            $this->language->load('template.common');
            $this->language->load('suppliers.create');
            $this->language->load('suppliers.labels');
            $this->language->load('suppliers.messages');
            $this->language->load('validation.errors');

            if (isset($_POST['submit']) && $this->isValid($this->_createActionRoles , $_POST)) {

                $supplier =  new SupplierModel();
                $supplier->Name = $this->filterString($_POST['Name']);
                $supplier->Email = $this->filterString($_POST['Email']) ;
                $supplier->PhoneNumber = $this->filterString($_POST['PhoneNumber']) ;
                $supplier->Address = $this->filterString($_POST['Address']) ;
                $supplier->PartitaIVA = $this->filterString($_POST['PartitaIVA']) ;
                $supplier->CodFISC = $this->filterString($_POST['CodFISC']) ;

                if ($supplier->save()) {
                    $this->messenger->add($this->language->get('message_create_success'));
                }
                else {
                    $this->messenger->add($this->language->get('message_create_failed') , Messenger::APP_MESSAGE_ERROR);
                }
                $this->redirect('/suppliers') ;
            }

            $this->_renderView();
        }

        public function editAction()
        {
            $id = $this->filterInt($this->_params[0]);
            $supplier = SupplierModel::getByKey( $id);

            if (false === $supplier) {
                $this->redirect('/suppliers');
            }
            $this->_data['supplier'] = $supplier ;

            $this->language->load('template.common');
            $this->language->load('suppliers.edit');
            $this->language->load('suppliers.labels');
            $this->language->load('suppliers.messages');
            $this->language->load('validation.errors');


            if (isset($_POST['submit']) && $this->isValid($this->_createActionRoles , $_POST)) {

                $supplier->Name = $this->filterString($_POST['Name']);
                $supplier->Email = $this->filterString($_POST['Email']) ;
                $supplier->PhoneNumber = $this->filterString($_POST['PhoneNumber']) ;
                $supplier->Address = $this->filterString($_POST['Address']) ;
                $supplier->PartitaIVA = $this->filterString($_POST['PartitaIVA']) ;
                $supplier->CodFISC = $this->filterString($_POST['CodFISC']) ;

                if ($supplier->save()) {
                    $this->messenger->add($this->language->get('message_create_success'));
                }
                else {
                    $this->messenger->add($this->language->get('message_create_failed') , Messenger::APP_MESSAGE_ERROR);
                }
                $this->redirect('/suppliers') ;
            }

            $this->_renderView();
        }


        public function deleteAction()
        {
            $id = $this->filterInt($this->_params[0]);
            $supplier = SupplierModel::getByKey( $id);

            if (false === $supplier) {
                $this->redirect('/suppliers');
            }

            $this->language->load('suppliers.messages');

            if ($supplier->delete()) {
                $this->messenger->add($this->language->get('message_delete_success'));
            }
            else {
                $this->messenger->add($this->language->get('message_delete_failed') , Messenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/suppliers') ;
        }

    }