
Archivo: ci_propietario... (así funcionaba)

<?php

require_once('operaciones/parametrizacion/propietario/dao_propietario.php');

class ci_propietario extends sgr_ci
{
function evt__cuadro__seleccion($seleccion)
{
  $this->cn()->dep('dr_propietario')->tabla('dt_propietario')->cargar($seleccion);
  $id_fila = $this->cn()->dep('dr_propietario')->tabla('dt_propietario')->get_id_fila_condicion($seleccion)[0];
  $this->cn()->dep('dr_propietario')->tabla('dt_propietario')->set_cursor($id_fila);
  $this->set_pantalla('pant_edicion');
}
}
?>

Archivo: ci_propietario..... (así no funciona, arroja el error citado debajo)

<?php
function evt__cuadro__seleccion($seleccion)
{
  cn_parametrizacion::seleccionpropietario($seleccion);
  $this->set_pantalla('pant_edicion');
}
?>

Archivo: cn_parametrizacion..... (así no funciona, arroja el error citado debajo)

<?php
public static function seleccionpropietario($seleccion)
{
  $this->dep('dr_propietario')->tabla('dt_propietario')->cargar($seleccion);
  $id_fila = $this->dep('dr_propietario')->tabla('dt_propietario')->get_id_fila_condicion($seleccion)[0];
  $this->dep('dr_propietario')->tabla('dt_propietario')->set_cursor($id_fila);
}
?>

Fatal error: Using $this when not in object context in
/home/toba_2_6_7/toba_2_7_6/proyectos/sgr/php/operaciones/parametrizacion/cn_parametrizacion.php on line 30
