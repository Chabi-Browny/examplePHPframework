<?php
namespace App\Services;

use Core\Database;
use Core\Session\Session;
/**
 * Description of LoginSubmitService
 */
class LoginSubmitService {

    const LOGGIN_KEY = 'logged';

    private $dbconn;
    private $session;

    public function __construct(Database $db, Session $session )
    {
        $this->dbconn = $db;
        $this->session = $session;
    }

    public function login(string $email, string $pass)
    {
        $sql = 'SELECT id, u_name, u_pass FROM users WHERE u_email = :email ;';

        $stm = $this->dbconn->prepare($sql);
        $stm->bindParam('email', $email, \PDO::PARAM_STR);
        $stm->execute();
        $result = $stm->fetch(\PDO::FETCH_OBJ);

        if ($result !== false && password_verify( hash('sha3-512', $pass), $result->u_pass) )
        {
            $this->session->add( self::LOGGIN_KEY, [
                'id' => $result->id,
                'uName' => $result->u_name,
                'uEmail' => $email
            ]);
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function logout()
    {
        if ($this->checkLogg())
        {
            $this->session->remove(self::LOGGIN_KEY);
            $this->session->clearAll();
            return TRUE;
        }
        return FALSE;
    }

    public function checkLogg()
    {
        return $this->session->has(self::LOGGIN_KEY);
    }

}
