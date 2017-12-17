de la 279 en adelante

else {
  $this->s__datos['operacion'] = 'modificacion';
  $this->s__datos['datos_nuevos_form'] = dao_personas::get_empleadobaja($this->s__datos['seleccion']['id_persona']);
  $respuesta = 'Se modificaron uno o mas datos del empleado '.$this->s__datos['datos_anteriores_form']['legajo'].': '.$this->s__datos['datos_anteriores_form']['apynom'].'<br/><br/>
  <table style="width:40%">
  <tr style="text-align:left">
    <th>Campo</th>
    <th>Anterior</th>
    <th>Actual</th>
  </tr>';
  foreach ($camposdao as $value) {
    if ($this->s__datos['datos_anteriores_form'][$value]<>$this->s__datos['datos_nuevos_form'][$value]){
      $valornuevo = $this->s__datos['datos_nuevos_form'][$value];
      $valorviejo = $this->s__datos['datos_anteriores_form'][$value];
      if (!(is_null ($valorviejo) and is_null($valornuevo))){
      $respuesta = $respuesta."<tr style='text-align:left'>
        <td>$value</td>
        <td>$valorviejo</td>
        <td>$valornuevo</td>
      </tr>";
      }
    }
  }
  $respuesta = $respuesta.'</table>';
}
}



else {
  $this->s__datos['operacion'] = 'modificacion';
  $this->s__datos['datos_nuevos_form'] = dao_personas::get_empleadobaja($this->s__datos['seleccion']['id_persona']);
  if (!is_null ($camposdao)){
    foreach ($camposdao as $value) {
      if ($this->s__datos['datos_anteriores_form'][$value]<>$this->s__datos['datos_nuevos_form'][$value]){
        $valornuevo = $this->s__datos['datos_nuevos_form'][$value];
        $valorviejo = $this->s__datos['datos_anteriores_form'][$value];
        if (!(is_null ($valorviejo) and is_null($valornuevo))){
        $verificador = '1';
        $respuesta = $respuesta."<tr style='text-align:left'>
          <td>$value</td>
          <td>$valorviejo</td>
          <td>$valornuevo</td>
        </tr>";
        }
      }
      //ei_arbol(['recorre_foreach'=>$respuesta]);
    }
    //ei_arbol(['salio_foreach'=>$respuesta]);
    if ($verificador = '1'){
        $respuesta = 'Se modificaron los datos de contacto del empleado '.$this->s__datos['datos_anteriores_form']['legajo'].': '.$this->s__datos['datos_anteriores_form']['apynom'].'<br/><br/>';
        //ei_arbol(['si resp es 1 se carga con esto'=>$respuesta]);
    }
    else{
      $respuesta = 'Se modificaron uno o mas datos personales del empleado '.$this->s__datos['datos_anteriores_form']['legajo'].': '.$this->s__datos['datos_anteriores_form']['apynom'].'<br/><br/>
      <table style="width:40%">
      <tr style="text-align:left">
      <th>Campo</th>
      <th>Anterior</th>
      <th>Actual</th>
      </tr>';
      foreach ($camposdao as $value) {
        if ($this->s__datos['datos_anteriores_form'][$value]<>$this->s__datos['datos_nuevos_form'][$value]){
          $valornuevo = $this->s__datos['datos_nuevos_form'][$value];
          $valorviejo = $this->s__datos['datos_anteriores_form'][$value];
          if (!(is_null ($valorviejo) and is_null($valornuevo))){
            $respuesta = $respuesta."<tr style='text-align:left'>
            <td>$value</td>
            <td>$valorviejo</td>
            <td>$valornuevo</td>
            </tr>";
          }
        }
      }
      $respuesta = $respuesta.'</table>';
    }
    //ei_arbol(['como resp no es 1 se carga con esto'=>$respuesta]);
  }
}
}
