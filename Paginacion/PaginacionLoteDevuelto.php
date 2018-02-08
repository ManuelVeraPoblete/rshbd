<?php
require_once("../Clases/ClasePagina.php");
$u=new Paginas();
$cantidad_resultados_por_pagina=15;

    if(isset($_GET["pagina"]))
    {
        if(is_numeric($_GET["pagina"]))
        {
            if($_GET["pagina"]==1){header("Location: Lote_Digitacion.php");
            }else { $pagina=$_GET["pagina"]; }
            }else { header("Location: Lote_Digitacion.php"); 
        }
    }else{$pagina=1;}


    $empezar_desde=($pagina-1 )*$cantidad_resultados_por_pagina;
    $sql1="
        select count(*) as cuantos from lote_cabeza;  ";
    $todos=$u->getDatos($sql1);
    $sql="SELECT  lote_cabeza.id                      , 
                  lote_cabeza.Numero_Lote             , 
                  lote_cabeza.Fecha                   , 
                  lote_cabeza.Usuario_Id              , 
                  usuario.Nombre, usuario.Apellido    ,
                  estado_lote.Estado_Lote             ,
                  lote_cabeza.Fecha_Estado            ,
                  lote_cabeza.Estado_Lote_Id
          FROM lote_cabeza
          INNER JOIN usuario      on usuario.id                   = lote_cabeza.Usuario_Id
          LEFT  JOIN Estado_Lote  on estado_lote.id               = lote_cabeza.Estado_Lote_Id
          LEFT  JOIN lote_detalle on lote_detalle.Lote_Cabeza_Id  = lote_cabeza.id
          WHERE lote_detalle.Estado_Detalle_Id = 3
          GROUP BY lote_cabeza.id
          ORDER BY id DESC
          LIMIT ".$empezar_desde.",".$cantidad_resultados_por_pagina."";
    $datos=$u->getDatos($sql);
    $total_paginas=ceil($todos[0]->cuantos/$cantidad_resultados_por_pagina);
?>