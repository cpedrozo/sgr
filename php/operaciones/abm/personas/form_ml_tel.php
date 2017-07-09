<?php
class form_ml_tel extends sgr_ei_formulario_ml
{
	//-----------------------------------------------------------------------------------
	//---- JAVASCRIPT -------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function extender_objeto_js()
	{
		echo "
		//---- Ocultar campo interno para otros telefonos --------------------------------

		{$this->objeto_js}.evt__id_tipotel__procesar = function(es_inicial, fila)
		{
			id_renglon = this.ef('id_tipotel').ir_a_fila(fila).get_estado();
			this.controlador.ajax('traerinfo_tipotel', id_renglon, this, this.mostrar_interno,fila);
		}

		{$this->objeto_js}.mostrar_interno = function(datos,fila)
		{
			var datos = (datos);
				if (datos=='si'){
					this.ef('interno').ir_a_fila(fila).mostrar();
				}
				else{
					this.ef('interno').ir_a_fila(fila).ocultar();
				}
		}

		";
	}

}
?>
