<?php

require_once('operaciones/metodosconsulta/flujosyregistros.php');

class ci_nuevoregistro extends sgr_ci
{
	//-----------------------------------------------------------------------------------
	//---- Variables ----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------
	protected $s__datos_filtro;
	protected $s__sqlwhere;
	protected $s__datos;

	//-----------------------------------------------------------------------------------
	//---- Eventos ----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function evt__nuevo()
	{
		$this->cn()->resetregistro();
		$this->set_pantalla('pant_edicion');
	}

	function evt__procesar()
	{
		try{
			$this->cn()->guardarregistro();
		}catch (toba_error_db $error) {
			$sql_state = $error->get_sqlstate();
			if ($sql_state == 'db_23505'){
				toba::notificacion()->agregar('Ya existe el registro', 'info');
			}
			else {
				toba::notificacion()->agregar('Error de carga', 'info');
			}
		}
		$this->cn()->resetregistro();
		$this->set_pantalla('pant_inicial');
	}

	function evt__cancelar()
	{
		$this->cn()->resetregistro();
		$this->set_pantalla('pant_inicial');
	}

	//-----------------------------------------------------------------------------------
	//---- frm --------------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__form($form)
	{
		$this->cn()->cargarregistro($form);
	}

	function evt__form__modificacion($datos)
	{
		$this->cn()->modifregistro($datos);
	}

	//-----------------------------------------------------------------------------------
	//---- frm_flujosyregistros ---------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function ajax__traerinfo_flujodetrabajo($variable, toba_ajax_respuesta $respuesta)
	{
		if (($variable['id_workflow'] == '') or ($variable['id_workflow'] == 'nopar'))
		{
			$respuesta->set([]);
		}
		else {
			$datos = flujosyregistros::get_estadodestino($variable['id_estadoorigen'],$variable['id_workflow']);
			$datos[] = ['iddestino' => 'nopar', 'nombredestino' => '[Sin definir]'];
			$respuesta->set($datos);
		}
	}

	function ajax__traerinfo_requisitos_estado($variable, toba_ajax_respuesta $respuesta)
	{
		if (($variable['id_estadodestino'] == '') or ($variable['id_estadodestino'] == 'nopar'))
		{
			$respuesta->set([]);
		}
		else {
			if (isset($variable['id_estadoorigen'])){
				$datos = flujosyregistros::get_requisitosxestado($variable['id_estadoorigen'], $variable['id_estadodestino'],$variable['id_workflow']);
				$respuesta->set($datos);
			}
			else {
				$datos = flujosyregistros::get_requisitosxestadoNuevo($variable['id_estadodestino'],$variable['id_workflow']);
				$respuesta->set($datos);
			}
		}
	}

	function ajax__traerinfo_personaboolean($id_renglon, toba_ajax_respuesta $respuesta)
	{
		$datos_renglon = flujosyregistros::get_personaboolean($id_renglon);
		$respuesta->set($datos_renglon);
	}

}

?>
