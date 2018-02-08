<?php
class ArrayConsulta
{
    private $dbh            ;    private $ArrayConsulta    ;
    public function __construct()
    {
        $this->actividades      =   array();
    }
    private function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");    
    }
    
    /****************Perfiles***************/
    public function Llenar_Matriz($Matriz)
    {
        for($i=0;$i<sizeof($Matriz);$i++) {
            $arreglo_consulta[$i]["id"]               = $Matriz[$i]["id"];
            $arreglo_consulta[$i]["Consulta"]         = $Matriz[$i]["Consulta"];
            $arreglo_consulta[$i]["Requerimiento_Id"] = $Matriz[$i]["Requerimiento_Id"];
            $arreglo_consulta[$i]["Estado"]           = 0;
        }

        return $arreglo_consulta;
    }

    public function Cambiar_Matriz($Matriz)
    {
        for($i=0;$i<sizeof($Matriz);$i++) {
            $arreglo_consulta[$i]["id"]               = $Matriz[$i]["id"];
            $arreglo_consulta[$i]["Consulta"]         = $Matriz[$i]["Consulta"];
            $arreglo_consulta[$i]["Requerimiento_Id"] = $Matriz[$i]["Requerimiento_Id"];
            $arreglo_consulta[$i]["Estado"]           = $Matriz[$i]["Estado"];
        }
        return $arreglo_consulta;
    }
    
}
?>