<?php
class form_nuevoregistro extends sgr_ei_formulario
{
	//-----------------------------------------------------------------------------------
	//---- JAVASCRIPT -------------------------------------------------------------------
	//-----------------------------------------------------------------------------------
//
	function extender_objeto_js()
	{
		echo "
		//---- Validacion de ingreso de caracteres ----------------------------------

		{$this->objeto_js}.ini = function ()
		{
			{$this->objeto_js}.ef('nombre').input().onkeyup = function()
			{
				var ef = {$this->objeto_js}.ef('nombre');
				var texto = ef.get_estado().toUpperCase();

				var texto_comprobado = texto.match(/[a-zA-Z\s]/gi);
				//--var texto_comprobado = texto.match(/[a-zA-Z\[Á-Ú\[0-9\:\! ¡¿?_°./\-\']/gi);
				var cadena = texto_comprobado.toString();
				while(cadena.indexOf(',') >= 0){
					cadena = cadena.replace(',','');
				}
				ef.set_estado(cadena);
			}

		}

		//---- Procesamiento de EFs --------------------------------

		/**
		 * M�todo que se invoca al cambiar el valor del ef en el cliente
		 * Se dispara inicialmente al graficar la pantalla, enviando en true el primer par�metro
		 */
		{$this->objeto_js}.evt__id_workflow__procesar = function(es_inicial)
		{
			if (!es_inicial) {
				console.log('me ejecuto');
				var ids_flujo = [];
				ids_flujo['id_workflow'] = {$this->objeto_js}.ef('id_workflow').get_estado();
				ids_flujo['id_estadoorigen'] = js_form_1000890_form_estado_actual.ef('id_estado').get_estado();
				this.controlador.ajax('traerinfo_flujodetrabajo', ids_flujo, this, this.respflujo);
			}
		}

    {$this->objeto_js}.respflujo = function(datos2)
		{
      console.log('esta es la respuesta que busca ud');
      var opciones = [];
      datos2.forEach(function(elemento)
      {
        opciones[elemento['iddestino']] = elemento['nombredestino'];
      })
      console.log(opciones);
      js_form_1000895_form_workflow.ef('id_estado').set_opciones(opciones);
      console.log(datos2);
		}
		";
	}


}
?>
