<?php

namespace Core\Handlers\Input;

use Core\Handlers\Input\InputsCheck;
use Core\Request\Request;

class InputsManager {
    
    const POST = "post";
    const GET = "get";
    
    private $filters = [];
    private $posts;
    private $gets;
    private $request;
    
    public function __construct( Request $request ) 
    {
        $this->request = $request;
        $this->setRequestParams();
    }
    
    public function getPost(string $indexName = NULL)
    {
        if (array_key_exists($indexName, $this->posts) && $indexName !== NULL)
        {
            return $this->posts[$indexName];
        }
        else if (empty($indexName))
        {
            return $this->posts;
        }
        else
        {
            throw new Exception("There is no such key like: ".$indexName);
        }
    }
    
    public function getGet(string $indexName = NULL)
    {
        if (array_key_exists($indexName, $this->gets) && $indexName !== NULL)
        {
            return $this->gets[$indexName];
        }
        else if (empty($indexName))
        {
            return $this->gets;
        }
        else
        {
            throw new Exception("There is no such key like: ".$indexName);
        }
    }
    
    /**
     * @desc - check the POST data with the specific InputCheck method
     * @param type $inputName
     * @param type $filters
     * @param type $checkMethOpt
     * @return boolean|$this
     */
    public function setFilter(string $inputName, string $filters, $checkMethOpt='')
    {
        if ( $filters === '')
        {
            throw new Exception("No filter set!");
        }
        
        $this->filters[$inputName] = explode('|', $filters);
        return $this;
    }
    
    /**
     * @desc - scan the input reports
     * @return boolean - if no FALSE report at all, than give back TRUE, otherwise FALSE
     */
    public function scan()
    {
        $filterError = [];
        $inputCheck = new InputsCheck();
        
        foreach($this->filters as $inputName => $filterArr)
        {
            if (!empty($filterArr))
            {
                foreach($filterArr as $filter)
                {
                    $filterExp = explode(':', $filter);
                    $filterName = $filterExp[0];
                    $filterOpt = !empty($filterExp[1]) ? $filterExp[1] : '';
                    
                    $filterRes = $inputCheck->$filterName($this->getPost($inputName), $filterOpt);
                    
                    if ( $filterRes === FALSE)
                    {
                        $filterError[$inputName] = $filterRes;
                        break;
                    }
                }
            }
        }
        
        if (empty($filterError))
            { return TRUE; }
        else
            { return $filterError; }
    }
    
    /**
     * @desc - set to he specific error the specific error message
     */
    public function setFormErrors(){}
    
    /**/
    private function setRequestParams()
    {
        $this->posts = $this->request->getReqestedParams()[self::POST];
        $this->gets = $this->request->getReqestedParams()[self::GET];
    }
    
}