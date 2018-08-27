<?php

require_once('libs/correos/Correos.php');

class CorreosDepositosServicios {

  static
   function enviarDevolucion($DatosDeposito) {

    $htmlContenido = Archivos::leer_archivo(PATH_MODELOS . "correos" . DS . "servicios" . DS . "devoluciondeposito.html.php");
    $htmlContenido = str_replace(
     array(
     '%%LOGO_OXIMED%%', '%%FECHADEVOLUCIONDEPOSITO%%',
     '%%NOMBRECLIENTE%%', '%%NUMRECIBO%%', '%%NUMEGRESO%%', '%%VALORDEPOSITO%%'
     ),
     array(
     URL_ARCHIVOS . Params::valor('logo_organizacion'),
     $DatosDeposito->reciboDepositoDevuelto,
     $DatosDeposito->personaRazonSocial,
     $DatosDeposito->reciboNumero,
     $DatosDeposito->documentoConsecutivoEgreso,
     $DatosDeposito->reciboDepositoValor
     ), $htmlContenido
    );

    $mail = new Correos();
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'localhost';                            // Specify main and backup SMTP servers
    $mail->SMTPAuth = false;                              // Enable SMTP authentication
    $mail->Username = 'user@example.com';                 // SMTP username
    $mail->Password = 'secret';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    
    $mail->setFrom(Params::valor('correo_pedidos'), Textos::paraCorreos(Params::valor('nombre_pedidos')));
    $mail->addAddress(Params::valor('correo_pedidos'), Textos::paraCorreos(Params::valor('nombre_pedidos')));     
    $mail->addReplyTo(Params::valor('correo_pedidos'), Textos::paraCorreos(Params::valor('nombre_pedidos')));
//    $mail->addCC('cc@example.com');
//    $mail->addBCC('bcc@example.com');
//    $mail->addAttachment(PATH_ARCHIVOS . str_replace(array(URL_ARCHIVOS, WS), array('', DS),
//                                                     $DatosDeposito->documentoRecibo->documentoUrl));         // Add attachments
    if(!is_null($DatosDeposito->documentoUrlEgreso)) {
      $mail->addAttachment(PATH_ARCHIVOS . str_replace(array(URL_ARCHIVOS, WS), array('', DS),
                                                       $DatosDeposito->documentoUrlEgreso));         // Add attachments
    }
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = Textos::paraCorreos('NOTIFICACIÓN DE DEVOLUCION DE DEPOSITO EN ' . strtoupper(Params::valor('nombre_organizacion')));
    $mail->Body = $htmlContenido;
    $mail->AltBody = strip_tags($mail->Body);

    if(!$mail->send()) {
      return $mail->ErrorInfo;
    } else {
      return TRUE;
    }
  }

}
