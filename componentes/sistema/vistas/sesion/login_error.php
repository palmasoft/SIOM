<?php
    switch ($error) {
        case 'ERROR_NOMBRE': ?>
			EL NOMBRE DE USUARIO ESTA ERRADO. POR FAVOR, VERIFICALO.
			<br />
			SI NO LO RECUERDAS, CONTACTA CON EL ADMINISTRADOR DEL SISTEMA.
<?php		break;
			
        case 'ERROR_CLAVE': ?>
			LA CLAVE ESCRITA ESTA ERRADA. POR FAVOR, VERIFICALA.
			<br />
			SI NO LA RECUERDAS, CONTACTA CON EL ADMINISTRADOR DEL SISTEMA.
<?php		break;
        
        default: ?>
			NO ENTIENDO EL RESULTADO QUE SE ME ENVIO.
			<br />
			URGENTE, CONTACTA CON EL ADMINISTRADOR DEL SISTEMA.
<?php		break;
    }
?>






