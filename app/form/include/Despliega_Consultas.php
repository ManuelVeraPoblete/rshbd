
                <div class="col-sm-3">
                    <ul class="list-group" id="Consultas_1" >
                        <?php 
                            for($i=0;$i<sizeof($ArrayConsulta);$i++)
                            {
                            if ($ArrayConsulta[$i]["Requerimiento_Id"] == 1)
                            {?>
                                <li class="list-group-item">
                                    <?php echo $ArrayConsulta[$i]["Consulta"];?>
                                    <div class="material-switch pull-right">
                                    <?php
                                        if ($ArrayConsulta[$i]["Estado"] == 0 ) 
                                        {  ?>
                                            <input  id="<?php echo 'con'.$ArrayConsulta[$i]["id"] ;?>" 
                                                    value="<?php echo $i;?>" 
                                                    name="ArrayConsulta[]" 
                                                    type="checkbox" 
                                                    onclick="CambiaEstado(this.value)"  />
                                        <?php
                                        } else { ?>
                                            <input  id="<?php echo 'con'.$ArrayConsulta[$i]["id"] ;?>" 
                                                    value="<?php echo $i;?>" 
                                                    name="ArrayConsulta[]" 
                                                    type="checkbox" 
                                                    onclick="CambiaEstado(this.value)" 
                                                    checked/>
                                        <?php } ?>
                                        <label for="<?php echo 'con'.$ArrayConsulta[$i]["id"] ;?>" class="label-success"></label>
                                    </div>
                                </li>
                            <?php 
                            }}
                        ?>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <ul class="list-group" id="Consultas_1" style="width: 69%;">
                        <?php 
                            for($i=0;$i<sizeof($ArrayConsulta);$i++)
                            {
                            if ($ArrayConsulta[$i]["Requerimiento_Id"] == 2)
                            {?>
                                <li class="list-group-item">
                                    <?php echo $ArrayConsulta[$i]["Consulta"];?>
                                    <div class="material-switch pull-right">
                                    <?php
                                        if ($ArrayConsulta[$i]["Estado"] == 0 ) 
                                        {  ?>
                                            <input  id="<?php echo 'con'.$ArrayConsulta[$i]["id"] ;?>" 
                                                    value="<?php echo $i;?>" 
                                                    name="ArrayConsulta[]" 
                                                    type="checkbox" 
                                                    onclick="CambiaEstado(this.value)"  />
                                        <?php
                                        } else { ?>
                                            <input  id="<?php echo 'con'.$ArrayConsulta[$i]["id"] ;?>" 
                                                    value="<?php echo $i;?>" 
                                                    name="ArrayConsulta[]" 
                                                    type="checkbox" 
                                                    onclick="CambiaEstado(this.value)" 
                                                    checked/>
                                        <?php } ?>
                                        <label for="<?php echo 'con'.$ArrayConsulta[$i]["id"] ;?>" class="label-success"></label>
                                    </div>
                                </li>
                            <?php 
                            }}
                        ?>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <ul class="list-group" id="Consultas_1" style="width: 69%;">
                        <?php 
                            for($i=0;$i<sizeof($ArrayConsulta);$i++)
                            {
                            if ($ArrayConsulta[$i]["Requerimiento_Id"] == 3)
                            {?>
                                <li class="list-group-item">
                                    <?php echo $ArrayConsulta[$i]["Consulta"];?>
                                    <div class="material-switch pull-right">
                                    <?php
                                        if ($ArrayConsulta[$i]["Estado"] == 0 ) 
                                        {  ?>
                                            <input  id="<?php echo 'con'.$ArrayConsulta[$i]["id"] ;?>" 
                                                    value="<?php echo $i;?>" 
                                                    name="ArrayConsulta[]" 
                                                    type="checkbox" 
                                                    onclick="CambiaEstado(this.value)"  />
                                        <?php
                                        } else { ?>
                                            <input  id="<?php echo 'con'.$ArrayConsulta[$i]["id"] ;?>" 
                                                    value="<?php echo $i;?>" 
                                                    name="ArrayConsulta[]" 
                                                    type="checkbox" 
                                                    onclick="CambiaEstado(this.value)" 
                                                    checked/>
                                        <?php } ?>
                                        <label for="<?php echo 'con'.$ArrayConsulta[$i]["id"] ;?>" class="label-success"></label>
                                    </div>
                                </li>
                            <?php 
                            }}
                        ?>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <ul class="list-group" id="Consultas_1" style="width: 69%;">
                        <?php 
                            for($i=0;$i<sizeof($ArrayConsulta);$i++)
                            {
                            if ($ArrayConsulta[$i]["Requerimiento_Id"] == 4)
                            {?>
                                <li class="list-group-item">
                                    <?php echo $ArrayConsulta[$i]["Consulta"];?>
                                    <div class="material-switch pull-right">
                                    <?php
                                        if ($ArrayConsulta[$i]["Estado"] == 0 ) 
                                        {  ?>
                                            <input  id="<?php echo 'con'.$ArrayConsulta[$i]["id"] ;?>" 
                                                    value="<?php echo $i;?>" 
                                                    name="ArrayConsulta[]" 
                                                    type="checkbox" 
                                                    onclick="CambiaEstado(this.value)"  />
                                        <?php
                                        } else { ?>
                                            <input  id="<?php echo 'con'.$ArrayConsulta[$i]["id"] ;?>" 
                                                    value="<?php echo $i;?>" 
                                                    name="ArrayConsulta[]" 
                                                    type="checkbox" 
                                                    onclick="CambiaEstado(this.value)" 
                                                    checked/>
                                        <?php } ?>
                                        <label for="<?php echo 'con'.$ArrayConsulta[$i]["id"] ;?>" class="label-success"></label>
                                    </div>
                                </li>
                            <?php 
                            }}
                        ?>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <ul class="list-group" id="Consultas_1" style="width: 69%;">
                        <?php 
                            for($i=0;$i<sizeof($ArrayConsulta);$i++)
                            {
                            if ($ArrayConsulta[$i]["Requerimiento_Id"] == 4)
                            {?>
                                <li class="list-group-item">
                                    <?php echo $ArrayConsulta[$i]["Consulta"];?>
                                    <div class="material-switch pull-right">
                                    <?php
                                        if ($ArrayConsulta[$i]["Estado"] == 0 ) 
                                        {  ?>
                                            <input  id="<?php echo 'con'.$ArrayConsulta[$i]["id"] ;?>" 
                                                    value="<?php echo $i;?>" 
                                                    name="ArrayConsulta[]" 
                                                    type="checkbox" 
                                                    onclick="CambiaEstado(this.value)"  />
                                        <?php
                                        } else { ?>
                                            <input  id="<?php echo 'con'.$ArrayConsulta[$i]["id"] ;?>" 
                                                    value="<?php echo $i;?>" 
                                                    name="ArrayConsulta[]" 
                                                    type="checkbox" 
                                                    onclick="CambiaEstado(this.value)" 
                                                    checked/>
                                        <?php } ?>
                                        <label for="<?php echo 'con'.$ArrayConsulta[$i]["id"] ;?>" class="label-success"></label>
                                    </div>
                                </li>
                            <?php 
                            }}
                        ?>
                    </ul>
                </div>
