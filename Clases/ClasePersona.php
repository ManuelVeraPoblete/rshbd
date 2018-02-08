<?php
require_once("ClaseConeccion.php");
class Persona extends  Coneccion
{
    private $dbh            ;    private $persona    ;
    public function __construct()
    {
        $this->dbh=parent::conecta();
        $this->persona  =   array();
    }
    private function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");    
    }
    /****************Personas***************/
    public function edit_persona()
    {
        if(empty($_POST["Rut"]) )
        {
            header("Location: EditPersona.php?m=1&id=".$_POST["id"]);exit;
        }
        $id=$_POST["id"];

        self::set_names();
        $sql="UPDATE persona SET
                     Rut            =   ?       ,
                     Nombre         =   ?       ,
                     Apellido       =   ?       ,
                     Telefono       =   ?       
                     
            where
                     id     =?";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Rut"]              ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["Nombre"]           ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$_POST["Apellido"]         ,   PDO::PARAM_STR);
        $stmt->bindValue(4,$_POST["Telefono"]         ,   PDO::PARAM_STR);
        $stmt->bindValue(5,$_POST["id"]               ,   PDO::PARAM_STR);
        $stmt->execute();
        $this->dbh=null;

       
        
        header("Location: EditPersona.php?m=2&id=".$_POST["id"]);exit;
    }
    public function add_persona()
    {
        if(empty($_POST["Rut"]))
        {
            header("Location: AddPersona.php?m=1");exit;
        }
        //insertar el registro en la tabla clientes
        self::set_names();
        $sql="INSERT INTO persona 
              VALUES ( NULL , ?, ?, ?, ?);";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Rut"]              ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["Nombre"]           ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$_POST["Apellido"]         ,   PDO::PARAM_STR);
        $stmt->bindValue(4,$_POST["Telefono"]         ,   PDO::PARAM_STR);
        
        $stmt->execute();
        //$id=mysql_insert_id();
        $id= $this->dbh->lastInsertId();
        $this->dbh=null;
        header("Location: AddPersona.php?m=2");exit;
    }
    public function get_persona()
    {
        self::set_names();
        $sql="SELECT  persona.* 
              from persona";

        foreach ($this->dbh->query($sql) as $row)
    		{
    			$this->persona[]=$row;
    		}  
            return $this->persona;
			$this->dbh=null;
    }

    public function get_persona_por_id($id)
    {
         if(isset($id))
        {
            self::set_names();
            $sql="SELECT * FROM persona 
                  WHERE id=?;";
            $stmt=$this->dbh->prepare($sql);


           if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->persona[]=$row;
                }
                return $this->persona;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
    public function get_persona_por_rut_atencion($rut)
    {
         if(isset($rut))
        {
            self::set_names();

            $sql="SELECT atencion.id as num_ate,
                         ate_consulta.Estado_Consulta ,
                         atencion.Estado_Atencion as Est_Ate
                  from ate_consulta
                  inner join atencion on atencion.id = ate_consulta.Atencion_Id
                  inner join persona  on persona.id  = atencion.Persona_Id
                  where persona.rut = ? and ate_consulta.Estado_Consulta = 7
                  GROUP BY atencion.id";
            $stmt=$this->dbh->prepare($sql);
           if($stmt->execute( array($rut) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->persona[]=$row;
                }
                return $this->persona;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
    public function get_persona_por_rut($rut)
    {
         if(isset($rut))
        {
            self::set_names();

            $sql="SELECT persona.* 
                  FROM   persona
                  WHERE Rut = ?"; 
            $stmt=$this->dbh->prepare($sql);
           if($stmt->execute( array($rut) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->persona[]=$row;
                }
                return $this->persona;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
    public function get_persona_por_id_atencion($id)
    {
        if(isset($id))
        {
            self::set_names();
            $sql="SELECT persona.* , atencion.Persona_Id, atencion.Estado_Atencion , atencion.id as num_ate
                  FROM   persona
                  LEFT JOIN atencion ON atencion.Persona_Id      = persona.id 
                  WHERE atencion.id = ?;" ;
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->persona[]=$row;
                }
                return $this->persona;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }

    
}

?>