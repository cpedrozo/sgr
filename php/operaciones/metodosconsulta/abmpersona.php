<?php

class abmpersona
{

  //////////////////////////////////////////////////////////////////////////////
  /////////// DATOS PERSONA ////////////////////////////////////////////////////
  //////////////////////////////////////////////////////////////////////////////

  static function get_descPopUpEntidad($id_entidad)
  {
    $id_entidad = quote($id_entidad);
    $sql = "SELECT e.razonsocial
            	FROM sgr.entidad e
             WHERE e.id_entidad = $id_entidad";
    $resultado = consultar_fuente($sql);
    if (count($resultado) > 0) {
      return $resultado[0]['razonsocial'];
    } else {
      return 'Falló, intente nuevamente';
    }
  }

  static function get_nacionalidad()
  {
  $sql = "SELECT * FROM sgr.nacionalidad ORDER BY nombre asc";
  $datos = consultar_fuente($sql);
  return $datos;
  }

  static function get_tipo_doc()
  {
  $sql = "SELECT * FROM sgr.tipo_doc ORDER BY nombre asc";
  $datos = consultar_fuente($sql);
  return $datos;
  }

  static function get_ecivil()
  {
  $sql = "SELECT * FROM sgr.estadocivil ORDER BY nombre asc";
  $datos = consultar_fuente($sql);
  return $datos;
  }

  static function get_genero()
  {
  $sql = "SELECT * FROM sgr.genero ORDER BY nombre asc";
  $datos = consultar_fuente($sql);
  return $datos;
  }

  static function get_sucursal()
  {
  $sql = "SELECT * FROM sgr.sucursal ORDER BY nombre asc";
  $datos = consultar_fuente($sql);
  return $datos;
  }

  static function get_dpto()
  {
  $sql = "SELECT * FROM sgr.dpto ORDER BY nombre asc";
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

  static function get_camposempleado()
  {
    $sql = "SELECT * FROM sgr.camposempleado ORDER BY nombre asc";
    $datos = consultar_fuente($sql);
    return $datos;
  }

  static function get_rol()
  {
    $sql = "SELECT * FROM sgr.rol ORDER BY nombre asc";
    $datos = consultar_fuente($sql);
    return $datos;
  }

}
?>
