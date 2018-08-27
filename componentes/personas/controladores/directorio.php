<?php

Modelos::cargar('Personas' . DS . 'TiposClientes');
Modelos::cargar('Personas' . DS . 'Clientes');
Modelos::cargar('Personas' . DS . 'Personas');
Modelos::cargar('Sistema' . DS . 'Mensajes');
Modelos::cargar('Sistema' . DS . 'TiposIdentificacion');

class directorioControlador extends Controladores {

  function validarExistenciaPersona() {
	if (isset(self::$datos['num_cedula'])) {
	  self::$datos['num_cedula'] = str_replace("_", "", self::$datos['num_cedula'] );
	  $Persona = Personas::datosPorCedula(self::$datos['num_cedula']);
	  if (is_null($Persona)) {
		echo json_encode(
		 array(
		  "mensaje" => "" . AlertasHTML5::informacion("La cedula [" . self::$datos['num_cedula'] . "] NO se encuentra en la base de datos.") . "",
		  "Persona" => $Persona)
		);
	  } else {
		echo json_encode(
		 array(
		  "mensaje" => "" . AlertasHTML5::advertencia(
			"La cedula [" . self::$datos['num_cedula'] . "] la pertenece a la persona <strong>" . $Persona->personaNombres . " " . $Persona->personaApellidos . "</strong>."
		   . "<em>Si consideras que esto es un error, comunicate con el adminsitrador del sistema para validar la información.</em> "),
		  "Persona" => $Persona)
		);
	  }
	}
  }

}
