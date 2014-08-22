(function(window,document,$,undefined){
    
    var AjaxBehavioral  =   (function(){
        
        function clearMessage(){
            $("#subscribe p.message").remove();
            $("#subscribe p.error").remove();
        }
        
        function hideFormElement(){
            $("#subscribe #form_email").slideUp();
            $("#subscribe button").slideUp();
        }
        
        function showMessage(message){
            clearMessage();
            $("#subscribe #form_email").after('<p class="message">' + message + '</p>');
            hideFormElement();
        }
        
        function showError(message){
            clearMessage();
            $("#subscribe #form_email").after('<p class="error">' + message + '</p>');
        }
        
        function subscribtionResult(str){
            var data    =   JSON.parse(str);
            if (data.error){
                if (data.data != null){
                    var result  =   data.message + '<br>';
                    data.data.forEach(function(t){
                        result += t + '<br>';
                    });
                    showError(result);
                } else {
                    showError(data.message);
                }
            } else {
                showMessage(data.message);
            }
        }
        
        return {
            'error'     :   showError,
            'message'   :   showMessage,
            'response'  :   subscribtionResult
        };
    })();
    
    $(document).ready(function(){
        $("#subscribe").on('keypress',function(e){
            if (e.keyCode === 13 && !e.shiftKey) {
                e.preventDefault();
                $("#subscribe button").trigger('click');
            }
        });
        $("#subscribe button").on('click',function(){
            $.post('mail/subscribe',$("form#subscribe").serialize())
            .done(function(data){
                AjaxBehavioral.response(data);
            });
        });        
    });
    
})(window,document,jQuery);
