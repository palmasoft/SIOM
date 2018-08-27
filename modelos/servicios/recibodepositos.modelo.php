<?php

/**
 * @author Puro Ingenio Samario
 * @version 1.0
 * @created 25-mar.-2015 11:22:18 a. m.
 */
class ReciboDepositos extends Modelos {

    private static
            $nTabla = "recibodepositos";
    private static
            $sqlBase = <<<sqlBase
SELECT
    recibodepositos.*
    , tiposdepositos.*
    
    , DOC_SERVICIO.documentoId AS docServicioId
    , DOC_SERVICIO.documentoCodigo AS docServicioCodigo 
    , DOC_SERVICIO.documentoConsecutivo AS docServicioConsecutivo 
    , DOC_SERVICIO.documentoTitulo AS docServicioTitulo 
    , DOC_SERVICIO.documentoUrl AS docServicioUrl
    
    , DOC_INGRESO.documentoId AS docIngresoId
    , DOC_INGRESO.documentoCodigo AS docIngresoCodigo 
    , DOC_INGRESO.documentoConsecutivo AS docIngresoConsecutivo 
    , DOC_INGRESO.documentoTitulo AS docIngresoTitulo 
    , DOC_INGRESO.documentoUrl AS docIngresoUrl
    
    , DOC_EGRESO.documentoId AS docEgresoId
    , DOC_EGRESO.documentoCodigo AS docEgresoCodigo 
    , DOC_EGRESO.documentoConsecutivo AS docEgresoConsecutivo 
    , DOC_EGRESO.documentoTitulo AS docEgresoTitulo 
    , DOC_EGRESO.documentoUrl AS docEgresoUrl
    
    , recibosserviciosequipos.*
   
   ,( SELECT COUNT(reciboequipos.reciboEquipoId) FROM  reciboequipos 
     WHERE reciboequipos.reciboServicioEquipo = recibodepositos.reciboServicioDeposito ) AS NumEquipos 
    
FROM
    recibodepositos
    INNER JOIN recibosserviciosequipos 
        ON (recibodepositos.reciboServicioDeposito = recibosserviciosequipos.reciboServicio)
    LEFT JOIN documentos AS DOC_SERVICIO
        ON (recibosserviciosequipos.reciboDocumento = DOC_SERVICIO.documentoId)
    LEFT JOIN documentos AS DOC_INGRESO 
        ON (recibodepositos.reciboDepositoDocIngreso = DOC_INGRESO.documentoId)
    LEFT JOIN documentos AS DOC_EGRESO
        ON (recibodepositos.reciboDepositoDocEgreso = DOC_EGRESO.documentoId)
    INNER JOIN tiposdepositos 
        ON (recibodepositos.reciboDepositoTipo = tiposdepositos.depositoId)  
sqlBase;
    private static
            $sqlCompleta = <<<EOD
   SELECT
    tiposdepositos.*
    , recibodepositos.*
    , recibosserviciosequipos.*
    , servicios.* 
    
    , clientes.*
    , tiposidentificacion.*
    , cliente.*
    
    , clientescontactos.*
    , referencia.personaIdentificacion AS identificacionReferencia
    , referencia.personaNombres AS nombresReferencia
    , referencia.personaApellidos AS apellidosReferencia
    , referencia.personaDireccion AS direccionReferencia
    , referencia.personaCelular AS celularReferencia
    , referencia.personaCorreoElectronico AS correoReferencia
    
    , usuarios.*
    , encargado.personaIdentificacion AS identificacionRecibe
    , encargado.personaNombres AS nombresRecibe
    , encargado.personaApellidos AS apellidosRecibe
    , encargado.personaFirmaEscaneada AS firmaRecibe
   
