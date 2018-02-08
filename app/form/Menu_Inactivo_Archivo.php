<?php 
	if ($Indentificador_Lote > 0 ) { ?>
		<li>				<a href="Completa_Informacion.php"  					class="btn btn-primary btn-lg "> Inicio 				 	  </a></li>
		<li class="active">	<a href="#Ide_Requerimiento"		data-toggle="tab" 	class="btn btn-primary btn-lg "> Identificacion Requerimiento </a></li>
		<li>				<a href="#Ide_Atencion" 			data-toggle="tab" 	class="btn btn-primary btn-lg "> Detalle Requerimiento        </a></li>
		<li>				<a href="#Ide_Atencion" 			data-toggle="tab" 	class="btn btn-primary btn-lg "> Identificacion Ciudadanio    </a></li>
		<li>				<a href="#Ide_Motivo" 				data-toggle="tab" 	class="btn btn-primary btn-lg "> Identificacion Requerimiento </a></li>
		<li>				<a href="#Obs_Cierre" 				data-toggle="tab" 	class="btn btn-primary btn-lg "> Observaciones y Cierre   	  </a></li>
<?php
} else { ?>
		<li>				<a href="Completa_Informacion.php"  					class="btn btn-primary btn-lg ">		 Inicio 				 	  </a></li>
		<li class="active">	<a href="#Ide_Ciudadano"			data-toggle="tab" 	class="btn btn-primary btn-lg ">		 Identificacion Requerimiento </a></li>
		<li>				<a href="#Ide_Atencion" 			data-toggle="tab" 	class="btn btn-primary btn-lg disabled"> Detalle Requerimiento        </a></li>
		<li>				<a href="#Ide_Atencion" 			data-toggle="tab" 	class="btn btn-primary btn-lg disabled"> Identificacion Ciudadanio    </a></li>
		<li>				<a href="#Ide_Motivo" 				data-toggle="tab" 	class="btn btn-primary btn-lg disabled"> Identificacion Requerimiento </a></li>
		<li>				<a href="#Obs_Cierre" 				data-toggle="tab" 	class="btn btn-primary btn-lg disabled"> Observaciones y Cierre   	  </a></li>
<?php } ?>