<?php

/**
 * @author Puro Ingenio Samario
 * @version 1.0
 * @created 25-mar.-2015 11:22:18 a. m.
 */
class ConsultaEquipos extends Modelos {

    private static
            $sqlCompleta = <<<EOD
   SELECT
    tiposequipos.*
    , equipos.*
   , equiposestados.*
    , COUNT(recibosserviciosequipos.reciboId) as numRecibos
FROM
    equipos
    LEFT JOIN tiposequipos 
        ON (equipos.equipoTipo = tiposequipos.tipoEquipoId)
    LEFT JOIN equiposestados 
        ON (equipos.equipoEstadoServicio = equiposestados.equipoEstadoId)
    LEFT JOIN reciboequipos 
        ON (equipos.equipoId = reciboequipos.reciboEquipoEnServicio)
    LEFT JOIN recibosserviciosequipos 
        ON (reciboequipos.reciboServicioEquipo = recibosserviciosequipos.reciboId)
    LEFT JOIN servicios 
        ON (recibosserviciosequipos.reciboServicio = servicios.servicioId)
    LEFT JOIN clientes 
        ON (recibosserviciosequipos.reciboCliente = clientes.clienteId)
    LEFT JOIN usuarios 
        ON (recibosserviciosequipos.reciboUsuarioCrea = usuarios.usuarioId)
    LEFT JOIN clientescontactos 
        ON (recibosserviciosequipos.reciboReferencia = clientescontactos.clienteContactoId)
    LEFT JOIN personas 
        ON (clientes.clientePersona = personas.personaId)
    LEFT JOIN personas AS personas_1
        ON (usuarios.usuarioPersona = personas_1.personaId)
    LEFT JOIN personas AS personas_2
        ON (clientescontactos.clienteContactoPersona = personas_2.personaId)
EOD;

    static public
            function buscar($desde = NULL, $hasta = NULL, $cliente_servicio = NULL, $empleado_servicio = NULL, $tipoequipo_servicio = NULL) {
        $query = self::$sqlCompleta;

        if (!is_null($desde) and ! is_null($hasta)) {
            $query .= ' WHERE recibosserviciosequipos.reciboFechaServicio BETWEEN "' . $desde . ' 00:00:00" AND "' . $hasta . ' 23:59:59" ';
        }
        if (!is_null($cliente_servicio)) {
            $query .= 'AND recibosserviciosequipos.reciboCliente = "' . $cliente_servicio . '"  ';
        }
        if (!is_null($empleado_servicio)) {
            $query .= 'AND recibosserviciosequipos.reciboUsuarioCrea = "' . $empleado_servicio . '"  ';
        }
        if (!is_null($tipoequipo_servicio)) {
            $query .= 'AND tiposequipos.tipoEquipoId = "' . $tipoequipo_servicio . '"  ';
        }
        $query .= 'GROUP BY tiposequipos.tipoEquipoId , equipos.equipoId, equiposestados.equipoEstadoId ';
        $resultado = self::consulta($query);
        if (count($resultado) > 0) {
            return $resultado;
        }
        return NULL;
    }

    
}
