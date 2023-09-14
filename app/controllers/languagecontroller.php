<?php



namespace SEVENAJJY\Controllers;



class LanguageController extends AbstractController
{
    public function defaultAction()
    {

        if (isset($_SESSION['lang']) && $_SESSION['lang'] == 'en') {
            $_SESSION['lang'] = 'ar';
        }else{
            $_SESSION['lang'] = 'en';
        }
        $this->redirect($_SERVER['HTTP_REFERER']);
    }
}