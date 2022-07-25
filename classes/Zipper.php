<?php
Class Zipper{
    private $_files = array( ),
            $_zip;

public function __construct()
{
    $this->_zip = new ZipArchive;
}

 public function add($input){
    
    if(is_array($input)){
        
        $this->_files = array_merge($this->_files, $input);

    }else{
            $this->_files[] = $input;
    }
 }

 public function store($location = null){

    if(count($this->_files) && $location){
        foreach($this->_files as $index=>$file) {
            //Filter files that do not exist
            if(!file_exists($file)) { 
                //remove file that does not exist   
                unset($this->_files[$index]);   
            }
        }  

        //open the zip
        if($this->_zip->open($location, file_exists($location)? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE)){
            
            //loop through the files and add to zip
            foreach($this->_files as $file) {      
                $this->_zip->addFile($file, $file);      
            }  
            //close zip
            $this->_zip->close();
        }
        

        
        
    }
 }


}