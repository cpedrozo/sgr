------------------------------------------------------------
--[1000728]--  - dr_entidades 
------------------------------------------------------------

------------------------------------------------------------
-- apex_objeto
------------------------------------------------------------

--- INICIO Grupo de desarrollo 1
INSERT INTO apex_objeto (proyecto, objeto, anterior, identificador, reflexivo, clase_proyecto, clase, punto_montaje, subclase, subclase_archivo, objeto_categoria_proyecto, objeto_categoria, nombre, titulo, colapsable, descripcion, fuente_datos_proyecto, fuente_datos, solicitud_registrar, solicitud_obj_obs_tipo, solicitud_obj_observacion, parametro_a, parametro_b, parametro_c, parametro_d, parametro_e, parametro_f, usuario, creacion, posicion_botonera) VALUES (
	'sgr', --proyecto
	'1000728', --objeto
	NULL, --anterior
	NULL, --identificador
	NULL, --reflexivo
	'toba', --clase_proyecto
	'toba_datos_relacion', --clase
	'1000001', --punto_montaje
	NULL, --subclase
	NULL, --subclase_archivo
	NULL, --objeto_categoria_proyecto
	NULL, --objeto_categoria
	'- dr_entidades', --nombre
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
	'2017-05-25 20:08:01', --creacion
	NULL  --posicion_botonera
);
--- FIN Grupo de desarrollo 1

------------------------------------------------------------
-- apex_objeto_datos_rel
------------------------------------------------------------
INSERT INTO apex_objeto_datos_rel (proyecto, objeto, debug, clave, ap, punto_montaje, ap_clase, ap_archivo, sinc_susp_constraints, sinc_orden_automatico, sinc_lock_optimista) VALUES (
	'sgr', --proyecto
	'1000728', --objeto
	'0', --debug
	NULL, --clave
	'2', --ap
	'1000001', --punto_montaje
	NULL, --ap_clase
	NULL, --ap_archivo
	'0', --sinc_susp_constraints
	'1', --sinc_orden_automatico
	'1'  --sinc_lock_optimista
);

------------------------------------------------------------
-- apex_objeto_dependencias
------------------------------------------------------------

--- INICIO Grupo de desarrollo 1
INSERT INTO apex_objeto_dependencias (proyecto, dep_id, objeto_consumidor, objeto_proveedor, identificador, parametros_a, parametros_b, parametros_c, inicializar, orden) VALUES (
	'sgr', --proyecto
	'1000538', --dep_id
	'1000728', --objeto_consumidor
	'1000731', --objeto_proveedor
	'dt_correo', --identificador
	'', --parametros_a
	'', --parametros_b
	NULL, --parametros_c
	NULL, --inicializar
	'1'  --orden
);
INSERT INTO apex_objeto_dependencias (proyecto, dep_id, objeto_consumidor, objeto_proveedor, identificador, parametros_a, parametros_b, parametros_c, inicializar, orden) VALUES (
	'sgr', --proyecto
	'1000550', --dep_id
	'1000728', --objeto_consumidor
	'1000743', --objeto_proveedor
	'dt_domicilio', --identificador
	'', --parametros_a
	'', --parametros_b
	NULL, --parametros_c
	NULL, --inicializar
	'2'  --orden
);
INSERT INTO apex_objeto_dependencias (proyecto, dep_id, objeto_consumidor, objeto_proveedor, identificador, parametros_a, parametros_b, parametros_c, inicializar, orden) VALUES (
	'sgr', --proyecto
	'1000536', --dep_id
	'1000728', --objeto_consumidor
	'1000729', --objeto_proveedor
	'dt_entidades', --identificador
	'', --parametros_a
	'', --parametros_b
	NULL, --parametros_c
	NULL, --inicializar
	'3'  --orden
);
INSERT INTO apex_objeto_dependencias (proyecto, dep_id, objeto_consumidor, objeto_proveedor, identificador, parametros_a, parametros_b, parametros_c, inicializar, orden) VALUES (
	'sgr', --proyecto
	'1000537', --dep_id
	'1000728', --objeto_consumidor
	'1000730', --objeto_proveedor
	'dt_telefono', --identificador
	'', --parametros_a
	'', --parametros_b
	NULL, --parametros_c
	NULL, --inicializar
	'4'  --orden
);
--- FIN Grupo de desarrollo 1

