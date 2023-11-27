<?php

namespace SEVENAJJY\Controllers;

use SEVENAJJY\Models\UserGroupsModel;
use SEVENAJJY\Models\UserModel;
use SEVENAJJY\Models\UserProfileModel;

class UsersController extends AbstractController
{

   
    /**
     *  Here we put an Array $_createActionRoles in it the name of each of the fields
     *  we want to check with Type validate that you need 
     * and it will be called Trait(Validate) and exactly method isValid
     *
     * @var array
     */
    private array $_createActionRoles = 
    [
        'FirstName'      => 'req|alpha|between(3,10)',
        'LastName'       => 'req|alpha|between(3,10)',
        'Username'       => 'req|alphanum|between(3,12)',
        'Password'       => 'req|min(6)|eq_field(CPassword)',
        'CPassword'      => 'req|min(6)',
        'Email'          => 'req|email|eq_field(CEmail)',
        'CEmail'         => 'req|email',
        'PhoneNumber'    => 'alphanum|max(15)',
        'GroupId'        => 'req|int',
    ];
    public function defaultAction()
    {
        $this->language->load('template.common');
        $this->language->load('users.default');
        $this->_data['users'] = UserModel::getAll();
        $this->_renderView();
    }

    public function createAction()
    {
        $this->language->load('template.common');
        $this->language->load('users.create');
        $this->language->load('users.labels');
        $this->language->load('validation.errors');

        $this->_data['groups'] = UserGroupsModel::getAll() ;
        
        if (isset($_POST['submit'])) {

            $this->isValid($this->_createActionRoles, $_POST);
            // $user =  new UserModel();
            // $user->Username = $this->filterString($_POST['Username']);
            // $user->$_POST['Password'];
            // $user->Email = $this->filterString($_POST['Email']) ;
            // $user->PhoneNumber = $this->filterString($_POST['PhoneNumber']) ;
            // $user->GroupId = $this->filterInt($_POST['GroupId']) ;
            // $user->SubscriptionDate = $this->filterString($_POST['SubscriptionDate']) ;
            // $user->LastLogin = date('Y-m-d H:i:s') ;
            // $user->Status = 1;

            // if ($user->save()) {
            //     $userProfile = new UserProfileModel() ;
            //     $userProfile->UserId = $user->UserId ;
            //     $userProfile->FirstName = $this->filterString($_POST['FirstName']) ;
            //     $userProfile->LastName = $this->filterString($_POST['LastName']) ;
            //     $userProfile->Address = $this->filterString($_POST['Address']) ;
            //     $userProfile->DOB = $this->filterString($_POST['DOB']) ;            
            // }
        }
        $this->_renderView();
    }

    public function editAction()
    {
        $this->language->load('template.common');

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
        $this->language->load('template.common');

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