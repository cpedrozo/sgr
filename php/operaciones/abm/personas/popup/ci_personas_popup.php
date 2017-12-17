<?php
require_once('operaciones/abm/personas/popup/dao_personas_popup.php');

class ci_personas_popup extends sgr_ci
{

	//-----------------------------------------------------------------------------------
	//---- Variables --------------------------------------------------------------------
	//-----------------------------------------------------------------------------------
	protected $s__datos_filtro;
	protected $s__sqlwhere;
	protected $s__datos;

	//-----------------------------------------------------------------------------------
	//---- form -------------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__form_persona($form)
	{
		$id_persona = toba::memoria()->get_parametro('persona');
		if (isset($id_persona))
		{
			$datos = dao_personas_popup::get_datospersona($id_persona);
			$form->set_datos($datos);
			$this->s__datos['form'] = $datos;
		}
	}

	function conf__form_dom($form)
	{
		$id_persona = toba::memoria()->get_parametro('persona');
		if (isset($id_persona))
		{
			$datos = dao_personas_popup::get_datosdom($id_persona);
			$form->set_datos($datos);
		}
	}

	function conf__form_tel($form)
	{
		$id_persona = toba::memoria()->get_parametro('persona');
		if (isset($id_persona))
		{
			$datos = dao_personas_popup::get_datostel($id_persona);
			$form->set_datos($datos);
		}
	}

	function conf__form_correo($form)
	{
		$id_persona = toba::memoria()->get_parametro('persona');
		if (isset($id_persona))
		{
			$datos = dao_personas_popup::get_datoscorreo($id_persona);
			$form->set_datos($datos);
		}
	}

		//-----------------------------------------------------------------------------------
		//---- cuadro -----------------------------------------------------------------------
		//-----------------------------------------------------------------------------------

		function conf__cuadro_dom($cuadro)
		{
			$id_persona = toba::memoria()->get_parametro('persona');
			if (isset($id_persona))
			{
				$datos = dao_personas_popup::get_datosdom2($id_persona);
				$cuadro->set_datos($datos);
			}
		}

		function conf__cuadro_tel($cuadro)
		{
			$id_persona = toba::memoria()->get_parametro('persona');
			if (isset($id_persona))
			{
				$datos = dao_personas_popup::get_datostel2($id_persona);
				$cuadro->set_datos($datos);
			}
		}

		function conf__cuadro_correo($cuadro)
		{
			$id_persona = toba::memoria()->get_parametro('persona');
			if (isset($id_persona))
			{
				$datos = dao_personas_popup::get_datoscorreo2($id_persona);
				$cuadro->set_datos($datos);
			}
		}

		//-----------------------------------------------------------------------------------
		//---- reporte ----------------------------------------------------------------------
		//-----------------------------------------------------------------------------------

		function vista_jasperreports(toba_vista_jasperreports $reporte)
		{
			$path_toba = '/home/toba_2_6_7/toba_2_7_6';
			$path_reporte = $path_toba . '/exportaciones/jasper/sgr/01-detalle_personas.jasper';
			$reporte->set_path_reporte($path_reporte);
			$usuario = toba::usuario()->get_nombre();
			$nombre_archivo = dao_personas_popup::get_nombrearchivo($this->s__datos['form']['id_persona']).'.pdf';
			$idpersona = $this->s__datos['form']['id_persona'];
			if (isset($this->s__datos['form']['legajo'])){
				$titulo = 'Detalles del legajo '.$this->s__datos['form']['apynom'];
			}
			else{
				$titulo = 'Detalles de la persona '.$this->s__datos['form']['apynom2'];
			}
      $reporte->set_parametro('titulo','S',$titulo);
			$reporte->set_parametro('usuario','S',$usuario);
			$reporte->set_parametro('idpersona','E',$idpersona);
			$reporte->set_nombre_archivo($nombre_archivo);
			$db = toba::db('sgr');
			$reporte->set_conexion($db);
		}
}
?>
