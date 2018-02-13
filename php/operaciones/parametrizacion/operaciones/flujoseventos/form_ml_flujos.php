<?php
class form_ml_flujos extends sgr_ei_formulario_ml
{
	//-----------------------------------------------------------------------------------
	//---- JAVASCRIPT -------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function extender_objeto_js()
  {
		echo "
		//---- Validacion de ingreso de caracteres ----------------------------------


		{$this->objeto_js}.crear_fila_toba={$this->objeto_js}.crear_fila;

		{$this->objeto_js}.crear_fila =function () {
			id_fila=this.crear_fila_toba();
			this.ef('orden').ir_a_fila(id_fila).set_estado(this.filas().length);
		}

		{$this->objeto_js}.ini = function (fila)
		{
			this.ef('nombre').ir_a_fila(fila).input().onkeyup = function()
			{
				var ef = {$this->objeto_js}.ef('nombre');
				var texto = ef.get_estado().toLowerCase();
				ef.set_estado(texto);
			}
		}
		";
	}
}
?>
