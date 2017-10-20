<?php
class filtro_datosentidades extends sgr_ei_filtro
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
			this.ef('entidad').input().onkeyup = function()
			{
				var ef = {$this->objeto_js}.ef('entidad');
				var texto = ef.get_estado().toUpperCase();

				var texto_comprobado = texto.match(/[a-zA-Z\s]/gi);
				//--var texto_comprobado = texto.match(/[a-zA-Z\[Á-Ú\[0-9\:\! ¡¿?_°./\-\']/gi);
				var cadena = texto_comprobado.toString();
				while(cadena.indexOf(',') >= 0)
				{
					cadena = cadena.replace(',','');
				}
				ef.set_estado(cadena);
			}

      this.ef('localidad').input().onkeyup = function()
      {
        var ef = {$this->objeto_js}.ef('localidad');
        var texto = ef.get_estado().toUpperCase();

        var texto_comprobado = texto.match(/[a-zA-Z\s]/gi);
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
