<?php

class dao_tipoevento
{
  static function get_datossinfiltro($where='')
  {
    if ($where) {
      $where_armado = "WHERE $where";
    } else {
      $where_armado = '';
    }
    $sql = "SELECT *
            FROM sgr.tipo_evento
            $where_armado ORDER BY nombre ASC
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
    $sql = "SELECT *
            FROM sgr.tipo_evento
            $where_armado ORDER BY nombre ASC";
    $resultado = consultar_fuente($sql);
    return $resultado;
  }

}
?>
