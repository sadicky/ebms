<?php

    //Fonction Login
	function login(){
	    include('Vues/login.php');
	}
	function logout(){
		session_start();  
		session_destroy();  
		header("location:".WEBROOT."login");  
    }
    
    //Fonction de la page non trouvée
	function error404(){
	    include('Vues/Login/error404.php');
    }

	function client(){
		include 'Language/config.php';
		require_once('Models/connexion.php');
		require_once('Models/Client.php');
		$database = new Database();
		$database = $database->getConnexion();

		$getCustomer= new Client($database);		
		$getCustomer= $getCustomer->getAll();
	    include('Vues/clients.php');
	}
	
	
	function Add(){
		include 'Language/config.php';
		require_once('Models/connexion.php');
		require_once('Models/Client.php');
		require_once('Models/Invoice.php');
		$database = new Database();
		$database = $database->getConnexion();

		$invoice= new Invoice($database);	

		$getCust= new Client($database);		
		$getCustomer= $getCust->getAll();
		$getI  = $invoice->getInv();		
		// $getC= $getCust->getClient(1);
	    include('Vues/addinvoice.php');
	}
	
	function invoices(){
		include 'Language/config.php';
		require_once('Models/connexion.php');
		require_once('Models/Invoice.php');
		$database = new Database();
		$database = $database->getConnexion();

		$getCustomer= new Invoice($database);		
		$getInvoice= $getCustomer->getAll();
	    include('Vues/invoices.php');
	}
	
	function Search(){
		include 'Language/config.php';
		require_once('Models/connexion.php');
		require_once('Models/Invoice.php');
		$database = new Database();
		$database = $database->getConnexion();

		$getCustomer= new Invoice($database);		
		$getInvoice= $getCustomer->getAll();
	    include('Vues/search.php');
	}

	function Cancelled(){
		include 'Language/config.php';
		require_once('Models/connexion.php');
		require_once('Models/Invoice.php');
		$database = new Database();
		$database = $database->getConnexion();

		$getCustomer= new Invoice($database);		
		$getInvoice= $getCustomer->getAll();
	    include('Vues/cancelled.php');
	}
	function settings(){
		include 'Language/config.php';
		require_once('Models/connexion.php');
		require_once('Models/Interconnect.php');
		require_once('Models/Society.php');
		$database = new Database();
		$database = $database->getConnexion();

		$getI= new Interconnect($database);		
		$getI = $getI->getAll();

		$soc = new Society($database);	
		$getSoc = $soc->getAll();

	    include('Vues/settings.php');
	}	
	function profile(){
		include 'Language/config.php';
		require_once('Models/connexion.php');
		require_once('Models/User.php');
		$database = new Database();
		$database = $database->getConnexion();

		$getUser= new User($database);		
		$getUser = $getUser->getAll();

	    include('Vues/user.php');
	}
    //Fonction de la page non trouvée
	function dashboard(){
		include 'Language/config.php';
		// require_once('Models/category.class.php');
		// $files = $getFile->getFiles();
	    include('Vues/dashboard.php');
	}
