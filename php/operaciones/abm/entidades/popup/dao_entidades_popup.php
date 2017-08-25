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

    static function get_datosdom($id_entidad)
    {
      $sql = "SELECT
              d.barrio, d.calle, d.num, d.piso, ci.nombre||', '||pro.nombre||', '||pa.nombre localidad
              FROM sgr.domicilio d
              LEFT JOIN sgr.ciudad ci ON d.id_ciudad = ci.id_ciudad
        			LEFT JOIN sgr.provincia pro ON ci.id_provincia = pro.id_provincia
        			LEFT JOIN sgr.pais pa ON pro.id_pais = pa.id_pais
              WHERE d.id_entidad = $id_entidad";
      $resultado = consultar_fuente($sql);
      if(count($resultado)>0)
      {
        return $resultado[0];
      }
      else {
        return [];
      }
    }

    static function get_datostel($id_entidad)
    {
      $sql = "SELECT tt.nombre tipo, c.nombre compania, t.numero, t.interno
              FROM sgr.telefono t
              LEFT JOIN sgr.tipotel tt ON t.id_tipotel = tt.id_tipotel
              LEFT JOIN sgr.compania c ON t.id_compania = c.id_compania
              WHERE t.id_entidad = $id_entidad";
      $resultado = consultar_fuente($sql);
      if(count($resultado)>0)
      {
        return $resultado[0];
      }
      else {
        return [];
      }
    }

    static function get_datoscorreo($id_entidad)
    {
      $sql = "SELECT tc.nombre tipocorreo, c.correo
              FROM sgr.correo c
              LEFT JOIN sgr.tipocorreo tc ON c.id_tipocorreo = tc.id_tipocorreo
              WHERE c.id_entidad = $id_entidad";
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
