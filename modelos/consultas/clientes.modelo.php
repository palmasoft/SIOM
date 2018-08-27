<?php

/**
 * @author Puro Ingenio Samario
 * @version 1.0
 * @created 25-mar.-2015 11:22:18 a. m.
 */
class ConsultaClientes extends Modelos {

  private static
   $sqlCompleta = <<<EOD
SELECT
    clientes.*
    , personas.*   
    , tiposclientes.*
    , tiposidentificacion.*
    , (SELECT COUNT(clientescontactos.clienteContactoCliente) FROM clientescontactos WHERE clientescontactos.clienteContactoCliente = clientes.clienteId ) AS cantContactos
FROM
    clientes    
   INNER JOIN tiposclientes 
        ON (clientes.clienteTipo = tiposclientes.tipoClienteId)
    INNER JOIN personas 
        ON (clientes.clientePersona = personas.personaId) 
    INNER JOIN tiposidentificacion 
        ON (personas.personaTipoIdentificacion = tiposidentificacion.tipoIdentificacionId)
    LEFT JOIN recibosserviciosequipos 
        ON (clientes.clienteId = recibosserviciosequipos.reciboCliente) 
    LEFT JOIN reciboequipos 
        ON (recibosserviciosequipos.reciboId = reciboequipos.reciboServicioEquipo) 
    LEFT JOIN equipos 
        ON (reciboequipos.reciboEquipoEnServicio = equipos.equipoId) 
    LEFT JOIN tiposequipos 
        ON (equipos.equipoTipo = tiposequipos.tipoEquipoId) 
           
    LEFT JOIN clientescontactos 
        ON (clientes.clienteId = clientescontactos.clienteContactoCliente)    
    LEFT JOIN recibosserviciosequipos AS recibosserviciosequiposReferencia
        ON (clientescontactos.clienteContactoId = recibosserviciosequiposReferencia.reciboReferencia) 
    LEFT JOIN personas AS personaReferencia
        ON (clientescontactos.clienteContactoPersona = personaReferencia.personaId) 
    LEFT JOIN reciboequipos AS reciboequiposReferencia
        ON (recibosserviciosequiposReferencia.reciboId = reciboequiposReferencia.reciboServicioEquipo) 
    LEFT JOIN equipos AS equiposReferencia
        ON (reciboequiposReferencia.reciboEquipoEnServicio = equiposReferencia.equipoId) 
    LEFT JOIN tiposequipos AS tiposequiposReferencia
        ON (equiposReferencia.equipoTipo = tiposequiposReferencia.tipoEquipoId) 
        
EOD;

  static public
   function buscar($desde = NULL, $hasta = NULL, $cliente_servicio = NULL, $empleado_servicio = NULL, $tipoequipo_servicio = NULL) {
    $query = self::$sqlCompleta;

    if(!is_null($desde) and ! is_null($hasta)) {
      $query .= ' WHERE recibosserviciosequipos.reciboFechaServicio BETWEEN "' . $desde . ' 00:00:00" AND "' . $hasta . ' 23:59:59" ';
    }
    if(!is_null($cliente_servicio)) {
      $query .= 'AND recibosserviciosequipos.reciboCliente = "' . $cliente_servicio . '"  ';
    }
    if(!is_null($empleado_servicio)) {
      $query .= 'AND recibosserviciosequipos.reciboUsuarioCrea = "' . $empleado_servicio . '"  ';
    }
    if(!is_null($tipoequipo_servicio)) {
      $query .= 'AND tiposequipos.tipoEquipoId = "' . $tipoequipo_servicio . '"  ';
    }
    
    $query .= "GROUP BY 
    clientes.clienteId
    , personas.personaId    
    , tiposclientes.tipoClienteId 
    , tiposidentificacion.tipoIdentificacionId  ";

    $resultado = self::consulta($query);
    if(count($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

}
