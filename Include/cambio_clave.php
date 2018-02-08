<!-- ***************************************************************************************************** -->    
<!-- ***************************************************************************************************** -->    
<!-- ***************************************************************************************************** -->    
    <div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="CambioClave" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width: auto; margin-left: 30%; margin-right:30%"> 
            <div class="modal-content"> 
                <div class="modal-header"> 
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                    <h4 class="modal-title">
                        <i class="glyphicon glyphicon-user"></i> Cambio de Clave Usuario 
                    </h4> 
                </div> 
                <div class="modal-body"> 
                    <div id="modal-loader" style="display: none; text-align: center;">
                        <img src="../img/ajax-loader.gif">
                    </div>
                    <!-- content will be load here -->                          
                    <div id="dynamic-content">
                    	<form class="form-horizontal" accept-charset="UTF-8" action="Menu_Sistema.php"  method="post">
    						<div class="form-group">
            					<label class="control-label col-lg-4" for="email">Nueva Password:</label>
            					<div class="col-md-10">
                					<input type="password" class="form-control" name="Nueva_Password"  placeholder="Nueva Passsword">
            					</div>
        					</div>
        					<div class="form-group">
            					<label class="control-label col-lg-4" for="email">Confirma Password:</label>
            					<div class="col-md-10">
                					<input type="password" class="form-control" name="Confirma_Nueva_Password"  placeholder="Confirma Password">
            					</div>
        					</div>
    						<center>
        						<div class="col-md-11">
            						<center>
                						<ul class="list-group">
                    						<li class="list-group-item">
                        						<button class="form-control btn btn-primary">Cambiar Clave</button>   
                    						</li>
                						</ul>
            						</center>
        						</div>
    						</center>
						</form>

                    </div>
                </div> 
            </div> 
        </div>
    </div><!-- /.modal -->    
<!-- ***************************************************************************************************** -->    
<!-- ***************************************************************************************************** -->    
<!-- ***************************************************************************************************** -->    