<?php
require_once('operaciones/abm/personas/dao_personas.php');

class ci_reportetramites extends sgr_ci
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

	function conf__cuadro($cuadro)
	{
		$cuadro->desactivar_modo_clave_segura();
		if (! isset($this->s__datos_filtro)) {
			$datos = dao_personas::get_datossinfiltro2($this->s__sqlwhere);
			$cuadro->set_datos($datos);
		}
		else{
			$datos = dao_personas::get_datos2($this->s__sqlwhere);
			$cuadro->set_datos($datos);
		}
	}

	function conf_evt__cuadro__detalles(toba_evento_usuario $evento, $fila)
	{
		$datos=$this->dep('cuadro')->get_datos()[$fila];
		$evento->vinculo()->agregar_parametro('persona', $datos['id_persona']);
	}
/*
	function conf__cuadrotel($cuadro)
	{
		if (! isset($this->s__datos_filtro)) {
			$datos = dao_datospersonas::get_datossinfiltrotel($this->s__sqlwhere);
			$cuadro->set_datos($datos);
		}
		else{
			$datos = dao_datospersonas::get_datostel($this->s__sqlwhere);
			$cuadro->set_datos($datos);
		}
	}

	function conf__cuadrodom($cuadro)
	{
		if (! isset($this->s__datos_filtro)) {
			$datos = dao_datospersonas::get_datossinfiltrodom($this->s__sqlwhere);
			$cuadro->set_datos($datos);
		}
		else{
			$datos = dao_datospersonas::get_datosdom($this->s__sqlwhere);
			$cuadro->set_datos($datos);
		}
	}

	function conf__cuadrocorreo($cuadro)
	{
		if (! isset($this->s__datos_filtro)) {
			$datos = dao_datospersonas::get_datossinfiltrocorreo($this->s__sqlwhere);
			$cuadro->set_datos($datos);
		}
		else{
			$datos = dao_datospersonas::get_datoscorreo($this->s__sqlwhere);
			$cuadro->set_datos($datos);
		}
	}
*/
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
