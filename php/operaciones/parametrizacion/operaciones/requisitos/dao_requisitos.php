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
    $sql = "SELECT r.id_requisitos, r.id_estadoorigen, r.id_estadodestino,r.id_workflow,
            fe.nombre flujo,
            r.nombre, r.obligatorio, r.orden, r.persona
            FROM sgr.requisitos r
            INNER JOIN sgr.flujo_evento fe ON r.id_workflow = fe.id_workflow
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
    $sql = "SELECT r.id_requisitos, r.id_estadoorigen, r.id_estadodestino,r.id_workflow,
            fe.nombre flujo,
            r.nombre, r.obligatorio, r.orden, r.persona
            FROM sgr.requisitos r
            INNER JOIN sgr.flujo_evento fe ON r.id_workflow = fe.id_workflow
            ORDER BY flujo, nombre ASC";
    $resultado = consultar_fuente($sql);
    return $resultado;
  }

}
?>
