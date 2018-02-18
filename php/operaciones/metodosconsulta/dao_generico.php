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

  //////////////////////////////////////////////////////////////////////////////
  /////////// Consultas para borrado inteligente de tablas relacionadas ////////
  ////////////////       Operaciones: Personas y Entidades      ////////////////
  //////////////////////////////////////////////////////////////////////////////

    static function consulta_borrado_persona($id_evaluar)
    {
      $sqlea = "SELECT count(id_persona) cantidad
                FROM sgr.estado_actual_flujo
                WHERE id_persona = $id_evaluar";
      $resultadoea = consultar_fuente($sqlea);
      $sqlcorreo = "SELECT count(id_persona) cantidad
                    FROM sgr.correo
                    WHERE id_persona = $id_evaluar";
      $resultadocorreo = consultar_fuente($sqlcorreo);
      $sqltel = "SELECT count(id_persona) cantidad
                FROM sgr.telefono
                WHERE id_persona = $id_evaluar";
      $resultadotel = consultar_fuente($sqltel);
      $sqldom = "SELECT count(id_persona) cantidad
                FROM sgr.domicilio
                WHERE id_persona = $id_evaluar";
      $resultadodom = consultar_fuente($sqldom);
      if (($resultadoea[0]['cantidad'] + $resultadocorreo[0]['cantidad'] + $resultadotel[0]['cantidad'] + $resultadodom[0]['cantidad'])>=1){
        return 1;
      }
      else{
        return 0;
      }
    }

    static function consulta_borrado_entidad($id_evaluar)
    {
      $sqlper = "SELECT count(id_entidad) cantidad
                FROM sgr.persona
                WHERE id_entidad = $id_evaluar";
      $resultadoper = consultar_fuente($sqlper);
      $sqlcorreo = "SELECT count(id_entidad) cantidad
                    FROM sgr.correo
                    WHERE id_entidad = $id_evaluar";
      $resultadocorreo = consultar_fuente($sqlcorreo);
      $sqltel = "SELECT count(id_entidad) cantidad
                FROM sgr.telefono
                WHERE id_entidad = $id_evaluar";
      $resultadotel = consultar_fuente($sqltel);
      $sqldom = "SELECT count(id_entidad) cantidad
                FROM sgr.domicilio
                WHERE id_entidad = $id_evaluar";
      $resultadodom = consultar_fuente($sqldom);
      if (($resultadoper[0]['cantidad'] + $resultadocorreo[0]['cantidad'] + $resultadotel[0]['cantidad'] + $resultadodom[0]['cantidad'])>=1){
        return 1;
      }
      else{
        return 0;
      }
    }

  //////////////////////////////////////////////////////////////////////////////
  /////////// Consultas para borrado inteligente de tablas relacionadas ////////
  //////////////////////       Operaciones: Contacto      //////////////////////
  //////////////////////////////////////////////////////////////////////////////

    static function consulta_borrado_compania($id_evaluar)
    {
      $sql = "SELECT count(id_compania) cantidad
              FROM sgr.telefono
              WHERE id_compania = $id_evaluar";
      $resultado = consultar_fuente($sql);
      return $resultado[0]['cantidad'];
    }

    static function consulta_borrado_tipotel($id_evaluar)
    {
      $sql = "SELECT count(id_tipotel) cantidad
              FROM sgr.telefono
              WHERE id_tipotel = $id_evaluar";
      $resultado = consultar_fuente($sql);
      return $resultado[0]['cantidad'];
    }

    static function consulta_borrado_tipocorreo($id_evaluar)
    {
      $sql = "SELECT count(id_tipocorreo) cantidad
              FROM sgr.correo
              WHERE id_tipocorreo = $id_evaluar";
      $resultado = consultar_fuente($sql);
      return $resultado[0]['cantidad'];
    }

//////////////////////////////////////////////////////////////////////////////
/////////// Consultas para borrado inteligente de tablas relacionadas ////////
//////////////////////       Operaciones: Workflow      //////////////////////
//////////////////////////////////////////////////////////////////////////////

  static function consulta_borrado_workflow($id_evaluar)
  {
    $sql = "SELECT count(id_workflow) cantidad
            FROM sgr.registro
            WHERE id_workflow = $id_evaluar";
    $resultado = consultar_fuente($sql);
    return $resultado[0]['cantidad'];
  }

  static function consulta_borrado_evento($id_evaluar)
  {
    $sql = "SELECT count(id_evento) cantidad
            FROM sgr.workflow
            WHERE id_evento = $id_evaluar";
    $resultado = consultar_fuente($sql);
    return $resultado[0]['cantidad'];
  }

  static function consulta_borrado_tipoevento($id_evaluar)
  {
    $sql = "SELECT count(id_tipoevento) cantidad
            FROM sgr.evento
            WHERE id_tipoevento = $id_evaluar";
    $resultado = consultar_fuente($sql);
    return $resultado[0]['cantidad'];
  }

  static function consulta_borrado_estado($id_evaluar)
  {
    $sql = "SELECT count(id_estado) cantidad
            FROM sgr.estado_actual_flujo
            WHERE id_estado = $id_evaluar";
    $resultado = consultar_fuente($sql);
    return $resultado[0]['cantidad'];
  }

