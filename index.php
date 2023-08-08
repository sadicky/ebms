<?php
session_start();
define('WEBROOT',str_replace('index.php', "", $_SERVER['SCRIPT_NAME']));
define('ROOT',str_replace('index.php', "", $_SERVER['SCRIPT_FILENAME']));

include 'Controllers/main.php';
// var_dump($lang);die();
if(isset($_GET['p'])){
	$params = explode('/', $_GET['p']); 
	//die(print_r($params));
	$_SESSION['action'] = '';
	$action = $params[0];
	$d = preg_split("#[-]+#", $action);
	// var_dump($d);die();
	$n = count($d);   
	if ($n > 1) 
	{
		$action = $d[0];
	}
	//url pour le login
	if($_GET['p']=='login'){
		login();
	}  
	
	//url pour le dashboard
	else if($_GET['p']=='dashboard')
	{
		dashboard();
	}
	else if($_GET['p']=='settings')
	{
		settings();
	}
	else if($_GET['p']=='profile')
	{
		profile();
	}
	//recupere un fichier
	else if($_GET['p']=='logout')
	{
		logout();
	}
	//recupere un fichier
	else if($_GET['p']=='addInvoice')
	{
		Add();
	}
	else if($_GET['p']=='invoices')
	{
		invoices();
	}
	else if($_GET['p']=='clients')
	{
		Client();
	}
	else if($_GET['p']=='search')
	{
		Search();
	}
	else if($_GET['p']=='cancelled')
	{
		Cancelled();
	}
	//pour la page non trouvee
	else{
		error404();
	}	
}
else{
	login();
}
?>