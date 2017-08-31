<?php

class flujosyregistros
{

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
  /////////// estados y registros //////////////////////////////////////////////
  //////////////////////////////////////////////////////////////////////////////

  static function get_estadodestino($id_estadoorigen, $id_workflow) //ci_nuevoregistro.php con ajax para mostrar posibles estados destino.
  {
  $id_estadoorigen = quote ($id_estadoorigen);
  $id_worfklow = quote ($id_workflow);
  $sql = "SELECT f.id_workflow, fe.nombre idorigen, fe2.id_estado iddestino, fe2.nombre nombredestino, f.orden
          FROM sgr.flujo f
          INNER JOIN sgr.estado fe ON f.id_estadoorigen = fe.id_estado
          INNER JOIN sgr.estado fe2 ON f.id_estadodestino = fe2.id_estado
          WHERE id_estadoorigen = $id_estadoorigen
          AND id_workflow = $id_worfklow ORDER BY orden asc";
  $datos = consultar_fuente($sql);
  return $datos;
  }

  static function get_requisitosxestado($id_estadoorigen, $id_estadodestino, $id_workflow) //form_workflow.php con ajax para mostrar requisitos.
  {
  $id_estadoorigen = quote ($id_estadoorigen);
  $id_estadodestino = quote ($id_estadodestino);
  $id_worfklow = quote ($id_workflow);
  $sql = "SELECT r.id_requisitos, r.id_estadoorigen, r.id_estadodestino, r.id_workflow, r.nombre, r.orden, r.persona, r.obligatorio
          FROM sgr.requisitos r
          WHERE r.id_estadoorigen = $id_estadoorigen
          AND r.id_estadodestino = $id_estadodestino
          AND r.id_workflow = $id_worfklow ORDER BY orden asc";
  $datos = consultar_fuente($sql);
  return $datos;
  }

  static function get_requisitosxestadoNuevo($id_estadodestino, $id_workflow) //form_workflow.php con ajax para mostrar requisitos.
  {
  $sql = "SELECT id_estado
          FROM sgr.estado
          WHERE inicio = TRUE";
  $datos = consultar_fuente($sql);

  return self::get_requisitosxestado($datos[0]['id_estado'],$id_estadodestino, $id_workflow);
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

  static function get_personaboolean($id_requisitos) //ci_nuevoregistro.php con ajax para mostrar el campo persona.
  {
    $sql = "SELECT id_requisitos, obligatorio, persona FROM sgr.requisitos
          where id_requisitos = $id_requisitos";
    $resultado = consultar_fuente($sql);
    if($resultado[0]['persona']==true)
    {
      return 'si';
    }
    else {
      return 'no';
    }
  }

}
?>
