$(document).ready(function(){

  var app = new Vue({
    el: '#app',
    data: {
      tabelaArtiklov:[
            {kolicina:1, povezava_artikel:"single.html", slika_url:"images/ba.jpg", ime_artikla:"Usnjena torba", redna_cena:"400", znizana_cena:"300"},
            {kolicina:1, povezava_artikel:"single.html", slika_url:"images/bag.jpg", ime_artikla:"Usnjena torba", redna_cena:"300", znizana_cena:"200"},
            {kolicina:1, povezava_artikel:"single.html", slika_url:"images/bag1.jpg", ime_artikla:"Usnjena torba", redna_cena:"200", znizana_cena:"100"},
          ]

    },
    computed:{
        skupnaCenaKosarice:function(){
          var skupnaCenaKosarice=0;
          var artikel=null;

          for (var i=0; i< this.tabelaArtiklov.length; i++) {
            artikel=this.tabelaArtiklov[i];
            skupnaCenaKosarice+= parseInt(artikel.kolicina)*parseFloat(artikel.redna_cena);
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
