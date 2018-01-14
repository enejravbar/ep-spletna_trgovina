$(document).ready(function(){

  var app = new Vue({
    el: '#app',
    data: {
      root_url:document.getElementById("rootUrl").value,
      tabelaArtiklov:[],
      pridobilPodatke:false,

    },
    computed:{
        skupnaCenaKosarice:function(){
          var skupnaCenaKosarice=0;
          var artikel=null;

          for (var i=0; i< this.tabelaArtiklov.length; i++) {
            artikel=this.tabelaArtiklov[i];
            skupnaCenaKosarice+= parseInt(artikel.kolicina)*parseFloat(artikel.redna_cena) ;
          }
          return Math.round(skupnaCenaKosarice*100)/100;
        }

    },
    mounted:function(){
      this.pridobiArtikleKosarice();
    },
    methods:{
      skupnaCenaNaIzdelek: function(artikel){
        return artikel.kolicina* Math.round(parseFloat(artikel.redna_cena)*100)/100;
      },
      odstraniIzdelekIzKosarice: function(izdelek){

        var request = new XMLHttpRequest();
        var ref=this;
        request.open('DELETE', this.root_url+'api/kosarica/izdelek/'+izdelek.id, true);
        request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
        request.send();

        request.addEventListener("load", function() {
          //var response = JSON.parse(request.responseText);
          ref.pridobiArtikleKosarice();
          ref.pridobilPodatke=true;
        });
        request.addEventListener("error", function() {
            console.log("NAPAKA!");
            ref.pridobiArtikleKosarice();
        });


      },
      pridobiArtikleKosarice: function(){
        var request = new XMLHttpRequest();
        var ref=this;
        request.open('GET', this.root_url+'api/kosarica', true);
        request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
        request.send();

        request.addEventListener("load", function() {
          var response = JSON.parse(request.responseText);
          var tabelaArtiklov=response.kosarica;
          ref.tabelaArtiklov=[];
          for(var i=0; i<tabelaArtiklov.length; i++){
            var artikel={
              id:tabelaArtiklov[i].id,
              ime_artikla:tabelaArtiklov[i].ime,
              redna_cena:tabelaArtiklov[i].cena,
              kolicina:tabelaArtiklov[i].kolicina,
              slika_url:ref.root_url+"api/slike/"+tabelaArtiklov[i].thumbnail,
            };
            ref.tabelaArtiklov.push(artikel);
          }
          ref.pridobilPodatke=true;
        });
        request.addEventListener("error", function() {
            console.log("NAPAKA!");
        });
      },
      povecajKolicino: function(artikel){
        artikel.kolicina=parseInt(artikel.kolicina)+1;

        var request = new XMLHttpRequest();

        var ref=this;
        var data={
          id_izdelka:artikel.id,
          sprememba:1,
        }
        var data=JSON_to_URLEncoded(data);

        request.open('PUT', this.root_url+'api/kosarica', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        request.send(data);

        request.addEventListener("load", function() {
          //var response = JSON.parse(request.responseText);
          ref.pridobiArtikleKosarice();
        });
        request.addEventListener("error", function() {
          ref.pridobiArtikleKosarice();
        });
      },
      zmanjsajKolicino: function(artikel){
        if(artikel.kolicina>=2){
          artikel.kolicina=parseInt(artikel.kolicina)-1;
        }
        var ref=this;
        var data={
          id_izdelka:artikel.id,
          sprememba:-1,
        }
        var data=JSON_to_URLEncoded(data);
        var request = new XMLHttpRequest();

        request.open('PUT', this.root_url+'api/kosarica', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        request.send(data);
        console.log("zaznan klik na MINUS!!!!")
        request.addEventListener("load", function() {
          //var response = JSON.parse(request.responseText);
          ref.pridobiArtikleKosarice();
        });
        request.addEventListener("error", function() {
          ref.pridobiArtikleKosarice();
        });

      }

    }
  });

});
