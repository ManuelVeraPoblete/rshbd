<?php
require_once("ClaseConeccion.php");
class Llamados extends  Coneccion
{
    private $dbh            ;    private $llamados    ;
    public function __construct()
    {
        $this->dbh=parent::conecta();
        $this->llamados      =   array();
    }
    private function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");    
    }
    
    public function genera_llamado_persona_no_existe(){
        //insertar el registro en la tabla Personas
        self::set_names();
        //-------------------- Persona Direccion ---------------//
        $sql="INSERT INTO persona 
              VALUES ( NULL , ?, ?, ?, ?);";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Rut"]              ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["Nombre"]           ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$_POST["Apellido"]         ,   PDO::PARAM_STR);
        $stmt->bindValue(4,$_POST["Telefono"]         ,   PDO::PARAM_STR);
        $stmt->execute();
        $id_persona= $this->dbh->lastInsertId();
        $Activa = '1';
        $Fecha = date("Y-m-d");
        // Insertar Registro en Tabla de Direcciones
        $sql="INSERT INTO direccion 
              VALUES ( NULL , ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
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
        $stmt->bindValue(10,$Activa                      ,   PDO::PARAM_STR) ;
        $stmt->bindValue(11,$Fecha                       ,   PDO::PARAM_STR) ;
        $stmt->execute();
        //-------------------- Fin -------------------------------//
    
        //-------------------- Llamado  --------------------------//
        $sql="INSERT INTO llamados 
              VALUES ( NULL , ?, ?, ?, ? );";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Fecha                           ,   PDO::PARAM_STR) ;
        $stmt->bindValue(2,$_POST["id_usuario_act"]         ,   PDO::PARAM_STR) ;
        $stmt->bindValue(3,$id_persona                      ,   PDO::PARAM_STR) ;
        $stmt->bindValue(4,$_POST["Respuesta"]              ,   PDO::PARAM_STR) ;
        $stmt->execute();
        //-------------------- Fin -------------------------------//
    }

    public function genera_llamado_persona_existe(){
        
        self::set_names();
        $Fecha = date("Y-m-d");
        //-------------------- Llamado  --------------------------//
        $sql="INSERT INTO llamados 
              VALUES ( NULL , ?, ?, ?, ? );";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Fecha                           ,   PDO::PARAM_STR) ;
        $stmt->bindValue(2,$_POST["id_usuario_act"]         ,   PDO::PARAM_STR) ;
        $stmt->bindValue(3,$_POST["id_persona_act"]         ,   PDO::PARAM_STR) ;
        $stmt->bindValue(4,$_POST["Respuesta"]              ,   PDO::PARAM_STR) ;
        $stmt->execute();
        //-------------------- Fin -------------------------------//
    }

    public function get_llamados_por_id($id)
    {
        self::set_names();

        $sql="SELECT    llamados.*                        , 
                        persona.Nombre       as nom_per   ,
                        persona.Apellido     as ape_per   ,
                        usuario.Nombre       as nom_usr   ,
                        usuario.Apellido     as ape_usr
              from      llamados 
              Inner join usuario on usuario.id = llamados.Usuario_Id
              inner join persona on persona.id = llamados.Persona_Id
              Where     llamados.Persona_Id = ?; " ;
          $stmt=$this->dbh->prepare($sql);
        if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->llamados[]=$row;
                }
                return $this->llamados;
                $this->dbh=null;
            }
        
    }
}
?>


