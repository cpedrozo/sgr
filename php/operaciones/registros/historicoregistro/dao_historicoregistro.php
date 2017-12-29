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

    $sql = "SELECT r.id_registro, te.nombre ||': '|| e.nombre ||' - '|| wf.nombre tipoevento_y_wf, r.nombre, ea.get_usuario, r.fecha_fin
            FROM sgr.registro r
            INNER JOIN sgr.workflow wf on wf.id_workflow = r.id_workflow
            INNER JOIN sgr.evento e ON e.id_evento = wf.id_evento
            INNER JOIN sgr.tipo_evento te ON e.id_tipoevento = te.id_tipoevento
            JOIN sgr.estado_actual_flujo ea ON r.id_registro = ea.id_registro AND ea.activo
            WHERE r.fecha_fin is null
            ORDER BY tipoevento_y_wf ASC
            limit 30";

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

    $sql = "SELECT r.id_registro, te.nombre ||': '|| e.nombre ||' - '|| wf.nombre tipoevento_y_wf, r.nombre, ea.get_usuario, to_char(r.fecha_fin::TIMESTAMP, 'DD / MM / YYYY HH24:MI:SS') fecha_fin
            FROM sgr.registro r
            INNER JOIN sgr.workflow wf on wf.id_workflow = r.id_workflow
            INNER JOIN sgr.evento e ON e.id_evento = wf.id_evento
            INNER JOIN sgr.tipo_evento te ON e.id_tipoevento = te.id_tipoevento
            JOIN sgr.estado_actual_flujo ea ON r.id_registro = ea.id_registro AND ea.activo
            $where_armado
            ORDER BY tipoevento_y_wf ASC";

    $resultado = consultar_fuente($sql);
    return $resultado;
  }

  static function get_empleado_xreg($id_persona)
  {
    $sql = "SELECT p.id_persona, coalesce(p.legajo, '0')||': '||p.apellido||', '||p.nombre apynom, tc.nombre, c.correo
            FROM sgr.persona p
            LEFT JOIN sgr.correo c ON p.id_persona = c.id_persona
            LEFT JOIN sgr.tipocorreo tc ON c.id_tipocorreo = tc.id_tipocorreo
            WHERE p.id_persona = $id_persona
            ORDER BY tc.nombre ASC";
    $resultado = consultar_fuente($sql);
    return $resultado[0];
  }

  static function get_correo_empleado($id_persona)
  {
    $sql = "SELECT p.id_persona, tc.nombre tipo, c.correo
            FROM sgr.persona p
            LEFT JOIN sgr.correo c ON p.id_persona = c.id_persona
            LEFT JOIN sgr.tipocorreo tc ON c.id_tipocorreo = tc.id_tipocorreo
            WHERE p.id_persona = $id_persona";
    $resultado = consultar_fuente($sql);
    return $resultado[0]['correo'];
  }

  static function get_detallereg($id_registro)
  {
    $sql = "SELECT ea.id_estado_actual, to_char(ea.fecha::TIMESTAMP, 'DD/MM/YYYY HH24:MI:SS') fecha,
            ea.activo, e.nombre estado, r.id_registro||': '||r.nombre registro, ea.observacion,
            coalesce(p.legajo, '0')||': '||p.apellido||', '||p.nombre apynom
            FROM sgr.estado_actual_flujo ea
            JOIN sgr.estado e ON ea.id_estado = e.id_estado
            JOIN sgr.registro r ON ea.id_registro = r.id_registro
            JOIN sgr.persona p ON ea.id_persona = p.id_persona
            WHERE ea.id_registro = $id_registro
            AND ea.activo = TRUE
            ORDER BY 1 DESC";
    $resultado = consultar_fuente($sql);
    return $resultado[0];
  }
}
?>
