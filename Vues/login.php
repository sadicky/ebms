<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Login</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="Assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="Assets/css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="Assets/css/maruti-login.css" />
</head>

<body>
    <div id="loginbox">
        <form class="form-vertical" method="post">
            <div class="control-group normal_text">
                <h3>eBMS - Login</h3>
            </div>
            <div class="control-group">
                <div class="controls">
                    <div class="main_input_box">
                        <span class="add-on"><i class="icon-user"></i></span><input id="email" name="email" type="email" placeholder="Email" />
                    </div>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <div class="main_input_box">
                        <span class="add-on"><i class="icon-lock"></i></span><input type="password" id="password" name="password" placeholder="Mot de passe" />
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <span class="pull-left"><a href="#" class="flip-link btn btn-inverse" id="to-recover">Lost password?</a></span>
                <span class="pull-right"><input type="submit" name="btn" class="btn btn-primary btnlogin" value="Login" /></span>
            </div>
        </form>
    </div>

    <script src="Assets/js/jquery.min.js"></script>
    <script src="Assets/js/maruti.login.js"></script>
</body>

<?php
include('./Models/connexion2.php');
$db = getConnexion();

if (isset($_POST["btn"])) {
    $email = htmlspecialchars($_POST["email"]);
    $pwd = base64_encode($_POST["password"]);
    $query = "SELECT * FROM tbl_users u WHERE u.email =? AND u.password = ?";
    $statement = $db->prepare($query);
    $statement->execute(array($email, $pwd));
    $user = $statement->fetch(PDO::FETCH_OBJ);

    $qcon = "SELECT * FROM tbl_interconnect where con_id=?";
    $qstatement = $db->prepare($qcon);
    $qstatement->execute(
        array("2")
    );


    $count = $statement->rowCount();
    if ($count > 0) {
        $_SESSION["email"] = $user->email;
        $_SESSION['iduser'] = $user->id;
        $_SESSION["nom"] = $user->nom;
        $_SESSION["prenom"] = $user->prenom;
        $con_det = $qstatement->fetch();

        $_SESSION['user0'] = ($con_det['con_username']);
        $_SESSION['pswd0'] = ($con_det['con_password']);
        $_SESSION['user'] = json_encode($con_det['con_username']);
        $_SESSION['pswd'] = json_encode($con_det['con_password']);
        
        $url = $con_det['con_url'];
        $_SESSION['ebmsLogin'] = $url . 'login/';
        $_SESSION['addInvoice'] = $url . 'addInvoice/';
        $_SESSION['cancelInvoice'] = $url . 'cancelInvoice/';
        $_SESSION['getInvoice'] = $url . 'getInvoice/';
        $_SESSION['checkTIN'] = $url . 'checkTIN/';
        header("location:" . WEBROOT . "dashboard");
    } else {
        echo "<div class='container alert alert-danger alert-dismissible' role='alert'>
                    Invalid Username and Password
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                    </div>";
    }
}

?>


</html>