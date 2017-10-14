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

      $sql = "SELECT p.id_persona,
              td.nombre||': '||p.doc documento, --p.apellido, p.nombre,
              e.razonsocial entidad,
              dp.nombre||' - '||se.nombre||' ('||s.nombre||')' suc_dpto,
              ci.nombre||', '||pro.nombre||' - '||pa.nombre localidad, ---ci.nombre ciudad, pro.nombre prov, pa.nombre pais,
              p.apellido||', '||p.nombre apynom
              FROM sgr.persona p
              LEFT JOIN sgr.tipo_doc td ON p.id_tipo_doc = td.id_tipo_doc
              LEFT JOIN sgr.entidad e ON p.id_entidad = e.id_entidad
              LEFT JOIN sgr.sector se ON p.id_sector = se.id_sector
              LEFT JOIN sgr.dpto dp ON se.id_dpto = dp.id_dpto
              LEFT JOIN sgr.sucursal s ON dp.id_sucursal = s.id_sucursal
              LEFT JOIN sgr.domicilio d ON p.id_persona = d.id_persona
              LEFT JOIN sgr.ciudad ci ON d.id_ciudad = ci.id_ciudad
              LEFT JOIN sgr.provincia pro ON ci.id_provincia = pro.id_provincia
              LEFT JOIN sgr.pais pa ON pro.id_pais = pa.id_pais
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

      $sql = "SELECT p.id_persona,
              td.nombre||': '||p.doc documento, --p.apellido, p.nombre,
              e.razonsocial entidad,
              dp.nombre||' - '||se.nombre||' ('||s.nombre||')' suc_dpto,
              ci.nombre||', '||pro.nombre||' - '||pa.nombre localidad, ---ci.nombre ciudad, pro.nombre prov, pa.nombre pais,
              p.apellido||', '||p.nombre apynom
              FROM sgr.persona p
              LEFT JOIN sgr.tipo_doc td ON p.id_tipo_doc = td.id_tipo_doc
              LEFT JOIN sgr.entidad e ON p.id_entidad = e.id_entidad
              LEFT JOIN sgr.sector se ON p.id_sector = se.id_sector
              LEFT JOIN sgr.dpto dp ON se.id_dpto = dp.id_dpto
              LEFT JOIN sgr.sucursal s ON dp.id_sucursal = s.id_sucursal
              LEFT JOIN sgr.domicilio d ON p.id_persona = d.id_persona
              LEFT JOIN sgr.ciudad ci ON d.id_ciudad = ci.id_ciudad
              LEFT JOIN sgr.provincia pro ON ci.id_provincia = pro.id_provincia
              LEFT JOIN sgr.pais pa ON pro.id_pais = pa.id_pais
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
