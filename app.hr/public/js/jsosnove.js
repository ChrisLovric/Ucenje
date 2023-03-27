/*
više redova

*/

/* isti red između valjanog koda */
// komentar jedan red

//alert('Hello world'); 
//prompt("Unesi ime");

//confirm("Obrisati?");

// STARI NAČIN
//var varijabla=7;

// noviji način
let varijabla = 7;

//document.writeln(varijabla);

console.log(varijabla + ': ' + typeof varijabla);

varijabla = 3.14;
console.log(varijabla + ': ' + typeof varijabla);

varijabla='Osijek';
console.log(varijabla + ': ' + typeof varijabla);

varijabla=true;
console.log(varijabla + ': ' + typeof varijabla);

varijabla = []; // niz ali je tip podatka object
console.log(varijabla + ': ' + typeof varijabla);

varijabla = {
    ime: 'Pero', 
    godine: 25, 
    iznosi: [
        2.3,
        23
    ],
    sestra: {ime:'Marija'}
};
console.log(varijabla + ': ' + typeof varijabla);
console.log(varijabla);

 varijabla = JSON.parse('{"employee": {  "name":  "sonoo", "salary": 56000,  "married":    true  }  }')  ;
console.log(varijabla + ': ' + typeof varijabla);
console.log(varijabla);

varijabla = [];
varijabla['kljuc1']=2;
varijabla['kljuc2']=3;
console.log(varijabla + ': ' + typeof varijabla);
console.log(varijabla);

let i=10;
console.log(i>0 ? 'DA' : 'NE');

for(let i=0;i<10;i++){
    console.log(i);
}

console.table(['PHP', 'JAVA', 'C#']);
/*
let suma=0;
let s,b;
for(;;){
    s=prompt('Unesi broj');
    b=parseInt(s);
    if(b===0){
        break;
    }
    suma+=b;
}
console.log(suma);
*/

let uvjet=true;
i=2;
while(uvjet){
    console.log('xxxxxx');
    uvjet=i++<10;
}


function random(){
    console.log(Math.random());
}

random();

function zbroj(a,b){
    return a+b;
}

console.log(zbroj('2','3'));


function primjeAJAXcisti(){
    let xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == XMLHttpRequest.DONE) { // XMLHttpRequest.DONE == 4
           if (xmlhttp.status == 200) {
            // ovo će se izvesti po povratku s servera,
            // nakon što smo pozvali server na liniji 115
               //console.log(xmlhttp.responseText);
               ispisiSmjerove(JSON.parse(xmlhttp.responseText));
           }
        }
    };

    xmlhttp.open('GET', '/smjer/v1/read', true);
    xmlhttp.send();
    return false;
}


function ispisiSmjerove(smjerovi){
    console.table(smjerovi);
    let ut=0;
    for(let i=0;i<smjerovi.length;i++){
        console.log(smjerovi[i].naziv);
        ut+=smjerovi[i].trajanje;
    }
    console.log(ut);
}

document.getElementById('ajax2').addEventListener('click',primjeAJAXcisti);

document.getElementById('ajax3')
.addEventListener('click',function(){
    console.log('Primjer poziva inner function');
    primjeAJAXcisti();
});

$('#jQuery1').click(function(){
    $('#panel1').html('Hello');
    $('#panel1').css('border','2px solid blue');
    return false;
});


$('li').click(function(){
    $('#panel1').html($(this).html());
});

$('#jQuery2').click(function(){
    $.get( '/smjer/v1/read', function( podaci ) {
        //console.log(varijabla + ': ' + typeof varijabla);
        for (const k in podaci) {
            const s = podaci[k];
            $('#lista').append('<li>' + s.naziv + '</li>');
        }
        
      });
    
    return false;
});

