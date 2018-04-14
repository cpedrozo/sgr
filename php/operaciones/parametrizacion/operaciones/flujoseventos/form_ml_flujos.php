<?php
class form_ml_flujos extends sgr_ei_formulario_ml
{
	//-----------------------------------------------------------------------------------
	//---- JAVASCRIPT -------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function extender_objeto_js()
	{
		$id_estadonuevo = $this->controlador()->cn()->get_nuevoestado()[0]['id_estado'];
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
		//---- Procesamiento de EFs --------------------------------

    comprobarestado = false;
		/**
		 * Método que se invoca al cambiar el valor del ef en el cliente
		 * Se dispara inicialmente al graficar la pantalla, enviando en true el primer parámetro
		 */
		 {$this->objeto_js}.evt__esinicial__procesar = function(es_inicial, fila) //Modifica el checkbox segun el estadoorigen
		 {
			 	if(! comprobarestado)
				{
					comprobarestado = true
					este_ef = this.ef('esinicial');
					este_ef2 = this.ef('id_estadoorigen');
					if(este_ef.ir_a_fila(fila).chequeado())
					{
						if(este_ef2.ir_a_fila(fila).get_estado() != $id_estadonuevo)
						{
							este_ef2.ir_a_fila(fila).set_estado($id_estadonuevo);
							este_ef2.ir_a_fila(fila).set_solo_lectura(true);
						}
					}
					else
					{
						if(este_ef2.ir_a_fila(fila).get_estado() == $id_estadonuevo)
						{
							este_ef2.ir_a_fila(fila).set_estado('nopar');
							este_ef2.ir_a_fila(fila).set_solo_lectura(false);
						}
					}
					comprobarestado = false
				}
		 	}

			{$this->objeto_js}.evt__id_estadoorigen__procesar = function(es_inicial, fila) //Modifica el ef estado_origen segun checkbox
 		 {
			 if(! comprobarestado)
			 {
				 comprobarestado = true
				 este_ef = this.ef('esinicial');
				 este_ef2 = this.ef('id_estadoorigen');
				 if(este_ef.ir_a_fila(fila).chequeado())
				 {
					 if(este_ef2.ir_a_fila(fila).get_estado() != $id_estadonuevo)
					 {
						 este_ef.ir_a_fila(fila).chequear(false);
					 }
				 }
				 else
				 {
					 if(este_ef2.ir_a_fila(fila).get_estado() == $id_estadonuevo)
					 {
						 este_ef.ir_a_fila(fila).chequear(true);
					 }
				 }
				 comprobarestado = false
			 }
 		 	}

		{$this->objeto_js}.estaChequeado = function(nombre_ef, nro_fila) //Verifica que se cargue al menos un estado inicial
		{
			fila_idx = this.filas()[nro_fila];
			tmp_ef = this.ef(nombre_ef);
			return (tmp_ef.ir_a_fila(fila_idx).chequeado());
		}

		{$this->objeto_js}.evt__esinicial__validar = function(fila) //Verifica que se cargue al menos un estado inicial
		{
			var todo_vacio = true;
			for (i=0; i < this.filas().length; i++) {
				todo_vacio = todo_vacio && !this.estaChequeado('esinicial', i);
			}
			if (todo_vacio) {
				this.ef('esinicial').ir_a_fila(fila).set_error('Debe tener por lo menos un estado inicial');
			}
			return !todo_vacio;
		}

		{$this->objeto_js}.evt__esfinal__validar = function(fila) //Verifica que se cargue al menos un estado final
		{
			var todo_vacio = true;
			for (i=0; i < this.filas().length; i++) {
				todo_vacio = todo_vacio && !this.estaChequeado('esfinal', i);
			}
			if (todo_vacio) {
				this.ef('esfinal').ir_a_fila(fila).set_error('Debe tener por lo menos un estado final');
			}
			return !todo_vacio;
		}
		";
	}

}
?>
