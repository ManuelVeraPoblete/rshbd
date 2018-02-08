<form  class="form-horizontal" name="form_atencion" id="form_atencion" action="" accept-charset="UTF-8" method="post"  onsubmit="return valida_ing_atencion()" novalidate>
    <div class="panel-body">
        <div class="tab-content">
            <div class="tab-pane fade in active" id="Ide_Ciudadano">
                <?php
                     require_once("include/Despliega_Datos_Personas.php");
                ?>
            </div>
        
            <!-- ############################### -->
            <!-- Inicio de Atencion VIA WEB      -->
            <!-- ############################### -->
            <div class="tab-pane fade" id="Ide_Atencion">
                <div class="container">
                    <div class="form-group ">
                        <label for="exampleInputText">Observacion</label>
                        <textarea       class       =   "form-control" 
                                        name        =   "Respuesta" 
                                        type        =   "textarea" 
                                        id          =   "message" 
                                        placeholder =   "Respuesta" 
                                        maxlength   =   "600" 
                                        rows        =   "10" 
                                        style       =   "width: 85%;">
                        </textarea>
                    </div>
                </div>
                <div class="container">
                    <div class="col-md-6">
                        <h4>Tipo de Atencion Web</h4>
                        <div class="funkyradio">
                            <h4>
                                <div class="funkyradio-success">
                                    <input type="radio" name="Radio" id="radio1" value='7' />
                                    <label for="radio1">Ingreso al Registro</label>
                                </div>
                            
                                <div class="funkyradio-success">
                                    <input type="radio" name="Radio" id="radio2" value ='5' />
                                    <label for="radio2">Cambio de Domicilio</label>
                                </div>
                                <div class="funkyradio-success">
                                    <input type="radio" name="Radio" id="radio3" value ='6'/>
                                    <label for="radio3">Modulo de Vivienda</label>
                                </div>
                            </h4>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="PE_Nueva_Atencion"  value="SI">
                <input type="hidden" name="Persona_Id_VW"      value="<?php echo $datos_per[0]["id"];?>">
                <input type="hidden" name="id_usuario_act"     value="<?php echo $_SESSION["id_usuario"];?>">
                <ul class="list-group">
                    <li class="list-group-item">
                        <button class="form-control btn btn-primary" type="button submit">Grabar</button>   
                    </li>
                </ul>
            </div>
            <!-- ############################### -->
            <!-- Fin de Atencion VIA WEB      -->
            <!-- ############################### -->
        </div>
    </div>
</form>