//////////////////////////////////////////////////////////////////////////////
/////////// Consultas para borrado inteligente de tablas relacionadas ////////
///////////////////      Perfiles: Contacto, Pais, etc     ///////////////////
//////////////////////////////////////////////////////////////////////////////

  static function consulta_borrado_ciudad($id_evaluar)
  {
    $sql = "SELECT count(id_ciudad) cantidad
            FROM sgr.domicilio
            WHERE id_ciudad = $id_evaluar";
    $resultado = consultar_fuente($sql);
    return $resultado[0]['cantidad'];
  }

  static function consulta_borrado_estadocivil($id_evaluar)
  {
    $sql = "SELECT count(id_estadocivil) cantidad
            FROM sgr.persona
            WHERE id_estadocivil = $id_evaluar";
    $resultado = consultar_fuente($sql);
    return $resultado[0]['cantidad'];
  }

  static function consulta_borrado_genero($id_evaluar)
  {
    $sql = "SELECT count(id_genero) cantidad
            FROM sgr.persona
            WHERE id_genero = $id_evaluar";
    $resultado = consultar_fuente($sql);
    return $resultado[0]['cantidad'];
  }

  static function consulta_borrado_nacionalidad($id_evaluar)
  {
    $sql = "SELECT count(id_nacionalidad) cantidad
            FROM sgr.persona
            WHERE id_nacionalidad = $id_evaluar";
    $resultado = consultar_fuente($sql);
    return $resultado[0]['cantidad'];
  }

  static function consulta_borrado_pais($id_evaluar)
  {
    $sql = "SELECT count(id_pais) cantidad
            FROM sgr.provincia
            WHERE id_pais = $id_evaluar";
    $resultado = consultar_fuente($sql);
    return $resultado[0]['cantidad'];
  }

  static function consulta_borrado_provincia($id_evaluar)
  {
    $sql = "SELECT count(id_provincia) cantidad
            FROM sgr.ciudad
            WHERE id_provincia = $id_evaluar";
    $resultado = consultar_fuente($sql);
    return $resultado[0]['cantidad'];
  }

  static function consulta_borrado_rol($id_evaluar)
  {
    $sql = "SELECT count(id_rol) cantidad
            FROM sgr.persona
            WHERE id_rol = $id_evaluar";
    $resultado = consultar_fuente($sql);
    return $resultado[0]['cantidad'];
  }

  static function consulta_borrado_rubro($id_evaluar)
  {
    $sql = "SELECT count(id_rubro) cantidad
            FROM sgr.entidad
            WHERE id_rubro = $id_evaluar";
    $resultado = consultar_fuente($sql);
    return $resultado[0]['cantidad'];
  }

  static function consulta_borrado_sector($id_evaluar)
  {
    $sql = "SELECT count(id_sector) cantidad
            FROM sgr.persona
            WHERE id_sector = $id_evaluar";
    $resultado = consultar_fuente($sql);
    return $resultado[0]['cantidad'];
  }

  static function consulta_borrado_sucursal($id_evaluar)
  {
    $sql = "SELECT count(id_sucursal) cantidad
            FROM sgr.dpto
            WHERE id_sucursal = $id_evaluar";
    $resultado = consultar_fuente($sql);
    return $resultado[0]['cantidad'];
  }

  static function consulta_borrado_tipodocumento($id_evaluar)
  {
    $sql = "SELECT count(id_tipo_doc) cantidad
            FROM sgr.persona
            WHERE id_tipo_doc = $id_evaluar";
    $resultado = consultar_fuente($sql);
    return $resultado[0]['cantidad'];
  }

/*
require_once('operaciones/metodosconsulta/dao_generico.php');

  $cantidad = dao_generico::consulta_borrado_evento($seleccion['id_evento']);
  if ($cantidad>0){
    toba::notificacion()->agregar('La operación fue cancelada por intentar borrar un Evento que está siendo utilizado por '.$cantidad.' flujos de trabajo. Para borrarlo deberá en primer lugar eliminar los registros asociados', 'warning');
  }
  else{
  }
*/
}
?>
