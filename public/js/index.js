$(document).ready(function(){

  var app = new Vue({
    el: '#app',
    data: {
      tabelaKategorij:[
        {ime:"Računalništvo", url:"product.html"},
        {ime:"Bela Tehnika", url:"product.html"},
        {ime:"Vrtnarstvo", url:"product.html"},
        {ime:"Obleke", url:"product.html"}
      ],
      artikel:{
        slika_url:"images/ba.jpg",
        ime_artikla:"Usnjena torba",
        redna_cena:"400",
        znizana_cena:"300"
      },
      mnoziceArtiklov:{
        slideShow:[
              {slika_url:"images/bag.jpg", ime_artikla:"Usnjena torba", redna_cena:"400", znizana_cena:"300"},
              {slika_url:"images/bag.jpg", ime_artikla:"Usnjena torba", redna_cena:"400", znizana_cena:"300"},
              {slika_url:"images/bag.jpg", ime_artikla:"Usnjena torba", redna_cena:"400", znizana_cena:"300"},
            ],
        zadnjiArtikli:[
              {slika_url:"images/ba.jpg", ime_artikla:"Usnjena torba", redna_cena:"400", znizana_cena:"300"},
              {slika_url:"images/ba.jpg", ime_artikla:"Usnjena torba", redna_cena:"400", znizana_cena:"300"},
              {slika_url:"images/ba.jpg", ime_artikla:"Usnjena torba", redna_cena:"400", znizana_cena:"300"},
            ],

      },
    }
  });

  $('.example1').wmuSlider();
});

$(function() {
    var menu_ul = $('.menu > li > ul'),
           menu_a  = $('.menu > li > a');
    menu_ul.hide();
    menu_a.click(function(e) {
        e.preventDefault();
        if(!$(this).hasClass('active')) {
            menu_a.removeClass('active');
            menu_ul.filter(':visible').slideUp('normal');
            $(this).addClass('active').next().stop(true,true).slideDown('normal');
        } else {
            $(this).removeClass('active');
            $(this).next().stop(true,true).slideUp('normal');
        }
    });

});
