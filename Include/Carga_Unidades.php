<?php
$Combo_Unidades="";
$carga_uni=new Unidad();
$carga_unidades=$carga_uni->get_unidades();
for($i=0;$i<sizeof($carga_unidades);$i++)
    {
       	?>
         <option  value="<?php echo $carga_unidades[$i]["id"];?>"><?php echo $carga_unidades[$i]["Unidad"];?></option>
        <?php 
    }
?>