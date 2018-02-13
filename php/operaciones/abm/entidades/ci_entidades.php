<?php
require_once('operaciones/abm/entidades/dao_entidades.php');

class ci_entidades extends sgr_ci
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

	function ini()
	{
			if ($this->controlador()->get_id()[1]=='1000866')
				{
					$this->dep('cuadro')->eliminar_evento('seleccion2');
					$this->dep('cuadro')->eliminar_evento('detalles');
					$this->dep('cuadro')->eliminar_evento('borrar');
				}
			else {
				$this->dep('cuadro')->eliminar_evento('seleccion');
			}
	}

	function conf__cuadro($cuadro)
	{
		$cuadro->desactivar_modo_clave_segura();
		if (! isset($this->s__datos_filtro)) {
			$datos = dao_entidades::get_datossinfiltro($this->s__sqlwhere);
			$cuadro->set_datos($datos);
		}
		else{
			$datos = dao_entidades::get_datos($this->s__sqlwhere);
			$cuadro->set_datos($datos);
		}
	}

	function evt__cuadro__seleccion2($seleccion)
	{
		$this->cn()->cargar_dr_entidades($seleccion);
		$this->cn()->set_cursorentidades($seleccion);
		$this->set_pantalla('pant_edicion');
	}

	function evt__cuadro__detalles($seleccion)
	{
		$this->cn()->cargar_dr_entidades($seleccion);
		$this->cn()->set_cursorentidades($seleccion);
		//$this->set_pantalla('pant_edicion');
	}

	function evt__cuadro__borrar($seleccion)
	{
		$this->cn()->cargar_dr_entidades($seleccion);
		$this->cn()->borrar_dt_entidades($seleccion);
		try{
			$this->cn()->guardar_dr_entidades();
			$this->cn()->resetear_dr_entidades();
		} catch (toba_error_db $error) {
			toba::notificacion()->agregar('Error de carga', 'info');
			$this->cn()->resetear_dr_entidades();
			$this->set_pantalla('pant_inicial');
		}
	}

	function conf_evt__cuadro__detalles(toba_evento_usuario $evento, $fila)
	{
		$datos=$this->dep('cuadro')->get_datos()[$fila];
		$evento->vinculo()->agregar_parametro('entidad', $datos['id_entidad']);
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
			$this->set_registroExitoso();
			$this->cn()->resetear_dr_entidades();
			$this->set_pantalla('pant_inicial');
		}catch (toba_error_db $error) {
			$sql_state = $error->get_sqlstate();
			if ($sql_state == 'db_23505'){
				toba::notificacion()->agregar('Ya existe la entidad', 'info');
			}
			else {
			}
		}
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
