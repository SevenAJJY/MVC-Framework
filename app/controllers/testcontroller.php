<?php


namespace SEVENAJJY\Controllers;



class TestController extends AbstractController
{
    public function defaultAction()
    {
        var_dump($this->floatlike(23.222, 2,3 ));
        exit;
    }

}