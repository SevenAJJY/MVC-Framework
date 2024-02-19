<?php

namespace SEVENAJJY\Library;

use ArrayIterator;

trait GenerateJSONFile {
    
    public function GenerateJSONFile(ArrayIterator|false $data, String $fileName)
    {
        // var_dump($fileName);exit;
        $this->checkFile($fileName);
        $data = json_encode($data);
        file_put_contents($fileName, $data);
    }

    private function checkFile($fileName){
        // Remove the old json file to put back the new one
        if($fileName !== '' && file_exists(JSON_DATA.DS.$fileName) && is_writable(JSON_DATA)) {
            unlink(JSON_DATA.DS.$fileName);
        }
    }
}