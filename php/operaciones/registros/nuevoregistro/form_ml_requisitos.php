<?php
class form_ml_requisitos extends sgr_ei_formulario_ml
{
	//-----------------------------------------------------------------------------------
	//---- JAVASCRIPT -------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function extender_objeto_js()
	{
		echo "
			//---- Ocultar campo persona cuando no se involucra una en el registro  --------------------------------

		js_form_1000896_form_ml_requisitos.boton_agregar().style.display = 'none'
		js_form_1000896_form_ml_requisitos.boton_eliminar().style.display = 'none'
		js_form_1000896_form_ml_requisitos.boton_deshacer().style.display = 'none'

		{$this->objeto_js}.evt__completo__validar = function(fila)
		{
			if (this.ef('obligatorio').ir_a_fila(fila).get_estado() == 'Si' ) {
				if (this.ef('completo').ir_a_fila(fila).get_estado()) {
					return true;
				} else {
					nombre = this.ef('nombre').ir_a_fila(fila).get_estado();
					this.ef('completo').ir_a_fila(fila).set_error('es obligatorio para el requisito ' + nombre);
					return false;
				}
			} else {
				return true;
			}
		}
		";
	}


}
?>
