<?php
class form_desarrollador extends sgr_ei_formulario
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
			this.ef('nombre').input().onkeyup = function()
			{
				var ef = {$this->objeto_js}.ef('nombre');
				var texto = ef.get_estado().toUpperCase();
				var texto_comprobado = texto.match(/[a-zA-Z\[0-9\:\! ¡¿?_°./\-\'\s]/gi);
				//--var texto_comprobado = texto.match(/[a-zA-Z\s]/gi);\[0-9\:\! ¡¿?_°./\-\']
				//--var texto_comprobado = texto.match(/^[a-zA-Z\d_]{4,100}$/i);
				//--var texto_comprobado = texto.match(/[a-zA-Z\[Á-Ú\[0-9\:\! ¡¿?_°./\-\']/gi);
				var cadena = texto_comprobado.toString();
				while(cadena.indexOf(',') >= 0)
				{
					cadena = cadena.replace(',','');
				}
				ef.set_estado(cadena);
			}

      this.ef('version').input().onkeyup = function()
      {
        var ef = {$this->objeto_js}.ef('version');
        var texto = ef.get_estado().toUpperCase();
				var texto_comprobado = texto.match(/[a-zA-Z\[0-9 ,.()]/gi);
        //--var texto_comprobado = texto.match(/[a-zA-Z\s]/gi);
        //--var texto_comprobado = texto.match(/[a-zA-Z\[Á-Ú\[0-9\:\! ¡¿?_°./\-\']/gi);
        var cadena = texto_comprobado.toString();
        while(cadena.indexOf(',') >= 0)
        {
          cadena = cadena.replace(',','');
        }
        ef.set_estado(cadena);
      }

		}
		";
	}

}
?>
