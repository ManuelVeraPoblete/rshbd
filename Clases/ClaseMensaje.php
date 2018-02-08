<?php
require_once("ClaseConeccion.php");
class Mensajes extends  Coneccion
{
    private $dbh            ;    private $mensajes    ;
    public function __construct()
    {
        
        $this->dbh=parent::conecta();
        $this->mensajes      =   array();
    }
    private function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");    
    }

    public function genera_mensaje_persona_existe(){
        
        self::set_names();
        $Fecha = date("Y-m-d");
        $Estado = '1';
        //-------------------- Llamado  --------------------------//
        $sql="INSERT INTO mensajes 
              VALUES ( NULL , ?, ?, ?, NULL, ?,NULL, ? );";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Mensaje"]         ,   PDO::PARAM_STR) ;
        $stmt->bindValue(2,$Estado                   ,   PDO::PARAM_STR) ;
        $stmt->bindValue(3,$_POST["id_usuario_act"]  ,   PDO::PARAM_STR) ;
        $stmt->bindValue(4,$Fecha                    ,   PDO::PARAM_STR) ;
        $stmt->bindValue(5,$_POST["id_persona_act"]  ,   PDO::PARAM_STR) ;
        $stmt->execute();
        //-------------------- Fin -------------------------------//
    }

    public function get_mensajes_por_id($id)
    {
        self::set_names();

        $sql="SELECT    mensajes.id                             , 
                        mensajes.Mensaje                        , 
                        mensajes.Estado                         , 
                        mensajes.Usuario_Id                     ,
                        mensajes.Usuario_Lee                    ,
                        mensajes.Fecha_Generada                 , 
                        mensajes.Fecha_Leido                    ,
                        mensajes.Persona_Id ,
                        persona.Nombre        as  nom_per       ,
                        persona.Apellido      as  ape_per       ,
                        usuario.Nombre        as  nom_usr_g     ,
                        usuario.Apellido      as  ape_usr_g     ,
                        usuario_Lee.Nombre    as  nom_usr_l     ,
                        usuario_Lee.Apellido  as  ape_usr_l
              from      mensajes 
              Inner join usuario              on usuario.id = mensajes.Usuario_Id
              left JOIN usuario usuario_Lee on usuario_lee.id = mensajes.Usuario_Lee
              inner join persona              on persona.id = mensajes.Persona_Id
              Where     mensajes.Persona_Id = ? and 
                        mensajes.Estado = 1 ; " ;
          $stmt=$this->dbh->prepare($sql);
        if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->mensajes[]=$row;
                }
                return $this->mensajes;
                $this->dbh=null;
            }
        
    }
    public function marca_mensaje($id)
    {
        
        self::set_names();
        $sql="UPDATE mensajes SET
                     Estado    =   '2'
            where
                     id     =?";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$id         ,    PDO::PARAM_STR);
        $stmt->execute();
        $this->dbh=null;
        return true;
    }
}
?>


