------------------------------------------------------------
--[1000797]--  ci_entidades_pop 
------------------------------------------------------------

------------------------------------------------------------
-- apex_objeto
------------------------------------------------------------

--- INICIO Grupo de desarrollo 1
INSERT INTO apex_objeto (proyecto, objeto, anterior, identificador, reflexivo, clase_proyecto, clase, punto_montaje, subclase, subclase_archivo, objeto_categoria_proyecto, objeto_categoria, nombre, titulo, colapsable, descripcion, fuente_datos_proyecto, fuente_datos, solicitud_registrar, solicitud_obj_obs_tipo, solicitud_obj_observacion, parametro_a, parametro_b, parametro_c, parametro_d, parametro_e, parametro_f, usuario, creacion, posicion_botonera) VALUES (
	'sgr', --proyecto
	'1000797', --objeto
	NULL, --anterior
	NULL, --identificador
	NULL, --reflexivo
	'toba', --clase_proyecto
	'toba_ci', --clase
	'1000001', --punto_montaje
	'ci_entidades_popup', --subclase
	'operaciones/abm/entidades/popup/ci_entidades_popup.php', --subclase_archivo
	NULL, --objeto_categoria_proyecto
	NULL, --objeto_categoria
	'ci_entidades_pop', --nombre
	NULL, --titulo
	'0', --colapsable
	NULL, --descripcion
	NULL, --fuente_datos_proyecto
	NULL, --fuente_datos
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
	'2017-06-25 16:08:12', --creacion
	'abajo'  --posicion_botonera
);
--- FIN Grupo de desarrollo 1

------------------------------------------------------------
-- apex_objeto_mt_me
------------------------------------------------------------
INSERT INTO apex_objeto_mt_me (objeto_mt_me_proyecto, objeto_mt_me, ev_procesar_etiq, ev_cancelar_etiq, ancho, alto, posicion_botonera, tipo_navegacion, botonera_barra_item, con_toc, incremental, debug_eventos, activacion_procesar, activacion_cancelar, ev_procesar, ev_cancelar, objetos, post_procesar, metodo_despachador, metodo_opciones) VALUES (
	'sgr', --objeto_mt_me_proyecto
	'1000797', --objeto_mt_me
	NULL, --ev_procesar_etiq
	NULL, --ev_cancelar_etiq
	'90%', --ancho
	NULL, --alto
	NULL, --posicion_botonera
	NULL, --tipo_navegacion
	'0', --botonera_barra_item
	'0', --con_toc
	NULL, --incremental
	NULL, --debug_eventos
	NULL, --activacion_procesar
	NULL, --activacion_cancelar
	NULL, --ev_procesar
	NULL, --ev_cancelar
	NULL, --objetos
	NULL, --post_procesar
	NULL, --metodo_despachador
	NULL  --metodo_opciones
);

------------------------------------------------------------
-- apex_objeto_dependencias
------------------------------------------------------------

--- INICIO Grupo de desarrollo 1
INSERT INTO apex_objeto_dependencias (proyecto, dep_id, objeto_consumidor, objeto_proveedor, identificador, parametros_a, parametros_b, parametros_c, inicializar, orden) VALUES (
	'sgr', --proyecto
	'1000663', --dep_id
	'1000797', --objeto_consumidor
	'1000870', --objeto_proveedor
	'form_correo', --identificador
	NULL, --parametros_a
	NULL, --parametros_b
	NULL, --parametros_c
	NULL, --inicializar
	NULL  --orden
);
INSERT INTO apex_objeto_dependencias (proyecto, dep_id, objeto_consumidor, objeto_proveedor, identificador, parametros_a, parametros_b, parametros_c, inicializar, orden) VALUES (
	'sgr', --proyecto
	'1000661', --dep_id
	'1000797', --objeto_consumidor
	'1000868', --objeto_proveedor
	'form_dom', --identificador
	NULL, --parametros_a
	NULL, --parametros_b
	NULL, --parametros_c
	NULL, --inicializar
	NULL  --orden
);
INSERT INTO apex_objeto_dependencias (proyecto, dep_id, objeto_consumidor, objeto_proveedor, identificador, parametros_a, parametros_b, parametros_c, inicializar, orden) VALUES (
	'sgr', --proyecto
	'1000660', --dep_id
	'1000797', --objeto_consumidor
	'1000867', --objeto_proveedor
	'form_entidad', --identificador
	NULL, --parametros_a
	NULL, --parametros_b
	NULL, --parametros_c
	NULL, --inicializar
	NULL  --orden
);
INSERT INTO apex_objeto_dependencias (proyecto, dep_id, objeto_consumidor, objeto_proveedor, identificador, parametros_a, parametros_b, parametros_c, inicializar, orden) VALUES (
	'sgr', --proyecto
	'1000662', --dep_id
	'1000797', --objeto_consumidor
	'1000869', --objeto_proveedor
	'form_tel', --identificador
	NULL, --parametros_a
	NULL, --parametros_b
	NULL, --parametros_c
	NULL, --inicializar
	NULL  --orden
);
--- FIN Grupo de desarrollo 1

------------------------------------------------------------
-- apex_objeto_ci_pantalla
------------------------------------------------------------

--- INICIO Grupo de desarrollo 1
INSERT INTO apex_objeto_ci_pantalla (objeto_ci_proyecto, objeto_ci, pantalla, identificador, orden, etiqueta, descripcion, tip, imagen_recurso_origen, imagen, objetos, eventos, subclase, subclase_archivo, template, template_impresion, punto_montaje) VALUES (
	'sgr', --objeto_ci_proyecto
	'1000797', --objeto_ci
	'1000440', --pantalla
	'pant_inicial', --identificador
	'1', --orden
	'Pantalla Inicial', --etiqueta
	NULL, --descripcion
	NULL, --tip
	'apex', --imagen_recurso_origen
	NULL, --imagen
	NULL, --objetos
	NULL, --eventos
	'pant_entidades_pop', --subclase
	'operaciones/abm/entidades/pant_entidades_pop.php', --subclase_archivo
	NULL, --template
	NULL, --template_impresion
	'1000001'  --punto_montaje
);
--- FIN Grupo de desarrollo 1

------------------------------------------------------------
-- apex_objetos_pantalla
------------------------------------------------------------
INSERT INTO apex_objetos_pantalla (proyecto, pantalla, objeto_ci, orden, dep_id) VALUES (
	'sgr', --proyecto
	'1000440', --pantalla
	'1000797', --objeto_ci
	'0', --orden
	'1000660'  --dep_id
);
INSERT INTO apex_objetos_pantalla (proyecto, pantalla, objeto_ci, orden, dep_id) VALUES (
	'sgr', --proyecto
	'1000440', --pantalla
	'1000797', --objeto_ci
	'1', --orden
	'1000661'  --dep_id
);
INSERT INTO apex_objetos_pantalla (proyecto, pantalla, objeto_ci, orden, dep_id) VALUES (
	'sgr', --proyecto
	'1000440', --pantalla
	'1000797', --objeto_ci
	'2', --orden
	'1000662'  --dep_id
);
INSERT INTO apex_objetos_pantalla (proyecto, pantalla, objeto_ci, orden, dep_id) VALUES (
	'sgr', --proyecto
	'1000440', --pantalla
	'1000797', --objeto_ci
	'3', --orden
	'1000663'  --dep_id
);
