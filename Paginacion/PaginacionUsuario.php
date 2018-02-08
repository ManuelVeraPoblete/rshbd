<?php
    require_once("../Clases/ClasePagina.php");
    $u=new Paginas();
    $cantidad_resultados_por_pagina=15;
    if(isset($_GET["pagina"]))
    {
        if(is_numeric($_GET["pagina"]))
        {
            if($_GET["pagina"]==1)
            {
                header("Location: Usuario.php");
            }else{ 
                $pagina=$_GET["pagina"]; 
              }
        }
        else { header("Location: Usuario.php"); 
        }
    }else{$pagina=1;}
    $empezar_desde=($pagina-1 )*$cantidad_resultados_por_pagina;
    if (isset($_POST["Nomber_Buscar"]))
    {
        $nombre = $_POST["Nombre_Buscar"];
        $sql1="SELECT count(*) as cuantos from usuario WHERE Nombre LIKE '%$nombre%' or Apellido LIKE '%$nombre%' ;";
    } else {
       if (isset($Per_Id)){
          if ($Per_Id  == 1 ) {
              $sql1="SELECT  count(*) as cuantos from usuario;";
          } else {
            if (isset($Niv_Id) == 1 ) {
                $sql1="SELECT  count(*) as cuantos from usuario
                       WHERE usuario.Perfil_Id = ".$Per_Id.";";
            } else {
                $sql1="SELECT  count(*) as cuantos from usuario
                       WHERE usuario.id = ".$Usuario_Id.";";
            }
          }
      }else {
        $sql1="SELECT  count(*) as cuantos from usuario;";
      }
    }
    $todos=$u->getDatos($sql1);
    if(isset($_POST["Nombre_Buscar"])) {
        $nombre = $_POST["Nombre_Buscar"];
        $sql="SELECT usuario.* , perfil.Perfil AS nom_per , nivel.Nivel AS nom_niv
              from usuario
              INNER JOIN perfil on perfil.id = usuario.Perfil_Id
              INNER JOIN nivel  on nivel.id = usuario.Nivel_Id
              WHERE usuario.Estado = 1 and ( Nombre LIKE '%$nombre%' or Apellido LIKE '%$nombre%' ) ORDER BY Nombre
              LIMIT ".$empezar_desde.",".$cantidad_resultados_por_pagina."";
    } else {
        if (isset($Per_Id)) {
          if ( $Per_Id == 1 ) 
          {
            $sql="SELECT usuario.* , perfil.Perfil AS nom_per , nivel.Nivel AS nom_niv
              from usuario
              INNER JOIN perfil on perfil.id = usuario.Perfil_Id
              INNER JOIN nivel  on nivel.id = usuario.Nivel_Id
              where usuario.Estado = 1
              ORDER BY Nombre ASC 
              LIMIT ".$empezar_desde.",".$cantidad_resultados_por_pagina."";
          } else {
            if (isset($Niv_Id) == 1) {
                $sql="SELECT usuario.* , perfil.Perfil AS nom_per , nivel.Nivel AS nom_niv
                from usuario
                INNER JOIN perfil on perfil.id = usuario.Perfil_Id
                INNER JOIN nivel  on nivel.id = usuario.Nivel_Id
                WHERE  usuario.Estado = 1 and usuario.Perfil_Id = ".$Per_Id." ORDER BY Nombre ASC 
                LIMIT ".$empezar_desde.",".$cantidad_resultados_por_pagina."";
            } else {
                $sql="SELECT usuario.* , perfil.Perfil AS nom_per , nivel.Nivel AS nom_niv
                from usuario
                INNER JOIN perfil on perfil.id = usuario.Perfil_Id
                INNER JOIN nivel  on nivel.id = usuario.Nivel_Id
                WHERE  usuario.Estado = 1 and usuario.id = ".$Usuario_Id." ORDER BY Nombre ASC 
                LIMIT ".$empezar_desde.",".$cantidad_resultados_por_pagina."";
            }

          }
        } else {
          $sql="SELECT usuario.* , perfil.Perfil AS nom_per , nivel.Nivel AS nom_niv
                from usuario
                INNER JOIN perfil on perfil.id = usuario.Perfil_Id
                INNER JOIN nivel  on nivel.id = usuario.Nivel_Id
                where usuario.Estado = 1
                ORDER BY Nombre ASC 
                LIMIT ".$empezar_desde.",".$cantidad_resultados_por_pagina."";
              }
    }
    $datos=$u->getDatos($sql);
    $total_paginas=ceil($todos[0]->cuantos/$cantidad_resultados_por_pagina);
?>