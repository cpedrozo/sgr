<?php
class form_ml_correo extends sgr_ei_formulario_ml
{
	//-----------------------------------------------------------------------------------
	//---- JAVASCRIPT -------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function extender_objeto_js()
  {
		echo "
		//---- Validacion de ingreso de caracteres ----------------------------------

		{$this->objeto_js}.ini = function (fila)
		{
			this.ef('correo').ir_a_fila(fila).input().onkeyup = function()
			{
				var ef = {$this->objeto_js}.ef('correo');
				var texto = ef.get_estado().toLowerCase();
				ef.set_estado(texto);
			}
		}
		";
	}
}
?>
