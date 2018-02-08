<?php
require_once("ClaseConeccion.php");
class Sector extends  Coneccion
{
    private $dbh            ;    private $sector    ;
    public function __construct()
    {
        $this->dbh=parent::conecta();
        $this->sector      =   array();
    }
    private function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");    
    }
    
    /****************Perfiles***************/
    public function edit_sector()
    {
        if(empty($_POST["Sector"]))         {
            header("Location: Sector.php?m=1&id=".$_POST["id"]);exit;
        }
        $id=$_POST["id"];
        self::set_names();
        $sql="UPDATE sector SET
                     Sector        =   ?       
            where
                     id     =?";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Sector"]         ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["id"]            ,   PDO::PARAM_STR);
        $stmt->execute();
        $this->dbh=null;
        header("Location: EditSector.php?m=2&id=".$_POST["id"]);exit;
    }
    public function add_sector()
    {
        if(empty($_POST["Sector"]) )
        {
            header("Location: AddSector.php?m=1");exit;
        }
        //insertar el registro en la tabla clientes
        self::set_names();
        $sql="INSERT INTO sector
                     values ( NULL , ?);";

        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Sector"]        ,   PDO::PARAM_STR);
        $stmt->execute();
        //$id=mysql_insert_id();
        $id= $this->dbh->lastInsertId();
        $this->dbh=null;
        header("Location: AddSector.php?m=2");exit;
    }
    public function get_sectores()
    {
        self::set_names();
        $sql="SELECT  sector.*  
              from sector;";
        foreach ($this->dbh->query($sql) as $row)
        {
            $this->sector[]=$row;
        }  
        return $this->sector;
        $this->dbh=null;
    }
    public function get_sector_por_id($id)
    {
         if(isset($id))
        {
            self::set_names();
            $sql="SELECT * FROM sector
                  WHERE id=?;";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->sector[]=$row;
                }
                return $this->sector;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
    /*************Fin Sector***************/
}
?>