<?php

class dao_nuevoregistro
{
  static function get_datossinfiltro($where='')
  {
    if ($where) {
      $where_armado = "WHERE $where";
    } else {
      $where_armado = '';
    }

    $sql = "SELECT *
            FROM sgr.registro
            --$where_armado ORDER BY id_registro ASC
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
            FROM sgr.registro
            --$where_armado ORDER BY id_registro ASC";

    $resultado = consultar_fuente($sql);
    return $resultado;
  }

}
?>
