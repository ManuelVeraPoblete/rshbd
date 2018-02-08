<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="Menu_Sistema.php">RSH-Local</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Parametros <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="../app/Usuarios.php">Usuarios</a></li>
                        <li><a href="../app/Perfil.php">Perfiles</a></li>
                        <li><a href="Nivel.php">Nivel</a></li>
                        <li><a href="Modulos.php">Modulos de Atencion</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="Respuesta.php">Respuestas Hojas de Ruta</a></li>
                        <li><a href="Anulacion.php">Motivos de Anulacion Atenciones</a></li>
                        <li><a href="Documento.php">Documentos Atenciones</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="Programa.php">Programas Atencion</a></li>
                        <li><a href="Consulta.php">Consultas Atencion</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="Sector.php">Sectores</a></li>
                        <li><a href="Unidades.php">Unidades Vecinales</a></li>
                        <li><a href="Poblacion.php">Poblaciones</a></li>
                        <li><a href="Calle.php">Calles</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="Actividades.php">Actividades</a></li>
                    </ul>
                </li>
            </ul>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Procesos <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="Atenciones.php">Atenciones</a></li>
                            <li><a href="Personas.php">Consulta Ciudadano</a></li>
                            <li><a href="Revisa_Atencion.php">Revision de Atenciones</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="Llamados_Telefonicos.php">Llamados Telefonicos</a></li>
                            <li><a href="Atencion_Via_Web.php">Atenciones Via Web</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">Mensajes para Atencion</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">Genera Hojas de Ruta</a></li>
                            <li><a href="#">Imprime Hojs de Ruta</a></li>
                            <li><a href="#">Ingreso de Respuestas</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Ciudadanos Via Web <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Atenciones Via Web</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Consultas <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Ciudadanos</a></li>
                            <li><a href="#">Ejecutoras</a></li>
                            <li><a href="#">Revisoras</a></li>
                            <li><a href="#">Hojas de Ruta</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Informes<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Resumen de Atenciones Diarias ( Ejecutoras )</a></li>
                            <li><a href="#">Resumen de Atenciones Diarias</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Estadisticas<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Atenciones por Fecha</a></li>
                            <li><a href="#">Resumen de Atenciones por Fecha</a></li>
                            <li><a href="#">Hojas de Ruta</a></li>
                            <li><a href="#">Resumen Hojas de Ruta</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Almacenar Solicitudes<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Atenciones por Fecha</a></li>
                            <li><a href="#">Resumen de Atenciones por Fecha</a></li>
                            <li><a href="#">Hojas de Ruta</a></li>
                            <li><a href="#">Resumen Hojas de Ruta</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $nombre.' '.$apellido.'--'.substr($perfil, 0, 3).'  '.substr($nivel, 0, 3) ?><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Cambio de Clave</a></li>
                            <li><a href="#">Atenciones Pendientes</a></li>
                            <li><a href="Cerrar_Session.php">Salir del Sistema</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </div>
</nav>