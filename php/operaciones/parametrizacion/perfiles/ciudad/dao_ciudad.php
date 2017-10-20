<?php

class dao_ciudad
{
    static function get_datossinfiltro($where='')
    {
      if ($where) {
        $where_armado = "WHERE $where";
      } else {
        $where_armado = '';
      }
      $sql = "SELECT c.id_ciudad, c.nombre, p.nombre provincia
              FROM sgr.ciudad c
              LEFT JOIN sgr.provincia p ON c.id_provincia = p.id_provincia
              $where_armado ORDER BY provincia, nombre ASC
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
      $sql = "SELECT c.id_ciudad, c.nombre, p.nombre provincia FROM sgr.ciudad c
              INNER JOIN sgr.provincia p ON c.id_provincia = p.id_provincia
              $where_armado ORDER BY provincia, nombre ASC";
      $resultado = consultar_fuente($sql);
      return $resultado;
    }
}
?>
