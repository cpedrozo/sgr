<?php

require_once('operaciones/parametrizacion/operaciones/nivelurgencia/dao_nivelurgencia.php');
require_once('operaciones/metodosconsulta/dao_generico.php');

class ci_nivelurgencia extends sgr_ci
{

	//-----------------------------------------------------------------------------------
	//---- Variables ----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------
	protected $s__datos_filtro;
	protected $s__sqlwhere;
	protected $s__datos;
	protected $s__datosborrar;

	//-----------------------------------------------------------------------------------
	//---- cuadro --------------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__cuadro($cuadro)
	{
		if (! isset($this->s__datos_filtro)) {
			$datos = dao_nivelurgencia::get_datossinfiltro($this->s__sqlwhere);
			$cuadro->set_datos($datos);
		}
		else{
			$datos = dao_nivelurgencia::get_datos($this->s__sqlwhere);
			$cuadro->set_datos($datos);
		}
	}

	function evt__cuadro__seleccion($seleccion)
	{
	  $this->cn()->seleccionnivelurgencia($seleccion);
	  $this->set_pantalla('pant_edicion');
	}

	function evt__cuadro__borrar($seleccion)
	{
		$cantidad = dao_generico::consulta_borrado_nivelurgencia($seleccion['id_nivelurgencia']);
	  if ($cantidad>0){
	    toba::notificacion()->agregar('La operación fue cancelada por intentar borrar un Nivel de Urgencia que está siendo utilizado por '.$cantidad.' Flujos. Para borrarlo deberá en primer lugar eliminar los registros asociados', 'warning');
	  }
	  else{
			$this->cn()->borrarnivelurgencia($seleccion);
			$this->evt__procesar();
	  }
	}

	//-----------------------------------------------------------------------------------
	//---- Eventos ----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function evt__nuevo()
	{
	  $this->cn()->resetnivelurgencia();
	  $this->set_pantalla('pant_edicion');
	}

	function comprobar_guardar_nivelurgencia() ////20180414
	{
		if (dao_nivelurgencia::existe_db_nivelurgencia($this->s__datosborrar['nombre']))
		{
			toba::notificacion()->agregar('Ya existe el nivel de urgencia', 'warning');
			return false;
		}
		return true;
	}

	function evt__procesar()
	{
		if($this->comprobar_guardar_nivelurgencia())
		{
			try{
				$this->cn()->guardarnivelurgencia();
				$this->set_registroExitoso();
				$this->cn()->resetnivelurgencia();
				$this->set_pantalla('pant_inicial');
			}catch (toba_error_db $error) {
				$sql_state = $error->get_sqlstate();
				if ($sql_state == 'db_23502'){
					toba::notificacion()->agregar('El nivel de urgencia que quiere cargar ya existe', 'info');
				}
				else {
					toba::notificacion()->agregar('Error de carga', 'info');
				}
			}
		}
	}

	function evt__cancelar()
	{
	  $this->cn()->resetnivelurgencia();
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
	  $this->cn()->cargarnivelurgencia($form);
	}

	function evt__form__modificacion($datos)
	{
		$this->s__datosborrar = $datos;
	  $this->cn()->modifnivelurgencia($datos);
	}
}
?>
