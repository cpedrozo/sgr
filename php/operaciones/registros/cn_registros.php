<?php
class cn_registros extends sgr_cn
{

  //-----------------------------------------------------------------------------------
  //---- ABM sgr_registros ------------------------------------------------------------
  //-----------------------------------------------------------------------------------

  function cargarregistro($form)
  {
    if ($this->dep('dr_registro')->tabla('dt_registro')->hay_cursor()) {
      $datos = $this->dep('dr_registro')->tabla('dt_registro')->get();
      $form->set_datos($datos);
      //return $form;
    }
  }

  function guardarregistro()
  {
    $this->dep('dr_registro')->sincronizar();
    $this->dep('dr_registro')->resetear();
  }

  function resetregistro()
  {
    $this->dep('dr_registro')->resetear();
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

  function borraregistro($seleccion)
  {
    $this->dep('dr_registro')->tabla('dt_registro')->cargar($seleccion);
    $id_fila = $this->dep('dr_registro')->tabla('dt_registro')->get_id_fila_condicion($seleccion)[0];
    $this->dep('dr_registro')->tabla('dt_registro')->set_cursor($id_fila);
    $this->dep('dr_registro')->tabla('dt_registro')->eliminar_fila($id_fila);
  }

}

?>
