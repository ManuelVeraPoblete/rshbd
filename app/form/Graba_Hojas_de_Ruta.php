<?php
    $Movimiento         = $_POST["Movimiento"];
    $Fecha_Desde        = $_POST["Fecha_Desde"];
    $ate                = new Atencion(); 
    $Ultimo_Numero_Hoja = $ate->get_ultima_hoja();
    $Numero_Hoja = 0;
    $Numero_Hoja = $Ultimo_Numero_Hoja[0]["Numero_Final"] ;
    $id_encabezado = 0;
    $hojas = new Atencion();
    $contador = 0;
    $Numero_Hoja_Paso = 0;
    $Sector_Paso      = ' ';
    $Numero_Hoja_Inicio = 0;
    $Numero_Hoja_Inicio = $Numero_Hoja + 1;
    $datos_hojas=$hojas->get_genera_hoja( $Movimiento, $Fecha_Desde );
    for($i=0;$i<sizeof($datos_hojas);$i++)
    { 
        $contador++; 
        if ($datos_hojas[$i]["Sector"] <> $Sector_Paso  or 
            $contador > 15 ) {
            $Sector_Paso = $datos_hojas[$i]["Sector"];
            $sector_id = $datos_hojas[$i]["sector_id"];
            $Numero_Hoja++;
            $Numero_Hoja_Paso = $Numero_Hoja;
            $contador = 1;
        }
        if ($contador == 1 ) { 
            /* grabar encabezadop Hoja */
            $cabeza = new ActualizaAtencion();
            $id_encabezado = $cabeza->Genera_Encabezado_Hoja_Ruta($Numero_Hoja, $sector_id , $Movimiento);
            
        } 
        $detalle = new ActualizaAtencion();
        $Persona_Id = $datos_hojas[$i]["Persona_id"] ;
        $atencion_id = $datos_hojas[$i]["atencion_id"]  ;
        $detalle->Genera_Detalle_Hoja_Ruta( $id_encabezado, $contador, $Persona_Id, $atencion_id    ) ;

        $cambia_ate = new ActualizaAtencion();
        $cambia_ate->Marcar_Atencion($atencion_id);
    }

    $ultima = new ActualizaAtencion();
    $ultima->Graba_Ultima_Hoja($Movimiento , $Numero_Hoja_Inicio , $Numero_Hoja)

?>
<center> <h1> Proceso Exitoso </h1> </center>