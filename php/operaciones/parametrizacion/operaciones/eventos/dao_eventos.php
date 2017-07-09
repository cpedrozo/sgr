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
    $sql = "SELECT *
            FROM sgr.evento
            $where_armado ORDER BY nombre ASC
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
    $sql = "SELECT *
            FROM sgr.evento
            $where_armado ORDER BY nombre ASC";
    $resultado = consultar_fuente($sql);
    return $resultado;
  }

}
?>
