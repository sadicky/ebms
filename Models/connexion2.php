<?php
    //les proprietés de connexion à la base de données
   

     //connexion à la base de données
    function getConnexion(){
        $host="localhost";
        $dbName="ebmsapi";
        $username="root";
        $password="";
         $db=null;
         
         try {
             $db = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8",
             $username,$password
            );
         } catch (PDOException $e) {
             echo "Erreur de connexion:".$e->getMessage();
         }

         return $db;
     }