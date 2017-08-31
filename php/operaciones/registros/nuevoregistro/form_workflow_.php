<?php
class form_workflow extends sgr_ei_formulario
{


}
//-----------------------------------------------------------------------------------
//---- JAVASCRIPT -------------------------------------------------------------------
//-----------------------------------------------------------------------------------
//
// 	function extender_objeto_js()
// 	{
// 		echo "
// 			//---- Ocultar campo persona cuando no se involucra una en el registro  --------------------------------
//
// 		{$this->objeto_js}.evt__id_requisitos__procesar = function(es_inicial, fila)
// 		{
// 			id_renglon = this.ef('id_requisitos').ir_a_fila(fila).get_estado();
// 			this.controlador.ajax('traerinfo_personaboolean', id_renglon, this, this.mostrar_persona,fila);
// 		}
//
// 		{$this->objeto_js}.mostrar_persona = function(datos,fila)
// 		{
// 			var datos = (datos);
// 				if (datos=='si'){
// 					this.ef('persona').ir_a_fila(fila).mostrar();
// 				}
// 				else{
// 					this.ef('persona').ir_a_fila(fila).ocultar();
// 				}
// 		}"
// }
?>