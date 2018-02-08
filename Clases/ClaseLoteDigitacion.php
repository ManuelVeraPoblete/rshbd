<?php
require_once("ClaseConeccion.php");
class LoteDigitacion extends  Coneccion
{
    private $dbh      ;    
    private $lotedigitacion    ;
    public function __construct()
    {
        $this->dbh=parent::conecta();
        $this->lotedigitacion      =   array();
    }
    private function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");    
    }
    /****************Perfiles***************/
    public function add_lote_encabezado()
    {
        self::set_names();
        $sql="INSERT INTO lote_cabeza
                     values ( NULL , ?, ?, ?, NULL, NULL);";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Numero_Lote"]        ,   PDO::PARAM_STR) ;
        $stmt->bindValue(2,$_POST["Fecha_Lote"]         ,   PDO::PARAM_STR) ;
        $stmt->bindValue(3,$_POST["Usuario_Id"]         ,   PDO::PARAM_STR) ;
        $stmt->execute();
        $ultimo_id= $this->dbh->lastInsertId();
        return $ultimo_id;
    }
    public function add_lote_detalle($Registro, $Lote)
    {
        
        self::set_names();
        $sql="INSERT INTO lote_detalle
                     values ( NULL , ?, ?, NULL, NULL);";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Lote         ,   PDO::PARAM_STR) ;
        $stmt->bindValue(2,$Registro     ,   PDO::PARAM_STR) ;
        $stmt->execute();

        return ;
    }

    public function get_lote_por_id($id)
    {
        if(isset($id))
        {
            self::set_names();
            $sql="SELECT lote_cabeza.id ,
                         lote_cabeza.Numero_Lote,
                         lote_cabeza.Fecha,
                         lote_detalle.id                as Ld_id,
                         lote_detalle.Lote_Cabeza_Id,
                         lote_detalle.Numero_Registro,
                         lote_detalle.Estado_Detalle_Id as Est_Detalle_Id,
                         estado_lote.Estado_Lote        as Est_Detalle,
                         lote_detalle.Fecha_Detalle,
                         usuario.id                     as Usr_Id,
                         usuario.Nombre,
                         usuario.Apellido
                  FROM lote_cabeza
                  left JOIN usuario      ON usuario.id                     = lote_cabeza.Usuario_Id
                  left JOIN lote_detalle ON lote_detalle.Lote_Cabeza_Id    = lote_cabeza.id
                  left join estado_lote  on lote_detalle.Estado_Detalle_Id = estado_lote.id
                  where lote_cabeza.id = ?";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->lotedigitacion[]=$row;
                }
                return $this->lotedigitacion;
                $this->dbh=null;
            }
        }
    }
    public function get_numero_requerimiento($Numero_Requerimiento)
    {
        if(isset($Numero_Requerimiento))
        {
            self::set_names();
            $sql="SELECT  lote_detalle.id                           ,
                          lote_detalle.Lote_Cabeza_Id               ,
                          lote_detalle.Numero_Registro              ,
                          lote_detalle.Estado_Detalle_Id            ,
                          lote_detalle.Fecha_Detalle                ,
                          atencion.id               as Atencion_Id  ,
                          lote_cabeza.Numero_Lote   as Numero_Lote  ,
                          lote_cabeza.Fecha         as Fecha_Lote
                  from lote_detalle
                  INNER JOIN atencion       on atencion.Numero_Solicitud = lote_detalle.Numero_Registro
                  INNER JOIN lote_cabeza    on lote_cabeza.id            = lote_detalle.Lote_Cabeza_Id
                  WHERE lote_detalle.Numero_Registro = ?"; 
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($Numero_Requerimiento) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->lotedigitacion[]=$row;
                }
                return $this->lotedigitacion;
                $this->dbh=null;
            }
        }
    }
    public function get_ultimo_lote()
    {
        self::set_names();
        $sql="SELECT max(lote_cabeza.Numero_Lote) as ultimo from lote_cabeza";
        $stmt=$this->dbh->prepare($sql);
        foreach ($this->dbh->query($sql) as $row)
            {
                $this->lotedigitacion[]=$row;
            }  
            return $this->lotedigitacion;
            $this->dbh=null;
    }

    public function Elimina_Lote_Por_Id($id)
    {
        if(isset($id))
        {
            self::set_names();
            $sql="DELETE FROM lote_detalle WHERE lote_detalle.id = ?";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->lotedigitacion[]=$row;
                }
                return $this->lotedigitacion;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
    public function Cambia_Estado_Lote_Id($id, $Estado)
    {
        if(isset($id))
        {
            $Fecha_Actual =  date("Y-m-d");
            self::set_names();
            $sql="UPDATE lote_cabeza SET Estado_Lote_Id= ?,
                                        Fecha_Estado = ?
                  WHERE id=? ";
            $stmt=$this->dbh->prepare($sql);
            $stmt->bindValue(1,$Estado         ,   PDO::PARAM_STR) ;
            $stmt->bindValue(2,$Fecha_Actual   ,   PDO::PARAM_STR) ;
            $stmt->bindValue(3,$id             ,   PDO::PARAM_STR) ;
            $stmt->execute();
            return ;
        }else
        {
            header("Location: error.php");
        }
    }
    public function Cambia_Estado_Lote_Detalle_Id($id, $Estado)
    {
        if(isset($id))
        {
            $Fecha_Actual =  date("Y-m-d");
            self::set_names();
            $sql="UPDATE lote_detalle SET Estado_Detalle_Id= ?,
                                          Fecha_Detalle = ?
                  WHERE id=? ";
            $stmt=$this->dbh->prepare($sql);
            $stmt->bindValue(1,$Estado         ,   PDO::PARAM_STR) ;
            $stmt->bindValue(2,$Fecha_Actual   ,   PDO::PARAM_STR) ;
            $stmt->bindValue(3,$id             ,   PDO::PARAM_STR) ;
            $stmt->execute();
            return ;
        }else
        {
            header("Location: error.php");
        }
    }
    public function Cambia_Estado_Lote_Detalle_Id_C($id, $Estado)
    {
        if(isset($id))
        {
            $Fecha_Actual =  date("Y-m-d");
            self::set_names();
            $sql="UPDATE lote_detalle SET Estado_Detalle_Id= ?,
                                          Fecha_Detalle = ?
                  WHERE Lote_Cabeza_Id = ? ";
            $stmt=$this->dbh->prepare($sql);
            $stmt->bindValue(1,$Estado         ,   PDO::PARAM_STR) ;
            $stmt->bindValue(2,$Fecha_Actual   ,   PDO::PARAM_STR) ;
            $stmt->bindValue(3,$id             ,   PDO::PARAM_STR) ;
            $stmt->execute();
            return ;
        }else
        {
            header("Location: error.php");
        }
    }
}
?>