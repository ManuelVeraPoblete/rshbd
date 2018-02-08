<?php
require_once("ClaseConeccion.php");
class Atencion extends  Coneccion
{
    private $dbh            ;    private $hojaruta    ;
    public function __construct()
    {
        $this->dbh=parent::conecta();
        $this->hojaruta  =   array();
    }
    private function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");    
    }

    public function get_genera_hoja( $Movimiento, $Fecha_Desde )
    {
        
            self::set_names();
            $sql="SELECT atencion.persona_id        , 
                         persona.Rut                ,
                         persona.Nombre             , 
                         persona.Apellido           ,
                         sector.id                  , 
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
                         hoja_detalle.id
                  FROM atencion
                  Inner Join persona        on persona.id                   =  atencion.persona_id
                  Inner Join direccion      on direccion.Persona_Id         =  persona.id
                  Inner Join unidad         on direccion.Unidad_Id          =  unidad.id 
                  Inner Join sector         on sector.id                    =  unidad.sector_id
                  Inner Join poblacion      on direccion.Poblacion_Id       =  poblacion.id
                  Inner Join calle          on direccion.Calle_Id           =  calle.id
                  inner Join ate_consulta   on ate_consulta.Atencion_Id     =  atencion.id
                  inner Join consulta       on ate_consulta.Consulta_Id     =  consulta.id
                  Left  Join hoja_detalle   on hoja_detalle.Persona_Id      =  atencion.Persona_Id
                  where atencion.Estado_Atencion              = 2            and
                        atencion.Estado_Revisora              = 6            and
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