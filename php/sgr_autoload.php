<?php
/**
 * Esta clase fue y será generada automáticamente. NO EDITAR A MANO.
 * @ignore
 */
class sgr_autoload 
{
	static function existe_clase($nombre)
	{
		return isset(self::$clases[$nombre]);
	}

	static function cargar($nombre)
	{
		if (self::existe_clase($nombre)) { 
			 require_once(dirname(__FILE__) .'/'. self::$clases[$nombre]); 
		}
	}

	static protected $clases = array(
		'sgr_ci' => 'extension_toba/componentes/sgr_ci.php',
		'sgr_cn' => 'extension_toba/componentes/sgr_cn.php',
		'sgr_datos_relacion' => 'extension_toba/componentes/sgr_datos_relacion.php',
		'sgr_datos_tabla' => 'extension_toba/componentes/sgr_datos_tabla.php',
		'sgr_ei_arbol' => 'extension_toba/componentes/sgr_ei_arbol.php',
		'sgr_ei_archivos' => 'extension_toba/componentes/sgr_ei_archivos.php',
		'sgr_ei_calendario' => 'extension_toba/componentes/sgr_ei_calendario.php',
		'sgr_ei_codigo' => 'extension_toba/componentes/sgr_ei_codigo.php',
		'sgr_ei_cuadro' => 'extension_toba/componentes/sgr_ei_cuadro.php',
		'sgr_ei_esquema' => 'extension_toba/componentes/sgr_ei_esquema.php',
		'sgr_ei_filtro' => 'extension_toba/componentes/sgr_ei_filtro.php',
		'sgr_ei_firma' => 'extension_toba/componentes/sgr_ei_firma.php',
		'sgr_ei_formulario' => 'extension_toba/componentes/sgr_ei_formulario.php',
		'sgr_ei_formulario_ml' => 'extension_toba/componentes/sgr_ei_formulario_ml.php',
		'sgr_ei_grafico' => 'extension_toba/componentes/sgr_ei_grafico.php',
		'sgr_ei_mapa' => 'extension_toba/componentes/sgr_ei_mapa.php',
		'sgr_servicio_web' => 'extension_toba/componentes/sgr_servicio_web.php',
		'sgr_comando' => 'extension_toba/sgr_comando.php',
		'sgr_modelo' => 'extension_toba/sgr_modelo.php',
	);
}
?>