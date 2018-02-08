<?php
require_once("ClaseConeccion.php");
class Usuario extends  Coneccion
{
    private $dbh            ;    private $usuario    ;
    public function __construct()
    {
        $this->dbh=parent::conecta();
        $this->usuario      =   array();
    }
    private function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");    
    }
    /****************Usuarios***************/
    public function edit_usuario()
    {
        if(empty($_POST["Nombre"]) or empty($_POST["Email"]))
        {
            header("Location: Edit_Usuarios.php?m=1&id=".$_POST["id"]);exit;
        }
        $id=$_POST["id"];
        self::set_names();
        $sql="UPDATE usuario SET
                     Usuario            =   ?       ,
                     Rut                =   ?       ,
                     Nombre             =   ?       ,
                     Apellido           =   ?       ,
                     Email              =   ?       ,
                     Nivel_Id           =   ?       ,
                     Perfil_Id          =   ?       ,
                     Fecha_Activacion   =   ?       ,
                     Estado             =   ?
            where
                     id     =?";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Usuario"]                ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["Rut"]                    ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$_POST["Nombre"]                 ,   PDO::PARAM_STR);
        $stmt->bindValue(4,$_POST["Apellido"]               ,   PDO::PARAM_STR);
        $stmt->bindValue(5,$_POST["Email"]                  ,   PDO::PARAM_STR);
        $stmt->bindValue(6,$_POST["Nivel_Id"]               ,   PDO::PARAM_STR);
        $stmt->bindValue(7,$_POST["Perfil_Id"]              ,   PDO::PARAM_STR);
        $stmt->bindValue(8,$_POST["Fecha_Activacion"]      ,   PDO::PARAM_STR);
        $stmt->bindValue(9,$_POST["Estado"]                ,   PDO::PARAM_STR);
        $stmt->bindValue(10,$_POST["id"]                    ,   PDO::PARAM_STR);
        $stmt->execute();
        $this->dbh=null;
        header("Location: EditUsuarios.php?m=2&id=".$_POST["id"]);exit;
    }
    public function cambia_password($Usuario_Id , $Nueva_Clave)
    {
        self::set_names();
        $sql="UPDATE usuario SET
                     Password           =   ?       
              where
                     id     =?";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,md5($Nueva_Clave)          ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Usuario_Id                ,   PDO::PARAM_STR);
        $stmt->execute();
        $this->dbh=null;

        header("Location:Cerrar_Session.php");exit;
        
        
    }
    public function add_usuario()
    {
        if(empty($_POST["Usuario"]))
        {
            header("Location: AddUsuarios.php?m=1");exit;
        }
        //insertar el registro en la tabla clientes
        self::set_names();
        $sql="INSERT INTO usuario 
              VALUES ( NULL , ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Usuario"]                ,   PDO::PARAM_STR);
        $stmt->bindValue(2,md5($_POST["Password"])          ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$_POST["Rut"]                    ,   PDO::PARAM_STR);
        $stmt->bindValue(4,$_POST["Nombre"]                 ,   PDO::PARAM_STR);
        $stmt->bindValue(5,$_POST["Apellido"]               ,   PDO::PARAM_STR);
        $stmt->bindValue(6,$_POST["Email"]                  ,   PDO::PARAM_STR);
        $stmt->bindValue(7,$_POST["Nivel_Id"]               ,   PDO::PARAM_STR);
        $stmt->bindValue(8,$_POST["Perfil_Id"]              ,   PDO::PARAM_STR);
        $stmt->bindValue(9,$_POST["Fecha_Activacion"]      ,   PDO::PARAM_STR);
        $stmt->bindValue(10,$_POST["Estado"]                ,   PDO::PARAM_STR);
        $stmt->execute();
        //$id=mysql_insert_id();
        $id= $this->dbh->lastInsertId();
        $this->dbh=null;
        header("Location: AddUsuarios.php?m=2");exit;
    }
    public function get_usuarios()
    {
        self::set_names();
        $sql="SELECT  usuario.id                    ,
                      usuario.Usuario               ,
                      usuario.Rut                   ,
                      usuario.Nombre                ,
                      usuario.Apellido              ,
                      usuario.Email                 ,
                      usuario.Nivel_Id              ,
                      usuario.Perfil_Id             ,
                      usuario.Fecha_Activacion      ,
                      usuario.Estado                ,
                      nivel.Nivel       as nom_niv  , 
                      perfil.perfil     as nom_per
              from usuario
              INNER JOIN nivel  on nivel.id     =   usuario.Nivel_Id
              INNER JOIN perfil on perfil.id    =   usuario.Perfil_Id
              where usuario.Estado = 1 
              ORDER BY usuario.Nombre ";
        foreach ($this->dbh->query($sql) as $row)
    		{
    			$this->usuario[]=$row;
    		}  
            return $this->usuario;
			$this->dbh=null;
    }
    public function get_usuario_por_id($id)
    {
         if(isset($id))
        {
            self::set_names();
            $sql="SELECT  usuario.*,
                          porsentaje.Prosentaje_1  AS po1 ,
                          porsentaje.Porsentaje_2  AS po2 
                  from usuario
                  left join porsentaje on porsentaje.Usuario_Id = usuario.id
                  WHERE usuario.id=?;";
            $stmt=$this->dbh->prepare($sql);


           if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->usuario[]=$row;
                }
                return $this->usuario;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
    public function validar_ingreso($usr)
    {
        if(isset($usr))
        {
            self::set_names();
            $sql="SELECT usuario.* , perfil.Perfil , nivel.Nivel FROM usuario 
                  inner join nivel on nivel.id = usuario.Nivel_Id
                  inner join perfil on perfil.id = usuario.Perfil_Id
                  WHERE Usuario=?;";
            $stmt=$this->dbh->prepare($sql);

           if($stmt->execute( array($usr) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->usuario[]=$row;
                }
                return $this->usuario;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
}
?>