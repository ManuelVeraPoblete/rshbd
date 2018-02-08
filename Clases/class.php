<?php
class Trabajo
{
    private $dbh            ;    private $usuario    ;
    private $perfil         ;    private $unidad     ;
    private $firma          ;    private $dolar      ;
    private $proveedor      ;    private $tipo       ;
    private $material       ;    private $subtipo    ;
    
    public function __construct()
    {
         //$this->dbh=new PDO('mysql:host=localhost;dbname=rshbd', "root", "#FX"."$"."sclW01");
        $this->dbh=new PDO('mysql:host=localhost;dbname=rshbd', "root","");

        $this->usuario      =   array();
        $this->perfil       =   array();
        $this->unidad       =   array();
        $this->firma        =   array();
        $this->dolar        =   array();
        $this->proveedor    =   array();
        $this->tipo         =   array();
        $this->subtipo      =   array();
    
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
            header("Location: edit_usuario.php?m=1&id=".$_POST["id"]);exit;
        }
        
        $id=$_POST["id"];
        
        $pass = md5($_POST["Usuario"]);

        self::set_names();
        
        $sql="UPDATE usuario SET
                     Usuario        =   ?       ,
                     Email          =   ?       ,
                     Nombre         =   ?       ,
                     Apellido       =   ?       ,
                     FechaIngreso   =   ?       ,
                     Perfil_Id      =   ?       ,
                     Activo         =   ?
            where
                     id     =?";


            $stmt=$this->dbh->prepare($sql);
                     
            $stmt->bindValue(1,$_POST["Usuario"]        ,   PDO::PARAM_STR);
            $stmt->bindValue(2,$_POST["Email"]          ,   PDO::PARAM_STR);
            $stmt->bindValue(3,$_POST["Nombre"]         ,   PDO::PARAM_STR);
            $stmt->bindValue(4,$_POST["Apellido"]       ,   PDO::PARAM_STR);
            $stmt->bindValue(5,$_POST["FechaIngreso"]   ,   PDO::PARAM_STR);
            $stmt->bindValue(6,$_POST["Perfil_Id"]      ,   PDO::PARAM_STR);
            $stmt->bindValue(7,$_POST["Activo"]         ,   PDO::PARAM_STR);
            $stmt->bindValue(8,$_POST["id"]             ,   PDO::PARAM_STR);
              
        
        $stmt->execute();

        echo mysql_affected_rows();

       
        $this->dbh=null;

