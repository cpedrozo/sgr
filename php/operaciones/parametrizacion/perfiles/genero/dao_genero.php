<?php

class dao_genero
{
    static function get_datos($where='')
    {
      if ($where) {
        $where_armado = "WHERE $where";
      } else {
        $where_armado = '';
      }

      $sql = "SELECT *
              FROM sgr.genero
              $where_armado";

      $resultado = consultar_fuente($sql);
      return $resultado;
    }
}
?>
