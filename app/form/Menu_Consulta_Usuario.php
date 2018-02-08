<li><a href="Consu_Usuarios.php"  class="btn btn-primary btn-lg  ">Inicio</a></li>
<?php
if ($Genera == "N") { ?>
	<li class="active"><a href="#Ide_Ciudadano" data-toggle="tab" class="btn btn-primary btn-lg ">Parametros Consulta</a></li>
<?php
} else { 
	if ($Genera == "S") { ?>
		<li class="active"><a href="#Atenciones_Acumuladas" data-toggle="tab" class="btn btn-primary btn-lg "> Atenciones Acumulados  </a> </li> 
	   	<li> <a href="#Atenciones_Sector" 					data-toggle="tab" class="btn btn-primary btn-lg "> Atenciones Sector 	  </a> </li>  
		<li> <a href="#Atenciones_Mensuales"                data-toggle="tab" class="btn btn-primary btn-lg "> Atenciones Mensuales   </a> </li>  
		<li> <a href="#Llamados_Telefonicos"                data-toggle="tab" class="btn btn-primary btn-lg "> Llamados Telefonicos   </a> </li>  
		<li> <a href="#Encuestas"                           data-toggle="tab" class="btn btn-primary btn-lg "> Encuestas 			  </a> </li>  
		<li> <a href="#ApruebaRechazo"                      data-toggle="tab" class="btn btn-primary btn-lg "> Aprobación Rechazo 	  </a> </li>  
	<?php }
} ?>