<?php
require_once('operaciones/abm/personas/dao_personas.php');
require_once('operaciones/metodosconsulta/flujosyregistros.php');
class ci_personas extends sgr_ci
{
	//-----------------------------------------------------------------------------------
	//---- Variables ----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------
	protected $s__datos_filtro;
	protected $s__sqlwhere;
	protected $s__datos;

	//-----------------------------------------------------------------------------------
	//---- cuadro -----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function ini()
	{
		if ($this->controlador()->get_id()[1]=='1000898')
			{
				$this->dep('cuadro')->eliminar_evento('seleccion2');
				$this->dep('cuadro')->eliminar_evento('detalles');
				$this->dep('cuadro')->eliminar_evento('borrar');
			}
		else {
			$this->dep('cuadro')->eliminar_evento('seleccion');
		}
	}

	function conf__cuadro($cuadro)
	{
		$cuadro->desactivar_modo_clave_segura();
		if (! isset($this->s__datos_filtro)) {
			$datos = dao_personas::get_datossinfiltro($this->s__sqlwhere);
			$cuadro->set_datos($datos);
		}
		else{
			$datos = dao_personas::get_datos($this->s__sqlwhere);
			$cuadro->set_datos($datos);
		}
	}

	function evt__cuadro__seleccion2($seleccion)
	{
		$this->cn()->cargar_dr_personas($seleccion);
		$this->cn()->set_cursorpersonas($seleccion);
		$this->set_pantalla('pant_edicion');
		$this->s__datos['seleccion'] = $seleccion;
	}

	function evt__cuadro__borrar($seleccion)
	{
		$this->s__datos['baja'] = $seleccion;
		$this->s__datos['datos_empleado'] = dao_personas::get_empleadobaja($this->s__datos['baja']['id_persona']);
		$this->s__datos['esempleado'] = dao_personas::esempleado($this->s__datos['baja']['id_persona']);
		$this->cn()->cargar_dr_personas($seleccion);
		$this->cn()->borrar_dt_personas($seleccion);
		try{
			$this->cn()->guardar_dr_personas();
			unset($this->s__datos['datos_anteriores_form']);
			if ($this->s__datos['esempleado']){
				$this->enviar_mail();
			}
			$this->cn()->resetear_dr_personas();
		} catch (toba_error_db $error) {
			toba::notificacion()->agregar('Error de carga', 'info');
			$this->cn()->resetear_dr_personas();
			$this->set_pantalla('pant_inicial');
		}
	}

	function conf_evt__cuadro__detalles(toba_evento_usuario $evento, $fila)
	{
		$datos=$this->dep('cuadro')->get_datos()[$fila];
		$evento->vinculo()->agregar_parametro('persona', $datos['id_persona']);
	}

	//-----------------------------------------------------------------------------------
	//---- Eventos ----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function evt__nuevo()
	{
		$this->cn()->resetear_dr_personas();
		$this->set_pantalla('pant_edicion');
	}

	function evt__procesar()
	{
		try{
			$this->cn()->guardar_dr_personas();
			$this->s__datos['idpersona_alta'] = $this->cn()->get_personas()['id_persona'];
			if (dao_personas::esempleado($this->s__datos['idpersona_alta'])){
				$this->enviar_mail();
			}
			$this->set_registroExitoso();
			$this->cn()->resetear_dr_personas();
			$this->set_pantalla('pant_inicial');
		}catch (toba_error_db $error) {
			$sql_state = $error->get_sqlstate();
			if ($sql_state == 'db_23505'){
				toba::notificacion()->agregar('Ya existe la persona', 'info');
			}
			else {
				toba::notificacion()->agregar('Error de carga', 'info');
			}
		}
	}

	function evt__cancelar()
	{
		$this->cn()->resetear_dr_personas();
		$this->set_pantalla('pant_inicial');
	}

		//-----------------------------------------------------------------------------------
		//---- filtro -----------------------------------------------------------------------
		//-----------------------------------------------------------------------------------

	function crear_valores_filtro_sucursal_segun_workflow($id_workflow)
	{
		$ids = flujosyregistros::get_dpto($id_workflow);
		$datos_filtro = ['id_sucursal' => ['condicion' =>	'es_igual_a',
																			 'valor' 	   => $ids[0]['id_sucursal']],
										 'id_dpto'     => ['condicion' =>	'es_igual_a',
								 									     'valor' 	   => $ids[0]['id_dpto']]];
		return $datos_filtro;
	}

