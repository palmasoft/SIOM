<?php

class informacionControlador extends Controladores {
    function mostrarInformacion() {
        phpinfo();
        echo "--cargo--";
    }

}
