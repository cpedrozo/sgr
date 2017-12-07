<?php
class cn_personas extends sgr_cn
{

  //-----------------------------------------------------------------------------------
  //---- ABM sgr_entidades// ----------------------------------------------------------
  //-----------------------------------------------------------------------------------

  function cargar_dr_entidades($seleccion=null)
    {
        if (!$this->dep('dr_entidades')->esta_cargada()) {
            if (isset($seleccion)) {
                $this->dep('dr_entidades')->cargar($seleccion);
            } else {
                $this->dep('dr_entidades')->cargar($seleccion);
            }
        }
    }

  function borrar_dt_entidades($seleccion)
  {
    if ($this->dep('dr_entidades')->tabla('dt_entidades')->esta_cargada()) {
      $id_memoria = $this->dep('dr_entidades')->tabla('dt_entidades')->get_id_fila_condicion($seleccion);
      $this->dep('dr_entidades')->tabla('dt_entidades')->eliminar_fila($id_memoria[0]);
    }
  }

  function get_entidades()
  {
    if ($this->dep('dr_entidades')->tabla('dt_entidades')->hay_cursor())
    {
      return $this->dep('dr_entidades')->tabla('dt_entidades')->get();
    }
  }

  function set_cursorentidades($seleccion)
  {
    $id = $this->dep('dr_entidades')->tabla('dt_entidades')->get_id_fila_condicion($seleccion);
    $this->dep('dr_entidades')->tabla('dt_entidades')->set_cursor($id[0]);
  }

  function guardar_dr_entidades()
  {
    $this->dep('dr_entidades')->sincronizar();
  }

  function resetear_dr_entidades()
  {
    $this->dep('dr_entidades')->resetear();
  }

  function set_dt_entidades($datos)
  {
    $this->dep('dr_entidades')->tabla('dt_entidades')->set($datos);
  }

  function seleccionentidades($seleccion)
  {
    if($this->dep('dr_entidades')->tabla('dt_entidades')->cargar($seleccion)){
      $id_fila = $this->dep('dr_entidades')->tabla('dt_entidades')->get_id_fila_condicion($seleccion)[0];
      $this->dep('dr_entidades')->tabla('dt_entidades')->set_cursor($id_fila);
    }
  }

  //-----------------------------------------------------------------------------------
  //---- ABM form_ml_domicilio_entidades-----------------------------------------------
  //-----------------------------------------------------------------------------------

  function getdomicilio_entidades()
  {
    return $this->dep('dr_entidades')->tabla('dt_domicilio')->get_filas();
  }

  function procesardomicilio_entidades($datos)
  {
    $this->dep('dr_entidades')->tabla('dt_domicilio')->procesar_filas($datos);
  }

  //-----------------------------------------------------------------------------------
  //---- ABM form_ml_tel_entidades-----------------------------------------------------
  //-----------------------------------------------------------------------------------

  function gettelefono_entidades()
  {
    return $this->dep('dr_entidades')->tabla('dt_telefono')->get_filas();
  }

  function procesartelefono_entidades($datos)
  {
    $this->dep('dr_entidades')->tabla('dt_telefono')->procesar_filas($datos);
  }

  //-----------------------------------------------------------------------------------
  //---- ABM form_ml_correo_entidades-----------------------------------------------------
  //-----------------------------------------------------------------------------------

  function getcorreo_entidades()
  {
    return $this->dep('dr_entidades')->tabla('dt_correo')->get_filas();
  }

  function procesarcorreo_entidades($datos)
  {
    $this->dep('dr_entidades')->tabla('dt_correo')->procesar_filas($datos);
  }

  //-----------------------------------------------------------------------------------
  //---- ABM sgr_personas// -----------------------------------------------------------
  //-----------------------------------------------------------------------------------

  function cargar_dr_personas($seleccion=null)
    {
        if (!$this->dep('dr_personas')->esta_cargada()) {
            if (isset($seleccion)) {
                $this->dep('dr_personas')->cargar($seleccion);
            } else {
                $this->dep('dr_personas')->cargar($seleccion);
            }
        }
    }

  function borrar_dt_personas($seleccion)
  {
    if ($this->dep('dr_personas')->tabla('dt_personas')->esta_cargada()) {
      $id_memoria = $this->dep('dr_personas')->tabla('dt_personas')->get_id_fila_condicion($seleccion);
      $this->dep('dr_personas')->tabla('dt_personas')->eliminar_fila($id_memoria[0]);
    }
  }

  function get_personas()
  {
    if ($this->dep('dr_personas')->tabla('dt_personas')->hay_cursor())
    {
      return $this->dep('dr_personas')->tabla('dt_personas')->get();
    }
  }

  function set_cursorpersonas($seleccion)
  {
    $id = $this->dep('dr_personas')->tabla('dt_personas')->get_id_fila_condicion($seleccion);
    $this->dep('dr_personas')->tabla('dt_personas')->set_cursor($id[0]);
  }

  function guardar_dr_personas()
  {
    $this->dep('dr_personas')->sincronizar();
  }

  function resetear_dr_personas()
  {
    $this->dep('dr_personas')->resetear();
  }

  function set_dt_personas($datos)
  {
    $this->dep('dr_personas')->tabla('dt_personas')->set($datos);
  }

  function seleccionpersonas($seleccion)
  {
    if($this->dep('dr_personas')->tabla('dt_personas')->cargar($seleccion)){
      $id_fila = $this->dep('dr_personas')->tabla('dt_personas')->get_id_fila_condicion($seleccion)[0];
      $this->dep('dr_personas')->tabla('dt_personas')->set_cursor($id_fila);
    }
  }

  //-----------------------------------------------------------------------------------
  //---- ABM form_ml_domicilio_personas-----------------------------------------------
  //-----------------------------------------------------------------------------------

  function getdomicilio_personas()
  {
    return $this->dep('dr_personas')->tabla('dt_domicilio')->get_filas();
    //ei_arbol(array(get_filas()));
  }

  function procesardomicilio_personas($datos)
  {
    $this->dep('dr_personas')->tabla('dt_domicilio')->procesar_filas($datos);
  }

  //-----------------------------------------------------------------------------------
  //---- ABM form_ml_tel_personas-----------------------------------------------------
  //-----------------------------------------------------------------------------------

  function gettelefono_personas()
  {
    return $this->dep('dr_personas')->tabla('dt_telefono')->get_filas();
  }

  function procesartelefono_personas($datos)
  {
    $this->dep('dr_personas')->tabla('dt_telefono')->procesar_filas($datos);
  }

  //-----------------------------------------------------------------------------------
  //---- ABM form_ml_correo_personas-----------------------------------------------------
  //-----------------------------------------------------------------------------------

  function getcorreo_personas()
  {
    return $this->dep('dr_personas')->tabla('dt_correo')->get_filas();
  }

  function procesarcorreo_personas($datos)
  {
    $this->dep('dr_personas')->tabla('dt_correo')->procesar_filas($datos);
  }

  }

?>
