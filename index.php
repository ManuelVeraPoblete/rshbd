<?php
    session_start();
    if ( isset($_SESSION["control"]) and $_SESSION["control"]="S"  )
    {
        header("Location: app/Menu_Sistema.php");
    } 
    if( $_POST )
    {
        #Comprueba que las variables existan
        if ( isset( $_POST['Usuario'] ) and isset( $_POST['Password'] ) ){
            # archivo php necesario
            require_once 'Clases/ClaseUsuario.php';
            $tra=new Usuario();
            //$datos=$usr->validar_ingreso($_POST["Usuario"],$_POST["Password"]);
            $datos=$tra->validar_ingreso($_POST['Usuario'],$_POST['Password']);
            if(sizeof($datos)==0)
            {
            ?>
                <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class= "sr-only">Error:</span>Usuario Incorrecto
                </div>
            <?php
            } else {         
                if ($datos[0]['Password'] == md5($_POST['Password'])){
                    session_start();
                    $_SESSION["control"]     = "S";
                    $_SESSION["nom"]         = $datos[0]['Nombre'];
                    $_SESSION["eml"]         = $datos[0]['Email'];
                    $_SESSION["ape"]         = $datos[0]['Apellido'];
                    $_SESSION["id_usuario"]  = $datos[0]['id'];
                    $_SESSION["niv"]         = $datos[0]['Nivel'];
                    $_SESSION["per"]         = $datos[0]['Perfil'];
                    $_SESSION["usr"]         = $datos[0]['Usuario'];
                    $_SESSION["per_id"]      = $datos[0]['Perfil_Id'];
                    $_SESSION["niv_id"]      = $datos[0]['Nivel_Id'];
                    $_SESSION["time"]        = time();
                    $_SESSION["Modulo"]      = "";
                    header("Location: app/Menu_Sistema.php");
                } else {
                  ?>
                    <div class="alert alert-danger" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class= "sr-only">Error:</span>Password Incorrecta
                    </div>
              <?php
            }
           }
        }
    }       
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="robots" content="noindex">
        <title>Sistema Integrado RSH</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bootstrap.css" rel="stylesheet" id="bootstrap-css">
        <link href="css/login.css" rel="stylesheet" id="login-css">
        <script src="js/jquery-3.1.1.js"></script>
        <script src="js/bootstrap.js"></script>
    </head>
    <body >
        <div class="container">
            <div class="card card-container">
                <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
                <p id="profile-name" class="profile-name-card"></p>
                <form class="form-signin" method="post">
                    <span id="reauth-email" class="reauth-email"></span>
                    <input type="text" id="Usuario" name="Usuario" class="form-control" placeholder="Usuario" required autofocus>
                    <input type="password" id="Password" name="Password" class="form-control" placeholder="Password" required>
                    <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Ingresar</button>
                </form><!-- /form -->
            </div><!-- /card-container -->
        </div><!-- /container -->
    </body>
</html>