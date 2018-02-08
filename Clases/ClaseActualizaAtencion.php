<?php
require_once("ClaseConeccion.php");
class ActualizaAtencion extends  Coneccion
{
    private $dbh            ;    
    private $act_atencion   ;
    private $id_hoja_cabeza ;
    public function __construct()
    {
        $this->dbh=parent::conecta();
        $this->act_atencion      =   array();
    }
    private function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");    
    }
    /****************Usuarios***************/
    public function Genera_Atencion()
    {
        if(empty($_POST["Rut"])) { header("Location: Atenciones.php" ); exit; }
        self::set_names();
        // Insertar Registro en Tabla de Personas
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
        // Insertar Registro en Tabla de Atencion
        self::set_names();
        $Estado_Revisora  = '1';
        $Hora_Termino     = date("H:i",time());
        if (!isset($_POST["Cierra"]) ) 
            { 
              $Estado_Atencion = '1'    ; 
              $Fecha_Cierra    =  null  ; 
              $usuario_cerrar  =  null  ;
              $usuario_activo  = $_POST["id_usuario_act"];
            }
        else 
            { $Estado_Atencion = '2'                       ; 
              $Fecha_Cierra    =  date("Y-m-d")            ; 
              $usuario_activo  = $_POST["id_usuario_act"]  ;   
              $usuario_cerrar  = $_POST["id_usuario_act"]  ;   
            }
        $Generada = "N";
        $sql="INSERT INTO atencion
              VALUES ( NULL , ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1 ,$usuario_activo                ,    PDO::PARAM_STR);
        $stmt->bindValue(2 ,$id_persona                    ,    PDO::PARAM_STR);
        $stmt->bindValue(3 ,$_POST["Fecha_Atencion"]       ,    PDO::PARAM_STR);
        $stmt->bindValue(4 ,$_POST["Hora_Atencion"]        ,    PDO::PARAM_STR);
        $stmt->bindValue(5 ,$_POST["Observacion"]          ,    PDO::PARAM_STR);
        $stmt->bindValue(6 ,$_POST["Folio_Rsh"]            ,    PDO::PARAM_STR);
        $stmt->bindValue(7 ,$_POST["Numero_Solicitud"]     ,    PDO::PARAM_STR);
        $stmt->bindValue(8 ,$Estado_Atencion               ,    PDO::PARAM_STR);
        $stmt->bindValue(9 ,$Estado_Revisora               ,    PDO::PARAM_STR);
        $stmt->bindValue(10,$_POST["Proxima_Visita"]       ,    PDO::PARAM_STR);
        $stmt->bindValue(11,$usuario_cerrar                ,    PDO::PARAM_STR);
        $stmt->bindValue(12,$Fecha_Cierra                  ,    PDO::PARAM_STR);
        $stmt->bindValue(13,$Generada                      ,    PDO::PARAM_STR);
        $stmt->execute();
        $id_atencion= $this->dbh->lastInsertId();
        //------------- Ingreso Registros en At_Consulta
        $numero=$_POST["ArrayConsulta"];
        $Estado_Consulta = 7;
        $Total_Registros = count($numero);
        for ($i = 0; $i < $Total_Registros; $i++) {
            $sql="INSERT INTO ate_consulta
                  VALUES ( NULL , ?, ? , ?);";

                if ($Estado_Atencion == 2) {
                    if ($numero[$i] == 5 or $numero[$i] == 6 or $numero[$i]== 7 ){
                        $Estado_Consulta = 7 ;
                    } else {
                        $Estado_Consulta = 6 ;
                    }
                } else {
                    $Estado_Consulta = 7;
                }
                $stmt=$this->dbh->prepare($sql);
                $stmt->bindValue(1 ,$numero[$i]        ,    PDO::PARAM_STR);
                $stmt->bindValue(2 ,$id_atencion       ,    PDO::PARAM_STR);
                $stmt->bindValue(3 ,$Estado_Consulta   ,    PDO::PARAM_STR);
                $stmt->execute();
        }
        //------------- Ingreso Registros en At_Programa
        $numero=$_POST["programa"];
        $Total_Registros = count($numero);
        for ($i = 0; $i < $Total_Registros; $i++) {
            $sql="INSERT INTO ate_programa
                    VALUES ( NULL , ?, ?  );";
            $stmt=$this->dbh->prepare($sql);
            $stmt->bindValue(1 ,$numero[$i]        ,    PDO::PARAM_STR);
            $stmt->bindValue(2 ,$id_atencion       ,    PDO::PARAM_STR);
            $stmt->execute();
        }
        //------------- Ingreso Registros en documentos            
        if ( $Estado_Atencion == '1' )
        {
            $numero=$_POST["documento"];
            $Total_Registros = count($numero);
            for ($i = 0; $i < $Total_Registros; $i++) {
                $sql="INSERT INTO ate_documentos
                      VALUES ( NULL , ?, ? );";
                $stmt=$this->dbh->prepare($sql);
                $stmt->bindValue(1 ,$id_atencion       ,    PDO::PARAM_STR);
                $stmt->bindValue(2 ,$numero[$i]        ,    PDO::PARAM_STR);
                $stmt->execute();  
            }
        }
        //------------- Ingreso Registros en Documentos
        header("Location: Atenciones.php");exit;
    }
    public function Genera_Atencion_persona_existe()
    {
        self::set_names();
        $id_persona = $_POST["id"];
        // Insertar Registro en Tabla de Atencion
        self::set_names();
        $Estado_Revisora  = '1';
        $Hora_Termino     = date("H:i",time());
        if (!isset($_POST["Cierra"]) ) 
            { 
              $Estado_Atencion = '1'    ; 
              $Fecha_Cierra    =  null  ; 
              $usuario_cerrar  =  null  ;
              $usuario_activo  = $_POST["id_usuario_act"];
            }
        else 
            { $Estado_Atencion = '2'                       ; 
              $Fecha_Cierra    =  date("Y-m-d")            ; 
              $usuario_activo  = $_POST["id_usuario_act"]  ;   
              $usuario_cerrar  = $_POST["id_usuario_act"]  ;   
            }
        $Generada = "N";
        $sql="INSERT INTO atencion
              VALUES ( NULL , ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1 ,$usuario_activo                ,    PDO::PARAM_STR);
        $stmt->bindValue(2 ,$id_persona                    ,    PDO::PARAM_STR);
        $stmt->bindValue(3 ,$_POST["Fecha_Atencion"]       ,    PDO::PARAM_STR);
        $stmt->bindValue(4 ,$_POST["Hora_Atencion"]        ,    PDO::PARAM_STR);
        $stmt->bindValue(5 ,$_POST["Observacion"]          ,    PDO::PARAM_STR);
        $stmt->bindValue(6 ,$_POST["Folio_Rsh"]            ,    PDO::PARAM_STR);
        $stmt->bindValue(7 ,$_POST["Numero_Solicitud"]     ,    PDO::PARAM_STR);
        $stmt->bindValue(8 ,$Estado_Atencion               ,    PDO::PARAM_STR);
        $stmt->bindValue(9 ,$Estado_Revisora               ,    PDO::PARAM_STR);
        $stmt->bindValue(10,$_POST["Proxima_Visita"]       ,    PDO::PARAM_STR);
        $stmt->bindValue(11,$usuario_cerrar                ,    PDO::PARAM_STR);
        $stmt->bindValue(12,$Fecha_Cierra                  ,    PDO::PARAM_STR);
        $stmt->bindValue(13,$Generada                      ,    PDO::PARAM_STR);
        $stmt->execute();
        $id_atencion= $this->dbh->lastInsertId();
        //------------- Ingreso Registros en At_Consulta
        $Estado_Consulta = 7;
        $numero=$_POST["ArrayConsulta"];
        $Total_Registros = count($numero);
        for ($i = 0; $i < $Total_Registros; $i++) {
            $sql="INSERT INTO ate_consulta
                    VALUES ( NULL , ?, ? , ?);";
            if ($Estado_Atencion == 2) {
                if ($numero[$i] == 5 or $numero[$i] == 6 or $numero[$i]== 7 ){
                        $Estado_Consulta = 7 ;
                } else {
                    $Estado_Consulta = 6 ;
                }
            } else {
                $Estado_Consulta = 7;
            }
            $stmt=$this->dbh->prepare($sql);
            $stmt->bindValue(1 ,$numero[$i]        ,    PDO::PARAM_STR);
            $stmt->bindValue(2 ,$id_atencion       ,    PDO::PARAM_STR);
            $stmt->bindValue(3 ,$Estado_Consulta   ,    PDO::PARAM_STR);
            $stmt->execute();
        }

        //------------- Ingreso Registros en At_Programa
            $numero=$_POST["programa"];  
            $Total_Registros = count($numero);
            for ($i = 0; $i < $Total_Registros; $i++) {
                
                $sql="INSERT INTO ate_programa
                      VALUES ( NULL , ?, ? );";
                $stmt=$this->dbh->prepare($sql);
                $stmt->bindValue(1 ,$numero[$i]        ,    PDO::PARAM_STR);
                $stmt->bindValue(2 ,$id_atencion       ,    PDO::PARAM_STR);
                $stmt->execute();
               }
        //------------- Ingreso Registros en At_Programa
        if ( $Estado_Atencion == '1' )
        {
            $numero=$_POST["documento"];
            $Total_Registros = count($numero);
            
            for ($i = 0; $i < $Total_Registros; $i++) {
                $sql="INSERT INTO ate_documentos
                      VALUES ( NULL , ?, ? );";
                $stmt=$this->dbh->prepare($sql);
                $stmt->bindValue(1 ,$id_atencion       ,    PDO::PARAM_STR);
                $stmt->bindValue(2 ,$numero[$i]        ,    PDO::PARAM_STR);
                $stmt->execute();
            }
        }
        header("Location: Atenciones.php");exit;
    }
    public function Actualiza_Atencion_persona_existe()
    {
        self::set_names();
        $id_persona = $_POST["id"];
        // Insertar Registro en Tabla de Atencion
        self::set_names();
        $Estado_Revisora  = '1';
        $Hora_Termino     = date("H:i",time());
        if (!isset($_POST["Cierra"]) ) 
            { 
              $Estado_Atencion = '1'    ; 
              $Fecha_Cierra    =  null  ; 
              $usuario_cerrar  =  null  ;
              $usuario_activo  = $_POST["id_usuario_act"];
            }
        else 
            { 
              $Estado_Atencion = '2'                       ; 
              $Fecha_Cierra    =  date("Y-m-d")            ; 
              $usuario_activo  = $_POST["id_usuario_act"]  ;   
              $usuario_cerrar  = $_POST["id_usuario_act"]  ;   
            }
        $Generada = "N";
        $sql="UPDATE atencion SET
                     Fecha_Atencion        =   ?       ,
                     Observacion           =   ?       ,
                     Folio_Rsh             =   ?       ,
                     Numero_Solicitud      =   ?       ,
                     Estado_Atencion       =   ?       ,
                     Fecha_Cita            =   ?       ,
                     Usuario_Cierra        =   ?       ,
                     Fecha_Cierra          =   ?       
                where
                     id     =?";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Fecha_Atencion"]       ,    PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["Observacion"]          ,    PDO::PARAM_STR);
        $stmt->bindValue(3,$_POST["Folio_Rsh"]            ,    PDO::PARAM_STR);
        $stmt->bindValue(4,$_POST["Numero_Solicitud"]     ,    PDO::PARAM_STR);
        $stmt->bindValue(5,$Estado_Atencion               ,    PDO::PARAM_STR);
        $stmt->bindValue(6,$_POST["Proxima_Visita"]       ,    PDO::PARAM_STR);
        $stmt->bindValue(7,$usuario_cerrar                ,    PDO::PARAM_STR);
        $stmt->bindValue(8,$Fecha_Cierra                  ,    PDO::PARAM_STR);
        $stmt->bindValue(9,$_POST["id_atencion"]          ,    PDO::PARAM_STR);
        $stmt->execute();
        //------------- Elimina Ate Consulta
        $sql="DELETE FROM ate_consulta
              where ate_consulta.Atencion_Id     =?";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["id_atencion"]          ,    PDO::PARAM_STR);
        $stmt->execute();
        //------------- Ingreso Registros en At_Consulta
        $Estado_Consulta = 7;
        $numero=$_POST["ArrayConsulta"];
        $Total_Registros = count($numero);
        for ($i = 0; $i < $Total_Registros; $i++) {
            $sql="INSERT INTO ate_consulta
                    VALUES ( NULL , ?, ? , ?);";

            if ($Estado_Atencion == 2) {
                if ($numero[$i] == 5 or $numero[$i] == 6 or $numero[$i]== 7 ){
                        $Estado_Consulta = 7 ;
                    } else {
                        $Estado_Consulta = 6 ;
                    }
            } else {
                $Estado_Consulta = 7;
            }

            $stmt=$this->dbh->prepare($sql);
            $stmt->bindValue(1 ,$numero[$i]                   ,    PDO::PARAM_STR);
            $stmt->bindValue(2,$_POST["id_atencion"]          ,    PDO::PARAM_STR);
            $stmt->bindValue(3 ,$Estado_Consulta              ,    PDO::PARAM_STR);
            $stmt->execute();
        }
        //------------- Ingreso Registros en At_Programa
        header("Location: Atenciones.php");exit;
    }
    public function Genera_Encabezado_Hoja_Ruta($Numero_Hoja, $Sector_Paso , $Movimiento)
    {
        $Fecha_Actual = date('Y/m/d');
        self::set_names();
        // Insertar Registro en Tabla de Personas
        $sql="INSERT INTO hoja_cabeza 
              VALUES ( NULL , ?, ?, NULL,NULL,?,NULL, ?);";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Numero_Hoja         ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Sector_Paso         ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$Fecha_Actual        ,   PDO::PARAM_STR);
        $stmt->bindValue(4,$Movimiento          ,   PDO::PARAM_STR);
        $stmt->execute();
        $id_hoja_cabeza = $this->dbh->lastInsertId();
        return $id_hoja_cabeza;
    }
    public function Actualiza_Hoja_Cebeza($Numero_Hoja, $Fecha_Entrega , $Fecha_Devolucion, $Usuario_Asignada)
    {
        self::set_names();
        // Insertar Registro en Tabla de Personas
        $sql="UPDATE hoja_cabeza SET
                     Fecha_Entrega         =    ?       ,
                     Fecha_Devolucion      =    ?       ,
                     Usuario_Asignada      =    ?       
            where
                     Numero_Hoja           =    ? ";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Fecha_Entrega       ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Fecha_Devolucion    ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$Usuario_Asignada    ,   PDO::PARAM_STR);
        $stmt->bindValue(4,$Numero_Hoja         ,   PDO::PARAM_STR);
        $stmt->execute();
        return ;
    }
    public function Actualiza_Hoja_Detalle( $HD_id              ,
                                            $HD_Respuesta_Id    ,
                                            $HD_Fecha_Visita    ,
                                            $HD_Usuario_Id      ,
                                            $HD_Observacion     ,
                                            $HD_AmPm            )
    {
        self::set_names();
        // Insertar Registro en Tabla de Personas
        $sql="UPDATE hoja_detalle     SET
                     Respuesta_Id       =   ?       ,
                     Fecha_Visita       =   ?       ,
                     Usuario_Id         =   ?       ,
                     Observacion        =   ?       ,
                     AmPm               =   ?         
            where
                     id                 =   ? ";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$HD_Respuesta_Id     ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$HD_Fecha_Visita     ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$HD_Usuario_Id       ,   PDO::PARAM_STR);
        $stmt->bindValue(4,$HD_Observacion      ,   PDO::PARAM_STR);
        $stmt->bindValue(5,$HD_AmPm             ,   PDO::PARAM_STR);
        $stmt->bindValue(6,$HD_id               ,   PDO::PARAM_STR);
        $stmt->execute();
        $sql="INSERT INTO hoja_historico 
              VALUES ( NULL         , 
                       ?            ,
                       CURRENT_TIMESTAMP,
                       ?            ,
                       ?            ,
                       ?            ,
                       ?            ,
                       ?         );";

        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$HD_id               ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$HD_Fecha_Visita     ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$HD_Respuesta_Id     ,   PDO::PARAM_STR);
        $stmt->bindValue(4,$HD_Observacion      ,   PDO::PARAM_STR);
        $stmt->bindValue(5,$HD_Usuario_Id       ,   PDO::PARAM_STR);
        $stmt->bindValue(6,$HD_AmPm             ,   PDO::PARAM_STR);
        $stmt->execute();
        return ;
    }
    public function Genera_Detalle_Hoja_Ruta(  $id_encabezado  , 
                                               $contador       , 
                                               $Persona_Id     , 
                                               $atencion_id      )
    {
        self::set_names();
        // Insertar Registro en Tabla de Personas
        $sql="INSERT INTO hoja_detalle 
              VALUES ( NULL         , 
                       ?            ,
                       ?            ,
                       ?            ,
                       NULL         ,
                       NULL         ,
                       NULL         ,
                       NULL         ,
                       ?            , 
                       NULL);";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$id_encabezado       ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$contador            ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$Persona_Id          ,   PDO::PARAM_STR);
        $stmt->bindValue(4,$atencion_id         ,   PDO::PARAM_STR);
        $stmt->execute();
        return ;
    }
    public function Marcar_Atencion($atencion_id)
    {
        self::set_names();
        $Generada = "S";
        $sql="UPDATE atencion SET
                     Generada              =   ?       
                where
                     id     =?";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Generada             ,    PDO::PARAM_STR);
        $stmt->bindValue(2,$atencion_id          ,    PDO::PARAM_STR);
        $stmt->execute();
        return;
    }
    public function Graba_Ultima_Hoja($Movimiento , $Numero_Hoja_Inicio , $Numero_Hoja)
    {
        $sql="INSERT INTO hojas_generadas
                     VALUE ( NULL , CURRENT_TIMESTAMP, ?, ?, ?)";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Numero_Hoja_Inicio    ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Numero_Hoja           ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$Movimiento            ,   PDO::PARAM_STR);
        $stmt->execute();
        return;
    }
    public function get_hoja_por_numero($Numero)
    {
        if(isset($Numero))
        {
            self::set_names();
            $sql="SELECT hoja_cabeza.id                as HC_id                  ,
                         hoja_cabeza.Numero_Hoja       as HC_Numero_Hoja         ,
                         hoja_cabeza.Sector_Id         as HC_Sector_Id           ,
                         hoja_cabeza.Fecha_Entrega     AS HC_Fecha_Entrega       ,
                         hoja_cabeza.Fecha_Devolucion  as HC_Fecha_Devolucion    ,
                         hoja_cabeza.Fecha_Generada    as HC_Fecha_Generada      , 
                         hoja_cabeza.Usuario_Asignada  AS HC_Usuario_Asignada    ,
                         hoja_cabeza.Consulta_Id       AS HC_Consulta_Id         ,
                         hoja_detalle.id               as HD_id                  ,
                         hoja_detalle.Hoja_Cabeza_Id   as HD_Hoja_Cabeza_Id      ,
                         hoja_detalle.Item             as HD_Item                ,
                         hoja_detalle.Persona_Id       as HD_Persona_Id          ,
                         hoja_detalle.Respuesta_Id     as HD_Respuesta_Id        ,
                         hoja_detalle.Fecha_Visita     as HD_Fecha_Visita        ,
                         hoja_detalle.Usuario_Id       as HD_Usuario_Id          ,
                         hoja_detalle.Observacion      as HD_Observacion         ,
                         hoja_detalle.Atencion_Id      as HD_Atencion_Id         ,
                         hoja_detalle.ampm             as HD_AmPm                ,
                         persona.Nombre                as Per_Nombre             ,
                         persona.Apellido              as Per_Apellido           ,
                         persona.Rut                   as Per_Rut
                  FROM   hoja_cabeza
                  INNER JOIN hoja_detalle on hoja_detalle.Hoja_Cabeza_Id = hoja_cabeza.id
                  INNER JOIN persona      on persona.id                  = hoja_detalle.Persona_Id
                  WHERE hoja_cabeza.Numero_Hoja = ?;";
           $stmt=$this->dbh->prepare($sql);
           if($stmt->execute( array($Numero) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->act_atencion[]=$row;
                }
                return $this->act_atencion;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
    public function get_historico_por_id($id)
    {
        if(isset($id))
        {
            self::set_names();
            $sql="SELECT  hoja_historico.id                                 ,
                          hoja_historico.Hoja_Detalle_Id                    ,
                          hoja_historico.Fecha_Grabada                      ,
                          hoja_historico.Fecha_Visita                       ,
                          hoja_historico.Respuesta_Id                       ,
                          hoja_historico.Observacion                        ,
                          hoja_historico.Usuario_Id                         ,
                          hoja_historico.AmPm                               ,
                          usuario.Nombre                                    ,
                          usuario.Apellido                                  ,
                          persona.Nombre                as Per_Nombre       ,
                          persona.Apellido              as Per_Apellido
             from hoja_historico
             INNER JOIN usuario         on hoja_historico.Usuario_Id = usuario.id
             INNER JOIN hoja_detalle    on hoja_detalle.id           = hoja_historico.Hoja_Detalle_Id
             INNER JOIN persona         ON persona.id                = hoja_detalle.Persona_Id
             WHERE hoja_historico.Hoja_Detalle_Id = ?;";
           $stmt=$this->dbh->prepare($sql);
           if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->act_atencion[]=$row;
                }
                return $this->act_atencion;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
    public function get_historico_por_persona($id)
    {
        if(isset($id))
        {
            self::set_names();
            $sql="SELECT    persona.Rut                 as P_Rut              ,
                            persona.Nombre              as P_Nombre           ,
                            persona.Apellido            as P_Apellido         ,
                            atencion.Numero_Solicitud   as A_NSolicitud       ,
                            atencion.Fecha_Atencion     as A_FechaAtencion    ,
                            hoja_cabeza.Numero_Hoja     as HC_NumHoja         ,
                            hoja_historico.Fecha_Visita as HH_FechaVisita     ,
                            usuario.Nombre              as U_Nombre           ,
                            usuario.Apellido            as U_Apellido         ,
                            respuestas.Respuesta_Larga  as R_Respuesta_Larga  ,
                            hoja_historico.Observacion  as HH_Observacion     ,
                            consulta.Consulta           as C_Consulta
                  from hoja_detalle
                  inner join persona             on persona.id                      = hoja_detalle.persona_id
                  left  join hoja_historico      on hoja_historico.Hoja_Detalle_Id  = hoja_detalle.id
                  left  join atencion            on atencion.id                     = hoja_detalle.Atencion_Id
                  left  join hoja_cabeza         on hoja_cabeza.id                  = hoja_detalle.Hoja_Cabeza_Id
                  left  join usuario             on usuario.id                      = hoja_historico.Usuario_Id
                  left  join respuestas          on respuestas.id                   = hoja_historico.Respuesta_Id
                  left  join consulta            on consulta.id                     = hoja_cabeza.Consulta_Id
                  where persona.id = ?;";
           $stmt=$this->dbh->prepare($sql);
           if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->act_atencion[]=$row;
                }
                return $this->act_atencion;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }





    public function Genera_Atencion_Via_Web()
    {
        if(empty($_POST["Rut"])) { header("Location: Atenciones_Via_Web.php" ); exit; }
        self::set_names();
        // Insertar Registro en Tabla de Personas
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
        // Insertar Registro en Tabla de Atencion
        self::set_names();
        $Estado_Revisora  = '1';
        $Hora_Termino     = date("H:i",time());
        $Hora_Atencion    = date("H:i",time());
        $Estado_Atencion = '2'                       ; 
        $Fecha_Cierra    =  date("Y-m-d")            ; 
        $Fecha_Atencion  =  date("Y-m-d")            ; 
        $usuario_activo  = $_POST["id_usuario_act"]  ;   
        $usuario_cerrar  = $_POST["id_usuario_act"]  ;   
        $Observacion     = "Atencion Via Web";
        $Generada = "N";
        $sql="INSERT INTO atencion
              VALUES ( NULL , ?, ?, ?, ?, ?, null, null, ?, ?, null, ?, ?, ?);";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1  , $usuario_activo                ,    PDO::PARAM_STR);
        $stmt->bindValue(2  , $id_persona                    ,    PDO::PARAM_STR);
        $stmt->bindValue(3  , $Fecha_Atencion                ,    PDO::PARAM_STR);
        $stmt->bindValue(4  , $Hora_Atencion                 ,    PDO::PARAM_STR);
        $stmt->bindValue(5  , $Observacion                   ,    PDO::PARAM_STR);
        $stmt->bindValue(6  , $Estado_Atencion               ,    PDO::PARAM_STR);
        $stmt->bindValue(7  , $Estado_Revisora               ,    PDO::PARAM_STR);
        $stmt->bindValue(8  , $usuario_cerrar                ,    PDO::PARAM_STR);
        $stmt->bindValue(9  , $Fecha_Cierra                  ,    PDO::PARAM_STR);
        $stmt->bindValue(10 , $Generada                      ,    PDO::PARAM_STR);
        $stmt->execute();
        $id_atencion= $this->dbh->lastInsertId();
        //------------- Ingreso Registros en At_Consulta

        $consulta = $_POST["Radio"];
        $Estado_Consulta = 7;
        $sql="INSERT INTO ate_consulta
                    VALUES ( NULL , ?, ?, ?);";
         
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1 ,$consulta          ,    PDO::PARAM_STR);
        $stmt->bindValue(2 ,$id_atencion       ,    PDO::PARAM_STR);
        $stmt->bindValue(3 ,$Estado_Consulta   ,    PDO::PARAM_STR);
        $stmt->execute();
        
        //-----------------------------------------------
        //------------- Ingreso Registros en At_Programa
        //-----------------------------------------------
        $Programa=9;
        $sql="INSERT INTO ate_programa
              VALUES ( NULL , ?, ? );";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1 ,$Programa          ,    PDO::PARAM_STR);
        $stmt->bindValue(2 ,$id_atencion       ,    PDO::PARAM_STR);
        $stmt->execute();
        //---------------------------------------------------
        //------------- Fin Ingreso Registros en At_Programa
        //---------------------------------------------------
        
        header("Location: Atencion_Via_Web.php");exit;
    }
    public function Genera_Atencion_Via_Web_Persona_Existe()
    {
        while ($post = each($_POST))
        {
            echo $post[0] . " = " . $post[1];
        }
     
        // Insertar Registro en Tabla de Atencion
        self::set_names();
        $Estado_Revisora  = '1';
        $Hora_Termino     = date("H:i",time());
        $Hora_Atencion    = date("H:i",time());
        $Estado_Atencion = '2'                       ; 
        $Fecha_Cierra    =  date("Y-m-d")            ; 
        $Fecha_Atencion  =  date("Y-m-d")            ; 
        $usuario_activo  = $_POST["id_usuario_act"]  ;   
        $usuario_cerrar  = $_POST["id_usuario_act"]  ;   
        $Observacion     = "Atencion Via Web";
        $Generada = "N";
        $id_persona = $_POST["Persona_Id_VW"];
        $sql="INSERT INTO atencion
              VALUES ( NULL , ?, ?, ?, ?, ?, null, null, ?, ?, null, ?, ?, ?);";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1  , $usuario_activo                ,    PDO::PARAM_STR);
        $stmt->bindValue(2  , $id_persona                    ,    PDO::PARAM_STR);
        $stmt->bindValue(3  , $Fecha_Atencion                ,    PDO::PARAM_STR);
        $stmt->bindValue(4  , $Hora_Atencion                 ,    PDO::PARAM_STR);
        $stmt->bindValue(5  , $Observacion                   ,    PDO::PARAM_STR);
        $stmt->bindValue(6  , $Estado_Atencion               ,    PDO::PARAM_STR);
        $stmt->bindValue(7  , $Estado_Revisora               ,    PDO::PARAM_STR);
        $stmt->bindValue(8  , $usuario_cerrar                ,    PDO::PARAM_STR);
        $stmt->bindValue(9  , $Fecha_Cierra                  ,    PDO::PARAM_STR);
        $stmt->bindValue(10 , $Generada                      ,    PDO::PARAM_STR);
        $stmt->execute();
        $id_atencion= $this->dbh->lastInsertId();
        //------------- Ingreso Registros en At_Consulta

        $consulta = $_POST["Radio"];
        $Estado_Consulta = 7;
        $sql="INSERT INTO ate_consulta
                    VALUES ( NULL , ?, ?, ?);";
         
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1 ,$consulta          ,    PDO::PARAM_STR);
        $stmt->bindValue(2 ,$id_atencion       ,    PDO::PARAM_STR);
        $stmt->bindValue(3 ,$Estado_Consulta   ,    PDO::PARAM_STR);
        $stmt->execute();
        
        //-----------------------------------------------
        //------------- Ingreso Registros en At_Programa
        //-----------------------------------------------
        $Programa=9;
        $sql="INSERT INTO ate_programa
              VALUES ( NULL , ?, ? );";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1 ,$Programa          ,    PDO::PARAM_STR);
        $stmt->bindValue(2 ,$id_atencion       ,    PDO::PARAM_STR);
        $stmt->execute();
        //---------------------------------------------------
        //------------- Fin Ingreso Registros en At_Programa
        //---------------------------------------------------
        
        header("Location: Atencion_Via_Web.php");exit;
    }
}
?>