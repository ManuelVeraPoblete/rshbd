<li><a href="Imprime_Hojas_de_Ruta.php"  class="btn btn-primary btn-lg  ">Inicio</a></li>
<?php
if ($Genera == "N") { ?>
	<li class="active"><a href="#Ide_Ciudadano" data-toggle="tab" class="btn btn-primary btn-lg ">Parametros Imprime Hojas de Ruta</a></li>
<?php
} else { 
	if ($Genera == "S") { 

	    if ( $_POST["Movimiento"] == '10') {?> <li class="active"><a href="#Ingreso_Registro" data-toggle="tab" class="btn btn-primary btn-lg ">Ingreso al Registro</a></li> <?php } 
	    if ( $_POST["Movimiento"] == '4') {?> <li class="active"><a href="#Ingreso_Registro" data-toggle="tab" class="btn btn-primary btn-lg ">Cambio de Domicilio</a></li> <?php } 
	    if ( $_POST["Movimiento"] == '14') {?> <li class="active"><a href="#Ingreso_Registro" data-toggle="tab" class="btn btn-primary btn-lg ">Modulo de Vivienda</a></li> <?php } ?>
	<?php }
	
} ?>