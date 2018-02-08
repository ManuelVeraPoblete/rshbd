<?php
	require_once("../Include/Rutinas.php")          ;
	require_once("../Paginacion/Logeo.php")         ;
	require_once("../Clases/ClaseUsuario.php")      ;
	require_once("../Clases/ClaseModulo.php")       ;
    require_once("../Clases/ClaseLogeo.php")        ;
    if ( isset($_POST["Nueva_Password"])  and isset($_POST["Confirma_Nueva_Password"]) )
    {
        $Nueva_Pass          = $_POST["Nueva_Password"]              ;
        $Confirma_Nueva_Pass = $_POST["Confirma_Nueva_Password"]     ;
        $Usuario_Id          = $_SESSION["id_usuario"]               ;
        if ( $Nueva_Pass == $Confirma_Nueva_Pass ) {
            $Usr = new Usuario;
            $Usr->cambia_password($Usuario_Id, $Nueva_Pass);
        }
    }
    if ( $_SESSION["Modulo"] == "" )
    {
        if ( isset ($_POST["Selecciono_Modulo"]) and  $_POST["Selecciono_Modulo"] == "Si"  and $_SESSION["per_id"]  == '3'  ) 
        {
            if ( $_POST["Modulo_Id"] > 0 )
            {
                $log = new Logeo();
                $_SESSION["Modulo"] = $_POST["Modulo_Id"];
                $log->Add_Logeo($_POST["Modulo_Id"],$_SESSION["id_usuario"]);
            }
        } else 
            {
            if ($_SESSION["per_id"] !== '3' )
            {
                $_SESSION["Modulo"] = 100;
                $log = new Logeo();
                $log->Add_Logeo($_SESSION["Modulo"],$_SESSION["id_usuario"]);
            }      
        }
    } 
?>
<html>
    <?php require_once("../Include/Header.php"); ?>
    <body>
        <?php
        	if ($_SESSION["per_id"]  == '3' and $_SESSION["Modulo"] == "") 
			{ ?>
		        <br><br>
				<center>
		    		<div clas="container" style="width: 39%;">
               			<div class="box-blue">
                    		<h4>
                             <form class="form-horizontal" accept-charset="UTF-8" action="Menu_Sistema.php"  method="post">
                        		<h4>Bienvenido   <strong><?php echo $nombre.' '.$apellido?></strong></h4>
                        		<br>
					        	<br>
                            	<td>
                                	<select name="Modulo_Id" class="form-control">
                                	<option  value="0"> Seleccione Modulo de Atencion </option>
                                	<?php
                                    	$calle=new Modulo();
                                    	$cal=$calle->get_modulos();
                                    	for($i=0;$i<sizeof($cal);$i++)
                                    	{
                                        	?>
                                        	<option  value="<?php echo $cal[$i]["id"];?>"><?php echo $cal[$i]["Modulo"];?></option>
                                        	<?php 
                                    	}?>
                                	</select>
                            	</td>
                            	<br>
                                <input type="hidden" name="Selecciono_Modulo" value="Si">
                            	<button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Ingresar</button>
                                <br>
                            	<a href="Cerrar_Session.php" title="Agregar Cliente">
                                    <button class="btn btn-lg btn-primary btn-block btn-signin" type='button' class="btn btn-info" data-toggle="modal" >
                                        Salir
                                    </button>   
                                </a>
                            </form>
                		</div>
		        	</div>
		        </center> <?php
			} else {
                if ( $_SESSION["per_id"]  == '3') {
                    require_once("../Include/Menu_Perfil_3.php");     
                }else {
                    require_once("../Include/Menu.php");     
                }
         		Include("../Include/footer.php");
         	}
        ?>
    </body>
    <?php
        require_once("../Include/Cambio_Clave.php"); 
    ?>
</html>
