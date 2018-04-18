<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Sys;

require 'Helper.php';
use App\Sys\Helper;

/**
 * Description of DB
 *
 * @author linux
 */
class DB extends \PDO{
    
    private $stmt;
    static private $_instance=null;
    
    
    static function getInstance(){
        if(!(self::$_instance instanceof self)){
            self::$_instance=new self();
        }
        
        return self::$_instance;
        
    }
    function __construct(){
       
        $dbconf=Helper::getConfig();
        
        $dsn=$dbconf['driver'].':host='.$dbconf['dbhost'].';dbname='.$dbconf['dbname'];
        $usr=$dbconf['dbuser'];
        $pwd=$dbconf['dbpass'];
        
        try{
        parent::__construct($dsn,$usr,$pwd);
        
        } catch (PDOException $e){
            echo $e->getMessage();
        }
        
    }
    
    public function query($sql){
        try{
        $this->stmt = self::$_instance->prepare($sql);
        } catch (\PDOException $ex){
            echo $ex->getMessage();
        }
    }
    
    public function bind($param,$value){
        
        $type = null;
        
        switch (true){
        case is_bool($value):
            $type = \PDO::PARAM_BOOL;
        break;
        case is_string($value):
            $type = \PDO::PARAM_STR;
        break;
        case is_int($value):
            $type = \PDO::PARAM_INT;
        break;
        default:
            $type = \PDO::PARAM_NULL;
        break;
        
        }
        $this->stmt->bindValue($param, $value, $type);
    }
    
    public function execute(){
      return $this->stmt->execute();
    }
    
    public function resultSet(){
        return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function single(){
        return $this->stmt->fetch(\PDO::FETCH_ASSOC);              
    }
    
    public function rowCount(){
    	return $this->stmt->rowCount();
    }
    
    //començar una transaccio de la base de dades.
    public function beginTransaction(){
        return $this->stmt->beginTransaction();
    }
    //depuracio de sentencies preparades.
    public function debugDumpParams(){
        return $this->stmt->debugDumpParams();
    }

                
}

