------------------------------------------------------------
--[1000841]--  DT - workflow 
------------------------------------------------------------

------------------------------------------------------------
-- apex_objeto
------------------------------------------------------------

--- INICIO Grupo de desarrollo 1
INSERT INTO apex_objeto (proyecto, objeto, anterior, identificador, reflexivo, clase_proyecto, clase, punto_montaje, subclase, subclase_archivo, objeto_categoria_proyecto, objeto_categoria, nombre, titulo, colapsable, descripcion, fuente_datos_proyecto, fuente_datos, solicitud_registrar, solicitud_obj_obs_tipo, solicitud_obj_observacion, parametro_a, parametro_b, parametro_c, parametro_d, parametro_e, parametro_f, usuario, creacion, posicion_botonera) VALUES (
	'sgr', --proyecto
	'1000841', --objeto
	NULL, --anterior
	NULL, --identificador
	NULL, --reflexivo
	'toba', --clase_proyecto
	'toba_datos_tabla', --clase
	'1000001', --punto_montaje
	NULL, --subclase
	NULL, --subclase_archivo
	NULL, --objeto_categoria_proyecto
	NULL, --objeto_categoria
	'DT - workflow', --nombre
	NULL, --titulo
	NULL, --colapsable
	NULL, --descripcion
	'sgr', --fuente_datos_proyecto
	'sgr', --fuente_datos
	NULL, --solicitud_registrar
	NULL, --solicitud_obj_obs_tipo
	NULL, --solicitud_obj_observacion
	NULL, --parametro_a
	NULL, --parametro_b
	NULL, --parametro_c
	NULL, --parametro_d
	NULL, --parametro_e
	NULL, --parametro_f
	NULL, --usuario
	'2017-07-03 16:45:30', --creacion
	NULL  --posicion_botonera
);
--- FIN Grupo de desarrollo 1

------------------------------------------------------------
-- apex_objeto_db_registros
------------------------------------------------------------
INSERT INTO apex_objeto_db_registros (objeto_proyecto, objeto, max_registros, min_registros, punto_montaje, ap, ap_clase, ap_archivo, tabla, tabla_ext, alias, modificar_claves, fuente_datos_proyecto, fuente_datos, permite_actualizacion_automatica, esquema, esquema_ext) VALUES (
	'sgr', --objeto_proyecto
	'1000841', --objeto
	NULL, --max_registros
	NULL, --min_registros
	'1000001', --punto_montaje
	'1', --ap
	NULL, --ap_clase
	NULL, --ap_archivo
	'workflow', --tabla
	NULL, --tabla_ext
	NULL, --alias
	'0', --modificar_claves
	'sgr', --fuente_datos_proyecto
	'sgr', --fuente_datos
	'1', --permite_actualizacion_automatica
	'sgr', --esquema
	'sgr'  --esquema_ext
);

------------------------------------------------------------
-- apex_objeto_db_registros_col
------------------------------------------------------------

--- INICIO Grupo de desarrollo 1
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'sgr', --objeto_proyecto
	'1000841', --objeto
	'1000757', --col_id
	'id_workflow', --columna
	'E', --tipo
	'1', --pk
	'workflow_id_workflow_seq', --secuencia
	NULL, --largo
	NULL, --no_nulo
	'1', --no_nulo_db
	'0', --externa
	'workflow'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'sgr', --objeto_proyecto
	'1000841', --objeto
	'1000758', --col_id
	'nombre', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'30', --largo
	NULL, --no_nulo
	'1', --no_nulo_db
	'0', --externa
	'workflow'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'sgr', --objeto_proyecto
	'1000841', --objeto
	'1000759', --col_id
	'id_evento', --columna
	'E', --tipo
	'0', --pk
	'', --secuencia
	NULL, --largo
	NULL, --no_nulo
	'1', --no_nulo_db
	'0', --externa
	'workflow'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'sgr', --objeto_proyecto
	'1000841', --objeto
	'1000780', --col_id
	'id_tipoevento', --columna
	'E', --tipo
	'0', --pk
	NULL, --secuencia
	NULL, --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	'1', --externa
	NULL  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'sgr', --objeto_proyecto
	'1000841', --objeto
	'1000848', --col_id
	'id_dpto', --columna
	'E', --tipo
	'0', --pk
	'', --secuencia
	NULL, --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	'0', --externa
	'workflow'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'sgr', --objeto_proyecto
	'1000841', --objeto
	'1000849', --col_id
	'id_sucursal', --columna
	'E', --tipo
	'0', --pk
	NULL, --secuencia
	NULL, --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	'1', --externa
	NULL  --tabla
);
--- FIN Grupo de desarrollo 1

