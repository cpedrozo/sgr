<?php

class dao_generico
{

//////////////////////////////////////////////////////////////////////////////
/////////// BLOB /////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////

  static function get_blob_from_resource($resource, $nombre_archivo='archivo', $extension_archivo=null)
  {
    $nombre_campo = 'archivodescarga';
    if (isset($resource)) {
      $temp_nombre = ($nombre_archivo ? $nombre_archivo : '').($extension_archivo ? '.'.$extension_archivo : '');
      $s__temp_archivo = toba::proyecto()->get_www_temp($temp_nombre);
      $html_imagen = "<img width=\"24px\" src='{$s__temp_archivo['url']}' alt='' />";
      $temp_imagen = fopen($s__temp_archivo['path'], 'w');
      stream_copy_to_stream($resource, $temp_imagen);
      fclose($temp_imagen);
      // fclose($resource); //< Para evitar errores en la recarga de formularios
      $tamano = round(filesize($s__temp_archivo['path']) / 1024);
      //$fila[$nombre_campo] = '<a href="'.$s__temp_archivo['url'].'" target="_newtab">'.$html_imagen.' Tamaño archivo actual: '.$tamano.' kb</a>';
      $fila[$nombre_campo] = '<a href="'.$s__temp_archivo['url'].'" target="_newtab">'.$html_imagen.' Descargar archivo ('.$tamano.' kb)</a>';
      $fila[$nombre_campo.'?html'] = $html_imagen;
      $fila[$nombre_campo.'?url'] = $s__temp_archivo['url'];
    } else {
      $fila[$nombre_campo] = null;
    }
    return $fila;
  }

  static function consulta_borrado_workflow($id_evaluar)
  {
    $sql = "SELECT count(id_workflow) cantidad
            FROM sgr.registro
            WHERE id_workflow = $id_evaluar";
    $resultado = consultar_fuente($sql);
    return $resultado[0]['cantidad'];
  }

}
?>
