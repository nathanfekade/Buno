<?php

class Connect{

    //private
    //public
    //protected

    // three ways to connect to database MysqlI(object oriented), mysqli(procedural), pdo

    private $user='root';
    private $db='bunodatabase';
    private $host='localhost';
    private $pass='';

    function _construct()
    {

    }
function getConnection()
    {
      $conn=new mysqli($this->host,$this->user, $this->pass,$this->db);
      if($conn->connect_error){
        die('error'.$conn->connect_error);
      }
      return $conn;
    }

    
}


?>