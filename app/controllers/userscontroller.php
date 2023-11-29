<?php

namespace SEVENAJJY\Controllers;

use SEVENAJJY\Library\Messenger;
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

    private $_editActionRoles = 
    [
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
        $this->language->load('users.messages');
        $this->language->load('validation.errors');

        $this->_data['groups'] = UserGroupsModel::getAll() ;
        
        if (isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST)) {
            $user =  new UserModel();
            $user->Username = $this->filterString($_POST['Username']);
            $user->cryptPassword($_POST['Password']);
            $user->Email = $this->filterString($_POST['Email']) ;
            $user->PhoneNumber = $this->filterString($_POST['PhoneNumber']) ;
            $user->GroupId = $this->filterInt($_POST['GroupId']) ;
            $user->SubscriptionDate = $this->filterString($_POST['SubscriptionDate']) ;
            $user->LastLogin = date('Y-m-d H:i:s') ;
            $user->Status = 1;

            if (UserModel::userExists($this->filterString($user->Username))) {
                $this->messenger->add($this->language->get('message_user_exists') , Messenger::APP_MESSAGE_ERROR);
                $this->redirect('/users') ;
            }
            if (UserModel::emailExists($this->filterString($_POST['Email']))) {
                $this->messenger->add($this->language->get('message_email_exists') , Messenger::APP_MESSAGE_ERROR);
                $this->redirect('/users') ;
            }

            //TODO::SEND THE USER WELCOME EMAIL
            if ($user->save()) {
                $userProfile = new UserProfileModel() ;
                $userProfile->UserId = $user->UserId ;
                $userProfile->FirstName = $this->filterString($_POST['FirstName']) ;
                $userProfile->LastName = $this->filterString($_POST['LastName']) ;
                $userProfile->Address = $this->filterString($_POST['Address']) ;
                $userProfile->DOB = $this->filterString($_POST['DOB']) ;
                }
                if($userProfile->save(false))
                {
                    $this->messenger->add($this->language->get('message_create_success'));
                    $this->redirect('/users');
                } 
                else {
                    $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);
                }
            $this->redirect('/users');            
        }
        $this->_renderView();
    }

    public function editAction()
    {
        $id = $this->_getParams(0, 'int');
        $user = UserModel::getByKey( $id);

        if (false === $user) {
            $this->redirect('/users');
        }
        $this->_data['user'] = $user ;

        $this->language->load('template.common');
        $this->language->load('users.edit');
        $this->language->load('users.labels');
        $this->language->load('users.messages');
        $this->language->load('validation.errors');

        $this->_data['groups'] = UserGroupsModel::getAll() ;

        if (isset($_POST['submit']) && $this->isValid($this->_editActionRoles , $_POST)) {

            $user->PhoneNumber = $this->filterString($_POST['PhoneNumber']) ;
            $user->GroupId = $this->filterInt($_POST['GroupId']) ;

            if ($user->save()) {
                $this->messenger->add($this->language->get('message_create_success'));
            }
            else {
                $this->messenger->add($this->language->get('message_create_failed') , Messenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/users') ;
        }

        $this->_renderView();
    }

    public function deleteAction()
    {
        $id = $this->_getParams(0, 'int');
        $user = UserModel::getByKey( $id);
        $userProfile = UserProfileModel::getByKey($id);

        if (false === $user) {
            $this->redirect('/users');
        }

        $this->language->load('users.messages');

        
        var_dump($user, $userProfile);
        if ($userProfile->delete()) {
            if ($user->delete()) {
                $this->messenger->add($this->language->get('message_delete_success'));
            }
            else {
                $this->messenger->add($this->language->get('message_delete_failed') , Messenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/users') ;
        }
    }


    //TODO:: Make sure this is a Ajax Request Username Exists
    public function checkUserExistsAjaxAction()
    {
        if (isset($_POST['Username'])) {
            header('Content-type: text/plain') ;
            if(UserModel::userExists($this->filterString($_POST['Username'])) !== false){
                echo 1 ;
            }
            else {
                echo 2 ;
            }
        }
    }
   //TODO:: Make sure this is a Ajax Request Email Exists
    public function checkEmailExistsAjaxAction()
    {
        if (isset($_POST['Email'])) {
            header('Content-type: text/plain') ;
            if(UserModel::emailExists($this->filterString($_POST['Email'])) !== false){
                echo 1 ;
            }
            else {
                echo 2 ;
            }
        }
    }
}