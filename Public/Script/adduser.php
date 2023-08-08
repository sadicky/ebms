<?php
 session_start(); 
require_once('../../Models/User.php');
require_once('../../Models/connexion.php');
$database = new Database();
$database = $database->getConnexion();
$user = new User($database);
   
         // sanitize
         $nom=htmlspecialchars(strip_tags($_GET['nom']));
         $prenom=htmlspecialchars(strip_tags($_GET['prenom']));
         $tel=htmlspecialchars(strip_tags($_GET['tel']));
         $email=htmlspecialchars(strip_tags($_GET['email']));
         $password=base64_encode($_GET['password']);
     
     // create the user
     $add = $user->Signup($nom,$prenom,$tel,$email,$password);     
    if($add) echo "Success";
    else echo 'error';
