<?php


namespace SEVENAJJY\Controllers;

class NotFoundController extends AbstractController
{
    public function notFoundAction()
        {
            $this->language->load('template.common');
            $this->_renderView();
        }
}