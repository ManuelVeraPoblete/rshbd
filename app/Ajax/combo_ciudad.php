<?php
	require("../mod_configuracion/configuracion.php")		;
	require("../include/crear_coneccion.php")				;
	$salida="";
	$id_pais=$_POST["elegido"];
	$combog =mysql_query("SELECT unipob.unidad_id, 
		                         unidad.unidad 
		                  from unipob
	   	  				  inner join  unidad on unidad.id = unipob.unidad_id
          				  WHERE unipob.poblacion_id = $id_pais");
  	
  	while($sql_p = mysql_fetch_row($combog))
  	{
		$salida.= "<option value='".$sql_p[0]."'>".$sql_p[1]."</option>";
  	}  
  	
  	echo $salida;
?>