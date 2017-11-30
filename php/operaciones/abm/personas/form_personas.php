<?php
class form_personas extends sgr_ei_formulario
{
	//-----------------------------------------------------------------------------------
	//---- JAVASCRIPT -------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function extender_objeto_js()
	{
		echo "
		//---- Validacion de ingreso de caracteres ----------------------------------

		{$this->objeto_js}.ini = function ()
		{
			this.ef('apellido').input().onkeyup = function()
			{
				var ef = {$this->objeto_js}.ef('apellido');
				var texto = ef.get_estado().toUpperCase();

				var texto_comprobado = texto.match(/[a-zA-Z\s]/gi);
				//--var texto_comprobado = texto.match(/[a-zA-Z\[Á-Ú\[0-9\:\! ¡¿?_°./\-\']/gi);
				var cadena = texto_comprobado.toString();
				while(cadena.indexOf(',') >= 0){
					cadena = cadena.replace(',','');
				}
				ef.set_estado(cadena);
			}
			this.ef('nombre').input().onkeyup = function()
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

		//---- Ocultar campos para personas ------------------------------------------------

		{$this->objeto_js}.evt__id_camposempleado__procesar = function(es_inicial)
		{
		  var nodo = this.ef('id_camposempleado').input();

		  var indice = nodo.selectedIndex;
		  var valor='';

		  if (indice) {
		      valor = nodo.options[indice].text;
		  }
		  //--alert(valor);
		  //--alert(indice);
		  var resultado = valor.substring(0,2);
		  //--alert(resultado);

		  if (resultado=='SI')
		  {
				this.ef('legajo').mostrar();
			  this.ef('apellido').mostrar();
		    this.ef('nombre').mostrar();
				this.ef('id_tipo_doc').mostrar();
				this.ef('doc').mostrar();
		    this.ef('fnac').mostrar();
		    this.ef('id_genero').mostrar();
		    this.ef('id_sucursal').mostrar();
		    this.ef('id_dpto').mostrar();
		    this.ef('id_rol').mostrar();
		    this.ef('id_nacionalidad').mostrar();
		    this.ef('id_estadocivil').mostrar();
				this.ef('id_entidad').ocultar();
		  }
			else if (resultado=='NO'){
				this.ef('legajo').ocultar();
		    this.ef('apellido').mostrar();
		    this.ef('nombre').mostrar();
				this.ef('id_tipo_doc').mostrar();
				this.ef('doc').mostrar();
		    this.ef('fnac').mostrar();
		    this.ef('id_genero').mostrar();
		    this.ef('id_sucursal').ocultar();
		    this.ef('id_dpto').ocultar();
		    this.ef('id_rol').ocultar();
		    this.ef('id_nacionalidad').mostrar();
		    this.ef('id_estadocivil').mostrar();
				this.ef('id_entidad').mostrar();
		  }
		  else {
		    this.ef('apellido').ocultar();
		    this.ef('nombre').ocultar();
				this.ef('id_tipo_doc').ocultar();
				this.ef('doc').ocultar();
		    this.ef('fnac').ocultar();
		    this.ef('id_genero').ocultar();
		    this.ef('id_sucursal').ocultar();
		    this.ef('id_dpto').ocultar();
		    this.ef('id_rol').ocultar();
		    this.ef('id_nacionalidad').ocultar();
		    this.ef('id_estadocivil').ocultar();
				this.ef('id_entidad').ocultar();
		  }
		}

		";
	}

}
?>
