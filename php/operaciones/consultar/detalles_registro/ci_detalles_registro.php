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
		$this->s__datos['form'] = $datos;
	}

	//-----------------------------------------------------------------------------------
	//---- form_ml_detalles_registro-----------------------------------------------------
	//-----------------------------------------------------------------------------------

	function evt__cancelar()
	{
		$this->set_pantalla('pant_inicial');
	}

	function conf__form_ml_detalles_registro($form_ml)
	{
		if (isset($this->s__datos['seleccion']))
		{
			$seleccion = $this->s__datos['seleccion'];
			$datos = dao_detalles_registro::cargar_ml($seleccion);
		}
		$form_ml->set_datos($datos);
	}

	//-----------------------------------------------------------------------------------
	//---- reporte ----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function vista_jasperreports(toba_vista_jasperreports $reporte)
	{
		$path_toba = '/home/toba_2_6_7/toba_2_7_6';
		$path_reporte = $path_toba . '/exportaciones/jasper/sgr/03-detalle_registro.jasper';
		$reporte->set_path_reporte($path_reporte);
		$usuario = toba::usuario()->get_nombre();
		$nombre_archivo = $this->s__datos['form']['registro'].'.pdf';
		$idregistro = $this->s__datos['form']['id_registro'];
		$titulo = 'Detalles del registro '.'<br/>'.$this->s__datos['form']['registro'];
		$reporte->set_parametro('idregistro','E',$idregistro);
		$reporte->set_parametro('titulo','S',$titulo);
		$reporte->set_parametro('usuario','S',$usuario);
		$reporte->set_nombre_archivo($nombre_archivo);
		$db = toba::db('sgr');
		$reporte->set_conexion($db);
	}

}
?>
