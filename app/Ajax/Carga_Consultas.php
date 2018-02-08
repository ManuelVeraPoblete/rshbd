<?php
require("../../Clases/ClaseConsulta.php");
$id_requerimiento=$_POST["elegido"];
$Array_Consulta=$_POST["ArrayConsulta"];
for($j=0;$j<sizeof($Array_Consulta);$j++)
{
  if ($Array_Consulta[$j]["Requerimiento_Id"] == $id_requerimiento ) 
  {
    echo $j.' '.$Array_Consulta[$j]["id"].' '.$Array_Consulta[$j]["Consulta"].' '.$Array_Consulta[$j]["Requerimiento_Id"].' '.$Array_Consulta[$j]["Estado"].'<br>';
  }
}
for($i=0;$i<sizeof($Array_Consulta);$i++)
  {
  	if ($Array_Consulta[$i]["Requerimiento_Id"] == $id_requerimiento)
  	{
  		?>
  			<li class="list-group-item">
    			<?php echo $Array_Consulta[$i]["Consulta"];?>
				  <div class="material-switch pull-right">
    				<?php
      		  if ($Array_Consulta[$i]["Estado"] == 0 ) 
    				{  ?>
        				<input id="<?php echo 'con'.$Array_Consulta[$i]["id"] ;?>" 
    				           value="<?php echo $i;?>" 
    				           name="Array_Consulta[]" 
                       type="checkbox" 
                       onclick="CambiaEstado(this.value)"  />
        			<?php
        			} else { ?>
        				<input id="<?php echo 'con'.$Array_Consulta[$i]["id"] ;?>" 
                       value="<?php echo $i;?>" 
                       name="Array_Consulta[]" 
                       type="checkbox" 
                       onclick="CambiaEstado(this.value)" 
                       checked/>
        			<?php } ?>
      				<label for="<?php echo 'con'.$Array_Consulta[$i]["id"] ;?>" class="label-success"></label>
    			</div>
    		</li>
  		<?php 
  	}
  }?>


