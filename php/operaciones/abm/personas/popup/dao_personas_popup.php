<?php

class dao_personas_popup
{
    static function get_datospersona($id_persona)
    {
      $sql = "SELECT p.id_persona,
              coalesce(p.legajo, '0')||': '||p.apellido||', '||p.nombre apynom,
              td.nombre tipodoc, p.doc, p.fnac, g.nombre genero,
              e.razonsocial entidad,
              s.nombre sucursal, dp.nombre||' - '||se.nombre||' ('||s.nombre||')' dpto, r.nombre rol,
              n.nombre nacionalidad, ec.nombre ecivil
              FROM sgr.persona p
              LEFT JOIN sgr.tipo_doc td ON p.id_tipo_doc = td.id_tipo_doc
              LEFT JOIN sgr.genero g ON p.id_genero = g.id_genero
              LEFT JOIN sgr.entidad e ON p.id_entidad = e.id_entidad
              LEFT JOIN sgr.sector se ON p.id_sector = se.id_sector
              LEFT JOIN sgr.dpto dp ON se.id_dpto = dp.id_dpto
              LEFT JOIN sgr.sucursal s ON dp.id_sucursal = s.id_sucursal
              LEFT JOIN sgr.rol r ON p.id_rol = r.id_rol
              LEFT JOIN sgr.nacionalidad n ON p.id_nacionalidad = n.id_nacionalidad
              LEFT JOIN sgr.estadocivil ec ON p.id_estadocivil = ec.id_estadocivil
              WHERE p.id_persona = $id_persona";
      $resultado = consultar_fuente($sql);
      return $resultado[0];
    }

    /////////////////////////////////////////////////////////////////////////////
    /////////cuadros ////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////

    static function get_datosdom2($id_persona)
    {
      $sql = "SELECT
              d.id_domicilio,
              d.calle||': '||d.num||' ('||d.barrio||')' dir, d.piso, ci.nombre||', '||pro.nombre||' - '||pa.nombre localidad
              FROM sgr.domicilio d
              LEFT JOIN sgr.ciudad ci ON d.id_ciudad = ci.id_ciudad
              LEFT JOIN sgr.provincia pro ON ci.id_provincia = pro.id_provincia
              LEFT JOIN sgr.pais pa ON pro.id_pais = pa.id_pais
              LEFT JOIN sgr.persona p ON d.id_persona = p.id_persona
              WHERE d.id_persona = $id_persona";
      $resultado = consultar_fuente($sql);
      return $resultado;
    }

    static function get_datostel2($id_persona)
    {
      $sql = "SELECT
              t.id_telefono, tt.nombre||': '||c.nombre tipoycompania, t.numero||' ('||coalesce(t.interno, '-')||')' num
              FROM sgr.telefono t
              LEFT JOIN sgr.tipotel tt ON t.id_tipotel = tt.id_tipotel
              LEFT JOIN sgr.compania c ON t.id_compania = c.id_compania
              LEFT JOIN sgr.persona p ON t.id_persona = p.id_persona
              WHERE t.id_persona = $id_persona";
      $resultado = consultar_fuente($sql);
      return $resultado;
    }

    static function get_datoscorreo2($id_persona)
    {
      $sql = "SELECT
              c.id_correo, tc.nombre tipocorreo, c.correo
              FROM sgr.correo c
              LEFT JOIN sgr.tipocorreo tc ON c.id_tipocorreo = tc.id_tipocorreo
              LEFT JOIN sgr.persona p ON c.id_persona = p.id_persona
              WHERE c.id_persona = $id_persona";
      $resultado = consultar_fuente($sql);
      return $resultado;
    }

    /////////////////////////////////////////////////////////////////////////////
    /////////jasper_reports /////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////

    static function get_nombrearchivo($id_persona)
    {
      $sql = "SELECT apellido||'_'||nombre apynom
      FROM sgr.persona
      WHERE id_persona = $id_persona";
      $resultado = consultar_fuente($sql);
      return $resultado[0]['apynom'];
    }

}
?>
