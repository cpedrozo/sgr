<?php

require_once('operaciones/consultar/reporte_tramites/dao_reportetramites.php');

class cuadro_reportetramites extends sgr_ei_cuadro
{
  function vista_pdf(toba_vista_pdf $salida )
  {
  //configuramos el nombre que tendr� el archivo pdf
  $salida->set_nombre_archivo("REPORTE_TRAMITES.pdf");
  //recuperamos el objteo ezPDF para agregar la cabecera y el pie de p�gina
  $pdf = $salida->get_pdf();
  //modificamos los m�rgenes de la hoja top, bottom, left, right
  $pdf->ezSetMargins(80, 50, 30, 30);
  //Configuramos el pie de p�gina. El mismo, tendra el n�mero de p�gina centrado en la p�gina y la fecha ubicada a la derecha.
  //Primero definimos la plantilla para el n�mero de p�gina.
  $formato = 'P�gina {PAGENUM} de {TOTALPAGENUM}';
  //Determinamos la ubicaci�n del n�mero p�gina en el pi� de pagina definiendo las coordenadas x y, tama�o de letra, posici�n, texto, pagina inicio
  $pdf->ezStartPageNumbers(300, 20, 8, 'left', utf8_d_seguro($formato), 1);
  //Luego definimos la ubicaci�n de la fecha en el pie de p�gina.
  $pdf->addText(480,20,8,date('d/m/Y h:i:s'));
  $usuario = toba::usuario()->get_nombre();
  $pdf->addText(24,20,8,'Usuario: '.$usuario);
  //Configuraci�n de T�tulo.
  $salida->titulo(utf8_d_seguro(""));
  $salida->titulo(utf8_d_seguro(""));
  $salida->titulo(utf8_d_seguro(""));
  // $salida->subtitulo(utf8_d_seguro("__________________________________________________________________________________"));
  //Configuraci�n de Subt�tulo.
  //$salida->subtitulo(utf8_d_seguro("Listado de Postulantes"));
  //Invoco la salida pdf original del cuadro
  parent::vista_pdf($salida);
  //Encabezado: Logo Organizaci�n - Nombre
  //Recorremos cada una de las hojas del documento para agregar el encabezado
  foreach ($pdf->ezPages as $pageNum=>$id){
    $pdf->reopenObject($id);
    //definimos el path a la imagen de logo de la organizacion
    $imagen = toba::proyecto()->get_path().'/www/img/logo_pdf.jpg';
    //agregamos al documento la imagen y definimos su posici�n a trav�s de las coordenadas (x,y) y el ancho y el alto.
    $pdf->addJpegFromFile($imagen, 10, 735, 150, 120);
    $pdf->addText(240,727,12,' Reporte de tr�mites');
    $pdf->addText(24,720,12,'__________________________________________________________________________________');
    //Agregamos el nombre de la organizaci�n a la cabecera junto al logo
    $getprop = dao_reportetramites::get_propietario();
    $propietario = $getprop['0']['nombre'].' | Tel: '.$getprop['0']['telefono'];
    $direccion = $getprop['0']['direccion'];
    $pdf->addText(145,795,10,$propietario);
    $pdf->addText(145,783,10,$direccion);
    $pdf->addText(24,744,12,'__________________________________________________________________________________');
    $pdf->closeObject();
  }
  }
}

?>
