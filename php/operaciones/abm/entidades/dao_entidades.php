<?php

class dao_entidades
{
    static function get_datossinfiltro($where='')
    {
      if ($where) {
        $where_armado = "WHERE $where";
      } else {
        $where_armado = '';
      }

      $sql = "SELECT e.id_entidad, e.razonsocial, e.cuit, case when e.propietario then 'Si' else 'No' end propietario,
          		pa.nombre pais, pro.nombre prov, ci.nombre ciudad
          		FROM sgr.entidad e
          		LEFT JOIN sgr.domicilio d ON e.id_entidad = d.id_entidad
              LEFT JOIN sgr.pais pa ON d.id_pais = pa.id_pais
          		LEFT JOIN sgr.provincia pro ON d.id_provincia = pro.id_provincia
          		LEFT JOIN sgr.ciudad ci ON d.id_ciudad = ci.id_ciudad
              $where_armado ORDER BY razonsocial ASC
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

      $sql = "SELECT e.id_entidad, e.razonsocial, e.cuit, case when e.propietario then 'Si' else 'No' end propietario,
          		pa.nombre pais, pro.nombre prov, ci.nombre ciudad
          		FROM sgr.entidad e
          		LEFT JOIN sgr.domicilio d ON e.id_entidad = d.id_entidad
              LEFT JOIN sgr.pais pa ON d.id_pais = pa.id_pais
          		LEFT JOIN sgr.provincia pro ON d.id_provincia = pro.id_provincia
          		LEFT JOIN sgr.ciudad ci ON d.id_ciudad = ci.id_ciudad
              $where_armado ORDER BY razonsocial ASC";
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