    , docIngreso.documentoId
    , docIngreso.documentoConsecutivo
    , docIngreso.documentoTitulo
    , docIngreso.documentoUrl
    , tipoDocIngreso.tipoDocCodigo
    , tipoDocIngreso.tipoDocTitulo
    , tipoDocIngreso.tipoDocActual 
   
   
    , docEgreso.documentoId  AS  documentoIdEgreso 
    , docEgreso.documentoConsecutivo AS documentoConsecutivoEgreso 
    , docEgreso.documentoTitulo  AS  documentoTituloEgreso 
    , docEgreso.documentoUrl AS documentoUrlEgreso 
    , tipoDocEgreso.tipoDocCodigo AS tipoDocCodigoEgreso 
    , tipoDocEgreso.tipoDocTitulo AS tipoDocTituloEgreso 
    , tipoDocEgreso.tipoDocActual  AS tipoDocActualEgreso 
   
   
   
   
   
    , DevueltoA.personaIdentificacion AS identificacionDevueltoA
    , DevueltoA.personaNombres AS nombresDevueltoA
    , DevueltoA.personaApellidos AS apellidosDevueltoA
    , DevueltoA.personaDireccion AS direccionDevueltoA
    , DevueltoA.personaCelular AS celularDevueltoA
    , DevueltoA.personaCorreoElectronico AS correoDevueltoA
   
   
    , cajero.personaIdentificacion AS identificacionDevuelve 
    , cajero.personaNombres AS nombresDevuelve 
    , cajero.personaApellidos AS apellidosDevuelve 
    , cajero.personaFirmaEscaneada AS firmaDevuelve 
   
   
FROM
    recibodepositos
    INNER JOIN recibosserviciosequipos 
        ON (recibodepositos.reciboServicioDeposito = recibosserviciosequipos.reciboId)
    INNER JOIN tiposdepositos 
        ON (recibodepositos.reciboDepositoTipo = tiposdepositos.depositoId)
    INNER JOIN servicios 
        ON (recibosserviciosequipos.reciboServicio = servicios.servicioId)
    INNER JOIN clientes 
        ON (recibosserviciosequipos.reciboCliente = clientes.clienteId)
    INNER JOIN personas AS cliente
        ON (clientes.clientePersona = cliente.personaId)
    INNER JOIN tiposidentificacion 
        ON (cliente.personaTipoIdentificacion = tiposidentificacion.tipoIdentificacionId)
    LEFT JOIN clientescontactos 
        ON (recibosserviciosequipos.reciboReferencia = clientescontactos.clienteContactoId)
    LEFT JOIN personas AS referencia
        ON (clientescontactos.clienteContactoPersona = referencia.personaId)
   
   
    LEFT JOIN personas AS DevueltoA
        ON (recibodepositos.reciboDepositoDevueltoA = DevueltoA.personaId)
       
    LEFT JOIN usuarios 
        ON (recibodepositos.reciboDepositoRecibio = usuarios.usuarioId)
    LEFT JOIN personas AS encargado
        ON (usuarios.usuarioPersona = encargado.personaId)

   
    LEFT JOIN usuarios AS usuarioDevuelve
        ON (recibodepositos.reciboDepositoDevolvio = usuarioDevuelve.usuarioId)
    LEFT JOIN personas AS cajero
        ON (usuarioDevuelve.usuarioPersona = cajero.personaId)

   
    LEFT JOIN documentos AS docIngreso
        ON (recibodepositos.reciboDepositoDocIngreso = docIngreso.documentoId)
    LEFT JOIN tiposdocumentos AS tipoDocIngreso
        ON (docIngreso.documentoTipo = tipoDocIngreso.tipoDocId)
   
    LEFT JOIN documentos AS docEgreso
        ON (recibodepositos.reciboDepositoDocEgreso = docEgreso.documentoId)
    LEFT JOIN tiposdocumentos AS tipoDocEgreso
        ON (docEgreso.documentoTipo = tipoDocEgreso.tipoDocId)
   
EOD;
    private static
            $sqlJoin = "";

    static public
            function todos($ESTADO = NULL) {
        $query = self::$sqlBase . '';
        if (!is_null($ESTADO)) {
            $query .= ' WHERE reciboDepositoEstado = "' . $ESTADO . '" ';
        }
        $query .= ' ORDER BY reciboDepositoRecibido DESC';
        $resultado = self::consulta($query);
        if (count($resultado) > 0) {
            return $resultado;
        }
        return NULL;
    }

