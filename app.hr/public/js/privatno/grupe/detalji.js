
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



  function spremi(polaznik){
    $.ajax({
        url: url + 'grupa/dodajpolaznik?grupa=' + grupasifra + 
             '&polaznik=' + polaznik.sifra,
        success:function(odgovor){
            if(odgovor.error){
                $('#poruka').css('border','2px solid red');
                $('#poruka').html(odgovor.description);
                $('#poruka').fadeIn();
                setTimeout(() => {
                    $('#poruka').css('border','0px');
                    $('#poruka').fadeOut();
                }, 1500);
                //alert(odgovor.description);
                return;
            }
            $('#poruka').html(odgovor.description);
            $('#poruka').fadeIn();
                setTimeout(() => {
                    $('#poruka').css('border','0px');
                    $('#poruka').fadeOut();
                }, 1500);
                //debugger;
           $('#podaci').append(
            '<tr>' + 
                '<td>' +
                    polaznik.ime + ' ' + polaznik.prezime +
                '</td>' + 
                '<td>' +
                    '<a href="#" class="odabraniPolaznik" id="p_' + 
                    polaznik.sifra
                    + '">' +
                    ' <i class="fi-trash"></i>' +
                    '</a>' +
                '</td>' + 
            '</tr>'
           );
           definirajBrisanje();

     }
    }); 

    
}


function definirajBrisanje(){
    $('.odabraniPolaznik').click(function(){

        //console.log(grupasifra);
        //console.log($(this).attr('id').split('_')[1]);
        let element = $(this);
        $.ajax({
            url: url + 'grupa/obrisipolaznik?grupa=' + grupasifra + 
                 '&polaznik=' + element.attr('id').split('_')[1],
            success:function(odgovor){
               element.parent().parent().remove();
         }
        }); 
    
        return false;
    });
}
definirajBrisanje();
$('#poruka').fadeOut();

$('#uvjet').focus();