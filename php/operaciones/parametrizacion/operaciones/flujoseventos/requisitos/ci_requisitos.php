<?php
require_once('operaciones/parametrizacion/operaciones/flujoseventos/requisitos/dao_requisitos.php');

class ci_requisitos extends sgr_ci
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
			$datos = dao_requisitos::get_datossinfiltro($this->s__sqlwhere);
			$cuadro->set_datos($datos);
		}
		else{
			$datos = dao_requisitos::get_datos($this->s__sqlwhere);
			$cuadro->set_datos($datos);
		}
	}

	function evt__cuadro__seleccion($seleccion)
	{
	  $this->cn()->seleccionrequisitos($seleccion);
	  $this->set_pantalla('pant_edicion');
	}

	function evt__cuadro__borrar($seleccion)
	{
	  $this->cn()->borrarrequisitos($seleccion);
	  $this->evt__procesar();
	}

	//-----------------------------------------------------------------------------------
	//---- Eventos ----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function evt__nuevo()
	{
	  $this->cn()->resetrequisitos();
	  $this->set_pantalla('pant_edicion');
	}

	function guardar_registros()
	{
		try{
			$this->cn()->guardarrequisitos();
		}catch (toba_error_db $error) {
			$sql_state = $error->get_sqlstate();
			if ($sql_state == 'db_23505'){
				toba::notificacion()->agregar('Ya existe el requisito', 'info');
			}
			else {
				toba::notificacion()->agregar('Error de carga', 'info');
			}
		}
		$this->cn()->resetrequisitos();
	}

	function evt__procesar()
	{
		$this->guardar_registros();
	  $this->controlador()->set_pantalla('pant_inicial');
	}

	function evt__cancelar()
	{
	  $this->cn()->resetrequisitos();
	  $this->controlador()->set_pantalla('pant_inicial');
	}

	function evt__form_ml_flujos__requisitos($seleccion)
	{
		$this->s__datos['cursorflujos']['0'] = $this->cn()->get_cursorflujo();
		$this->s__datos['cursorflujos']['1'] = $seleccion;
		//$datos=$this->dep('form_ml_flujos')->get_datos();
		$this->cn()->seleccionflujo($seleccion);
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
	//---- frm_flujoseventos-------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__form(sgr_ei_formulario $form)
	{
	  $datos = $this->cn()->get_flujoseventos();
	  $form->set_datos($datos);
	}

	function evt__form__modificacion($datos)
	{
	  $this->cn()->set_dt_flujoseventos($datos);
	}

	//-----------------------------------------------------------------------------------
	//---- form_ml_flujos-------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__form_ml_flujos(sgr_ei_formulario_ml $form_ml)
	{
	  $datos = $this->cn()->getflujos();
	  $form_ml->set_datos($datos);
	}

	function evt__form_ml_flujos__modificacion($datos)
	{
	  $this->cn()->procesarflujos($datos);
	}

	//-----------------------------------------------------------------------------------
	//---- form_ml_requisitos------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__form_ml_requisitos(sgr_ei_formulario_ml $form_ml_requisitos)
	{
	  $datos = $this->cn()->getrequisitos();
	  $form_ml_requisitos->set_datos($datos);
	}

	function evt__form_ml_requisitos__modificacion($datos)
	{
		$this->cn()->seleccionflujo($this->s__datos['cursorflujos']['0']);
	  $this->cn()->procesarrequisitos($datos);
		$this->cn()->seleccionflujo($this->s__datos['cursorflujos']['1']);
	}

	function evt__form_ml_requisitos__guardar($datos)
	{
		$this->evt__form_ml_requisitos__modificacion($datos);
		$this->guardar_registros();
		$seleccion = $this->controlador()->get_seleccion();
		$this->controlador()->evt__cuadro__seleccion($seleccion);
	}

	//-----------------------------------------------------------------------------------
	//---- pantalla ---------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__pant_flujosreq($pantalla)
	{
		if (!$this->cn()->hay_cursor_flujo())
		{
			$pantalla->eliminar_dep('form_ml_requisitos');
		}
	}

}
?>
