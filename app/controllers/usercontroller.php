<?php

namespace SEVENAJJY\Controllers;

use SEVENAJJY\Models\UserModel;

class UserController extends AbstractController
{
    public function defaultAction()
    {
        $this->_data['users'] = UserModel::getAll();
        $this->_renderView();
    }

    public function createAction()
    {
        if (isset($_POST['submit'])) {
            $user = new UserModel();
            $user->name    = $this->filterString($_POST['name']);
            $user->address = $this->filterString($_POST['address']);
            $user->age     = $this->filterInt($_POST['age']);
            $user->tax     = $this->filterFloat($_POST['tax']);
            $user->salary  = $this->filterFloat($_POST['salary']);
            if ($user->save()) {
                $_SESSION['message'] = 'Saving User '. $user->name . 'Sucessfully';
                $this->redirect("/user");
            }
            else{
                $this->redirectBack('/user/create');
            }
        }
        $this->_renderView();
    }

    public function editAction()
    {
        $pk = $this->_getParams(0, "int");
        $user = UserModel::getByKey($pk);
        if ($user === false) {
            $this->redirectBack('/user');
        }
        $this->_data['user'] = $user ;

        if (isset($_POST['submit'])) {
            $user->name    = $this->filterString($_POST['name']);
            $user->address = $this->filterString($_POST['address']);
            $user->age     = $this->filterInt($_POST['age']);
            $user->tax     = $this->filterFloat($_POST['tax']);
            $user->salary  = $this->filterFloat($_POST['salary']);
            if ($user->save()) {
                $_SESSION['message'] = 'Saving User '. $user->name . 'Sucessfully';
                $this->redirect("/user");
            }
            else{
                $this->redirectBack('/user/create');
            }
        }
        $this->_renderView();
    }

    public function deleteAction()
    {
        $pk = $this->_getParams(0, "int");
        $user = UserModel::getByKey($pk);
        if ($user === false) {
            $this->redirectBack('/user');
        }

        if ($user->delete()) {
            $_SESSION['message'] = 'User Deleted Sucessfully';
            $this->redirect("/user");
        }
        else{
            $this->redirectBack('/user');
        }
    }
}