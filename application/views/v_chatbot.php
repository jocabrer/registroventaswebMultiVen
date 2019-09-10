<html>
    <head>
        <script>base_url = '<?php echo base_url(); ?>'; 
                id_visitante = <?php echo $id_visitante;?>;
                id_atencion = <?php echo $id_atencion;?>;
                ck_nombre = '<?php echo $atencion['ck_nombre']; ?>';
                ck_contacto= '<?php echo $atencion['ck_contacto']; ?>';
                ck_saludo = '<?php echo $atencion['ck_saludo']; ?>';
                
                ;
        </script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url('chatbot/js/cb.js'); ?>"></script>

        <link href="<?php echo base_url('chatbot/css/cb.css'); ?>" rel="stylesheet" type="text/css" >
        <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    </head>
    <body>
    <div class="chat_window">
        <div class="top_menu">
            <div class="buttons">
                <img class="imguser" src="<?php echo base_url("chatbot/img/cbvendedor.png"); ?>">
            </div>
             <div class="title">Agente de Ventas<br><span id="escribiendo" class="escribiendo">Escribiendo<img src="<?php echo base_url("chatbot/img/message.gif"); ?>"></span></div>
        </div>
        <ul class="messages"></ul>

                    
                    <div class="bottom_wrapper clearfix">
                      <div class="message_input_wrapper">
                          <input class="message_input" placeholder="Escriba su mensaje..." id="inputmsje" /></div>
                          <div class="send_message" id="btnenviar">
                            <div class="icon"></div>
                            <div class="text">Enviar</div>
                          </div>
                      </div>
    </div>

    <!-- template sistema -->
    <div class="message_template">
            <li class="message">
            <h5>Jose dice:</h5>
                <div class="text_wrapper"><div class="text"></div>
                </div>
            </li>
    </div>
    <!-- template visitante -->
    <div class="message_template2">
            <li class="message">
                <div class="text_wrapper"><div class="text"></div>
                </div>
            </li>
    </div>

  </body>
</html>
