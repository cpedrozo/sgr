<?php

class operaciones
{

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

  static function get_estado_inicial()
  {
    $sql = "SELECT * FROM sgr.estado
    WHERE inicio = true
    ORDER BY nombre asc";
    $datos = consultar_fuente($sql);
    return $datos;
  }

  static function get_flujos()
  {
    $sql = "SELECT * FROM sgr.flujo";// ORDER BY nombre asc;
    $datos = consultar_fuente($sql);
    return $datos;
  }

  static function get_flujo_trabajo($id_evento) //ci_nuevoregistro - form (toba), seleccionar flujo de trabajo para un alta de registro.
  {
    $id_evento = quote ($id_evento);
    $sql = "SELECT * FROM sgr.workflow
            WHERE id_evento = $id_evento
            ORDER BY nombre ASC";
    $resultado = consultar_fuente($sql);
    return $resultado;
  }

  static function get_workflow()
  {
    $sql = "SELECT * FROM sgr.workflow ORDER BY nombre asc";
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

  static function get_evento_tipo($id_tipoevento)
  {
    $id_tipoevento = quote ($id_tipoevento);
    $sql = "SELECT * FROM sgr.evento
            WHERE id_tipoevento = $id_tipoevento
            ORDER BY nombre ASC";
    $resultado = consultar_fuente($sql);
    return $resultado;
  }

  static function get_usuarios()
  {
    $resultado = toba::instancia()->get_lista_usuarios();
    foreach ($resultado as $key => $value) {
      $resultado[$key]['user'] = $value['usuario'].': '.$value['nombre'];
    }
    return $resultado;
  }

}
?>
