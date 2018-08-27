<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Información de <?php echo Params::valor('nombre_organizacion') ?></title> 

    <!-- Bootstrap core CSS -->
    <link href="<?php echo Plantillas::$url ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo Plantillas::$url ?>fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo Plantillas::$url ?>css/animate.min.css" rel="stylesheet">
    <!-- Custom styling plus plugins -->
    <link href="<?php echo Plantillas::$url ?>css/custom.css" rel="stylesheet">
    <link href="<?php echo Plantillas::$url ?>css/icheck/flat/green.css" rel="stylesheet">
    <script src="<?php echo Plantillas::$url ?>js/jquery.min.js"></script>

    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]--> 

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

  </head>
  <body style="background:#F7F7F7;">
    <div class="">
      <a class="hiddenanchor" id="toregister"></a>
      <a class="hiddenanchor" id="tologin"></a>

      <div id="wrapper">

        <div id="login" class="animate form">
          <section class="login_content">
            <div class="text-center" >
              <img src="/archivos/oximeiser/logos/logo_oximed.png" style="max-width: 60%; margin: auto;" />
            </div>
            <form id="frm-login" onsubmit="return false;" >
              <h1>Solo empleados</h1>
              <div>
                <input type="text" name="txt_correo_usuario" class="form-control" placeholder="nombre de usuario" required="" />
              </div>
              <div>
                <input type="password" name="txt_clave_usuario" class="form-control" placeholder="clave " required="" />
              </div>
              
                <div id="div-resp-login"></div>
              <div>
                <button class="btn btn-default submit" type="submit">Entrar</button>
                <a class="reset_pass" href="#">olvidaste tu clave?</a>
              </div>
              <div class="clearfix"></div>
              <div class="separator">
                <div class="clearfix"></div>
                <br />
                <div>
                  <p>©<?php echo date('Y'); ?> Sistema de información de <a href="http://www.oximeiser.com"><strong>OXIMED MEISER S.A.S.</strong></a></p>
                  <a href="http://www.puroingeniosamario.com.co/" >
                    <h1 style="font-size: 2em;"><i class="fa fa-barcode" style="font-size: 1em;"></i> Puro ingenio samario!</h1>
                  </a>
                </div>
              </div>
              <input type="hidden" name="componente" value="sistema" />
              <input type="hidden" name="controlador" value="sesion" />
              <input type="hidden" name="accion" value="validar_usuario" />
            </form>
            <!-- form -->
          </section>
          <!-- content -->
        </div>
        <div id="register" class="animate form">
<!--          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>
              <div class="clearfix"></div>
              <div class="separator">

                <p class="change_link">Already a member ?
                  <a href="#tologin" class="to_register"> Log in </a>
                </p>
                <div class="clearfix"></div>
                <br />
                <div>
                  <h1><i class="fa fa-paw" style="font-size: 26px;"></i> Gentelella Alela!</h1>

                  <p>©2015 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
             form 
          </section>-->
          <!-- content -->
        </div>
      </div>
    </div>

    <script>
      $(document).ready(function () {
        $("#frm-login").submit(function () {
          $.post("controlador.php", $(this).serialize(), function (data) {
//            alert(data); 
            var respuesta = JSON.parse(data);
            if (respuesta.TIPO_RESPUESTA == 'EXITO') {
              location = './';
            } else {
              $("#div-resp-login").html(respuesta.MENSAJE_RESPUESTA);
            }
          });
        });
      });
    </script>


  </body>
</html>