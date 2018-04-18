<?php
class cn_registros_bm extends sgr_cn
{

  //-----------------------------------------------------------------------------------
  //---- ABM sgr_registros ------------------------------------------------------------
  //-----------------------------------------------------------------------------------

  function cargar_dr_registro($seleccion=null)
  {
    if (!$this->dep('dr_registro')->esta_cargada()) {
      if (isset($seleccion)) {
        $this->dep('dr_registro')->cargar($seleccion);
      } else {
        $this->dep('dr_registro')->cargar($seleccion);
      }
    }
  }

  function borrar_dt_registro($seleccion)
  {
    if ($this->dep('dr_registro')->tabla('dt_registro')->esta_cargada()) {
      $id_memoria = $this->dep('dr_registro')->tabla('dt_registro')->get_id_fila_condicion($seleccion);
      $this->dep('dr_registro')->tabla('dt_registro')->eliminar_fila($id_memoria[0]);
    }
  }

  function get_registro()
  {
    if ($this->dep('dr_registro')->tabla('dt_registro')->hay_cursor())
    {
      return $this->dep('dr_registro')->tabla('dt_registro')->get();
    }
  }

  function set_cursorregistro($seleccion)
  {
    $id = $this->dep('dr_registro')->tabla('dt_registro')->get_id_fila_condicion($seleccion);
    $this->dep('dr_registro')->tabla('dt_registro')->set_cursor($id[0]);
  }

  function guardar_dr_registro()
  {
    $this->dep('dr_registro')->sincronizar();
    $this->resetear_dr_registro();
  }

  function resetear_dr_registro()
  {
    unset($this->s__indices_estado_actual_flujo);
    $this->dep('dr_registro')->resetear();
  }

  function cargarregistro($form)
  {
    $dt = $this->dep('dr_registro')->tabla('dt_registro');
    if ($dt->hay_cursor()) {
      $datos = $dt->get();
      $form->set_datos($datos);
    }
  }

  function set_dt_registro($datos)
  {
    $this->dep('dr_registro')->tabla('dt_registro')->set($datos);
  }

  function set_datos_dtregistro($datos)
  {
    $this->dep('dr_registro')->tabla('dt_registro')->set($datos);
  }

