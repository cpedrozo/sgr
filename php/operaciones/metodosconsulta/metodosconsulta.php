<?php

class metodosconsulta
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

  static function get_prov_pais($id_pais='')
  {
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

  static function get_ciudad_prov($id_provincia='')
  {
    $sql = "SELECT * FROM sgr.ciudad
            WHERE id_provincia = $id_provincia
            ORDER BY nombre ASC";
    $resultado = consultar_fuente($sql);
    return $resultado;
  }

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

  static function get_dpto_suc($id_sucursal='')
  {
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
/////////// OPERACIONES //////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////

  static function get_entidades()
  {
    $sql = "SELECT * FROM sgr.entidad ORDER BY razonsocial asc";
    $datos = consultar_fuente($sql);
    return $datos;
  }

  static function get_entidad_propietario()
  {
    $sql = "SELECT * FROM sgr.entidad
    WHERE propietario = 'true'
    ORDER BY razonsocial asc";
    $datos = consultar_fuente($sql);
    return $datos;
  }

  static function get_estados()
  {
    $sql = "SELECT * FROM sgr.estado ORDER BY nombre asc";
    $datos = consultar_fuente($sql);
    return $datos;
  }

  static function get_flujos()
  {
    $sql = "SELECT * FROM sgr.flujo";// ORDER BY nombre asc;
    $datos = consultar_fuente($sql);
    return $datos;
  }

  static function get_flujo_evento()
  {
    $sql = "SELECT * FROM sgr.flujo_evento ORDER BY nombre asc";
    $datos = consultar_fuente($sql);
    return $datos;
  }

  static function get_eventos()
  {
    $sql = "SELECT * FROM sgr.evento ORDER BY nombre asc";
    $datos = consultar_fuente($sql);
    return $datos;
  }

  static function get_personas()
  {
    $sql = "SELECT * FROM sgr.persona ORDER BY apellido, nombre asc";
    $datos = consultar_fuente($sql);
    return $datos;
  }

  static function get_tipoevento()
  {
    $sql = "SELECT * FROM sgr.tipo_evento ORDER BY nombre asc";
    $datos = consultar_fuente($sql);
    return $datos;
  }

  static function get_evento_tipo($id_tipoevento='')
  {
    $sql = "SELECT * FROM sgr.evento
            WHERE id_tipoevento = $id_tipoevento
            ORDER BY nombre ASC";
    $resultado = consultar_fuente($sql);
    return $resultado;
  }


}
?>
