
<div class="row">
  <div class="col-md-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Calendario de Recolección <small> de Equipos</small></h2>
        <ul class="nav navbar-right panel_toolbox">
<!--          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Settings 1</a>
              </li>
              <li><a href="#">Settings 2</a>
              </li>
            </ul>
          </li>
          <li><a class="close-link"><i class="fa fa-close"></i></a>
          </li>-->
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">

        <div id='calendar'></div>

      </div>
    </div>
  </div>
</div>

<!-- Start Calender modal -->
<div id="CalenderModalNew" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">New Calender Entry</h4>
      </div>
      <div class="modal-body">
        <div id="testmodal" style="padding: 5px 20px;">
          <form id="antoform" class="form-horizontal calender" role="form">
            <div class="form-group">
              <label class="col-sm-3 control-label">Title</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="title" name="title">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Description</label>
              <div class="col-sm-9">
                <textarea class="form-control" style="height:55px;" id="descr" name="descr"></textarea>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary antosubmit">Save changes</button>
      </div>
    </div>
  </div>
</div>
<div id="CalenderModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel2">Edit Calender Entry</h4>
      </div>
      <div class="modal-body">

        <div id="testmodal2" style="padding: 5px 20px;">
          <form id="antoform2" class="form-horizontal calender" role="form">
            <div class="form-group">
              <label class="col-sm-3 control-label">Title</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="title2" name="title2">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Description</label>
              <div class="col-sm-9">
                <textarea class="form-control" style="height:55px;" id="descr2" name="descr"></textarea>
              </div>
            </div>

          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary antosubmit2">Save changes</button>
      </div>
    </div>
  </div>
</div>
<div id="fc_create" data-toggle="modal" data-target="#CalenderModalNew"></div>
<div id="fc_edit" data-toggle="modal" data-target="#CalenderModalEdit"></div>
<!-- End Calender modal -->

<script>
  $(document).ready(function () {

    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    var started;
    var categoryClass;

    var calendar = $('#calendar').fullCalendar({
      lang: 'es',
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      eventClick: function (calEvent, jsEvent, view) {
        //alert(calEvent.title, jsEvent, view);
        if (calEvent.url) {
          window.open(calEvent.url);
          return false;
        }
//        $('#fc_edit').click();
//        $('#title2').val(calEvent.title);
//        categoryClass = $("#event_type").val();
//
//        $(".antosubmit2").on("click", function () {
//          calEvent.title = $("#title2").val();
//
//          calendar.fullCalendar('updateEvent', calEvent);
//          $('.antoclose2').click();
//        });
//        calendar.fullCalendar('unselect');
      },
      editable: false,
      events: [
<?php if(count($equiposPorRecoger)) foreach($equiposPorRecoger as $Servicio): ?>
            {
              title: '<?php echo ($Servicio->personaRazonSocial) ?> <?php echo ($Servicio->referenciaNombres . " " . $Servicio->referenciaApellidos) ?>',
                        start: new Date(<?php echo intval(date("Y", strtotime($Servicio->reciboFechaRecogida))) ?>, <?php
    echo intval(date("m", strtotime($Servicio->reciboFechaRecogida))) - 1
    ?>, <?php echo intval(date("d", strtotime($Servicio->reciboFechaRecogida)))
    ?>, 0, 0, 0),
                        end: new Date(<?php echo intval(date("Y", strtotime($Servicio->reciboFechaRecogida))) ?>, <?php
    echo intval(date("m", strtotime($Servicio->reciboFechaRecogida))) - 1
    ?>, <?php echo intval(date("d", strtotime($Servicio->reciboFechaRecogida)))
    ?>, 23, 59, 59),
                        url: '<?php echo ($Servicio->documentoUrl) ?>',
                        backgroundColor: '#5078d8',
                        borderColor: '#db5706',
                        textColor: '#FFFFFF',
                      },
  <?php endforeach; ?>
//        {
//          title: 'All Day Event',
//          start: new Date(y, m, 1)
//        },
//        {
//          title: 'Long Event',
//          start: new Date(y, m, d - 5),
//          end: new Date(y, m, d - 2)
//        },
//        {
//          title: 'Meeting',
//          start: new Date(y, m, d, 10, 30),
//          allDay: false
//        },
//        {
//          title: 'Lunch',
//          start: new Date(y, m, d + 14, 12, 0),
//          end: new Date(y, m, d, 14, 0),
//          allDay: false
//        },
//        {
//          title: 'Birthday Party',
//          start: new Date(y, m, d + 1, 19, 0),
//          end: new Date(y, m, d + 1, 22, 30),
//          allDay: false
//        },
//        {
//          title: 'Click for Google',
//          start: new Date(y, m, 28),
//          end: new Date(y, m, 29),
//          url: 'http://google.com/'
//        }
                ]
              });
            });
</script>















<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

