<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="Menu_Sistema.php">RSH-Local</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Procesos <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="Atenciones.php">Atenciones</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="Llamados_Telefonicos.php">Llamados Telefonicos</a></li>
                            <li><a href="Atencion_Via_Web.php">Atenciones Via Web</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="Actividades_Diarias.php">Actividades Diarias</a></li>
                            
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Consultas <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="Personas.php">Ciudadano</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Informes<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="Resumen_Diario_Atenciones.php">Resumen de Atenciones Diarias ( Ejecutoras )</a></li>
                            <li><a href="Acumulado_Atenciones.php">Acumulado de Atenciones</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Estadisticas<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="Est_Atenciones_Fecha.php">Atenciones por Fecha</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="Actividades_Usuario.php">Actividades por Usuario</a></li>
                            
                        </ul>
                    </li>
                </ul>
                 <ul class="nav navbar-nav navbar-right">
                    <a href="Actividad_Terreno.php"><img src="../img/noticias.png" style="height: 43px;";>  </a>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-user"></span> 
                            <strong><?php echo $nombre.' '.$apellido?></strong>
                            <span class="glyphicon glyphicon-chevron-down"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="navbar-login">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <p class="text-center">
                                                <?php $foto = "../picusr/".$_SESSION['usr'].".jpg" ;?>
                                                <img src='<?php echo $foto ;?>' >
                                            </p>
                                        </div>
                                        <?php $Tiempo = time() - $_SESSION["time"] ; ?>
                                        <div class="col-lg-8">
                                            <table class='table  '>
                                                <tr>
                                                    <td><strong><?php echo 'Perfil';?> </strong></td>
                                                    <td><strong><?php echo $perfil; ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td><strong><?php echo 'Nivel '?></strong></td>
                                                    <td><strong><?php echo $nivel ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td><strong><?php echo 'Tiempo '?></strong></td>
                                                    <td><strong><?php echo conversorSegundosHoras($Tiempo); ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td><strong><?php echo 'Modulo '?></strong></td>
                                                    <td><strong><?php echo $Modulo_Atencion; ?></strong></td>
                                                </tr>
                                            </table>
                                            <!--<p class="text-left">
                                                <a href="#" class="btn btn-primary btn-block btn-sm">Actualizar Datos</a>
                                            </p> -->
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="navbar-login navbar-login-session">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p>
                                                <button data-toggle="modal" data-target="#view-modal" data-id="<?php echo $id_usuario;?>" id="CambioClave" class="btn btn-primary btn-block"> Cambiar Clave</button>
                                            </p>
                                        </div>
                                        <div class="col-lg-12">
                                            <p>
                                                <a href="Cerrar_Session.php" class="btn btn-danger btn-block">Cerrar Sesion</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </div>
</nav>