<?php
/////////////////////////////////////////////////////////////////
form_ml_tel

{$this->objeto_js}.evt__id_tipotel__procesar = function(es_inicial, fila)
{
  //--id_renglon = this.ef('id_tipotel').ir_a_fila(fila).get_estado();
  var nodo = this.ef('id_tipotel').ir_a_fila(fila).input();

  var indice = nodo.selectedIndex;
  var valor='';

  if (indice) {
      valor = nodo.options[indice].text;
  }
  alert(valor);
  alert(indice);
  var resultado = valor.substring(0,3);
  alert(resultado);

  if (resultado=='TRA')
  {
    this.ef('id_compania').mostrar();
  } else if (resultado=='CAS'){
    this.ef('id_compania').ocultar();
  }
  else {
    this.ef('id_compania').ocultar();
  }
}

/////////////////////////////////////////////////////////////////////////////
form_entidades

//---- Ocultar campos para personas ------------------------------------------------

{$this->objeto_js}.evt__id_tipopersona__procesar = function(es_inicial)
{
  var nodo = this.ef('id_camposempleado').input();

  var indice = nodo.selectedIndex;
  var valor='';

  if (indice) {
      valor = nodo.options[indice].text;
  }
  alert(valor);
  alert(indice);
  var resultado = valor.substring(0,2);
  alert(resultado);

  if (resultado=='SI')
  {
    this.ef('apellido').mostrar();
    this.ef('nombre').mostrar();
    this.ef('dni').mostrar();
    this.ef('fnac').mostrar();
    this.ef('id_genero').mostrar();
    this.ef('id_sucursal').mostrar();
    this.ef('id_dpto').mostrar();
    this.ef('id_rol').mostrar();
    this.ef('id_nacionalidad').mostrar();
    this.ef('id_estadocivil').mostrar();
  } else if (resultado=='NO'){
    this.ef('apellido').mostrar();
    this.ef('nombre').mostrar();
    this.ef('dni').mostrar();
    this.ef('fnac').mostrar();
    this.ef('id_genero').mostrar();
    this.ef('id_sucursal').ocultar();
    this.ef('id_dpto').ocultar();
    this.ef('id_rol').ocultar();
    this.ef('id_nacionalidad').mostrar();
    this.ef('id_estadocivil').mostrar();
  }
  else {
    this.ef('apellido').ocultar();
    this.ef('nombre').ocultar();
    this.ef('dni').ocultar();
    this.ef('fnac').ocultar();
    this.ef('id_genero').ocultar();
    this.ef('id_sucursal').ocultar();
    this.ef('id_dpto').ocultar();
    this.ef('id_rol').ocultar();
    this.ef('id_nacionalidad').ocultar();
    this.ef('id_estadocivil').ocultar();
  }
}
 ?>
