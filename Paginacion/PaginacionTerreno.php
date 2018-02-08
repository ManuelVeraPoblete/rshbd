<?php
require_once("../Clases/ClasePagina.php");
$u=new Paginas();
$busqueda = "";
$cantidad_resultados_por_pagina=15;
if(isset($_GET["pagina"]))
{
    if(is_numeric($_GET["pagina"]))
    {
        if($_GET["pagina"]==1){header("Location: Actividad_Terreno.php");
        }else { $pagina=$_GET["pagina"]; }
        }else { header("Location: Actividad_Terreno.php"); 
    }
}else{$pagina=1;}
$empezar_desde=($pagina-1 )*$cantidad_resultados_por_pagina;
$Fecha_Actual =  date("Y-m-d");
$sql1="SELECT count(*) as cuantos from terreno WHERE terreno.Fecha_Operativo >=  '$Fecha_Actual' ";
$todos=$u->getDatos($sql1);
$sql="SELECT  terreno.* , operativo.Operativo , usuario.Nombre, usuario.Apellido FROM terreno 
      inner join operativo on operativo.id = terreno.Operativo_Id
      inner join usuario on usuario.id = terreno.Responsable_Id
      WHERE terreno.Fecha_Operativo >= '$Fecha_Actual'
      ORDER BY terreno.Fecha_Operativo ASC
      LIMIT ".$empezar_desde.",".$cantidad_resultados_por_pagina."";
$datos=$u->getDatos($sql);
$total_paginas=ceil($todos[0]->cuantos/$cantidad_resultados_por_pagina);
?>