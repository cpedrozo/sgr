<?php

class dao_agenda
{
  static function get_datostel($where='')
  {
    if ($where) {
      $where_armado = "WHERE $where";
    } else {
      $where_armado = '';
    }
    $sql = "SELECT p.apellido||', '||p.nombre apynom,
            t.id_telefono, tt.nombre tipo, c.nombre compania, t.numero, t.interno,
            se.nombre sector, dp.nombre dpto, su.nombre sucursal
            FROM sgr.telefono t
            LEFT JOIN sgr.tipotel tt ON t.id_tipotel = tt.id_tipotel
            LEFT JOIN sgr.compania c ON t.id_compania = c.id_compania
            LEFT JOIN sgr.persona p ON t.id_persona = p.id_persona
            LEFT JOIN sgr.sector se ON p.id_sector = se.id_sector
            LEFT JOIN sgr.dpto dp ON se.id_dpto = dp.id_dpto
            LEFT JOIN sgr.sucursal su ON dp.id_sucursal = su.id_sucursal
            $where_armado AND t.id_persona IS NOT NULL
            ORDER BY apynom, tipo, compania ASC";
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
    $sql = "SELECT p.apellido||', '||p.nombre apynom,
            t.id_telefono, tt.nombre tipo, c.nombre compania, t.numero, t.interno,
            se.nombre sector, dp.nombre dpto, su.nombre sucursal
            FROM sgr.telefono t
            LEFT JOIN sgr.tipotel tt ON t.id_tipotel = tt.id_tipotel
            LEFT JOIN sgr.compania c ON t.id_compania = c.id_compania
            LEFT JOIN sgr.persona p ON t.id_persona = p.id_persona
            LEFT JOIN sgr.sector se ON p.id_sector = se.id_sector
            LEFT JOIN sgr.dpto dp ON se.id_dpto = dp.id_dpto
            LEFT JOIN sgr.sucursal su ON dp.id_sucursal = su.id_sucursal
            $where_armado AND t.id_persona IS NOT NULL
            ORDER BY apynom, tipo, compania ASC
            LIMIT 5";
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
    $sql = "SELECT p.apellido||', '||p.nombre apynom,
            d.id_domicilio,
            d.barrio, d.calle, d.num, d.piso, ci.nombre||', '||pro.nombre||', '||pa.nombre localidad,
            se.nombre sector, dp.nombre dpto, su.nombre sucursal
            FROM sgr.domicilio d
            LEFT JOIN sgr.ciudad ci ON d.id_ciudad = ci.id_ciudad
            LEFT JOIN sgr.provincia pro ON ci.id_provincia = pro.id_provincia
            LEFT JOIN sgr.pais pa ON pro.id_pais = pa.id_pais
            LEFT JOIN sgr.persona p ON d.id_persona = p.id_persona
            LEFT JOIN sgr.sector se ON p.id_sector = se.id_sector
            LEFT JOIN sgr.dpto dp ON se.id_dpto = dp.id_dpto
            LEFT JOIN sgr.sucursal su ON dp.id_sucursal = su.id_sucursal
            $where_armado AND d.id_persona IS NOT NULL
            ORDER BY apynom, localidad ASC";
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
    $sql = "SELECT p.apellido||', '||p.nombre apynom,
            d.id_domicilio,
            d.barrio, d.calle, d.num, d.piso, ci.nombre||', '||pro.nombre||', '||pa.nombre localidad,
            se.nombre sector, dp.nombre dpto, su.nombre sucursal
            FROM sgr.domicilio d
            LEFT JOIN sgr.ciudad ci ON d.id_ciudad = ci.id_ciudad
            LEFT JOIN sgr.provincia pro ON ci.id_provincia = pro.id_provincia
            LEFT JOIN sgr.pais pa ON pro.id_pais = pa.id_pais
            LEFT JOIN sgr.persona p ON d.id_persona = p.id_persona
            LEFT JOIN sgr.sector se ON p.id_sector = se.id_sector
            LEFT JOIN sgr.dpto dp ON se.id_dpto = dp.id_dpto
            LEFT JOIN sgr.sucursal su ON dp.id_sucursal = su.id_sucursal
            $where_armado AND d.id_persona IS NOT NULL
            ORDER BY apynom, localidad ASC
            LIMIT 5";
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
    $sql = "SELECT p.apellido||', '||p.nombre apynom,
            c.id_correo, tc.nombre tipocorreo, c.correo,
            se.nombre sector, dp.nombre dpto, su.nombre sucursal
            FROM sgr.correo c
            LEFT JOIN sgr.tipocorreo tc ON c.id_tipocorreo = tc.id_tipocorreo
            LEFT JOIN sgr.persona p ON c.id_persona = p.id_persona
            LEFT JOIN sgr.sector se ON p.id_sector = se.id_sector
            LEFT JOIN sgr.dpto dp ON se.id_dpto = dp.id_dpto
            LEFT JOIN sgr.sucursal su ON dp.id_sucursal = su.id_sucursal
            $where_armado AND c.id_persona IS NOT NULL
            ORDER BY apynom, tipocorreo ASC";
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
    $sql = "SELECT p.apellido||', '||p.nombre apynom,
            c.id_correo, tc.nombre tipocorreo, c.correo,
            se.nombre sector, dp.nombre dpto, su.nombre sucursal
            FROM sgr.correo c
            LEFT JOIN sgr.tipocorreo tc ON c.id_tipocorreo = tc.id_tipocorreo
            LEFT JOIN sgr.persona p ON c.id_persona = p.id_persona
            LEFT JOIN sgr.sector se ON p.id_sector = se.id_sector
            LEFT JOIN sgr.dpto dp ON se.id_dpto = dp.id_dpto
            LEFT JOIN sgr.sucursal su ON dp.id_sucursal = su.id_sucursal
            $where_armado AND c.id_persona IS NOT NULL
            ORDER BY apynom, tipocorreo ASC
            LIMIT 5";
    $resultado = consultar_fuente($sql);
    return $resultado;
  }

}
?>
