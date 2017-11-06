<?php

class MySQLConnection {
    const HOST = "localhost";
    const PORT = "3306";
    const DATABASE = "resabike";
    const USER = "root";
    const PWD = "root";

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
            return array('status'=>'error', 'result'=>'sql_query_failed '.$code);

        }
        $result = $stmt->fetchAll();
        return array('status'=>'success', 'result'=>$result);
    }
    public function insertReservation($query, $attributes)
    {
        $stmt = $this->_conn->prepare($query);
        $stmt->execute($attributes);
        $id = $this->_conn->lastInsertId();
        $code = $stmt->errorCode();
        if($code!='00000'){
            if($code == '23000'){
                return array('status'=>'error', 'result'=>'sql_query_doublon');
            }
            return array('status'=>'error', 'result'=>'sql_query_failed '.$code);
            
        }
        $result = $stmt->fetchAll();
        return array('status'=>'success', 'result'=>$result, 'id'=>$id);
    }
	public function fetch($query){
		$stmt = $this->_conn->prepare($query);
		$stmt->execute();
		$code = $stmt->errorCode();
		if($code!='00000'){
			if($code == '23000'){
				return array('status'=>'error', 'result'=>'sql_query_doublon');
			}
			return array('status'=>'error', 'result'=>'sql_query_failed '.$code);

		}
		$result = $stmt->fetchAll();
		return array('status'=>'success', 'result'=>$result);
	}
	public function getRows($query, $attributes)
	{
	    $stmt = $this->_conn->prepare($query);
	    $stmt->execute($attributes);
	    $code = $stmt->errorCode();
	    if($code!='00000'){
	        if($code == '23000'){
	            return array('status'=>'error', 'result'=>'sql_query_doublon');
	        }
	        return array('status'=>'error', 'result'=>'sql_query_failed '.$code);
	        
	    }
	    $result = $stmt->rowCount();
	    return $result;
	     
	}
	
    public static function getConnection()
    {
        return self::getInstance()->_conn;
    }

}
