<?php
 session_start(); 
require_once('../../Models/Client.php');
require_once('../../Models/connexion.php');
$database = new Database();
$database = $database->getConnexion();
$cust = new Client($database);
   
         // sanitize
         $customer_name=htmlspecialchars(strip_tags($_GET['customer_name']));
         $customer_TIN=htmlspecialchars(strip_tags($_GET['customer_TIN']));
         $customer_address=htmlspecialchars(strip_tags($_GET['customer_address']));
         $vat_customer_payer=htmlspecialchars(strip_tags($_GET['vat_customer_payer']));
     
     // create the user
     $add = $cust->create($customer_name,$customer_TIN,$customer_address,$vat_customer_payer);     
    if($add) echo "Added Success";
    else echo 'error';
