<?php
class cn_registros_alta extends sgr_cn
{

  //-----------------------------------------------------------------------------------
  //---- ABM sgr_registros (form) -----------------------------------------------------
  //-----------------------------------------------------------------------------------
  //
  function guardarregistro()
  {
    $this->dep('dr_registro')->sincronizar();
    //$this->dep('dr_registro')->resetear(); comentado 20171206
  }

  function resetregistro()
  {
    $this->dep('dr_registro')->resetear();
  }

  function set_datos_dtregistro($datos)
  {
    //$datos['get_usuario'] = toba::usuario()->get_id(); // 20171220
    $this->dep('dr_registro')->tabla('dt_registro')->set($datos);
  }

  function get_registro()
  {
    if ($this->dep('dr_registro')->tabla('dt_registro')->hay_cursor())
    {
      return $this->dep('dr_registro')->tabla('dt_registro')->get();
    }
  }

  function set_dt_registro($datos)
  {
    $this->dep('dr_registro')->tabla('dt_registro')->set($datos);
  }

  function get_estado_actual()
  {
    if ($this->dep('dr_registro')->tabla('dt_estado_actual_flujo')->hay_cursor())
    {
      return $this->dep('dr_registro')->tabla('dt_estado_actual_flujo')->get();
    }
  }

  /**
  * Asocia los $datos blob al dt.
  *
  * @param string $nombre_dr Nombre del datos relación a usar, si no se
  * determina, se usará $this->nombre_dr_defecto
  * @param string $nombre_dt Nombre del datos tabla del cual obtener los datos.
  * Si se omite, se usará this->nombres_dt_defecto[0].
  * @param array $datos Array asociativo tipo ['nombre_columna' => valor_fila, ].
  * Determina los datos de la tabla a sociar para, más adelante, registrar los
  * datos en la base de datos.
  * @param string $nombre_campo Determina el nombre del campo blob.
  * @param bool $es_ml Determina si el dt se asocia a un $datos proviniente de
  * un frm_ml. True = proviene de un ml.
  */

  public function set_blob_dt($nombre_dr, $nombre_dt, $datos, $nombre_campo, $es_ml = false)
  {
      $nom_dr = (isset($nombre_dr) ? $nombre_dr : $this->nombre_dr_defecto);
      $dr = $this->dep($nom_dr);
      $nom_dt = (isset($nombre_dt) ? $nombre_dt : $this->nombres_dt_defecto[0]);
      $dt = $dr->tabla($nom_dt);

      // Si es ml, procesamos las filas
      if ($es_ml) {
          foreach ($datos as $key => $value) {
              $this->set_blob($dt, $nombre_campo, $datos[$key], $key);
          }
      } else { // Si no es ml
          $this->set_blob($dt, $nombre_campo, $datos, null);
      }
  }

  /**
  * Asocia los $datos blob al dt.
  *
  * @param toba_datos_tabla $dt Datos tabla instanciado.
  * @param string $nombre_campo Determina el nombre del campo blob.
  * @param array $datos Array asociativo tipo ['nombre_columna' => valor_fila, ].
  * Determina los datos de la tabla a sociar para, más adelante, registrar los
  * datos en la base de datos.
  * @param array $id_fila Array asociativo tipo ['nombre_columna' => valor_fila, ].
  * Determina el id explícito de la fila a usar.
  */

  public function set_blob($dt, $nombre_campo, $datos, $id_fila = null)
  {
      if (is_array($datos[$nombre_campo])) {
          $s__temp_archivo = $datos[$nombre_campo]['tmp_name'];
          $imagen = fopen($s__temp_archivo, 'rb');

          $dt->set_blob($nombre_campo, $imagen, $id_fila);
      }
  }

  /**
  * Obtiene los $datos blob del dt $nombre_dt.
  *
  * @param string $nombre_dr nombre del datos relación a usar, si no se
  * determina, se usará $this->nombre_dr_defecto
  * @param string $nombre_dt nombre del datos tabla del cual obtener los datos.
  * Si se omite, se usará this->nombres_dt_defecto[0].
  * @param array $datos Array asociativo tipo ['nombre_columna' => valor_fila, ].
  * Determina los datos de la tabla a sociar para, más adelante, registrar los
  * datos en la base de datos.
  * @param string $nombre_campo Determina el nombre del campo blob.
  * @param bool $es_ml Determina si el dt se asocia a un $datos proviniente de
  * un frm_ml. True = proviene de un ml.
  */
  public function get_blobs($nombre_dr, $nombre_dt, $datos, $nombre_campo)
  {
      $datos_r = array();
      foreach ($datos as $key => $value) {
          $datos_r[$key] = $this->get_blob($nombre_dr, $nombre_dt, $datos[$key], $nombre_campo, $key);
      }

      return $datos_r;
  }

