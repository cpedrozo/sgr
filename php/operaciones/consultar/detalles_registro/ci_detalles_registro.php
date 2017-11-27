<?php

require_once('operaciones/consultar/detalles_registro/dao_detalles_registro.php');

class ci_detalles_registro extends sgr_ci
{

	//-----------------------------------------------------------------------------------
	//---- Variables ----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------
	protected $s__datos_filtro;
	protected $s__sqlwhere;
	protected $s__datos;
	protected $s__datos2;

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
			$datos = dao_detalles_registro::get_datossinfiltro($this->s__sqlwhere);
			$cuadro->set_datos($datos);
		}
		else{
			$datos = dao_detalles_registro::get_datos($this->s__sqlwhere);
			$cuadro->set_datos($datos);
		}
	}

	function evt__cuadro__seleccion($seleccion)
	{
		$this->s__datos['seleccion'] = $seleccion;
		$this->set_pantalla('pant_edicion');
	}

	//-----------------------------------------------------------------------------------
	//---- form -------------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__form($form)
	{
		if (isset($this->s__datos['seleccion']))
		{
			$seleccion = $this->s__datos['seleccion'];
			$datos = dao_detalles_registro::cargar_form($seleccion);
		}
		$form->set_datos($datos);
	}

	//-----------------------------------------------------------------------------------
	//---- form_ml_detalles_registro-----------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__form_ml_detalles_registro($form_ml)
	{
		if (isset($this->s__datos['seleccion']))
		{
			$seleccion = $this->s__datos['seleccion'];
			$datos = dao_detalles_registro::cargar_ml($seleccion);
		}
		$form_ml->set_datos($datos);
	}

}
?>
