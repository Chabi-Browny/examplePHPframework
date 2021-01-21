<?php

namespace Sys\Core\Handler\Input;

use Sys\Core\Handler\Input\InputsCheck;

class InputsManage {
    
    private $_errorReports = [];

    public function __construct() {
        
    }
    
    /**
     * @desc - check the POST data with the specific InputCheck method
     * @param type $inputName
     * @param type $checkMethName
     * @param type $checkMethOpt
     * @return boolean|$this
     */
    public function checkInput($inputName, $checkMethName, $checkMethOpt='')
    {
        $inputData = '';
        if( isset($_POST[$inputName]) )
        {
            $inputData = $_POST[$inputName];
        }
        else
        {
            return FALSE;
        }
        
        $checkerObj = new InputsCheck();
        $this->_errorReports[$inputName][] = $checkerObj->$checkMethName($inputData , $checkMethOpt);
         
        return $this;
    }
    
    /**
     * @desc - scan the input reports
     * @return boolean - if no FALSE report at all, than give back TRUE, otherwise FALSE
     */
    public function scan()
    {
        $regFalses = [];
        foreach($this->_errorReports as $repKey => $repResArr)
        {
            if(!empty($repResArr))
            {
                foreach($repResArr as $repRes)
                {
                    if($repRes === FALSE)
                    {
                        $regFalses[$repKey]= $repRes;
                        break;
                    }
                }
            }
        }
        
        if(empty($regFalses))
            { return TRUE; }
        else
            { return FALSE; }
    }
    
    /**
     * @desc - set to he specific error the specific error message
     */
    public function setFormErrors(){}
    

}