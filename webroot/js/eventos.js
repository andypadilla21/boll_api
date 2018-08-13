/**Controla el parallax*/
$(document).ready(function () {
    $('.parallax').parallax();
});


/**Controla el menu para celular*/
$(".button-collapse").sideNav();

/*Controla los select**/

//inicializa el select
$(document).ready(function () {
    $('select').material_select();
});


//el destroy se usa cuando se actualiza el select para limpiarlo y despues se ejecura el de arriba (inicializa) para cargarlo con todos los datos
//$('select').material_select('destroy');

/**cointrolar los select**/

/**CONTROLA EL SLIDER*/
$(document).ready(function () {
    $('.slider').slider({
        full_width: true,
        indicators: false,
        height: 530
    });
});



///controlador galeria inicio
$(document).ready(function () {
    var value = "gratis"; //inicia mostrando las fotos gratis

    if (value == "gratis") {
        //$('.filter').removeClass('hidden');
        $(".filter").not('.' + value).hide('3000');
        $('.filter').filter('.' + value).show('3000');
    }


    $(".filter-button").click(function () {
        value = $(this).attr('data-filter');
        if (value == "pagas") {
            $('.pagas').addClass('pagadas');
            $(".filter").not('.' + value).hide('3000');
            $('.filter').filter('.' + value).show('3000');
        } else {
            //            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
            //            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
            $(".filter").not('.' + value).hide('3000');
            $('.filter').filter('.' + value).show('3000');

        }
    });

});

///controlador galeria inicio

///pone de color rojo el texto cuando se pasa el cursor sobre el
$('a').hover(
    function () {
        $(this).addClass('red-text');
    },
    function () {
        $(this).removeClass('red-text');
    }
)

//////////////////////////////////////////////////////////////////////////////////////////////////////////

$("video").click(function () {
    //console.log(this); 
    if (this.paused) {
        this.play();
    } else {
        this.pause();
    }
});


$("video").hover(function () {
    $(this).prop("controls", true);
}, function () {
    $(this).prop("controls", false);

});


///**Controla el input fechs*//
$('.datepicker').pickadate({
    firstDay: true,
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 100 // Creates a dropdown of 15 years to control year

});




///***======= controla el precio de las fotos y videos==



//==========================================================================================================================
////////////////////////*********************** controlador de autocompletado y filtrado
$(function () {
    $('input.autocomplete').autocomplete({
        data: {
            "Eustaquia": null,
            "Gumercinda": null,
            "Cretinilda": './img/1.jpg',
            "Soponsia": null,
            "Eustaquio": null,
            "Gumercindo": null,
            "Cretinildo": null,
            "Soponsio": null
        },
        onAutocomplete: function (val) {
            Materialize.toast('Filtrado por: '+val, 4000);
            $(".filter").not('.' + val).hide('3000');
            $('.filter').filter('.' + val).show('3000');
            
        }

    });
});
//////////////////////////////////////////////////////////////////==========================================
