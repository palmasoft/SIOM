<div class="top_nav hidden-print" >
  <div class="nav_menu">
    <nav class="" role="navigation">
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>
      <ul class="nav navbar-nav navbar-right">
        <li>
          <a href="javascript:void();" class="" onclick="window.print();" 
             data-togle="tooltip" title="Imprimir Pantalla"  ><i class="fa fa-print"></i>
          </a>
        </li>
        <li class="">
          <a href="javascript:void();" class="user-profile dropdown-toggle" 
             data-toggle="dropdown" aria-expanded="false" >
            <img src="<?php echo Visitante::fotoPersona() ?>" alt=""><span class="hidden-xs" ><?php echo Visitante::nombreCompletoUsuario() ?></span>
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
            <li><a href="<?php echo Plantillas::$url ?>javascript:;">  Mi perfil</a></li>
            <!--            
            <li>
              <a href="<?php echo Plantillas::$url ?>javascript:;">
                <span class="badge bg-red pull-right">50%</span>
                <span>Settings</span>
              </a>
            </li>-->
            <li>
              <a href="<?php echo Plantillas::$url ?>javascript:;">Ayuda</a>
            </li>
            <li>
              <a href="javascript:void(0);" onclick="salir_sistema()" >
                <i class="fa fa-sign-out pull-right"></i> Salir
              </a>
            </li>
          </ul>
        </li>
        <?php if (ORIGEN != 'SMARTPHONE'): ?>
        <li role="presentation" class="dropdown">
          <a href="<?php echo Plantillas::$url ?>javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-bell-o"></i>
            <span class="badge bg-green" id="numAlertas" >0</span>
          </a>
          <ul id="menuAlertas" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu" style="height: 200px;overflow: auto;">
            
          </ul>
        </li>
        <?php endif; ?>
      </ul>
    </nav>
  </div>
</div>
<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

