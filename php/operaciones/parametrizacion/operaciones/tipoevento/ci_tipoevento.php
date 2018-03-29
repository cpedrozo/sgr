<?php

require_once('operaciones/parametrizacion/operaciones/tipoevento/dao_tipoevento.php');
require_once('operaciones/metodosconsulta/dao_generico.php');

class ci_tipoevento extends sgr_ci
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
			$datos = dao_tipoevento::get_datossinfiltro($this->s__sqlwhere);
			$cuadro->set_datos($datos);
		}
		else{
			$datos = dao_tipoevento::get_datos($this->s__sqlwhere);
			$cuadro->set_datos($datos);
		}
	}

	function evt__cuadro__seleccion($seleccion)
	{
	  $this->cn()->selecciontipoevento($seleccion);
	  $this->set_pantalla('pant_edicion');
	}

	function evt__cuadro__borrar($seleccion)
	{
		$cantidad = dao_generico::consulta_borrado_tipoevento($seleccion['id_tipoevento']);
	  if ($cantidad>0){
	    toba::notificacion()->agregar('La operación fue cancelada por intentar borrar un Tipo de Evento que está siendo utilizado por '.$cantidad.' Eventos. Para borrarlo deberá en primer lugar eliminar los Eventos asociados', 'warning');
	  }
	  else{
			$this->cn()->borrartipoevento($seleccion);
			$this->evt__procesar();
	  }
	}

	//-----------------------------------------------------------------------------------
	//---- Eventos ----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function evt__nuevo()
	{
	  $this->cn()->resettipoevento();
	  $this->set_pantalla('pant_edicion');
	}

	function evt__procesar()
	{
	  try{
	    $this->cn()->guardartipoevento();
			$this->set_registroExitoso();
			$this->cn()->resettipoevento();
			$this->set_pantalla('pant_inicial');
	  }catch (toba_error_db $error) {
	    $sql_state = $error->get_sqlstate();
	    if ($sql_state == 'db_23505'){
	      toba::notificacion()->agregar('Ya existe el tipo de evento', 'info');
	    }
	    else {
	      toba::notificacion()->agregar('Error de carga', 'info');
	    }
	  }
	}

	function evt__cancelar()
	{
	  $this->cn()->resettipoevento();
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
	  $this->cn()->cargartipoevento($form);
	}

	function evt__form__modificacion($datos)
	{
	  $this->cn()->modiftipoevento($datos);
	}
}
?>
