<?php

require_once('operaciones/registros/historicoregistro/dao_historicoregistro.php');
require_once('operaciones/metodosconsulta/flujosyregistros.php');

class ci_historicoregistro extends sgr_ci
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
		$this->cn()->resetear_dr_registro();
		$this->set_pantalla('pant_edicion');
	}

	function evt__procesar()
	{
		try{
			$this->cn()->guardar_dr_registro();
		}catch (toba_error_db $error) {
			$sql_state = $error->get_sqlstate();
			if ($sql_state == 'db_23505'){
				toba::notificacion()->agregar('Ya existe el registro', 'info');
			}
			else {
				toba::notificacion()->agregar('Error de carga', 'info');
			}
		$this->cn()->resetear_dr_registro();
		$this->set_pantalla('pant_inicial');
		}
	}

	function evt__cancelar()
	{
		$this->cn()->resetear_dr_registro();
		$this->set_pantalla('pant_inicial');
	}


	//-----------------------------------------------------------------------------------
	//---- filtro -----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------


	function conf__filtro($filtro)
	{
		if (isset($this->s__datos_filtro))
		{
			$filtro->set_datos($this->s__datos_filtro);
			$this->s__sqlwhere = $filtro->get_sql_where();
		}
	}

	function evt__filtro__cancelar()
	{
		unset($this->s__datos_filtro);
	}

	function evt__filtro__filtrar($datos)
	{
		$this->s__datos_filtro = $datos;
	}


	//-----------------------------------------------------------------------------------
	//---- cuadro -----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__cuadro($cuadro)
	{
		if (! isset($this->s__datos_filtro)) {
			$datos = dao_historicoregistro::get_datossinfiltro($this->s__sqlwhere);
			$cuadro->set_datos($datos);
		}
		else{
			$datos = dao_historicoregistro::get_datos($this->s__sqlwhere);
			$cuadro->set_datos($datos);
		}
	}

	function evt__cuadro__seleccion($seleccion)
	{
		$this->cn()->seleccionregistro($seleccion);
		$this->set_pantalla('pant_edicion');
	}

	function evt__cuadro__borrar($seleccion)
	{
		$this->cn()->cargar_dr_registro($seleccion);
		$this->cn()->borrar_dt_registro($seleccion);
		try{
			$this->cn()->guardar_dr_registro();
			$this->cn()->resetear_dr_registro();
		} catch (toba_error_db $error) {
			ei_arbol(array('$error->get_sqlstate():' => $error->get_mensaje_log()));
			toba::notificacion()->agregar('Error de carga', 'info');
			$this->cn()->resetear_dr_registro();
			$this->set_pantalla('pant_inicial');
		}
	}

	//-----------------------------------------------------------------------------------
	//---- form -------------------------------------------------------------------------
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
	//---- form_estado_actual -----------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__form_estado_actual($form)
	{
		$ea = $this->cn()->cargarestadoactual($form);
		$this->s__datos['estadoactual'] = $ea;
	}

	function evt__form_estado_actual__modificacion($datos)
	{
		$this->cn()->modifestadoactual($datos);
	}

	function ajax__traerinfo_estadoactual($variable, toba_ajax_respuesta $respuesta)
	{
		$datos = $this->s__datos['estadoactual'];
		$this->informar_a_toba_opciones_ef($datos, 'id_estado', 'form_estado_actual', 'id_estado');
		$respuesta->set($datos);
	}

	//-----------------------------------------------------------------------------------
	//---- form_workflow ----------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__form_workflow($form)
	{
		$this->cn()->cargarestado($form);
	}

	function evt__form_workflow__modificacion($datos)
	{
		$this->cn()->modifestado($datos);
	}

	//-----------------------------------------------------------------------------------
	//---- form_ml_requisitos -----------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__form_ml_requisitos(sgr_ei_formulario_ml $form_ml)
	{
		$datos = $this->cn()->getrequisitos_registro();
		$form_ml->set_datos($datos);
	}

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
			$datos[] = ['iddestino' => 'nopar', 'nombredestino' => '[Sin definir]'];
			$this->informar_a_toba_opciones_ef($datos, 'iddestino', 'form_workflow', 'id_estado');
			//ei_arbol($datos);
			$respuesta->set($datos);
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
