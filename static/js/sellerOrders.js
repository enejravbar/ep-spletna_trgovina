$(document).ready(function(){

  var app = new Vue({
    el: '#app',
    data: {
      tabelaNarocil:[
            {
              id_narocila:1,
                narocnik:{
                  ime:"Jože1",
                  priimek:"Gorišek",
                  naslov:"Ljubljana 232",
                  tel_stevilka:"041232141",
                },
                datum_narocila:"14.3.2017 13:33",
                status_narocila:"POTRJENO",
                cena_narocila:300,
                tabelaArtiklov:[
                  {kolicina:1, povezava_artikel:"single.html", slika_url:"images/ba.jpg", ime_artikla:"Usnjena torba", redna_cena:"100", znizana_cena:"300"},
                  {kolicina:1, povezava_artikel:"single.html", slika_url:"images/bag.jpg", ime_artikla:"Usnjena torba1", redna_cena:"100", znizana_cena:"200"},
                  {kolicina:1, povezava_artikel:"single.html", slika_url:"images/bag1.jpg", ime_artikla:"Usnjena torba2", redna_cena:"100", znizana_cena:"100"},
                ]
            }

          ]
    },
    computed:{

    },
    methods:{

    }

  });

});
