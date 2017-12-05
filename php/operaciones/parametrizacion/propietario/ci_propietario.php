<?php

require_once('operaciones/parametrizacion/propietario/dao_propietario.php');

class ci_propietario extends sgr_ci
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

	function conf__cuadro($cuadro)
	{
		if (! isset($this->s__datos_filtro)) {
			$datos = dao_propietario::get_datossinfiltro($this->s__sqlwhere);
			$cuadro->set_datos($datos);
		}
		else{
			$datos = dao_propietario::get_datos($this->s__sqlwhere);
			$cuadro->set_datos($datos);
		}
	}

	function evt__cuadro__seleccion($seleccion)
	{
		$this->cn()->seleccionpropietario($seleccion);
		$this->set_pantalla('pant_edicion');
	}

	function evt__cuadro__borrar($seleccion)
	{
		$this->cn()->borrarpropietario($seleccion);
		$this->evt__procesar();
	}

	//-----------------------------------------------------------------------------------
	//---- Eventos ----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function evt__nuevo()
	{
		$this->cn()->resetpropietario();
		$this->set_pantalla('pant_edicion');
	}

	function evt__procesar()
	{
		try{
			$this->cn()->guardarpropietario();
			$this->set_registroExitoso();
			$this->cn()->resetpropietario();
			$this->set_pantalla('pant_inicial');
		}catch (toba_error_db $error) {
			$sql_state = $error->get_sqlstate();
			if ($sql_state == 'db_23505'){
				toba::notificacion()->agregar('Ya existe el propietario', 'info');
			}
			else {
				toba::notificacion()->agregar('Error de carga', 'info');
			}
		}
	}

	function evt__cancelar()
	{
		$this->cn()->resetpropietario();
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


	//-----------------------------------------------------------------------------------
	//---- frm --------------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__form($form)
	{
		$this->cn()->cargarpropietario($form);
	}

	function evt__form__modificacion($datos)
	{
		$this->cn()->modifpropietario($datos);
	}
}
?>
