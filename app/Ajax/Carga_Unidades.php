<?php
require("../../Clases/ClaseUnipob.php");
$salida="";
$id_unidad=$_POST["elegido"];
$unif=new UniPob();
$uni=$unif->get_unipob_por_id($id_unidad);


for($i=0;$i<sizeof($uni);$i++)
  {
  ?>
    <option  value="<?php echo $uni[$i]["uni_id"];?>"><?php echo $uni[$i]["uni_nm"];?></option>
  <?php 
  }?>
</select>