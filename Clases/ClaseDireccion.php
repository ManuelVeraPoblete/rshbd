<?php
require_once("ClaseConeccion.php");
class Direccion extends  Coneccion
{
    private $dbh            ;    private $direccion    ;
    public function __construct()
    {
        $this->dbh=parent::conecta();
        $this->direcciondireccion  =   array();
    }
    private function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");    
    }
    /****************Personas***************/
    public function edit_direccion()
    {
        
        $id_persona=$_POST["id_persona"];
        self::set_names();
        $sql="UPDATE direccion SET
                     Unidad_Id          = ?     ,
                     Poblacion_Id       = ?     ,
                     Calle_Id           = ?     ,
                     Numero             = ?     ,
                     Block              = ?     ,
                     Departamento       = ?     ,
                     Casa               = ?     ,
                     Observacion        = ?     
            where
                    Persona_Id     =?";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Unidad_Id"]           ,   PDO::PARAM_STR) ;
        $stmt->bindValue(2,$_POST["Poblacion_Id"]        ,   PDO::PARAM_STR) ;
        $stmt->bindValue(3,$_POST["Calle_Id"]            ,   PDO::PARAM_STR) ;
        $stmt->bindValue(4,$_POST["Numero"]              ,   PDO::PARAM_STR) ;
        $stmt->bindValue(5,$_POST["Block"]               ,   PDO::PARAM_STR) ;
        $stmt->bindValue(6,$_POST["Departamento"]        ,   PDO::PARAM_STR) ;
        $stmt->bindValue(7,$_POST["Casa"]                ,   PDO::PARAM_STR) ;
        $stmt->bindValue(8,$_POST["Referencia"]          ,   PDO::PARAM_STR) ;
        $stmt->bindValue(9,$id_persona                   ,   PDO::PARAM_STR) ;
        $stmt->execute();
        $this->dbh=null;
        header("Location: Personas.php");exit;
    }
    public function add_direccion()
    {
        if(empty($_POST["Rut"]))
        {
            header("Location: AddDireccion.php?m=1");exit;
        }
        //insertar el registro en la tabla clientes
        self::set_names();
        $sql="INSERT INTO direccion 
              VALUES ( NULL , ?, ?, ?, ?,?,?,?,?,?,?);";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Unidad_Id"]           ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["Poblacion_Id"]        ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$_POST["Calle_Id"]            ,   PDO::PARAM_STR);
        $stmt->bindValue(4,$_POST["Numero"]              ,   PDO::PARAM_STR);
        $stmt->bindValue(5,$_POST["Block"]               ,   PDO::PARAM_STR);
        $stmt->bindValue(6,$_POST["Departamento"]        ,   PDO::PARAM_STR);
        $stmt->bindValue(7,$_POST["Casa"]                ,   PDO::PARAM_STR);
        $stmt->bindValue(8,$_POST["Observacion"]         ,   PDO::PARAM_STR);
        $stmt->bindValue(9,$_POST["Persona_Id"]          ,   PDO::PARAM_STR);
        $stmt->bindValue(10,$_POST["Activa"]             ,   PDO::PARAM_STR);
        $stmt->bindValue(11,$_POST["Fecha"]              ,   PDO::PARAM_STR);
        $stmt->execute();
        //$id=mysql_insert_id();
        $id= $this->dbh->lastInsertId();
        $this->dbh=null;
        header("Location: AddPersona.php?m=2");exit;
    }
    public function get_direccion($id)
    {
        self::set_names();
        $sql="SELECT direccion.*, 
                     unidad.Unidad as Nom_Unidad ,
                     poblacion.Poblacion as Nom_Poblacion,
                     calle.Calle as Nom_Calle
              FROM direccion 
              INNER JOIN unidad     on unidad.id    = direccion.Unidad_Id
              INNER JOIN poblacion  on poblacion.id = direccion.Poblacion_Id
              INNER JOIN calle      on calle.id     = direccion.Calle_Id
              WHERE Persona_id=?;";
        $stmt=$this->dbh->prepare($sql);
        if($stmt->execute( array($id) ) )
        {
            while($row = $stmt->fetch())
            {
                $this->direccion[]=$row;
            }
            return $this->direccion;
            $this->dbh=null;
        }
    }
    public function get_direccion_por_id($id)
    {
         if(isset($id))
        {
            self::set_names();
            $sql="SELECT * FROM direccion 
                  WHERE id=?;";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->direccion[]=$row;
                }
                return $this->direccion;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
}
?>