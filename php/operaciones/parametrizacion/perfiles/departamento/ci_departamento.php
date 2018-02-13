<?php
require_once('operaciones/parametrizacion/perfiles/departamento/dao_departamento.php');

class ci_departamento extends sgr_ci
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
				$datos = dao_departamento::get_datossinfiltro($this->s__sqlwhere);
				$cuadro->set_datos($datos);
			}
			else{
				$datos = dao_departamento::get_datos($this->s__sqlwhere);
				$cuadro->set_datos($datos);
			}
		}

		function evt__cuadro__seleccion($seleccion)
		{
			$this->cn()->cargar_dr_departamento($seleccion);
			$this->cn()->set_cursordepartamento($seleccion);
			$this->set_pantalla('pant_edicion');
		}

		function evt__cuadro__borrar($seleccion)
		{
			$this->cn()->cargar_dr_departamento($seleccion);
			$this->cn()->borrar_dt_departamento($seleccion);
			try{
				$this->cn()->guardar_dr_departamento();
				$this->cn()->resetear_dr_departamento();
			} catch (toba_error_db $error) {
				toba::notificacion()->agregar('Error de carga', 'info');
				$this->cn()->resetear_dr_departamento();
				$this->set_pantalla('pant_inicial');
			}
		}

		//-----------------------------------------------------------------------------------
		//---- Eventos ----------------------------------------------------------------------
		//-----------------------------------------------------------------------------------

		function evt__nuevo()
		{
			$this->cn()->resetear_dr_departamento();
			$this->set_pantalla('pant_edicion');
		}

		function evt__procesar()
		{
			try{
				$this->cn()->guardar_dr_departamento();
				$this->set_registroExitoso();
				$this->cn()->resetear_dr_departamento();
				$this->set_pantalla('pant_inicial');
			}catch (toba_error_db $error) {
				$sql_state = $error->get_sqlstate();
				if ($sql_state == 'db_23505'){
					toba::notificacion()->agregar('Ya existe el departamento', 'info');
				}
				else {
					toba::notificacion()->agregar('Error de carga', 'info');
				}
			}
		}

		function evt__cancelar()
		{
			$this->cn()->resetear_dr_departamento();
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
			$datos = $this->cn()->get_departamento();
			$form->set_datos($datos);
		}

		function evt__form__modificacion($datos)
		{
			$this->cn()->set_dt_departamento($datos);
		}

		//-----------------------------------------------------------------------------------
		//---- frm_correo -------------------------------------------------------------------
		//-----------------------------------------------------------------------------------

		function conf__form_correo(sgr_ei_formulario $form)
		{
			$datos = $this->cn()->get_correo();
			if (count($datos) == 0){
				$form->set_datos_defecto(dao_departamento::get_tipocorreo());
			} else {
				$form->set_datos($datos);
			}
		}

		function evt__form_correo__modificacion($datos)
		{
			$this->cn()->set_dt_correo($datos);
		}

}
?>
