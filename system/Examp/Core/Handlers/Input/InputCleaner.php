<?php
namespace Core\Handlers\Input;

use Core\Helpers\StringCleaner;
/**
 * Description of InputCleaner
 */
class InputCleaner {
    
    protected $stringCleaner;
    
    public function __construct() 
    {
        $this->stringCleaner = new StringCleaner();
    }
    
    public function cleaningData($dataToClean)
    {
        return $this->stringCleaner->setUncleanedData($dataToClean)
            ->trimBothSides()
            ->htmlSpecial()
            ->stripTags()
            ->getCleanedData();
    }
    
    /**/
    public function cleanOne( $dataToClean )
    {
        if ( is_scalar($dataToClean) )
        {
            return $this->cleaningData($dataToClean);
        } 
        else 
        {
            throw new \Exception("The input data to clean is not scalar!");
        }
    }
    
    /**/
    public function cleanAll($dataToClean)
    {
        $retVal = [];
        if (!empty($dataToClean)) {
            foreach ($dataToClean as $uncleanKey => $unclean)
            {
                if (is_array($unclean)) 
                {
                    $retVal [$uncleanKey] = $this->cleanAll($unclean);
                }
                else
                {
                    $retVal [$uncleanKey] = $this->cleaningData($unclean);
                }
            }
            return $retVal;
        }
        else 
        {
            throw new \Exception("The array to clean is empty!");
        }
    }
        
}
