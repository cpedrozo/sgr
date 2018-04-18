<?php
require_once('operaciones/metodosconsulta/dao_generico.php');

class dao_historicoregistro
{
  static function get_datossinfiltro($where='')
  {
    return self::get_datos('', true); ////20180414
  }

  static function get_datos($where='', $limit=false)
  {
    if ($where) {
      $where_armado = "$where";
    } else {
      $where_armado = 'true';
    }
    $limite=($limit ? 'limit 10':'');
    $sql = "SELECT r.id_registro, substring(te.nombre from 1 for 3) ||': '|| substring(e.nombre from 1 for 8) ||' - '|| wf.nombre tipoevento_y_wf,
            r.nombre, r.archivo, r.archivo_nombre, nu.nombre urgencia, c.caducidad,
            ea.get_usuario,
            s.nombre ||' - '|| dp.nombre sucursal_dpto, es.nombre estado,
            to_char(r.fecha_inicio::TIMESTAMP, 'DD/MM/YYYY HH24:MI') fecha_inicio,
            to_char(r.fecha_fin::TIMESTAMP, 'DD/MM/YYYY HH24:MI') fecha_fin,
            to_char(ea.fecha::TIMESTAMP, 'DD/MM/YYYY HH24:MI') ultedicion
            FROM sgr.registro r
            INNER JOIN sgr.workflow wf on wf.id_workflow = r.id_workflow
            INNER JOIN sgr.evento e ON e.id_evento = wf.id_evento
            INNER JOIN sgr.tipo_evento te ON e.id_tipoevento = te.id_tipoevento
            INNER JOIN sgr.dpto dp ON wf.id_dpto = dp.id_dpto
            INNER JOIN sgr.sucursal s ON dp.id_sucursal = s.id_sucursal
            JOIN sgr.estado_actual_flujo ea ON r.id_registro = ea.id_registro AND ea.activo
            INNER JOIN sgr.estado es ON ea.id_estado = es.id_estado
            LEFT JOIN sgr.nivelurgencia nu ON nu.id_nivelurgencia = wf.id_nivelurgencia
            JOIN sgr.vw_caducidad_registros c ON c.id_registro = r.id_registro
            WHERE $where_armado
            ORDER BY tipoevento_y_wf ASC
            $limite";
    $resultado = consultar_fuente($sql);
    foreach ($resultado as $key => $value) {
      $resultado[$key]['archivo'] = dao_generico::get_blob_from_resource($value['archivo'], $value['archivo_nombre'])['archivodescarga'];
    }
    return $resultado;
  }

  static function es_final(array $esfinal) ////20180414
  {
    $id_workflow = quote($esfinal['id_workflow']);
    $id_estadoactual = quote($esfinal['id_estadoactual']);
    $id_estadonuevo = quote($esfinal['id_estadonuevo']);
    $sql = "SELECT esfinal
            FROM sgr.flujo
            WHERE id_workflow = $id_workflow
            AND id_estadoorigen = $id_estadoactual
            AND id_estadodestino = $id_estadonuevo";
    $resultado = consultar_fuente($sql);
    return $resultado[0]['esfinal'];
  }

  static function get_empleado_xreg($id_persona)
  {
    $sql = "SELECT p.id_persona, coalesce(p.legajo||':', '')||p.apellido||', '||p.nombre apynom, tc.nombre, c.correo
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
    $sql = "SELECT ea.id_estado_actual, to_char(ea.fecha::TIMESTAMP, 'DD/MM/YYYY HH24:MI') fecha,
            ea.activo, e.nombre estado, r.id_registro||': '||r.nombre registro, ea.observacion,
            coalesce(p.legajo||':', '')||p.apellido||', '||p.nombre apynom
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
