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
                echo $user->name . " has neem Saved successfullyc with ID ". $user->id;
            }
        }
        $this->_renderView();
    }
}