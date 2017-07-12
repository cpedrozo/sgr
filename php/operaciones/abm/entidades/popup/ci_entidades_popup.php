<?php
require_once('operaciones/abm/entidades/dao_entidades.php');

class ci_entidades_popup extends sgr_ci
{

	//-----------------------------------------------------------------------------------
	//---- Variables ----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------
	protected $s__datos_filtro;
	protected $s__sqlwhere;
	protected $s__datos;
	protected $s__id;

	//-----------------------------------------------------------------------------------
	//---- cuadro -----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------
/*
	function conf__form(sgr_ei_formulario $form)
	{
		$datos = $this->cn()->get_personas();
		$form->set_datos($datos);
	}

	function evt__form__modificacion($datos)
	{
		$this->cn()->set_dt_personas($datos);
	}

*/

	//function conf()
	//{
	//  $this->s__id = toba::memoria()->get_parametro('id_integ');
	//}

	function conf__cuadroentidad($cuadro)
	{
		$datos = $this->s__id = toba::memoria()->get_parametro('id_entidad');
		//$datos = $this->cn()->get_entidades();
		ei_arbol(array($datos));
		$cuadro->set_datos($datos);
	}

	function evt__cuadro__seleccion($seleccion)
	{
		$this->cn()->cargar_dr_entidades($seleccion);
		$this->cn()->set_cursorentidades($seleccion);
		$this->set_pantalla('pant_edicion');
	}

	function evt__cuadro__borrar($seleccion)
	{
		$this->cn()->cargar_dr_entidades($seleccion);
		$this->cn()->borrar_dt_entidades($seleccion);
		try{
			$this->cn()->guardar_dr_entidades();
			$this->cn()->resetear_dr_entidades();
		} catch (toba_error_db $error) {
			ei_arbol(array('$error->get_sqlstate():' => $error->get_mensaje_log()));
			toba::notificacion()->agregar('Error de carga', 'info');
			$this->cn()->resetear_dr_entidades();
			$this->set_pantalla('pant_inicial');
		}
	}

	//-----------------------------------------------------------------------------------
	//---- Eventos ----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function evt__nuevo()
	{
		$this->cn()->resetear_dr_entidades();
		$this->set_pantalla('pant_edicion');
	}

	function evt__procesar()
	{
		try{
			$this->cn()->guardar_dr_entidades();
		}catch (toba_error_db $error) {
			$sql_state = $error->get_sqlstate();
			if ($sql_state == 'db_23505'){
				toba::notificacion()->agregar('Ya existe la entidad', 'info');
			}
			else {
				//ei_arbol(array('$error->get_sqlstate():' => $error->get_mensaje_log()));
				toba::notificacion()->agregar('Error de carga', 'info');
			}
		}
		$this->cn()->resetear_dr_entidades();
		$this->set_pantalla('pant_inicial');
	}

	function evt__cancelar()
	{
		$this->cn()->resetear_dr_entidades();
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


	function conf__form(sgr_ei_formulario $form)
	{
	 	$datos = $this->cn()->get_entidades();
	 	$form->set_datos($datos);
	}

	function evt__form__modificacion($datos)
	{
		$this->cn()->set_dt_entidades($datos);
	}

	//-----------------------------------------------------------------------------------
	//---- form_ml_domicilio-------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__form_ml_domicilio(sgr_ei_formulario_ml $form_ml)
	{
		$datos = $this->cn()->getdomicilio_entidades();
		$form_ml->set_datos($datos);
	}

	function evt__form_ml_domicilio__modificacion($datos)
	{
		$this->cn()->procesardomicilio_entidades($datos);
	}

	//-----------------------------------------------------------------------------------
	//---- form_ml_tel ------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__form_ml_tel(sgr_ei_formulario_ml $form_ml)
	{
		$datos = $this->cn()->gettelefono_entidades();
		$form_ml->set_datos($datos);
	}

	function evt__form_ml_tel__modificacion($datos)
	{
		$this->cn()->procesartelefono_entidades($datos);
	}

	function ajax__traerinfo_tipotel($id_renglon, toba_ajax_respuesta $respuesta)
	{
		$datos_renglon = dao_entidades::get_tipotel($id_renglon);
		$respuesta->set($datos_renglon);
	}

	//-----------------------------------------------------------------------------------
	//---- form_ml_correo ---------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__form_ml_correo(sgr_ei_formulario_ml $form_ml)
	{
		$datos = $this->cn()->getcorreo_entidades();
		$form_ml->set_datos($datos);
	}

	function evt__form_ml_correo__modificacion($datos)
	{
		$this->cn()->procesarcorreo_entidades($datos);
	}

}
?>