  function seleccionregistro($seleccion)
  {
    $dt = $this->dep('dr_registro')->tabla('dt_registro');
    if ($dt->cargar($seleccion)) {
      $id_fila = $dt->get_id_fila_condicion($seleccion)[0];
      $dt->set_cursor($id_fila);
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


  function get_estadoactual()
  {
    if ($this->dep('dr_registro')->tabla('dt_estado_actual_flujo')->hay_cursor())
    {
      return $this->dep('dr_registro')->tabla('dt_estado_actual_flujo')->get();
    }
  }

  function get_estadoactual_activo()
  {
    $dt_registro = $this->dep('dr_registro')->tabla('dt_registro');
    $dt_estado_actual_flujo = $this->dep('dr_registro')->tabla('dt_estado_actual_flujo');

    if ($dt_registro->hay_cursor()) {
      if (!isset($this->s__indices_estado_actual_flujo['viejo'])) {
        if (!$dt_estado_actual_flujo->hay_cursor()) {
          $dt_estado_actual_flujo->cargar();
          $id_fila = $dt_estado_actual_flujo->get_id_fila_condicion(['activo'=>true])[0];
          $this->s__indices_estado_actual_flujo['viejo'] = $id_fila;
          $dt_estado_actual_flujo->set_cursor($id_fila);
        }
      } else {
        $dt_estado_actual_flujo->set_cursor($this->s__indices_estado_actual_flujo['viejo']);
      }
      $datos = $dt_estado_actual_flujo->get();
      if (isset($datos['activo'])) {
        $datos['activo']=$datos['activo']?'Si':'No';
      } else {
        $datos['activo']=null;
      }
      $ea = [];
      if (isset($datos['nombre'])) {
        $ea[]=[['id_estado'=>$datos['id_estado'],'nombre'=>$datos['nombre']]];
      } else {
        $ea[]=[['id_estado'=>$datos['id_estado'],'nombre'=>null]];
      }
      $ea[]=$datos;
      return $ea;
    } else {
      return [];
    }
  }

  function cargarestadoactual($form)
  {
    $ea = $this->get_estadoactual_activo();
    $form->set_datos($ea[1]);
    return $ea[0];
  }

  function modifestadoactual($datos)
  {
    if (isset($datos['activo'])) {
      if ($datos['activo'] == 'Si') {
        $datos['activo'] = true;
      } else {
        $datos['activo'] = false;
      }
    }
    $this->dep('dr_registro')->tabla('dt_estado_actual_flujo')->set($datos);
  }

  //-----------------------------------------------------------------------------------
  //---- ABM sgr_form_workflow --------------------------------------------------------
  //-----------------------------------------------------------------------------------

  function cargarestado($form)
  {
    if ($this->dep('dr_registro')->tabla('dt_estado_actual_flujo')->hay_cursor()) {
      $datos = $this->dep('dr_registro')->tabla('dt_estado_actual_flujo')->get();
      $datos2 = $this->get_estadoactual_activo()[1];
      $datos['observacion'] = $datos2['observacion'];
      $datos['id_persona'] = $datos2['id_persona'];
      $form->set_datos($datos);
    }
  }

  protected $s__indices_estado_actual_flujo = [];

  function desactivarEstadoActual()
  {
    $dt_estado_actual_flujo = $this->dep('dr_registro')->tabla('dt_estado_actual_flujo');

    if (isset($this->s__indices_estado_actual_flujo['viejo'])) {
      $dt_estado_actual_flujo->set_cursor($this->s__indices_estado_actual_flujo['viejo']);
    }

    $datos_viejo = $this->get_estadoactual();
    $this->s__indices_estado_actual_flujo['viejo'] = $dt_estado_actual_flujo->get_cursor();
    $xxx = $this->s__indices_estado_actual_flujo['viejo'];

    $datos_viejo['activo'] = false;

    $dt_estado_actual_flujo->set($datos_viejo);
  }

  function set_nuevoEstado($datos)
  {
    $dt_estado_actual_flujo = $this->dep('dr_registro')->tabla('dt_estado_actual_flujo');
    $datos['get_usuario'] = toba::usuario()->get_id(); // 20171220

    if (isset($this->s__indices_estado_actual_flujo['nuevo'])) {
      $dt_estado_actual_flujo->set_cursor($this->s__indices_estado_actual_flujo['nuevo']);
      $id_fila = $dt_estado_actual_flujo->set([$datos]);
    } else {
      $id_fila = $dt_estado_actual_flujo->anexar_datos([$datos]);
      $dt_estado_actual_flujo->forzar_insercion(false, $id_fila);
      $dt_estado_actual_flujo->set_cursor($id_fila[0]);
      $this->s__indices_estado_actual_flujo['nuevo'] = $id_fila[0];
      $xxx = $this->s__indices_estado_actual_flujo['nuevo'];
    }
  }

  function modifestado($datos)
  {
    $this->desactivarEstadoActual();
    $this->set_NuevoEstado($datos);
  }

  //-----------------------------------------------------------------------------------
  //---- ABM sgr_requisitos_registro --------------------------------------------------
  //-----------------------------------------------------------------------------------

  function getrequisitos_registro()
  {
    if (!$this->dep('dr_registro')->tabla('dt_requisitos_registro')->esta_cargada()) {
    $this->dep('dr_registro')->tabla('dt_requisitos_registro')->cargar();
    }
    $datos = $this->dep('dr_registro')->tabla('dt_requisitos_registro')->get_filas();
    foreach ($datos as $key => $value) {
      $datos[$key]['nro_requisito'] = $key + 1;
    }
    return $datos;
  }

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
    $this->dep('dr_registro')->tabla('dt_requisitos_registro')->resetear();
    $this->dep('dr_registro')->tabla('dt_requisitos_registro')->procesar_filas($datos);
  }

  function imprimirDatosARegistrar()
  {
    $dt_registro = $this->dep('dr_registro')->tabla('dt_registro');
    $dt_estado_actual_flujo = $this->dep('dr_registro')->tabla('dt_estado_actual_flujo');
    $dt_requisitos_registro = $this->dep('dr_registro')->tabla('dt_requisitos_registro');
    toba::logger()->error("fake error xxx");
    toba::logger()->var_dump(array('datos a imprimirDatosARegistrar:' => [
      'dt_registro-get' => $dt_registro->get(),
      'dt_estado_actual_flujo-get' => $dt_estado_actual_flujo->get(),
      'dt_estado_actual_flujo-getFilas' => $dt_estado_actual_flujo->get_filas(),
      '$dt_requisitos_registro-getFilas' => $dt_requisitos_registro->get_filas(),
      ]));
  }
}

?>
