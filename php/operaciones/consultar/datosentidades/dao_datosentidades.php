<?php

class dao_datosentidades
{
  static function get_datostel($where='')
  {
    if ($where) {
      $where_armado = "WHERE $where";
    } else {
      $where_armado = '';
    }
    $sql = "SELECT e.razonsocial||': '||e.cuit entidad,
            t.id_telefono, tt.nombre||': '||c.nombre tipoycompania, t.numero||coalesce('('||t.interno||')', '') num
            FROM sgr.telefono t
            LEFT JOIN sgr.tipotel tt ON t.id_tipotel = tt.id_tipotel
            LEFT JOIN sgr.compania c ON t.id_compania = c.id_compania
            LEFT JOIN sgr.entidad e ON t.id_entidad = e.id_entidad
            $where_armado AND t.id_entidad IS NOT NULL
            ORDER BY entidad ASC";
    $resultado = consultar_fuente($sql);
    return $resultado;
  }

  static function get_datossinfiltrotel($where='')
  {
    if ($where) {
      $where_armado = "WHERE $where";
    } else {
      $where_armado = '';
    }
    $sql = "SELECT e.razonsocial||': '||e.cuit entidad,
            t.id_telefono, tt.nombre||': '||c.nombre tipoycompania, t.numero||coalesce('('||t.interno||')', '') num
            FROM sgr.telefono t
            LEFT JOIN sgr.tipotel tt ON t.id_tipotel = tt.id_tipotel
            LEFT JOIN sgr.compania c ON t.id_compania = c.id_compania
            LEFT JOIN sgr.entidad e ON t.id_entidad = e.id_entidad
            WHERE t.id_entidad IS NOT NULL
            ORDER BY entidad ASC
            LIMIT 10";
    $resultado = consultar_fuente($sql);
    return $resultado;
  }

  static function get_datosdom($where='')
  {
    if ($where) {
      $where_armado = "WHERE $where";
    } else {
      $where_armado = '';
    }
    $sql = "SELECT e.razonsocial||': '||e.cuit entidad,
            d.id_domicilio,
            d.calle||': '||d.num||' ('||d.barrio||')' dir, d.piso, ci.nombre||', '||pro.nombre||' - '||pa.nombre localidad
            FROM sgr.domicilio d
            LEFT JOIN sgr.ciudad ci ON d.id_ciudad = ci.id_ciudad
            LEFT JOIN sgr.provincia pro ON ci.id_provincia = pro.id_provincia
            LEFT JOIN sgr.pais pa ON pro.id_pais = pa.id_pais
            LEFT JOIN sgr.entidad e ON d.id_entidad = e.id_entidad
            $where_armado AND d.id_entidad IS NOT NULL
            ORDER BY entidad, localidad ASC";
    $resultado = consultar_fuente($sql);
    return $resultado;
  }

  static function get_datossinfiltrodom($where='')
  {
    if ($where) {
      $where_armado = "WHERE $where";
    } else {
      $where_armado = '';
    }
    $sql = "SELECT e.razonsocial||': '||e.cuit entidad,
            d.id_domicilio,
            d.calle||': '||d.num||' ('||d.barrio||')' dir, d.piso, ci.nombre||', '||pro.nombre||' - '||pa.nombre localidad
            FROM sgr.domicilio d
            LEFT JOIN sgr.ciudad ci ON d.id_ciudad = ci.id_ciudad
            LEFT JOIN sgr.provincia pro ON ci.id_provincia = pro.id_provincia
            LEFT JOIN sgr.pais pa ON pro.id_pais = pa.id_pais
            LEFT JOIN sgr.entidad e ON d.id_entidad = e.id_entidad
            WHERE d.id_entidad IS NOT NULL
            ORDER BY entidad, localidad ASC
            LIMIT 10";
    $resultado = consultar_fuente($sql);
    return $resultado;
  }

  static function get_datoscorreo($where='')
  {
    if ($where) {
      $where_armado = "WHERE $where";
    } else {
      $where_armado = '';
    }
    $sql = "SELECT e.razonsocial||': '||e.cuit entidad,
            c.id_correo, tc.nombre tipocorreo, c.correo
            FROM sgr.correo c
            LEFT JOIN sgr.tipocorreo tc ON c.id_tipocorreo = tc.id_tipocorreo
            LEFT JOIN sgr.entidad e ON c.id_entidad = e.id_entidad
            $where_armado AND c.id_entidad IS NOT NULL
            ORDER BY entidad, tipocorreo ASC";
    $resultado = consultar_fuente($sql);
    return $resultado;
  }

  static function get_datossinfiltrocorreo($where='')
  {
    if ($where) {
      $where_armado = "WHERE $where";
    } else {
      $where_armado = '';
    }
    $sql = "SELECT e.razonsocial||': '||e.cuit entidad,
            c.id_correo, tc.nombre tipocorreo, c.correo
            FROM sgr.correo c
            LEFT JOIN sgr.tipocorreo tc ON c.id_tipocorreo = tc.id_tipocorreo
            LEFT JOIN sgr.entidad e ON c.id_entidad = e.id_entidad
            WHERE c.id_entidad IS NOT NULL
            ORDER BY entidad, tipocorreo ASC
            LIMIT 10";
    $resultado = consultar_fuente($sql);
    return $resultado;
  }

}
?>
