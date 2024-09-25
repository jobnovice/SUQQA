<?php
class Connect{
private $user='root';
private $host='localhost';
private $pass='';
private $db='suqqa';

function __construct()
{

}
function getConnection()
{
    $connection=new mysqli($this->host,$this->user,$this->pass,$this->db);
    if($connection->connect_error)
    {
        die('connection doent work'.$connection->connect_error);
    }
    return $connection;
}
}

?>