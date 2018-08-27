<?php

/**
 * @author Puro Ingenio Samario
 * @version 1.0
 * @created 25-mar.-2015 11:22:18 a. m.
 */
class Recogidas extends Modelos {

  private static
   $sqlProximas = <<<sqlEquiposEnServicio
SELECT 
  recibosserviciosequipos.*
  , documentos.*
  , servicios.servicioId
  , clientes.clienteId
  , clientes.clienteCodigo
  , personas.personaRazonSocial
  , personas.personaNombres
  , personas.personaApellidos
  , personas.personaFotoReferencia
  , personas.personaLogo
  , personas_1.personaRazonSocial AS referenciaRazonSocial
  , personas_1.personaNombres AS referenciaNombres
  , personas_1.personaApellidos AS referenciaApellidos 
FROM
  recibosserviciosequipos 
  LEFT JOIN servicios 
    ON (
      recibosserviciosequipos.reciboServicio = servicios.servicioId
    ) 
  LEFT JOIN clientes 
    ON (
      recibosserviciosequipos.reciboCliente = clientes.clienteId
    ) 
  LEFT JOIN clientescontactos 
    ON (
      recibosserviciosequipos.reciboReferencia = clientescontactos.clienteContactoId
    ) 
  LEFT JOIN documentos 
    ON (
      recibosserviciosequipos.reciboDocumento = documentos.documentoId
    ) 
  LEFT JOIN personas 
    ON (
      clientes.clientePersona = personas.personaId
    ) 
  LEFT JOIN personas AS personas_1 
    ON (
      clientescontactos.clienteContactoPersona = personas_1.personaId
    ) 
  LEFT JOIN reciboequipos 
    ON (
      reciboequipos.reciboServicioEquipo = recibosserviciosequipos.reciboId
    ) 
  LEFT JOIN equipos 
    ON (
      equipos.equipoId = reciboequipos.reciboEquipoEnServicio
    )  
sqlEquiposEnServicio;

  static public
   function proximas($numServicio = 10) {
    $query = self::$sqlProximas . 'WHERE equipos.equipoEstadoServicio = 2 
      AND equipos.equipoReciboServicio = recibosserviciosequipos.reciboId 
      GROUP BY recibosserviciosequipos.reciboId '; 
    $resultado = self::consulta($query);
    if(count($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  static public
   function proximasEnAlerta($numServicio = 10) {
    $query = self::$sqlProximas . 'WHERE equipos.equipoEstadoServicio = 2       '
     . 'AND equipos.equipoReciboServicio = recibosserviciosequipos.reciboId '
     . 'AND  ( recibosserviciosequipos.reciboFechaRecogida BETWEEN  '
     . '  NOW() AND  DATE_ADD(NOW(), INTERVAL '.Parametros::valor('dias_recogida').' DAY)  )  '
     . 'GROUP BY recibosserviciosequipos.reciboId '
     . 'ORDER BY reciboFechaRecogida ASC ';    
    $resultado = self::consulta($query);
    if(count($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

}
