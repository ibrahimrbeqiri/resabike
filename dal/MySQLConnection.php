<?php

class MySQLConnection {
    const HOST = "127.0.0.1";
    const PORT = "3306";
    const DATABASE = "resabike";
    const USER = "grp7";
    const PWD = "Espagne2016";
    
    private static $instance;
    private $_conn;
    
    private function __construct()
    {
        try{
            $this->_conn = new PDO('mysql:host='.self::HOST.
                ';port='.self::PORT.
                ';dbname='.self::DATABASE,
                self::USER, self::PWD,array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        }
        catch (PDOException $e) {
            die ('Connection failed: ' . $e->getMessage());
        }
    }
    
    public static function getInstance()
    {
        if (!isset(self::$instance)|| self::$instance == null)
        {
            $c = __CLASS__;
            self::$instance = new $c();
        }
        return self::$instance;
    }
    
    public function execute($query, $attributes){
        $stmt = $this->_conn->prepare($query);
        $stmt->execute($attributes);
        $code = $stmt->errorCode();
        if($code!='00000'){
            if($code == '23000'){
                return array('status'=>'error', 'result'=>'sql_query_doublon');
            }
            return array('status'=>'error', 'result'=>'sql_query_failed');
        }
        $result = $stmt->fetchAll();
        return array('status'=>'success', 'result'=>$result);
    }
}
