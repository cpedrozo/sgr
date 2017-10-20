<?php

class dao_provincia
{
  /*
  static function get_datos()
  {
  	$sql = "SELECT p.id_provincia, p.nombre, pa.nombre pais from sgr.provincia p inner join sgr.pais pa on p.id_pais = pa.id_pais order by pais, nombre asc"; //con inner join mostrar el nombre del pais en lugar del numero id
  	$datos = consultar_fuente($sql);
    return $datos;
  }
  */

    static function get_datossinfiltro($where='')
    {
      if ($where) {
        $where_armado = "WHERE $where";
      } else {
        $where_armado = '';
      }
      $sql = "SELECT p.id_provincia, p.nombre, pa.nombre pais
              FROM sgr.provincia p
              LEFT JOIN sgr.pais pa ON p.id_pais = pa.id_pais
              $where_armado ORDER BY pais, nombre ASC
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
      $sql = "SELECT p.id_provincia, p.nombre, pa.nombre pais FROM sgr.provincia p
              INNER JOIN sgr.pais pa ON p.id_pais = pa.id_pais
              $where_armado ORDER BY pais, nombre ASC";
      $resultado = consultar_fuente($sql);
      return $resultado;
    }
}
?>
