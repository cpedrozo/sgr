<?php
require_once('operaciones/metodosconsulta/flujosyregistros.php');
require_once('operaciones/metodosconsulta/operaciones.php');
require_once('operaciones/abm/personas/dao_personas.php');

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
		$registroExitoso = false;
		try{
			$this->cn()->guardarregistro();
			/*$this->s__datos['idpersona_alta'] = $this->cn()->get_personas()['id_persona'];
			if (dao_personas::esempleado($this->s__datos['idpersona_alta'])){
				$this->enviar_mail();
			}*/
			$registroExitoso = true;
		}catch (toba_error_db $error) {
			$sql_state = $error->get_sqlstate();
			if ($sql_state == 'db_23505'){
				toba::notificacion()->agregar('Ya existe el registro', 'info');
			}
			else {
				toba::notificacion()->agregar('Error de carga', 'info');
			}
		}
		if ($registroExitoso) {
			$this->set_registroExitoso();
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
	//---- form -------------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function evt__form__modificacion($datos)
	{
		$this->cn()->modifregistro($datos);
	}

	//-----------------------------------------------------------------------------------
	//---- form_estado_actual -----------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__form_estado_actual($form)
	{
		$this->cn()->cargarestadoactual($form);
	}

	function get_estado_inicial()
	{
		return operaciones::get_estado_inicial();
	}

	//-----------------------------------------------------------------------------------
	//---- form_workflow ----------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__form_workflow($form)
	{
		$form->set_modoEdicion(false);
	}

	function evt__form_workflow__modificacion($datos)
	{
		$this->cn()->modifestado($datos);
	}

	//-----------------------------------------------------------------------------------
	//---- form_ml_requisitos -----------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function evt__form_ml_requisitos__modificacion($datos)
	{
		$this->cn()->procesarrequisitos_registro($datos, $this->s__datos['datos_ml_requisitos']);
	}

	//-----------------------------------------------------------------------------------
	//---- form_flujosyregistros --------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function ajax__traerinfo_flujodetrabajo($variable, toba_ajax_respuesta $respuesta)
	{
		if (($variable['id_workflow'] == '') or ($variable['id_workflow'] == 'nopar'))
		{
			$respuesta->set([]);
		}
		else {
			$datos = flujosyregistros::get_estadodestino($variable['id_estadoorigen'],$variable['id_workflow']);
			$datos2 = flujosyregistros::get_dpto($variable['id_workflow']);
			$datos[] = ['iddestino' => 'nopar', 'nombredestino' => '[Sin definir]'];
			$this->informar_a_toba_opciones_ef($datos, 'iddestino', 'form_workflow', 'id_estado');
			$datos3['estadosdestino'] = $datos;
			$datos3['dpto'] = $datos2;
			$respuesta->set($datos3);
		}
	}

	function informar_a_toba_opciones_ef($datos, $iddestino, $form_workflow, $id_estado)
	{
		$sesion = [];
		foreach ($datos as $key => $value) {
		$sesion[] = $value[$iddestino];
		}
		$this->dep($form_workflow)->ef($id_estado)->guardar_dato_sesion($sesion, true);
	}

	function ajax__traerinfo_requisitos_estado($variable, toba_ajax_respuesta $respuesta)
	{
		if (($variable['id_estado'] == '') or ($variable['id_estado'] == 'nopar'))
		{
			$datos = [];
		}
		else {
			if (isset($variable['id_estadoorigen'])){
				$datos = flujosyregistros::get_requisitosxestado($variable['id_estadoorigen'], $variable['id_estado'],$variable['id_workflow']);
			}
			else {
				$datos = flujosyregistros::get_requisitosxestadoNuevo($variable['id_estado'],$variable['id_workflow']);
			}
		}
	$this->s__datos['datos_ml_requisitos'] = $datos;
	$respuesta->set($datos);
	}

	function ajax__traerinfo_personaboolean($id_renglon, toba_ajax_respuesta $respuesta)
	{
		$datos_renglon = flujosyregistros::get_personaboolean($id_renglon);
		$respuesta->set($datos_renglon);
	}

}
?>
