<?php
    if(!isset($_SESSION['Lang']))
        $_SESSION['Lang']= "en";
    else if(isset($_GET['Lang']) && $_SESSION['Lang'] != $_GET['Lang'] && !empty($_GET['Lang'])){
        if($_GET['Lang']=="en")
            $_SESSION['Lang']= "en";
        else if($_GET['Lang']=="fr")
        $_SESSION['Lang']= "fr";
    }
    
 require_once $_SESSION['Lang'].".php"; 


?>