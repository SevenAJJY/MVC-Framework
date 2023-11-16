<?php


namespace SEVENAJJY\Controllers;



class IndexController extends AbstractController
{
    public function defaultAction()
    {
        $this->_language->load('template.common');
        $this->_renderView();
        
    }

    public function addAction()
    {
        $this->_language->load('template.common');
        $this->_renderView();
    }
}