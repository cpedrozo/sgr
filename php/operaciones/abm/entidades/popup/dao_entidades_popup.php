<?php

class dao_entidades_popup
{
    static function get_datosentidad($id_entidad)
    {
      $sql = "SELECT e.id_entidad, e.razonsocial, e.cuit, case when e.propietario then 'Si' else 'No' end propietario
          		FROM sgr.entidad e
              WHERE e.id_entidad = $id_entidad";
      $resultado = consultar_fuente($sql);
      if(count($resultado)>0)
      {
        return $resultado[0];
      }
      else {
        return [];
      }
    }

    /////////////////////////////////////////////////////////////////////////////
    /////////cuadros ////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////

    static function get_datosdom2($id_entidad)
    {
      $sql = "SELECT
              d.id_domicilio,
              d.calle||': '||d.num||' ('||d.barrio||')' dir, d.piso, ci.nombre||', '||pro.nombre||' - '||pa.nombre localidad
              FROM sgr.domicilio d
              LEFT JOIN sgr.ciudad ci ON d.id_ciudad = ci.id_ciudad
              LEFT JOIN sgr.provincia pro ON ci.id_provincia = pro.id_provincia
              LEFT JOIN sgr.pais pa ON pro.id_pais = pa.id_pais
              LEFT JOIN sgr.entidad e ON d.id_entidad = e.id_entidad
              WHERE d.id_entidad = $id_entidad";
      $resultado = consultar_fuente($sql);
      return $resultado;
    }

    static function get_datostel2($id_entidad)
    {
      $sql = "SELECT
              t.id_telefono, tt.nombre||': '||c.nombre tipoycompania, t.numero||' ('||coalesce(t.interno, '-')||')' num
              FROM sgr.telefono t
              LEFT JOIN sgr.tipotel tt ON t.id_tipotel = tt.id_tipotel
              LEFT JOIN sgr.compania c ON t.id_compania = c.id_compania
              LEFT JOIN sgr.entidad e ON t.id_entidad = e.id_entidad
              WHERE t.id_entidad = $id_entidad";
      $resultado = consultar_fuente($sql);
      return $resultado;
    }

    static function get_datoscorreo2($id_entidad)
    {
      $sql = "SELECT
              c.id_correo, tc.nombre tipocorreo, c.correo
              FROM sgr.correo c
              LEFT JOIN sgr.tipocorreo tc ON c.id_tipocorreo = tc.id_tipocorreo
              LEFT JOIN sgr.entidad e ON c.id_entidad = e.id_entidad
              WHERE c.id_entidad = $id_entidad";
      $resultado = consultar_fuente($sql);
      return $resultado;
    }

}
?>
