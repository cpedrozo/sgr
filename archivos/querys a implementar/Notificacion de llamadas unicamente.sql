SELECT r.id_registro||': '||w.nombre||' - '||r.nombre registro, d.nombre dpto, c.correo, ea.observacion
FROM sgr.registro r
JOIN sgr.workflow w on r.id_workflow = w.id_workflow
JOIN sgr.estado_actual_flujo ea on r.id_registro = ea.id_registro
JOIN sgr.dpto d on w.id_dpto = d.id_dpto
JOIN sgr.correo c on d.id_dpto = c.id_dpto
WHERE r.fecha_fin is null
AND r.id_registro = $variable
--AND w.notifica is TRUE
ORDER BY 1 ASC

select * from sgr.registro