<?php

require_once('operaciones/registros/historicoregistro/dao_historicoregistro.php');
require_once('operaciones/metodosconsulta/flujosyregistros.php');
require_once('operaciones/metodosconsulta/operaciones.php');
require_once('operaciones/abm/personas/dao_personas.php');

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
		$registroExitoso = false;
		try{
			$this->cn()->guardar_dr_registro();
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
		$this->cn()->resetear_dr_registro();
		$this->set_pantalla('pant_inicial');
	}

	function comprobar_estado_final()
	{
		ei_arbol(['entro a comprobar'=>$this->s__esfinal]);
		if (dao_historicoregistro::es_final($this->s__esfinal))
		{
			ei_arbol(['dentro del if'=>$this->s__esfinal]);
			return true;
		}
		return false;
	}

	function evt__procesar2()
	{
		if($this->comprobar_estado_final())
		{
			$datos = $this->cn()->get_registro();
			$datos ['fecha_fin'] = date(DATE_ATOM);
			$this->cn()->set_dt_registro($datos);
			$this->evt__procesar();
		}
		else
		{
			toba::notificacion()->agregar('No se puede finalizar el registro en el estado seleccionado', 'warning');
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
		$this->s__esfinal['id_workflow'] = $datos['id_workflow'];
		if (isset($datos['archivo'])){
			$datos['archivo_nombre'] = preg_replace("/[^a-zA-Z0-9.]+/", "", $datos['archivo']['name']);
		}
		$this->cn()->modifregistro($datos);
		$this->cn()->set_blob_dt('dr_registro', 'dt_registro', $datos, 'archivo', /*es_ml?*/false);
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
		$this->s__esfinal['id_estadoactual'] = $datos['id_estado'];
		$this->cn()->modifestadoactual($datos);
	}

	function ajax__traerinfo_estadoactual($variable, toba_ajax_respuesta $respuesta)
	{
		$datos = $this->s__datos['estadoactual'];
		$this->informar_a_toba_opciones_ef($datos, 'id_estado', 'form_estado_actual', 'id_estado');
		$respuesta->set($datos);
	}

	function get_estado_inicial()
	{
		if (isset($this->s__datos['estadoactual'][0]['id_estado'])) {
			return operaciones::get_estado_inicial($this->s__datos['estadoactual'][0]['id_estado']);
		} else {
			return [];
		}
	}

	//-----------------------------------------------------------------------------------
	//---- form_workflow ----------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__form_workflow($form)
	{
		$form->set_modoEdicion(true);
		$this->cn()->cargarestado($form);
	}

	function evt__form_workflow__modificacion($datos)
	{
		$this->s__esfinal['id_estadonuevo'] = $datos['id_estado'];
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
			$datos['estadosdestino'] = $datos;
			$datos['dpto'] = $datos2;
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

	//-----------------------------------------------------------------------------------
	//---- notif_email ------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function enviar_mail()
	{
		$cuerpo_mail = $this->get_datos_cambiados();

		if ($this->s__datos['operacion'] == 'alta'){
			$asunto = 'Se dio de alta el empleado '.$this->s__datos['datos_nuevos_form']['legajo'].': '.$this->s__datos['datos_nuevos_form']['apynom'];
		}
		else if ($this->s__datos['operacion'] == 'modificacion') {
			$asunto = 'Se modifico el legajo '.$this->s__datos['datos_anteriores_form']['apynom'];
		}
		else
		$asunto = 'Se dio de baja el empleado '.$this->s__datos['datos_empleado']['apynom'];
    try {
        $mail = new toba_mail(dao_personas::get_correorrhh(), $asunto, $cuerpo_mail);
        $mail->set_html(true);
        $mail->enviar();
    } catch (toba_error $e) {
        toba::logger()->debug('Envio email ABM empleado: '. $e->getMessage());
        toba::notificacion()->agregar('Se produjo un error al intentar enviar el email.', 'warning');
    }
	}

	function get_datos_cambiados()
	{
		$camposform = ['id_camposempleado','apellido','nombre','id_tipo_doc','doc','fnac','id_genero','id_sector','id_rol','id_nacionalidad','id_estadocivil','fbaja','id_entidad','id_sucursal','id_dpto'];
		$camposdao = ['apynom','legajo','tipodoc','doc','fnac','genero','rol','sector','nacionalidad','ecivil','entidad'];
		if (isset($this->s__datos['datos_anteriores_form'])){
			if (!is_array($this->s__datos['datos_anteriores_form'])){
				$this->s__datos['datos_nuevos_form'] = dao_personas::get_empleadobaja($this->s__datos['idpersona_alta']);
				$this->s__datos['operacion'] = 'alta';
				$respuesta = 'Detalles del empleado '.$this->s__datos['datos_nuevos_form']['legajo'].': '.$this->s__datos['datos_nuevos_form']['apynom'].'<br/><br/>
				<table style="width:40%">
			  <tr style="text-align:left">
					<th>Campo</th>
			    <th>Dato</th>
			  </tr>';
				foreach ($camposdao as $value) {
						$valornuevo = $this->s__datos['datos_nuevos_form'][$value];
						if (!is_null ($valornuevo)){
						$respuesta = $respuesta."<tr style='text-align:left'>
							<td>$value</td>
					    <td>$valornuevo</td>
					  </tr>";
						}
				}
				$respuesta = $respuesta.'</table>';
			}
			else {
				$this->s__datos['operacion'] = 'modificacion';
				$this->s__datos['datos_nuevos_form'] = dao_personas::get_empleadobaja($this->s__datos['seleccion']['id_persona']);
				$respuesta = 'Se modificaron uno o mas datos del empleado '.$this->s__datos['datos_anteriores_form']['legajo'].': '.$this->s__datos['datos_anteriores_form']['apynom'].'<br/><br/>
				<table style="width:40%">
			  <tr style="text-align:left">
					<th>Campo</th>
			    <th>Anterior</th>
			    <th>Actual</th>
			  </tr>';
				foreach ($camposdao as $value) {
					if ($this->s__datos['datos_anteriores_form'][$value]<>$this->s__datos['datos_nuevos_form'][$value]){
						$valornuevo = $this->s__datos['datos_nuevos_form'][$value];
						$valorviejo = $this->s__datos['datos_anteriores_form'][$value];
						if (!(is_null ($valorviejo) and is_null($valornuevo))){
						$respuesta = $respuesta."<tr style='text-align:left'>
							<td>$value</td>
					    <td>$valorviejo</td>
					    <td>$valornuevo</td>
					  </tr>";
						}
					}
				}
				$respuesta = $respuesta.'</table>';
			}
		}
		else {
			$this->s__datos['operacion'] = 'baja';
			$respuesta = 'Se dio de baja el empleado '.$this->s__datos['datos_empleado']['legajo'].': '.$this->s__datos['datos_empleado']['apynom'].'<br/><br/>
			<table style="width:40%">
			<tr style="text-align:left">
				<th>Campo</th>
				<th>Dato</th>
			</tr>';
			foreach ($camposdao as $value) {
				$valorempleado = $this->s__datos['datos_empleado'][$value];
					if (!is_null ($valorempleado)){
						$respuesta = $respuesta."<tr style='text-align:left'>
						<td>$value</td>
						<td>$valorempleado</td>
						</tr>";
					}
			}
			$respuesta = $respuesta.'</table>';
		}
		return $respuesta;
	}

}
?>
