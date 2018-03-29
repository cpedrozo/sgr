<?php

require_once('operaciones/parametrizacion/perfiles/tipo_documento/dao_tipodocumento.php');
require_once('operaciones/metodosconsulta/dao_generico.php');

class ci_tipodocumento extends sgr_ci
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
	  if (! isset($this->s__datos_filtro)) {
	    $datos = dao_tipodocumento::get_datossinfiltro($this->s__sqlwhere);
	    $cuadro->set_datos($datos);
	  }
	  else{
	    $datos = dao_tipodocumento::get_datos($this->s__sqlwhere);
	    $cuadro->set_datos($datos);
	  }
	}

	function evt__cuadro__seleccion($seleccion)
	{
		$this->cn()->selecciontipodocumento($seleccion);
		$this->set_pantalla('pant_edicion');
	}

	function evt__cuadro__borrar($seleccion)
	{
		$cantidad = dao_generico::consulta_borrado_tipodocumento($seleccion['id_tipo_doc']);
		if ($cantidad>0){
			toba::notificacion()->agregar('La operaci�n fue cancelada por intentar borrar un Tipo de Documento que est� siendo utilizado por '.$cantidad.' Personas. Para borrarlo deber� en primer lugar eliminar las Personas que lo utilizan', 'warning');
		}
		else{
			$this->cn()->borrartipodocumento($seleccion);
			$this->evt__procesar();
		}
	}


	//-----------------------------------------------------------------------------------
	//---- Eventos ----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function evt__nuevo()
	{
		$this->cn()->resettipodocumento();
		$this->set_pantalla('pant_edicion');
	}

	function evt__procesar()
	{
		try{
			$this->cn()->guardartipodocumento();
			$this->set_registroExitoso();
			$this->cn()->resettipodocumento();
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
		$this->cn()->resettipodocumento();
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
		$this->cn()->cargartipodocumento($form);
	}

	function evt__form__modificacion($datos)
	{
		$this->cn()->modiftipodocumento($datos);
	}
}


?>
