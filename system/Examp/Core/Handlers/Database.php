<?php
defined('ISRUN') OR exit('Direct access to the script not allowed!');

namespace Examp\Core\Handlers;

class Database extends \PDO {
    
    private $_dbType="mysql";
    private $_dbHost = 'localhost';
    private $_dbName = 'prio_db';
    private $_dbUserName = 'root';
    private $_dbPass = '';

    public function __construct()
    {
        $this->_setConnection();
    }
    
    private function _setConnection()
    {
        try
        {
            parent::__construct(
                $this->_dbType.':host='.$this->_dbHost.';dbname='.$this->_dbName,
                $this->_dbUserName,
                $this->_dbPass,
                [
                    \PDO::ATTR_ERRMODE => self::ERRMODE_EXCEPTION,
                    \PDO::ATTR_ERRMODE => self::ERRMODE_WARNING,
                    \PDO::MYSQL_ATTR_FOUND_ROWS => true,
                    \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                ]);
        }
        catch ( \PDOException $e )
        {
            print_r('ErrorPdo:'.$e->getMessage());
        }
        
    }

}