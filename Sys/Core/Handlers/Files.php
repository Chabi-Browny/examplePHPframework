<?php

namespace Sys\Core\Handlers;

class Files {

    public function __construct() {
//        vdx('this is the file');
    }
    
    /**
     * @desc - search for the target file, and give back the file name
     * @param type $getFile
     * @param type $filePath
     * @param type $defaultFile
     * @param type $basePath
     * @return boolean|string
     */
    public function searchFile($getFile, $filePath,  $resultArr=[])
    {
        //minden esetben megnézzük hogy hol vagyunk, ez visszad egy tömböt
        $examinedPathArr = array_diff( scandir($filePath), ['.','..']);
        
        $fileName = '';
        foreach($examinedPathArr as $subject)
        {
            //$subject - ez lehet file VAGY könyvtár
            //vdx($subject);
            
            //összefűzi $filePath(bejövő paraméterből) és a vizsgált $subject, ami fájl VAGY könyvtár
            $path = $filePath.DS.$subject;
            
            //az útvonal könyvtárra mutat?
            if( is_dir($path) )
            {
                $fileName = $this->searchFile( $getFile, $path, $resultArr );
            }
            else if( !is_dir($path) )//ha az útvonal fájlra mutat
            {
                $file =  explode('.', $subject);
                
                if( isset($file[1]) && $getFile == $file[0] ) // 
                {
                     $resultArr['path'] = $path;
                     $resultArr['name'] = $file[0].'.'.$file[1];
                     return $resultArr;
                }
            }
            if(!empty($fileName))
            {
                break;
            }
        }
        return $fileName;
    }

}