------------------------------------------------------------
-- apex_objeto_datos_rel_asoc
------------------------------------------------------------

--- INICIO Grupo de desarrollo 1
INSERT INTO apex_objeto_datos_rel_asoc (proyecto, objeto, asoc_id, identificador, padre_proyecto, padre_objeto, padre_id, padre_clave, hijo_proyecto, hijo_objeto, hijo_id, hijo_clave, cascada, orden) VALUES (
	'sgr', --proyecto
	'1000728', --objeto
	'1000022', --asoc_id
	NULL, --identificador
	'sgr', --padre_proyecto
	'1000729', --padre_objeto
	'dt_entidades', --padre_id
	NULL, --padre_clave
	'sgr', --hijo_proyecto
	'1000731', --hijo_objeto
	'dt_correo', --hijo_id
	NULL, --hijo_clave
	NULL, --cascada
	'1'  --orden
);
INSERT INTO apex_objeto_datos_rel_asoc (proyecto, objeto, asoc_id, identificador, padre_proyecto, padre_objeto, padre_id, padre_clave, hijo_proyecto, hijo_objeto, hijo_id, hijo_clave, cascada, orden) VALUES (
	'sgr', --proyecto
	'1000728', --objeto
	'1000023', --asoc_id
	NULL, --identificador
	'sgr', --padre_proyecto
	'1000729', --padre_objeto
	'dt_entidades', --padre_id
	NULL, --padre_clave
	'sgr', --hijo_proyecto
	'1000730', --hijo_objeto
	'dt_telefono', --hijo_id
	NULL, --hijo_clave
	NULL, --cascada
	'2'  --orden
);
INSERT INTO apex_objeto_datos_rel_asoc (proyecto, objeto, asoc_id, identificador, padre_proyecto, padre_objeto, padre_id, padre_clave, hijo_proyecto, hijo_objeto, hijo_id, hijo_clave, cascada, orden) VALUES (
	'sgr', --proyecto
	'1000728', --objeto
	'1000024', --asoc_id
	NULL, --identificador
	'sgr', --padre_proyecto
	'1000729', --padre_objeto
	'dt_entidades', --padre_id
	NULL, --padre_clave
	'sgr', --hijo_proyecto
	'1000743', --hijo_objeto
	'dt_domicilio', --hijo_id
	NULL, --hijo_clave
	NULL, --cascada
	'3'  --orden
);
--- FIN Grupo de desarrollo 1

------------------------------------------------------------
-- apex_objeto_rel_columnas_asoc
------------------------------------------------------------
INSERT INTO apex_objeto_rel_columnas_asoc (proyecto, objeto, asoc_id, padre_objeto, padre_clave, hijo_objeto, hijo_clave) VALUES (
	'sgr', --proyecto
	'1000728', --objeto
	'1000022', --asoc_id
	'1000729', --padre_objeto
	'1000748', --padre_clave
	'1000731', --hijo_objeto
	'1000566'  --hijo_clave
);
INSERT INTO apex_objeto_rel_columnas_asoc (proyecto, objeto, asoc_id, padre_objeto, padre_clave, hijo_objeto, hijo_clave) VALUES (
	'sgr', --proyecto
	'1000728', --objeto
	'1000023', --asoc_id
	'1000729', --padre_objeto
	'1000748', --padre_clave
	'1000730', --hijo_objeto
	'1000646'  --hijo_clave
);
INSERT INTO apex_objeto_rel_columnas_asoc (proyecto, objeto, asoc_id, padre_objeto, padre_clave, hijo_objeto, hijo_clave) VALUES (
	'sgr', --proyecto
	'1000728', --objeto
	'1000024', --asoc_id
	'1000729', --padre_objeto
	'1000748', --padre_clave
	'1000743', --hijo_objeto
	'1000637'  --hijo_clave
);
