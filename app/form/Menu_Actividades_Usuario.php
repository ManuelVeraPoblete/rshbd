<li><a href="Actividades_Usuario.php"  class="btn btn-primary btn-lg  ">Inicio</a></li>
<?php
if ($Genera == "N") { ?>
	<li class="active"><a href="#Ide_Ciudadano" data-toggle="tab" class="btn btn-primary btn-lg ">Parametros Estadistica Atencion 	</a></li>
	<li><a href="#Atenciones_Abiertas" data-toggle="tab" class="btn btn-primary btn-lg  disabled ">Atenciones 						</a></li> 
	<li><a href="#Resumen_Abiertas" data-toggle="tab" class="btn btn-primary btn-lg  disabled ">Resumen Atenciones 					</a></li> 
	<li><a href="#Atenciones_Telefonicas" data-toggle="tab" class="btn btn-primary btn-lg disabled ">Llamados Telefonicos 			</a></li>   
	<li><a href="#Resumen_Encuestas" data-toggle="tab" class="btn btn-primary btn-lg disabled ">Encuestas 							</a></li>   
	<li><a href="#Actividades_Diarias" data-toggle="tab" class="btn btn-primary btn-lg  disabled ">Actividades Diarias 			    </a></li>   
<?php
} else { 
	if ($Genera == "S") { ?>
	   <li><a href="#Atenciones_Abiertas" data-toggle="tab" class="btn btn-primary btn-lg">Atenciones 								</a></li> 
	   <li><a href="#Resumen_Atenciones" data-toggle="tab" class="btn btn-primary btn-lg">Resumen Atenciones 						</a></li> 
	   <li><a href="#Llamados_Telefonicos" data-toggle="tab" class="btn btn-primary btn-lg">Llamados Telefonicos 					</a></li>   
	   <li><a href="#Resumen_Encuestas" data-toggle="tab" class="btn btn-primary btn-lg">Encuestas 									</a></li>   
	   <li><a href="#Actividades_Diarias" data-toggle="tab" class="btn btn-primary btn-lg">Actividades Diarias 						</a></li>   
	<?php }
} ?>