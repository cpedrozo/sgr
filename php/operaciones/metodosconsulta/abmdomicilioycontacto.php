<?php

class abmdomicilioycontacto
{

  //////////////////////////////////////////////////////////////////////////////
  /////////// DOMICILIO ////////////////////////////////////////////////////////
  //////////////////////////////////////////////////////////////////////////////

  static function get_pais()
  {
  $sql = "SELECT * FROM sgr.pais ORDER BY nombre asc";
  $datos = consultar_fuente($sql);
  return $datos;
  }

  static function get_prov()
  {
  $sql = "SELECT * FROM sgr.provincia ORDER BY nombre asc";
  $datos = consultar_fuente($sql);
  return $datos;
  }

  static function get_prov_pais($id_pais)
  {
    $id_pais = quote ($id_pais);
    $sql = "SELECT * FROM sgr.provincia
            WHERE id_pais = $id_pais
            ORDER BY nombre ASC";
    $resultado = consultar_fuente($sql);
    return $resultado;
  }

  static function get_ciudad()
  {
  $sql = "SELECT * FROM sgr.ciudad ORDER BY nombre asc";
  $datos = consultar_fuente($sql);
  return $datos;
  }

  static function get_ciudad_prov($id_provincia)
  {
    $id_provincia = quote ($id_provincia);
    $sql = "SELECT * FROM sgr.ciudad
            WHERE id_provincia = $id_provincia
            ORDER BY nombre ASC";
    $resultado = consultar_fuente($sql);
    return $resultado;
  }

  //////////////////////////////////////////////////////////////////////////////
  /////////// CONTACTO /////////////////////////////////////////////////////////
  //////////////////////////////////////////////////////////////////////////////

  static function get_tipocorreo()
  {
  $sql = "SELECT * FROM sgr.tipocorreo ORDER BY nombre asc";
  $datos = consultar_fuente($sql);
  return $datos;
  }

  static function get_tipotel()
  {
  $sql = "SELECT * FROM sgr.tipotel ORDER BY nombre asc";
  $datos = consultar_fuente($sql);
  return $datos;
  }

  static function get_compania()
  {
  $sql = "SELECT * FROM sgr.compania ORDER BY nombre asc";
  $datos = consultar_fuente($sql);
  return $datos;
  }

  //////////////////////////////////////////////////////////////////////////////
  /////////// DEPTO - SUCURSAL /////////////////////////////////////////////////
  //////////////////////////////////////////////////////////////////////////////

  static function get_sucursal()
  {
  $sql = "SELECT * FROM sgr.sucursal ORDER BY nombre asc";
  $datos = consultar_fuente($sql);
  return $datos;
  }

  static function get_dpto_suc($id_sucursal)
  {
    $id_sucursal = quote ($id_sucursal);
    $sql = "SELECT * FROM sgr.dpto
            WHERE id_sucursal = $id_sucursal
            ORDER BY nombre ASC";
    $resultado = consultar_fuente($sql);
    return $resultado;
  }

  static function get_dpto()
  {
  $sql = "SELECT * FROM sgr.dpto ORDER BY nombre asc";
  $datos = consultar_fuente($sql);
  return $datos;
  }
}
?>
