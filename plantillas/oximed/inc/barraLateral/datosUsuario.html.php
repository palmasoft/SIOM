<?php //print_r($_SESSION['OXIMED_USR']); ?>
<div class="profile">
  <div class="profile_pic">
    <img src="<?php echo Visitante::avatarUsuario() ?>" alt="..." class="img-circle profile_img">
  </div>
  <div class="profile_info">
    <span>Bienvenido,</span>
    <h2><?php echo Visitante::nombreUsuario() ?></h2>
  </div>
</div>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

