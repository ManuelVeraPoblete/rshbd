<?php
require_once("ClaseConeccion.php");
class Autoriza extends  Coneccion
{
    private $dbh            ;    private $autoriza    ;
    public function __construct()
    {
        $this->dbh=parent::conecta();
        $this->autoriza     =   array();
    }
    private function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");    
    }
    /****************Firma*******************/
    public function edit_autoriza()
    {
        if(empty($_POST["Nombre"]))
        {
            header("Location: EditAutoriza.php?m=1&id=".$_POST["id"]);exit;
        }
        $id=$_POST["id"];
        self::set_names();
        $sql="UPDATE autoriza SET
                     Nombre        =   ?       ,
                     Cargo          =   ?       ,
                     Activo         =   ?
            where
                     id     =?";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Nombre"]        ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["Cargo"]          ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$_POST["Activo"]         ,   PDO::PARAM_STR);
        $stmt->bindValue(4,$_POST["id"]             ,   PDO::PARAM_STR);
        $stmt->execute();
        $this->dbh=null;
        header("Location: EditAutoriza.php?m=2&id=".$_POST["id"]);exit;
    }
    public function add_autoriza()
    {
        if(empty($_POST["Nombre"]))
        {
            header("Location: EditAutoriza.php?m=1");exit;
        }
        //insertar el registro en la tabla clientes
        self::set_names();

        $sql="INSERT INTO autoriza 
                     values ( NULL , ?, ?, ?);
        ";

        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Nombre"]        ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["Cargo"]          ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$_POST["Activo"]         ,   PDO::PARAM_STR);
      
        $stmt->execute();
        //$id=mysql_insert_id();
        $id= $this->dbh->lastInsertId();

        $this->dbh=null;

        header("Location: AddAutoriza.php?m=2");exit;

    }

    public function get_autorizas()
    {
        self::set_names();
        $sql="SELECT  autoriza.* 
              from autoriza
              ";
        foreach ($this->dbh->query($sql) as $row)
            {
                $this->autoriza[]=$row;
            }  
            return $this->autoriza;
            $this->dbh=null;
    }
    public function get_autoriza_por_id($id)
    {
         if(isset($id))
        {
            self::set_names();
            $sql="SELECT * FROM autoriza 
                  WHERE id=?;";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->autoriza[]=$row;
                }
                return $this->autoriza;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
    /*************Fin Firma***************/
}
?>