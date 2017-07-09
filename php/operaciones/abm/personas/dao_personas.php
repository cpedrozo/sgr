<?php

class dao_personas
{
    static function get_datossinfiltro($where='')
    {
      if ($where) {
        $where_armado = "WHERE $where";
      } else {
        $where_armado = '';
      }

      $sql = "SELECT p.id_persona, p.apellido, p.nombre, p.dni,
              e.razonsocial entidad,
              s.nombre sucursal, dp.nombre dpto,
              pa.nombre pais, pro.nombre prov, ci.nombre ciudad
              FROM sgr.persona p
              LEFT JOIN sgr.entidad e ON p.id_entidad = e.id_entidad
              LEFT JOIN sgr.sucursal s ON p.id_sucursal = s.id_sucursal
              LEFT JOIN sgr.dpto dp ON p.id_dpto = dp.id_dpto
              LEFT JOIN sgr.domicilio d ON e.id_entidad = d.id_entidad
              LEFT JOIN sgr.pais pa ON d.id_pais = pa.id_pais
              LEFT JOIN sgr.provincia pro ON d.id_provincia = pro.id_provincia
              LEFT JOIN sgr.ciudad ci ON d.id_ciudad = ci.id_ciudad
              $where_armado ORDER BY p.apellido, p.nombre ASC
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

      $sql = "SELECT p.id_persona, p.apellido, p.nombre, p.dni,
              e.razonsocial entidad,
              s.nombre sucursal, dp.nombre dpto,
              pa.nombre pais, pro.nombre prov, ci.nombre ciudad
              FROM sgr.persona p
              LEFT JOIN sgr.entidad e ON p.id_entidad = e.id_entidad
              LEFT JOIN sgr.sucursal s ON p.id_sucursal = s.id_sucursal
              LEFT JOIN sgr.dpto dp ON p.id_dpto = dp.id_dpto
              LEFT JOIN sgr.domicilio d ON e.id_entidad = d.id_entidad
              LEFT JOIN sgr.pais pa ON d.id_pais = pa.id_pais
              LEFT JOIN sgr.provincia pro ON d.id_provincia = pro.id_provincia
              LEFT JOIN sgr.ciudad ci ON d.id_ciudad = ci.id_ciudad
              $where_armado ORDER BY p.apellido, p.nombre ASC";

      $resultado = consultar_fuente($sql);
      return $resultado;
    }

    static function get_tipotel($id_tipotel)
    {
      $sql = "SELECT id_tipotel, interno FROM sgr.tipotel
            where id_tipotel = $id_tipotel";
      $resultado = consultar_fuente($sql);
      //ei_arbol($resultado);
      if($resultado[0]['interno']==true)
      {
        return 'si';
      }
      else {
        return 'no';
      }
    }

}
?>
