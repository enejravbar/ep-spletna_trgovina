$(document).ready(function(){

  var app = new Vue({
    el: '#app',
    data: {
      root_url:document.getElementById("rootUrl").value,
      mnoziceArtiklov:{
        slideShow:[
              {slika_url: "/ep/ep-spletna_trgovina/static/images/bag.jpg", ime_artikla:"Usnjena torba", redna_cena:"400", znizana_cena:"300"},
              {slika_url:"api/slike/2", ime_artikla:"Usnjena torba", redna_cena:"400", znizana_cena:"300"},
              {slika_url:"api/slike/3", ime_artikla:"Usnjena torba", redna_cena:"400", znizana_cena:"300"},

            ],
        zadnjiArtikli:[
          {slika_url:"api/slike/1", ime_artikla:"Usnjena torba", redna_cena:"400", znizana_cena:"300"},
          {slika_url:"api/slike/2", ime_artikla:"Usnjena torba", redna_cena:"400", znizana_cena:"300"},
          {slika_url:"api/slike/3", ime_artikla:"Usnjena torba", redna_cena:"400", znizana_cena:"300"},
            ],
      },
    },
    methods:{
      getData: function(){
        var request = new XMLHttpRequest();
        request.open('POST', this.root_url+'api/izdelki/index', true);
        request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
        request.addEventListener("load", function() {
        	var response = JSON.parse(request.responseText);
          console.log(response);
        });
        request.addEventListener("error", function() {
            console.log("NAPAKA!");
        });
        request.send(data);
      }
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
