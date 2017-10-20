<?php

class dao_eventos
{
  static function get_datossinfiltro($where='')
  {
    if ($where) {
      $where_armado = "WHERE $where";
    } else {
      $where_armado = '';
    }
    $sql = "SELECT e.id_evento, e.nombre, te.nombre tipoevento FROM sgr.evento e
            INNER JOIN sgr.tipo_evento te ON e.id_tipoevento = te.id_tipoevento
            $where_armado ORDER BY tipoevento, nombre ASC
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
    $sql = "SELECT e.id_evento, e.nombre, te.nombre tipoevento FROM sgr.evento e
            INNER JOIN sgr.tipo_evento te ON e.id_tipoevento = te.id_tipoevento
            $where_armado ORDER BY tipoevento, nombre ASC";
    $resultado = consultar_fuente($sql);
    return $resultado;
  }

}
?>
