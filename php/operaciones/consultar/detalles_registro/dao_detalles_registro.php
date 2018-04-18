<?php
require_once('operaciones/metodosconsulta/dao_generico.php');

class dao_detalles_registro
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

  static function cargar_form($seleccion)
  {
    $consulta = $seleccion['id_registro'];
    $sql = "SELECT id_registro,
            r.id_registro||': '||w.nombre||' - '||r.nombre registro, r.archivo, r.archivo_nombre,
            s.nombre||' - '||d.nombre sucursal,
            to_char(r.fecha_fin::TIMESTAMP, 'DD/MM/YYYY HH24:MI') fecha_fin
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
            coalesce(p.legajo||':', '')||p.apellido||', '||p.nombre apynom,
            to_char(fecha::TIMESTAMP, 'DD/MM/YYYY HH24:MI') fecha
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
