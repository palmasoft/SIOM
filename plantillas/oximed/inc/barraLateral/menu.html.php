<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
            <li><a href="javascript:void(0);" onclick="mostrar_widgets_bienvenida();" ><i class="fa fa-pagelines"></i> Panel de Inicio <span class="fa fa-chevron-circle-right"></span></a>
                <?php foreach ($_SESSION['OXIMED_USR']->componentes as $Componente): ?>
                    <?php if (count($Componente->permisos)): ?>
                    <li><a><i class="<?php echo $Componente->componenteIcono ?>"></i> <?php echo $Componente->componenteTitulo ?> <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <?php foreach ($Componente->permisos as $Funcion): ?>
                                <li><a href="javacript:void(0)" class="menu-funcion" data-modulo="<?php echo $Funcion->funcionModulo ?>" 
                                       data-logica="<?php echo $Funcion->funcionLogica ?>" 
                                       data-tarea="<?php echo $Funcion->funcionTarea ?>" ><?php echo $Funcion->funcionNombre ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </div>
    <hr />
    <!--  <div class="menu_section">
        <h3>Live On</h3>
        <ul class="nav side-menu">
    
        </ul>
      </div>-->

</div>
<!-- /sidebar menu -->

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

