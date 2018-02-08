<?php
require_once("ClaseConeccion.php");
class Atencion extends  Coneccion
{
    private $dbh            ;    private $atencion    ;
    public function __construct()
    {
        $this->dbh=parent::conecta();
        $this->atencion  =   array();
    }
    private function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");    
    }
    /****************Usuarios***************/
    public function edit_atencion()
    {
        
        $id=$_POST["id"];
        self::set_names();
        $sql="UPDATE atencion SET
                     Usuario_iD         =   ?       ,
                     Persona_Id         =   ?       ,
                     Fecha_Atencion     =   ?       ,
                     Hora_Atencion      =   ?       ,
                     Observacion        =   ?       ,
                     Folio_Rsh          =   ?       ,
                     Numero_Solicitud   =   ?       ,
                     Estado_Atencion    =   ?       ,
                     Estado_Revisora    =   ?       ,
                     Fecha_Cita         =   ?       ,
                     Usuario_Cierra     =   ?       ,
                     Fecha_Cierra       =   ?
            where
                     id     =?";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Usuario_Id"]         ,    PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["Persona_Id"]         ,    PDO::PARAM_STR);
        $stmt->bindValue(3,$_POST["Fecha_Atencion"]     ,    PDO::PARAM_STR);
        $stmt->bindValue(4,$_POST["Hora_Atencion"]      ,    PDO::PARAM_STR);
        $stmt->bindValue(5,$_POST["Observacion"]        ,    PDO::PARAM_STR);
        $stmt->bindValue(6,$_POST["Folio_Rsh"]          ,    PDO::PARAM_STR);
        $stmt->bindValue(7,$_POST["Numero_Solicitud"]   ,    PDO::PARAM_STR);
        $stmt->bindValue(8,$_POST["Estado_Atencion"]    ,    PDO::PARAM_STR);
        $stmt->bindValue(9,$_POST["Estado_Revisora"]    ,    PDO::PARAM_STR);
        $stmt->bindValue(10,$_POST["Fecha_Cita"]        ,    PDO::PARAM_STR);
        $stmt->bindValue(11,$_POST["Usuario_Cierra"]    ,    PDO::PARAM_STR);
        $stmt->bindValue(12,$_POST["Fecha_Cierra"]      ,    PDO::PARAM_STR);
        $stmt->bindValue(13,$_POST["id"]                ,    PDO::PARAM_STR);
        $stmt->execute();
        $this->dbh=null;
        //header("Location: Atencion.php");exit;
    }
    public function aprueba_atencion($id)
    {
        
        self::set_names();
        $sql="UPDATE atencion SET
                     Estado_Revisora    =   '6'
            where
                     id     =?";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$id         ,    PDO::PARAM_STR);
        $stmt->execute();
        $this->dbh=null;
        header("Location: Revisa_Atencion.php");exit;
    }
    public function aprueba_consulta($id,$Atencion,$Usuario_Id)
    {
        
        self::set_names();
        $sql="UPDATE ate_consulta SET
                     Estado_Consulta    =   '6'
            where
                     id     =?";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$id         ,    PDO::PARAM_STR);
        $stmt->execute();
        

        $Fecha_Actual =  date("Y-m-d");
        $Rechaza = 2 ;

        self::set_names();
        $sql="INSERT INTO his_rechazo
              VALUES ( NULL , ?, ?, ?, ?);";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Fecha_Actual         ,    PDO::PARAM_STR);
        $stmt->bindValue(2,$Usuario_Id           ,    PDO::PARAM_STR);
        $stmt->bindValue(3,$id                   ,    PDO::PARAM_STR);
        $stmt->bindValue(4,$Rechaza              ,    PDO::PARAM_STR);
        $stmt->execute();


        $this->dbh=null;
        header("Location: Revisa_Atencion.php");exit;
    }
    public function rechaza_consulta($id,$Atencion,$Usuario_Id)
    {

        self::set_names();
        $sql="UPDATE ate_consulta SET
                     Estado_Consulta    =   '4'
            where
                     id     =?";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$id         ,    PDO::PARAM_STR);
        $stmt->execute();
        $sql="UPDATE atencion SET Estado_Atencion  = '1'
              where  id     =?";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Atencion         ,    PDO::PARAM_STR);
        $stmt->execute();
        $Fecha_Actual =  date("Y-m-d");
        $Rechaza = 1 ;
        self::set_names();
        $sql="INSERT INTO his_rechazo
              VALUES ( NULL , ?, ?, ?, ?);";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Fecha_Actual         ,    PDO::PARAM_STR);
        $stmt->bindValue(2,$Usuario_Id           ,    PDO::PARAM_STR);
        $stmt->bindValue(3,$id                   ,    PDO::PARAM_STR);
        $stmt->bindValue(4,$Rechaza              ,    PDO::PARAM_STR);
        $stmt->execute();
        $this->dbh=null;
        header("Location: Revisa_Atencion.php");exit;
    }
    public function Cambia_Estado_Atencion($esta,$ate)
    {
        self::set_names();
        $sql="UPDATE atencion SET
                     Estado_Atencion = ? 
              WHERE  id = ?";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$esta         ,    PDO::PARAM_STR);
        $stmt->bindValue(2,$ate          ,    PDO::PARAM_STR);
        $stmt->execute();
        $this->dbh=null;
        return;
    }
    public function rechaza_atencion($id)
    {
        self::set_names();
        $sql="UPDATE atencion SET
                     Estado_Atencion    =   '1'
            where
                     id     =?";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$id         ,    PDO::PARAM_STR);
        $stmt->execute();
        $this->dbh=null;
        header("Location: Revisa_Atencion.php");exit;
    }
    public function add_atencion()
    {
        if(empty($_POST["Usuario_Id"]))
        {
            header("Location: Atencion.php");exit;
        }
        //insertar el registro en la tabla clientes
        self::set_names();
        $sql="INSERT INTO atencion
              VALUES ( NULL , ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Usuario_Id"]         ,    PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["Persona_Id"]         ,    PDO::PARAM_STR);
        $stmt->bindValue(3,$_POST["Fecha_Atencion"]     ,    PDO::PARAM_STR);
        $stmt->bindValue(4,$_POST["Hora_Atencion"]      ,    PDO::PARAM_STR);
        $stmt->bindValue(5,$_POST["Observacion"]        ,    PDO::PARAM_STR);
        $stmt->bindValue(6,$_POST["Folio_Rsh"]          ,    PDO::PARAM_STR);
        $stmt->bindValue(7,$_POST["Numero_Solicitud"]   ,    PDO::PARAM_STR);
        $stmt->bindValue(8,$_POST["Estado_Atencion"]    ,    PDO::PARAM_STR);
        $stmt->bindValue(9,$_POST["Estado_Revisora"]    ,    PDO::PARAM_STR);
        $stmt->bindValue(10,$_POST["Fecha_Cita"]        ,    PDO::PARAM_STR);
        $stmt->bindValue(11,$_POST["Usuario_Cierra"]    ,    PDO::PARAM_STR);
        $stmt->bindValue(12,$_POST["Fecha_Cierra"]      ,    PDO::PARAM_STR);
        $stmt->execute();
        //$id=mysql_insert_id();
        $id= $this->dbh->lastInsertId();
        $this->dbh=null;
        header("Location: Atencion.php");exit;
    }
    public function get_atencion_por_id($id)
    {
       
        if(isset($id))
        {
            self::set_names();
            $sql="SELECT     atencion.*, 
                             consulta.Consulta ,
                             usuario.Nombre ,
                             usuario.Apellido
                  FROM atencion 
                  Inner Join ate_consulta on ate_consulta.Atencion_Id = atencion.id
                  inner join consulta     on consulta.id              = ate_consulta.Consulta_Id
                  inner join usuario      on usuario.id               = atencion.Usuario_Id
                  WHERE atencion.id=?;";
           $stmt=$this->dbh->prepare($sql);
           if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->atencion[]=$row;
                }
                return $this->atencion;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
    public function get_atenciones_requerimientos($Requerimiento)
    {
       
        if(isset($Requerimiento))
        {
            self::set_names();

            $sql="SELECT  atencion.*
                  FROM    atencion 
                  WHERE   atencion.Numero_Solicitud=?;";
           $stmt=$this->dbh->prepare($sql);
           if($stmt->execute( array($Requerimiento) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->atencion[]=$row;
                }
                return $this->atencion;
                $this->dbh=null;
            }
        }else
        {
            header("Location: errorIA.php");
        }
    }
    public function get_atencion_por_persona($id)
    {
        if(isset($id))
        {
            self::set_names();
            $sql="SELECT     atencion.*, 
                             consulta.Consulta ,
                             usuario.Nombre ,
                             usuario.Apellido,
                             usr_cierra.Nombre       as Nombre_Cierra,
                             usr_cierra.Apellido     as Apellido_Cierra,
                             est_ate.Estado_Atencion as est_ate ,
                             estado.Estado_Atencion  as est_revi,
                             his_rechazo.Fecha_Rechazo ,
                             usr_apr.Nombre          as Nom_Apr,
                             usr_apr.Apellido        as Ape_Apr,
                             DATEDIFF( his_rechazo.Fecha_Rechazo , atencion.Fecha_Atencion )  as dif_A_A ,
                             DATEDIFF( his_rechazo.Fecha_Rechazo , atencion.Fecha_Cierra )    as dif_A_C 

                  FROM atencion 
                  Inner Join ate_consulta              on ate_consulta.Atencion_Id     = atencion.id
                  inner join consulta                  on consulta.id                  = ate_consulta.Consulta_Id
                  inner join usuario                   on usuario.id                   = atencion.Usuario_Id
                  left  join usuario  as usr_cierra    on usr_cierra.id                = atencion.Usuario_Cierra
                  inner join estado                    on ate_consulta.Estado_Consulta = estado.id
                  inner join estado as est_ate         on est_ate.id = ate_consulta.Estado_Consulta
                  left  join his_rechazo               on his_rechazo.Consulta_Id = ate_consulta.id
                  left  join usuario as usr_apr        on usr_apr.id = his_rechazo.Usuario_Id
                  WHERE atencion.Persona_Id=?;";
           $stmt=$this->dbh->prepare($sql);
           if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->atencion[]=$row;
                }
                return $this->atencion;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
    public function get_atencion_pendiente_id($id)
    {
        if(isset($id))
        {
            self::set_names();
            $sql="SELECT     atencion.*, 
                             consulta.Consulta ,
                             usuario.Nombre ,
                             usuario.Apellido
                  FROM atencion 
                  Inner Join ate_consulta on ate_consulta.Atencion_Id = atencion.id
                  inner join consulta     on consulta.id              = ate_consulta.Consulta_Id
                  inner join usuario      on usuario.id               = atencion.Usuario_Id
                  WHERE Persona_Id=? and Estado_Atencion = '1' ";
           $stmt=$this->dbh->prepare($sql);
           if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->atencion[]=$row;
                }
                return $this->atencion;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }

    public function get_ate_consulta($id)
    {
        if(isset($id))
        {
         
            self::set_names();
            $sql="SELECT     ate_consulta.*
                  FROM ate_consulta 
                  WHERE ate_consulta.Atencion_Id=?";
           $stmt=$this->dbh->prepare($sql);
  
           if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->atencion[]=$row;
                }
                return $this->atencion;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
    public function get_ate_programa($id)
    {
        if(isset($id))
        {
            self::set_names();
            $sql="SELECT     ate_programa.*
                  FROM  ate_programa
                  WHERE ate_programa.Atencion_Id=?";
                  
           $stmt=$this->dbh->prepare($sql);
           if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->atencion[]=$row;
                }
                return $this->atencion;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
    public function get_genera_hoja( $Movimiento, $Fecha_Desde )
    {
            self::set_names();
            $sql="SELECT atencion.Persona_id        , 
                         persona.Rut                ,
                         persona.Nombre             , 
                         persona.Apellido           ,
                         sector.id   as sector_id   , 
                         sector.Sector              ,
                         unidad.id                  , 
                         unidad.Unidad              ,
                         poblacion.id               , 
                         poblacion.Poblacion        ,
                         calle.id                   , 
                         calle.Calle                ,
                         consulta.Resumen           , 
                         atencion.Fecha_atencion    ,
                         direccion.Numero           , 
                         persona.Telefono           ,
                         hoja_detalle.id            ,
                         atencion.id    as atencion_id 
                  FROM atencion
                  Inner Join persona        on persona.id                   =  atencion.Persona_Id
                  Inner Join direccion      on direccion.Persona_Id         =  persona.id
                  Inner Join unidad         on direccion.Unidad_Id          =  unidad.id 
                  Inner Join sector         on sector.id                    =  unidad.sector_id
                  Inner Join poblacion      on direccion.Poblacion_Id       =  poblacion.id
                  Inner Join calle          on direccion.Calle_Id           =  calle.id
                  inner Join ate_consulta   on ate_consulta.Atencion_Id     =  atencion.id
                  inner Join consulta       on ate_consulta.Consulta_Id     =  consulta.id
                  Left  Join hoja_detalle   on hoja_detalle.Persona_Id      =  atencion.Persona_Id
                  where atencion.Estado_Atencion              = 2            and
                        ate_consulta.Estado_Consulta          = 6            and
                        ate_consulta.Consulta_id              = $Movimiento  and
                        atencion.fecha_Cierra                >= $Fecha_Desde and 
                        atencion.generada                     = 'N'                 
                  GROUP BY persona.rut
                  ORDER BY sector.id            , 
                           unidad.id            ,
                           poblacion.id         , 
                           calle.id             ,
                           direccion.Numero     ";
           foreach ($this->dbh->query($sql) as $row)
           {
              $this->atencion[]=$row;
           }  
           return $this->atencion;
           $this->dbh=null;
    }
    public function get_ate_documento($id)
    {
        if(isset($id))
        {
            self::set_names();
            $sql="SELECT     ate_documentos.*
                  FROM  ate_documentos
                  WHERE ate_documentos.Atencion_Id=?";
                  
           $stmt=$this->dbh->prepare($sql);
           if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->atencion[]=$row;
                }
                return $this->atencion;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
    public function get_ultima_hoja()
    {
        self::set_names();
        $sql="SELECT  hojas_generadas.id                ,
                      hojas_generadas.Fecha_Generada    ,
                      hojas_generadas.Numero_Generado   ,
                      hojas_generadas.Numero_Final      ,
                      hojas_generadas.Consulta_Id  
              from hojas_generadas
              Order By hojas_generadas.id desc limit 1";
        foreach ($this->dbh->query($sql) as $row)
        {
            $this->atencion[]=$row;
        }  
        return $this->atencion;
        $this->dbh=null;
    }
}
?>