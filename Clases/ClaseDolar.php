<?php
require_once("ClaseConeccion.php");
class Dolar extends  Coneccion
{
    private $dbh            ;
    private $dolar      ;
    
    
    public function __construct()
    {
        $this->dbh=parent::conecta();
        $this->dolar        =   array();
    }
    private function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");    
    }
    /****************dolar***************/
    public function edit_dolar()
    {
        if(empty($_POST["Valor"]))
        {
            header("Location: EditDolar.php?m=1&id=".$_POST["id"]);exit;
        }
        
        $id=$_POST["id"];
        
        
        self::set_names();
        
        $sql="UPDATE dolar SET
                     Fecha          =   ?       ,
                     Valor          =   ?       
            where
                     id     =?";


            $stmt=$this->dbh->prepare($sql);
                     
            $stmt->bindValue(1,$_POST["Fecha"]    ,   PDO::PARAM_STR);
            $stmt->bindValue(2,$_POST["Valor"]    ,   PDO::PARAM_STR);
            $stmt->bindValue(3,$_POST["id"]       ,   PDO::PARAM_STR);
              
        
        $stmt->execute();

        $this->dbh=null;

        header("Location: EditDolar.php?m=2&id=".$_POST["id"]);exit;
    }
    public function add_dolar()
    {
        if(empty($_POST["Valor"]))
        {
            header("Location: AddDolar.php?m=1");exit;
        }
        //insertar el registro en la tabla clientes
        self::set_names();

        $sql="INSERT INTO dolar 
                     values ( NULL , ?, ?);
        ";

        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Fecha"]        ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["Valor"]          ,   PDO::PARAM_STR);
        
      
        $stmt->execute();
        //$id=mysql_insert_id();
        $id= $this->dbh->lastInsertId();

        $this->dbh=null;

        header("Location: AddDolar.php?m=2");exit;

    }

    public function get_dolares()
    {
        self::set_names();
        $sql="SELECT  dolar.* 
              from dolar
              ";
        foreach ($this->dbh->query($sql) as $row)
            {
                $this->dolar[]=$row;
            }  
            return $this->dolar;
            $this->dbh=null;
    }
    public function get_dolar_por_id($id)
    {
         if(isset($id))
        {
            self::set_names();
            $sql="SELECT * FROM dolar 
                  WHERE id=?;";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->dolar[]=$row;
                }
                return $this->dolar;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
    /*************Fin Dolar***************/
}
?>