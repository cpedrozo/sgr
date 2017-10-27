<?php
require_once('operaciones/abm/personas/popup/dao_personas_popup.php');

class ci_personas_popup extends sgr_ci
{

	//-----------------------------------------------------------------------------------
	//---- Variables ----------------------------------------------------------------------
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

}
?>
