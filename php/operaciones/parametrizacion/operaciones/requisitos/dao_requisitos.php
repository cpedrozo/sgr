<?php

class dao_requisitos
{
  static function get_datossinfiltro($where='')
  {
    if ($where) {
      $where_armado = "WHERE $where";
    } else {
      $where_armado = '';
    }
    $sql = "SELECT r.id_requisitos,
            f.nombre flujo,
            r.nombre, r.observacion, r.obligatorio, r.orden, r.archivo
            FROM sgr.requisitos r
            INNER JOIN sgr.flujo f ON r.id_flujo = f.id_flujo
            ORDER BY flujo, nombre ASC
            LIMIT 5";
    $resultado = consultar_fuente($sql);
    return $resultado;
  }

  static function get_datos($where='')
  {
    if ($where) {
      $where_armado = "WHERE $where";
    } else {
      $where_armado = '';
    }
    $sql = "SELECT r.id_requisitos,
            f.nombre flujo,
            r.nombre, r.observacion, r.obligatorio, r.orden, r.archivo
            FROM sgr.requisitos r
            INNER JOIN sgr.flujo f ON r.id_flujo = f.id_flujo
            ORDER BY flujo, nombre ASC";
    $resultado = consultar_fuente($sql);
    return $resultado;
  }

}
?>
