<?php

function get_datos()
{
	$sql = "SELECT * FROM sgr.companias";
	$datos = cosultar_fuente($sql);
	return $datos;
}

?>