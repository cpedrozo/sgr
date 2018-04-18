<?php

require_once('operaciones/ayuda/acerca/dao_acerca.php');

class cn_parametrizacion extends sgr_cn
{
  //-----------------------------------------------------------------------------------
  //---- Acerca_de --------------------------------------------------------------------
  //-----------------------------------------------------------------------------------

  function cargar_acercade($form)
  {
    $datos['nombre'] = '<body><p align="center"><strong><big>'.dao_acerca::consulta_texto()['nombre'].'</big></strong></p></body>';
    $datos['version'] = '<p align="center">Versión '.dao_acerca::consulta_texto()['version'].'</p>';
    $datos['desarrollador'] = '<p align="center">Desarrollado por '.dao_acerca::consulta_texto()['desarrollador'].'</p>';

    $fp_imagen1 = dao_acerca::consulta_logo();

    if (isset($fp_imagen1)) {
      $temp_nombre1 = 'logo_mediano';
      $temp_archivo1 = toba::proyecto()->get_www_temp($temp_nombre1);
      $temp_imagen1 = fopen($temp_archivo1['path'], 'w');
      stream_copy_to_stream($fp_imagen1, $temp_imagen1);
      fclose($temp_imagen1);
      $tamanio_imagen1 = round(filesize($temp_archivo1['path']) / 1024);
      $datos['logo'] = "<center><img src = '{$temp_archivo1['url']}' alt=\"Imagen\" WIDTH=150 HEIGHT=150 ></center>";
    }
    $form->set_datos($datos);
  }

  //-----------------------------------------------------------------------------------
  //---- ABM sgr_desarrollador ----------------------------------------------------------
  //-----------------------------------------------------------------------------------

  function cargardesarrollador($form)
  {
    if ($this->dep('dr_desarrollador')->tabla('dt_sgr')->hay_cursor()) {
    $datos = $this->dep('dr_desarrollador')->tabla('dt_sgr')->get();

    $fp_imagen1 = $this->dep('dr_desarrollador')->tabla('dt_sgr')->get_blob('logo_grande');
    $fp_imagen2 = $this->dep('dr_desarrollador')->tabla('dt_sgr')->get_blob('logo_chico');

    if (isset($fp_imagen1)) {
      $temp_nombre1 = 'logo_grande' . $datos['id_sgr'];
      $temp_archivo1 = toba::proyecto()->get_www_temp($temp_nombre1);
      $temp_imagen1 = fopen($temp_archivo1['path'], 'w');
      stream_copy_to_stream($fp_imagen1, $temp_imagen1);
      fclose($temp_imagen1);
      $tamanio_imagen1 = round(filesize($temp_archivo1['path']) / 1024);
      $datos['prevgrande'] = "<img src = '{$temp_archivo1['url']}' alt=\"Imagen\" WIDTH=200 HEIGHT=150 >";
      $datos['logo_grande'] = 'Tamaño foto actual: '.$tamanio_imagen1.' KB';
    } else {
      $datos['logo_grande'] = null;
    }

    if (isset($fp_imagen2)) {
      $temp_nombre2 = 'logo_chico' . $datos['id_sgr'];
      $temp_archivo2 = toba::proyecto()->get_www_temp($temp_nombre2);
      $temp_imagen2 = fopen($temp_archivo2['path'], 'w');
      stream_copy_to_stream($fp_imagen2, $temp_imagen2);
      fclose($temp_imagen2);
      $tamanio_imagen2 = round(filesize($temp_archivo2['path']) / 1024);
      $datos['prevchica'] = "<img src = '{$temp_archivo2['url']}' alt=\"Imagen\" WIDTH=120 HEIGHT=100 >";
      $datos['logo_chico'] = 'Tamaño foto actual: '.$tamanio_imagen2.' KB';
    } else {
      $datos['logo_chico'] = null;
    }
    $form->set_datos($datos);
    }
  }

  function guardardesarrollador()
  {
    $this->dep('dr_desarrollador')->sincronizar();
    $this->dep('dr_desarrollador')->resetear();
  }

  function resetdesarrollador()
  {
    $this->dep('dr_desarrollador')->resetear();
  }

  function modifdesarrollador($datos)
  {
    $this->dep('dr_desarrollador')->tabla('dt_sgr')->set($datos);
    if (is_array($datos['logo_grande'])) {
      $temp_archivo1 = $datos['logo_grande']['tmp_name'];
      $fp = fopen($temp_archivo1, 'rb');
      $this->dep('dr_desarrollador')->tabla('dt_sgr')->set_blob('logo_grande', $fp);
    }
    if (is_array($datos['logo_chico'])) {
      $temp_archivo2 = $datos['logo_chico']['tmp_name'];
      $fp = fopen($temp_archivo2, 'rb');
      $this->dep('dr_desarrollador')->tabla('dt_sgr')->set_blob('logo_chico', $fp);
    }
  }

