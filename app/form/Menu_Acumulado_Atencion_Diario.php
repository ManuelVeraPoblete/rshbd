<li><a href="Acumulado_Atenciones.php"  class="btn btn-primary btn-lg  ">Inicio</a></li>
<?php
if ($Genera == "N") { ?>
	<li class="active"><a href="#Ide_Ciudadano" data-toggle="tab" class="btn btn-primary btn-lg ">Parametros Atencion Diaria</a></li>
<?php
} else { 
	if ($Genera == "S") { ?>
	    <li class="active"><a href="#Atenciones" data-toggle="tab" class="btn btn-primary btn-lg ">Atenciones el día <?php echo $_POST["Fecha_Desde"] ;?></a></li> 
	    <li><a href="#Acumulado" data-toggle="tab" class="btn btn-primary btn-lg ">Acumulado el Día <?php echo $_POST["Fecha_Desde"] ;?> </a></li>   
	    <li><a href="#Acumulado_Total" data-toggle="tab" class="btn btn-primary btn-lg ">Acumulado Total al <?php echo $_POST["Fecha_Desde"] ;?></a></li>     
	<?php }
} ?>