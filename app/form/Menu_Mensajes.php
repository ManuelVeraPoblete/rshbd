<li><a href="Mensajes_Ciudadano.php"  class="btn btn-primary btn-lg  ">Inicio</a></li>
<li class="active"><a href="#Ide_Ciudadano" data-toggle="tab" class="btn btn-primary btn-lg ">Identificacion Ciudadano</a></li>
<?php if (!isset($existe_persona)) { ?>
	<li><a href="#Ide_Mensaje" data-toggle="tab" class="btn btn-primary btn-lg disabled ">Mensaje Ciudadano</a></li>
<?php 
} else {?>
	<li><a href="#Ide_Mensaje" data-toggle="tab" class="btn btn-primary btn-lg  ">Mensaje Ciudadano</a></li>
<?php }?>