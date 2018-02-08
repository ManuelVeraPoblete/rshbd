<?php
    require("../../Clases/ClaseAtencion.php");


    $Requerimiento = $_REQUEST['Requerimiento'];


    $ate                = new Atencion(); 
    $Lista_Requerimiento = $ate->get_atenciones_requerimientos($Requerimiento);


    if(sizeof($Lista_Requerimiento) > 0) {
        echo '<div class="alert alert-warning alert-dismissible" role="alert">
  				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  				<strong>Error!</strong> Numero de Requerimiento ya Existe .... Reingrese
</div>';
    } 
?>
