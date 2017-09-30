<?php
class form_workflow extends sgr_ei_formulario
{
	//-----------------------------------------------------------------------------------
	//---- JAVASCRIPT -------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function extender_objeto_js()
	{
		echo "
		//---- Procesamiento de EFs --------------------------------

		/**
		 * Método que se invoca al cambiar el valor del ef en el cliente
		 * Se dispara inicialmente al graficar la pantalla, enviando en true el primer parámetro
		 * CARGA LOS ESTADOS DISPONIBLES PARA SELECCION SEGUN EL ESTADO ACTUAL.
		 */
		{$this->objeto_js}.evt__id_estado__procesar = function(es_inicial)
		{
			if (!es_inicial) {
				js_form_1000896_form_ml_requisitos.eliminar_filas()
				//--console.log('id_estado ejecutando');
				var id_estado_x_requsito = [];
				id_estado_x_requsito['id_workflow'] = js_form_1000889_form.ef('id_workflow').get_estado();
				id_estado_x_requsito['id_estado'] = this.ef('id_estado').get_estado();
				id_estado_x_requsito['id_estadoorigen'] = js_form_1000890_form_estado_actual.ef('id_estado').get_estado();
				this.controlador.ajax('traerinfo_requisitos_estado', id_estado_x_requsito, this, this.resp_requsitos);
			}
		}

    {$this->objeto_js}.resp_requsitos = function(datos)
		{
      //--console.log('coment requisitos');
			//--console.log(datos);
			frm = js_form_1000896_form_ml_requisitos
      datos.forEach(function(elemento)
      {
				fila = frm.crear_fila()
				et_ob = elemento['obligatorio'] ? 'Si' : 'No';
				frm.ef('obligatorio').ir_a_fila(fila).set_estado(et_ob);
				frm.ef('nro_requisito').ir_a_fila(fila).set_estado(elemento['nro_requisito']);
				frm.ef('nombre').ir_a_fila(fila).set_estado(elemento['nombre']);
				if (elemento['persona'])
				{
					frm.ef('id_persona').ir_a_fila(fila).mostrar();
				}
				else{
					frm.ef('id_persona').ir_a_fila(fila).ocultar();
				}
      })
		}
		";
	}

}

?>
