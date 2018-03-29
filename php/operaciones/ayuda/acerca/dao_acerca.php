<?php

class dao_acerca
{

  //////////////////////////////////////////////////////////////////////////////
  /////////// Consulta para cargar logo en la pantalla acerca de ///////////////
  //////////////////////////////////////////////////////////////////////////////

    static function consulta_logo()
    {
      $sql = "SELECT logo_chico
              FROM sgr.sgr
              WHERE activo IS TRUE
              LIMIT 1";
      $resultado = consultar_fuente($sql);
      return $resultado[0]['logo_chico'];
    }

    static function consulta_texto()
    {
      $sql = "SELECT nombre, version, desarrollador
              FROM sgr.sgr
              WHERE activo IS TRUE
              LIMIT 1";
      $resultado = consultar_fuente($sql);
      return $resultado[0];
    }

}
?>
