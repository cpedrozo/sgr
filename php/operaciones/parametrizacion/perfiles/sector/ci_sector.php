<?php

require_once ('operaciones/parametrizacion/perfiles/sector/dao_sector.php');

class ci_sector extends sgr_ci
{
	protected $s__datos;
	protected $s__datos_filtro;

	//-----------------------------------------------------------------------------------
	//---- cuadro -----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__cuadro($cuadro)
	{
		if (! isset($this->s__datos_filtro)) {
			$filtro = $this->dep('filtro');
			$filtro->set_datos($this->s__datos_filtro);
			$sql_where = $filtro->get_sql_where();

			$datos = dao_sector::get_datossinfiltro($sql_where);
			$cuadro->set_datos($datos);
		}
		else{
			$filtro = $this->dep('filtro');
			$filtro->set_datos($this->s__datos_filtro);
			$sql_where = $filtro->get_sql_where();

			$datos = dao_sector::get_datos($sql_where);
			$cuadro->set_datos($datos);
		}
	}

	function evt__cuadro__seleccion($seleccion)
	{
		$this->cn()->seleccionsector($seleccion);
		$this->set_pantalla('pant_edicion');
	}

	function evt__cuadro__borrar($seleccion)
	{
		$this->cn()->borrarsector($seleccion);
		$this->evt__procesar();
	}

	//-----------------------------------------------------------------------------------
	//---- Eventos ----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function evt__nuevo()
	{
		$this->cn()->resetsector();
		$this->set_pantalla('pant_edicion');
	}

	function evt__procesar()
	{
		try{
			$this->cn()->guardarsector();
		}catch (toba_error_db $error) {
			$sql_state = $error->get_sqlstate();
			if ($sql_state == 'db_23505'){
				toba::notificacion()->agregar('Ya existe el sector', 'info');
			}
			else {
				toba::notificacion()->agregar('Error de carga', 'info');
			}
		}
		$this->cn()->resetsector();
		$this->set_pantalla('pant_inicial');
	}

	function evt__cancelar()
	{
		$this->cn()->resetsector();
		$this->set_pantalla('pant_inicial');
	}


	//-----------------------------------------------------------------------------------
	//---- filtro -----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------


	function conf__filtro($filtro)
	{
	  if (isset($this->s__datos_filtro)) {
	    $filtro->set_datos($this->s__datos_filtro);
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
	//---- frm --------------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__form($form)
	{
		$this->cn()->cargarsector($form);
	}

	function evt__form__modificacion($datos)
	{
		$this->cn()->modifsector($datos);
	}
}


?>
