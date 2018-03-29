<?php

require_once('operaciones/parametrizacion/contacto/companias_tel/dao_companias_tel.php');
require_once('operaciones/metodosconsulta/dao_generico.php');

class ci_companias_tel extends sgr_ci
{
	protected $s__datos;
	protected $s__datos_filtro;
	//protected $sql_state;

		//-----------------------------------------------------------------------------------
		//---- cuadro -----------------------------------------------------------------------
		//-----------------------------------------------------------------------------------

		function conf__cuadro($cuadro)
		{
			//if (isset($this->s__datos_filtro)) {
				$filtro = $this->dep('filtro');
				$filtro->set_datos($this->s__datos_filtro);
				$sql_where = $filtro->get_sql_where();

				$datos = dao_companias_tel::get_datos($sql_where);
				$cuadro->set_datos($datos);
			//}
		}

		/*
		function conf__cuadro($cuadro)
		{
			$datos = dao_companias_tel::get_datos();
			$cuadro->set_datos($datos);
		}
		*/

		function evt__cuadro__seleccion($seleccion)
		{
			$this->cn()->seleccioncompania($seleccion);
			$this->set_pantalla('pant_edicion');
		}

		function evt__cuadro__borrar($seleccion)
		{
			$cantidad = dao_generico::consulta_borrado_compania($seleccion['id_compania']);
			if ($cantidad>0){
				toba::notificacion()->agregar('La operaci�n fue cancelada por intentar borrar una Compa��a de Tel�fono que est� siendo utilizada por '.$cantidad.' Tel�fonos. Para borrarla deber� en primer lugar eliminar los Tel�fonos que la utilizan', 'warning');
			}
			else{
				$this->cn()->borrarcompania($seleccion);
				$this->evt__procesar();
			}
		}

		//-----------------------------------------------------------------------------------
		//---- Eventos ----------------------------------------------------------------------
		//-----------------------------------------------------------------------------------

		function evt__nuevo()
		{
			$this->cn()->resetcompania();
			$this->set_pantalla('pant_edicion');
		}

		function evt__procesar()
		{
			try{
				$this->cn()->guardarcompania();
				$this->set_registroExitoso();
				$this->cn()->resetcompania();
				$this->set_pantalla('pant_inicial');
			}catch (toba_error_db $error) {
				$sql_state = $error->get_sqlstate();
				if ($sql_state == 'db_23505'){
					toba::notificacion()->agregar('Ya existe la compa��a telef�nica', 'info');
				}
				else {
					toba::notificacion()->agregar('Error de carga', 'info');
				}
			}
		}

		function evt__cancelar()
		{
			$this->cn()->resetcompania();
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
		$this->cn()->cargarcompania($form);
	}

	function evt__form__modificacion($datos)
	{
		$this->cn()->modifcompania($datos);
	}
}


?>
