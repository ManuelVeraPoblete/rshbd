<?php
require_once("ClaseConeccion.php");
class ActividadesDiarias extends  Coneccion
{
    private $dbh            ;    private $actividades_diarias    ;
    public function __construct()
    {
        $this->dbh=parent::conecta();
        $this->actividades_diarias      =   array();
    }
    private function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");    
    }
    
    /****************Perfiles***************/

    public function get_actividades_diarias_por_meses_por_usuario($Usuario_Actividad)
    {

        $Mes_Actual = date('n');$Anio_Actual = date('Y');
        self::set_names();
        $sql="SELECT  actividades.Actividades as Nombre_Actividad,  
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) =  1 THEN actividad_diaria.Cantidad ELSE 0 END ) AS ' 1', SUM(CASE WHEN DAY (actividad_diaria.Fecha) =  2 THEN actividad_diaria.Cantidad ELSE 0 END ) AS ' 2', 
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) =  3 THEN actividad_diaria.Cantidad ELSE 0 END ) AS ' 3', SUM(CASE WHEN DAY (actividad_diaria.Fecha) =  4 THEN actividad_diaria.Cantidad ELSE 0 END ) AS ' 4',
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) =  5 THEN actividad_diaria.Cantidad ELSE 0 END ) AS ' 5', SUM(CASE WHEN DAY (actividad_diaria.Fecha) =  6 THEN actividad_diaria.Cantidad ELSE 0 END ) AS ' 6', 
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) =  7 THEN actividad_diaria.Cantidad ELSE 0 END ) AS ' 7', SUM(CASE WHEN DAY (actividad_diaria.Fecha) =  8 THEN actividad_diaria.Cantidad ELSE 0 END ) AS ' 8',
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) =  9 THEN actividad_diaria.Cantidad ELSE 0 END ) AS ' 9', SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 10 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '10', 
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 11 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '11', SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 12 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '12',
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 13 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '13', SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 14 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '14', 
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 15 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '15', SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 16 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '16',
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 17 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '17', SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 18 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '18', 
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 19 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '19', SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 20 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '20',
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 21 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '21', SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 22 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '22', 
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 23 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '23', SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 24 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '24',
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 25 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '25', SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 26 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '26', 
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 27 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '27', SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 28 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '28',
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 29 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '29', SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 30 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '30',
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 31 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '31'
                FROM       actividad_diaria
                INNER JOIN actividades ON actividades.id = actividad_diaria.Actividad_Id
                INNER JOIN usuario ON usuario.id = actividad_diaria.Usuario_Id
                Where actividad_diaria.Usuario_Id = ? and MONTH(actividad_diaria.Fecha) =$Mes_Actual and YEAR(actividad_diaria.Fecha) = $Anio_Actual
                GROUP BY Nombre_Actividad
                ORDER BY actividad_diaria.Actividad_Id ,  MONTH(actividad_diaria.Fecha)";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Usuario_Actividad        ,   PDO::PARAM_STR);
        $stmt->execute();
        
            while($row = $stmt->fetch())
            {
                $this->actividades_diarias[]=$row;
            }
            return $this->actividades_diarias;
            $this->dbh=null;
        
    }
    public function get_actividades_diarias_por_usuario_fecha($Fecha_Desde , $Fecha_Hasta)
    {

        
        self::set_names();
        $sql="SELECT  usuario.Nombre, usuario.Apellido, actividades.Actividades as Nombre_Actividad,  
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) =  1 THEN actividad_diaria.Cantidad ELSE 0 END ) AS ' 1', SUM(CASE WHEN DAY (actividad_diaria.Fecha) =  2 THEN actividad_diaria.Cantidad ELSE 0 END ) AS ' 2', 
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) =  3 THEN actividad_diaria.Cantidad ELSE 0 END ) AS ' 3', SUM(CASE WHEN DAY (actividad_diaria.Fecha) =  4 THEN actividad_diaria.Cantidad ELSE 0 END ) AS ' 4',
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) =  5 THEN actividad_diaria.Cantidad ELSE 0 END ) AS ' 5', SUM(CASE WHEN DAY (actividad_diaria.Fecha) =  6 THEN actividad_diaria.Cantidad ELSE 0 END ) AS ' 6', 
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) =  7 THEN actividad_diaria.Cantidad ELSE 0 END ) AS ' 7', SUM(CASE WHEN DAY (actividad_diaria.Fecha) =  8 THEN actividad_diaria.Cantidad ELSE 0 END ) AS ' 8',
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) =  9 THEN actividad_diaria.Cantidad ELSE 0 END ) AS ' 9', SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 10 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '10', 
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 11 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '11', SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 12 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '12',
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 13 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '13', SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 14 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '14', 
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 15 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '15', SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 16 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '16',
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 17 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '17', SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 18 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '18', 
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 19 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '19', SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 20 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '20',
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 21 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '21', SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 22 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '22', 
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 23 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '23', SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 24 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '24',
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 25 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '25', SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 26 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '26', 
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 27 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '27', SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 28 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '28',
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 29 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '29', SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 30 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '30',
                SUM(CASE WHEN DAY (actividad_diaria.Fecha) = 31 THEN actividad_diaria.Cantidad ELSE 0 END ) AS '31'
                FROM       actividad_diaria
                INNER JOIN actividades ON actividades.id = actividad_diaria.Actividad_Id
                INNER JOIN usuario ON usuario.id = actividad_diaria.Usuario_Id
                Where actividad_diaria.Fecha BETWEEN ? and ?
                GROUP BY Nombre_Actividad
                ORDER BY actividad_diaria.Actividad_Id ,  MONTH(actividad_diaria.Fecha)";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Fecha_Desde        ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Fecha_Hasta        ,   PDO::PARAM_STR);
        $stmt->execute();
        
            while($row = $stmt->fetch())
            {
                $this->actividades_diarias[]=$row;
            }
            return $this->actividades_diarias;
            $this->dbh=null;
        
    }
    public function get_actividades_acumuladas($Fecha_Desde , $Fecha_Hasta)
    {
        self::set_names();
        $sql="SELECT  actividades.Actividades as Nombre_Actividad,  SUM(actividad_diaria.Cantidad ) AS Total_Actividad
              FROM       actividad_diaria
              INNER JOIN actividades ON actividades.id = actividad_diaria.Actividad_Id
              Where actividad_diaria.Fecha BETWEEN ? and ?
              GROUP BY Nombre_Actividad
              ORDER BY actividad_diaria.Actividad_Id ,  MONTH(actividad_diaria.Fecha)";
                
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Fecha_Desde        ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Fecha_Hasta        ,   PDO::PARAM_STR);
        $stmt->execute();
        
            while($row = $stmt->fetch())
            {
                $this->actividades_diarias[]=$row;
            }
            return $this->actividades_diarias;
            $this->dbh=null;
        
    }
    public function Elimina_Actividad($id)
    {
        self::set_names();
        $sql="DELETE  actividad_diaria.* 
              FROM       actividad_diaria
              Where actividad_diaria.id = ? ";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$id        ,   PDO::PARAM_STR);
        $stmt->execute();
        while($row = $stmt->fetch())
        {
            $this->actividades_diarias[]=$row;
        }
        header("Location: Actividades_Diarias.php");
        exit;
    }
}
?>