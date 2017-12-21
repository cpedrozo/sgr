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

  function modifregistro($datos)
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

}

?>
