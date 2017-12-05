<?php

require_once ('operaciones/parametrizacion/notificaciones/dao_notificaciones.php');

class ci_notificaciones extends sgr_ci
{
	protected $s__datos;
	protected $s__datos_filtro;
	protected $s__sqlwhere;

	//-----------------------------------------------------------------------------------
	//---- cuadro -----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__cuadro($cuadro)
	{
		if (! isset($this->s__datos_filtro)) {
			$datos = dao_notificaciones::get_datossinfiltro($this->s__sqlwhere);
			$cuadro->set_datos($datos);
		}
		else{
			$datos = dao_notificaciones::get_datos($this->s__sqlwhere);
			$cuadro->set_datos($datos);
		}
	}

	function evt__cuadro__seleccion($seleccion)
	{
		$this->cn()->seleccion_notificaciones($seleccion);
		$this->set_pantalla('pant_edicion');
	}

	function evt__cuadro__borrar($seleccion)
	{
		$this->cn()->borrar_notificaciones($seleccion);
		$this->evt__procesar();
	}

	//-----------------------------------------------------------------------------------
	//---- Eventos ----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function evt__nuevo()
	{
		$this->cn()->reset_notificaciones();
		$this->set_pantalla('pant_edicion');
	}

	function evt__procesar()
	{
		try{
			$this->cn()->guardar_notificaciones();
			$this->set_registroExitoso();
			$this->cn()->reset_notificaciones();
			$this->set_pantalla('pant_inicial');
		}catch (toba_error_db $error) {
			$sql_state = $error->get_sqlstate();
			if ($sql_state == 'db_23505'){
				toba::notificacion()->agregar('Ya existe la notificacion', 'info');
			}
			else {
				toba::notificacion()->agregar('Error de carga', 'info');
			}
		}
	}

	function evt__cancelar()
	{
		$this->cn()->reset_notificaciones();
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
		$this->cn()->cargar_notificaciones($form);
	}

	function evt__form__modificacion($datos)
	{
		$this->cn()->modif_notificaciones($datos);
	}

}


?>
