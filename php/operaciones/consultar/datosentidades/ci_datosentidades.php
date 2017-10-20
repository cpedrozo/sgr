<?php
require_once('operaciones/consultar/datosentidades/dao_datosentidades.php');

class ci_datosentidades extends sgr_ci
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

	function conf__cuadrotel($cuadro)
	{
		if (! isset($this->s__datos_filtro)) {
			$datos = dao_datosentidades::get_datossinfiltrotel($this->s__sqlwhere);
			$cuadro->set_datos($datos);
		}
		else{
			$datos = dao_datosentidades::get_datostel($this->s__sqlwhere);
			$cuadro->set_datos($datos);
		}
	}

	function conf__cuadrodom($cuadro)
	{
		if (! isset($this->s__datos_filtro)) {
			$datos = dao_datosentidades::get_datossinfiltrodom($this->s__sqlwhere);
			$cuadro->set_datos($datos);
		}
		else{
			$datos = dao_datosentidades::get_datosdom($this->s__sqlwhere);
			$cuadro->set_datos($datos);
		}
	}

	function conf__cuadrocorreo($cuadro)
	{
		if (! isset($this->s__datos_filtro)) {
			$datos = dao_datosentidades::get_datossinfiltrocorreo($this->s__sqlwhere);
			$cuadro->set_datos($datos);
		}
		else{
			$datos = dao_datosentidades::get_datoscorreo($this->s__sqlwhere);
			$cuadro->set_datos($datos);
		}
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

}
?>
