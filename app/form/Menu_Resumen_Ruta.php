<li><a href="Resumen_Hojas_de_Ruta.php"  class="btn btn-primary btn-lg  ">Inicio</a></li>
<?php
if ($Genera == "N") { ?>
	<li class="active"><a href="#Ide_Ciudadano" data-toggle="tab" class="btn btn-primary btn-lg ">Parametros Imprime Hojas de Ruta</a></li>
<?php
} else { 
	if ($Genera == "S") { ?>
	    <li class="active"><a href="#Ingreso_Registro" data-toggle="tab" class="btn btn-primary btn-lg ">Resumen Hojas de Ruta</a></li> 
	   
	<?php }
	
} ?>