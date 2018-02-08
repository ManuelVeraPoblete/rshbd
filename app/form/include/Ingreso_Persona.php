<table class='table  '>
    <input type="hidden" name="Rut"            value=<?php echo $_POST['Rut_Ciudadano']     ;   ?>  >
    <input type="hidden" name="id_usuario_act" value=<?php echo $id_usuario_act             ;   ?>  >
    <tr>
        <td>Rut</td>
        <td>
            <input type="text"  
                   class="form-control" 
                   name="Rut"  
                   value=<?php echo $_POST["Rut_Ciudadano"] ;?> 
                   id="name" 
                   disabled placeholder="Nuevo Ingrese Rut Ciudadano" >
        </td>
    </tr>
    <tr>
        <td>Nombre</td>
        <td><input  type="text"  
                    class="form-control" 
                    name="Nombre"   
                    placeholder="Ingrese Nombre Ciudadano" >
        </td>                            
        <td>Apellido</td>
        <td><input  type="text"  
                    class="form-control" 
                    name="Apellido"  
                    placeholder="Ingrese Apellidos">
        </td>
    </tr>
    <tr>
        <td>Telefono</td>
        <td><input  type="text"  
                    class="form-control" 
                    name="Telefono"  
                    placeholder="Numero de Telefono">
        </td>
    </tr>
    <tr>
        <td>Poblacion</td>
        <td>
            <select name="Poblacion_Id" class="form-control" id="Poblacion" >
                <option value='0'>Seleccione Poblacion <option>
                <?php 
                    echo $combo_poblacion;
                ?>
            </select>
        </td>                            
        <td>Unidad Vecinal</td>
        <td>
            <select name="Unidad_Id" id="Unidad" class="form-control" id="Unidad_Vecinal">                            
            </select>
        </td>
    </tr>
    <tr>
        <td>Calle</td>
        <td>
            <select name="Calle_Id" class="form-control">
            <?php
                $calle=new Calle();
                $cal=$calle->get_calles();
                for($i=0;$i<sizeof($cal);$i++)
                {
                    ?>
                    <option  value="<?php echo $cal[$i]["id"];?>"><?php echo $cal[$i]["Calle"];?></option>
                    <?php 
                }?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Numero</td>
        <td><input  type='text' 
                    name='Numero' 
                    class='form-control'  
                    required  
                    placeholder="Numero ">
        </td>
        <td>Block</td>
        <td><input  type='text' 
                    name='Block'  
                    class='form-control'  
                    required  
                    placeholder="Numero de Block"></td>
    </tr>
    <tr>
        <td>Departamento</td>
        <td><input  type='text' 
                    name='Departamento'  
                    class='form-control'  
                    required  
                    placeholder="Numero de Departamento">
        </td>
        <td>Casa</td>
        <td><input  type='text' 
                    name='Casa' 
                    class='form-control'  
                    required  
                    placeholder="Numero de Casa"></td>
    </tr>
    <tr>
        <td>Referencia</td>
        <td><input  type="text"  
                    class="form-control" 
                    name="Referencia"   
                    placeholder="Ingrese Referencia Direccion" >
        </td>
    </tr>
</table>