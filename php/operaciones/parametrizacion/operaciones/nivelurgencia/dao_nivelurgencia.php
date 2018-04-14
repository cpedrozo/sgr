<?php

class dao_nivelurgencia
{
  static function get_datossinfiltro($where='')
  {
    return self::get_datos('', true); ////20180414
  }

  static function get_datos($where='', $limit=false)
  {
    if ($where) {
      $where_armado = "$where";
    } else {
      $where_armado = 'true';
    }
    $limite=($limit ? 'limit 10':'');
    $sql = "SELECT *
            FROM sgr.nivelurgencia
            WHERE $where_armado
            ORDER BY nombre ASC
            $limite";
    $resultado = consultar_fuente($sql);
    return $resultado;
  }

  static function existe_db_nivelurgencia($nombreurgencia) ////20180414
  {
    $nombreurgencia = quote($nombreurgencia);
    $sql = "SELECT COUNT(*) cantidad
            FROM sgr.nivelurgencia
            WHERE nombre = $nombreurgencia";
    $resultado = consultar_fuente($sql);
    return $resultado[0]['cantidad']>0;
  }

}
?>
