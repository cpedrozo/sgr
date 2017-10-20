<?php
class pant_personas_pop extends toba_ei_pantalla
{
	function generar_layout()
	{
    $this->dep('form_persona')->generar_html();
    echo '<hr />';
    if ($this->dep('form_dom')->get_datos()['barrio'] === null) {
        echo '<div class="ef-sga-info-amariilo">No posee un domicilio</div>';
        $this->eliminar_dep('form_dom');
    } else {
        $this->dep('form_dom')->generar_html();
    }
		if ($this->dep('form_tel')->get_datos()['numero'] === null) {
				echo '<div class="ef-sga-info-amariilo">No posee un telefono</div>';
				$this->eliminar_dep('form_tel');
		} else {
				$this->dep('form_tel')->generar_html();
		}
		if ($this->dep('form_correo')->get_datos()['correo'] === null) {
				echo '<div class="ef-sga-info-amariilo">No posee un correo</div>';
				$this->eliminar_dep('form_correo');
		} else {
				$this->dep('form_correo')->generar_html();
		}
	}

}
?>
