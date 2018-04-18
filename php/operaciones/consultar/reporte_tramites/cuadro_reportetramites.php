<?php

require_once('operaciones/consultar/reporte_tramites/dao_reportetramites.php');

class cuadro_reportetramites extends sgr_ei_cuadro
{
  function vista_pdf(toba_vista_pdf $salida )
  {
  //configuramos el nombre que tendrá el archivo pdf
  $salida->set_nombre_archivo("REPORTE_TRAMITES.pdf");
  //recuperamos el objteo ezPDF para agregar la cabecera y el pie de página
  $pdf = $salida->get_pdf();
  //modificamos los márgenes de la hoja top, bottom, left, right
  $pdf->ezSetMargins(80, 50, 30, 30);
  //Configuramos el pie de página. El mismo, tendra el número de página centrado en la página y la fecha ubicada a la derecha.
  //Primero definimos la plantilla para el número de página.
  $formato = 'Página {PAGENUM} de {TOTALPAGENUM}';
  //Determinamos la ubicación del número página en el pié de pagina definiendo las coordenadas x y, tamaño de letra, posición, texto, pagina inicio
  $pdf->ezStartPageNumbers(300, 20, 8, 'left', utf8_d_seguro($formato), 1);
  //Luego definimos la ubicación de la fecha en el pie de página.
  $pdf->addText(480,20,8,date('d/m/Y h:i:s'));
  $usuario = toba::usuario()->get_nombre();
  $pdf->addText(24,20,8,'Usuario: '.$usuario);
  //Configuración de Título.
  $salida->titulo(utf8_d_seguro(""));
  $salida->titulo(utf8_d_seguro(""));
  $salida->titulo(utf8_d_seguro(""));
  // $salida->subtitulo(utf8_d_seguro("__________________________________________________________________________________"));
  //Configuración de Subtítulo.
  //$salida->subtitulo(utf8_d_seguro("Listado de Postulantes"));
  //Invoco la salida pdf original del cuadro
  parent::vista_pdf($salida);
  //Encabezado: Logo Organización - Nombre
  //Recorremos cada una de las hojas del documento para agregar el encabezado
  foreach ($pdf->ezPages as $pageNum=>$id){
    $pdf->reopenObject($id);
    //definimos el path a la imagen de logo de la organizacion
    $imagen = toba::proyecto()->get_path().'/www/img/logo_pdf.jpg';
    //agregamos al documento la imagen y definimos su posición a través de las coordenadas (x,y) y el ancho y el alto.
    $pdf->addJpegFromFile($imagen, 10, 735, 150, 120);
    $pdf->addText(240,727,12,' Reporte de trámites');
    $pdf->addText(24,720,12,'__________________________________________________________________________________');
    //Agregamos el nombre de la organización a la cabecera junto al logo
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
