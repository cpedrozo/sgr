<?php
class form_estado_actual extends sgr_ei_formulario
{
	//-----------------------------------------------------------------------------------
	//---- JAVASCRIPT -------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function extender_objeto_js()
	{
    if (!$this->controlador()->get_id()[1]=='1000891')
      {
  		echo "
  		//---- Procesamiento de EFs --------------------------------

  		/**
  		 * CARGA EL ESTADO ACTUAL
  		 */
  		{$this->objeto_js}.evt__id_estado__procesar = function(es_inicial)
  		{
  			if (es_inicial) {
          var ids_flujo = [];
  				ids_flujo['id_workflow'] = 0;
  				this.controlador.ajax('traerinfo_estadoactual', ids_flujo, this, this.resp_estadoactual);
          console.log('es inicial');
  			}
        else{
          console.log('no es inicial');
        }
  		}

      {$this->objeto_js}.resp_estadoactual = function(datos)
  		{
        //console.log('saarasa');
        var opciones = [];
        datos.forEach(function(elemento)
        {
          opcion = [];
          opcion.push(elemento['id_estado']);
          opcion.push(elemento['nombre']);
          opciones.push(opcion);
        })
        this.ef('id_estado').set_opciones_rs(opciones);
        this.ef('id_estado').set_estado(opciones[0][0]);
        this.ef('id_estado').set_solo_lectura(true);
  		}
  		";
    }
    else{
      echo "
      {$this->objeto_js}.ef('id_estado').set_solo_lectura(true);
      ";
  }
  }
}

?>
