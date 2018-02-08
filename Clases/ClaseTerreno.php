<?php
require_once("ClaseConeccion.php");
class Terreno extends  Coneccion
{
    private $dbh                    ;    
    private $terreno                ;
    public function __construct()
    {
        $this->dbh=parent::conecta();
        $this->terreno      =   array();
    }

    private function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");    
    }
    
    public function Get_Terreno()
    {
        self::set_names();
        $sql="SELECT    terreno.id , 
                        terreno.Operativo_Id,
                        operativo.Operativo,
                        terreno.Fecha_Operativo,
                        terreno.Hora,
                        terreno.Descripcion,
                        terreno.Lugar,
                        terreno.Responsable_Id,
                        usuario.Nombre,
                        usuario.Apellido,
                        terreno.Pob_Esperada,
                        terreno.Pob_Atendida
                from terreno
                inner join operativo  on operativo.id             = terreno.Operativo_Id
                inner join usuario    on terreno.Responsable_Id   = usuario.id
                ORDER BY terreno.Fecha_Operativo , terreno.Hora ASC";
        foreach ($this->dbh->query($sql) as $row)
        {
            $this->terreno[]=$row;
        }  
        return $this->terreno;
        $this->dbh=null;
    }
}
?>