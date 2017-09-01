<?php

class cargasexternas
{

  //////////////////////////////////////////////////////////////////////////////
  /////////// CARGA EXTERNA PROVINCIA, PAIS/////////////////////////////////////
  //////////////////////////////////////////////////////////////////////////////

  static function get_idextdomicilio($id_ciudad)
  {
    $id_ciudad = quote($id_ciudad);

    $sql = "SELECT pr.id_pais,
            pr.id_provincia
            FROM sgr.provincia pr
            JOIN sgr.ciudad ci ON ci.id_provincia = pr.id_provincia
            WHERE ci.id_ciudad = $id_ciudad";
    $resultado = consultar_fuente($sql);
    return $resultado[0];
  }

  //////////////////////////////////////////////////////////////////////////////
  /////////// carga externa tipo evento ////////////////////////////////////////
  //////////////////////////////////////////////////////////////////////////////

  static function get_idexttipoevento($id_evento)
  {
    $id_evento = quote($id_evento);

    $sql = "SELECT e.id_tipoevento
              FROM sgr.evento e
              WHERE e.id_evento = $id_evento";
    $resultado = consultar_fuente($sql);
    return $resultado[0];
  }

}
?>
