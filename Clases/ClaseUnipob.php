<?php
require_once("ClaseConeccion.php");
class UniPob extends  Coneccion
{
    private $dbh            ;    private $unipob    ;
    public function __construct()
    {
        $this->dbh=parent::conecta();
        $this->unidad  =   array();
    }
    private function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");    
    }
    public function get_unipob_por_id($id)
    {
        self::set_names();
        $sql="SELECT unipob.Unidad_Id as uni_id , unidad.Unidad as uni_nm from unipob
              inner join  unidad on unidad.id = unipob.Unidad_Id
                WHERE unipob.Poblacion_Id =  ".$id;
        echo $sql;
        $stmt=$this->dbh->prepare($sql);
        if($stmt->execute( array($id) ) )
        {
            while($row = $stmt->fetch())
            {
                $this->unipob[]=$row;
            }
            return $this->unipob;
            $this->dbh=null;
        }
    }

    
}
?>