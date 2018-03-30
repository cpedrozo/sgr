<?php
class ci_bkp extends sgr_ci
{
	protected $s__datos = [];
	protected $scriptCrearBackup = "/home/toba_2_6_7/toba_2_7_6/proyectos/sgr/bin/script_bkp_db";
	protected $modoDesarrollador = false;
	
	function ejecutarComando($comando)
	{
		$output = [];
		$resultado = -1;
		exec("$comando 2>&1", $output, $resultado);
		// Valor de retorno de la función
		$unResultado = ['resultado' => $resultado,
			 							'output' => $output];
		// Usamos s__datos['backup-log'] en la función esta_backupCreado para
		// determinar si el backup fue exitoso o no
		$this->s__datos['backup-log'] = $unResultado;
		// == DEBUG ==
		// Usamos esta variable para imprimir información de debug
		$unaInformacionLog = array_merge(['comando' => $comando],
	 											             $unResultado);
		// Si la orden se ejecutó correctamente
		if ($resultado == 0) {
			// Imprimimos la información de debug
			toba::logger()->debug('Se ejecutó la orden: '.$unaInformacionLog['comando']);
		} else {
			// De lo contrario imprimimos la información de debug informando de un error
			toba::logger()->error('Falló la orden: '.$unaInformacionLog['comando']);
		}
		// Imprimimos todo lo guardado en $unaInformacionLog
		toba::logger()->var_dump($unaInformacionLog, 'Ejecucion de comando');
		// == FIN DEBUG ==
		return $unResultado;
	}
	function crearBackup()
	{
		// Obtenemos la clave
		$unResultado = $this->ejecutarComando($this->scriptCrearBackup. " get-pass");
		if ($unResultado['resultado']==0) {
			if (isset($unResultado['output'][0])) {
				// Seteamos la clave
				putenv("PGPASSWORD=" . $unResultado['output'][0]);
			}
		}
		// Creamos el backup
		$this->ejecutarComando($this->scriptCrearBackup);
	}
	function ini()
	{
		// Esto se puede implementar usando AJAX para mostrar al usuario una
		// Animación con la que brindarlee un aproximación al porcentaje de completado de la acción
		$this->crearBackup();
	}
	//-----------------------------------------------------------------------------------
	//---- JAVASCRIPT -------------------------------------------------------------------
	//-----------------------------------------------------------------------------------
	function esta_backupCreado()
	{
		if (isset($this->s__datos['backup-log']['resultado'])) {
			if ($this->s__datos['backup-log']['resultado'] == 0) {
				return true;
			}
		}
		return false;
	}
	function extender_objeto_js()
	{
		if ($this->esta_backupCreado()) {
			$funcionDescargar = " {$this->objeto_js}.descargar = function(dataurl, filename) {".'
															var a = document.createElement("a");
															a.href = dataurl;
															a.setAttribute("download", filename);
															var b = document.createEvent("MouseEvents");
															b.initEvent("click", false, true);
															a.dispatchEvent(b);
														}';
			$accionBoton = "{$this->objeto_js}.descargar('temp/backup.backup.gz', 'backup.gz');";
			$accionDefecto = $accionBoton;
		} else {
			$funcionDescargar = "";
			$accionDefecto = "";
			$accionBoton = "alert('No se pudo generar el bakcup. Intente nuevamente más tarde.');";
			// Aquí se puede utilizar el log $this->s__datos['backup-log']
			// para dar un mensaje más concreto sobre qué falló.
			toba::notificacion()->agregar("Falló la creación del backup. Intente nuevamente más tarde.", 'error');
		}
		echo "
		$funcionDescargar
		$accionDefecto
		//---- Eventos ---------------------------------------------
		{$this->objeto_js}.evt__descargar = function()
		{
			$accionBoton
			return false;
		}
		";
	}
}
?>
