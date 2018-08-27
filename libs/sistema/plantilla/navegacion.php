<section >
    <h1>
        <?php echo $titulo_vista ?>        
    </h1>
    <h2><?php echo $descripcion_vista ?></h2>
    <ul class="breadcrumb">
        <?php
        if (count($ruta_navegacion))
            foreach ($ruta_navegacion as $id => $paso) {
                $utl = false;
                $clase = '';
                if ($key == count($array)) {
                    $ult = true;
                    $clase = ' active ';
                }
                ?>
                <li>
                    <?php if (!ult): ?><a href="javascript:void(0)" data-componente="<?php echo $paso->controlador ?>"  data-controlador="<?php echo $paso->controlador ?>"  data-accion="<?php echo $paso->controlador ?>"  data-script="" class="btn btn-default btn-flat control-de-accion <?php echo $clase ?> " ><?php endif; ?>
                        <i class="<?php echo $paso->icono ?>"></i> <?php echo $paso->nombre ?>
                        <?php if (!ult): ?></a><?php endif; ?>
                </li>
            <?php } ?>
    </ul>
</section>

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

