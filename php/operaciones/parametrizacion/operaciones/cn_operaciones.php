<?php

class cn_operaciones extends sgr_cn
{
  //-----------------------------------------------------------------------------------
  //---- ABM sgr_eventos --------------------------------------------------------------
  //-----------------------------------------------------------------------------------

  function cargareventos($form)
  {
    if ($this->dep('dr_eventos')->tabla('dt_eventos')->hay_cursor()) {
    $datos = $this->dep('dr_eventos')->tabla('dt_eventos')->get();
    $form->set_datos($datos);
    }
  }

  function guardareventos()
  {
    $this->dep('dr_eventos')->sincronizar();
    $this->dep('dr_eventos')->resetear();
  }

  function reseteventos()
  {
    $this->dep('dr_eventos')->resetear();
  }

  function modifeventos($datos)
  {
    $this->dep('dr_eventos')->tabla('dt_eventos')->set($datos);
  }

  function seleccioneventos($seleccion)
  {
    if($this->dep('dr_eventos')->cargar($seleccion)){
      $id_fila = $this->dep('dr_eventos')->tabla('dt_eventos')->get_id_fila_condicion($seleccion)[0];
      $this->dep('dr_eventos')->tabla('dt_eventos')->set_cursor($id_fila);
    }
  }

  function borrareventos($seleccion)
  {
    $this->dep('dr_eventos')->tabla('dt_eventos')->cargar($seleccion);
    $id_fila = $this->dep('dr_eventos')->tabla('dt_eventos')->get_id_fila_condicion($seleccion)[0];
    $this->dep('dr_eventos')->tabla('dt_eventos')->set_cursor($id_fila);
    $this->dep('dr_eventos')->tabla('dt_eventos')->eliminar_fila($id_fila);
  }

  //-----------------------------------------------------------------------------------
  //---- ABM sgr_estados --------------------------------------------------------------
  //-----------------------------------------------------------------------------------

  function cargarestados($form)
  {
    if ($this->dep('dr_estados')->tabla('dt_estados')->hay_cursor()) {
    $datos = $this->dep('dr_estados')->tabla('dt_estados')->get();
    $form->set_datos($datos);
    }
  }

  function guardarestados()
  {
    $this->dep('dr_estados')->sincronizar();
    $this->dep('dr_estados')->resetear();
  }

  function resetestados()
  {
    $this->dep('dr_estados')->resetear();
  }

  function modifestados($datos)
  {
    $this->dep('dr_estados')->tabla('dt_estados')->set($datos);
  }

  function seleccionestados($seleccion)
  {
    if($this->dep('dr_estados')->cargar($seleccion)){
      $id_fila = $this->dep('dr_estados')->tabla('dt_estados')->get_id_fila_condicion($seleccion)[0];
      $this->dep('dr_estados')->tabla('dt_estados')->set_cursor($id_fila);
    }
  }

  function borrarestados($seleccion)
  {
    $this->dep('dr_estados')->tabla('dt_estados')->cargar($seleccion);
    $id_fila = $this->dep('dr_estados')->tabla('dt_estados')->get_id_fila_condicion($seleccion)[0];
    $this->dep('dr_estados')->tabla('dt_estados')->set_cursor($id_fila);
    $this->dep('dr_estados')->tabla('dt_estados')->eliminar_fila($id_fila);
  }

  //-----------------------------------------------------------------------------------
  //---- ABM sgr_flujos --------------------------------------------------------------
  //-----------------------------------------------------------------------------------

  function cargarflujos($form)
  {
    if ($this->dep('dr_flujos')->tabla('dt_flujos')->hay_cursor()) {
    $datos = $this->dep('dr_flujos')->tabla('dt_flujos')->get();
    $form->set_datos($datos);
    }
  }

  function guardarflujos()
  {
    $this->dep('dr_flujos')->sincronizar();
    $this->dep('dr_flujos')->resetear();
  }

  function resetflujos()
  {
    $this->dep('dr_flujos')->resetear();
  }

  function modifflujos($datos)
  {
    $this->dep('dr_flujos')->tabla('dt_flujos')->set($datos);
  }

  function seleccionflujos($seleccion)
  {
    if($this->dep('dr_flujos')->cargar($seleccion)){
      $id_fila = $this->dep('dr_flujos')->tabla('dt_flujos')->get_id_fila_condicion($seleccion)[0];
      $this->dep('dr_flujos')->tabla('dt_flujos')->set_cursor($id_fila);
    }
  }

  function borrarflujos($seleccion)
  {
    $this->dep('dr_flujos')->tabla('dt_flujos')->cargar($seleccion);
    $id_fila = $this->dep('dr_flujos')->tabla('dt_flujos')->get_id_fila_condicion($seleccion)[0];
    $this->dep('dr_flujos')->tabla('dt_flujos')->set_cursor($id_fila);
    $this->dep('dr_flujos')->tabla('dt_flujos')->eliminar_fila($id_fila);
  }

  //-----------------------------------------------------------------------------------
  //---- ABM sgr_requisitos -----------------------------------------------------------
  //-----------------------------------------------------------------------------------

  function cargarrequisitos($form)
  {
    if ($this->dep('dr_requisitos')->tabla('dt_requisitos')->hay_cursor()) {
    $datos = $this->dep('dr_requisitos')->tabla('dt_requisitos')->get();
    $form->set_datos($datos);
    }
  }

  function guardarrequisitos()
  {
    $this->dep('dr_requisitos')->sincronizar();
    $this->dep('dr_requisitos')->resetear();
  }

  function resetrequisitos()
  {
    $this->dep('dr_requisitos')->resetear();
  }

  function modifrequisitos($datos)
  {
    $this->dep('dr_requisitos')->tabla('dt_requisitos')->set($datos);
  }

  function seleccionrequisitos($seleccion)
  {
    if($this->dep('dr_requisitos')->cargar($seleccion)){
      $id_fila = $this->dep('dr_requisitos')->tabla('dt_requisitos')->get_id_fila_condicion($seleccion)[0];
      $this->dep('dr_requisitos')->tabla('dt_requisitos')->set_cursor($id_fila);
    }
  }

  function borrarrequisitos($seleccion)
  {
    $this->dep('dr_requisitos')->tabla('dt_requisitos')->cargar($seleccion);
    $id_fila = $this->dep('dr_requisitos')->tabla('dt_requisitos')->get_id_fila_condicion($seleccion)[0];
    $this->dep('dr_requisitos')->tabla('dt_requisitos')->set_cursor($id_fila);
    $this->dep('dr_requisitos')->tabla('dt_requisitos')->eliminar_fila($id_fila);
  }



}

?>
