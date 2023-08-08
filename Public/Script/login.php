
<?php
session_start();
require_once('../../Models/connexion.php');
require_once('../../Models/User.php');
require_once('../../Models/Interconnect.php');

$database = new Database();
$database = $database->getConnexion();
$user = new User($database);
$int = new Interconnect($database);
    if (isset($_GET["email"])) {

        $email = htmlspecialchars(strip_tags($_GET['email']));
        $password = base64_decode($_GET['password']);

        // create the user
        $user = $user->Login(); 

        if($user->rowCount() > 0){
            $row = $user->fetch(PDO::FETCH_OBJ);            
            $resultat = $int->getInter();
            $data = array();
            $data[]=$resultat->fetchAll();
            // create array
            $user_arr=array(
                "status" => true,
                "message" => "Connexion Réussi avec succes!",
                "id" => $row->id,
                "nom" => $row->nom,
                "prenom" => $row->prenom,
                "email" => $row->email,
                "Interconnect"=>$data
            );
            print_r(json_encode($user_arr));
        }        
        
    //     $_SESSION['iduser'] = $user->id; 
        // print_r($user);die();
        // if ($user) {
            // $_SESSION["username"] = $_POST["username"];
            // $con_det = $qstatement->fetch();
            // $_SESSION['user0'] = ($con_det['con_username']);
            // $_SESSION['pswd0'] = ($con_det['con_password']);
            // $_SESSION['user'] = json_encode($con_det['con_username']);
            // $_SESSION['pswd'] = json_encode($con_det['con_password']);
            // $url = $con_det['con_url'];
            // $_SESSION['ebmsLogin'] = $url . 'login/';
            // $_SESSION['addInvoice'] = $url . 'addInvoice/';
            // $_SESSION['cancelInvoice'] = $url . 'cancelInvoice/';
            // $_SESSION['getInvoice'] = $url . 'getInvoice/';
            // $_SESSION['checkTIN'] = $url . 'checkTIN/';
            // header("location:invoice.php");
     } else {
            echo "<div class='container alert alert-danger alert-dismissible' role='alert'>
                    Invalid Username and Password
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                    </div>";
        }

        
        
?> 
