<?php

class dao_personas_popup
{
    static function get_datospersona($id_persona)
    {
      $sql = "SELECT p.id_persona, p.apellido, p.nombre, p.dni, p.fnac, g.nombre genero,
              e.razonsocial entidad,
              s.nombre sucursal, dp.nombre dpto, r.nombre rol,
              n.nombre nacionalidad, ec.nombre ecivil
              FROM sgr.persona p
              LEFT JOIN sgr.genero g ON p.id_genero = g.id_genero
              LEFT JOIN sgr.entidad e ON p.id_entidad = e.id_entidad
              LEFT JOIN sgr.sucursal s ON p.id_sucursal = s.id_sucursal
              LEFT JOIN sgr.dpto dp ON p.id_dpto = dp.id_dpto
              LEFT JOIN sgr.rol r ON p.id_rol = r.id_rol
              LEFT JOIN sgr.nacionalidad n ON p.id_nacionalidad = n.id_nacionalidad
              LEFT JOIN sgr.estadocivil ec ON p.id_estadocivil = ec.id_estadocivil
              WHERE p.id_persona = $id_persona";
      $resultado = consultar_fuente($sql);
      return $resultado[0];
    }

    static function get_datosdom($id_persona)
    {
      $sql = "SELECT
              d.barrio, d.calle, d.num, d.piso, c.nombre||', '||pro.nombre||', '||pa.nombre localidad
              FROM sgr.domicilio d
              LEFT JOIN sgr.ciudad c ON d.id_ciudad = c.id_ciudad
              LEFT JOIN sgr.pais pa ON d.id_pais = pa.id_pais
              LEFT JOIN sgr.provincia pro ON d.id_provincia = pro.id_provincia
              WHERE d.id_persona = $id_persona";
      $resultado = consultar_fuente($sql);
      if(count($resultado)>0)
      {
        return $resultado[0];
      }
      else {
        return [];
      }
    }

    static function get_datostel($id_persona)
    {
      $sql = "SELECT tt.nombre tipo, c.nombre compania, t.numero, t.interno
              FROM sgr.telefono t
              LEFT JOIN sgr.tipotel tt ON t.id_tipotel = tt.id_tipotel
              LEFT JOIN sgr.compania c ON t.id_compania = c.id_compania
              WHERE t.id_persona = $id_persona";
      $resultado = consultar_fuente($sql);
      if(count($resultado)>0)
      {
        return $resultado[0];
      }
      else {
        return [];
      }
    }

    static function get_datoscorreo($id_persona)
    {
      $sql = "SELECT tc.nombre tipocorreo, c.correo
              FROM sgr.correo c
              LEFT JOIN sgr.tipocorreo tc ON c.id_tipocorreo = tc.id_tipocorreo
              WHERE c.id_persona = $id_persona";
      $resultado = consultar_fuente($sql);
      if(count($resultado)>0)
      {
        return $resultado[0];
      }
      else {
        return [];
      }
    }

}
?>
