<?php

namespace SEVENAJJY\Library;

class FileUpload{
    private $name;
    private $type;
    private $size;
    private $tmpPath;
    private $error;

    private $fileExtension;

    private $allowedExtensions = [ 'jpg', 'jpeg' , 'png', 'gif', 'pdf', 'doc', 'docx', 'xls' , 'svg' ];

    
    public function __construct(array $file){
        $this->name      = $this->rename($file['image']['name']);
        $this->type      = $file['image']['type'];
        $this->size      = $file['image']['size'];
        $this->tmpPath   = $file['image']['tmp_name'];
        $this->error     = $file['image']['error'];
    }

    /**
     * encrypt name
     * @param mixed $name
     * 
     * @return string
     */
    private function rename($name){
        preg_match_all('/([a-z]{1,4})$/i' , $name, $m );
        $this->fileExtension = $m[0][0] ;
        $name = substr(strtolower(base64_encode($name.APP_SALT)),0,30);
        $name = preg_replace('/(\w{6})/i','$1_',$name);
        $name = rtrim($name,'_');
        $this->name = $name;
        return $name ;
    }

    /**
     * Verify the allowed type
     * @return bool
     */
    private function isAllowedType(){
        return in_array($this->fileExtension, $this->allowedExtensions);
    }

    /**
     * verify the size Acceptable
     * @return bool
     */
    private function isSizeNotAcceptable()
    {
        preg_match_all('/(\d+)([MG])$/i',MAX_FILE_SIZE_ALLOWED,$matches);
        $maxFileSizeToUpload = $matches[1][0] ;
        $sizeUnit =  $matches[2][0];
        $currentFileSize = ($sizeUnit == 'M') ? ($this->size / 1024 / 1024) : ($this->size / 1024 / 1024 / 1024) ;
        $currentFileSize = ceil($currentFileSize);  
        return(int) $currentFileSize > (int) $maxFileSizeToUpload ;
    }

    /**
     * verify the type of the image
     * @return bool
     */
    private function isImage()
    {
        return preg_match('/image/i', $this->type);
    }

    /** 
     * get the file name
     * @return string
     */
    public function getFileName()
    {
        return $this->name .'.'. $this->fileExtension ;
    }

    public function upload()
    {
        if ($this->error != 0) {
            throw new \Exception('Sorry file didn\'t upload Successfully ');
        }
        elseif(!$this->isAllowedType()){
            throw new \Exception('Sorry files of '.$this->fileExtension.' are not Allowed');
        }
        elseif ($this->isSizeNotAcceptable()) {
            throw new \Exception('Sorry file Size exceeds the maximum allowed size'.$this->fileExtension.' are not Allowed');
        }else {
            /**
             * TODO::Make sure that the folder has write permissions to avoid errors
             */
            $storageFolder = $this->isImage() ? IMAGES_UPLOAD_STORAGE : DOCUMENTS_UPLOAD_STORAGE ;
            if (is_writable($storageFolder)) {
                move_uploaded_file($this->tmpPath , $storageFolder . DS . $this->getFileName()) ;
            }
            else {
                throw new \Exception('Sorry, the destination folder is not writable ');
            }
        }
        return $this ;
    }
}