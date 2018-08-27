<?php
/**
 * @author Puro Ingenio Samario
 * @version 1.0
 * @created 25-mar.-2015 11:22:18 a. m.
 */
class ConsultaServicios extends Modelos {
  private static
   $sqlCompleta = <<<EOD
   SELECT 
  servicios.*
  , recibosserviciosequipos.*
  , clientes.*
  , cliente.*
  , tiposidentificacion.*
  , clientescontactos.* 
  , referencia.personaTipoIdentificacion AS tipoIdReferencia
  , referencia.personaIdentificacion AS idReferencia
  , referencia.personaRazonSocial AS razonSocialReferencia
  , referencia.personaNombreComercial AS nombreComercialReferencia
  , referencia.personaNombres AS nombresReferencia
  , referencia.personaApellidos AS apellidosReferencia
  , referencia.personaDireccion AS direccionReferencia
  , referencia.personaTelefono AS telefonoReferencia
  , referencia.personaCelular AS celularReferencia
  , referencia.personaCorreoElectronico AS correoReferencia
  , referencia.personaLatitud AS latitudReferencia
  , referencia.personaLongitud AS longitudReferencia
  , referencia.personaObservaciones AS obsReferencia
  , referencia.personaLogo AS logoReferencia
  , referencia.personaFotoReferencia AS fotoReferencia
  , usuarios.*
  , encargado.personaTipoIdentificacion AS tipoIdEncargado
  , encargado.personaIdentificacion AS idEncargado
  , encargado.personaNombres AS nombresEncargado
  , encargado.personaApellidos AS apellidosEncargado
  , encargado.personaFirmaEscaneada AS firmaEncargado
  , documentos.*
  , tiposdocumentos.*
  , recibodepositos.*
  , recibodepositos.reciboDepositoValor AS totalDeposito
  ,  (SELECT 
    COUNT(reciboequipos.reciboEquipoId) 
  FROM
    reciboequipos 
  WHERE recibosserviciosequipos.reciboId = reciboequipos.reciboServicioEquipo) AS equiposRecibo
  
FROM
  servicios 
  LEFT JOIN recibosserviciosequipos 
    ON (
      servicios.servicioId = recibosserviciosequipos.reciboServicio
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
  LEFT JOIN recibodepositos
    ON (
      recibosserviciosequipos.reciboId = recibodepositos.reciboServicioDeposito
    ) 
  LEFT JOIN usuarios 
    ON (
      recibosserviciosequipos.reciboUsuarioCrea = usuarios.usuarioId
    ) 
  LEFT JOIN personas AS cliente 
    ON (
      clientes.clientePersona = cliente.personaId
    ) 
  LEFT JOIN tiposidentificacion 
    ON (
      cliente.personaIdentificacion = tiposidentificacion.tipoIdentificacionId
    ) 
  LEFT JOIN personas AS referencia 
    ON (
      clientescontactos.clienteContactoPersona = referencia.personaId
    ) 
  LEFT JOIN tiposdocumentos 
    ON (
      documentos.documentoTipo = tiposdocumentos.tipoDocId
    ) 
  LEFT JOIN personas AS encargado 
    ON (
      usuarios.usuarioPersona = encargado.personaId
    )
EOD;

  static public
   function buscar($desde = NULL, $hasta = NULL, $cliente_servicio = NULL, $empleado_servicio = NULL) {
    $query = self::$sqlCompleta;

    if(!is_null($desde) and ! is_null($hasta)) {
      $query .= ' WHERE recibosserviciosequipos.reciboFechaServicio BETWEEN "' . $desde . ' 00:00:00" AND "' . $hasta . ' 23:59:59 " ';
    }
    if(!is_null($cliente_servicio)) {
      $query .= ' AND recibosserviciosequipos.reciboCliente = "' . $cliente_servicio . '"  ';
    }
    if(!is_null($empleado_servicio)) {
      $query .= ' AND recibosserviciosequipos.reciboUsuarioCrea = "' . $empleado_servicio . '"  ';
    }
    $resultado = self::consulta($query);
    if(count($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

}