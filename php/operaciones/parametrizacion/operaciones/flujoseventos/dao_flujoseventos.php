<?php

class dao_flujoseventos
{

  static function get_datossinfiltro()
  {
    return self::get_datos('', true); ////20180414
  }

  static function get_datos($where='', $limit=false)
  {
    if ($where) {
      $where_armado = "WHERE $where";
    } else {
      $where_armado = '';
    }
    $limite=($limit ? 'limit 10':'');
    $sql = "SELECT wf.id_workflow, wf.nombre, te.nombre||': '||e.nombre evento, 0 tipoevento
            FROM sgr.workflow wf
            INNER JOIN sgr.evento e ON wf.id_evento = e.id_evento
            INNER JOIN sgr.tipo_evento te ON e.id_tipoevento = te.id_tipoevento
            $where_armado ORDER BY tipoevento, evento ASC
            $limite";
    $resultado = consultar_fuente($sql);
    return $resultado;
  }

}
?>
