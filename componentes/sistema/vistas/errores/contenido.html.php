
<!--start-content------>
<div class="content-error">
    <div class="mensaje" >
        <div id="info" style="" >
            <span>Ohh....</span>lo sentimos, pero tenemos un problema.
            <br />
            <strong>Error de <?php echo $Error->TIPO_ERROR ?> | <?php echo $Error->COD_ERROR ?></strong>
        </div>
        <div style="clear: both" ></div>

        <div id="stage" style="width: 50%; height: 128px; ">
            <p id="spinner" style="background: transparent; text-align: center; ">
                <img src="componentes/sistema/imagenes/error-img.png" style="max-width: 100%; height: 128px; " />
            </p>
        </div>
        <div>
            <h5><?php echo $Error->TITULO_ERROR ?></h5>
            <em><strong><?php echo $Error->CAUSA_ERROR ?></strong></em>
            <div> <i class="fa fa-book"></i> <?php echo $_POST['componente'] ?> | <i class="fa fa-code"></i> <?php echo $_POST['controlador'] ?>| <i class="fa fa-check"></i> <?php echo $_POST['accion'] ?></div>
        </div>
        <h4><?php echo $Error->SOLUCION_ERROR ?></h4>
        <div style="clear: both" ></div>
        <a href="./">Re-iniciar</a>
    </div>
</div>
