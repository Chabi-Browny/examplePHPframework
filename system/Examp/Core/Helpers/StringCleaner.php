<?php

namespace Core\Helpers;

/**
 * Description of StringCleaner
 */
class StringCleaner {
    
    protected $cleanedData;
    protected $uncleanedData;
    
    public function __construct() {}
    
    public function setUncleanedData( string $uncleandData ): self
    {
        $this->uncleanedData = $uncleandData;
        return $this;
    }
    
    public function getCleanedData (): string
    {
        return $this->cleanedData;
    }       
    
    public function removeEndingForvardSlashs( string $uncleanedData = null ): self
    {        
        $this->cleanedData = rtrim( $this->uncleandDataChecker($uncleanedData), '/');
        return $this;
    }
    
    public function trimBothSides( string $uncleanedData = null ): self
    {
        $this->cleanedData = trim( $this->uncleandDataChecker($uncleanedData) );
        return $this;
    }
    
    public function stripTags( string $uncleanedData = null ): self
    {
        $this->cleanedData = strip_tags( $this->uncleandDataChecker($uncleanedData) );
        return $this;
    }
    
    public function htmlSpecial( string $uncleanedData = null ): self
    {
        $this->cleanedData = htmlspecialchars( $this->uncleandDataChecker($uncleanedData), ENT_QUOTES, 'UTF-8' );
        return $this;
    }
    
    protected function uncleandDataChecker( string $incomData = null ): string
    {
        return $incomData !== null ? $incomData : $this->uncleanedData;
    }
    
}