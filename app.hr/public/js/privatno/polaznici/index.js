$('#uvjet').focus();

$( '#uvjet' ).autocomplete({
    source: function(req,res){
       $.ajax({
           url: url + 'polaznik/ajaxSearch/' + req.term,
           success:function(odgovor){
            res(odgovor);
            //console.log(odgovor);
        }
       }); 
    },
    minLength: 2,
    select:function(dogadaj,ui){
        //console.log(ui.item);
        spremi(ui.item);
    }
}).autocomplete( 'instance' )._renderItem = function( ul, item ) {
    return $( '<li>' )
      .append( '<div> <img src="https://picsum.photos/30/30" />' + item.ime + ' ' + item.prezime + '<div>')
      .appendTo( ul );
  };

