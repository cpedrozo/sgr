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
    $sql = "SELECT fe.id_workflow, fe.nombre, te.nombre tipoevento, e.nombre evento
            FROM sgr.flujo_evento fe
            INNER JOIN sgr.tipo_evento te ON fe.id_tipoevento = te.id_tipoevento
            INNER JOIN sgr.evento e ON fe.id_evento = e.id_evento
            $where_armado ORDER BY tipoevento, evento ASC
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
    $sql = "SELECT fe.id_workflow, fe.nombre, te.nombre tipoevento, e.nombre evento
            FROM sgr.flujo_evento fe
            INNER JOIN sgr.tipo_evento te ON fe.id_tipoevento = te.id_tipoevento
            INNER JOIN sgr.evento e ON fe.id_evento = e.id_evento
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
  //           fe.nombre workflow
  //           FROM sgr.flujo f
  //           INNER JOIN sgr.estado e ON f.id_estadoorigen = e.id_estado
  //           INNER JOIN sgr.estado ON f.id_estadodestino = e.id_estado
  //           INNER JOIN sgr.flujo_evento fe ON f.id_workflow = fe.id_workflow
  //           $where_armado ORDER BY origen, destino ASC
  //           LIMIT 5";
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
  //           fe.nombre workflow
  //           FROM sgr.flujo f
  //           INNER JOIN sgr.estado e ON f.id_estadoorigen = e.id_estado
  //           INNER JOIN sgr.estado ON f.id_estadodestino = e.id_estado
  //           INNER JOIN sgr.flujo_evento fe ON f.id_workflow = fe.id_workflow
  //           $where_armado ORDER BY origen, destino ASC";
  //   $resultado = consultar_fuente($sql);
  //   return $resultado;
  // }

}
?>
