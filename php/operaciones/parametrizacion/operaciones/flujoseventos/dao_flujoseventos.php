<?php

class dao_flujoseventos
{

  static function get_datossinfiltro($where='')
  {
    if ($where) {
      $where_armado = "WHERE $where";
    } else {
      $where_armado = '';
    }
    $sql = "SELECT wf.id_workflow, wf.nombre,
            te.nombre||': '||e.nombre evento
            FROM sgr.workflow wf
            INNER JOIN sgr.evento e ON wf.id_evento = e.id_evento
            INNER JOIN sgr.tipo_evento te ON e.id_tipoevento = te.id_tipoevento
            $where_armado ORDER BY evento ASC
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
    $sql = "SELECT wf.id_workflow, wf.nombre, te.nombre tipoevento, e.nombre evento
            FROM sgr.workflow wf
            INNER JOIN sgr.evento e ON wf.id_evento = e.id_evento
            INNER JOIN sgr.tipo_evento te ON e.id_tipoevento = te.id_tipoevento
            $where_armado ORDER BY tipoevento, evento ASC";
    $resultado = consultar_fuente($sql);
    return $resultado;
  }


  // static function get_datossinfiltro($where='')
  // {
  //   if ($where) {
  //     $where_armado = "WHERE $where";
  //   } else {
  //     $where_armado = '';
  //   }
  //   $sql = "SELECT f.id_flujo, f.nombre,
  //           e.nombre origen, e.nombre destino,
  //           f.orden,
  //           wf.nombre workflow
  //           FROM sgr.flujo f
  //           INNER JOIN sgr.estado e ON f.id_estadoorigen = e.id_estado
  //           INNER JOIN sgr.estado ON f.id_estadodestino = e.id_estado
  //           INNER JOIN sgr.workflow wf ON f.id_workflow = wf.id_workflow
  //           $where_armado ORDER BY origen, destino ASC
  //           limit 10";
  //   $resultado = consultar_fuente($sql);
  //   return $resultado;
  // }
  //
  // static function get_datos($where='')
  // {
  //   if ($where) {
  //     $where_armado = "WHERE $where";
  //   } else {
  //     $where_armado = '';
  //   }
  //   $sql = "SELECT f.id_flujo, f.nombre,
  //           e.nombre origen, e.nombre destino,
  //           f.orden,
  //           wf.nombre workflow
  //           FROM sgr.flujo f
  //           INNER JOIN sgr.estado e ON f.id_estadoorigen = e.id_estado
  //           INNER JOIN sgr.estado ON f.id_estadodestino = e.id_estado
  //           INNER JOIN sgr.workflow wf ON f.id_workflow = wf.id_workflow
  //           $where_armado ORDER BY origen, destino ASC";
  //   $resultado = consultar_fuente($sql);
  //   return $resultado;
  // }

}
?>
