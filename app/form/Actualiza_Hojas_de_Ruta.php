<?php
	$Numero_Hoja_Grabar 		= 	$_POST["Numero_Hoja_Grabar"]	;
	$Fecha_Entrega 				= 	$_POST["Fecha_Entrega"]			;
	$Fecha_Devolucion 			= 	$_POST["Fecha_Devolucion"]		;
	$Usuario_Asignada 			= 	$_POST["Usuario_Asignada"]		;
	$cabeza = new ActualizaAtencion();
	$cabeza->Actualiza_Hoja_Cebeza(		$Numero_Hoja_Grabar   , 
								   		$Fecha_Entrega        , 
								   		$Fecha_Devolucion     , 
								   		$Usuario_Asignada      	) 	;
 ?>

    <h1> Resultado de Actualizacion </h1>
	<table class="table table table-striped">
        <thead>
            <tr class="filters">
                <th>Rut		  </th>
                <th>Nombre      </th>
                <th>Encuestador       </th>
                <th>Respuesta       </th>
                <th>Observacion            </th>
            </tr>
        </thead>
        <tbody>

<?php
	for ($i=0; $i < sizeof($datos_grabar) ; $i++) 
	{
		echo "<tr>";
		$detalle = new ActualizaAtencion();
		if ( 		 $datos_grabar[$i]["HD_id"] 						== 0 or 
	 		 		 $datos_grabar[$i]["HD_Respuesta_Id"] 				== 0 or 
	 	 	is_null($datos_grabar[$i]["HD_Fecha_Visita"] ) 				 or 
	 	 			 $datos_grabar[$i]["HD_Usuario_Id"] 				== 0 or 
	 	 	is_null($datos_grabar[$i]["HD_Observacion"] ) ) 
		{

			
                            

			echo "<td>".$datos_grabar[$i]["Per_Rut"]."</td>";
			echo "<td>".$datos_grabar[$i]["Per_Nombre"]." ".$datos_grabar[$i]["Per_Apellido"]."</td>";
	 	 	echo "<td></td>";
	 	 	echo "<td></td>";
	 	 	echo "<td></td>"; ?>
	 	 	<td>
	 	 		<button type='button' class="btn btn-info" data-toggle="modal" >
                    <span class="glyphicon glyphicon-remove" ></span> 
            	</button> 
          	</td>
            <?php
		} else 
		{
			$detalle->Actualiza_Hoja_Detalle(   $datos_grabar[$i]["HD_id"] 				,
	 	 			  							$datos_grabar[$i]["HD_Respuesta_Id"] 	,
	 	 			  							$datos_grabar[$i]["HD_Fecha_Visita"] 	,
	 	 		  								$datos_grabar[$i]["HD_Usuario_Id"] 		,
	 	 		  								$datos_grabar[$i]["HD_Observacion"]  	,
	 	 		  								$datos_grabar[$i]["HD_AmPm"]			);

			echo "<td>".$datos_grabar[$i]["Per_Rut"]."</td>";
			echo "<td>".$datos_grabar[$i]["Per_Nombre"]." ".$datos_grabar[$i]["Per_Apellido"]."</td>";
            $usr=new Usuario();
            $u=$usr->get_usuario_por_id($datos_grabar[$i]["HD_Usuario_Id"]);
            ?>
                <td> <?php echo $u[0]["Nombre"].' '.$u[0]["Apellido"];?></td>
            <?php

            $res= new Respuesta();
            $r=$res->get_respuestas_por_id($datos_grabar[$i]["HD_Respuesta_Id"]) ;
            ?>
                <td> <?php echo $r[0]["Respuesta_Corta"];?></td>
            <?php
	 	 	echo "<td>".$datos_grabar[$i]["HD_Observacion"] ."</td>";
	 	 	
	 	 	?>
	 	 		<td>
	 	 			<button type='button' class="btn btn-info" data-toggle="modal" >
                    	<span class="glyphicon glyphicon-ok" ></span> 
            		</button> 
          		</td>
          	<?php
		}
	echo "</tr>";
	}
?>


