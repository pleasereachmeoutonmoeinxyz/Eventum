(function(window,document,$,undefined){
    $(document).ready(function(){
        $("#subscribe button").on('click',function(){
            $.post('mail/subscribe',$("form#subscribe").serialize())
            .done(function(data){
                console.log(data);
            }).fail(function(){

            });
        });        
    });
})(window,document,jQuery);
