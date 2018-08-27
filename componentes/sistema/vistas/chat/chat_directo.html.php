

<div class="box box-warning direct-chat direct-chat-warning">
    <div class="box-header with-border">
        <h3 class="box-title">Chat CCSM</h3>
        <div class="box-tools pull-right">
            <span data-toggle="tooltip" title="3 New Messages" class='badge bg-yellow'>3</span>
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle"><i class="fa fa-comments"></i></button>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <!-- Conversations are loaded here -->
        <div class="direct-chat-messages">
            <!-- Message. Default to the left -->
            <div class="direct-chat-msg">
                <div class='direct-chat-info clearfix'>
                    <span class='direct-chat-name pull-left'>Alexander Pierce</span>
                    <span class='direct-chat-timestamp pull-right'>23 Jan 2:00 pm</span>
                </div><!-- /.direct-chat-info -->
                <img class="direct-chat-img" src="<?php echo Plantillas::$url ?>dist/img/user1-128x128.jpg" alt="message user image" /><!-- /.direct-chat-img -->
                <div class="direct-chat-text">
                    Is this template really for free? That's unbelievable!
                </div><!-- /.direct-chat-text -->
            </div><!-- /.direct-chat-msg -->

            <!-- Message to the right -->
            <div class="direct-chat-msg right">
                <div class='direct-chat-info clearfix'>
                    <span class='direct-chat-name pull-right'>Sarah Bullock</span>
                    <span class='direct-chat-timestamp pull-left'>23 Jan 2:05 pm</span>
                </div><!-- /.direct-chat-info -->
                <img class="direct-chat-img" src="<?php echo Plantillas::$url ?>dist/img/user3-128x128.jpg" alt="message user image" /><!-- /.direct-chat-img -->
                <div class="direct-chat-text">
                    You better believe it!
                </div><!-- /.direct-chat-text -->
            </div><!-- /.direct-chat-msg -->

            <!-- Message. Default to the left -->
            <div class="direct-chat-msg">
                <div class='direct-chat-info clearfix'>
                    <span class='direct-chat-name pull-left'>Alexander Pierce</span>
                    <span class='direct-chat-timestamp pull-right'>23 Jan 5:37 pm</span>
                </div><!-- /.direct-chat-info -->
                <img class="direct-chat-img" src="<?php echo Plantillas::$url ?>dist/img/user1-128x128.jpg" alt="message user image" /><!-- /.direct-chat-img -->
                <div class="direct-chat-text">
                    Working with AdminLTE on a great new app! Wanna join?
                </div><!-- /.direct-chat-text -->
            </div><!-- /.direct-chat-msg -->

            <!-- Message to the right -->
            <div class="direct-chat-msg right">
                <div class='direct-chat-info clearfix'>
                    <span class='direct-chat-name pull-right'>Sarah Bullock</span>
                    <span class='direct-chat-timestamp pull-left'>23 Jan 6:10 pm</span>
                </div><!-- /.direct-chat-info -->
                <img class="direct-chat-img" src="<?php echo Plantillas::$url ?>dist/img/user3-128x128.jpg" alt="message user image" /><!-- /.direct-chat-img -->
                <div class="direct-chat-text">
                    I would love to.
                </div><!-- /.direct-chat-text -->
            </div><!-- /.direct-chat-msg -->

        </div><!--/.direct-chat-messages-->
        <!-- Contacts are loaded here -->
        <div class="direct-chat-contacts">
            <ul class='contacts-list'>
                <?php foreach ($todos_usuarios as $Usuario) : ?>
                <?php if( !is_null($Usuario->id_persona) ): ?>
                    <li>
                        <a href='javascript:void(0); '  >
                            <img class='contacts-list-img' src='<?php echo $Usuario->url_avatar_usuario ?>' />
                            <div class='contacts-list-info'>
                                <span class='contacts-list-name'>
                                    <span title="<?php echo $Usuario->nombre_usuario ?>" ><?php echo $Usuario->primer_nombre_persona ?>&nbsp;<?php echo $Usuario->segundo_nombre_persona ?>&nbsp;<?php echo $Usuario->primer_apellido_persona ?>&nbsp;</span>
                                    <small class='contacts-list-date pull-right'> <?php echo $Usuario->fecha_ultimo_mensaje ?></small>
                                </span>
                                <span class='contacts-list-msg'><?php echo $Usuario->ultimo_mensaje ?></span>
                            </div><!-- /.contacts-list-info -->
                        </a>
                    </li><!-- End Contact Item -->
                    <?php endif; ?>
                    
                <?php endforeach; ?>
            </ul><!-- /.contatcts-list -->
        </div><!-- /.direct-chat-pane -->
    </div><!-- /.box-body -->
    <div class="box-footer">
        <form action="#" method="post">
            <div class="input-group">
                <input type="text" name="message" placeholder="Escribir mensaje ..." class="form-control"/>
                <span class="input-group-btn">
                    <button type="button" class="btn btn-warning btn-flat">Enviar</button>
                </span>
            </div>
        </form>
    </div><!-- /.box-footer-->
</div>

<script>

    $(document).ready(function () {

        $('[data-widget="chat-pane-toggle"]').click(function () {
            var box = $(this).parents('.direct-chat').first();
            box.toggleClass('direct-chat-contacts-open');
        });

    });

</script>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