    static public
            function del_servicio($idServicio) {
        $query = self::$sqlCompleta . ' WHERE servicios.servicioId = ' . $idServicio . ' ';
        $resultado = self::consulta($query);
        if (count($resultado) > 0) {
            return $resultado[0];
        }
        return NULL;
    }

    static public
            function del_recibo($idRecibo) {
        $query = self::$sqlCompleta . ' WHERE recibosserviciosequipos.reciboId = ? ';
        $resultado = self::consulta($query, array($idRecibo));
        if (count($resultado) > 0) {
            return $resultado[0];
        }
        return NULL;
    }

    static public
            function datos($idReciboDeposito) {
        $query = self::$sqlBase . " WHERE recibodepositos.reciboDepositoId = ? ";
        $resultado = self::consulta($query, array($idReciboDeposito));
        if (count($resultado) > 0) {
            return $resultado[0];
        }
        return NULL;
    }

    static public
            function datos_completos($idReciboDeposito) {
        $query = self::$sqlCompleta . " WHERE recibodepositos.reciboDepositoId = ? ";
        $resultado = self::consulta($query, array($idReciboDeposito));
        if (count($resultado) > 0) {
            return $resultado[0];
        }
        return NULL;
    }

    static public
            function insertar($reciboServicioDeposito, $reciboDepositoTipo, $reciboDepositoValor) {
        $query = " INSERT INTO recibodepositos   ( "
                . "reciboServicioDeposito, reciboDepositoTipo, reciboDepositoValor, reciboDepositoRecibio "
                . ") VALUES ( ?, ?, ?, ? ) ; ";
        $resultado = self::crearUltimoId(
                        $query, array($reciboServicioDeposito, $reciboDepositoTipo, $reciboDepositoValor, Visitante::idUsuario())
        );
        if (($resultado) > 0) {
            return $resultado;
        }
        return NULL;
    }

    static public
            function actualizar_documento_ingreso($reciboDepositoId, $reciboDepositoDocIngreso) {
        $query = " UPDATE recibodepositos SET "
                . "reciboDepositoDocIngreso = ? "
                . "WHERE reciboDepositoId = ? ; ";
        $resultado = self::modificarRegistros(
                        $query, array($reciboDepositoDocIngreso, $reciboDepositoId)
        );
        if (($resultado) > 0) {
            return $resultado;
        }
        return NULL;
    }

    static public
            function actualizar_documento_egreso($reciboDepositoId, $reciboDepositoDocEgreso) {
        $query = " UPDATE recibodepositos SET "
                . "reciboDepositoDocEgreso = ? "
                . "WHERE reciboDepositoId = ? ; ";
        $resultado = self::modificarRegistros(
                        $query, array($reciboDepositoDocEgreso, $reciboDepositoId)
        );
        if (($resultado) > 0) {
            return $resultado;
        }
        return NULL;
    }

    static public
            function devolverDinero($reciboDepositoId, $reciboDepositoDevueltoA) {
        $query = " UPDATE recibodepositos SET "
                . "reciboDepositoDevueltoA = ?, reciboDepositoDevolvio = ?, "
                . "reciboDepositoEstado = 'DEVUELTO', reciboDepositoDevuelto = CURRENT_TIMESTAMP  "
                . "WHERE reciboDepositoId = ? ; ";
        $resultado = self::modificarRegistros(
                        $query, array($reciboDepositoDevueltoA, Visitante::idUsuario(), $reciboDepositoId)
        );
        if (($resultado) > 0) {
            return $resultado;
        }
        return NULL;
    }

    static public
            function anular($reciboDepositoId) {
        $query = " UPDATE recibodepositos SET "
                . "reciboDepositoEstado = 'ANULADO' ,"
                . "reciboDepositoAnulado = CURRENT_TIMESTAMP ,"
                . "reciboDepositoAnula  = ? "
                . "WHERE reciboDepositoId = ? ; ";
        $resultado = self::modificarRegistros(
                        $query, array(Visitante::idUsuario(), $reciboDepositoId)
        );
        if (($resultado) > 0) {
            return $resultado;
        }
        return NULL;
    }

}
