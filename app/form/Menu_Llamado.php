<li><a href="Llamados_Telefonicos.php"  class="btn btn-primary btn-lg  ">Inicio</a></li>
<li class="active"><a href="#Ide_Ciudadano" data-toggle="tab" class="btn btn-primary btn-lg ">Identificacion Ciudadano</a></li>
<?php if (!isset($existe_persona)) { ?>
	<li><a href="#Ide_Respuesta" data-toggle="tab" class="btn btn-primary btn-lg disabled ">Respuesta Llamado</a></li>
<?php 
} else {?>
	<li><a href="#Ide_Respuesta" data-toggle="tab" class="btn btn-primary btn-lg  ">Respuesta Llamado</a></li>
<?php }?>