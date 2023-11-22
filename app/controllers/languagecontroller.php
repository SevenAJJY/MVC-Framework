<?php



namespace SEVENAJJY\Controllers;



class LanguageController extends AbstractController
{
    public function defaultAction()
    {
        if (isset($this->session->lang) &&$this->session->lang == 'en') {
            $this->session->lang = 'ar' ;
        }
        else {
            $this->session->lang = 'en' ;
        }
        
        if (isset($_SERVER['HTTP_REFERER'])) {
            $this->redirect($_SERVER['HTTP_REFERER']);
        }
    }
}