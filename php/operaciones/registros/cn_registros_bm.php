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
    $this->dep('dr_registro')->resetear();
  }

  function resetear_dr_registro()
  {
    $this->dep('dr_registro')->resetear();
  }

  function cargarregistro($form)
  {
    if ($this->dep('dr_registro')->tabla('dt_registro')->hay_cursor()) {
      $datos = $this->dep('dr_registro')->tabla('dt_registro')->get();
      $form->set_datos($datos);
    }
  }

  function set_dt_registro($datos)
  {
    $this->dep('dr_registro')->tabla('dt_registro')->set($datos);
  }

  function modifregistro($datos)
  {
    $this->dep('dr_registro')->tabla('dt_registro')->set($datos);
  }

  function seleccionregistro($seleccion)
  {
    if($this->dep('dr_registro')->tabla('dt_registro')->cargar($seleccion)){
      $id_fila = $this->dep('dr_registro')->tabla('dt_registro')->get_id_fila_condicion($seleccion)[0];
      $this->dep('dr_registro')->tabla('dt_registro')->set_cursor($id_fila);
    }
  }

  //-----------------------------------------------------------------------------------
  //---- ABM sgr_form_estado_actual ---------------------------------------------------
  //-----------------------------------------------------------------------------------

  function cargarestadoactual($form)
  {
    if ($this->dep('dr_registro')->tabla('dt_registro')->hay_cursor()) {
      if (!$this->dep('dr_registro')->tabla('dt_estado_actual_flujo')->hay_cursor()) {
        $this->dep('dr_registro')->tabla('dt_estado_actual_flujo')->cargar();
        $id_fila = $this->dep('dr_registro')->tabla('dt_estado_actual_flujo')->get_id_fila_condicion(['activo'=>true])[0];
        $this->dep('dr_registro')->tabla('dt_estado_actual_flujo')->set_cursor($id_fila);
      }
      $datos = $this->dep('dr_registro')->tabla('dt_estado_actual_flujo')->get();
      $datos['activo']=$datos['activo']?'Si':'No';
      $ea = [];
      $ea[]=['id_estado'=>$datos['id_estado'],'nombre'=>$datos['nombre']];
      $form->set_datos($datos);
      return $ea;
    } else {
      return [];
    }
  }

  function modifestadoactual($datos)
  {
    $this->dep('dr_registro')->tabla('dt_estado_actual_flujo')->set($datos);
  }

  //-----------------------------------------------------------------------------------
  //---- ABM sgr_form_workflow --------------------------------------------------------
  //-----------------------------------------------------------------------------------

  function cargarestado($form)
  {
    if ($this->dep('dr_registro')->tabla('dt_estado_actual_flujo')->hay_cursor()) {
      $datos = $this->dep('dr_registro')->tabla('dt_estado_actual_flujo')->get();
      $form->set_datos($datos);
    }
  }

  function modifestado($datos)
  {
    $this->dep('dr_registro')->tabla('dt_estado_actual_flujo')->set($datos);
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

  function procesarrequisitos_registro($datos)
  {
    $this->dep('dr_registro')->tabla('dt_requisitos_registro')->procesar_filas($datos);
  }

}

?>
