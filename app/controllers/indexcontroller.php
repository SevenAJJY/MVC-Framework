<?php


namespace SEVENAJJY\Controllers;



class IndexController extends AbstractController
{
    public function defaultAction()
    {
        $this->language->load('template.common');
        $this->language->load('index.default');
            $this->_renderView();
    }

}