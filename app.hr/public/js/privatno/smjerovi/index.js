$('.nazivSmjera').mouseover(function(){
    let e = $(this);
    $.ajax({
        url: url + 'smjer/grupesmjera/' + e.attr('id').split('_')[1],
        success:function(odgovor){
            
           e.attr('title',odgovor);
     }
    }); 
});