<?php

class registros
{

  //////////////////////////////////////////////////////////////////////////////
  /////////// REGISTROS ////////////////////////////////////////////////////////
  //////////////////////////////////////////////////////////////////////////////

  static function get_descPopUpPersona($id_persona)
  {
    $id_persona = quote($id_persona);
    $sql = "SELECT p.apellido||', '||p.nombre apynom
            	FROM sgr.persona p
             WHERE p.id_persona = $id_persona";
    $resultado = consultar_fuente($sql);
    if (count($resultado) > 0) {
      return $resultado[0]['apynom'];
    } else {
      return 'Falló, intente nuevamente';
    }
  }

}
?>
