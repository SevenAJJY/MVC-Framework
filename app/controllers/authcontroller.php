<?php


namespace SEVENAJJY\Controllers;

use SEVENAJJY\Library\Messenger;
use SEVENAJJY\Models\UserModel;

class AuthController extends AbstractController
{
    public function loginAction()
    {
        $this->_template->swapTemplate(
            [':VIEW' => ':actionView' ]
        );
        $this->language->load("auth.login");
        if (isset($_POST['login'])) {
            $isAuthorized = UserModel::authenticate($_POST['ucname'], $_POST['ucpwd'], $this->session);
            if ($isAuthorized == 2) {
                $this->messenger->add($this->language->get('text_user_disabled'),Messenger::APP_MESSAGE_ERROR) ;
            }
            elseif ($isAuthorized == 1) {
                $this->redirect('/');
            }
            elseif ($isAuthorized === false) {
                $this->messenger->add($this->language->get('text_user_not_found'),Messenger::APP_MESSAGE_ERROR) ;
            }
        }

        $this->_renderView();
    }

    public function logoutAction()
    {
        //TODO:: CHECK THE COOKIE DELETION
        $this->session->Kill() ;
        $this->redirect('/auth/login');
    }

}