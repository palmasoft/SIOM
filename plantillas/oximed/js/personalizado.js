/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function cerrar_sesion_usuario() {
  window.location = '/';
}




$(function () {
  $('#sidebar-menu li ul').slideUp();
  $('#sidebar-menu li').removeClass('active');

  $('#sidebar-menu li').click(function () {
    if ($(this).is('.active')) {
      $(this).removeClass('active');
      $('ul', this).slideUp();
      $(this).removeClass('nv');
      $(this).addClass('vn');
    } else {
      $('#sidebar-menu li ul').slideUp();
      $(this).removeClass('vn');
      $(this).addClass('nv');
      $('ul', this).slideDown();
      $('#sidebar-menu li').removeClass('active');
      $(this).addClass('active');
    }
  });

  $('#menu_toggle').click(function () {
    if ($('body').hasClass('nav-md')) {
      $('body').removeClass('nav-md');
      $('body').addClass('nav-sm');
      $('.left_col').removeClass('scroll-view');
      $('.left_col').removeAttr('style');
      $('.sidebar-footer').hide();

      if ($('#sidebar-menu li').hasClass('active')) {
        $('#sidebar-menu li.active').addClass('active-sm');
        $('#sidebar-menu li.active').removeClass('active');
      }
    } else {
      $('body').removeClass('nav-sm');
      $('body').addClass('nav-md');
      $('.sidebar-footer').show();

      if ($('#sidebar-menu li').hasClass('active-sm')) {
        $('#sidebar-menu li.active-sm').addClass('active');
        $('#sidebar-menu li.active-sm').removeClass('active-sm');
      }
    }
  });
});

$(function () {
  var url = window.location;
  $('#sidebar-menu a[href="' + url + '"]').parent('li').addClass('current-page');
  $('#sidebar-menu a').filter(function () {
    return this.href == url;
  }).parent('li').addClass('current-page').parent('ul').slideDown().parent().addClass('active');
});



$(document).ready(function () {

  $(".menu-funcion").click(function (evt) {
    evt.preventDefault();
    $(".menu-funcion").removeClass('animate bounceIn');
    $(this).addClass('animate bounceIn');
    $(".menu-funcion").parent('li').removeClass('menu-activo');
    $(this).parent('li').addClass('menu-activo');
    mostrar_contenidos($(this).attr('data-modulo'), $(this).attr('data-logica'), $(this).attr('data-tarea'), $(this).attr('data-datos'));
  });


  $(".scroll-view").niceScroll({
    touchbehavior: true,
    cursorcolor: "rgba(42, 63, 84, 0.35)"
  });



  mostrar_widgets_bienvenida();

});








