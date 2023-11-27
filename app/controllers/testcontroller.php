<?php


namespace SEVENAJJY\Controllers;



class TestController extends AbstractController
{
    public function defaultAction()
    {
        var_dump($this->num('sss'));
        exit;
    }

}