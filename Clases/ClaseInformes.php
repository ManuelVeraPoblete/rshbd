<?php
require_once("ClaseConeccion.php");
class Informes extends  Coneccion
{
    private $dbh           ;
    private $imp_informe   ;

  
      public function __construct()
    {
        $this->dbh=parent::conecta();
        $this->imp_informe  =   array();

    }
    private function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");    
    }


    public function Get_Hojas_de_Ruta($Fecha_Generada , $Moviemiento)
    {
        if(isset($Fecha_Generada))
        {
            self::set_names();
            $sql="SELECT hoja_cabeza.id                             AS HC_id                  ,
                         hoja_cabeza.Numero_Hoja                    AS HC_Numero_Hoja         ,
                         hoja_cabeza.Sector_Id                      AS HC_Sector_Id           ,
                         hoja_cabeza.Fecha_Entrega                  AS HC_Fecha_Entrega       ,
                         hoja_cabeza.Fecha_Devolucion               AS HC_Fecha_Devolucion    ,
                         hoja_cabeza.Fecha_Generada                 AS HC_Fecha_Generada      ,
                         hoja_cabeza.Usuario_Asignada               AS HC_Usuario_Asignada    ,
                         hoja_cabeza.Consulta_Id                    AS HC_Consulta_Id         ,
                         hoja_detalle.id                            AS HD_id                  ,
                         hoja_detalle.Hoja_Cabeza_Id                AS HD_Hoja_Cabeza_Id      ,
                         hoja_detalle.Item                          AS HD_Item                ,
                         hoja_detalle.Persona_Id                    AS HD_Persona_Id          ,
                         respuestas.Respuesta_Corta                 AS RE_Respuesta_Corta     ,
                         hoja_detalle.Respuesta_Id                  AS HD_Respuesta_Id        ,
                         hoja_detalle.Fecha_Visita                  AS HD_Fecha_Visita        ,
                         hoja_detalle.Usuario_Id                    AS HD_Usuario_Id          ,
                         usuario.Nombre                             AS US_Nombre              ,
                         usuario.Apellido                           AS US_Apellido            ,
                         hoja_detalle.Observacion                   AS HD_Observacion         ,
                         hoja_detalle.Atencion_Id                   AS HD_Atencion_Id         ,
                         persona.id                                 AS PE_id                  ,
                         persona.Rut                                AS PE_Rut                 ,
                         SUBSTRING_INDEX(persona.nombre, ' ', 1 )   AS PE_Nombre              ,
                         SUBSTRING_INDEX(persona.apellido, ' ', 1 ) AS PE_Apellido            ,
                         persona.Telefono                           AS PE_Telefono            ,
                         direccion.id                               AS DI_id                  ,
                         direccion.Unidad_Id                        AS DI_Unidad_Id           ,
                         unidad.Unidad                              AS UN_Unidad              ,
                         unidad.Sector_Id                           AS UN_Sector_Id           ,
                         sector.Sector                              AS SE_Sector              ,
                         direccion.Poblacion_Id                     AS DI_Poblacion_Id        ,
                         poblacion.Poblacion                        AS PO_Poblacion           ,
                         direccion.Calle_Id                         AS DI_Calle_Id            ,
                         calle.Calle                                AS CA_Calle               ,
                         direccion.Numero                           AS DI_Numero              ,
                         direccion.Block                            AS DI_Block               ,
                         direccion.Departamento                     AS DI_Departamento        ,
                         direccion.Casa                             AS DI_Casa                ,
                         direccion.Observacion                      AS DI_Observacion         
                  FROM      hoja_cabeza
                  INNER JOIN hoja_detalle       on hoja_detalle.Hoja_Cabeza_Id  = hoja_cabeza.id
                  INNER JOIN persona            on persona.id                   = hoja_detalle.Persona_Id
                  INNER JOIN direccion          on direccion.Persona_Id         = persona.id
                  INNER JOIN unidad             on unidad.id                    = direccion.Unidad_Id
                  INNER JOIN sector             on sector.id                    = unidad.Sector_Id
                  INNER JOIN calle              on calle.id                     = direccion.Calle_Id
                  INNER JOIN poblacion          on poblacion.id                 = direccion.Poblacion_Id
                  LEFT  JOIN respuestas         on respuestas.id                = hoja_detalle.Respuesta_Id
                  LEFT  JOIN usuario            on usuario.id                   = hoja_detalle.Usuario_Id
                  WHERE hoja_cabeza.Fecha_Generada  = ? AND 
                        hoja_cabeza.Consulta_Id     = ?";

            $stmt=$this->dbh->prepare($sql);
            $stmt->bindValue(1,$Fecha_Generada         ,   PDO::PARAM_STR);
            $stmt->bindValue(2,$Moviemiento            ,   PDO::PARAM_STR);
           
     
           if($stmt->execute())

            {
                while($row = $stmt->fetch())
                {
                    $this->imp_informe[]=$row;
                }
                return $this->imp_informe;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }

    public function Get_Hojas_de_Ruta_Resumen($Fecha_Desde , $Fecha_Hasta)
    {
        self::set_names();
        $sql="SELECT hoja_historico.Usuario_Id as HH_Usuario_Id,  
                     usuario.Nombre            as USR_Nombre,
                     usuario.Apellido          as USR_Apellido, 
                     SUM(CASE WHEN hoja_historico.Respuesta_id = 1   then 1 else 0 end ) as  'A2',
                     SUM(CASE WHEN hoja_historico.Respuesta_id = 2   then 1 else 0 end ) as  'E',
                     SUM(CASE WHEN hoja_historico.Respuesta_id = 3   then 1 else 0 end ) as  'NO',
                     SUM(CASE WHEN hoja_historico.Respuesta_id = 4   then 1 else 0 end ) as  'NOT',
                     SUM(CASE WHEN hoja_historico.Respuesta_id = 5   then 1 else 0 end ) as  'NV',
                     SUM(CASE WHEN hoja_historico.Respuesta_id = 6   then 1 else 0 end ) as  'P1',
                     SUM(CASE WHEN hoja_historico.Respuesta_id = 7   then 1 else 0 end ) as  'P2',
                     SUM(CASE WHEN hoja_historico.Respuesta_id = 8   then 1 else 0 end ) as  'P3',
                     SUM(CASE WHEN hoja_historico.Respuesta_id = 9   then 1 else 0 end ) as  'P4',
                     SUM(CASE WHEN hoja_historico.Respuesta_id = 10  then 1 else 0 end ) as  'P5',
                     SUM(CASE WHEN hoja_historico.Respuesta_id = 11  then 1 else 0 end ) as  'P6',
                     SUM(CASE WHEN hoja_historico.Respuesta_id = 12  then 1 else 0 end ) as  'P7',
                     SUM(CASE WHEN hoja_historico.Respuesta_id = 13  then 1 else 0 end ) as  'P8',
                     SUM(CASE WHEN hoja_historico.Respuesta_id = 14  then 1 else 0 end ) as  'R2',
                     SUM(CASE WHEN hoja_historico.Respuesta_id = 15  then 1 else 0 end ) as  'X',
                      SUM(1) AS Tot_Linea
              from hoja_historico
              INNER JOIN usuario on usuario.id =  hoja_historico.Usuario_Id
              where    hoja_historico.Fecha_Visita BETWEEN ? and ?
              group by hoja_historico.Usuario_Id
              ORDER BY hoja_historico.Usuario_Id";
            $stmt=$this->dbh->prepare($sql);
            $stmt->bindValue(1,$Fecha_Desde         ,   PDO::PARAM_STR);
            $stmt->bindValue(2,$Fecha_Hasta             ,   PDO::PARAM_STR);
           if($stmt->execute())

            {
                while($row = $stmt->fetch())
                {
                    $this->imp_informe[]=$row;
                }
                return $this->imp_informe;
                $this->dbh=null;
            }
    }
    public function Get_Cantidad_de_Personas($Fecha_Desde , $Fecha_Hasta , $Usuario)
    {
        self::set_names();
        $sql="SELECT  hoja_historico.Usuario_Id      as CP_Usuario_Id,
                      COUNT(hoja_detalle.persona_id) as CP_Cantidad
              FROM  hoja_historico
              INNER JOIN hoja_detalle ON hoja_detalle.id = hoja_historico.Hoja_Detalle_Id
              INNER JOIN hoja_cabeza  on hoja_cabeza.id  = hoja_detalle.Hoja_Cabeza_Id
              where hoja_historico.Fecha_Visita BETWEEN ? and ? and 
                    hoja_historico.Usuario_Id = ?
              GROUP BY   hoja_historico.Usuario_Id,hoja_detalle.Persona_Id";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Fecha_Desde       ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Fecha_Hasta       ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$Usuario           ,   PDO::PARAM_STR);
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }

    public function Get_Cantidad_de_Personas_Atendidas($Mes)
    {
        self::set_names();
        $sql="SELECT MONTH(atencion.Fecha_Atencion) , 
                     count(atencion.id) from atencion
              where  MONTH(atencion.Fecha_Atencion) = ? ";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Fecha_Desde       ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Fecha_Hasta       ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$Usuario           ,   PDO::PARAM_STR);
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }



    public function Get_Atenciones_Diarias($Fecha_Desde , $Fecha_Hasta , $Usuario)
    {
        self::set_names();
        $sql="SELECT    atencion.id               as AT_id                  ,
                        atencion.Usuario_Id       as AT_Usuario_Id          ,
                        atencion.Persona_Id       as AT_Persona_Id          ,
                        persona.Rut               as PE_Rut                 ,
                        persona.Nombre            as PE_Nombre              ,
                        persona.Apellido          as PE_Apellido            ,
                        atencion.Fecha_Atencion   as AT_Fecha_Atencion      ,
                        atencion.Hora_Atencion    as AT_Hora_Atencion       ,
                        atencion.Observacion      as AT_Observacion         ,
                        atencion.Folio_Rsh        as AT_Folio_Rsh           ,
                        atencion.Numero_Solicitud as AT_Numero_Solicitud    ,
                        atencion.Estado_Atencion  as AT_Estado_Atencion     ,
                        atencion.Fecha_Cita       as AT_Fecha_Cita          ,
                        atencion.Usuario_Cierra   as AT_Usuario_Cierra      ,
                        atencion.Fecha_Cierra     as AT_Fecha_Cierra        ,
                        atencion.Generada         as AT_Generada            
              FROM atencion
              INNER JOIN persona      on persona.id                 =   atencion.Persona_Id
              WHERE atencion.Fecha_Atencion BETWEEN ? and ? AND   
                    atencion.Usuario_Id = ? ";

        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Fecha_Desde       ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Fecha_Hasta       ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$Usuario           ,   PDO::PARAM_STR);
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }

    

    public function Get_Atenciones_Acumuladas()
    {
        self::set_names();
        $sql="SELECT requerimientos.Requerimiento                                       as Requerimiento , 
                     consulta.Consulta                                                  as Consulta ,
                     consulta.id                                                        as Consulta_Id , 
                     SUM(CASE when ate_consulta.Estado_Consulta = 7 then 1 else 0 end) as Pendientes,
                     SUM(CASE when ate_consulta.Estado_Consulta =  6 then 1 else 0 end) as Aprovadas,
                     SUM(CASE when ate_consulta.Estado_Consulta =  4 then 1 else 0 end) as Anuladas
                FROM atencion
                inner JOIN ate_consulta     ON ate_consulta.Atencion_Id = atencion.id
                inner join consulta         on consulta.id = ate_consulta.Consulta_Id
                inner join requerimientos   on requerimientos.id = consulta.Requerimiento_Id
                GROUP BY requerimientos.Requerimiento, consulta.Consulta";

        $stmt=$this->dbh->prepare($sql);
        
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Hojas_Ruta_Encuestador_Acumuladas()
    {
        self::set_names();
        $sql="SELECT  usuario.id        as Usuario_Id ,
                      usuario.Nombre    as Nombre , 
                      usuario.Apellido  as Apellido ,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 1   then 1 else 0 end ) as  A2,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 2   then 1 else 0 end ) as  E,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 3   then 1 else 0 end ) as  ERROR,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 4   then 1 else 0 end ) as  NOENC,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 5   then 1 else 0 end ) as  NV,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 6   then 1 else 0 end ) as  P1,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 7   then 1 else 0 end ) as  P2,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 8   then 1 else 0 end ) as  P3,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 9   then 1 else 0 end ) as  P4,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 10  then 1 else 0 end ) as  P5,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 11  then 1 else 0 end ) as  P6,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 12  then 1 else 0 end ) as  P7,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 13  then 1 else 0 end ) as  P8,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 14  then 1 else 0 end ) as  R2,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 15  then 1 else 0 end ) as  ANUL,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 15  then 1 else 0 end ) as  DES
              FROM hoja_historico
              INNER JOIN usuario on usuario.id = hoja_historico.Usuario_Id
              INNER JOIN respuestas on respuestas.id = hoja_historico.Respuesta_Id
              GROUP BY usuario.id
              ORDER BY usuario.id";

        $stmt=$this->dbh->prepare($sql);
        
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Hojas_Ruta_Acumuladas()
    {
        self::set_names();
        $sql="SELECT     consulta.id as Consulta_Id , consulta.Consulta as Consulta , count(hoja_cabeza.id) as Cantidad 
              from hoja_cabeza
              inner join consulta on consulta.id = hoja_cabeza.Consulta_Id
              GROUP BY consulta.Consulta";

        $stmt=$this->dbh->prepare($sql);
        
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Hojas_Ruta_Acumuladas_Persona($Consulta_Id)
    {
        self::set_names();
        $sql="SELECT  hoja_cabeza.Consulta_Id , count(hoja_detalle.Persona_Id)
              from hoja_cabeza
              inner join hoja_detalle on hoja_cabeza.id = hoja_detalle.Hoja_Cabeza_Id
              WHERE hoja_cabeza.Consulta_Id = ?
              group by hoja_cabeza.Consulta_Id, hoja_detalle.Persona_Id";

        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Consulta_Id       ,   PDO::PARAM_STR);
        
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }

    public function Get_Personas_Hojas_Ruta_Acumuladas($Usuario_Id)
    {
        self::set_names();
        $sql="SELECT  hoja_detalle.Usuario_Id          , 
                      count(hoja_detalle.Persona_Id) AS Persona_Hoja_Ruta
              FROM    hoja_detalle
              WHERE   hoja_detalle.Usuario_Id = ?
              GROUP BY hoja_detalle.Usuario_Id";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Usuario_Id   ,   PDO::PARAM_STR);
        
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }


    public function Get_Hojas_Ruta_Detalle_Acumuladas()
    {
        self::set_names();
        $sql="SELECT  consulta.id as Consulta_Id ,
                      consulta.Consulta  as Consulta , 
                      SUM(CASE when hoja_detalle.Respuesta_Id =  2 then 1 else 0 end) as Encuestadas ,
                      SUM(CASE when hoja_detalle.Respuesta_Id <> 2 then 1 else 0 end) as Pendientes  
              from       hoja_detalle
              inner join hoja_cabeza on hoja_cabeza.id  = hoja_detalle.Hoja_Cabeza_Id
              inner join consulta    on consulta.id     = hoja_cabeza.Consulta_Id
              GROUP BY consulta.Consulta";

        $stmt=$this->dbh->prepare($sql);
        
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Hojas_Ruta_Detalle_Acumuladas_Personas()
    {
        self::set_names();
        $sql="SELECT  consulta.id as Consulta_Id , consulta.Consulta  as Consulta , 
                      SUM(CASE when hoja_detalle.Respuesta_Id =  2 then 1 else 0 end) as Encuestadas ,
                      SUM(CASE when hoja_detalle.Respuesta_Id <> 2 then 1 else 0 end) as Pendientes  
              from       hoja_detalle
              inner join hoja_cabeza on hoja_cabeza.id  = hoja_detalle.Hoja_Cabeza_Id
              inner join consulta    on consulta.id     = hoja_cabeza.Consulta_Id
              GROUP BY consulta.Consulta";

        $stmt=$this->dbh->prepare($sql);
        
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Hoja_Detalle_Sector()
    {
        self::set_names();
        $sql="SELECT  sector.Sector as Sector ,
                      consulta.Consulta  as Consulta , 
                      SUM(CASE when hoja_detalle.Respuesta_Id =  2 then 1 else 0 end) as Encuestadas ,
                      SUM(CASE when hoja_detalle.Respuesta_Id <> 2 then 1 else 0 end) as Pendientes  
               from       hoja_detalle
               inner join hoja_cabeza on hoja_cabeza.id       = hoja_detalle.Hoja_Cabeza_Id
               inner join consulta    on consulta.id          = hoja_cabeza.Consulta_Id
               inner join direccion   on direccion.Persona_Id = hoja_detalle.Persona_Id
               inner join unidad      on unidad.id            = direccion.Unidad_Id
               inner join sector      on sector.id            = unidad.Sector_Id
               GROUP BY sector.Sector , consulta.Consulta";
        $stmt=$this->dbh->prepare($sql);
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Hoja_Resumen_Sector()
    {
        self::set_names();
        $sql="SELECT  sector.id as Sector_Id, sector.Sector as Sector ,
                      SUM(CASE when hoja_detalle.Respuesta_Id =  2 then 1 else 0 end) as Encuestadas ,
                      SUM(CASE when hoja_detalle.Respuesta_Id <> 2 then 1 else 0 end) as Pendientes  
               from       hoja_detalle
               inner join hoja_cabeza on hoja_cabeza.id       = hoja_detalle.Hoja_Cabeza_Id
               inner join consulta    on consulta.id          = hoja_cabeza.Consulta_Id
               inner join direccion   on direccion.Persona_Id = hoja_detalle.Persona_Id
               inner join unidad      on unidad.id            = direccion.Unidad_Id
               inner join sector      on sector.id            = unidad.Sector_Id
               GROUP BY sector.Sector ";
        $stmt=$this->dbh->prepare($sql);
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Hoja_Resumen_Sector_Persona($Sector_Id)
    {
        self::set_names();
        $sql="SELECT  sector.Sector as Sector , count(hoja_detalle.Persona_Id)
              from       hoja_detalle
              inner join hoja_cabeza on hoja_cabeza.id       = hoja_detalle.Hoja_Cabeza_Id
              inner join consulta    on consulta.id          = hoja_cabeza.Consulta_Id
              inner join direccion   on direccion.Persona_Id = hoja_detalle.Persona_Id
              inner join unidad      on unidad.id            = direccion.Unidad_Id
              inner join sector      on sector.id            = unidad.Sector_Id
              where sector.id = ?
              GROUP BY sector.Sector , hoja_detalle.Persona_Id ";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Sector_Id       ,   PDO::PARAM_STR);
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Atenciones_Acumuladas_Sector()
    {
        self::set_names();
        $sql="SELECT sector.Sector, sector.id  as Sector_Id,
                SUM(CASE when ate_consulta.Estado_Consulta = 7 then 1 else 0 end) as Pendientes,
                SUM(CASE when ate_consulta.Estado_Consulta =  6 then 1 else 0 end) as Aprovadas,
                SUM(CASE when ate_consulta.Estado_Consulta =  4 then 1 else 0 end) as Anuladas
              FROM atencion
              inner JOIN ate_consulta     ON ate_consulta.Atencion_Id = atencion.id
              inner join consulta         on consulta.id = ate_consulta.Consulta_Id
              inner join requerimientos   on requerimientos.id = consulta.Requerimiento_Id
              inner join direccion        on direccion.Persona_Id = atencion.Persona_Id
              inner join unidad           on unidad.id = direccion.Unidad_Id
              inner join sector           on sector.id = unidad.Sector_Id
              GROUP BY sector.Sector";

        $stmt=$this->dbh->prepare($sql);
        
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Atenciones_Personas_Sector($Sector_Id)
    {
        self::set_names();
        $sql="SELECT unidad.Sector_Id , count(atencion.Persona_Id) from atencion
              inner join direccion on direccion.Persona_Id = atencion.Persona_Id
              inner join unidad on unidad.id = direccion.Unidad_Id
              WHERE unidad.Sector_Id = ?
              GROUP BY unidad.Sector_Id, atencion.Persona_Id";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Sector_Id       ,   PDO::PARAM_STR);



        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Atenciones_Acumuladas_Mensual()
    {
        self::set_names();
        $sql="SELECT sector.Sector,
                SUM(CASE when ate_consulta.Estado_Consulta = 1 then 1 else 0 end) as Pendientes,
                SUM(CASE when ate_consulta.Estado_Consulta =  6 then 1 else 0 end) as Aprovadas,
                SUM(CASE when ate_consulta.Estado_Consulta =  4 then 1 else 0 end) as Anuladas
              FROM atencion
              inner JOIN ate_consulta     ON ate_consulta.Atencion_Id = atencion.id
              inner join consulta         on consulta.id = ate_consulta.Consulta_Id
              inner join requerimientos   on requerimientos.id = consulta.Requerimiento_Id
              inner join direccion        on direccion.Persona_Id = atencion.Persona_Id
              inner join unidad           on unidad.id = direccion.Unidad_Id
              inner join sector           on sector.id = unidad.Sector_Id
              GROUP BY sector.Sector";

        $stmt=$this->dbh->prepare($sql);
        
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Atenciones_Acumuladas_Anio($Anio)
    {
        self::set_names();
        $sql="SELECT  year(atencion.Fecha_Atencion) as Anio  ,  requerimientos.Requerimiento  as Requerimiento, consulta.Consulta as Consulta ,
        SUM(CASE WHEN MONTH(atencion.Fecha_Atencion) = 1  AND ate_consulta.Estado_Consulta =  0 then 1 else 0 end) as 'Enero_Pendiente',
        SUM(CASE WHEN MONTH(atencion.Fecha_Atencion) = 1  AND ate_consulta.Estado_Consulta =  6 then 1 else 0 end) as 'Enero_Aprovado' ,
        SUM(CASE WHEN MONTH(atencion.Fecha_Atencion) = 1  AND ate_consulta.Estado_Consulta =  4 then 1 else 0 end) as 'Enero_Anulado'  ,
        SUM(CASE WHEN MONTH(atencion.Fecha_Atencion) = 2  AND ate_consulta.Estado_Consulta =  0 then 1 else 0 end) as 'Febrero_Pendiente',
        SUM(CASE WHEN MONTH(atencion.Fecha_Atencion) = 2  AND ate_consulta.Estado_Consulta =  6 then 1 else 0 end) as 'Febrero_Aprovado' ,
        SUM(CASE WHEN MONTH(atencion.Fecha_Atencion) = 2  AND ate_consulta.Estado_Consulta =  4 then 1 else 0 end) as 'Febrero_Anulado'  ,
        SUM(CASE WHEN MONTH(atencion.Fecha_Atencion) = 3  AND ate_consulta.Estado_Consulta =  0 then 1 else 0 end) as 'Marzo_Pendiente',
        SUM(CASE WHEN MONTH(atencion.Fecha_Atencion) = 3  AND ate_consulta.Estado_Consulta =  6 then 1 else 0 end) as 'Marzo_Aprovado' ,
        SUM(CASE WHEN MONTH(atencion.Fecha_Atencion) = 3  AND ate_consulta.Estado_Consulta =  4 then 1 else 0 end) as 'Marzo_Anulado'  ,
        SUM(CASE WHEN MONTH(atencion.Fecha_Atencion) = 4  AND ate_consulta.Estado_Consulta =  0 then 1 else 0 end) as 'Abril_Pendiente',
        SUM(CASE WHEN MONTH(atencion.Fecha_Atencion) = 4  AND ate_consulta.Estado_Consulta =  6 then 1 else 0 end) as 'Abril_Aprovado' ,
        SUM(CASE WHEN MONTH(atencion.Fecha_Atencion) = 4  AND ate_consulta.Estado_Consulta =  4 then 1 else 0 end) as 'Abril_Anulado'  ,
        SUM(CASE WHEN MONTH(atencion.Fecha_Atencion) = 5  AND ate_consulta.Estado_Consulta =  0 then 1 else 0 end) as 'Mayo_Pendiente',
        SUM(CASE WHEN MONTH(atencion.Fecha_Atencion) = 5  AND ate_consulta.Estado_Consulta =  6 then 1 else 0 end) as 'Mayo_Aprovado' ,
        SUM(CASE WHEN MONTH(atencion.Fecha_Atencion) = 5  AND ate_consulta.Estado_Consulta =  4 then 1 else 0 end) as 'Mayo_Anulado'  ,
        SUM(CASE WHEN MONTH(atencion.Fecha_Atencion) = 6  AND ate_consulta.Estado_Consulta =  0 then 1 else 0 end) as 'Junio_Pendiente',
        SUM(CASE WHEN MONTH(atencion.Fecha_Atencion) = 6  AND ate_consulta.Estado_Consulta =  6 then 1 else 0 end) as 'Junio_Aprovado' ,
        SUM(CASE WHEN MONTH(atencion.Fecha_Atencion) = 6  AND ate_consulta.Estado_Consulta =  4 then 1 else 0 end) as 'Junio_Anulado'  ,
        SUM(CASE WHEN MONTH(atencion.Fecha_Atencion) = 7  AND ate_consulta.Estado_Consulta =  0 then 1 else 0 end) as 'Julio_Pendiente',
        SUM(CASE WHEN MONTH(atencion.Fecha_Atencion) = 7  AND ate_consulta.Estado_Consulta =  6 then 1 else 0 end) as 'Julio_Aprovado' ,
        SUM(CASE WHEN MONTH(atencion.Fecha_Atencion) = 7  AND ate_consulta.Estado_Consulta =  4 then 1 else 0 end) as 'Julio_Anulado'  ,
        SUM(CASE WHEN MONTH(atencion.Fecha_Atencion) = 8  AND ate_consulta.Estado_Consulta =  0 then 1 else 0 end) as 'Agosto_Pendiente',
        SUM(CASE WHEN MONTH(atencion.Fecha_Atencion) = 8  AND ate_consulta.Estado_Consulta =  6 then 1 else 0 end) as 'Agosto_Aprovado' ,
        SUM(CASE WHEN MONTH(atencion.Fecha_Atencion) = 8  AND ate_consulta.Estado_Consulta =  4 then 1 else 0 end) as 'Agosto_Anulado'  ,
        SUM(CASE WHEN MONTH(atencion.Fecha_Atencion) = 9  AND ate_consulta.Estado_Consulta =  0 then 1 else 0 end) as 'Septiembre_Pendiente',
        SUM(CASE WHEN MONTH(atencion.Fecha_Atencion) = 9  AND ate_consulta.Estado_Consulta =  6 then 1 else 0 end) as 'Septiembre_Aprovado' ,
        SUM(CASE WHEN MONTH(atencion.Fecha_Atencion) = 9  AND ate_consulta.Estado_Consulta =  4 then 1 else 0 end) as 'Septiembre_Anulado'  ,
        SUM(CASE WHEN MONTH(atencion.Fecha_Atencion) = 10 AND ate_consulta.Estado_Consulta =  0 then 1 else 0 end) as 'Octubre_Pendiente',
        SUM(CASE WHEN MONTH(atencion.Fecha_Atencion) = 10 AND ate_consulta.Estado_Consulta =  6 then 1 else 0 end) as 'Octubre_Aprovado' ,
        SUM(CASE WHEN MONTH(atencion.Fecha_Atencion) = 10 AND ate_consulta.Estado_Consulta =  4 then 1 else 0 end) as 'Octubre_Anulado'  ,
        SUM(CASE WHEN MONTH(atencion.Fecha_Atencion) = 11 AND ate_consulta.Estado_Consulta =  0 then 1 else 0 end) as 'Noviembre_Pendiente',
        SUM(CASE WHEN MONTH(atencion.Fecha_Atencion) = 11 AND ate_consulta.Estado_Consulta =  6 then 1 else 0 end) as 'Noviembre_Aprovado' ,
        SUM(CASE WHEN MONTH(atencion.Fecha_Atencion) = 11 AND ate_consulta.Estado_Consulta =  4 then 1 else 0 end) as 'Noviembre_Anulado'  ,
        SUM(CASE WHEN MONTH(atencion.Fecha_Atencion) = 12 AND ate_consulta.Estado_Consulta =  0 then 1 else 0 end) as 'Diciembre_Pendiente',
        SUM(CASE WHEN MONTH(atencion.Fecha_Atencion) = 12 AND ate_consulta.Estado_Consulta =  6 then 1 else 0 end) as 'Diciembre_Aprovado' ,
        SUM(CASE WHEN MONTH(atencion.Fecha_Atencion) = 12 AND ate_consulta.Estado_Consulta =  4 then 1 else 0 end) as 'Diciembre_Anulado'       
        FROM atencion
        inner join ate_consulta             on ate_consulta.Atencion_Id = atencion.id
        inner join consulta                 on consulta.id              = ate_consulta.Consulta_Id
        inner join requerimientos           on requerimientos.id        = consulta.Requerimiento_Id
        where year(atencion.Fecha_Atencion) = ?
        GROUP BY year(atencion.Fecha_Atencion),  consulta.Requerimiento_Id, consulta.Consulta ";

        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Anio       ,   PDO::PARAM_STR);
        
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }

    public function Get_Atenciones_Acumuladas_Anual()
    {
        self::set_names();
        $sql="      SELECT  year(atencion.Fecha_Atencion)  as Anio ,
                            SUM(CASE when ate_consulta.Estado_Consulta =  7 then 1 else 0 end) as Pendientes,
                            SUM(CASE when ate_consulta.Estado_Consulta =  6 then 1 else 0 end) as Aprovadas,
                            SUM(CASE when ate_consulta.Estado_Consulta =  4 then 1 else 0 end) as Anuladas
                    FROM atencion
                    inner join ate_consulta on ate_consulta.Atencion_Id = atencion.id
                    GROUP BY year(atencion.Fecha_Atencion)";
        $stmt=$this->dbh->prepare($sql);
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Atenciones_Acumuladas_Anual_Persona($Anio_Proceso)
    {
        self::set_names();
        $sql="SELECT  YEAR(atencion.Fecha_Atencion) , count(atencion.Persona_Id)
              from atencion
              where YEAR(atencion.Fecha_Atencion) = ? 
              GROUP BY YEAR(atencion.Fecha_Atencion) , atencion.Persona_Id";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Anio_Proceso       ,   PDO::PARAM_STR);

        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }

    public function Get_Atenciones_Acumuladas_Requerimiento()
    {
        self::set_names();
        $sql="SELECT requerimientos.Requerimiento , requerimientos.id as Requerimiento_Id ,
                    SUM(CASE when ate_consulta.Estado_Consulta =  7 then 1 else 0 end) as 'Pendientes',
                    SUM(CASE when ate_consulta.Estado_Consulta =  6 then 1 else 0 end) as 'Aprovadas',
                    SUM(CASE when ate_consulta.Estado_Consulta =  4 then 1 else 0 end) as 'Anuladas'
                FROM atencion
                inner JOIN ate_consulta         ON ate_consulta.Atencion_Id = atencion.id
                inner join consulta             on consulta.id              = ate_consulta.Consulta_Id
                inner join requerimientos       on requerimientos.id        = consulta.Requerimiento_Id
                GROUP BY requerimientos.Requerimiento";

        $stmt=$this->dbh->prepare($sql);
        
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Atenciones_Personas_Requerimiento($Requerimiento_Id)
    {
        self::set_names();
        $sql="SELECT  consulta.Requerimiento_Id , count(atencion.Persona_Id) from atencion
              inner join ate_consulta on ate_consulta.Atencion_Id = atencion.id
              inner join consulta on consulta.id = ate_consulta.Consulta_Id
              where  consulta.Requerimiento_Id = ?
              GROUP BY consulta.Requerimiento_Id , atencion.Persona_Id ";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Requerimiento_Id       ,   PDO::PARAM_STR);
        
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Atenciones_Personas_Consultas($Consulta_Id)
    {
        self::set_names();
        $sql="SELECT  consulta.Requerimiento_Id , ate_consulta.Consulta_Id, count(atencion.Persona_Id) from atencion
              inner join ate_consulta on ate_consulta.Atencion_Id = atencion.id
              inner join consulta on consulta.id = ate_consulta.Consulta_Id
              where ate_consulta.Consulta_Id = ?
              GROUP BY consulta.Requerimiento_Id , ate_consulta.Consulta_Id , atencion.Persona_Id ";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Consulta_Id       ,   PDO::PARAM_STR);
        
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Cuenta_Personas_Periodo()
    {
        self::set_names();
        $sql="SELECT  persona.rut , 
                      count(atencion.Persona_Id) as Cantidad 
              from atencion
              INNER JOIN persona on persona.id = atencion.Persona_Id
              GROUP BY atencion.Persona_Id ";
        $stmt=$this->dbh->prepare($sql);
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Cuenta_Personas_Periodo_fecha($Fecha_Desde , $Fecha_Hasta)
    {
        self::set_names();
        $sql="SELECT  persona.rut , 
                      count(atencion.Persona_Id) as Cantidad 
              from atencion
              INNER JOIN persona on persona.id = atencion.Persona_Id
              where atencion.Fecha_Atencion BETWEEN ? and ? 
              GROUP BY atencion.Persona_Id ";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Fecha_Desde       ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Fecha_Hasta       ,   PDO::PARAM_STR);
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Cuenta_Atenciones_Periodo_fecha($Fecha_Desde, $Fecha_Hasta)
    {
        self::set_names();
        $sql="SELECT  count(atencion.id) as T_Atenciones from atencion 
              Where atencion.Fecha_Atencion BETWEEN ? and ? ";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Fecha_Desde       ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Fecha_Hasta       ,   PDO::PARAM_STR);
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Cuenta_Atenciones_Periodo()
    {
        self::set_names();
        $sql="SELECT  count(atencion.id) as T_Atenciones from atencion ";
        $stmt=$this->dbh->prepare($sql);
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Cuenta_Consultas_Periodo()
    {
        self::set_names();
        $sql="SELECT  count(ate_consulta.id) from ate_consulta";
        $stmt=$this->dbh->prepare($sql);
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Atenciones_Diarias_Resumen($Fecha_Desde )
    {
        self::set_names();
        $sql="SELECT    atencion.id               as AT_id                  ,
                        atencion.Usuario_Id       as AT_Usuario_Id          ,
                        atencion.Persona_Id       as AT_Persona_Id          ,
                        persona.Rut               as PE_Rut                 ,
                        persona.Nombre            as PE_Nombre              ,
                        persona.Apellido          as PE_Apellido            ,
                        atencion.Fecha_Atencion   as AT_Fecha_Atencion      ,
                        atencion.Hora_Atencion    as AT_Hora_Atencion       ,
                        atencion.Observacion      as AT_Observacion         ,
                        atencion.Folio_Rsh        as AT_Folio_Rsh           ,
                        atencion.Numero_Solicitud as AT_Numero_Solicitud    ,
                        atencion.Estado_Atencion  as AT_Estado_Atencion     ,
                        atencion.Fecha_Cita       as AT_Fecha_Cita          ,
                        atencion.Usuario_Cierra   as AT_Usuario_Cierra      ,
                        atencion.Fecha_Cierra     as AT_Fecha_Cierra        ,
                        atencion.Generada         as AT_Generada            
              FROM atencion
              INNER JOIN persona      on persona.id                 =   atencion.Persona_Id
              WHERE atencion.Fecha_Atencion =  ?  or atencion.Fecha_Cierra = ?";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Fecha_Desde       ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Fecha_Desde       ,   PDO::PARAM_STR);
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Atenciones_Diarias_Acumulado($Fecha_Desde )
    {
        self::set_names();
        $sql ="SELECT   consulta.Consulta as Consulta,
                        SUM(CASE when atencion.Estado_Atencion = 1 then 1 else 0 end) as 'Pendientes',
                        SUM(CASE when atencion.Estado_Atencion = 2 then 1 else 0 end) as 'Cerradas',
                        SUM(CASE when atencion.Estado_Atencion = 3 then 1 else 0 end) as 'Anuladas'
               FROM atencion
               INNER JOIN ate_consulta on atencion.id                  = ate_consulta.Atencion_Id
               INNER JOIN consulta     on ate_consulta.Consulta_Id = consulta.id
               WHERE atencion.Fecha_Atencion =  ?  or atencion.Fecha_Cierra = ?
               GROUP BY consulta.Consulta";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Fecha_Desde       ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Fecha_Desde       ,   PDO::PARAM_STR);
        
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Atenciones_Total()
    {
        self::set_names();
        $sql ="SELECT   YEAR(atencion.Fecha_Atencion)                                   as  Ano_Proceso                 ,
                        MONTH(atencion.Fecha_Atencion)                                  as  Mes_Proceso                 ,
                        SUM(CASE WHEN ate_consulta.Consulta_Id = 1  then 1 else 0 end ) as  Desvinculacion              ,
                        SUM(CASE WHEN ate_consulta.Consulta_Id = 2  then 1 else 0 end ) as  Recien_Nacidos              ,
                        SUM(CASE WHEN ate_consulta.Consulta_Id = 3  then 1 else 0 end ) as  Otro_Integrante             ,
                        SUM(CASE WHEN ate_consulta.Consulta_Id = 4  then 1 else 0 end ) as  Cambio_Domicilio            ,
                        SUM(CASE WHEN ate_consulta.Consulta_Id = 5  then 1 else 0 end ) as  Cartola                     ,
                        SUM(CASE WHEN ate_consulta.Consulta_Id = 6  then 1 else 0 end ) as  Educacion                   ,
                        SUM(CASE WHEN ate_consulta.Consulta_Id = 7  then 1 else 0 end ) as  Parentesco                  ,
                        SUM(CASE WHEN ate_consulta.Consulta_Id = 8  then 1 else 0 end ) as  Ocupacion_Ingreso           ,
                        SUM(CASE WHEN ate_consulta.Consulta_Id = 9  then 1 else 0 end ) as  Salud                       ,
                        SUM(CASE WHEN ate_consulta.Consulta_Id = 10 then 1 else 0 end ) as  Ingreso_Registro_RSH        ,
                        SUM(CASE WHEN ate_consulta.Consulta_Id = 11 then 1 else 0 end ) as  Actualizacion_Rectificacion ,
                        SUM(CASE WHEN ate_consulta.Consulta_Id = 12 then 1 else 0 end ) as  Complemento_Educacion       ,
                        SUM(CASE WHEN ate_consulta.Consulta_Id = 13 then 1 else 0 end ) as  Otra_Consulta               ,
                        SUM(CASE WHEN ate_consulta.Consulta_Id = 14 then 1 else 0 end ) as  Modulo_Vivienda
                FROM atencion
                INNER JOIN ate_consulta ON ate_consulta.Atencion_Id = atencion.id
                GROUP BY YEAR(atencion.Fecha_Atencion)     , 
                         MONTH(atencion.Fecha_Atencion)    ";
        $stmt=$this->dbh->prepare($sql);   
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Atenciones_Diarias_Cerradas($Fecha_Desde , $Fecha_Hasta , $Usuario)
    {
        self::set_names();
        $sql="SELECT    atencion.id               as AT_id                  ,
                        atencion.Usuario_Id       as AT_Usuario_Id          ,
                        atencion.Persona_Id       as AT_Persona_Id          ,
                        persona.Rut               as PE_Rut                 ,
                        persona.Nombre            as PE_Nombre              ,
                        persona.Apellido          as PE_Apellido            ,
                        atencion.Fecha_Atencion   as AT_Fecha_Atencion      ,
                        atencion.Hora_Atencion    as AT_Hora_Atencion       ,
                        atencion.Observacion      as AT_Observacion         ,
                        atencion.Folio_Rsh        as AT_Folio_Rsh           ,
                        atencion.Numero_Solicitud as AT_Numero_Solicitud    ,
                        atencion.Estado_Atencion  as AT_Estado_Atencion     ,
                        atencion.Fecha_Cita       as AT_Fecha_Cita          ,
                        atencion.Usuario_Cierra   as AT_Usuario_Cierra      ,
                        atencion.Fecha_Cierra     as AT_Fecha_Cierra        ,
                        atencion.Generada         as AT_Generada            
              FROM atencion
              INNER JOIN persona      on persona.id                 =   atencion.Persona_Id
              WHERE atencion.Fecha_Cierra BETWEEN ? and ? AND   
                    atencion.Usuario_Cierra =       ?  and 
                    atencion.Fecha_Atencion <> atencion.Fecha_Cierra";               
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Fecha_Desde       ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Fecha_Hasta       ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$Usuario           ,   PDO::PARAM_STR);

        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Consultas($Atencion_Id)
    {
        self::set_names();
        $sql="SELECT  consulta.Resumen as Resu 
              from ate_consulta
              inner join consulta on ate_consulta.Consulta_Id = consulta.id
              where ate_consulta.Atencion_Id = ? ";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Atencion_Id       ,   PDO::PARAM_STR);
        
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Programas($Atencion_Id)
    {
        self::set_names();
        $sql="SELECT  programa.Resumen  as Resu_Prog
              from ate_programa
              INNER JOIN programa on programa.id = ate_programa.Programa_Id
              where ate_programa.Atencion_Id = ? ";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Atencion_Id       ,   PDO::PARAM_STR);
        
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Atenciones_Acumuladas_Requerimiento_Fecha($Fecha_Desde , $Fecha_Hasta)
    {
        self::set_names();
        $sql="SELECT requerimientos.Requerimiento , requerimientos.id as Requerimiento_Id ,
                    SUM(CASE when ate_consulta.Estado_Consulta =  7 then 1 else 0 end) as 'Pendientes',
                    SUM(CASE when ate_consulta.Estado_Consulta =  6 then 1 else 0 end) as 'Aprovadas',
                    SUM(CASE when ate_consulta.Estado_Consulta =  4 then 1 else 0 end) as 'Anuladas'
                FROM atencion
                inner JOIN ate_consulta         ON ate_consulta.Atencion_Id = atencion.id
                inner join consulta             on consulta.id              = ate_consulta.Consulta_Id
                inner join requerimientos       on requerimientos.id        = consulta.Requerimiento_Id
                WHERE atencion.Fecha_Atencion BETWEEN ? AND ?
                GROUP BY requerimientos.Requerimiento";

        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Fecha_Desde       ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Fecha_Hasta       ,   PDO::PARAM_STR);
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Atenciones_Personas_Requerimiento_Fecha($Requerimiento_Id, $Fecha_Desde, $Fecha_Hasta)
    {
        self::set_names();
        $sql="SELECT     consulta.Requerimiento_Id , 
                         count(atencion.Persona_Id) 
              from atencion
              inner join ate_consulta on ate_consulta.Atencion_Id = atencion.id
              inner join consulta     on consulta.id             = ate_consulta.Consulta_Id
              where  consulta.Requerimiento_Id = ? and 
                     atencion.Fecha_Atencion BETWEEN ? AND ?
              GROUP BY consulta.Requerimiento_Id , atencion.Persona_Id ";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Requerimiento_Id       ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Fecha_Desde            ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$Fecha_Hasta            ,   PDO::PARAM_STR);
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Atenciones_Acumuladas_Fecha($Fecha_Desde, $Fecha_Hasta)
    {
        self::set_names();
        $sql="SELECT requerimientos.Requerimiento                                       as Requerimiento , 
                     consulta.Consulta                                                  as Consulta ,
                     consulta.id                                                        as Consulta_Id , 
                     SUM(CASE when ate_consulta.Estado_Consulta =  7 then 1 else 0 end) as Pendientes,
                     SUM(CASE when ate_consulta.Estado_Consulta =  6 then 1 else 0 end) as Aprovadas,
                     SUM(CASE when ate_consulta.Estado_Consulta =  4 then 1 else 0 end) as Anuladas
                FROM atencion
                inner JOIN ate_consulta     ON ate_consulta.Atencion_Id = atencion.id
                inner join consulta         on consulta.id = ate_consulta.Consulta_Id
                inner join requerimientos   on requerimientos.id = consulta.Requerimiento_Id
                WHERE atencion.Fecha_Atencion BETWEEN ? AND ?
                GROUP BY requerimientos.Requerimiento, consulta.Consulta";

        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Fecha_Desde            ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Fecha_Hasta            ,   PDO::PARAM_STR);
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Atenciones_Personas_Consultas_Fecha($Consulta_Id, $Fecha_Desde, $Fecha_Hasta)
    {
        self::set_names();
        $sql="SELECT  consulta.Requerimiento_Id   , 
                      ate_consulta.Consulta_Id    , 
                      count(atencion.Persona_Id) 
              from atencion
              inner join ate_consulta       on ate_consulta.Atencion_Id = atencion.id
              inner join consulta           on consulta.id              = ate_consulta.Consulta_Id
              where ate_consulta.Consulta_Id = ? and atencion.Fecha_Atencion BETWEEN ? AND ?
              GROUP BY consulta.Requerimiento_Id , 
                       ate_consulta.Consulta_Id  , 
                       atencion.Persona_Id ";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Consulta_Id             ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Fecha_Desde             ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$Fecha_Hasta             ,   PDO::PARAM_STR);
        
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Atenciones_Acumuladas_Sector_Fecha($Fecha_Desde , $Fecha_Hasta)
    {
        self::set_names();
        $sql="SELECT              sector.Sector, sector.id                             as Sector_Id,
                    SUM(CASE when ate_consulta.Estado_Consulta =  7 then 1 else 0 end) as Pendientes,
                    SUM(CASE when ate_consulta.Estado_Consulta =  6 then 1 else 0 end) as Aprovadas,
                    SUM(CASE when ate_consulta.Estado_Consulta =  4 then 1 else 0 end) as Anuladas
              FROM atencion
              inner JOIN ate_consulta     ON ate_consulta.Atencion_Id   = atencion.id
              inner join consulta         on consulta.id                = ate_consulta.Consulta_Id
              inner join requerimientos   on requerimientos.id          = consulta.Requerimiento_Id
              inner join direccion        on direccion.Persona_Id       = atencion.Persona_Id
              inner join unidad           on unidad.id                  = direccion.Unidad_Id
              inner join sector           on sector.id                  = unidad.Sector_Id
              where atencion.Fecha_Atencion BETWEEN ? AND ?
              GROUP BY sector.Sector";

        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Fecha_Desde             ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Fecha_Hasta             ,   PDO::PARAM_STR);
        
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Atenciones_Personas_Sector_Fecha($Sector_Id , $Fecha_Desde , $Fecha_Hasta)
    {
        self::set_names();
        $sql="SELECT        unidad.Sector_Id , 
                      count(atencion.Persona_Id) 
              from atencion
              inner join direccion  on direccion.Persona_Id = atencion.Persona_Id
              inner join unidad     on unidad.id            = direccion.Unidad_Id
              WHERE unidad.Sector_Id = ? and atencion.Fecha_Atencion BETWEEN ? AND ?
              GROUP BY unidad.Sector_Id, atencion.Persona_Id";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Sector_Id       ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Fecha_Desde             ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$Fecha_Hasta             ,   PDO::PARAM_STR);
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Atenciones_Acumuladas_Anual_Fecha($Fecha_Desde , $Fecha_Hasta)
    {
        self::set_names();
        $sql="      SELECT  year(atencion.Fecha_Atencion)  as Anio ,
                            SUM(CASE when ate_consulta.Estado_Consulta = 7 then 1 else 0 end) as Pendientes,
                            SUM(CASE when ate_consulta.Estado_Consulta =  6 then 1 else 0 end) as Aprovadas,
                            SUM(CASE when ate_consulta.Estado_Consulta =  4 then 1 else 0 end) as Anuladas
                    FROM atencion
                    inner join ate_consulta on ate_consulta.Atencion_Id = atencion.id
                    WHERE atencion.Fecha_Atencion BETWEEN ? AND ?
                    GROUP BY year(atencion.Fecha_Atencion)";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Fecha_Desde             ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Fecha_Hasta             ,   PDO::PARAM_STR);
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Atenciones_Acumuladas_Anual_Persona_Fecha($Anio_Proceso, $Fecha_Desde , $Fecha_Hasta)
    {
        self::set_names();
        $sql="SELECT  YEAR(atencion.Fecha_Atencion) , count(atencion.Persona_Id)
              from atencion
              where YEAR(atencion.Fecha_Atencion) = ? and atencion.Fecha_Atencion BETWEEN ? AND ?
              GROUP BY YEAR(atencion.Fecha_Atencion) , atencion.Persona_Id";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Anio_Proceso       ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Fecha_Desde        ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$Fecha_Hasta        ,   PDO::PARAM_STR);

        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Hojas_Ruta_Acumuladas_Fecha($Fecha_Desde, $Fecha_Hasta)
    {
        self::set_names();
        $sql="SELECT     consulta.id as Consulta_Id , consulta.Consulta as Consulta , count(hoja_cabeza.id) as Cantidad 
              from hoja_cabeza
              inner join consulta on consulta.id = hoja_cabeza.Consulta_Id
              where hoja_cabeza.Fecha_Generada  BETWEEN ? AND ?
              GROUP BY consulta.Consulta";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Fecha_Desde        ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Fecha_Hasta        ,   PDO::PARAM_STR);   
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Hojas_Ruta_Acumuladas_Persona_Fecha($Consulta_Id, $Fecha_Desde, $Fecha_Hasta)
    {
        self::set_names();
        $sql="SELECT  hoja_cabeza.Consulta_Id , count(hoja_detalle.Persona_Id)
              from hoja_cabeza
              inner join hoja_detalle on hoja_cabeza.id = hoja_detalle.Hoja_Cabeza_Id
              WHERE hoja_cabeza.Consulta_Id = ? and hoja_cabeza.Fecha_Generada  BETWEEN ? AND ?
              group by hoja_detalle.Persona_Id";

        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Consulta_Id       ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Fecha_Desde       ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$Fecha_Hasta       ,   PDO::PARAM_STR);
        
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Hojas_Ruta_Detalle_Acumuladas_Fecha($Fecha_Desde , $Fecha_Hasta)
    {
        self::set_names();
        $sql="SELECT  consulta.id as Consulta_Id ,
                      consulta.Consulta  as Consulta , 
                      SUM(CASE when hoja_detalle.Respuesta_Id =  2 then 1 else 0 end) as Encuestadas ,
                      SUM(CASE when hoja_detalle.Respuesta_Id <> 2 then 1 else 0 end) as Pendientes  
              from       hoja_detalle
              inner join hoja_cabeza on hoja_cabeza.id  = hoja_detalle.Hoja_Cabeza_Id
              inner join consulta    on consulta.id     = hoja_cabeza.Consulta_Id
              WHERE hoja_detalle.Fecha_Visita  BETWEEN ? AND ?
              GROUP BY consulta.Consulta";

        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Fecha_Desde       ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Fecha_Hasta       ,   PDO::PARAM_STR);
        
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Hoja_Resumen_Sector_Fecha($Fecha_Desde, $Fecha_Hasta)
    {
        self::set_names();
        $sql="SELECT  sector.id as Sector_Id, sector.Sector as Sector ,
                      SUM(CASE when hoja_detalle.Respuesta_Id =  2 then 1 else 0 end) as Encuestadas ,
                      SUM(CASE when hoja_detalle.Respuesta_Id <> 2 then 1 else 0 end) as Pendientes  
               from       hoja_detalle
               inner join hoja_cabeza on hoja_cabeza.id       = hoja_detalle.Hoja_Cabeza_Id
               inner join consulta    on consulta.id          = hoja_cabeza.Consulta_Id
               inner join direccion   on direccion.Persona_Id = hoja_detalle.Persona_Id
               inner join unidad      on unidad.id            = direccion.Unidad_Id
               inner join sector      on sector.id            = unidad.Sector_Id
               WHERE hoja_cabeza.Fecha_Generada  BETWEEN ? AND ?
               GROUP BY sector.Sector ";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Fecha_Desde       ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Fecha_Hasta       ,   PDO::PARAM_STR);
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Hoja_Resumen_Sector_Persona_Fecha($Sector_Id , $Fecha_Desde, $Fecha_Hasta)
    {
        self::set_names();
        $sql="SELECT  sector.Sector as Sector , count(hoja_detalle.Persona_Id)
              from       hoja_detalle
              inner join hoja_cabeza on hoja_cabeza.id       = hoja_detalle.Hoja_Cabeza_Id
              inner join consulta    on consulta.id          = hoja_cabeza.Consulta_Id
              inner join direccion   on direccion.Persona_Id = hoja_detalle.Persona_Id
              inner join unidad      on unidad.id            = direccion.Unidad_Id
              inner join sector      on sector.id            = unidad.Sector_Id
              where sector.id = ? and  hoja_cabeza.Fecha_Generada  BETWEEN ? AND ?
              GROUP BY sector.Sector , hoja_detalle.Persona_Id ";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Sector_Id         ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Fecha_Desde       ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$Fecha_Hasta       ,   PDO::PARAM_STR);
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Hoja_Detalle_Sector_Fecha($Fecha_Desde , $Fecha_Hasta)
    {
        self::set_names();
        $sql="SELECT  sector.Sector             as Sector ,
                      consulta.Consulta         as Consulta , 
                      SUM(CASE when hoja_detalle.Respuesta_Id =  2 then 1 else 0 end) as Encuestadas ,
                      SUM(CASE when hoja_detalle.Respuesta_Id <> 2 then 1 else 0 end) as Pendientes  
               from       hoja_detalle
               inner join hoja_cabeza on hoja_cabeza.id       = hoja_detalle.Hoja_Cabeza_Id
               inner join consulta    on consulta.id          = hoja_cabeza.Consulta_Id
               inner join direccion   on direccion.Persona_Id = hoja_detalle.Persona_Id
               inner join unidad      on unidad.id            = direccion.Unidad_Id
               inner join sector      on sector.id            = unidad.Sector_Id
               where hoja_cabeza.Fecha_Generada  BETWEEN ? AND ?
               GROUP BY sector.Sector , consulta.Consulta";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Fecha_Desde       ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Fecha_Hasta       ,   PDO::PARAM_STR);
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Hojas_Ruta_Encuestador_Acumuladas_Fecha($Fecha_Desde, $Fecha_Hasta)
    {
        self::set_names();
        $sql="SELECT  usuario.id        as Usuario_Id ,
                      usuario.Nombre    as Nombre , 
                      usuario.Apellido  as Apellido ,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 1   then 1 else 0 end ) as  A2,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 2   then 1 else 0 end ) as  E,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 3   then 1 else 0 end ) as  ERROR,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 4   then 1 else 0 end ) as  NOENC,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 5   then 1 else 0 end ) as  NV,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 6   then 1 else 0 end ) as  P1,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 7   then 1 else 0 end ) as  P2,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 8   then 1 else 0 end ) as  P3,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 9   then 1 else 0 end ) as  P4,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 10  then 1 else 0 end ) as  P5,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 11  then 1 else 0 end ) as  P6,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 12  then 1 else 0 end ) as  P7,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 13  then 1 else 0 end ) as  P8,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 14  then 1 else 0 end ) as  R2,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 15  then 1 else 0 end ) as  ANUL,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 15  then 1 else 0 end ) as  DES
              FROM hoja_historico
              INNER JOIN usuario on usuario.id = hoja_historico.Usuario_Id
              INNER JOIN respuestas on respuestas.id = hoja_historico.Respuesta_Id
              WHERE      hoja_historico.Fecha_Visita BETWEEN ? AND ?
              GROUP BY  usuario.id
              ORDER BY  usuario.id";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Fecha_Desde       ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Fecha_Hasta       ,   PDO::PARAM_STR);
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Hojas_Ruta_Encuestador_Acumuladas_Fecha_Resumen($Fecha_Desde, $Fecha_Hasta)
    {
        self::set_names();
        $sql="SELECT  YEAR(hoja_historico.Fecha_Visita)         as Ano_Proceso                                  ,
                      MONTH(hoja_historico.Fecha_Visita)        as Mes_Proceso                                  ,
                           usuario.id                           as Usuario_Id                                   ,
                           usuario.Nombre                       as Nombre                                       ,
                           usuario.Apellido                     as Apellido                                     ,
                           SUM(CASE WHEN hoja_historico.Respuesta_Id    = 2 then 1 else 0 end ) as  Logradas    ,
                           SUM(CASE WHEN hoja_historico.Respuesta_Id   <> 2 then 1 else 0 end ) as  Resto
                      FROM hoja_historico
                      INNER JOIN usuario    on usuario.id           =       hoja_historico.Usuario_Id
                      INNER JOIN respuestas on respuestas.id        =       hoja_historico.Respuesta_Id
                      WHERE      hoja_historico.Fecha_Visita BETWEEN ? AND ?
                      GROUP BY  YEAR(hoja_historico.Fecha_Visita) , MONTH(hoja_historico.Fecha_Visita), usuario.id
                      ORDER BY  YEAR(hoja_historico.Fecha_Visita) , MONTH(hoja_historico.Fecha_Visita), usuario.id";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Fecha_Desde       ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Fecha_Hasta       ,   PDO::PARAM_STR);
        
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Personas_Hojas_Ruta_Acumuladas_Fecha($Usuario_Id, $Fecha_Desde , $Fecha_Hasta)
    {
        self::set_names();
        $sql="SELECT     hoja_historico.Usuario_Id ,
                         count(hoja_detalle.Persona_Id) AS Persona_Hoja_Ruta
              FROM       hoja_historico
              inner join hoja_detalle on hoja_detalle.id = hoja_historico.Hoja_Detalle_Id
              WHERE     hoja_historico.Usuario_Id = ? and hoja_historico.Fecha_Visita BETWEEN ? and ?
              GROUP BY  hoja_historico.Usuario_Id";

        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Usuario_Id        ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Fecha_Desde       ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$Fecha_Hasta       ,   PDO::PARAM_STR);
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Personas_Hojas_Ruta_Acumuladas_Fecha_Resumen($Usuario_Id, $Ano_Procesamiento , $Mes_Procesamiento)
    {
        self::set_names();
        $sql="SELECT     hoja_historico.Usuario_Id ,
                         count(hoja_detalle.Persona_Id) AS Persona_Hoja_Ruta
              FROM       hoja_historico
              inner join hoja_detalle on hoja_detalle.id = hoja_historico.Hoja_Detalle_Id
              WHERE     hoja_historico.Usuario_Id               = ? and 
                        YEAR(hoja_historico.Fecha_Visita)       = ? AND 
                        MONTH(hoja_historico.Fecha_Visita)      = ? 
              GROUP BY  hoja_historico.Usuario_Id";

        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Usuario_Id         ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Ano_Procesamiento  ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$Mes_Procesamiento  ,   PDO::PARAM_STR);
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Atenciones_Acumuladas_Requerimiento_Fecha_Usuario($Fecha_Desde , $Fecha_Hasta, $Usuario_Busqueda)
    {
        self::set_names();
        $sql="SELECT requerimientos.Requerimiento , requerimientos.id as Requerimiento_Id ,
                    SUM(CASE when ate_consulta.Estado_Consulta = 7 then 1 else 0 end) as 'Pendientes',
                    SUM(CASE when ate_consulta.Estado_Consulta =  6 then 1 else 0 end) as 'Aprovadas',
                    SUM(CASE when ate_consulta.Estado_Consulta =  4 then 1 else 0 end) as 'Anuladas'
                FROM atencion
                inner JOIN ate_consulta         ON ate_consulta.Atencion_Id = atencion.id
                inner join consulta             on consulta.id              = ate_consulta.Consulta_Id
                inner join requerimientos       on requerimientos.id        = consulta.Requerimiento_Id
                WHERE atencion.Usuario_Id = ? and atencion.Fecha_Atencion BETWEEN ? AND ?
                GROUP BY requerimientos.Requerimiento";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Usuario_Busqueda    ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Fecha_Desde         ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$Fecha_Hasta         ,   PDO::PARAM_STR);
        
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Atenciones_Abiertas($Fecha_Desde , $Fecha_Hasta, $Usuario_Busqueda)
    {
        self::set_names();
        $sql="SELECT requerimientos.Requerimiento , requerimientos.id as Requerimiento_Id ,
                    SUM(CASE when ate_consulta.Estado_Consulta = 7 then 1 else 0 end) as 'Pendientes',
                    SUM(CASE when ate_consulta.Estado_Consulta =  6 then 1 else 0 end) as 'Aprovadas',
                    SUM(CASE when ate_consulta.Estado_Consulta =  4 then 1 else 0 end) as 'Anuladas',
                    porsentaje.Prosentaje_1  as p1 , porsentaje.Porsentaje_2 as p2
            FROM atencion
            inner JOIN ate_consulta         ON ate_consulta.Atencion_Id = atencion.id
            inner join consulta             on consulta.id              = ate_consulta.Consulta_Id
            inner join requerimientos       on requerimientos.id        = consulta.Requerimiento_Id  
            inner join porsentaje           on porsentaje.Usuario_Id    = atencion.Usuario_Id
                WHERE atencion.Usuario_Id = ? and atencion.Fecha_Atencion BETWEEN ? AND ?
                GROUP BY requerimientos.Requerimiento";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Usuario_Busqueda    ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Fecha_Desde         ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$Fecha_Hasta         ,   PDO::PARAM_STR);
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Atenciones_Cerradas($Fecha_Desde , $Fecha_Hasta, $Usuario_Busqueda)
    {
        self::set_names();
        $sql="SELECT requerimientos.Requerimiento , requerimientos.id as Requerimiento_Id ,
                    SUM(CASE when ate_consulta.Estado_Consulta = 7 then 1 else 0 end) as 'Pendientes',
                    SUM(CASE when ate_consulta.Estado_Consulta =  6 then 1 else 0 end) as 'Aprovadas',
                    SUM(CASE when ate_consulta.Estado_Consulta =  4 then 1 else 0 end) as 'Anuladas',
                    porsentaje.Prosentaje_1  as p1 , porsentaje.Porsentaje_2 as p2
            FROM atencion
            inner JOIN ate_consulta         ON ate_consulta.Atencion_Id = atencion.id
            inner join consulta             on consulta.id              = ate_consulta.Consulta_Id
            inner join requerimientos       on requerimientos.id        = consulta.Requerimiento_Id  
            inner join porsentaje           on porsentaje.Usuario_Id    = atencion.Usuario_Id
                WHERE atencion.Usuario_Cierra = ? and atencion.Fecha_Atencion BETWEEN ? AND ? and atencion.Usuario_Id <> atencion.Usuario_Cierra
                GROUP BY requerimientos.Requerimiento";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Usuario_Busqueda    ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Fecha_Desde         ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$Fecha_Hasta         ,   PDO::PARAM_STR);
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Atenciones_Personas_Requerimiento_Fecha_Usuario($Requerimiento_Id, $Fecha_Desde, $Fecha_Hasta, $Usuario_Busqueda)
    {
        self::set_names();
        $sql="SELECT     consulta.Requerimiento_Id , 
                         count(atencion.Persona_Id) 
              from atencion
              inner join ate_consulta on ate_consulta.Atencion_Id = atencion.id
              inner join consulta     on consulta.id             = ate_consulta.Consulta_Id
              where  consulta.Requerimiento_Id = ? and atencion.Usuario_Id = ? and 
                     atencion.Fecha_Atencion BETWEEN ? AND ?

              GROUP BY consulta.Requerimiento_Id , atencion.Persona_Id ";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Requerimiento_Id       ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Usuario_Busqueda       ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$Fecha_Desde            ,   PDO::PARAM_STR);
        $stmt->bindValue(4,$Fecha_Hasta            ,   PDO::PARAM_STR);
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Atenciones_Cerradas_Personas_Requerimiento_Fecha_Usuario($Requerimiento_Id, $Fecha_Desde, $Fecha_Hasta, $Usuario_Busqueda)
    {
        self::set_names();
        $sql="SELECT     consulta.Requerimiento_Id , 
                         count(atencion.Persona_Id) 
              from atencion
              inner join ate_consulta on ate_consulta.Atencion_Id = atencion.id
              inner join consulta     on consulta.id             = ate_consulta.Consulta_Id
              where  consulta.Requerimiento_Id = ? and atencion.Usuario_Cierra = ? and 
                     atencion.Fecha_Atencion BETWEEN ? AND ? and atencion.Usuario_Id <> atencion.Usuario_Cierra
              GROUP BY consulta.Requerimiento_Id , atencion.Persona_Id ";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Requerimiento_Id       ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Usuario_Busqueda       ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$Fecha_Desde            ,   PDO::PARAM_STR);
        $stmt->bindValue(4,$Fecha_Hasta            ,   PDO::PARAM_STR);
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Atenciones_Acumuladas_Fecha_Usuario($Fecha_Desde, $Fecha_Hasta, $Usuario_Busqueda)
    {
        self::set_names();
        $sql="SELECT requerimientos.Requerimiento                                       as Requerimiento , 
                     consulta.Consulta                                                  as Consulta ,
                     consulta.id                                                        as Consulta_Id , 
                     SUM(CASE when ate_consulta.Estado_Consulta =  7 then 1 else 0 end) as Pendientes,
                     SUM(CASE when ate_consulta.Estado_Consulta =  6 then 1 else 0 end) as Aprovadas,
                     SUM(CASE when ate_consulta.Estado_Consulta =  4 then 1 else 0 end) as Anuladas
                FROM atencion
                inner JOIN ate_consulta     ON ate_consulta.Atencion_Id = atencion.id
                inner join consulta         on consulta.id = ate_consulta.Consulta_Id
                inner join requerimientos   on requerimientos.id = consulta.Requerimiento_Id
                WHERE atencion.Usuario_Id = ? and atencion.Fecha_Atencion BETWEEN ? AND ?
                GROUP BY requerimientos.Requerimiento, consulta.Consulta";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Usuario_Busqueda       ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Fecha_Desde            ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$Fecha_Hasta            ,   PDO::PARAM_STR);
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Atenciones_Abiertas_Consulta($Fecha_Desde, $Fecha_Hasta, $Usuario_Busqueda)
    {
        self::set_names();
        $sql="SELECT requerimientos.Requerimiento                                       as Requerimiento , 
                     consulta.Consulta                                                  as Consulta ,
                     consulta.id                                                        as Consulta_Id , 
                     SUM(CASE when ate_consulta.Estado_Consulta =  7 then 1 else 0 end) as Pendientes,
                     SUM(CASE when ate_consulta.Estado_Consulta =  6 then 1 else 0 end) as Aprovadas,
                     SUM(CASE when ate_consulta.Estado_Consulta =  4 then 1 else 0 end) as Anuladas
                FROM atencion
                inner JOIN ate_consulta     ON ate_consulta.Atencion_Id = atencion.id
                inner join consulta         on consulta.id = ate_consulta.Consulta_Id
                inner join requerimientos   on requerimientos.id = consulta.Requerimiento_Id
                WHERE atencion.Usuario_Id = ? and atencion.Fecha_Atencion BETWEEN ? AND ?
                GROUP BY requerimientos.Requerimiento, consulta.Consulta";

        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Usuario_Busqueda       ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Fecha_Desde            ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$Fecha_Hasta            ,   PDO::PARAM_STR);
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }

    public function Get_Atenciones_Acumuladas_Consulta($Fecha_Desde, $Fecha_Hasta, $Usuario_Busqueda)
    {
        self::set_names();
        $sql="SELECT requerimientos.Requerimiento                                       as Requerimiento , 
                     consulta.Consulta                                                  as Consulta ,
                     consulta.id                                                        as Consulta_Id , 
                     SUM(CASE when ate_consulta.Estado_Consulta =  7 then 1 else 0 end) as Pendientes,
                     SUM(CASE when ate_consulta.Estado_Consulta =  6 then 1 else 0 end) as Aprovadas,
                     SUM(CASE when ate_consulta.Estado_Consulta =  4 then 1 else 0 end) as Anuladas
                FROM atencion
                inner JOIN ate_consulta     ON ate_consulta.Atencion_Id = atencion.id
                inner join consulta         on consulta.id = ate_consulta.Consulta_Id
                inner join requerimientos   on requerimientos.id = consulta.Requerimiento_Id
                WHERE  ( atencion.Usuario_Id = ? or  atencion.Usuario_Cierra = ? ) and  atencion.Fecha_Atencion BETWEEN ? AND ?
                GROUP BY requerimientos.Requerimiento, consulta.Consulta";

        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Usuario_Busqueda       ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Usuario_Busqueda       ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$Fecha_Desde            ,   PDO::PARAM_STR);
        $stmt->bindValue(4,$Fecha_Hasta            ,   PDO::PARAM_STR);
        
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Atenciones_Cerradas_Consulta($Fecha_Desde, $Fecha_Hasta, $Usuario_Busqueda)
    {
        self::set_names();
        $sql="SELECT requerimientos.Requerimiento                                       as Requerimiento , 
                     consulta.Consulta                                                  as Consulta ,
                     consulta.id                                                        as Consulta_Id , 
                     SUM(CASE when ate_consulta.Estado_Consulta =  7 then 1 else 0 end) as Pendientes,
                     SUM(CASE when ate_consulta.Estado_Consulta =  6 then 1 else 0 end) as Aprovadas,
                     SUM(CASE when ate_consulta.Estado_Consulta =  4 then 1 else 0 end) as Anuladas
                FROM atencion
                inner JOIN ate_consulta     ON ate_consulta.Atencion_Id = atencion.id
                inner join consulta         on consulta.id = ate_consulta.Consulta_Id
                inner join requerimientos   on requerimientos.id = consulta.Requerimiento_Id
                WHERE atencion.Usuario_Cierra = ? and atencion.Fecha_Atencion BETWEEN ? AND ? and atencion.Usuario_Id <> atencion.Usuario_Cierra
                GROUP BY requerimientos.Requerimiento, consulta.Consulta";

        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Usuario_Busqueda       ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Fecha_Desde            ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$Fecha_Hasta            ,   PDO::PARAM_STR);
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
                    
    public function Get_Atenciones_Personas_Consultas_Fecha_Usuario($Consulta_Id, $Fecha_Desde, $Fecha_Hasta, $Usuario_Busqueda)
    {
        self::set_names();
        $sql="SELECT  consulta.Requerimiento_Id   , 
                      ate_consulta.Consulta_Id    , 
                      count(atencion.Persona_Id) 
              from atencion
              inner join ate_consulta       on ate_consulta.Atencion_Id = atencion.id
              inner join consulta           on consulta.id              = ate_consulta.Consulta_Id
              where ate_consulta.Consulta_Id = ? and atencion.Usuario_Id = ? and
                    atencion.Fecha_Atencion BETWEEN ? AND ?
              GROUP BY consulta.Requerimiento_Id , 
                       ate_consulta.Consulta_Id  , 
                       atencion.Persona_Id ";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Consulta_Id             ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Usuario_Busqueda       ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$Fecha_Desde             ,   PDO::PARAM_STR);
        $stmt->bindValue(4,$Fecha_Hasta             ,   PDO::PARAM_STR);
        
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Atenciones_Acumulada_Personas_Consultas_Fecha_Usuario($Consulta_Id, $Fecha_Desde, $Fecha_Hasta, $Usuario_Busqueda)
    {
        self::set_names();
        $sql="SELECT  consulta.Requerimiento_Id   , 
                      ate_consulta.Consulta_Id    , 
                      count(atencion.Persona_Id) 
              from atencion
              inner join ate_consulta       on ate_consulta.Atencion_Id = atencion.id
              inner join consulta           on consulta.id              = ate_consulta.Consulta_Id
              where ate_consulta.Consulta_Id = ? and ( atencion.Usuario_Id = ? or atencion.Usuario_Cierra = ? ) and
                    atencion.Fecha_Atencion BETWEEN ? AND ?
              GROUP BY consulta.Requerimiento_Id , 
                       ate_consulta.Consulta_Id  , 
                       atencion.Persona_Id ";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Consulta_Id             ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Usuario_Busqueda       ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$Usuario_Busqueda       ,   PDO::PARAM_STR);
        $stmt->bindValue(4,$Fecha_Desde             ,   PDO::PARAM_STR);
        $stmt->bindValue(5,$Fecha_Hasta             ,   PDO::PARAM_STR);
        
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Atenciones_Cerradas_Personas_Consultas_Fecha_Usuario($Consulta_Id, $Fecha_Desde, $Fecha_Hasta, $Usuario_Busqueda)
    {
        self::set_names();
        $sql="SELECT  consulta.Requerimiento_Id   , 
                      ate_consulta.Consulta_Id    , 
                      count(atencion.Persona_Id) 
              from atencion
              inner join ate_consulta       on ate_consulta.Atencion_Id = atencion.id
              inner join consulta           on consulta.id              = ate_consulta.Consulta_Id
              where ate_consulta.Consulta_Id = ? and atencion.Usuario_Cierra = ? and
                    atencion.Fecha_Atencion BETWEEN ? AND ? and atencion.Usuario_Id <> atencion.Usuario_Cierra
              GROUP BY consulta.Requerimiento_Id , 
                       ate_consulta.Consulta_Id  , 
                       atencion.Persona_Id ";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Consulta_Id             ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Usuario_Busqueda       ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$Fecha_Desde             ,   PDO::PARAM_STR);
        $stmt->bindValue(4,$Fecha_Hasta             ,   PDO::PARAM_STR);
        
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Atenciones_Acumuladas_Sector_Fecha_Usuario($Fecha_Desde , $Fecha_Hasta, $Usuario_Busqueda)
    {
        self::set_names();
        $sql="SELECT              sector.Sector, sector.id                             as Sector_Id,
                    SUM(CASE when ate_consulta.Estado_Consulta = 7 then 1 else 0 end) as Pendientes,
                    SUM(CASE when ate_consulta.Estado_Consulta =  6 then 1 else 0 end) as Aprovadas,
                    SUM(CASE when ate_consulta.Estado_Consulta =  4 then 1 else 0 end) as Anuladas
              FROM atencion
              inner JOIN ate_consulta     ON ate_consulta.Atencion_Id   = atencion.id
              inner join consulta         on consulta.id                = ate_consulta.Consulta_Id
              inner join requerimientos   on requerimientos.id          = consulta.Requerimiento_Id
              inner join direccion        on direccion.Persona_Id       = atencion.Persona_Id
              inner join unidad           on unidad.id                  = direccion.Unidad_Id
              inner join sector           on sector.id                  = unidad.Sector_Id
              where atencion.Usuario_Id = ? and atencion.Fecha_Atencion BETWEEN ? AND ?
              GROUP BY sector.Sector";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Usuario_Busqueda        ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Fecha_Desde             ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$Fecha_Hasta             ,   PDO::PARAM_STR);
        
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Atenciones_Personas_Sector_Fecha_Usuario($Sector_Id , $Fecha_Desde , $Fecha_Hasta, $Usuario_Busqueda)
    {
        self::set_names();
        $sql="SELECT        unidad.Sector_Id , 
                      count(atencion.Persona_Id) 
              from atencion
              inner join direccion  on direccion.Persona_Id = atencion.Persona_Id
              inner join unidad     on unidad.id            = direccion.Unidad_Id
              WHERE unidad.Sector_Id = ? and atencion.Usuario_Id = ? and atencion.Fecha_Atencion BETWEEN ? AND ?
              GROUP BY unidad.Sector_Id, atencion.Persona_Id";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Sector_Id               ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Usuario_Busqueda        ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$Fecha_Desde             ,   PDO::PARAM_STR);
        $stmt->bindValue(4,$Fecha_Hasta             ,   PDO::PARAM_STR);
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Atenciones_Acumuladas_Anual_Fecha_Usuario($Fecha_Desde , $Fecha_Hasta, $Usuario_Busqueda)
    {
        self::set_names();
        $sql="      SELECT  year(atencion.Fecha_Atencion)  as Anio ,
                            SUM(CASE when ate_consulta.Estado_Consulta = 7 then 1 else 0 end) as Pendientes,
                            SUM(CASE when ate_consulta.Estado_Consulta =  6 then 1 else 0 end) as Aprovadas,
                            SUM(CASE when ate_consulta.Estado_Consulta =  4 then 1 else 0 end) as Anuladas
                    FROM atencion
                    inner join ate_consulta on ate_consulta.Atencion_Id = atencion.id
                    WHERE atencion.Usuario_Id = ? and atencion.Fecha_Atencion BETWEEN ? AND ?
                    GROUP BY year(atencion.Fecha_Atencion)";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Usuario_Busqueda        ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Fecha_Desde             ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$Fecha_Hasta             ,   PDO::PARAM_STR);
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Atenciones_Acumuladas_Anual_Persona_Fecha_Usuario($Anio_Proceso, $Fecha_Desde , $Fecha_Hasta, $Usuario_Busqueda)
    {
        self::set_names();
        $sql="SELECT  YEAR(atencion.Fecha_Atencion) , count(atencion.Persona_Id)
              from atencion
              where YEAR(atencion.Fecha_Atencion) = ? and 
                         atencion.Usuario_Id      = ? and 
                         atencion.Fecha_Atencion BETWEEN ? AND ?
              GROUP BY YEAR(atencion.Fecha_Atencion) , atencion.Persona_Id";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Anio_Proceso       ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Usuario_Busqueda   ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$Fecha_Desde        ,   PDO::PARAM_STR);
        $stmt->bindValue(4,$Fecha_Hasta        ,   PDO::PARAM_STR);

        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function  Get_llamados_usuario( $Fecha_Desde , $Fecha_Hasta, $Usuario_Busqueda)
    {
        self::set_names();
        $sql="SELECT MONTH(llamados.Fecha_Llamado) as Mes,
                     SUM(CASE WHEN DAY (llamados.Fecha_Llamado) =  1 THEN 1 ELSE 0 END ) AS  '1', SUM(CASE WHEN DAY (llamados.Fecha_Llamado) =  2 THEN 1 ELSE 0 END ) AS '2', 
                     SUM(CASE WHEN DAY (llamados.Fecha_Llamado) =  3 THEN 1 ELSE 0 END ) AS  '3', SUM(CASE WHEN DAY (llamados.Fecha_Llamado) =  4 THEN 1 ELSE 0 END ) AS '4',
                     SUM(CASE WHEN DAY (llamados.Fecha_Llamado) =  5 THEN 1 ELSE 0 END ) AS  '5', SUM(CASE WHEN DAY (llamados.Fecha_Llamado) =  6 THEN 1 ELSE 0 END ) AS '6', 
                     SUM(CASE WHEN DAY (llamados.Fecha_Llamado) =  7 THEN 1 ELSE 0 END ) AS  '7', SUM(CASE WHEN DAY (llamados.Fecha_Llamado) =  8 THEN 1 ELSE 0 END ) AS '8',
                     SUM(CASE WHEN DAY (llamados.Fecha_Llamado) =  9 THEN 1 ELSE 0 END ) AS  '9', SUM(CASE WHEN DAY (llamados.Fecha_Llamado) = 10 THEN 1 ELSE 0 END ) AS '10', 
                     SUM(CASE WHEN DAY (llamados.Fecha_Llamado) = 11 THEN 1 ELSE 0 END ) AS '11', SUM(CASE WHEN DAY (llamados.Fecha_Llamado) = 12 THEN 1 ELSE 0 END ) AS '12',
                     SUM(CASE WHEN DAY (llamados.Fecha_Llamado) = 13 THEN 1 ELSE 0 END ) AS '13', SUM(CASE WHEN DAY (llamados.Fecha_Llamado) = 14 THEN 1 ELSE 0 END ) AS '14', 
                     SUM(CASE WHEN DAY (llamados.Fecha_Llamado) = 15 THEN 1 ELSE 0 END ) AS '15', SUM(CASE WHEN DAY (llamados.Fecha_Llamado) = 16 THEN 1 ELSE 0 END ) AS '16',
                     SUM(CASE WHEN DAY (llamados.Fecha_Llamado) = 17 THEN 1 ELSE 0 END ) AS '17', SUM(CASE WHEN DAY (llamados.Fecha_Llamado) = 18 THEN 1 ELSE 0 END ) AS '18', 
                     SUM(CASE WHEN DAY (llamados.Fecha_Llamado) = 19 THEN 1 ELSE 0 END ) AS '19', SUM(CASE WHEN DAY (llamados.Fecha_Llamado) = 20 THEN 1 ELSE 0 END ) AS '20',
                     SUM(CASE WHEN DAY (llamados.Fecha_Llamado) = 21 THEN 1 ELSE 0 END ) AS '21', SUM(CASE WHEN DAY (llamados.Fecha_Llamado) = 22 THEN 1 ELSE 0 END ) AS '22', 
                     SUM(CASE WHEN DAY (llamados.Fecha_Llamado) = 23 THEN 1 ELSE 0 END ) AS '23', SUM(CASE WHEN DAY (llamados.Fecha_Llamado) = 24 THEN 1 ELSE 0 END ) AS '24',
                     SUM(CASE WHEN DAY (llamados.Fecha_Llamado) = 25 THEN 1 ELSE 0 END ) AS '25', SUM(CASE WHEN DAY (llamados.Fecha_Llamado) = 26 THEN 1 ELSE 0 END ) AS '26', 
                     SUM(CASE WHEN DAY (llamados.Fecha_Llamado) = 27 THEN 1 ELSE 0 END ) AS '27', SUM(CASE WHEN DAY (llamados.Fecha_Llamado) = 28 THEN 1 ELSE 0 END ) AS '28',
                     SUM(CASE WHEN DAY (llamados.Fecha_Llamado) = 29 THEN 1 ELSE 0 END ) AS '29', SUM(CASE WHEN DAY (llamados.Fecha_Llamado) = 30 THEN 1 ELSE 0 END ) AS '30',
                     SUM(CASE WHEN DAY (llamados.Fecha_Llamado) = 31 THEN 1 ELSE 0 END ) AS '31'
              FROM llamados
              WHERE  llamados.Fecha_Llamado BETWEEN ? AND ? and
                     llamados.Usuario_Id = ? 
              group by MONTH(llamados.Fecha_Llamado)";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Fecha_Desde       ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Fecha_Hasta       ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$Usuario_Busqueda  ,   PDO::PARAM_STR);
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Hojas_Ruta_Encuestador_Acumuladas_Fecha_Usuario($Fecha_Desde, $Fecha_Hasta , $Usuario_Busqueda)
    {
        self::set_names();
        $sql="SELECT  usuario.id        as Usuario_Id      ,
                      usuario.Nombre    as Nombre           , 
                      usuario.Apellido  as Apellido         ,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 1   then 1 else 0 end ) as  A2,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 2   then 1 else 0 end ) as  E,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 3   then 1 else 0 end ) as  ERROR,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 4   then 1 else 0 end ) as  NOENC,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 5   then 1 else 0 end ) as  NV,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 6   then 1 else 0 end ) as  P1,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 7   then 1 else 0 end ) as  P2,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 8   then 1 else 0 end ) as  P3,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 9   then 1 else 0 end ) as  P4,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 10  then 1 else 0 end ) as  P5,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 11  then 1 else 0 end ) as  P6,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 12  then 1 else 0 end ) as  P7,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 13  then 1 else 0 end ) as  P8,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 14  then 1 else 0 end ) as  R2,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 15  then 1 else 0 end ) as  ANUL,
                      SUM(CASE WHEN hoja_historico.Respuesta_Id = 15  then 1 else 0 end ) as  DES
              FROM hoja_historico
              INNER JOIN usuario    on usuario.id       = hoja_historico.Usuario_Id
              INNER JOIN respuestas on respuestas.id    = hoja_historico.Respuesta_Id
              WHERE hoja_historico.Usuario_Id = ? and hoja_historico.Fecha_Visita BETWEEN ? and ?
              GROUP BY  hoja_historico.Usuario_Id";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Usuario_Busqueda        ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Fecha_Desde             ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$Fecha_Hasta             ,   PDO::PARAM_STR);
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
     /****************Perfiles***************/
    public function get_actividades_diarias_usuario($Fecha_Desde , $Fecha_Hasta, $Usuario_Actividad)
    {

        $Mes_Actual = date('n');$Anio_Actual = date('Y');
        self::set_names();
        $sql="SELECT  actividades.Actividades as Nombre_Actividad,  
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) =  1 THEN actividad_diaria.Cantidad ELSE 0 END ) AS ' 1', SUM(CASE WHEN DAY (actividad_diaria.Fecha) =  2 THEN actividad_diaria.Cantidad ELSE 0 END ) AS ' 2', 
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) =  3 THEN actividad_diaria.Cantidad ELSE 0 END ) AS ' 3', SUM(CASE WHEN DAY (actividad_diaria.Fecha) =  4 THEN actividad_diaria.Cantidad ELSE 0 END ) AS ' 4',
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) =  5 THEN actividad_diaria.Cantidad ELSE 0 END ) AS ' 5', SUM(CASE WHEN DAY (actividad_diaria.Fecha) =  6 THEN actividad_diaria.Cantidad ELSE 0 END ) AS ' 6', 
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) =  7 THEN actividad_diaria.Cantidad ELSE 0 END ) AS ' 7', SUM(CASE WHEN DAY (actividad_diaria.Fecha) =  8 THEN actividad_diaria.Cantidad ELSE 0 END ) AS ' 8',
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) =  9 THEN actividad_diaria.Cantidad ELSE 0 END ) AS ' 9', SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 10 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '10', 
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 11 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '11', SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 12 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '12',
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 13 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '13', SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 14 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '14', 
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 15 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '15', SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 16 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '16',
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 17 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '17', SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 18 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '18', 
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 19 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '19', SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 20 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '20',
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 21 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '21', SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 22 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '22', 
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 23 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '23', SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 24 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '24',
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 25 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '25', SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 26 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '26', 
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 27 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '27', SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 28 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '28',
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 29 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '29', SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 30 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '30',
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 31 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '31'
                FROM       actividad_diaria
                INNER JOIN actividades ON actividades.id = actividad_diaria.Actividad_Id
                INNER JOIN usuario ON usuario.id = actividad_diaria.Usuario_Id
                Where actividad_diaria.Usuario_Id = ? and actividad_diaria.Fecha BETWEEN ? and ? 
                GROUP BY Nombre_Actividad
                ORDER BY actividad_diaria.Actividad_Id ,  MONTH(actividad_diaria.Fecha)";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Usuario_Actividad        ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Fecha_Desde              ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$Fecha_Hasta              ,   PDO::PARAM_STR);

        $stmt->execute();
        
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        
    }
    public function Get_Historia_de_Aprobacion($Fecha_Desde, $Fecha_Hasta, $Usuario_Busqueda)
    {
        self::set_names();
        $sql="  SELECT      consulta.Consulta                                                   as Consulta         , 
                            atencion.Fecha_Atencion                                             as F_Atencion       ,
                            atencion.Fecha_Cierra                                               as F_Cierre         ,
                            his_rechazo.Fecha_Rechazo                                           as F_Revision       ,
                            his_rechazo.Aprueba_Rechaza                                         as H_Tipo           ,
                            count(his_rechazo.id)                                               as Cantidad         ,
                            datediff( his_rechazo.Fecha_Rechazo , atencion.Fecha_Cierra   )     as Dif_Rev_Cierre   ,
                            datediff( his_rechazo.Fecha_Rechazo , atencion.Fecha_Atencion )     as Dif_Rev_Atencion 
                from his_rechazo
                inner join ate_consulta on ate_consulta.id  = his_rechazo.Consulta_Id
                inner join consulta     on consulta.id      = ate_consulta.Consulta_Id
                inner join atencion     on atencion.id      = ate_consulta.Atencion_Id
                GROUP BY    consulta.Consulta           ,
                            atencion.Fecha_Atencion     ,
                            atencion.Fecha_Cierra       ,
                            his_rechazo.Fecha_Rechazo   ,
                            his_rechazo.Aprueba_Rechaza ";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Fecha_Desde       ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Fecha_Hasta       ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$Usuario_Busqueda  ,   PDO::PARAM_STR);
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Llamados_Telefonicos()
    {
        self::set_names();
        $sql="SELECT  llamados.Usuario_Id , 
                      usuario.Nombre as Nombre, 
                      usuario.Apellido  as Apellido,  
                      count(llamados.id) as total 
              from llamados
              inner join usuario on usuario.id = llamados.Usuario_Id
              group by llamados.Usuario_Id";
        $stmt=$this->dbh->prepare($sql);
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
    public function Get_Llamados_Telefonicos_Fecha($Fecha_Desde, $Fecha_Hasta)
    {
        self::set_names();
        $sql="SELECT  llamados.Usuario_Id , 
                      usuario.Nombre as Nombre, 
                      usuario.Apellido  as Apellido,  
                      count(llamados.id) as total 
              from llamados
              inner join usuario on usuario.id = llamados.Usuario_Id
              where llamados.Fecha_Llamado BETWEEN ? and ?
              group by llamados.Usuario_Id";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Fecha_Desde              ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Fecha_Hasta              ,   PDO::PARAM_STR);
        if($stmt->execute())
        {
            while($row = $stmt->fetch())
            {
                $this->imp_informe[]=$row;
            }
            return $this->imp_informe;
            $this->dbh=null;
        }
    }
}
?>