  function selecciondesarrollador($seleccion)
  {
    if($this->dep('dr_desarrollador')->cargar($seleccion)){
      $id_fila = $this->dep('dr_desarrollador')->tabla('dt_sgr')->get_id_fila_condicion($seleccion)[0];
      $this->dep('dr_desarrollador')->tabla('dt_sgr')->set_cursor($id_fila);
    }
  }

  function borrardesarrollador($seleccion)
  {
    $this->dep('dr_desarrollador')->tabla('dt_sgr')->cargar($seleccion);
    $id_fila = $this->dep('dr_desarrollador')->tabla('dt_sgr')->get_id_fila_condicion($seleccion)[0];
    $this->dep('dr_desarrollador')->tabla('dt_sgr')->set_cursor($id_fila);
    $this->dep('dr_desarrollador')->tabla('dt_sgr')->eliminar_fila($id_fila);
  }

  //-----------------------------------------------------------------------------------
  //---- ABM sgr_propietario ----------------------------------------------------------
  //-----------------------------------------------------------------------------------

  function get_servicios()
  {
    return $datos;
  }

  function cargarpropietario($form)
  {
    if ($this->dep('dr_propietario')->tabla('dt_propietario')->hay_cursor()) {
    $datos = $this->dep('dr_propietario')->tabla('dt_propietario')->get();

    $fp_imagen1 = $this->dep('dr_propietario')->tabla('dt_propietario')->get_blob('logo_grande');
    $fp_imagen2 = $this->dep('dr_propietario')->tabla('dt_propietario')->get_blob('logo_chico');

    if (isset($fp_imagen1)) {
      $temp_nombre1 = 'logo_grande' . $datos['id_propietario'];
      $temp_archivo1 = toba::proyecto()->get_www_temp($temp_nombre1);
      $temp_imagen1 = fopen($temp_archivo1['path'], 'w');
      stream_copy_to_stream($fp_imagen1, $temp_imagen1);
      fclose($temp_imagen1);
      $tamanio_imagen1 = round(filesize($temp_archivo1['path']) / 1024);
      $datos['prevgrande'] = "<img src = '{$temp_archivo1['url']}' alt=\"Imagen\" WIDTH=400 HEIGHT=150 >";
      $datos['logo_grande'] = 'Tamaño foto actual: '.$tamanio_imagen1.' KB';
    } else {
      $datos['logo_grande'] = null;
    }

    if (isset($fp_imagen2)) {
      $temp_nombre2 = 'logo_chico' . $datos['id_propietario'];
      $temp_archivo2 = toba::proyecto()->get_www_temp($temp_nombre2);
      $temp_imagen2 = fopen($temp_archivo2['path'], 'w');
      stream_copy_to_stream($fp_imagen2, $temp_imagen2);
      fclose($temp_imagen2);
      $tamanio_imagen2 = round(filesize($temp_archivo2['path']) / 1024);
      $datos['prevchica'] = "<img src = '{$temp_archivo2['url']}' alt=\"Imagen\" WIDTH=180 HEIGHT=150 >";
      $datos['logo_chico'] = 'Tamaño foto actual: '.$tamanio_imagen2.' KB';
    } else {
      $datos['logo_chico'] = null;
    }
    $form->set_datos($datos);
    }
  }

  function guardarpropietario()
  {
    $this->dep('dr_propietario')->sincronizar();
    $this->dep('dr_propietario')->resetear();
  }

  function resetpropietario()
  {
    $this->dep('dr_propietario')->resetear();
  }

  function modifpropietario($datos)
  {
    $this->dep('dr_propietario')->tabla('dt_propietario')->set($datos);
    if (is_array($datos['logo_grande'])) {
      $temp_archivo1 = $datos['logo_grande']['tmp_name'];
      $fp = fopen($temp_archivo1, 'rb');
      $this->dep('dr_propietario')->tabla('dt_propietario')->set_blob('logo_grande', $fp);
    }
    if (is_array($datos['logo_chico'])) {
      $temp_archivo2 = $datos['logo_chico']['tmp_name'];
      $fp = fopen($temp_archivo2, 'rb');
      $this->dep('dr_propietario')->tabla('dt_propietario')->set_blob('logo_chico', $fp);
    }
    /*Copia del logo para los reportes pdf generados desde toba*/
    if (isset($datos['logo_grande']))
        {
            $extension = pathinfo($datos['logo_grande']['name'], PATHINFO_EXTENSION);
            if (in_array($extension, sga_parametros::$extensionesPeligrosas)) {
                throw new toba_error_usuario('Error: Intentó cargar un archivo de extensión "'.$extension.'". Seleccione un archivo con formato de imagen (jpg,bmp,tif).');
            }
            $arc_logopdforig = toba::proyecto()->get_www_temp('../img/logo_pdf.jpg')['path'];
            // Stream hacia el archivo temporal
            $stream_logopdforig = fopen($arc_logopdforig, 'w');
        