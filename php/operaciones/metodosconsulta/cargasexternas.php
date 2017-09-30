<?php

class cargasexternas
{

  //////////////////////////////////////////////////////////////////////////////
  /////////// CARGA EXTERNA PROVINCIA, PAIS/////////////////////////////////////
  //////////////////////////////////////////////////////////////////////////////

  static function get_idextdomicilio($id_ciudad)
  {
    $id_ciudad = quote($id_ciudad);

    $sql = "SELECT pr.id_pais,
            pr.id_provincia
            FROM sgr.provincia pr
            JOIN sgr.ciudad ci ON ci.id_provincia = pr.id_provincia
            WHERE ci.id_ciudad = $id_ciudad";
    $resultado = consultar_fuente($sql);
    return $resultado[0];
  }

  //////////////////////////////////////////////////////////////////////////////
  /////////// carga externa tipo evento ////////////////////////////////////////
  //////////////////////////////////////////////////////////////////////////////

  static function get_idexttipoevento($id_evento)
  {
    $id_evento = quote($id_evento);

    $sql = "SELECT e.id_tipoevento
            FROM sgr.evento e
            WHERE e.id_evento = $id_evento";
    $resultado = consultar_fuente($sql);
    return $resultado[0];
  }

  //////////////////////////////////////////////////////////////////////////////
  /////////// carga externa Workflow ///////////////////////////////////////////
  //////////////////////////////////////////////////////////////////////////////

  static function get_idextworkflow($id_workflow)
  {
    $id_workflow = quote($id_workflow);

    $sql = "SELECT e.id_tipoevento,
            e.id_evento
            FROM sgr.evento e
            JOIN sgr.workflow wf ON wf.id_evento = e.id_evento
            WHERE wf.id_workflow = $id_workflow";
    $resultado = consultar_fuente($sql);
    return $resultado[0];
  }

  //////////////////////////////////////////////////////////////////////////////
  /////////// carga externa Requisitos /////////////////////////////////////////
  //////////////////////////////////////////////////////////////////////////////

  static function get_detalle_ext_requisitos($id_requisitos, $id_estadoorigen, $id_estadodestino, $id_workflow)
  {
    $id_estadodestino = quote($id_estadodestino);
    $id_estadoorigen = quote($id_estadoorigen);
    $id_requisitos = quote($id_requisitos);
    $id_workflow = quote($id_workflow);

    $sql = "SELECT nombre, CASE WHEN obligatorio then 'Si' else 'No' end obligatorio
            FROM sgr.requisitos
            WHERE id_workflow = $id_workflow
            AND id_estadoorigen = $id_estadoorigen
            AND id_estadodestino = $id_estadodestino
            AND id_requisitos = $id_requisitos";
    $resultado = consultar_fuente($sql);
    return $resultado;
  }

  //////////////////////////////////////////////////////////////////////////////
  /////////// carga externa Estado Actual //////////////////////////////////////
  //////////////////////////////////////////////////////////////////////////////

  static function get_estadoactual($id_estado)
  {
    $id_estado = quote($id_estado);

    $sql = "SELECT id_estado, nombre
            FROM sgr.estado
            WHERE id_estado = $id_estado";
    $resultado = consultar_fuente($sql);
    return $resultado;
  }

}
?>
