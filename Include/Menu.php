<?php 
if ( $_SESSION["per_id"]  == '3') {
    require_once("../Include/Menu_Perfil_3.php");     
}else {
    require_once("../Include/Menu_Perfil_1.php");     
}
?>