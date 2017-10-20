<?php

class dao_historicoregistro
{
  static function get_datossinfiltro($where='')
  {
    if ($where) {
      $where_armado = "WHERE $where";
    } else {
      $where_armado = '';
    }

    $sql = "SELECT r.id_registro, te.nombre ||': '|| e.nombre ||' - '|| wf.nombre tipoevento_y_wf, r.nombre, r.get_usuario, r.fecha_fin
            FROM sgr.registro r
            INNER JOIN sgr.workflow wf on wf.id_workflow = r.id_workflow
            INNER JOIN sgr.evento e ON e.id_evento = wf.id_evento
            INNER JOIN sgr.tipo_evento te ON e.id_tipoevento = te.id_tipoevento
            WHERE r.fecha_fin is null
            ORDER BY tipoevento_y_wf ASC
            limit 10";

    $resultado = consultar_fuente($sql);
    return $resultado;
  }

  static function get_datos($where='')
  {
    if ($where) {
      $where_armado = "WHERE $where";
    } else {
      $where_armado = '';
    }

    $sql = "SELECT r.id_registro, te.nombre ||': '|| e.nombre ||' - '|| wf.nombre tipoevento_y_wf, r.nombre, r.get_usuario, to_char(r.fecha_fin::TIMESTAMP, 'DD / MM / YYYY HH24:MI:SS') fecha_fin
            FROM sgr.registro r
            INNER JOIN sgr.workflow wf on wf.id_workflow = r.id_workflow
            INNER JOIN sgr.evento e ON e.id_evento = wf.id_evento
            INNER JOIN sgr.tipo_evento te ON e.id_tipoevento = te.id_tipoevento
            $where_armado
            ORDER BY tipoevento_y_wf ASC";

    $resultado = consultar_fuente($sql);
    return $resultado;
  }
}
?>
