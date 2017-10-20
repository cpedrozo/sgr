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
            wf.nombre flujo,
            r.nombre, r.obligatorio, r.orden, r.persona
            FROM sgr.requisitos r
            INNER JOIN sgr.workflow wf ON r.id_workflow = wf.id_workflow
            ORDER BY flujo, nombre ASC
            limit 10";
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
            wf.nombre flujo,
            r.nombre, r.obligatorio, r.orden, r.persona
            FROM sgr.requisitos r
            INNER JOIN sgr.workflow wf ON r.id_workflow = wf.id_workflow
            ORDER BY flujo, nombre ASC";
    $resultado = consultar_fuente($sql);
    return $resultado;
  }

}
?>
