<?php

session_start(); 
require_once('../../Models/Client.php');
require_once('../../Models/connexion.php');
require_once('../../Language/config.php');
$database = new Database();
$database = $database->getConnexion();
$cust = new Client($database);
$customer_TIN=$_POST["customer_TIN"];

 
$success = 0;
$msg = "";
$manage = [];
 
if (!empty($customer_TIN)) {
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => $_SESSION['ebmsLogin'],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{"username": '.$_SESSION['user'].',"password":'.$_SESSION['pswd'].'}',
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json'
    ),
  ));
  
  $response = curl_exec($curl);
  curl_close($curl);

  $login=json_decode($response,true);
  $login['result']['token'];
  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => $_SESSION['checkTIN'],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
      "tp_TIN": "'.$customer_TIN.'"
      }',
    CURLOPT_HTTPHEADER => array(
      'Authorization: Bearer '.$login['result']['token'].'',
      'Content-Type: application/json'
    ),
  ));
  
  $response = curl_exec($curl);
  $manage=json_decode($response,true);
  if(!empty($manage['result'])) {
    echo "<span class='label label-success'>".$manage['result']['taxpayer'][0]['tp_name']."</span><br>";
   }
  else{
    echo "<span class='label label-important'>".$manage['msg']."</span>";
  }


} else {
	$msg = "Veuillez renseigner tous les champs";
}
 

?>