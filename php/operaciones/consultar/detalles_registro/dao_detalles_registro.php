<?php
require_once('operaciones/metodosconsulta/dao_generico.php');

class dao_detalles_registro
{
  static function get_datossinfiltro($where='')
  {
    if ($where) {
      $where_armado = "WHERE $where";
    } else {
      $where_armado = '';
    }

    $sql = "SELECT r.id_registro, te.nombre ||': '|| e.nombre ||' - '|| wf.nombre tipoevento_y_wf,
            r.nombre, r.archivo, r.archivo_nombre,
            ea.get_usuario,
            s.nombre ||' - '|| dp.nombre sucursal_dpto, es.nombre estado,
            to_char(r.fecha_fin::TIMESTAMP, 'DD / MM / YYYY HH24:MI:SS') fecha_fin
            FROM sgr.registro r
            INNER JOIN sgr.workflow wf on wf.id_workflow = r.id_workflow
            INNER JOIN sgr.evento e ON e.id_evento = wf.id_evento
            INNER JOIN sgr.tipo_evento te ON e.id_tipoevento = te.id_tipoevento
            INNER JOIN sgr.dpto dp ON wf.id_dpto = dp.id_dpto
            INNER JOIN sgr.sucursal s ON dp.id_sucursal = s.id_sucursal
            JOIN sgr.estado_actual_flujo ea ON r.id_registro = ea.id_registro AND ea.activo
            INNER JOIN sgr.estado es ON ea.id_estado = es.id_estado
            WHERE r.fecha_fin IS NULL
            ORDER BY tipoevento_y_wf ASC
            limit 10";
    $resultado = consultar_fuente($sql);
    foreach ($resultado as $key => $value) {
      $resultado[$key]['archivo'] = dao_generico::get_blob_from_resource($value['archivo'])['archivodescarga'];
    }
    return $resultado;
  }

  static function get_datos($where='')
  {
    if ($where) {
      $where_armado = "WHERE $where";
    } else {
      $where_armado = '';
    }

    $sql = "SELECT r.id_registro, te.nombre ||': '|| e.nombre ||' - '|| wf.nombre tipoevento_y_wf,
            r.nombre, r.archivo, r.archivo_nombre,
            ea.get_usuario,
            s.nombre ||' - '|| dp.nombre sucursal_dpto, es.nombre estado,
            to_char(r.fecha_fin::TIMESTAMP, 'DD / MM / YYYY HH24:MI:SS') fecha_fin
            FROM sgr.registro r
            INNER JOIN sgr.workflow wf on wf.id_workflow = r.id_workflow
            INNER JOIN sgr.evento e ON e.id_evento = wf.id_evento
            INNER JOIN sgr.tipo_evento te ON e.id_tipoevento = te.id_tipoevento
            INNER JOIN sgr.dpto dp ON wf.id_dpto = dp.id_dpto
            INNER JOIN sgr.sucursal s ON dp.id_sucursal = s.id_sucursal
            JOIN sgr.estado_actual_flujo ea ON r.id_registro = ea.id_registro AND ea.activo
            INNER JOIN sgr.estado es ON ea.id_estado = es.id_estado
            $where_armado
            ORDER BY tipoevento_y_wf ASC";
    $resultado = consultar_fuente($sql);
    foreach ($resultado as $key => $value) {
      $resultado[$key]['archivo'] = dao_generico::get_blob_from_resource($value['archivo'], $value['archivo_nombre'])['archivodescarga'];
    }
    return $resultado;
  }

  static function cargar_form($seleccion)
  {
    $consulta = $seleccion['id_registro'];
    $sql = "SELECT id_registro,
            r.id_registro||': '||w.nombre||' - '||r.nombre registro, r.archivo, r.archivo_nombre,
            s.nombre||' - '||d.nombre sucursal,
            to_char(r.fecha_fin::TIMESTAMP, 'DD/MM/YYYY HH24:MI:SS') fecha_fin
            FROM sgr.registro r
            JOIN sgr.workflow w ON r.id_workflow = w.id_workflow
            JOIN sgr.dpto d ON w.id_dpto = d.id_dpto
            JOIN sgr.sucursal s ON d.id_sucursal = s.id_sucursal
            WHERE r.id_registro = $consulta";
    $resultado = consultar_fuente($sql);
    $resultado[0]['archivo'] = dao_generico::get_blob_from_resource($resultado[0]['archivo'], $resultado[0]['archivo_nombre'])['archivodescarga'];
    return $resultado[0];
  }

  static function cargar_ml($seleccion)
  {
    $consulta = $seleccion['id_registro'];
    $sql = "SELECT id_estado_actual,
            e.nombre estado,
            ea.observacion, ea.get_usuario,
            coalesce(p.legajo, '0')||': '||p.apellido||', '||p.nombre apynom,
            to_char(fecha::TIMESTAMP, 'DD/MM/YYYY HH24:MI:SS') fecha
            FROM sgr.estado_actual_flujo ea
            JOIN sgr.estado e ON ea.id_estado = e.id_estado
            LEFT JOIN sgr.persona p ON ea.id_persona = p.id_persona
            WHERE id_registro = $consulta
            ORDER BY fecha ASC";
    $resultado = consultar_fuente($sql);
    return $resultado;
  }
}
?>