	function conf__filtro($filtro)
	{
		if (!isset($this->s__datos['id_workflow_filtrodefecto'])) {
			$id_workflow_filtrodefecto = toba::memoria()->get_parametro('id_workflow_filtrodefecto');
			if (isset($id_workflow_filtrodefecto)) {
				$this->s__datos['id_workflow_filtrodefecto'] = $id_workflow_filtrodefecto;
				if (!isset($this->s__datos_filtro)) {
					$this->s__datos_filtro = [];
				}
				$this->s__datos_filtro = array_merge($this->s__datos_filtro, $this->crear_valores_filtro_sucursal_segun_workflow($id_workflow_filtrodefecto));
			}
		}
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
	//---- frm --------------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__form(sgr_ei_formulario $form)
	{
		$datos = $this->cn()->get_personas();
		$form->set_datos($datos);
		$this->s__datos['datos_anteriores_form'] = isset($datos) ? dao_personas::get_empleadobaja($datos['id_persona']) : '';
	}

	function evt__form__modificacion($datos)
	{
		$this->cn()->set_dt_personas($datos);
	}

	//-----------------------------------------------------------------------------------
	//---- form_ml_domicilio-------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__form_ml_domicilio(sgr_ei_formulario_ml $form_ml)
	{
		$datos = $this->cn()->getdomicilio_personas();
		$form_ml->set_datos($datos);
		$this->s__datos['datos_anteriores_dom'] = $datos;
	}

	function evt__form_ml_domicilio__modificacion($datos)
	{
		$this->cn()->procesardomicilio_personas($datos);
		$this->s__datos['datos_nuevos_dom'] = $datos;
	}

	//-----------------------------------------------------------------------------------
	//---- form_ml_tel ------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__form_ml_tel(sgr_ei_formulario_ml $form_ml)
	{
		$datos = $this->cn()->gettelefono_personas();
		$form_ml->set_datos($datos);
		$this->s__datos['datos_anteriores_tel'] = $datos;
	}

	function evt__form_ml_tel__modificacion($datos)
	{
		$this->cn()->procesartelefono_personas($datos);
		$this->s__datos['datos_nuevos_tel'] = $datos;
	}

	function ajax__traerinfo_tipotel($id_renglon, toba_ajax_respuesta $respuesta)
	{
		$datos_renglon = dao_personas::get_tipotel($id_renglon);
		$respuesta->set($datos_renglon);
	}

	//-----------------------------------------------------------------------------------
	//---- form_ml_correo ---------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__form_ml_correo(sgr_ei_formulario_ml $form_ml)
	{
		$datos = $this->cn()->getcorreo_personas();
		$form_ml->set_datos($datos);
		$this->s__datos['datos_anteriores_correo'] = $datos;
	}

	function evt__form_ml_correo__modificacion($datos)
	{
		$this->cn()->procesarcorreo_personas($datos);
		$this->s__datos['datos_nuevos_correo'] = $datos;
	}

	//-----------------------------------------------------------------------------------
	//---- notif_email ------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function enviar_mail()
	{
		$cuerpo_mail = $this->get_datos_cambiados();

		if ($this->s__datos['operacion'] == 'alta'){
			$asunto = 'Se dio de alta el empleado '.$this->s__datos['datos_nuevos_form']['apellido'].', '.$this->s__datos['datos_nuevos_form']['nombre'];
		}
		else if ($this->s__datos['operacion'] == 'modificacion') {
			$asunto = 'Se modificaron uno o mas datos del empleado '.$this->s__datos['datos_anteriores_form']['apynom'];
		}
		else//($this->s__datos['operacion'] == 'baja')
		$asunto = 'Se dio de baja el empleado '.$this->s__datos['datos_empleado']['apynom'];
		//$mail = new toba_mail($receptor, $asunto, $cuerpo_mail);
		//$mail->set_html(true);
		//$mail->enviar();
    try {
        $mail = new toba_mail(dao_personas::get_correorrhh(), $asunto, $cuerpo_mail);
        $mail->set_html(true);
        $mail->enviar();
    } catch (toba_error $e) {
        toba::logger()->debug('Envio email ABM empleado: '. $e->getMessage());
        toba::notificacion()->agregar('Se produjo un error al intentar enviar el email.');
    }
	}

	function get_datos_cambiados()
	{
		$camposform = ['id_camposempleado','apellido','nombre','id_tipo_doc','doc','fnac','id_genero','id_sector','id_rol','id_nacionalidad','id_estadocivil','fbaja','id_entidad','id_sucursal','id_dpto'];
		$camposdao = ['apynom', 'legajo', 'tipodoc', 'fnac', 'genero', 'rol', 'sector', 'nacionalidad', 'ecivil', 'entidad'];
		if (isset($this->s__datos['datos_anteriores_form'])){
			if (!is_array($this->s__datos['datos_anteriores_form'])){
				$this->s__datos['datos_nuevos_form'] = dao_personas::get_empleadobaja($this->s__datos['idpersona_alta']);
				$this->s__datos['operacion'] = 'alta';
				$respuesta = 'Se dio de alta el empleado '.$this->s__datos['datos_nuevos_form']['legajo'].': '.$this->s__datos['datos_nuevos_form']['apellido'].', '.$this->s__datos['datos_nuevos_form']['nombre'].'<br/><br/>
				<table style="width:40%">
			  <tr style="text-align:left">
					<th>Campo</th>
			    <th>Dato</th>
			  </tr>';
				foreach ($camposdao as $value) {
						$valornuevo = $this->s__datos['datos_nuevos_form'][$value];
						if (!is_null ($valornuevo)){
						$respuesta = $respuesta.'<tr style="text-align:left">
							<td>$value</td>
					    <td>$valornuevo</td>
					  </tr>';
						}
				}
				$respuesta = $respuesta.'</table>';
			}
			else {
				$this->s__datos['operacion'] = 'modificacion';
				$this->s__datos['datos_nuevos_form'] = dao_personas::get_empleadobaja($this->s__datos['seleccion']['id_persona']);
				$respuesta = 'Se modifico el legajo '.$this->s__datos['datos_anteriores_form']['legajo'].': '.$this->s__datos['datos_anteriores_form']['apynom'].'<br/><br/>
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