  public function get_blob($nombre_dr, $nombre_dt, $datos, $nombre_campo, $id_fila)
  	{
  		$nombre_dr = (isset($nombre_dr) ? $nombre_dr : $this->nombre_dr_defecto);
  		$dr = $this->dep($nombre_dr);
  		$nombre_dt = (isset($nombre_dt) ? $nombre_dt : $this->nombres_dt_defecto[0]);
  		$dt = $dr->tabla($nombre_dt);

  		if (!isset($this->s__datos['cache_imagenes'])) {
  			$this->s__datos['cache_imagenes'] = [];
  		}
  		$cacheImagenes = $this->s__datos['cache_imagenes'];

  		if (isset($cacheImagenes[$nombre_dr][$nombre_dt][$nombre_campo][$id_fila][$nombre_campo.'?html'])) {
  			$fila = $cacheImagenes[$nombre_dr][$nombre_dt][$nombre_campo][$id_fila];
  			$datos = array_merge($datos, $fila);
  		} else {
  			$html_imagen = null;
  			$imagen = $dt->get_blob($nombre_campo, $id_fila);
  			if (isset($imagen)) {
  				$temp_nombre = md5(uniqid(time()));
  				$s__temp_archivo = toba::proyecto()->get_www_temp($temp_nombre);
  				$html_imagen = "<img width=\"24px\" src='{$s__temp_archivo['url']}' alt='' />";
  				$temp_imagen = fopen($s__temp_archivo['path'], 'w');
  				stream_copy_to_stream($imagen, $temp_imagen);
  				fclose($temp_imagen);
  				fclose($imagen);
  				$tamano = round(filesize($s__temp_archivo['path']) / 1024);
  				$fila[$nombre_campo] = '<a href="'.$s__temp_archivo['url'].'" target="_newtab">'.$html_imagen.' Tamaño archivo actual: '.$tamano.' kb</a>';
  				$fila[$nombre_campo.'?html'] = $html_imagen;
  				$fila[$nombre_campo.'?url'] = $s__temp_archivo['url'];
  			} else {
  				$fila[$nombre_campo] = null;
  			}
  			$datos = array_merge($datos, $fila);
  			$this->s__datos['cache_imagenes'][$nombre_dr][$nombre_dt][$nombre_campo][$id_fila] = $fila;
  		}

  		return $datos;
  	}

  //-----------------------------------------------------------------------------------
  //---- ABM sgr_form_estado_actual ---------------------------------------------------
  //-----------------------------------------------------------------------------------

  function cargarestadoactual($form)
  {
    $sql = "SELECT id_estado, nombre, 'Si' activo
    FROM sgr.estado
    WHERE inicio = true";
    $datos = consultar_fuente($sql);
    $form->set_datos($datos);
  }

  //-----------------------------------------------------------------------------------
  //---- ABM sgr_form_workflow --------------------------------------------------------
  //-----------------------------------------------------------------------------------

  function modifestado($datos)
  {
    $datos['get_usuario'] = toba::usuario()->get_id(); // 20171220
    $this->dep('dr_registro')->tabla('dt_estado_actual_flujo')->set($datos);
  }

  //-----------------------------------------------------------------------------------
  //---- ABM sgr_requisitos_registro --------------------------------------------------
  //-----------------------------------------------------------------------------------

  function procesarrequisitos_registro($datos, $cache_ml)
  {
    foreach ($datos as $key => $value) {
      foreach ($cache_ml as $key2 => $value2) {
        if ($value['nro_requisito'] == $value2['nro_requisito']) {
          $datos[$key]['id_requisitos'] = $value2['id_requisitos'];
          $datos[$key]['id_estadoorigen'] = $value2['id_estadoorigen'];
          $datos[$key]['id_estadodestino'] = $value2['id_estadodestino'];
          $datos[$key]['id_workflow'] = $value2['id_workflow'];
        }
      }
    }
    $this->dep('dr_registro')->tabla('dt_requisitos_registro')->procesar_filas($datos);
  }

  function imprimirEstado()
  {
    ei_arbol(array('datos del CN:'
      => ['dt_registro'             => $this->dep('dr_registro')->tabla('dt_registro')->get()
         ,'dt_reqisitos_registro'   => $this->dep('dr_registro')->tabla('dt_requisitos_registro')->get_filas()
         ,'dt_estado_actual_flujo'  => $this->dep('dr_registro')->tabla('dt_estado_actual_flujo')->get_filas()]));
  }
}

?>
