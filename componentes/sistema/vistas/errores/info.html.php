
<!--start-wrap--->
<div id="error" class="wrap">
    <!---start-header---->
    <div class="header">
        <div class="logo">
            <h1><a href="#">Error <?php echo $Error->COD_ERROR ?></a></h1>
        </div>
    </div>
    <!---End-header---->
    <?php var_dump($_POST); ?>
    <?php Vistas::cargar("errores/contenido", self::$datos, 'sistema'); ?>

    <div class="copy-right">
        <p>&#169 Puro Ingenio Samario <a href="<?php echo Parametros::valor('web_organizacion') ?>" target="_blank" ><?php echo Parametros::valor('nombre_organizacion') ?></a></p>
    </div>
</div>
<!--End-wrap--->