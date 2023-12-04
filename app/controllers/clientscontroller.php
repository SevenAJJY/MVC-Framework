<?php

    namespace SEVENAJJY\Controllers ;

    use SEVENAJJY\LIBRARY\Messenger;
    use SEVENAJJY\Models\ClientModel;

    class ClientsController extends AbstractController
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
            $this->language->load('clients.default');

            $this->_data['clients'] = ClientModel::getAll();

            $this->_renderView();
        }


        public function createAction()
        {
            $this->language->load('template.common');
            $this->language->load('clients.create');
            $this->language->load('clients.labels');
            $this->language->load('clients.messages');
            $this->language->load('validation.errors');

            if (isset($_POST['submit']) && $this->isValid($this->_createActionRoles , $_POST)) {

                $client =  new ClientModel();
                $client->Name = $this->filterString($_POST['Name']);
                $client->Email = $this->filterString($_POST['Email']) ;
                $client->PhoneNumber = $this->filterString($_POST['PhoneNumber']) ;
                $client->Address = $this->filterString($_POST['Address']) ;
                $client->PartitaIVA = $this->filterString($_POST['PartitaIVA']) ;
                $client->CodFISC = $this->filterString($_POST['CodFISC']) ;

                if ($client->save()) {
                    $this->messenger->add($this->language->get('message_create_success'));
                }
                else {
                    $this->messenger->add($this->language->get('message_create_failed') , Messenger::APP_MESSAGE_ERROR);
                }
                $this->redirect('/clients') ;
            }

            $this->_renderView();
        }

        public function editAction()
        {
            $id = $this->filterInt($this->_params[0]);
            $clients = ClientModel::getByKey( $id);

            if (false === $clients) {
                $this->redirect('/clients');
            }
            $this->_data['clients'] = $clients ;

            $this->language->load('template.common');
            $this->language->load('clients.edit');
            $this->language->load('clients.labels');
            $this->language->load('clients.messages');
            $this->language->load('validation.errors');


            if (isset($_POST['submit']) && $this->isValid($this->_createActionRoles , $_POST)) {

                $clients->Name = $this->filterString($_POST['Name']);
                $clients->Email = $this->filterString($_POST['Email']) ;
                $clients->PhoneNumber = $this->filterString($_POST['PhoneNumber']) ;
                $clients->Address = $this->filterString($_POST['Address']) ;
                $clients->PartitaIVA = $this->filterString($_POST['PartitaIVA']) ;
                $clients->CodFISC = $this->filterString($_POST['CodFISC']) ;


                if ($clients->save()) {
                    $this->messenger->add($this->language->get('message_create_success'));
                }
                else {
                    $this->messenger->add($this->language->get('message_create_failed') , Messenger::APP_MESSAGE_ERROR);
                }
                $this->redirect('/clients') ;
            }

            $this->_renderView();
        }


        public function deleteAction()
        {
            $id = $this->filterInt($this->_params[0]);
            $clients = ClientModel::getByKey( $id);

            if (false === $clients) {
                $this->redirect('/clients');
            }

            $this->language->load('clients.messages');

            if ($clients->delete()) {
                $this->messenger->add($this->language->get('message_delete_success'));
            }
            else {
                $this->messenger->add($this->language->get('message_delete_failed') , Messenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/clients') ;
        }

    }