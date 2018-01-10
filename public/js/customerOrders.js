$(document).ready(function(){

  var app = new Vue({
    el: '#app',
    data: {
      tabelaNarocil:[
            { id_narocila:1,
              datum_narocila:"12.3.2017 13:33",
              status_narocila:"POTRJENO",
              cena_narocila:300,
              tabelaArtiklov:[
                {kolicina:1, povezava_artikel:"single.html", slika_url:"images/ba.jpg", ime_artikla:"Usnjena torba", redna_cena:"400", znizana_cena:"300"},
                {kolicina:1, povezava_artikel:"single.html", slika_url:"images/bag.jpg", ime_artikla:"Usnjena torba1", redna_cena:"300", znizana_cena:"200"},
                {kolicina:1, povezava_artikel:"single.html", slika_url:"images/bag1.jpg", ime_artikla:"Usnjena torba2", redna_cena:"200", znizana_cena:"100"},
              ]
            },
            {
              id_narocila:2,
              datum_narocila:"12.3.2017 13:33",
              status_narocila:"ODDANO",
              cena_narocila:400,
              tabelaArtiklov:[
                {kolicina:1, povezava_artikel:"single.html", slika_url:"images/ba.jpg", ime_artikla:"torba", redna_cena:"400", znizana_cena:"300"},
                {kolicina:1, povezava_artikel:"single.html", slika_url:"images/bag.jpg", ime_artikla:"torba1", redna_cena:"300", znizana_cena:"200"},
                {kolicina:1, povezava_artikel:"single.html", slika_url:"images/bag1.jpg", ime_artikla:"torba2", redna_cena:"200", znizana_cena:"100"},
              ]
            },
          ],
          uporabnik:{
            ime:"Jože",
            priimek:"Gorišek",
            naslov:"Ljubljana 232",
            tel_stevilka:"041232141",
          }

    },
    computed:{
        skupnaCenaKosarice:function(narocilo){
          var skupnaCenaKosarice=0;
          var artikel=null;

          for (var i=0; i< narocilo.tabelaArtiklov.length; i++) {
            artikel=narocilo.tabelaArtiklov[i];
            skupnaCenaKosarice+= parseInt(narocilo.kolicina)*parseFloat(artikel.redna_cena);
          }
          return skupnaCenaKosarice;
        }
    },
    methods:{
      odstraniIzdelekIzKosarice: function(izdelek){
        for(var i = this.tabelaArtiklov.length; i--;) {
            if(this.tabelaArtiklov[i] === izdelek) {
                this.tabelaArtiklov.splice(i, 1);
            }
        }
      }
    }

  });

});
