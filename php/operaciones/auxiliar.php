<?php
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
  //$this->dep('dr_personas')->resetear();
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
