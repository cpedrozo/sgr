<?php
class ci_ayuda extends sgr_ci
{
	function ini()
	{
		$file = 'file:///home/toba_2_6_7/toba_2_7_6/proyectos/sgr/archivos/Manual/manual_usuario_v10.pdf';
		$filename = 'manual_usuario_v10.pdf'; // Note: Always use .pdf at the end.

		header('Content-type: application/pdf');
		header('Content-Disposition: inline; filename="' . $filename . '"');
		header('Content-Transfer-Encoding: binary');
		header('Content-Length: ' . filesize($file));
		header('Accept-Ranges: bytes');
		readfile($file);
	}
}

// Funciona, genera la descarga del archivo en vez de abrir en la ventana
// function ini()
// {
// 	$file = 'file:///home/toba_2_6_7/toba_2_7_6/proyectos/sgr/archivos/Manual/manual.pdf';
// 	$filename = 'manual.pdf'; // Note: Always use .pdf at the end.
//
//
// 	$filename="file:///home/toba_2_6_7/toba_2_7_6/proyectos/sgr/archivos/Manual/manual.pdf";
// 	//$url_download = BASE_URL . RELATIVE_PATH . $filename;
//
// 	//header("Content-type:application/pdf");
// 	header("Content-type: application/octet-stream");
// 	header("Content-Disposition:inline;filename=".basename($filename));
// 	header('Content-Length: ' . filesize($filename));
// 	header("Cache-control: private"); //use this to open files directly
// 	readfile($filename);
//
// }

?>
