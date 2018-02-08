<li><a href="Genera_Hojas_de_Ruta.php"  class="btn btn-primary btn-lg  ">Inicio</a></li>
<?php
if ($Genera == "N") { ?>
	<li class="active"><a href="#Ide_Ciudadano" data-toggle="tab" class="btn btn-primary btn-lg ">Parametros Hojas de Ruta</a></li>
<?php
} else { 
	if ($Genera == "S") { 

	    if ( $_POST["Movimiento"] == '7') {?> <li class="active"><a href="#Ingreso_Registro" data-toggle="tab" class="btn btn-primary btn-lg ">Ingreso al Registro</a></li> <?php } 
	    if ( $_POST["Movimiento"] == '5') {?> <li class="active"><a href="#Ingreso_Registro" data-toggle="tab" class="btn btn-primary btn-lg ">Cambio de Domicilio</a></li> <?php } 
	    if ( $_POST["Movimiento"] == '6') {?> <li class="active"><a href="#Ingreso_Registro" data-toggle="tab" class="btn btn-primary btn-lg ">Modulo de Vivienda</a></li> <?php } ?>
	<?php }
	
} ?>