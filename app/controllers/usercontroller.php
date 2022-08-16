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
        }
        $this->_renderView();
    }
}