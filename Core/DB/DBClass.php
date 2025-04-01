<?php
namespace Core\DB;

use PDO;
use PDOException;

class DBClass {
    private $PDO = null;
    private $iniFile = '/config.ini';
    private $dbConnectionData = [
        'host'     => '',
        'user'     => '',
        'password' => '',
        'db'       => '',
    ];

    public function init() {
        $config = parse_ini_file(__DIR__ . $this->iniFile);
        
        $this->dbConnectionData['host']     = $config['host'];
        $this->dbConnectionData['user']     = $config['user'];
        $this->dbConnectionData['password'] = $config['password'];
        $this->dbConnectionData['db']       = $config['db'];
    }

    public function connectToDB() {
        try {
            [
                'host'     => $host,
                'user'     => $user,
                'password' => $password,
                'db'       => $db,
                
            ] = $this->dbConnectionData;

            $this->PDO = new PDO("mysql:host=$host;dbname=$db", $user, $password);
            $this->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error connecting to the db" . $e->getMessage();
        }
    }

    public function getPDO()
    {
        return $this->PDO;
    }
}
