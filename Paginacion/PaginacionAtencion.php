<?php
    require_once("../Clases/ClasePagina.php");
    $Fecha_Desde = "";
    $Fecha_Hasta = "";
    $u=new Paginas();
    $cantidad_resultados_por_pagina=15;
    if(isset($_GET["pagina"]))
    {
        if(is_numeric($_GET["pagina"]))
        {
            if($_GET["pagina"]==1){header("Location: Revisa_Atencion.php");
            }else { $pagina=$_GET["pagina"]; }
            }else { header("Location: Revisa_Atencion.php"); 
        }
    }else{$pagina=1;}
    $empezar_Desde=($pagina-1 )*$cantidad_resultados_por_pagina;
    if (isset($_POST["Fecha_Desde"]) and isset($_POST["Fecha_Hasta"]) )
    {
        $Fecha_Desde = $_POST["Fecha_Desde"];
        $Fecha_Hasta = $_POST["Fecha_Hasta"];
        $sql1="SELECT count(*) as cuantos from atencion 
                inner join ate_consulta on ate_consulta.Atencion_Id =  atencion.id
                WHERE ate_consulta.Estado_Consulta = '7' and atencion.Estado_Atencion = '2' and atencion.Fecha_Atencion BETWEEN '$Fecha_Desde' and '$Fecha_Hasta'";
                   
    } else {
        $sql1="SELECT count(*) as cuantos from atencion  
               inner join ate_consulta on ate_consulta.Atencion_Id =  atencion.id
               WHERE ate_consulta.Estado_Consulta = '7'  and atencion.Estado_Atencion = '2' ";
                   
    }
    $todos=$u->getDatos($sql1);
    $Fecha_Hoy = date("Y-m-d");
    if (isset($_POST["Rut_Ciudadano"]) and $_POST["Rut_Ciudadano"] != ""  ) {
        $Rut_Ciudadano = $_POST["Rut_Ciudadano"];

        $sql="SELECT atencion.*                      ,
                     usuario.Nombre                 AS nom_usr,
                     usuario.Apellido               AS ape_usr,
                     persona.Rut                    AS rut_per,
                     persona.Nombre                 AS nom_per, 
                     persona.Apellido               AS ape_per,
                     consulta.Consulta              AS nom_con,
                     ate_consulta.id                AS ate_id ,
                     ate_consulta.Estado_Consulta   AS est_con ,
                     estado.Estado_Atencion         as est_con_des,
                     atencion.Fecha_Atencion        as fate ,
                     datediff( '$Fecha_Hoy'  , atencion.Fecha_Atencion   )     as Fecha_Dif
             FROM atencion 
             INNER JOIN usuario         on usuario.id                 =  atencion.Usuario_Id
             inner join persona         on persona.id                 =  atencion.Persona_Id
             inner join ate_consulta    on ate_consulta.Atencion_Id   =  atencion.id
             INNER JOIN consulta        ON consulta.id                =  ate_consulta.Consulta_Id
             inner join estado          on estado.id                  =  ate_consulta.Estado_Consulta
             WHERE persona.Rut = '$Rut_Ciudadano' and ate_consulta.Estado_Consulta = '7' and
                   atencion.Estado_Atencion = 2     
             ORDER BY id
             LIMIT ".$empezar_Desde.",".$cantidad_resultados_por_pagina."";
    } else {
        $sql="SELECT atencion.*                                 ,
                     usuario.Nombre                 AS nom_usr  ,
                     usuario.Apellido               AS ape_usr  ,
                     persona.Rut                    AS rut_per  ,
                     persona.Nombre                 AS nom_per  , 
                     persona.Apellido               AS ape_per  ,
                     consulta.Consulta              AS nom_con  ,
                     ate_consulta.id                AS ate_id   ,
                     ate_consulta.Estado_Consulta   AS est_con  ,
                     estado.Estado_Atencion         as est_con_des ,
                     atencion.Fecha_Atencion        as fate,
                     datediff( '$Fecha_Hoy' , atencion.Fecha_Atencion   )     as Fecha_Dif
             FROM atencion 
             INNER JOIN usuario         on usuario.id               = atencion.Usuario_Id
             inner join persona         on persona.id               = atencion.Persona_Id
             inner join ate_consulta    on ate_consulta.Atencion_Id =  atencion.id
             INNER JOIN consulta        ON consulta.id              = ate_consulta.Consulta_Id
             inner join estado          on estado.id                = ate_consulta.Estado_Consulta
             WHERE  ate_consulta.Estado_Consulta = '7' and
                   atencion.Estado_Atencion = 2
             ORDER BY id ASC LIMIT ".$empezar_Desde.",".$cantidad_resultados_por_pagina."";
    }

    $datos=$u->getDatos($sql);
    $total_paginas=ceil($todos[0]->cuantos/$cantidad_resultados_por_pagina);
?>