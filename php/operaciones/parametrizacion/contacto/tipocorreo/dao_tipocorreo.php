<?php

class dao_tipocorreo
{
  /*
  static function get_datos()
  {
  	$sql = "SELECT * FROM sgr.tipocorreo";
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

      $sql = "SELECT * FROM sgr.tipocorreo
              $where_armado";

      $resultado = consultar_fuente($sql);
      return $resultado;
    }
}
?>
