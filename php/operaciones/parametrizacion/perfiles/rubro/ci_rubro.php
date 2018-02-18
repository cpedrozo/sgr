<?php

require_once('operaciones/parametrizacion/perfiles/rubro/dao_rubro.php');
require_once('operaciones/metodosconsulta/dao_generico.php');

class ci_rubro extends sgr_ci
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
			$datos = dao_rubro::get_datossinfiltro($sql_where);
			$cuadro->set_datos($datos);
		}
		else{
			$filtro = $this->dep('filtro');
			$filtro->set_datos($this->s__datos_filtro);
			$sql_where = $filtro->get_sql_where();
			$datos = dao_rubro::get_datos($sql_where);
			$cuadro->set_datos($datos);
		}
	}

	function evt__cuadro__seleccion($seleccion)
	{
		$this->cn()->seleccionrubro($seleccion);
		$this->set_pantalla('pant_edicion');
	}

	function evt__cuadro__borrar($seleccion)
	{
		$cantidad = dao_generico::consulta_borrado_rubro($seleccion['id_rubro']);
		if ($cantidad>0){
			toba::notificacion()->agregar('La operación fue cancelada por intentar borrar un Rubro que está siendo utilizado por '.$cantidad.' Entidades. Para borrarlo deberá en primer lugar eliminar las Entidades que lo utilizan', 'warning');
		}
		else{
			$this->cn()->borrarrubro($seleccion);
			$this->evt__procesar();
		}
	}


	//-----------------------------------------------------------------------------------
	//---- Eventos ----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function evt__nuevo()
	{
		$this->cn()->resetrubro();
		$this->set_pantalla('pant_edicion');
	}

	function evt__procesar()
	{
		try{
			$this->cn()->guardarrubro();
			$this->set_registroExitoso();
			$this->cn()->resetrubro();
			$this->set_pantalla('pant_inicial');
		}catch (toba_error_db $error) {
			$sql_state = $error->get_sqlstate();
			if ($sql_state == 'db_23505'){
				toba::notificacion()->agregar('Ya existe el rubro', 'info');
			}
			else {
				toba::notificacion()->agregar('Error de carga', 'info');
			}
		}
	}

	function evt__cancelar()
	{
		$this->cn()->resetrubro();
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
		$this->cn()->cargarrubro($form);
	}

	function evt__form__modificacion($datos)
	{
		$this->cn()->modifrubro($datos);
	}
}


?>
