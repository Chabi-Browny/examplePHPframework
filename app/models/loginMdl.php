<?php

use Examp\Core\Handlers\Model;

class LoginMdl extends Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getAllUserAllInfo()
    {
        $stm = $this->dbObj->prepare('SELECT * FROM users');
        $stm->execute();
        if( $stm->rowCount() > 0 )
        {
            return $stm->fetch(PDO::FETCH_ASSOC);    
        }
        return FALSE;
    }
    
    public function getUserInfos($uName, $uPass)
    {
        $sqlStr = 'SELECT id,u_name,u_email FROM users WHERE u_email=? AND u_pass=?';
        $stm = $this->dbObj->prepare($sqlStr);
        $stm->execute([$uName, $uPass]);
        if( $stm->rowCount() == 1 )
        {
            return $stm->fetch(PDO::FETCH_ASSOC);    
        }
        return FALSE;
    }

}