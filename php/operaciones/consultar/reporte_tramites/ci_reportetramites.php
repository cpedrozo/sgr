<?php
require_once('operaciones/consultar/reporte_tramites/dao_reportetramites.php');

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
		$cuadro->eliminar_columnas(['sucursal_dpto']);
		if (!isset($this->s__datos_filtro['fecha_fin']))
		{
			$cuadro->eliminar_columnas(['fecha_fin']);
		}
		if (!isset($this->s__datos_filtro['id_registro']))
		{
			$cuadro->eliminar_columnas(['id_registro']);
		}
		if (!isset($this->s__datos_filtro['fecha_inicio']))
		{
			$cuadro->eliminar_columnas(['fecha_inicio']);
		}
		if (!isset($this->s__datos_filtro['ultedicion']))
		{
			$cuadro->eliminar_columnas(['ultedicion']);
		}
		if (!isset($this->s__datos_filtro['caducidad']))
		{
			$cuadro->eliminar_columnas(['caducidad']);
		}
		if (! isset($this->s__datos_filtro)) {
			$datos = dao_reportetramites::get_datossinfiltro($this->s__sqlwhere);
			$cuadro->set_datos($datos);
		}
		else{
			$datos = dao_reportetramites::get_datos($this->s__sqlwhere);
			$cuadro->set_datos($datos);
		}
	}

	function conf_evt__cuadro__detalles(toba_evento_usuario $evento, $fila)
	{
		$datos=$this->dep('cuadro')->get_datos()[$fila];
		$evento->vinculo()->agregar_parametro('persona', $datos['id_persona']);
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
