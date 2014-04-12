(function(window,document,$,undefined){
    $(document).ready(function(){
        $("#subscribe button").on('click',function(){
            $.post('/',$("#subscribe form").serialize())
            .done(function(data){
                console.log(data);
            }).fail(function(){

            });
        });        
    });
})(window,document,jQuery);
