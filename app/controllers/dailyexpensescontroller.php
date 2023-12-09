<?php

namespace SEVENAJJY\Controllers ;

use SEVENAJJY\LIBRARY\Messenger;
use SEVENAJJY\Models\DailyExpensesModel;
use SEVENAJJY\Models\ExpenseCategoryModel;
use SEVENAJJY\Models\ExpenseDailyModel;

class DailyExpensesController extends AbstractController
{
    private $_createActionRoles = 
    [
        'Description'    => 'alphanum|max(50)',
    ];

    public function defaultAction()
    {
        $this->language->load('template.common');
        $this->language->load('dailyexpenses.default');
        $this->language->load('dailyexpenses.labels');
        $this->_data['expenseslist'] = DailyExpensesModel::getAll();
        
        $this->_renderView();
    }
    
    public function createAction()
    {
        $this->language->load('template.common');
        $this->language->load('dailyexpenses.create');
        $this->language->load('dailyexpenses.labels');
        $this->language->load('dailyexpenses.messages');
        $this->language->load('validation.errors');

        $this->_data['categories'] = ExpenseCategoryModel::getAll();

        if (isset($_POST['submit'])) {
            if ($this->isValid($this->_createActionRoles , $_POST)) {
                $expense = new DailyExpensesModel();
                $expense->ExpenseId = isset($_POST['CategoryId']) && !empty($_POST['CategoryId']) ? $this->filterInt($_POST['CategoryId']) : '';
                if($expense->ExpenseId !== null) $category = ExpenseCategoryModel::getByKey($expense->ExpenseId);
                
                if(isset($category) && false === $category) {
                    $this->redirect('/dailyexpenses');
                }
                

                $expense->Description = $this->filterString($_POST['Description']);
                $expense->Payment = isset($category) ? $this->filterFloat($_POST['Payment']) : $category->FixedPayment;
                $expense->UserId = $this->session->u->UserId;
                $expense->Created = date('Y-m-d H:i:s');

                if ($expense->save()) {
                    $this->messenger->add($this->language->get('message_create_success'));
                }
                
                else {
                    $this->messenger->add($this->language->get('message_create_failed') , Messenger::APP_MESSAGE_ERROR);
                }
                $this->redirect('/dailyexpenses') ;
                
            }
        }

        $this->_renderView();
    }

    public function editAction()
    {
        $id = $this->_getParams(0, 'int');
        $expense = DailyExpensesModel::getByKey($id);
        if($expense === false) {
            $this->redirect('/dailyexpenses') ;
        }

        $this->language->load('template.common');
        $this->language->load('dailyexpenses.edit');
        $this->language->load('dailyexpenses.labels');
        $this->language->load('dailyexpenses.messages');
        $this->language->load('validation.errors');

        $this->_data['list'] = $expense;

        $this->_data['categories'] = ExpenseCategoryModel::getAll();

        if (isset($_POST['submit'])) {
            if ($this->isValid($this->_createActionRoles , $_POST)) {
                $expense->ExpenseId = isset($_POST['CategoryId']) && !empty($_POST['CategoryId']) ? $this->filterInt($_POST['CategoryId']) : null;

                if($expense->ExpenseId !== null) $category = ExpenseCategoryModel::getByKey($expense->ExpenseId);
                if(isset($category) && false === $category) {
                    $this->redirectBack('/dailyexpenses');
                }

                $expense->Description = $this->filterString($_POST['Description']);
                $expense->Payment     = isset($category) ? $this->filterFloat($_POST['Payment']) : $category->FixedPayment;
                $expense->UserId      = $this->session->u->UserId;
                $expense->Created     = date('Y-m-d H:i:s');

                if ($expense->save()) {
                    $this->messenger->add($this->language->get('message_edit_success'));
                }
                else {
                    $this->messenger->add($this->language->get('message_edit_failed') , Messenger::APP_MESSAGE_ERROR);
                }
                $this->redirect('/dailyexpenses') ;
                
            }
        }

        $this->_renderView();
    }

    public function deleteAction()
    {
        $id = $this->_getParams(0, 'int');
        
        $expense = DailyExpensesModel::getByKey($id);
        
        if($expense === false) {
            $this->redirect('/dailyexpenses') ;
        }

        $this->language->load('dailyexpenses.messages');

        if ($expense->delete()) {
            $this->messenger->add($this->language->get('message_delete_success'));
        }
        else {
            $this->messenger->add($this->language->get('message_delete_failed') , Messenger::APP_MESSAGE_ERROR);
        }
        
        $this->redirect('/dailyexpenses') ;

        $this->_renderView();
    }
}