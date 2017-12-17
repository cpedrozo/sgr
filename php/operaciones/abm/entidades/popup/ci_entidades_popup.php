<?php
require_once('operaciones/abm/entidades/popup/dao_entidades_popup.php');

class ci_entidades_popup extends sgr_ci
{

	//-----------------------------------------------------------------------------------
	//---- Variables ----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------
	protected $s__datos_filtro;
	protected $s__sqlwhere;
	protected $s__datos;

	//-----------------------------------------------------------------------------------
	//---- form efs fijos ---------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__form_entidad($form)
	{
		$id_entidad = toba::memoria()->get_parametro('entidad');
		if (isset($id_entidad))
		{
			$datos = dao_entidades_popup::get_datosentidad($id_entidad);
			$form->set_datos($datos);
			$this->s__datos['form'] = $datos;
		}
	}

	function conf__form_dom($form)
	{
		$id_entidad = toba::memoria()->get_parametro('entidad');
		if (isset($id_entidad))
		{
			$datos = dao_entidades_popup::get_datosdom($id_entidad);
			$form->set_datos($datos);
		}
	}

	function conf__form_tel($form)
	{
		$id_entidad = toba::memoria()->get_parametro('entidad');
		if (isset($id_entidad))
		{
			$datos = dao_entidades_popup::get_datostel($id_entidad);
			$form->set_datos($datos);
		}
	}

	function conf__form_correo($form)
	{
		$id_entidad = toba::memoria()->get_parametro('entidad');
		if (isset($id_entidad))
		{
			$datos = dao_entidades_popup::get_datoscorreo($id_entidad);
			$form->set_datos($datos);
		}
	}

	//-----------------------------------------------------------------------------------
	//---- cuadro -----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__cuadro_dom($cuadro)
	{
		$id_entidad = toba::memoria()->get_parametro('entidad');
		if (isset($id_entidad))
		{
			$datos = dao_entidades_popup::get_datosdom2($id_entidad);
			$cuadro->set_datos($datos);
		}
	}

	function conf__cuadro_tel($cuadro)
	{
		$id_entidad = toba::memoria()->get_parametro('entidad');
		if (isset($id_entidad))
		{
			$datos = dao_entidades_popup::get_datostel2($id_entidad);
			$cuadro->set_datos($datos);
		}
	}

	function conf__cuadro_correo($cuadro)
	{
		$id_entidad = toba::memoria()->get_parametro('entidad');
		if (isset($id_entidad))
		{
			$datos = dao_entidades_popup::get_datoscorreo2($id_entidad);
			$cuadro->set_datos($datos);
		}
	}

	//-----------------------------------------------------------------------------------
	//---- reporte ----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function vista_jasperreports(toba_vista_jasperreports $reporte)
	{
		$path_toba = '/home/toba_2_6_7/toba_2_7_6';
		$path_reporte = $path_toba . '/exportaciones/jasper/sgr/02-detalle_empresas.jasper';
		$reporte->set_path_reporte($path_reporte);
		$usuario = toba::usuario()->get_nombre();
		$nombre_archivo = dao_entidades_popup::get_nombrearchivo($this->s__datos['form']['id_entidad']).'.pdf';
		$identidad = $this->s__datos['form']['id_entidad'];
		$titulo = 'Detalles de la entidad '.$this->s__datos['form']['razonsocial'];
		$reporte->set_parametro('titulo','S',$titulo);
		$reporte->set_parametro('usuario','S',$usuario);
		$reporte->set_parametro('identidad','E',$identidad);
		$reporte->set_nombre_archivo($nombre_archivo);
		$db = toba::db('sgr');
		$reporte->set_conexion($db);
	}
}
?>
