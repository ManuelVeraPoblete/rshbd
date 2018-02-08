<li><a href="Est_Atenciones_Fecha.php"  class="btn btn-primary btn-lg  ">Inicio</a></li>
<?php
if ($Genera == "N") { ?>
	<li class="active"><a href="#Ide_Ciudadano" data-toggle="tab" class="btn btn-primary btn-lg ">Parametros Estadistica Atencion</a></li>
	<li><a href="#Atenciones_Acumuladas" data-toggle="tab" class="btn btn-primary btn-lg  disabled ">Atenciones Acumulados</a></li> 
	<li><a href="#Atenciones_Sector" data-toggle="tab" class="btn btn-primary btn-lg disabled ">Atenciones Sector</a></li>  
	<li><a href="#Llamados_Telefonicos" data-toggle="tab" class="btn btn-primary btn-lg disabled ">  Llamados Telefonicos  </a></li>   
	<li><a href="#Actividades_Diarias" data-toggle="tab" class="btn btn-primary btn-lg disabled ">  Actividades Diarias  </a></li>   
	<li><a href="#Actividades_Acumuladas" data-toggle="tab" class="btn btn-primary btn-lg disabled ">  Acumulado Actividades  </a></li>   
<?php
} else { 
	if ($Genera == "S") { ?>
		<li><a href="#Atenciones_Acumuladas" data-toggle="tab" class="btn btn-primary btn-lg "> Atenciones Acumulados </a></li> 
		<li><a href="#Atenciones_Sector" data-toggle="tab" class="btn btn-primary btn-lg ">     Atenciones Sector     </a></li>  
		<li><a href="#Atenciones_Mensuales" data-toggle="tab" class="btn btn-primary btn-lg ">  Atenciones Anuales    </a></li>   
    	<li><a href="#Llamados_Telefonicos" data-toggle="tab" class="btn btn-primary btn-lg ">  Llamados Telefonicos  </a></li>   
    	<li><a href="#Actividades_Diarias" data-toggle="tab" class="btn btn-primary btn-lg ">  Actividades Diarias  </a></li>   
    	<li><a href="#Actividades_Acumuladas" data-toggle="tab" class="btn btn-primary btn-lg  ">  Acumulado Actividades  </a></li>   
	<?php }
} ?>