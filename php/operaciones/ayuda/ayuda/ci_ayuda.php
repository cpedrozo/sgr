<?php
class ci_ayuda extends sgr_ci
{
	function ini()
	{
		$file = 'file:///home/toba_2_6_7/toba_2_7_6/proyectos/sgr/www/manual.pdf';
		$filename = 'manual.pdf'; /* Note: Always use .pdf at the end. */

		header('Content-type: application/pdf');
		header('Content-Disposition: inline; filename="' . $filename . '"');
		header('Content-Transfer-Encoding: binary');
		header('Content-Length: ' . filesize($file));
		header('Accept-Ranges: bytes');

		readfile($file);
	}
}

?>
