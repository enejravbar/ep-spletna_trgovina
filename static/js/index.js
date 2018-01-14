$(document).ready(function(){

  var app = new Vue({
    el: '#app',
    data: {
      root_url:document.getElementById("rootUrl").value,
      mnoziceArtiklov:{
        slideShow:[],
        /*zadnjiArtikli:[
          ,
          {slika_url:"api/slike/2", ime_artikla:"Usnjena torba", redna_cena:"400", znizana_cena:"300"},
          {slika_url:"api/slike/3", ime_artikla:"Usnjena torba", redna_cena:"400", znizana_cena:"300"},
        ],*/
      //  slideShow:[{slika_url:"api/slike/1", ime_artikla:"Usnjena torba", redna_cena:"400", znizana_cena:"300"}],
        zadnjiArtikli:[],
      },
    },
    created: function(){

      this.getData(this);


    },
    methods:{
      getData: function(ref){
        console.log("PRIDOBIVAM PODATKE!!!!!!!!!!!!!")
        var request = new XMLHttpRequest();
        var ref=this;
        request.open('GET', this.root_url+'api/izdelki/index', true);
        request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
        request.send();

        request.addEventListener("load", function() {
          var response = JSON.parse(request.responseText);
        	var tabelaZadnjihArtiklov=response.zadnji;
          var tabelaOcenjenihArtiklov=response.ocenjeni;
          ref.posodobiZadnjeArtikle(tabelaZadnjihArtiklov);
          ref.posodobiSlideShow(tabelaOcenjenihArtiklov);

        });
        request.addEventListener("error", function() {
            console.log("NAPAKA!");
        });
      },

      posodobiSlideShow: function(tabelaArtiklov){
        this.mnoziceArtiklov.slideShow=[];
        for(var i=0; i< tabelaArtiklov.length; i++){
            var artikel=  {
              id : tabelaArtiklov[i].id,
              slika_url: this.root_url+"api/slike/"+tabelaArtiklov[i].thumbnail,
              ime_artikla: tabelaArtiklov[i].ime,
              redna_cena: tabelaArtiklov[i].cena,
            };
            this.mnoziceArtiklov.slideShow.push(artikel);
          }

          console.log(this.mnoziceArtiklov.slideShow)
      },

      posodobiZadnjeArtikle: function(tabelaArtiklov){
        this.mnoziceArtiklov.zadnjiArtikli=[];
        for(var i=0; i< tabelaArtiklov.length; i++){
            var artikel=  {
              id:tabelaArtiklov[i].id,
              slika_url: this.root_url+"api/slike/"+tabelaArtiklov[i].thumbnail,
              ime_artikla: tabelaArtiklov[i].ime,
              redna_cena: tabelaArtiklov[i].cena,
            };
            this.mnoziceArtiklov.zadnjiArtikli.push(artikel);
          }
      }

    }
  });

});
