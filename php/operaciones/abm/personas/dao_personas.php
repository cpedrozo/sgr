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

      $sql = "SELECT p.id_persona, ce.nombre esempleado,
              td.nombre||': '||p.doc documento,
              e.razonsocial entidad,
              dp.nombre||' - '||se.nombre||' ('||s.nombre||')' suc_dpto,
              ci.nombre||', '||pro.nombre||' - '||pa.nombre localidad,
              coalesce(p.legajo, '0')||': '||p.apellido||', '||p.nombre apynom
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
              LEFT JOIN sgr.camposempleado ce ON p.id_camposempleado = ce.id_camposempleado
              ORDER BY p.apellido, p.nombre, suc_dpto ASC
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

      $sql = "SELECT p.id_persona, ce.nombre esempleado,
              td.nombre||': '||p.doc documento,
              e.razonsocial entidad,
              dp.nombre||' - '||se.nombre||' ('||s.nombre||')' suc_dpto,
              ci.nombre||', '||pro.nombre||' - '||pa.nombre localidad,
              coalesce(p.legajo, '0')||': '||p.apellido||', '||p.nombre apynom
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
              LEFT JOIN sgr.camposempleado ce ON p.id_camposempleado = ce.id_camposempleado
              $where_armado ORDER BY p.apellido, p.nombre, suc_dpto ASC";

      $resultado = consultar_fuente($sql);
      return $resultado;
    }

    static function get_tipotel($id_tipotel)
    {
      $sql = "SELECT id_tipotel, interno FROM sgr.tipotel
            where id_tipotel = $id_tipotel";
      $resultado = consultar_fuente($sql);
      if($resultado[0]['interno']==true)
      {
        return 'si';
      }
      else {
        return 'no';
      }
    }

    static function get_empleadobaja($id_persona)
    {
      $sql = "SELECT p.apellido||', '||p.nombre apynom, legajo, td.nombre tipodoc, doc, fnac, g.nombre genero, r.nombre rol, s.nombre sector, n.nombre nacionalidad, ec.nombre ecivil, e.razonsocial entidad
              FROM sgr.persona p
              LEFT JOIN sgr.tipo_doc td ON p.id_tipo_doc = td.id_tipo_doc
              LEFT JOIN sgr.genero g ON p.id_genero = g.id_genero
              LEFT JOIN sgr.rol r ON p.id_rol = r.id_rol
              LEFT JOIN sgr.sector s ON p.id_sector = s.id_sector
              LEFT JOIN sgr.nacionalidad n ON p.id_nacionalidad = n.id_nacionalidad
              LEFT JOIN sgr.estadocivil ec ON p.id_estadocivil = ec.id_estadocivil
              LEFT JOIN sgr.entidad e ON p.id_entidad = e.id_entidad
              WHERE id_persona = $id_persona";
      $resultado = consultar_fuente($sql);
      return $resultado[0];
    }

    static function get_correorrhh()
    {
      $sql = "SELECT correo
              FROM sgr.notificaciones
              WHERE nombre like '%EMPLEADOS%'";
      $resultado = consultar_fuente($sql);
      return $resultado[0]['correo'];
    }

    static function esempleado($id_persona)
    {
      $sql = "SELECT id_camposempleado
              FROM sgr.persona
              WHERE id_persona = $id_persona";
      $resultado = consultar_fuente($sql);
      return $resultado[0]['id_camposempleado'] == 1;
    }

}
?>
