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
	//---- cuadro -----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__form_entidad($form)
	{
		$id_entidad = toba::memoria()->get_parametro('entidad');
		if (isset($id_entidad))
		{
			$datos = dao_entidades_popup::get_datosentidad($id_entidad);
			$form->set_datos($datos);
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
}
?>
