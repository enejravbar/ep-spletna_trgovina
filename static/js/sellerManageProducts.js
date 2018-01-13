$(document).ready(function(){

  var app = new Vue({
    el: '#app',
    data: {
      root_url: document.getElementById("rootUrl").value,
      /*tabelaArtiklov:[
            {povezava_artikel:"single.html", slika_url:"images/ba.jpg", ime_artikla:"Usnjena torba", redna_cena:"400", znizana_cena:"300"},
            { povezava_artikel:"single.html", slika_url:"images/bag.jpg", ime_artikla:"Usnjena torba", redna_cena:"300", znizana_cena:"200"},
            {povezava_artikel:"single.html", slika_url:"images/bag1.jpg", ime_artikla:"Usnjena torba", redna_cena:"200", znizana_cena:"100"},
          ]*/
        tabelaArtiklov:[]
    },
    mounted: function(){

      this.getData();

    },
    methods:{
      odstraniIzdelek: function(artikel){
        for(var i = this.tabelaArtiklov.length; i--;) {
            if(this.tabelaArtiklov[i] === artikel) {
                this.tabelaArtiklov.splice(i, 1);
            }
        }
      },
      getData: function(){
        var ref=this;
        var request = new XMLHttpRequest();

        request.open('GET', this.root_url+"api/izdelki", true);
        request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
        request.send();

        request.addEventListener("load", function() {
          var response = JSON.parse(request.responseText);
          ref.posodobiTabeloArtiklov(response.izdelki);

        });
        request.addEventListener("error", function() {
            console.log("NAPAKA!");
        });
      },
      posodobiTabeloArtiklov: function(tabelaArtiklov){
        this.tabelaArtiklov=[];
        for(var i=0; i<tabelaArtiklov.length; i++){
            artikel={
              id:tabelaArtiklov[i].id,
              povezava_artikel:this.root_url+"izdelki/"+tabelaArtiklov[i].id,
              slika_url: this.root_url+"api/slike/"+tabelaArtiklov[i].thumbnail,
              ime_artikla: tabelaArtiklov[i].ime,
              redna_cena:tabelaArtiklov[i].cena,
            }
            this.tabelaArtiklov.push(artikel);
        }
      },

    }
  });

});
