<?php

namespace SEVENAJJY\Controllers;

use SEVENAJJY\Library\FileUpload;
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

    private $_changePasswordActionRoles = 
    [
        'OPassword'       => 'req|min(6)',
        'NPassword'       => 'req|min(6)|eq_field(CNPassword)',
        'CNPassword'      => 'req|min(6)',
    ];

    private $_resetPasswordActionRoles = 
    [
        'Password'       => 'req|min(6)|eq_field(CPassword)',
        'CPassword'      => 'req|min(6)',
    ];
    
    public function defaultAction()
    {
        $this->language->load('template.common');
        $this->language->load('users.default');

        $this->_data['users'] = UserModel::getUsers($this->session->u);
        
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
        $uploadError = false;

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

            $error = false ;
            if (UserModel::userExists($this->filterString($user->Username))) {
                $this->messenger->add($this->language->get('message_user_exists') , Messenger::APP_MESSAGE_ERROR);
                $this->redirect('/users') ;
                $error = true ;
            }
            if (UserModel::emailExists($this->filterString($_POST['Email']))) {
                $this->messenger->add($this->language->get('message_email_exists') , Messenger::APP_MESSAGE_ERROR);
                $this->redirect('/users') ;
                $error = true ;
            }

            //TODO:: SEND THE USER WELCOME EMAIL
            if ($error != true) {
                if ($user->save()) {
                    $userProfile = new UserProfileModel() ;
                    $userProfile->UserId = $user->UserId ;
                    $userProfile->FirstName = $this->filterString($_POST['FirstName']) ;
                    $userProfile->LastName = $this->filterString($_POST['LastName']) ;
                    $userProfile->Address = $this->filterString($_POST['Address']) ;
                    $userProfile->DOB = $this->filterString($_POST['DOB']) ;
                    if(!empty($_FILES['image']['name'])) {
                        $uploader = new FileUpload($_FILES);
                        try {
                            $uploader->upload();
                            $userProfile->Image = $uploader->getFileName();
                        } catch (\Exception $e) {
                            $this->messenger->add($e->getMessage(), Messenger::APP_MESSAGE_ERROR);
                            $uploadError = true;
                        }
                    }
                    // var_dump($uploadError);exit;
                    if($uploadError === false && $userProfile->save(false))
                    {
                        $this->messenger->add($this->language->get('message_create_success'));
                        $this->redirect('/users');
                    } 
                    else {
                        $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);
                    }
                }
                else {
                    $this->messenger->add($this->language->get('message_create_failed') , Messenger::APP_MESSAGE_ERROR);
                }
            }
            $this->redirect('/users');            
        }
        $this->_renderView();
    }

    public function editAction()
    {
        $id = $this->_getParams(0, 'int');
        $user = UserModel::getByKey( $id);

        if (false === $user || $this->session->u->UserId == $id) {
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

        if (false === $user || $this->session->u->UserId == $id) {
            $this->redirect('/users');
        }

        $this->language->load('users.messages');

        
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
    public function viewAction()
    {
        $this->language->load('template.common');
        $this->language->load('users.view');
        $this->language->load('users.labels');
        $this->language->load('users.messages');
        $this->language->load('validation.errors');

        $userProfile = UserProfileModel::getProfile($this->session->u);
        $this->_data['profile'] = $userProfile ;

        $user = UserModel::getUserProfile($this->session->u) ;
        $this->_data['user'] = $user ;

        $uploadError = false ;
        if (isset($_POST['submit'])) {
            if(!empty($_FILES['image']['name'])) {
                // Remove the old image
                if($userProfile->Image !== '' && file_exists(IMAGES_UPLOAD_STORAGE.DS.$userProfile->Image) && is_writable(IMAGES_UPLOAD_STORAGE)) {
                    unlink(IMAGES_UPLOAD_STORAGE.DS.$userProfile->Image);
                }
                // Create a new image
                $uploader = new FileUpload($_FILES);
                try {
                    $uploader->upload();
                    $userProfile->Image = $uploader->getFileName();
                } catch (\Exception $e) {
                    $this->messenger->add($e->getMessage(), Messenger::APP_MESSAGE_ERROR);
                    $uploadError = true;
                }
            }
            if($uploadError === false && $userProfile->save())
            {
                $this->messenger->add($this->language->get('message_create_success'));
                $this->redirect('/users/view');
            } else {
                $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);
            }
        }
        

        $this->_renderView();
    }

    public function editprofileAction()
    {
        $this->language->load('template.common');
        $this->language->load('users.editprofile');
        $this->language->load('users.labels');
        $this->language->load('users.messages');
        $this->language->load('validation.errors');

        $user = UserModel::getUserProfile($this->session->u) ;
        $this->_data['user'] = $user ;

        $userProfile = UserProfileModel::getProfile($this->session->u);
        $this->_data['profile'] = $userProfile ;

        $uploadError = false ;
        if (isset($_POST['saveImage'])) {
            if (!empty($_FILES['image']['name'])) {
                ### -> Remove the old Image
                if ($userProfile->Image !== '' && file_exists(IMAGES_UPLOAD_STORAGE.DS.$userProfile->Image) && is_writable(IMAGES_UPLOAD_STORAGE)) {
                    unlink(IMAGES_UPLOAD_STORAGE.DS.$userProfile->Image);
                }
                ### -> Create a new image
                $uploader = new FileUpload($_FILES);
                try {
                    $uploader->upload();
                    $userProfile->Image = $uploader->getFileName();
                } catch (\Exception $e) {
                    $this->messenger->add($e->getMessage(), Messenger::APP_MESSAGE_ERROR);
                    $uploadError = true;
                }
            }
            if($uploadError === false && $userProfile->save())
            {
                $this->messenger->add($this->language->get('message_create_success'));
                $this->redirect('/users/view');
            } else {
                $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);
            }
        }

        if (isset($_POST['submit'])) {
            $user->PhoneNumber = $this->filterString($_POST['PhoneNumber']) ;
            if ($user->save()) {
                $userProfile->FirstName = $this->filterString($_POST['FirstName']) ;
                $userProfile->LastName = $this->filterString($_POST['LastName']) ;
                $userProfile->Address = $this->filterString($_POST['Address']) ;
                $userProfile->DOB = $this->filterString($_POST['DOB']) ;
                if($userProfile->save())
                {
                    $this->messenger->add($this->language->get('message_create_success'));
                    $this->redirect('/users/view');
                } 
                else {
                    $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);
                }
            }
            else {
                $this->messenger->add($this->language->get('message_create_failed') , Messenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/users') ;
        }

        $this->_renderView();
    }

    public function changepasswordAction()
    {
        $this->language->load('template.common');
        $this->language->load('users.changepassword');
        $this->language->load('users.labels');
        $this->language->load('users.messages');
        $this->language->load('validation.errors');

        $user = UserModel::getByKey($this->session->u->UserId) ;
        $this->_data['user'] = $user ;

        $userProfile = UserProfileModel::getProfile($this->session->u);
        $this->_data['profile'] = $userProfile ; 

        $uploadError = false ;
        if (isset($_POST['saveImage'])) {
            if (!empty($_FILES['image']['name'])) {
                ### -> Remove the old Image
                if ($userProfile->Image !== '' && file_exists(IMAGES_UPLOAD_STORAGE.DS.$userProfile->Image) && is_writable(IMAGES_UPLOAD_STORAGE)) {
                    unlink(IMAGES_UPLOAD_STORAGE.DS.$userProfile->Image);
                }
                ### -> Create a new image
                $uploader = new FileUpload($_FILES);
                try {
                    $uploader->upload();
                    $userProfile->Image = $uploader->getFileName();
                } catch (\Exception $e) {
                    $this->messenger->add($e->getMessage(), Messenger::APP_MESSAGE_ERROR);
                    $uploadError = true;
                }
            }
            if($uploadError === false && $userProfile->save())
            {
                $this->messenger->add($this->language->get('message_create_success'));
                $this->redirect('/users/view');
            } else {
                $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);
            }
        }

        if (isset($_POST['submit']) && $this->isValid($this->_changePasswordActionRoles , $_POST)) {
            $newPassword = $user->confirmCryptPassword($_POST['OPassword']);
            if($user->Password === $newPassword){
                $user->cryptPassword($_POST['NPassword']);
                if ($user->save()) {
                    $this->messenger->add($this->language->get('message_create_success'));
                }
                else {
                    $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);
                }
            }else {
                $this->messenger->add($this->language->get('message_password_mismatch'), Messenger::APP_MESSAGE_ERROR);
                $this->redirect('/users/changepassword') ;
            }
            $this->redirect('/users/view') ;
        }

        $this->_renderView();
    }


    public function resetpasswordAction()
    {
        $this->language->load('template.common');
        $this->language->load('users.resetpassword');
        $this->language->load('users.messages');
        $this->language->load('validation.errors');

        $id = $this->_getParams(0, 'int');

        $user = UserModel::getByKey($id);

        if($user === false || $user->UserId === $this->session->u->UserId) {
            $this->redirect('/users');
        }

        if (isset($_POST['submit'])) {
            if ($this->isValid($this->_resetPasswordActionRoles , $_POST)) {
                if ($this->filterString($_POST['Password']) == $this->filterString($_POST['CPassword'])) {
                    $user->cryptPassword($_POST['Password']);
                    if ($user->save()) {
                        $this->messenger->add($this->language->get('message_create_success'));
                    }
                    else {
                        $this->messenger->add($this->language->get('message_password_mismatch'), Messenger::APP_MESSAGE_ERROR);
                        $this->redirect('/users/resetpassword') ;
                    }
                }
                else {
                    $this->messenger->add($this->language->get('message_password_mismatch'), Messenger::APP_MESSAGE_ERROR);
                    $this->redirect('/users/resetpassword') ;
                }
            }
            $this->redirect('/users/default') ;
        }

        $this->_renderView();
    }

    public function settingsAction(){
        $this->language->load('template.common');
        $this->language->load('users.resetpassword');
        $this->language->load('users.messages');
        $this->language->load('validation.errors');
    }
}