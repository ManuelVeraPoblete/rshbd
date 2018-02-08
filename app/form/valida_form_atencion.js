<script>
	function valida_ing_atencion()
	{
		//valido el Nombre
		if (document.form_atencion.Nombre.value.length==0){
			//swal('No Ingreso Nombre...','Identificacion Ciudadano','error')
			swal("No Ingreso Nombre","Identificacion Ciudadano","error")
			return false;
		}
		//valido el Apellido
		if (document.form_atencion.Apellido.value.length==0){
			swal("No Ingreso Apellido","Identificacion Ciudadano","error")
			return false;
		}
		//valido el Telefono
		if (document.form_atencion.Telefono.value.length==0){
			swal("No Ingreso Numero de Telefono","Identificacion Ciudadano","error")
			return false;
		}
		//valido el Numero
		if (document.form_atencion.Numero.value.length==0){
			swal('No Numero en Direccion...','Identificacion Ciudadano','error')
			return false;
		}
		// Valido Block -- Departamento -- Casa
		if ( ( document.form_atencion.Block.value.length 		    == 0 &&
			     document.form_atencion.Departamento.value.length == 0 ) ||
			     document.form_atencion.Casa.value.length         == 0 )
    {
		  swal('Error identificacion Direccion...','Identificacion Ciudadano','error');
			return false;
		}
		if ( ( document.form_atencion.Unidad_Id.selectedIndex      == null    || document.form_atencion.Unidad_Id.selectedIndex    == 0 )  ||
			   ( document.form_atencion.Poblacion_Id.selectedIndex   == null    || document.form_atencion.Poblacion_Id.selectedIndex == 0 )  ||
			   ( document.form_atencion.Calle_Id.selectedIndex       == null    || document.form_atencion.Calle_Id.selectedIndex     == 0 ) 
        ) 
    {
			swal('Error en direccion hola...','Identificacion Ciudadano','error')
			return false;	 	
		}

		if (document.form_atencion.Folio_Rsh.value.length==0){
			swal('No Ingreso Folio Rsh...','Identificacion Atencion','error')
			return false;
		}

		if (document.form_atencion.Numero_Solicitud.value.length==0){
			swal('No Ingreso Numero Solicitud...','Identificacion Atencion','error')
			return false;
		}

		if (document.form_atencion.Fecha_Atencion.value.length==0){
			swal('No Ingreso Fecha de Atencion...','Identificacion Atencion','error')
			return false;
		}

		if (document.form_atencion.Hora_Atencion.value.length==0){
			swal('No Ingreso Hora de Atención...','Identificacion Atencion','error')
			return false;
		}
		if (document.form_atencion.Hora_Atencion.value.length==0){
			swal('No Ingreso Hora de Atención...','Identificacion Atencion','error')
			return false;
		}

		var elem_consulta = document.getElementsByName("consulta[]")
  	cont = 0;
  	x=0;
		for (x=0;x<elem_consulta.length;x++) 
    {
    	if (elem_consulta[x].checked == true){ cont = cont + 1; }
    }
    if ( cont == 0 )
    {
    	swal('No Ingreso consulta...','Identificacion Motivos','error')
    	return false;
    }
    var elem_programa = document.getElementsByName("programa[]")
    prog = 0;
  	i=0;
		for (i=0;i<elem_programa.length;i++)
    {
    	if (elem_programa[i].checked == true) { prog = prog + 1; }
    }
    if ( prog == 0 ) 
    {
    	swal('No Ingreso programa...','Identificacion Motivos','error');
    	return false;
    }



    var elem_documento = document.getElementsByName("documento[]");
    var elem_cierra = document.getElementsByName("Cierra");
    cont_docu = 0;
  	i=0;
		for (i=0;i<elem_documento.length;i++)
    {
    	if (elem_documento[i].checked == true) { cont_docu = cont_docu + 1; }
    }
    if ( cont_docu == 0 && elem_cierra[0].checked == false ) 
    {
    	swal('Atencion no esta cerrada debe Ingresar Documentos Faltantes...','Observaciones y Cierre','error')
    	return false;
    }

    if ( cont_docu > 0 && elem_cierra[0].checked == true ) 
    {
    	swal('Atencion esta cerrada no debe Ingresar Documentos Faltantes...','Observaciones y Cierre','error');
    	return false;
    }

    if ( document.form_atencion.Proxima_Visita.value.length==0 && elem_cierra[0].checked == false ) 
    {
    	swal('Atencion Pendiente, debe ingresar Fecha Proxima Visita...','Observaciones y Cierre','error');
    	return false;
    } else 
      {
        if ( document.form_atencion.Proxima_Visita.value.length != 0 && elem_cierra[0].checked == true ) 
        {
    	   swal('Atencion Cerrada, No debe ingresar Fecha Proxima Visita...','Observaciones y Cierre','error');
    	   return false;
        }
      }

    if (document.Observacion.value.length==0 && elem_cierra[0].checked == false )
    {
      swal('Atencion Pendiente, debe ingresar Observaciones...','Observaciones y Cierre','error');
      return false;
    }
	return true;
	}

	function aviso(value)
        {
        	var elem_cierra = document.getElementsByName("Cierra");
                if (elem_cierra[0].checked == true ) {
                    swal({
  							       title: 'Cerrara Atencion?',
  							       text: "Antes de cerrar, asegúrese de que han entregado la documentación completa y todos los formularios están firmados!",
  							       type: 'warning',
  							       showCancelButton: true,
  							       confirmButtonColor: '#3085d6',
  							       cancelButtonColor: '#d33',
  							       confirmButtonText: 'Si, Cerrare la Atencion!',
  							       cancelButtonText: 'No, Primero me Asegurare!',
  							       confirmButtonClass: 'btn btn-success',
  							       cancelButtonClass: 'btn btn-danger',
  							       buttonsStyling: false
						        }).then(function () {
  							       swal(
    							       'Confirmado!',
    							       'La atencion quedara cerrada.',
    							       'success'
							         )
							       }, function (dismiss) {
  								          if (dismiss === 'cancel') {
    									       swal(
      										        'Cancelado',
      										        'La Atencion Cambiara de Estado',
      										        'error'
    										        );
    								        $('input[name=cierra]').attr("disabled",false);$('input[name=cierra]').attr("checked",false);
  								        }
							       })
                }
                
        }
  function valida_nueva_atencion()()
  {
    
    if (document.form_atencion.Folio_Rsh.value.length==0){
      swal('No Ingreso Folio Rsh...','Identificacion Atencion','error')
      return false;
    }

    if (document.form_atencion.Numero_Solicitud.value.length==0){
      swal('No Ingreso Numero Solicitud...','Identificacion Atencion','error')
      return false;
    }

    if (document.form_atencion.Fecha_Atencion.value.length==0){
      swal('No Ingreso Fecha de Atencion...','Identificacion Atencion','error')
      return false;
    }

    if (document.form_atencion.Hora_Atencion.value.length==0){
      swal('No Ingreso Hora de Atención...','Identificacion Atencion','error')
      return false;
    }
    if (document.form_atencion.Hora_Atencion.value.length==0){
      swal('No Ingreso Hora de Atención...','Identificacion Atencion','error')
      return false;
    }

    var elem_consulta = document.getElementsByName("consulta[]")
    cont = 0;
    x=0;
    for (x=0;x<elem_consulta.length;x++) 
    {
      if (elem_consulta[x].checked == true){ cont = cont + 1; }
    }
    if ( cont == 0 )
    {
      swal('No Ingreso consulta...','Identificacion Motivos','error')
      return false;
    }
    var elem_programa = document.getElementsByName("programa[]")
    prog = 0;
    i=0;
    for (i=0;i<elem_programa.length;i++)
    {
      if (elem_programa[i].checked == true) { prog = prog + 1; }
    }
    if ( prog == 0 ) 
    {
      swal('No Ingreso programa...','Identificacion Motivos','error');
      return false;
    }
    var elem_documento = document.getElementsByName("documento[]");
    var elem_cierra = document.getElementsByName("Cierra");
    cont_docu = 0;
    i=0;
    for (i=0;i<elem_documento.length;i++)
    {
      if (elem_documento[i].checked == true) { cont_docu = cont_docu + 1; }
    }
    if ( cont_docu == 0 && elem_cierra[0].checked == false ) 
    {
      swal('Atencion no esta cerrada debe Ingresar Documentos Faltantes...','Observaciones y Cierre','error')
      return false;
    }

    if ( cont_docu > 0 && elem_cierra[0].checked == true ) 
    {
      swal('Atencion esta cerrada no debe Ingresar Documentos Faltantes...','Observaciones y Cierre','error');
      return false;
    }

    if ( document.form_atencion.Proxima_Visita.value.length==0 && elem_cierra[0].checked == false ) 
    {
      swal('Atencion Pendiente, debe ingresar Fecha Proxima Visita...','Observaciones y Cierre','error');
      return false;
    } else 
      {
        if ( document.form_atencion.Proxima_Visita.value.length != 0 && elem_cierra[0].checked == true ) 
        {
         swal('Atencion Cerrada, No debe ingresar Fecha Proxima Visita...','Observaciones y Cierre','error');
         return false;
        }
      }

    if (document.Observacion.value.length==0 && elem_cierra[0].checked == false )
    {
      swal('Atencion Pendiente, debe ingresar Observaciones...','Observaciones y Cierre','error');
      return false;
    }
  return true;
  }
</script>