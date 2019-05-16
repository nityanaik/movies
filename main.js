$(document).ready(function(){
    var lang = [],gen = [];
    $( "input[type=checkbox]" ).click(function(){
        var value = $(this).attr('class');
        if(value == 'lang'){
            if ($(this).is(':checked')) {
                lang.push($(this).val());
            }else{
                lang.splice($.inArray($(this).val(), lang),1);
            }
        }else if(value == 'type'){
            if ($(this).is(':checked')) {
                gen.push($(this).val());
            }else{
                gen.splice($.inArray($(this).val(), gen),1);
            }
        }
        console.log("language present:"+lang);
        console.log("genre present:"+gen);
        $.ajax({
            type: 'POST',
            url: 'filter_data.php',
            data: {
                lang:lang,
                gen:gen,
            },
            success: function(data){
                $('.body').html(data);
            },
            error: function(){
                console.log("error");
            }
        });
    })
    $('select').click(function(){
        var sorting = $(this).val();

        $.ajax({
                    type: 'POST',
                    url: 'fetch_data.php',
                    data: {
                        sorting:sorting,
                    },
                    success: function(data){
                        $('.body').html(data);
                    },
                    error: function(){
                        console.log("error");
                    }
                });
    })
    $('input').click(function(){
        var favorite = [];
        $.each($("input[name='lang']:checked"), function(){            
            favorite.push($(this).val());
        });
    })
});