------------------------------------------------------------
-- apex_objeto_db_registros_ext
------------------------------------------------------------

--- INICIO Grupo de desarrollo 1
INSERT INTO apex_objeto_db_registros_ext (objeto_proyecto, objeto, externa_id, tipo, sincro_continua, metodo, clase, include, punto_montaje, sql, dato_estricto, carga_dt, carga_consulta_php, permite_carga_masiva, metodo_masivo) VALUES (
	'sgr', --objeto_proyecto
	'1000841', --objeto
	'1000002', --externa_id
	'dao', --tipo
	'1', --sincro_continua
	'get_idexttipoevento', --metodo
	'cargasexternas', --clase
	'operaciones/metodosconsulta/cargasexternas.php', --include
	'1000001', --punto_montaje
	NULL, --sql
	'0', --dato_estricto
	NULL, --carga_dt
	NULL, --carga_consulta_php
	'0', --permite_carga_masiva
	NULL  --metodo_masivo
);
INSERT INTO apex_objeto_db_registros_ext (objeto_proyecto, objeto, externa_id, tipo, sincro_continua, metodo, clase, include, punto_montaje, sql, dato_estricto, carga_dt, carga_consulta_php, permite_carga_masiva, metodo_masivo) VALUES (
	'sgr', --objeto_proyecto
	'1000841', --objeto
	'1000009', --externa_id
	'dao', --tipo
	'1', --sincro_continua
	'get_idextsuc', --metodo
	'cargasexternas', --clase
	'operaciones/metodosconsulta/cargasexternas.php', --include
	'1000001', --punto_montaje
	NULL, --sql
	'0', --dato_estricto
	NULL, --carga_dt
	NULL, --carga_consulta_php
	'0', --permite_carga_masiva
	NULL  --metodo_masivo
);
--- FIN Grupo de desarrollo 1

------------------------------------------------------------
-- apex_objeto_db_registros_ext_col
------------------------------------------------------------
INSERT INTO apex_objeto_db_registros_ext_col (objeto_proyecto, objeto, externa_id, col_id, es_resultado) VALUES (
	'sgr', --objeto_proyecto
	'1000841', --objeto
	'1000002', --externa_id
	'1000759', --col_id
	'0'  --es_resultado
);
INSERT INTO apex_objeto_db_registros_ext_col (objeto_proyecto, objeto, externa_id, col_id, es_resultado) VALUES (
	'sgr', --objeto_proyecto
	'1000841', --objeto
	'1000002', --externa_id
	'1000780', --col_id
	'1'  --es_resultado
);
INSERT INTO apex_objeto_db_registros_ext_col (objeto_proyecto, objeto, externa_id, col_id, es_resultado) VALUES (
	'sgr', --objeto_proyecto
	'1000841', --objeto
	'1000009', --externa_id
	'1000848', --col_id
	'0'  --es_resultado
);
INSERT INTO apex_objeto_db_registros_ext_col (objeto_proyecto, objeto, externa_id, col_id, es_resultado) VALUES (
	'sgr', --objeto_proyecto
	'1000841', --objeto
	'1000009', --externa_id
	'1000849', --col_id
	'1'  --es_resultado
);
