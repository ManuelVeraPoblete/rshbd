<?php 
    ini_set("session.cookie_lifetime","3600");
    session_start();
  
        if ( isset($_SESSION["control"]) and $_SESSION["control"]="S"  )
        {
            $nombre              =       $_SESSION["nom"]           ;       
            $apellido            =       $_SESSION["ape"]           ;
            $nivel               =       $_SESSION["niv"]           ;
            $perfil              =       $_SESSION["per"]           ;
            $id_usuario_act      =       $_SESSION["id_usuario"]    ;
            $Modulo_Atencion     =       $_SESSION["Modulo"]        ;
        } else {
            header("Location: ../index.php");
        }
  
?>