<?php

class dao_tipotel
{

    static function get_datos($where='')
    {
      if ($where) {
        $where_armado = "WHERE $where";
      } else {
        $where_armado = '';
      }

      $sql = "SELECT id_tipotel, nombre, case when interno then 'Activo' else 'Inactivo' end interno
              FROM sgr.tipotel
              $where_armado";

      $resultado = consultar_fuente($sql);
      return $resultado;
    }

}
?>
