<?php

require_once('operaciones/parametrizacion/operaciones/flujoseventos/dao_flujoseventos.php');

class ci_flujoseventos extends sgr_ci
{

	//-----------------------------------------------------------------------------------
	//---- Variables ----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------
	protected $s__datos_filtro;
	protected $s__sqlwhere;
	protected $s__datos;

	//-----------------------------------------------------------------------------------
	//---- cuadro --------------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function get_seleccion()
	{
		return $this->s__datos['seleccion'];
	}

	function conf__cuadro($cuadro)
	{
	  if (! isset($this->s__datos_filtro)) {
	    $datos = dao_flujoseventos::get_datossinfiltro($this->s__sqlwhere);
	    $cuadro->set_datos($datos);
	  }
	  else{
	    $datos = dao_flujoseventos::get_datos($this->s__sqlwhere);
	    $cuadro->set_datos($datos);
	  }
	}

	function evt__cuadro__seleccion($seleccion)
	{
		$this->s__datos['seleccion'] = $seleccion;
	  $this->cn()->cargar_dr_flujoseventos($seleccion);
	  $this->cn()->set_cursorflujoseventos($seleccion);
	  $this->set_pantalla('pant_edicion');
	}

	function evt__cuadro__detalles($seleccion)
	{
	  $this->cn()->cargar_dr_flujoseventos($seleccion);
	  $this->cn()->set_cursorflujoseventos($seleccion);
	}

	function evt__cuadro__borrar($seleccion)
	{
	  $this->cn()->cargar_dr_flujoseventos($seleccion);
	  $this->cn()->borrar_dt_flujoseventos($seleccion);
	  try{
	    $this->cn()->guardar_dr_flujoseventos();
	    $this->cn()->resetear_dr_flujoseventos();
	  } catch (toba_error_db $error) {
	    ei_arbol(array('$error->get_sqlstate():' => $error->get_mensaje_log()));
	    toba::notificacion()->agregar('Error de carga', 'info');
	    $this->cn()->resetear_dr_flujoseventos();
	    $this->set_pantalla('pant_inicial');
	  }
	}

	//-----------------------------------------------------------------------------------
	//---- Eventos ----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function evt__nuevo()
	{
	  $this->cn()->resetear_dr_flujoseventos();
	  $this->set_pantalla('pant_edicion');
	}

	function evt__procesar()
	{
	  try{
	    $this->cn()->guardar_dr_flujoseventos();
			$this->set_registroExitoso();
			$this->cn()->resetear_dr_flujoseventos();
			$this->set_pantalla('pant_inicial');
	  }catch (toba_error_db $error) {
	    $sql_state = $error->get_sqlstate();
	    if ($sql_state == 'db_23505'){
	      toba::notificacion()->agregar('Ya existe el flujo', 'info');
	    }
	    else {
	      toba::notificacion()->agregar('Error de carga', 'info');
	    }
	  }
	}

	function evt__cancelar()
	{
	  $this->cn()->resetear_dr_flujoseventos();
	  $this->set_pantalla('pant_inicial');
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
