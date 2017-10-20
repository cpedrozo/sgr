<?php

class cn_parametrizacion extends sgr_cn
{
  //-----------------------------------------------------------------------------------
  //---- ABM sgr_propietario ----------------------------------------------------------
  //-----------------------------------------------------------------------------------

  function cargarpropietario($form)
  {
    if ($this->dep('dr_propietario')->tabla('dt_propietario')->hay_cursor()) {
    $datos = $this->dep('dr_propietario')->tabla('dt_propietario')->get();
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
  }

  function seleccionpropietario($seleccion)
  {
    if($this->dep('dr_propietario')->cargar($seleccion)){
      $id_fila = $this->dep('dr_propietario')->tabla('dt_propietario')->get_id_fila_condicion($seleccion)[0];
      $this->dep('dr_propietario')->tabla('dt_propietario')->set_cursor($id_fila);
    }
  }

  function borrarpropietario($seleccion)
  {
    $this->dep('dr_propietario')->tabla('dt_propietario')->cargar($seleccion);
    $id_fila = $this->dep('dr_propietario')->tabla('dt_propietario')->get_id_fila_condicion($seleccion)[0];
    $this->dep('dr_propietario')->tabla('dt_propietario')->set_cursor($id_fila);
    $this->dep('dr_propietario')->tabla('dt_propietario')->eliminar_fila($id_fila);
  }


  //-----------------------------------------------------------------------------------
  //---- ABM sgr_companiastelefonicas -------------------------------------------------
  //-----------------------------------------------------------------------------------

  function cargarcompania($form)
  {
    if ($this->dep('dr_companias_telefonicas')->tabla('dt_compania')->hay_cursor()) {
    $datos = $this->dep('dr_companias_telefonicas')->tabla('dt_compania')->get();
    $form->set_datos($datos);
    }
  }

  function guardarcompania()
  {
    $this->dep('dr_companias_telefonicas')->sincronizar();
    $this->dep('dr_companias_telefonicas')->resetear();
  }

  function resetcompania()
  {
    $this->dep('dr_companias_telefonicas')->resetear();
  }

  function modifcompania($datos)
  {
    $this->dep('dr_companias_telefonicas')->tabla('dt_compania')->set($datos);
  }

  function seleccioncompania($seleccion)
  {
    if($this->dep('dr_companias_telefonicas')->tabla('dt_compania')->cargar($seleccion)){
      $id_fila = $this->dep('dr_companias_telefonicas')->tabla('dt_compania')->get_id_fila_condicion($seleccion)[0];
      $this->dep('dr_companias_telefonicas')->tabla('dt_compania')->set_cursor($id_fila);
    }
  }

  function borrarcompania($seleccion)
  {
    $this->dep('dr_companias_telefonicas')->tabla('dt_compania')->cargar($seleccion);
    $id_fila = $this->dep('dr_companias_telefonicas')->tabla('dt_compania')->get_id_fila_condicion($seleccion)[0];
    $this->dep('dr_companias_telefonicas')->tabla('dt_compania')->set_cursor($id_fila);
    $this->dep('dr_companias_telefonicas')->tabla('dt_compania')->eliminar_fila($id_fila);
  }

  //-----------------------------------------------------------------------------------
  //---- ABM sgr_tipocorreo -----------------------------------------------------------
  //-----------------------------------------------------------------------------------

  function cargartipocorreo($form)
  {
    if ($this->dep('dr_tipos_de_correo')->tabla('dt_tipocorreo')->hay_cursor()) {
      $datos = $this->dep('dr_tipos_de_correo')->tabla('dt_tipocorreo')->get();
      $form->set_datos($datos);
    }
  }

  function guardartipocorreo()
  {
    $this->dep('dr_tipos_de_correo')->sincronizar();
    $this->dep('dr_tipos_de_correo')->resetear();
  }

  function resettipocorreo()
  {
    $this->dep('dr_tipos_de_correo')->resetear();
  }

  function modiftipocorreo($datos)
  {
    $this->dep('dr_tipos_de_correo')->tabla('dt_tipocorreo')->set($datos);
  }

  function selecciontipocorreo($seleccion)
  {
    if($this->dep('dr_tipos_de_correo')->tabla('dt_tipocorreo')->cargar($seleccion)){
      $id_fila = $this->dep('dr_tipos_de_correo')->tabla('dt_tipocorreo')->get_id_fila_condicion($seleccion)[0];
      $this->dep('dr_tipos_de_correo')->tabla('dt_tipocorreo')->set_cursor($id_fila);
    }
  }

  function borrartipocorreo($seleccion)
  {
    $this->dep('dr_tipos_de_correo')->tabla('dt_tipocorreo')->cargar($seleccion);
    $id_fila = $this->dep('dr_tipos_de_correo')->tabla('dt_tipocorreo')->get_id_fila_condicion($seleccion)[0];
    $this->dep('dr_tipos_de_correo')->tabla('dt_tipocorreo')->set_cursor($id_fila);
    $this->dep('dr_tipos_de_correo')->tabla('dt_tipocorreo')->eliminar_fila($id_fila);
  }

  //-----------------------------------------------------------------------------------
  //---- ABM sgr_tipotel -----------------------------------------------------------
  //-----------------------------------------------------------------------------------

  function cargartipotel($form)
  {
    if ($this->dep('dr_tipos_de_telefono')->tabla('dt_tipotel')->hay_cursor()) {
      $datos = $this->dep('dr_tipos_de_telefono')->tabla('dt_tipotel')->get();
      $form->set_datos($datos);
    }
  }

  function guardartipotel()
  {
    $this->dep('dr_tipos_de_telefono')->sincronizar();
    $this->dep('dr_tipos_de_telefono')->resetear();
  }

  function resettipotel()
  {
    $this->dep('dr_tipos_de_telefono')->resetear();
  }

  function modiftipotel($datos)
  {
    $this->dep('dr_tipos_de_telefono')->tabla('dt_tipotel')->set($datos);
  }

  function selecciontipotel($seleccion)
  {
    if($this->dep('dr_tipos_de_telefono')->tabla('dt_tipotel')->cargar($seleccion)){
      $id_fila = $this->dep('dr_tipos_de_telefono')->tabla('dt_tipotel')->get_id_fila_condicion($seleccion)[0];
      $this->dep('dr_tipos_de_telefono')->tabla('dt_tipotel')->set_cursor($id_fila);
    }
  }

  function borrartipotel($seleccion)
  {
    $this->dep('dr_tipos_de_telefono')->tabla('dt_tipotel')->cargar($seleccion);
    $id_fila = $this->dep('dr_tipos_de_telefono')->tabla('dt_tipotel')->get_id_fila_condicion($seleccion)[0];
    $this->dep('dr_tipos_de_telefono')->tabla('dt_tipotel')->set_cursor($id_fila);
    $this->dep('dr_tipos_de_telefono')->tabla('dt_tipotel')->eliminar_fila($id_fila);
  }


  //-----------------------------------------------------------------------------------
  //---- ABM sgr_estadocivil -----------------------------------------------------------
  //-----------------------------------------------------------------------------------

  function cargarestadocivil($form)
  {
    if ($this->dep('dr_estado_civil')->tabla('dt_estadocivil')->hay_cursor()) {
      $datos = $this->dep('dr_estado_civil')->tabla('dt_estadocivil')->get();
      $form->set_datos($datos);
    }
  }

  function guardarestadocivil()
  {
    $this->dep('dr_estado_civil')->sincronizar();
    $this->dep('dr_estado_civil')->resetear();
  }

  function resetestadocivil()
  {
    $this->dep('dr_estado_civil')->resetear();
  }

  function modifestadocivil($datos)
  {
    $this->dep('dr_estado_civil')->tabla('dt_estadocivil')->set($datos);
  }

  function seleccionestadocivil($seleccion)
  {
    if($this->dep('dr_estado_civil')->tabla('dt_estadocivil')->cargar($seleccion)){
      $id_fila = $this->dep('dr_estado_civil')->tabla('dt_estadocivil')->get_id_fila_condicion($seleccion)[0];
      $this->dep('dr_estado_civil')->tabla('dt_estadocivil')->set_cursor($id_fila);
    }
  }

  function borrarestadocivil($seleccion)
  {
    $this->dep('dr_estado_civil')->tabla('dt_estadocivil')->cargar($seleccion);
    $id_fila = $this->dep('dr_estado_civil')->tabla('dt_estadocivil')->get_id_fila_condicion($seleccion)[0];
    $this->dep('dr_estado_civil')->tabla('dt_estadocivil')->set_cursor($id_fila);
    $this->dep('dr_estado_civil')->tabla('dt_estadocivil')->eliminar_fila($id_fila);
  }

  //-----------------------------------------------------------------------------------
  //---- ABM sgr_nacionalidad----------------------------------------------------------
  //-----------------------------------------------------------------------------------

  function cargarnacionalidad($form)
  {
    if ($this->dep('dr_nacionalidad')->tabla('dt_nacionalidad')->hay_cursor()) {
      $datos = $this->dep('dr_nacionalidad')->tabla('dt_nacionalidad')->get();
      $form->set_datos($datos);
    }
  }

  function guardarnacionalidad()
  {
    $this->dep('dr_nacionalidad')->sincronizar();
    $this->dep('dr_nacionalidad')->resetear();
  }

  function resetnacionalidad()
  {
    $this->dep('dr_nacionalidad')->resetear();
  }

  function modifnacionalidad($datos)
  {
    $this->dep('dr_nacionalidad')->tabla('dt_nacionalidad')->set($datos);
  }

  function seleccionnacionalidad($seleccion)
  {
    if($this->dep('dr_nacionalidad')->tabla('dt_nacionalidad')->cargar($seleccion)){
      $id_fila = $this->dep('dr_nacionalidad')->tabla('dt_nacionalidad')->get_id_fila_condicion($seleccion)[0];
      $this->dep('dr_nacionalidad')->tabla('dt_nacionalidad')->set_cursor($id_fila);
    }
  }

  function borrarnacionalidad($seleccion)
  {
    $this->dep('dr_nacionalidad')->tabla('dt_nacionalidad')->cargar($seleccion);
    $id_fila = $this->dep('dr_nacionalidad')->tabla('dt_nacionalidad')->get_id_fila_condicion($seleccion)[0];
    $this->dep('dr_nacionalidad')->tabla('dt_nacionalidad')->set_cursor($id_fila);
    $this->dep('dr_nacionalidad')->tabla('dt_nacionalidad')->eliminar_fila($id_fila);
  }

  //-----------------------------------------------------------------------------------
  //---- ABM sgr_pais------------------------------------------------------------------
  //-----------------------------------------------------------------------------------

  function cargarpais($form)
  {
    if ($this->dep('dr_pais')->tabla('dt_pais')->hay_cursor()) {
      $datos = $this->dep('dr_pais')->tabla('dt_pais')->get();
      $form->set_datos($datos);
    }
  }

  function guardarpais()
  {
    $this->dep('dr_pais')->sincronizar();
    $this->dep('dr_pais')->resetear();
  }

  function resetpais()
  {
    $this->dep('dr_pais')->resetear();
  }

  function modifpais($datos)
  {
    $this->dep('dr_pais')->tabla('dt_pais')->set($datos);
  }

  function seleccionpais($seleccion)
  {
    if($this->dep('dr_pais')->tabla('dt_pais')->cargar($seleccion)){
      $id_fila = $this->dep('dr_pais')->tabla('dt_pais')->get_id_fila_condicion($seleccion)[0];
      $this->dep('dr_pais')->tabla('dt_pais')->set_cursor($id_fila);
    }
  }

  function borrarpais($seleccion)
  {
    $this->dep('dr_pais')->tabla('dt_pais')->cargar($seleccion);
    $id_fila = $this->dep('dr_pais')->tabla('dt_pais')->get_id_fila_condicion($seleccion)[0];
    $this->dep('dr_pais')->tabla('dt_pais')->set_cursor($id_fila);
    $this->dep('dr_pais')->tabla('dt_pais')->eliminar_fila($id_fila);
  }

  //-----------------------------------------------------------------------------------
  //---- ABM sgr_provincia-------------------------------------------------------------
  //-----------------------------------------------------------------------------------

  function cargarprovincia($form)
  {
    if ($this->dep('dr_provincia')->tabla('dt_provincia')->hay_cursor()) {
      $datos = $this->dep('dr_provincia')->tabla('dt_provincia')->get();
      $form->set_datos($datos);
    }
  }

  function guardarprovincia()
  {
    $this->dep('dr_provincia')->sincronizar();
    $this->dep('dr_provincia')->resetear();
  }

  function resetprovincia()
  {
    $this->dep('dr_provincia')->resetear();
  }

  function modifprovincia($datos)
  {
    $this->dep('dr_provincia')->tabla('dt_provincia')->set($datos);
  }

  function seleccionprovincia($seleccion)
  {
    if($this->dep('dr_provincia')->tabla('dt_provincia')->cargar($seleccion)){
      $id_fila = $this->dep('dr_provincia')->tabla('dt_provincia')->get_id_fila_condicion($seleccion)[0];
      $this->dep('dr_provincia')->tabla('dt_provincia')->set_cursor($id_fila);
    }
  }

  function borrarprovincia($seleccion)
  {
    $this->dep('dr_provincia')->tabla('dt_provincia')->cargar($seleccion);
    $id_fila = $this->dep('dr_provincia')->tabla('dt_provincia')->get_id_fila_condicion($seleccion)[0];
    $this->dep('dr_provincia')->tabla('dt_provincia')->set_cursor($id_fila);
    $this->dep('dr_provincia')->tabla('dt_provincia')->eliminar_fila($id_fila);
  }

  //-----------------------------------------------------------------------------------
  //---- ABM sgr_ciudad----------------------------------------------------------------
  //-----------------------------------------------------------------------------------

  function cargarciudad($form)
  {
    if ($this->dep('dr_ciudad')->tabla('dt_ciudad')->hay_cursor()) {
      $datos = $this->dep('dr_ciudad')->tabla('dt_ciudad')->get();
      $form->set_datos($datos);
    }
  }

  function guardarciudad()
  {
    $this->dep('dr_ciudad')->sincronizar();
    $this->dep('dr_ciudad')->resetear();
  }

  function resetciudad()
  {
    $this->dep('dr_ciudad')->resetear();
  }

  function modifciudad($datos)
  {
    $this->dep('dr_ciudad')->tabla('dt_ciudad')->set($datos);
  }

  function seleccionciudad($seleccion)
  {
    if($this->dep('dr_ciudad')->tabla('dt_ciudad')->cargar($seleccion)){
      $id_fila = $this->dep('dr_ciudad')->tabla('dt_ciudad')->get_id_fila_condicion($seleccion)[0];
      $this->dep('dr_ciudad')->tabla('dt_ciudad')->set_cursor($id_fila);
    }
  }

  function borrarciudad($seleccion)
  {
    $this->dep('dr_ciudad')->tabla('dt_ciudad')->cargar($seleccion);
    $id_fila = $this->dep('dr_ciudad')->tabla('dt_ciudad')->get_id_fila_condicion($seleccion)[0];
    $this->dep('dr_ciudad')->tabla('dt_ciudad')->set_cursor($id_fila);
    $this->dep('dr_ciudad')->tabla('dt_ciudad')->eliminar_fila($id_fila);
  }

  //-----------------------------------------------------------------------------------
  //---- ABM sgr_sucursal -------------------------------------------------------------
  //-----------------------------------------------------------------------------------

  function cargarsucursal($form)
  {
    if ($this->dep('dr_sucursal')->tabla('dt_sucursal')->hay_cursor()) {
      $datos = $this->dep('dr_sucursal')->tabla('dt_sucursal')->get();
      $form->set_datos($datos);
    }
  }

  function guardarsucursal()
  {
    $this->dep('dr_sucursal')->sincronizar();
    $this->dep('dr_sucursal')->resetear();
  }

  function resetsucursal()
  {
    $this->dep('dr_sucursal')->resetear();
  }

  function modifsucursal($datos)
  {
    $this->dep('dr_sucursal')->tabla('dt_sucursal')->set($datos);
  }

  function seleccionsucursal($seleccion)
  {
    if($this->dep('dr_sucursal')->tabla('dt_sucursal')->cargar($seleccion)){
      $id_fila = $this->dep('dr_sucursal')->tabla('dt_sucursal')->get_id_fila_condicion($seleccion)[0];
      $this->dep('dr_sucursal')->tabla('dt_sucursal')->set_cursor($id_fila);
    }
  }

  function borrarsucursal($seleccion)
  {
    $this->dep('dr_sucursal')->tabla('dt_sucursal')->cargar($seleccion);
    $id_fila = $this->dep('dr_sucursal')->tabla('dt_sucursal')->get_id_fila_condicion($seleccion)[0];
    $this->dep('dr_sucursal')->tabla('dt_sucursal')->set_cursor($id_fila);
    $this->dep('dr_sucursal')->tabla('dt_sucursal')->eliminar_fila($id_fila);
  }

  //-----------------------------------------------------------------------------------
  //---- ABM sgr_departamento----------------------------------------------------------
  //-----------------------------------------------------------------------------------

  function cargardepartamento($form)
  {
    if ($this->dep('dr_departamento')->tabla('dt_departamento')->hay_cursor()) {
      $datos = $this->dep('dr_departamento')->tabla('dt_departamento')->get();
      $form->set_datos($datos);
    }
  }

  function guardardepartamento()
  {
    $this->dep('dr_departamento')->sincronizar();
    $this->dep('dr_departamento')->resetear();
  }

  function resetdepartamento()
  {
    $this->dep('dr_departamento')->resetear();
  }

  function modifdepartamento($datos)
  {
    $this->dep('dr_departamento')->tabla('dt_departamento')->set($datos);
  }

  function selecciondepartamento($seleccion)
  {
    if($this->dep('dr_departamento')->tabla('dt_departamento')->cargar($seleccion)){
      $id_fila = $this->dep('dr_departamento')->tabla('dt_departamento')->get_id_fila_condicion($seleccion)[0];
      $this->dep('dr_departamento')->tabla('dt_departamento')->set_cursor($id_fila);
    }
  }

  function borrardepartamento($seleccion)
  {
    $this->dep('dr_departamento')->tabla('dt_departamento')->cargar($seleccion);
    $id_fila = $this->dep('dr_departamento')->tabla('dt_departamento')->get_id_fila_condicion($seleccion)[0];
    $this->dep('dr_departamento')->tabla('dt_departamento')->set_cursor($id_fila);
    $this->dep('dr_departamento')->tabla('dt_departamento')->eliminar_fila($id_fila);
  }

  /////////////////////////////////////////////////////////////////////////////////////
  //-----------------------------------------------------------------------------------
  //---- ABM sgr_sector ---------------------------------------------------------------
  //-----------------------------------------------------------------------------------
  /////////////////////////////////////////////////////////////////////////////////////

  function cargarsector($form)
  {
    if ($this->dep('dr_sector')->tabla('dt_sector')->hay_cursor()) {
      $datos = $this->dep('dr_sector')->tabla('dt_sector')->get();
      $form->set_datos($datos);
    }
  }

  function guardarsector()
  {
    $this->dep('dr_sector')->sincronizar();
    $this->dep('dr_sector')->resetear();
  }

  function resetsector()
  {
    $this->dep('dr_sector')->resetear();
  }

  function modifsector($datos)
  {
    $this->dep('dr_sector')->tabla('dt_sector')->set($datos);
  }

  function seleccionsector($seleccion)
  {
    if($this->dep('dr_sector')->tabla('dt_sector')->cargar($seleccion)){
      $id_fila = $this->dep('dr_sector')->tabla('dt_sector')->get_id_fila_condicion($seleccion)[0];
      $this->dep('dr_sector')->tabla('dt_sector')->set_cursor($id_fila);
    }
  }

  function borrarsector($seleccion)
  {
    $this->dep('dr_sector')->tabla('dt_sector')->cargar($seleccion);
    $id_fila = $this->dep('dr_sector')->tabla('dt_sector')->get_id_fila_condicion($seleccion)[0];
    $this->dep('dr_sector')->tabla('dt_sector')->set_cursor($id_fila);
    $this->dep('dr_sector')->tabla('dt_sector')->eliminar_fila($id_fila);
  }

  //-----------------------------------------------------------------------------------
  //---- ABM sgr_rol ------------------------------------------------------------------
  //-----------------------------------------------------------------------------------

  function cargarrol($form)
  {
    if ($this->dep('dr_rol')->tabla('dt_rol')->hay_cursor()) {
      $datos = $this->dep('dr_rol')->tabla('dt_rol')->get();
      $form->set_datos($datos);
    }
  }

  function guardarrol()
  {
    $this->dep('dr_rol')->sincronizar();
    $this->dep('dr_rol')->resetear();
  }

  function resetrol()
  {
    $this->dep('dr_rol')->resetear();
  }

  function modifrol($datos)
  {
    $this->dep('dr_rol')->tabla('dt_rol')->set($datos);
  }

  function seleccionrol($seleccion)
  {
    if($this->dep('dr_rol')->tabla('dt_rol')->cargar($seleccion)){
      $id_fila = $this->dep('dr_rol')->tabla('dt_rol')->get_id_fila_condicion($seleccion)[0];
      $this->dep('dr_rol')->tabla('dt_rol')->set_cursor($id_fila);
    }
  }

  function borrarrol($seleccion)
  {
    $this->dep('dr_rol')->tabla('dt_rol')->cargar($seleccion);
    $id_fila = $this->dep('dr_rol')->tabla('dt_rol')->get_id_fila_condicion($seleccion)[0];
    $this->dep('dr_rol')->tabla('dt_rol')->set_cursor($id_fila);
    $this->dep('dr_rol')->tabla('dt_rol')->eliminar_fila($id_fila);
  }

  //-----------------------------------------------------------------------------------
  //---- ABM sgr_sexo------------------------------------------------------------------
  //-----------------------------------------------------------------------------------

  function cargargenero($form)
  {
    if ($this->dep('dr_genero')->tabla('dt_genero')->hay_cursor()) {
      $datos = $this->dep('dr_genero')->tabla('dt_genero')->get();
      $form->set_datos($datos);
    }
  }

  function guardargenero()
  {
    $this->dep('dr_genero')->sincronizar();
    $this->dep('dr_genero')->resetear();
  }

  function resetgenero()
  {
    $this->dep('dr_genero')->resetear();
  }

  function modifgenero($datos)
  {
    $this->dep('dr_genero')->tabla('dt_genero')->set($datos);
  }

  function selecciongenero($seleccion)
  {
    if($this->dep('dr_genero')->tabla('dt_genero')->cargar($seleccion)){
      $id_fila = $this->dep('dr_genero')->tabla('dt_genero')->get_id_fila_condicion($seleccion)[0];
      $this->dep('dr_genero')->tabla('dt_genero')->set_cursor($id_fila);
    }
  }

  function borrargenero($seleccion)
  {
    $this->dep('dr_genero')->tabla('dt_genero')->cargar($seleccion);
    $id_fila = $this->dep('dr_genero')->tabla('dt_genero')->get_id_fila_condicion($seleccion)[0];
    $this->dep('dr_genero')->tabla('dt_genero')->set_cursor($id_fila);
    $this->dep('dr_genero')->tabla('dt_genero')->eliminar_fila($id_fila);
  }

  //-----------------------------------------------------------------------------------
  //---- ABM sgr_tipo_doc -------------------------------------------------------------
  //-----------------------------------------------------------------------------------

  function cargartipodocumento($form)
  {
    if ($this->dep('dr_tipodocumento')->tabla('dt_tipodocumento')->hay_cursor()) {
      $datos = $this->dep('dr_tipodocumento')->tabla('dt_tipodocumento')->get();
      $form->set_datos($datos);
    }
  }

  function guardartipodocumento()
  {
    $this->dep('dr_tipodocumento')->sincronizar();
    $this->dep('dr_tipodocumento')->resetear();
  }

  function resettipodocumento()
  {
    $this->dep('dr_tipodocumento')->resetear();
  }

  function modiftipodocumento($datos)
  {
    $this->dep('dr_tipodocumento')->tabla('dt_tipodocumento')->set($datos);
  }

  function selecciontipodocumento($seleccion)
  {
    if($this->dep('dr_tipodocumento')->tabla('dt_tipodocumento')->cargar($seleccion)){
      $id_fila = $this->dep('dr_tipodocumento')->tabla('dt_tipodocumento')->get_id_fila_condicion($seleccion)[0];
      $this->dep('dr_tipodocumento')->tabla('dt_tipodocumento')->set_cursor($id_fila);
    }
  }

  function borrartipodocumento($seleccion)
  {
    $this->dep('dr_tipodocumento')->tabla('dt_tipodocumento')->cargar($seleccion);
    $id_fila = $this->dep('dr_tipodocumento')->tabla('dt_tipodocumento')->get_id_fila_condicion($seleccion)[0];
    $this->dep('dr_tipodocumento')->tabla('dt_tipodocumento')->set_cursor($id_fila);
    $this->dep('dr_tipodocumento')->tabla('dt_tipodocumento')->eliminar_fila($id_fila);
  }

  //-----------------------------------------------------------------------------------
  //---- ABM sgr_rubro ----------------------------------------------------------------
  //-----------------------------------------------------------------------------------

  function cargarrubro($form)
  {
    if ($this->dep('dr_rubro')->tabla('dt_rubro')->hay_cursor()) {
      $datos = $this->dep('dr_rubro')->tabla('dt_rubro')->get();
      $form->set_datos($datos);
    }
  }

  function guardarrubro()
  {
    $this->dep('dr_rubro')->sincronizar();
    $this->dep('dr_rubro')->resetear();
  }

  function resetrubro()
  {
    $this->dep('dr_rubro')->resetear();
  }

  function modifrubro($datos)
  {
    $this->dep('dr_rubro')->tabla('dt_rubro')->set($datos);
  }

  function seleccionrubro($seleccion)
  {
    if($this->dep('dr_rubro')->tabla('dt_rubro')->cargar($seleccion)){
      $id_fila = $this->dep('dr_rubro')->tabla('dt_rubro')->get_id_fila_condicion($seleccion)[0];
      $this->dep('dr_rubro')->tabla('dt_rubro')->set_cursor($id_fila);
    }
  }

  function borrarrubro($seleccion)
  {
    $this->dep('dr_rubro')->tabla('dt_rubro')->cargar($seleccion);
    $id_fila = $this->dep('dr_rubro')->tabla('dt_rubro')->get_id_fila_condicion($seleccion)[0];
    $this->dep('dr_rubro')->tabla('dt_rubro')->set_cursor($id_fila);
    $this->dep('dr_rubro')->tabla('dt_rubro')->eliminar_fila($id_fila);
  }

}

?>
