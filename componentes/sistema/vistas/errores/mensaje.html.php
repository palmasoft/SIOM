
<!--start-content------>
<div class="content-error">
    <div class="mensaje" >
        <div id="info" style="" >
            <span>Ohh....</span>lo sentimos, pero tenemos un problema.
            <br />
            <strong>Error de <?php echo $Error->TIPO_ERROR ?> | <?php echo $Error->COD_ERROR ?></strong>
        </div>
        <img class="spinner" src="componentes/sistema/imagenes/error-img.png" 
             title="error" style="float: right;height: 180px;" />    
        <div style="clear: both" ></div>
        <div style="font-weight: bold;" >
            <div><?php echo $Error->TITULO_ERROR ?></div>
            <em><strong><?php echo $Error->CAUSA_ERROR ?></strong></em>
            <div> <i class="fa fa-book"></i> <?php echo $_POST['componente'] ?> | <i class="fa fa-code"></i> <?php echo $_POST['controlador'] ?>| <i class="fa fa-check"></i> <?php echo $_POST['accion'] ?></div>
        </div>
        <strong><?php echo $Error->SOLUCION_ERROR ?></strong>
        <div style="clear: both" ></div>
        <a href="./" class="btn btn-center btn-warning" >Re-iniciar</a>
    </div>
</div>
