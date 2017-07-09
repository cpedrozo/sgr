<?php

class dao_sucursal
{
  /*
  static function get_datos()
  {
  	$sql = "SELECT * FROM sgr.sucursal";
  	$datos = consultar_fuente($sql);
    return $datos;
  }
  */

    static function get_datos($where='')
    {
      if ($where) {
        $where_armado = "WHERE $where";
      } else {
        $where_armado = '';
      }

      $sql = "SELECT s.id_sucursal, s.nombre, p.nombre provincia, c.nombre ciudad
              FROM sgr.sucursal s
              LEFT JOIN sgr.provincia p ON s.id_provincia = p.id_provincia
              LEFT JOIN sgr.ciudad c ON s.id_ciudad = c.id_ciudad
              $where_armado
              ORDER BY p.nombre, c.nombre";
      $resultado = consultar_fuente($sql);
      return $resultado;
    }
}
?>
