$(document).ready(function(){

  var app = new Vue({
    el: '#app',
    data: {
      base_url:document.getElementById("baseUrl").value,
      mnoziceArtiklov:{
        slideShow:[
              {slika_url:"api/slike/1", ime_artikla:"Usnjena torba", redna_cena:"400", znizana_cena:"300"},
              {slika_url:"api/slike/2", ime_artikla:"Usnjena torba", redna_cena:"400", znizana_cena:"300"},
              {slika_url:"api/slike/3", ime_artikla:"Usnjena torba", redna_cena:"400", znizana_cena:"300"},

            ],
        zadnjiArtikli:[
          {slika_url:"api/slike/1", ime_artikla:"Usnjena torba", redna_cena:"400", znizana_cena:"300"},
          {slika_url:"api/slike/2", ime_artikla:"Usnjena torba", redna_cena:"400", znizana_cena:"300"},
          {slika_url:"api/slike/3", ime_artikla:"Usnjena torba", redna_cena:"400", znizana_cena:"300"},
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
