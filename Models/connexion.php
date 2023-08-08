<?php
class Database{

    //les proprietés de connexion à la base de données
     private $host="localhost";
     private $dbName="ebmsapi";
     private $username="root";
     private $password="";

     //connexion à la base de données
     public function getConnexion(){

         $db=null;
         
         try {
             $db = new PDO("mysql:host=$this->host;dbname=$this->dbName;charset=utf8",
             $this->username,$this->password
            );
         } catch (PDOException $e) {
             echo "Erreur de connexion:".$e->getMessage();
         }

         return $db;
     }
}