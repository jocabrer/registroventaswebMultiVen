(function () {
   
   
    var Message;
    Message = function (arg) {
        this.text = arg.text, this.message_side = arg.message_side;
        this.draw = function (_this) {
            return function () {
                var $message;
                $message = $($(arg.template).clone().html());
                
                $message.addClass(_this.message_side).find('.text').html(_this.text);
                $('.messages').append($message);
                return setTimeout(function () {
                    return $message.addClass('appeared');
                }, 0);
            };
        }(this);
        return this;
    };

    /* Main */
    $(function (){
        
        var getMessageText, sendMessage, obligatorio, ck_saludo, ck_nombre, ck_contacto;

        obligatorio = 0 ; //no es campo del visitante obligatorio
        claveobligatorio = "";
        claveobligatorioRespuesta = "";

        //obtiene el mensaje del input 
        getMessageText = function(){
            var $message_input;
            $message_input = $('#inputmsje');
            return $message_input.val();
        };
        

        //Muestra un mensaje en el chatbox
        sendMessage = function (text,message_side,template) {
            var $messages, message;
            if (text.trim() === '') {
                return;
            }
            $('.message_input').val(''); 
            $messages = $('.messages');
            message = new Message({
                text: text,
                message_side: message_side,
                template:template
            });
            message.draw();
            return $messages.animate({ scrollTop: $messages.prop('scrollHeight') }, 300);
        };

        //Muestra un mensaje Como el bot en el chatbox
        botMessage = function($msje){
            escribiendo = $('#escribiendo');
            escribiendo.show();
            setTimeout(function () {
              escribiendo.hide();
              sendMessage($msje,'left','.message_template');
            }, 3000);
  
          }


          //se encarga de revisar en el storage  si se han cumplidos los CK 
         verificaCK = function($clave){
            retorno="";
            if(ck_saludo!=0){
                retorno = 'ck_saludo';
             }else if(ck_nombre!=0){
                 retorno = 'ck_nombre';
             }else if(ck_contacto!=0){
                 retorno = 'ck_contacto';
             }else
                 retorno = $clave;
             return retorno;
        }

        botAction = function($clave){
            $clave = verificaCK($clave);
            obtieneAjaxMensaje($clave);
 
        }


        obtieneAjaxMensaje = function($clave){

            if ($clave.trim() == '') 
            return;

            jQuery.ajax({
                method: "POST",
                    url: base_url+"Chatbot/obtieneMensaje",
                    dataType: 'json',
                    data: {clave:$clave,claveobligatorioRespuesta},
                    success: function(res) {
                        botActionCallBack(res.respuesta);
                    }
                }); 
        }


        
        botActionCallBack = function(res){
            if(res.obligatoria>0){
                //Bot Pregunta
                obligatorio = res.obligatoria;
                claveobligatorioRespuesta = res.ck;
            }else{
                //Bot Responde
                obligatorio = 0 ;
                claveobligatorioRespuesta="";
            }

            botMessage(res.respuesta);
        }

        userAction = function(mensaje){
            if(obligatorio>0){
                //es una respuesta debo saber cual es la clave a actualizar
                jQuery.ajax({
                    method: "POST",
                        url: base_url+"Chatbot/actualizaObligatorio",
                        dataType: 'json',
                        data: {obligatorio,mensaje,claveobligatorioRespuesta,id_atencion},
                        success: function(res) {
                            actualizaCK(res);
                        }
                    }); 
            }
            sendMessage(getMessageText(),'right','.message_template2');
            setTimeout(function () {botAction(mensaje,);}, 3000);
        }

        actualizaCK = function(res){
                //actualize un ck , debo refrescar las variables ck en el chatbox
                if(claveobligatorioRespuesta=="ck_nombre"){
                    ck_nombre = 0;
                }
                if(claveobligatorioRespuesta=="ck_contacto")
                ck_contacto= 0;
                if(claveobligatorioRespuesta=="ck_saludo")
                ck_saludo = 0;
        }

       


        inicializaChatBox = function(){

                
                //inicializamos chat con el HOLA 
                botAction('[hola]');
               // localStorage.setItem('preguntasObligatorias',<?php echo $preguntasObligatorias; ?>)
        }


        inicializaChatBox();

        //Listeners
        $('#btnenviar').click(function (e) {userAction(getMessageText());});
        $('#inputmsje').keyup(function (e) {
                if (e.which === 13){
                    userAction(getMessageText());
                }
        });
    });

    
    
}.call(this));


