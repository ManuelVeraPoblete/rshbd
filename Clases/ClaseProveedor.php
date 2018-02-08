<?php
require_once("ClaseConeccion.php");
class Proveedor extends  Coneccion
{
    private $dbh    ;    private $Proveedor     ;
    
    public function __construct()
    {
        $this->dbh=parent::conecta();
        $this->proveedor    =   array();
   
    }
    private function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");    
    }
   
    
    /****************Proveedores***************/
    public function edit_proveedor()
    {
        if(empty($_POST["Nombre"]) )
        {
            header("Location: EditProveedor.php?m=1&id=".$_POST["id"]);exit;
        }
        $id=$_POST["id"];
        self::set_names();
        $sql="UPDATE proveedor SET
                     Nombre        =   ?       ,
                     Direccion     =   ?       ,
                     Rut           =   ?       ,
                     Fono_1        =   ?       ,
                     Fono_2        =   ?       ,
                     Email         =   ?       ,
                     Contacto      =   ?       ,
                     Rubro         =   ?
            where
                     id     =?";
            $stmt=$this->dbh->prepare($sql);
            $stmt->bindValue(1,$_POST["Nombre"]         ,   PDO::PARAM_STR);
            $stmt->bindValue(2,$_POST["Direccion"]      ,   PDO::PARAM_STR);
            $stmt->bindValue(3,$_POST["Rut"]            ,   PDO::PARAM_STR);
            $stmt->bindValue(4,$_POST["Fono_1"]          ,   PDO::PARAM_STR);
            $stmt->bindValue(5,$_POST["Fono_2"]          ,   PDO::PARAM_STR);
            $stmt->bindValue(6,$_POST["Email"]          ,   PDO::PARAM_STR);
            $stmt->bindValue(7,$_POST["Contacto"]       ,   PDO::PARAM_STR);
            $stmt->bindValue(8,$_POST["Rubro"]          ,   PDO::PARAM_STR);
            $stmt->bindValue(9,$_POST["id"]             ,   PDO::PARAM_STR);
        $stmt->execute();
        $this->dbh=null;
        header("Location: EditProveedor.php?m=2&id=".$_POST["id"]);exit;
    }
    public function add_proveedor()
    {
        if(empty($_POST["Nombre"]))
        {
            header("Location: AddProveedor.php?m=1");exit;
        }
        //insertar el registro en la tabla clientes
        self::set_names();

        $sql="INSERT INTO proveedor 
                     values ( NULL , ?, ?, ?, ?, ?, ?, ?, ?);
        ";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Nombre"]         ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["Direccion"]      ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$_POST["Rut"]            ,   PDO::PARAM_STR);
        $stmt->bindValue(4,$_POST["Fono_1"]          ,   PDO::PARAM_STR);
        $stmt->bindValue(5,$_POST["Fono_2"]          ,   PDO::PARAM_STR);
        $stmt->bindValue(6,$_POST["Email"]          ,   PDO::PARAM_STR);
        $stmt->bindValue(7,$_POST["Contacto"]       ,   PDO::PARAM_STR);
        $stmt->bindValue(8,$_POST["Rubro"]          ,   PDO::PARAM_STR);
        $stmt->execute();
        $id= $this->dbh->lastInsertId();
        $this->dbh=null;
        header("Location: AddProveedor.php?m=2");exit;
    }
     public function get_proveedor()
    {
        self::set_names();
        $sql="SELECT  proveedor.* 
              from proveedor;";
        foreach ($this->dbh->query($sql) as $row)
            {
                $this->proveedor[]=$row;
            }  
            return $this->proveedor;
            $this->dbh=null;
    }
    public function get_proveedor_por_id($id)
    {
         if(isset($id))
        {
            self::set_names();
            $sql="SELECT * FROM proveedor 
                  WHERE id=?;";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->proveedor[]=$row;
                }
                return $this->proveedor;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
/*************Fin Proveedores***************/
}
?>