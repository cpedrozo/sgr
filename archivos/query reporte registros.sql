SELECT r.id_registro, substring(te.nombre from 1 for 3) ||': '|| substring(e.nombre from 1 for 8) ||' - '|| wf.nombre tipoevento_y_wf,
            substring(r.nombre from 1 for 20)||'..', r.archivo, r.archivo_nombre, nu.nombre urgencia, c.caducidad,
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