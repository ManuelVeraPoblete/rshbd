<li><a href="Resumen_Diario_Atenciones.php"  class="btn btn-primary btn-lg  ">Inicio</a></li>
<?php
if ($Genera == "N") { ?>
	<li class="active"><a href="#Atenciones" data-toggle="tab" class="btn btn-primary btn-lg ">Parametros Atencion Diaria</a></li>
<?php
} else { 
	if ($Genera == "S") { ?>
	    <li class="active"><a href="#Atenciones" data-toggle="tab" class="btn btn-primary btn-lg ">Atenciones Abiertas</a></li> 
	    <li><a href="#Atenciones_Cerradas" data-toggle="tab" class="btn btn-primary btn-lg ">Atenciones Cerradas</a></li>    
	<?php }
} ?>