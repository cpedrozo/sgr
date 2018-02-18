<?php

require_once('operaciones/parametrizacion/perfiles/rol/dao_rol.php');
require_once('operaciones/metodosconsulta/dao_generico.php');

class ci_rol extends sgr_ci
{
	protected $s__datos;
	protected $s__datos_filtro;

	//-----------------------------------------------------------------------------------
	//---- cuadro -----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__cuadro($cuadro)
	{
			$filtro = $this->dep('filtro');
			$filtro->set_datos($this->s__datos_filtro);
			$sql_where = $filtro->get_sql_where();
			$datos = dao_rol::get_datos($sql_where);
			$cuadro->set_datos($datos);
	}

	function evt__cuadro__seleccion($seleccion)
	{
		$this->cn()->seleccionrol($seleccion);
		$this->set_pantalla('pant_edicion');
	}

	function evt__cuadro__borrar($seleccion)
	{
		$cantidad = dao_generico::consulta_borrado_rol($seleccion['id_rol']);
		if ($cantidad>0){
			toba::notificacion()->agregar('La operación fue cancelada por intentar borrar un Rol que está siendo utilizado por '.$cantidad.' Personas. Para borrarlo deberá en primer lugar eliminar las Personas que lo utilizan', 'warning');
		}
		else{
			$this->cn()->borrarrol($seleccion);
			$this->evt__procesar();
		}
	}


	//-----------------------------------------------------------------------------------
	//---- Eventos ----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function evt__nuevo()
	{
		$this->cn()->resetrol();
		$this->set_pantalla('pant_edicion');
	}

	function evt__procesar()
	{
		try{
			$this->cn()->guardarrol();
			$this->set_registroExitoso();
			$this->cn()->resetrol();
			$this->set_pantalla('pant_inicial');
		}catch (toba_error_db $error) {
			$sql_state = $error->get_sqlstate();
			if ($sql_state == 'db_23505'){
				toba::notificacion()->agregar('Ya existe el rol', 'info');
			}
			else {
				toba::notificacion()->agregar('Error de carga', 'info');
			}
		}
	}

	function evt__cancelar()
	{
		$this->cn()->resetrol();
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
		$this->cn()->cargarrol($form);
	}

	function evt__form__modificacion($datos)
	{
		$this->cn()->modifrol($datos);
	}
}


?>
