<?php

    namespace SEVENAJJY\Controllers ;

use SEVENAJJY\LIBRARY\Messenger;
use SEVENAJJY\Models\ExpenseCategoryModel;

    class ExpensesCategoriesController extends AbstractController
    {
        private $_createActionRoles = 
        [
            'ExpenseName'    => 'req|alphanum|between(3,30)',
            'FixedPayment'   => 'req|num|max(7)',
        ];

        public function defaultAction()
        {
            $this->language->load('template.common');
            $this->language->load('expensescategories.default');

            $this->_data['expensescategories'] = ExpenseCategoryModel::getAll();

            $this->_renderView();
        }
        
        public function createAction()
        {
            $this->language->load('template.common');
            $this->language->load('expensescategories.create');
            $this->language->load('expensescategories.labels');
            $this->language->load('expensescategories.messages');
            $this->language->load('validation.errors');

            if (isset($_POST['submit'])) {
                if ($this->isValid($this->_createActionRoles , $_POST)) {
                    $category = new ExpenseCategoryModel();

                    $category->ExpenseName = $this->filterString($_POST['ExpenseName']);
                    $category->FixedPayment = $this->filterFloat($_POST['FixedPayment']);

                    if ($category->save()) {
                        $this->messenger->add($this->language->get('message_create_success'));
                    }
                    else {
                        $this->messenger->add($this->language->get('message_create_failed') , Messenger::APP_MESSAGE_ERROR);
                    }
                    $this->redirect('/expensescategories') ;
                    
                }
            }

            $this->_renderView();
        }

        public function editAction()
        {
            $id = $this->_getParams(0, 'int');
            $category = ExpenseCategoryModel::getByKey($id);
            if($category === false) {
                $this->redirect('/expensescategories') ;
            }

            $this->language->load('template.common');
            $this->language->load('expensescategories.edit');
            $this->language->load('expensescategories.labels');
            $this->language->load('expensescategories.messages');
            $this->language->load('validation.errors');

            $this->_data['expensescategories'] = $category ;

            if (isset($_POST['submit'])) {
                if ($this->isValid($this->_createActionRoles , $_POST)) {

                    $category->ExpenseName = $this->filterString($_POST['ExpenseName']);
                    $category->FixedPayment = $this->filterFloat($_POST['FixedPayment']);

                    if ($category->save()) {
                        $this->messenger->add($this->language->get('message_create_success'));
                    }
                    else {
                        $this->messenger->add($this->language->get('message_create_failed') , Messenger::APP_MESSAGE_ERROR);
                    }
                    $this->redirect('/expensescategories') ;
                    
                }
            }

            $this->_renderView();
        }

        public function deleteAction()
        {
            $id = $this->_getParams(0, 'int');
            $category = ExpenseCategoryModel::getByKey($id);
            if($category === false || $category->hasRelatedExpensesList() !== false) {
                $this->redirect('/expensescategories') ;
            }

            $this->language->load('expensescategories.messages');

            $this->_data['expensescategories'] = $category ;


            if ($category->delete()) {
                $this->messenger->add($this->language->get('message_delete_success'));
            }
            else {
                $this->messenger->add($this->language->get('message_delete_failed') , Messenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/expensescategories') ;

            $this->_renderView();
        }
    }