<li><a href="Est_HojasRuta_Fecha.php"  class="btn btn-primary btn-lg  ">Inicio</a></li>
<?php
if ($Genera == "N") { ?>
	<li class="active"><a href="#Ide_Ciudadano" data-toggle="tab" class="btn btn-primary btn-lg ">Parametros Estadistica Hojas de Ruta</a></li>
	<li><a href="#HojasRuta_Acumuladas" data-toggle="tab" class="btn btn-primary btn-lg disabled ">Hojas de Ruta</a></li> 
	<li><a href="#Atenciones_Sector" data-toggle="tab" class="btn btn-primary btn-lg disabled ">Hojas de Ruta / Sector</a></li>  
	<li><a href="#Atenciones_Mensuales" data-toggle="tab" class="btn btn-primary btn-lg disabled ">Hojas de Ruta / Encuestador</a></li>    
	<li><a href="#Acumulado Atenciones" data-toggle="tab" class="btn btn-primary btn-lg disabled ">Resumen Encuestador</a></li>    
<?php
} else { 
	if ($Genera == "S") { ?>
	   	<li class="active"><a href="#HojasRuta_Acumuladas" data-toggle="tab" class="btn btn-primary btn-lg  ">Hojas de Ruta</a></li> 
		<li><a href="#Atenciones_Sector" data-toggle="tab" class="btn btn-primary btn-lg  ">Hojas de Ruta / Sector</a></li>  
		<li><a href="#Atenciones_Mensuales" data-toggle="tab" class="btn btn-primary btn-lg  ">Hojas de Ruta / Encuestador</a></li> 
		<li><a href="#Acumulado_Atenciones" data-toggle="tab" class="btn btn-primary btn-lg  ">Resumen Encuestador</a></li> 
	<?php }
} ?>