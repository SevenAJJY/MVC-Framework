<?php
namespace SEVENAJJY\Library\Template;

trait TemplateHelper {
    public function matchURL($url){
        return parse_url($_SERVER['REQUEST_URI'] , PHP_URL_PATH) === $url;
    }
}