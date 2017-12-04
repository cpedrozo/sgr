<?php

require_once('operaciones/consultar/detalles_registro/dao_detalles_registro.php');

class ci_detalles_registro extends sgr_ci
{

	//-----------------------------------------------------------------------------------
	//---- Variables ----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------
	protected $s__datos_filtro;
	protected $s__sqlwhere;
	protected $s__datos;
	protected $s__datos2;

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
	//---- cuadro -----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__cuadro($cuadro)
	{
		if (! isset($this->s__datos_filtro)) {
			$datos = dao_detalles_registro::get_datossinfiltro($this->s__sqlwhere);
			$cuadro->set_datos($datos);
		}
		else{
			$datos = dao_detalles_registro::get_datos($this->s__sqlwhere);
			$cuadro->set_datos($datos);
		}
	}

	function evt__cuadro__seleccion($seleccion)
	{
		$this->s__datos['seleccion'] = $seleccion;
		$this->set_pantalla('pant_edicion');
	}

	//-----------------------------------------------------------------------------------
	//---- form -------------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__form($form)
	{
		if (isset($this->s__datos['seleccion']))
		{
			$seleccion = $this->s__datos['seleccion'];
			$datos = dao_detalles_registro::cargar_form($seleccion);
		}
		$form->set_datos($datos);
	}

	//-----------------------------------------------------------------------------------
	//---- form_ml_detalles_registro-----------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__form_ml_detalles_registro($form_ml)
	{
		if (isset($this->s__datos['seleccion']))
		{
			$seleccion = $this->s__datos['seleccion'];
			$datos = dao_detalles_registro::cargar_ml($seleccion);
		}
		$form_ml->set_datos($datos);
	}

/*
	//-----------------------------------------------------------------------------------
	//---- notif_email ------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function evt__enviar_mail($seleccion)
	{
		$this->enviar_mail();
	}

	function enviar_mail()
	{
		//Se envia el mail a la direccion especificada por el usuario.
    $asunto = 'xxxAsunto de pruebaxxx';
    $cuerpo_mail = '<p>Este mail fue enviado a esta cuenta porque se <strong>solicito un cambio de contraseña</strong>.'
    . 'Si usted solicito dicho cambio haga click en el siguiente link: </br></br>'
    .'</br> El mismo será válido unicamente por 24hs.</p>';

    //Guardo el random asociado al usuario y envio el mail
		$mail = new toba_mail('piguazu@gmail.com', $asunto, $cuerpo_mail);
		$mail->set_html(true);
		$mail->enviar();
    /*try {
        $mail = new toba_mail('piguazu@gmail.com', $asunto, $cuerpo_mail);
        $mail->set_html(true);
        $mail->enviar();
    } catch (toba_error $e) {
        toba::instancia()->get_db()->abortar_transaccion();
        toba::logger()->debug('Proceso de envio de random a cuenta: '. $e->getMessage());
        throw new toba_error('Se produjo un error en el proceso de cambio, contactese con un administrador del sistema.');
    }
	}
*/
}
?>