        header("Location: edit_usuario.php?m=2&id=".$_POST["id"]);exit;
    }
    public function add_usuario()
    {
        if(empty($_POST["Nombre"]) or empty($_POST["Email"]))
        {
            header("Location: add_usuario.php?m=1");exit;
        }
        //insertar el registro en la tabla clientes
        self::set_names();

        $pass = md5($_POST["Password"]);

        $sql="INSERT INTO usuario 
                     values ( NULL , ?, ?, ?, ?, ?, ?, ?, ?);
        ";

        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Usuario"]        ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["Email"]          ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$pass                    ,   PDO::PARAM_STR);
        $stmt->bindValue(4,$_POST["Nombre"]         ,   PDO::PARAM_STR);
        $stmt->bindValue(5,$_POST["Apellido"]       ,   PDO::PARAM_STR);
        $stmt->bindValue(6,$_POST["FechaIngreso"]   ,   PDO::PARAM_STR);
        $stmt->bindValue(7,$_POST["Perfil_Id"]      ,   PDO::PARAM_STR);
        $stmt->bindValue(8,$_POST["Activo"]         ,   PDO::PARAM_STR);
      
        $stmt->execute();
        //$id=mysql_insert_id();
        $id= $this->dbh->lastInsertId();

        echo mysql_error();
        
        $this->dbh=null;



        header("Location: add_usuario.php?m=2");exit;

    }

    public function get_usuarios()
    {
        self::set_names();
        $sql="SELECT  usuario.* , perfil.Nombre as nom_per
              from usuario
              INNER JOIN perfil on perfil.id = usuario.Perfil_Id;";
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
            $sql="SELECT * FROM usuario 
                  WHERE id=?;";
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
    /*************Fin Usuarios***************/
    /*--------------------------------------------------------------*/
    /****************Perfiles***************/
    public function edit_perfil()
    {
        if(empty($_POST["Nombre"]))         {
            header("Location: edit_perfil.php?m=1&id=".$_POST["id"]);exit;
        }
        
        $id=$_POST["id"];
        
        self::set_names();
        
        $sql="UPDATE perfil SET
                     Nombre        =   ?       
            where
                     id     =?";


            $stmt=$this->dbh->prepare($sql);
                     
            $stmt->bindValue(1,$_POST["Nombre"]         ,   PDO::PARAM_STR);
            $stmt->bindValue(2,$_POST["id"]             ,   PDO::PARAM_STR);
              
        
        $stmt->execute();

              
        $this->dbh=null;

        header("Location: edit_perfil.php?m=2&id=".$_POST["id"]);exit;
    }
    public function add_perfil()
    {
        if(empty($_POST["Nombre"]) )
        {
            header("Location: add_perfil.php?m=1");exit;
        }
        //insertar el registro en la tabla clientes
        self::set_names();

        $sql="INSERT INTO perfil
                     values ( NULL , ?);
        ";

        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Nombre"]        ,   PDO::PARAM_STR);
        
      
        $stmt->execute();
        //$id=mysql_insert_id();
        $id= $this->dbh->lastInsertId();

        echo mysql_error();
        
        $this->dbh=null;



        header("Location: add_perfil.php?m=2");exit;

    }

    public function get_perfiles()
    {
        self::set_names();
        $sql="SELECT  perfil.*  
              from perfil
              ;";
        foreach ($this->dbh->query($sql) as $row)
            {
                $this->perfil[]=$row;
            }  
            return $this->perfil;
            $this->dbh=null;
    }
    public function get_perfil_por_id($id)
    {
         if(isset($id))
        {
            self::set_names();
            $sql="SELECT * FROM perfil 
                  WHERE id=?;";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->perfil[]=$row;
                }
                return $this->perfil;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
    /*************Fin Perfiles***************/
    /*--------------------------------------------------------------*/
    /****************Unidades***************/
    public function edit_unidad()
    {

               
        if(empty($_POST["Unidad_Medida"]) or empty($_POST["Descripcion_Medida"]))         
        {
            header("Location: edit_unidad.php?m=1&id=".$_POST["id"]);exit;
        }
        
        
        $id=$_POST["id"];
        
        self::set_names();
        
        $sql="UPDATE unidad SET
                     Unidad_Medida        =   ?,
                     Descripcion_Medida   =   ?       
            where
                     id                   =   ?";


            $stmt=$this->dbh->prepare($sql);
                     
            $stmt->bindValue(1,$_POST["Unidad_Medida"]      ,   PDO::PARAM_STR);
            $stmt->bindValue(2,$_POST["Descripcion_Medida"] ,   PDO::PARAM_STR);
            $stmt->bindValue(3,$_POST["id"]                 ,   PDO::PARAM_STR);
              
        
        $stmt->execute();

              
        $this->dbh=null;

        header("Location: edit_unidad.php?m=2&id=".$_POST["id"]);exit;
    }
    public function add_unidad()
    {
        if(empty($_POST["Unidad_Medida"]) or empty($_POST["Descripcion_Medida"])) 
        {
            header("Location: add_unidad.php?m=1");exit;
        }
        //insertar el registro en la tabla clientes
        self::set_names();

        $sql="INSERT INTO unidad
                     values ( NULL , ?, ?);
        ";

        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Unidad_Medida"]        ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["Descripcion_Medida"]   ,   PDO::PARAM_STR);
        
      
        $stmt->execute();
        //$id=mysql_insert_id();
        $id= $this->dbh->lastInsertId();

        
        $this->dbh=null;



        header("Location: add_unidad.php?m=2");exit;

    }

    public function get_unidades()
    {
        self::set_names();
        $sql="SELECT  unidad.*  
              from unidad
              ;";
        foreach ($this->dbh->query($sql) as $row)
            {
                $this->perfil[]=$row;
            }  
            return $this->perfil;
            $this->dbh=null;
    }
    public function get_unidad_por_id($id)
    {
         if(isset($id))
        {
            self::set_names();
            $sql="SELECT * FROM unidad 
                  WHERE id=?;";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->perfil[]=$row;
                }
                return $this->perfil;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
    /*************Fin Unidades***************/
    /*--------------------------------------*/
    /****************Firma*******************/
    public function edit_firma()
    {
        if(empty($_POST["Nombre"]))
        {
            header("Location: edit_firma.php?m=1&id=".$_POST["id"]);exit;
        }
        
        $id=$_POST["id"];
        
        
        self::set_names();
        
        $sql="UPDATE firma SET
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

        header("Location: edit_firma.php?m=2&id=".$_POST["id"]);exit;
    }
    public function add_firma()
    {
        if(empty($_POST["Nombre"]))
        {
            header("Location: add_firma.php?m=1");exit;
        }
        //insertar el registro en la tabla clientes
        self::set_names();

        $sql="INSERT INTO firma 
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

        header("Location: add_firma.php?m=2");exit;

    }

    public function get_firmas()
    {
        self::set_names();
        $sql="SELECT  firma.* 
              from firma
              ";
        foreach ($this->dbh->query($sql) as $row)
            {
                $this->firma[]=$row;
            }  
            return $this->firma;
            $this->dbh=null;
    }
    public function get_firma_por_id($id)
    {
         if(isset($id))
        {
            self::set_names();
            $sql="SELECT * FROM firma 
                  WHERE id=?;";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->firma[]=$row;
                }
                return $this->firma;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
    /*************Fin Firma***************/
    /*--------------------------------------*/
    /****************dolar***************/
    public function edit_dolar()
    {
        if(empty($_POST["Valor"]))
        {
            header("Location: edit_dolar.php?m=1&id=".$_POST["id"]);exit;
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

        header("Location: edit_dolar.php?m=2&id=".$_POST["id"]);exit;
    }
    public function add_dolar()
    {
        if(empty($_POST["Valor"]))
        {
            header("Location: add_dolar.php?m=1");exit;
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

        header("Location: add_dolar.php?m=2");exit;

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
    /****************Proveedores***************/
    public function edit_proveedor()
    {
        if(empty($_POST["Nombre"]) or empty($_POST["Email"]))
        {
            header("Location: edit_proveedor.php?m=1&id=".$_POST["id"]);exit;
        }
        $id=$_POST["id"];
        self::set_names();
        $sql="UPDATE proveedor SET
                     Nombre        =   ?       ,
                     Direccion     =   ?       ,
                     Rut           =   ?       ,
                     Fono1         =   ?       ,
                     Fono2         =   ?       ,
                     Email         =   ?       ,
                     Contacto      =   ?       ,
                     Rubro         =   ?
            where
                     id     =?";
            $stmt=$this->dbh->prepare($sql);
            $stmt->bindValue(1,$_POST["Nombre"]         ,   PDO::PARAM_STR);
            $stmt->bindValue(2,$_POST["Direccion"]      ,   PDO::PARAM_STR);
            $stmt->bindValue(3,$_POST["Rut"]            ,   PDO::PARAM_STR);
            $stmt->bindValue(4,$_POST["Fono1"]          ,   PDO::PARAM_STR);
            $stmt->bindValue(5,$_POST["Fono2"]          ,   PDO::PARAM_STR);
            $stmt->bindValue(6,$_POST["Email"]          ,   PDO::PARAM_STR);
            $stmt->bindValue(7,$_POST["Contacto"]       ,   PDO::PARAM_STR);
            $stmt->bindValue(8,$_POST["Rubro"]          ,   PDO::PARAM_STR);
            $stmt->bindValue(9,$_POST["id"]             ,   PDO::PARAM_STR);
        $stmt->execute();
        $this->dbh=null;
        header("Location: edit_proveedor.php?m=2&id=".$_POST["id"]);exit;
    }
    public function add_proveedor()
    {
        if(empty($_POST["Nombre"]))
        {
            header("Location: add_proveedor.php?m=1");exit;
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
        $stmt->bindValue(4,$_POST["Fono1"]          ,   PDO::PARAM_STR);
        $stmt->bindValue(5,$_POST["Fono2"]          ,   PDO::PARAM_STR);
        $stmt->bindValue(6,$_POST["Email"]          ,   PDO::PARAM_STR);
        $stmt->bindValue(7,$_POST["Contacto"]       ,   PDO::PARAM_STR);
        $stmt->bindValue(8,$_POST["Rubro"]          ,   PDO::PARAM_STR);
        $stmt->execute();
        $id= $this->dbh->lastInsertId();
        $this->dbh=null;
        header("Location: add_proveedor.php?m=2");exit;
    }
     public function get_proveedores()
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
/****************Tipos de Materiales***************/
    public function edit_tipo()
    {
        if(empty($_POST["Descripcion"]) )
        {
            header("Location: edit_tipo.php?m=1&id=".$_POST["id"]);exit;
        }
        $id=$_POST["id"];
        self::set_names();
        $sql="UPDATE tipo SET
                     Descripcion   =   ?       
            where
                     id     =?";
            $stmt=$this->dbh->prepare($sql);
            $stmt->bindValue(1,$_POST["Descripcion"]         ,   PDO::PARAM_STR);
            $stmt->bindValue(2,$_POST["id"]                  ,   PDO::PARAM_STR);
        $stmt->execute();
        $this->dbh=null;
        header("Location: edit_tipo.php?m=2&id=".$_POST["id"]);exit;
    }
    public function add_tipo()
    {
        if(empty($_POST["Descripcion"]))
        {
            header("Location: add_tipo.php?m=1");exit;
        }
        //insertar el registro en la tabla clientes
        self::set_names();

        $sql="INSERT INTO tipo 
                     values ( NULL , ?);
        ";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Descripcion"]         ,   PDO::PARAM_STR);
        
        $stmt->execute();
        $id= $this->dbh->lastInsertId();
        $this->dbh=null;
        header("Location: add_tipo.php?m=2");exit;
    }
     public function get_tipos()
    {
        self::set_names();
        $sql="SELECT  tipo.* 
              from tipo;";
        foreach ($this->dbh->query($sql) as $row)
            {
                $this->tipo[]=$row;
            }  
            return $this->tipo;
            $this->dbh=null;
    }
    public function get_tipo_por_id($id)
    {
         if(isset($id))
        {
            self::set_names();
            $sql="SELECT * FROM tipo 
                  WHERE id=?;";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->tipo[]=$row;
                }
                return $this->tipo;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
/*************Fin Tipos de Materiales***************/
/****************Sub Tipos de Materiales***************/
    public function edit_subtipo()
    {
        if(empty($_POST["Descripcion"]) )
        {
            header("Location: edit_subtipo.php?m=1&id=".$_POST["id"]);exit;
        }
        $id=$_POST["id"];
        self::set_names();
        $sql="UPDATE subtipo SET
                     Tipo_Id       =   ?,
                     Descripcion   =   ?       
            where
                     id     =?";
            $stmt=$this->dbh->prepare($sql);
            $stmt->bindValue(1,$_POST["Tipo_Id"]             ,   PDO::PARAM_STR);
            $stmt->bindValue(2,$_POST["Descripcion"]         ,   PDO::PARAM_STR);
            $stmt->bindValue(3,$_POST["id"]                  ,   PDO::PARAM_STR);
        $stmt->execute();
        $this->dbh=null;
        header("Location: edit_subtipo.php?m=2&id=".$_POST["id"]);exit;
    }
    public function add_subtipo()
    {
        if(empty($_POST["Descripcion"]))
        {
            header("Location: add_subtipo.php?m=1");exit;
        }
        //insertar el registro en la tabla clientes
        self::set_names();

        $sql="INSERT INTO subtipo 
                     values ( NULL , ?, ?);
        ";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Tipo_Id"]             ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["Descripcion"]         ,   PDO::PARAM_STR);
        
        $stmt->execute();
        $id= $this->dbh->lastInsertId();
        $this->dbh=null;
        header("Location: add_subtipo.php?m=2");exit;
    }

    public function get_subtipo_ajax($id)
    {
        self::set_names();
        $sql="SELECT *
              FROM subtipo
              WHERE Tipo_Id=? 
              ORDER BY  Descripcion asc ";
        $stmt=$this->dbh->prepare($sql);
        if($stmt->execute( array($id) ) )
        {
            while($row = $stmt->fetch())
            {
                $this->subtipo[]=$row;
            }
            return $this->subtipo;
            $this->dbh=null;
        }
    }

    public function get_subtipos()
    {
        self::set_names();
        

              $sql="SELECT  subtipo.* , tipo.descripcion as des_tip
              from subtipo
              INNER JOIN tipo on tipo.id = subtipo.Tipo_Id;";

        foreach ($this->dbh->query($sql) as $row)
            {
                $this->subtipo[]=$row;
            }  
            return $this->subtipo;
            $this->dbh=null;
    }
    public function get_subtipo_por_id($id)
    {
         if(isset($id))
        {
            self::set_names();
            $sql="SELECT * FROM subtipo 
                  WHERE id=?;";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->subtipo[]=$row;
                }
                return $this->subtipo;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
/*************Sub Fin Tipos de Materiales***************/
/****************Sub Tipos de Movimientos***************/
    public function edit_movimiento()
    {
        if(empty($_POST["Descripcion"]) )
        {
            header("Location: edit_movimiento.php?m=1&id=".$_POST["id"]);exit;
        }
        $id=$_POST["id"];
        self::set_names();
        $sql="UPDATE movimiento SET
                     Descripcion        =   ?,      
                     Tipo_Movimiento    =   ?
            where
                     id     =?";
            $stmt=$this->dbh->prepare($sql);
            $stmt->bindValue(1,$_POST["Descripcion"]             ,   PDO::PARAM_STR);
            $stmt->bindValue(2,$_POST["Tipo_Movimiento"]         ,   PDO::PARAM_STR);
            $stmt->bindValue(3,$_POST["id"]                      ,   PDO::PARAM_STR);
        $stmt->execute();
        $this->dbh=null;
        header("Location: edit_movimiento.php?m=2&id=".$_POST["id"]);exit;
    }
    public function add_movimiento()
    {
        if(empty($_POST["Descripcion"]))
        {
            header("Location: add_movimiento.php?m=1");exit;
        }
        //insertar el registro en la tabla clientes
        self::set_names();

        $sql="INSERT INTO movimiento 
                     values ( NULL , ?, ?);";

        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Descripcion"]             ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["Tipo_Movimiento"]         ,   PDO::PARAM_STR);
        
        $stmt->execute();
        $id= $this->dbh->lastInsertId();
        $this->dbh=null;
        header("Location: add_movimiento.php?m=2");exit;
    }
     public function get_movimientos()
    {
        self::set_names();
        $sql="SELECT  movimiento.* 
              from movimiento;";
        foreach ($this->dbh->query($sql) as $row)
            {
                $this->movimiento[]=$row;
            }  
            return $this->movimiento;
            $this->dbh=null;
    }
    public function get_movimiento_por_id($id)
    {
         if(isset($id))
        {
            self::set_names();
            $sql="SELECT * FROM movimiento 
                  WHERE id=?;";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->movimiento[]=$row;
                }
                return $this->movimiento;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
/*************Sub Fin Tipos de Movimientos***************/
/****************Departamentos***************/
    public function edit_departamento()
    {
        if(empty($_POST["Descripcion"]) )
        {
            header("Location: edit_departamento.php?m=1&id=".$_POST["id"]);exit;
        }
        $id=$_POST["id"];
        self::set_names();
        $sql="UPDATE departamento SET
                     Descripcion        =   ?
            where
                     id     =?";
            $stmt=$this->dbh->prepare($sql);
            $stmt->bindValue(1,$_POST["Descripcion"]             ,   PDO::PARAM_STR);
            $stmt->bindValue(2,$_POST["id"]                      ,   PDO::PARAM_STR);
        $stmt->execute();
        $this->dbh=null;
        header("Location: edit_departamento.php?m=2&id=".$_POST["id"]);exit;
    }
    public function add_departamento()
    {
        if(empty($_POST["Descripcion"]))
        {
            header("Location: add_departamento.php?m=1");exit;
        }
        //insertar el registro en la tabla clientes
        self::set_names();

        $sql="INSERT INTO departamento 
                     values ( NULL , ?);
        ";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Descripcion"]             ,   PDO::PARAM_STR);
        
        
        $stmt->execute();
        $id= $this->dbh->lastInsertId();
        $this->dbh=null;
        header("Location: add_departamento.php?m=2");exit;
    }
     public function get_departamentos()
    {
        self::set_names();
        $sql="SELECT  departamento.* 
              from departamento;";
        foreach ($this->dbh->query($sql) as $row)
            {
                $this->departamento[]=$row;
            }  
            return $this->departamento;
            $this->dbh=null;
    }
    public function get_departamento_por_id($id)
    {
         if(isset($id))
        {
            self::set_names();
            $sql="SELECT * FROM departamento 
                  WHERE id=?;";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->departamento[]=$row;
                }
                return $this->departamento;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
/*************Fin Departamentos***************/
/****************SubDepartamentos***************/
    public function edit_subdepartamento()
    {
        if(empty($_POST["SubDepartamento"]) )
        {
            header("Location: edit_subdepartamento.php?m=1&id=".$_POST["id"]);exit;
        }
        $id=$_POST["id"];
        self::set_names();
        $sql="UPDATE subdepartamento SET
                     Departamento_Id        =   ? ,
                     SubDepartamento        =   ?
              WHERE
                     id     =?";
            $stmt=$this->dbh->prepare($sql);
            $stmt->bindValue(1,$_POST["Departamento_Id"]             ,   PDO::PARAM_STR);
            $stmt->bindValue(2,$_POST["SubDepartamento"]             ,   PDO::PARAM_STR);
            $stmt->bindValue(3,$_POST["id"]                          ,   PDO::PARAM_STR);
        $stmt->execute();
        $this->dbh=null;
        header("Location: edit_subdepartamento.php?m=2&id=".$_POST["id"]);exit;
    }
    public function add_subdepartamento()
    {
        if(empty($_POST["SubDepartamento"]))
        {
            header("Location: add_subdepartamento.php?m=1");exit;
        }
        //insertar el registro en la tabla clientes
        self::set_names();

        $sql="INSERT INTO subdepartamento 
                     values ( NULL , ?, ?);
        ";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Departamento_Id"]             ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["SubDepartamento"]             ,   PDO::PARAM_STR);
        
        
        $stmt->execute();
        $id= $this->dbh->lastInsertId();
        $this->dbh=null;
        header("Location: add_subdepartamento.php?m=2");exit;
    }
    public function get_depa_ajax($id)
    {
        self::set_names();
        $sql="SELECT *
              FROM subdepartamento
              WHERE Departamento_Id=? ";
        $stmt=$this->dbh->prepare($sql);
        if($stmt->execute( array($id) ) )
        {
            while($row = $stmt->fetch())
            {
                $this->subtipo[]=$row;
            }
            return $this->subtipo;
            $this->dbh=null;
        }
    }
    public function get_subdepartamentos()
    {
        self::set_names();
        $sql="SELECT  subdepartamento.* , departamento.Descripcion as des_dep
              from subdepartamento
              INNER JOIN departamento on subdepartamento.Departamento_Id = departamento.id ;";



        foreach ($this->dbh->query($sql) as $row)
            {
                $this->subdepartamento[]=$row;
            }  
            return $this->subdepartamento;
            $this->dbh=null;
    }
    public function get_subdepartamento_por_id($id)
    {
         if(isset($id))
        {
            self::set_names();
            $sql="SELECT * FROM subdepartamento 
                  WHERE id=?;";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->subdepartamento[]=$row;
                }
                return $this->subdepartamento;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
/*************Fin SubDepartamentos***************/


/**************** Materiales ***************/
    public function edit_material()
    {
        if(empty($_POST["Descripcion"]))
        {
            header("Location: edit_material.php?m=1&id=".$_POST["id"]);exit;
        }
        $id=$_POST["id"];
        self::set_names();
        $sql="UPDATE material SET
                     Nombre        =   ?       ,
                     Direccion     =   ?       ,
                     Rut           =   ?       ,
                     Fono1         =   ?       ,
                     Fono2         =   ?       ,
                     Email         =   ?       ,
                     Contacto      =   ?       ,
                     Rubro         =   ?
            where
                     id     =?";
            $stmt=$this->dbh->prepare($sql);
            $stmt->bindValue(1,$_POST["Nombre"]         ,   PDO::PARAM_STR);
            $stmt->bindValue(2,$_POST["Direccion"]      ,   PDO::PARAM_STR);
            $stmt->bindValue(3,$_POST["Rut"]            ,   PDO::PARAM_STR);
            $stmt->bindValue(4,$_POST["Fono1"]          ,   PDO::PARAM_STR);
            $stmt->bindValue(5,$_POST["Fono2"]          ,   PDO::PARAM_STR);
            $stmt->bindValue(6,$_POST["Email"]          ,   PDO::PARAM_STR);
            $stmt->bindValue(7,$_POST["Contacto"]       ,   PDO::PARAM_STR);
            $stmt->bindValue(8,$_POST["Rubro"]          ,   PDO::PARAM_STR);
            $stmt->bindValue(9,$_POST["id"]             ,   PDO::PARAM_STR);
        $stmt->execute();
        $this->dbh=null;
        header("Location: edit_material.php?m=2&id=".$_POST["id"]);exit;
    }
    public function add_material()
    {
        if(empty($_POST["Nombre"]))
        {
            header("Location: add_material.php?m=1");exit;
        }
        //insertar el registro en la tabla clientes
        self::set_names();

        $sql="INSERT INTO material 
                     values ( NULL , ?, ?, ?, ?, ?, ?, ?, ?);
        ";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Nombre"]         ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["Direccion"]      ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$_POST["Rut"]            ,   PDO::PARAM_STR);
        $stmt->bindValue(4,$_POST["Fono1"]          ,   PDO::PARAM_STR);
        $stmt->bindValue(5,$_POST["Fono2"]          ,   PDO::PARAM_STR);
        $stmt->bindValue(6,$_POST["Email"]          ,   PDO::PARAM_STR);
        $stmt->bindValue(7,$_POST["Contacto"]       ,   PDO::PARAM_STR);
        $stmt->bindValue(8,$_POST["Rubro"]          ,   PDO::PARAM_STR);
        $stmt->execute();
        $id= $this->dbh->lastInsertId();
        $this->dbh=null;
        header("Location: add_material.php?m=2");exit;
    }
     public function get_materiales()
    {
        self::set_names();
        $sql="SELECT  material.* , 
                      unidad.Unidad_Medida as uni_des ,
                      tipo.Descripcion as tip_des,
                      subtipo.Descripcion as sti_des
              from    material
              INNER JOIN unidad  on unidad.id = material.Unidad_Id
              INNER JOIN tipo    on tipo.id   = material.Tipo_Id
              INNER JOIN subtipo on subtipo.id = material.Sub_Tipo_Id;";
        foreach ($this->dbh->query($sql) as $row)
            {
                $this->material[]=$row;
            }  
            return $this->material;
            $this->dbh=null;
    }
    public function get_material_por_id($id)
    {
         if(isset($id))
        {
            self::set_names();
            $sql="SELECT * FROM material 
                  WHERE id=?;";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->material[]=$row;
                }
                return $this->material;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
/*************Fin Materiales***************/
/**************** Recepcion ***************/
    public function edit_recepcion()
    {
        if(empty($_POST["Movimiento_Id"]))
        {
            header("Location: edit_recepcion.php?m=1&id=".$_POST["id"]);exit;
        }
        $id=$_POST["id"];
        self::set_names();
        $sql="UPDATE recepcion SET
                     Fecha_Recepcion           =   ?       ,
                     Movimiento_Id             =   ?       ,
                     Departamento_Id           =   ?       ,
                     SubDepartamento_Id        =   ?       
            where
                     id     =?";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Fecha_Recepcion"]      ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["Movimiento_Id"]        ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$_POST["Departamento_Id"]      ,   PDO::PARAM_STR);
        $stmt->bindValue(4,$_POST["SubDepartamento_Id"]   ,   PDO::PARAM_STR);
        $stmt->bindValue(5,$_POST["id"]                   ,   PDO::PARAM_STR);

        $stmt->execute();
        $this->dbh=null;
        header("Location: edit_recepcion.php?m=2&id=".$_POST["id"]);exit;
    }
    public function add_recepcion()
    {
        

        if(empty($_POST["Movimiento_Id"]))
        {
            header("Location: add_recepcion.php?m=1");
            exit;
        }
        
        self::set_names();

        $sql="INSERT INTO recepcion 
                     values ( NULL , ?, ?, ?, ?,'1');";
        
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Fecha_Recepcion"]     ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["Movimiento_Id"]       ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$_POST["Departamento_Id"]     ,   PDO::PARAM_STR);
        $stmt->bindValue(4,$_POST["SubDepartamento_Id"]  ,   PDO::PARAM_STR);

        $stmt->execute();

        $id= $this->dbh->lastInsertId();
        $this->dbh=null;
        header("Location: add_recepcion.php?m=2");exit;
    }
     public function get_recepciones()
    {
        self::set_names();
        $sql="SELECT  recepcion.* , 
                      movimiento.Descripcion          as movi , 
                      departamento.Descripcion        as depa, 
                      subdepartamento.SubDepartamento as subdepa
              from    recepcion
              INNER JOIN movimiento      on movimiento.id      = recepcion.Movimiento_Id
              inner join departamento    on departamento.id    = recepcion.Departamento_Id
              inner join subdepartamento on subdepartamento.id = recepcion.SubDepartamento_Id
              ORDER BY recepcion.Fecha_Recepcion DESC";
        foreach ($this->dbh->query($sql) as $row)
            {
                $this->recepcion[]=$row;
            }  
            return $this->recepcion;
            $this->dbh=null;
    }
    public function get_recepcion_por_id($id)
    {
         if(isset($id))
        {
            self::set_names();
            $sql="SELECT * FROM recepcion 
                  WHERE id=?;";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->recepcion[]=$row;
                }
                return $this->recepcion;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
/*************Fin Recepcion***************/
}
?>