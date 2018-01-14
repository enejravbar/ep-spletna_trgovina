$(document).ready(function(){

  var app = new Vue({
    el: '#app',
    data: {
      root_url:document.getElementById("rootUrl").value,
      narocilo:{
        id_narocila:1,
          narocnik:{
            /*ime:"Jože1",
            priimek:"Gorišek",
            naslov:"Ljubljana 232",
            tel_stevilka:"041232141",*/
          },
          datum_narocila:"",
          status_narocila:"",
          cena_narocila:"",
          tabelaArtiklov: [],
        },
        tabelaArtiklov:[],
        pridobilPodatke:false,
        narociloOddano:false

    },
    mounted:function(){
        this.pridobiArtikleKosarice();
        this.pridobiPodatkeNarocnika();
      },
    methods:{
      oddajNarocilo: function(){
        this.narociloOddano=true;
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
          ref.narocilo.tabelaArtiklov=[];
          for(var i=0; i<tabelaArtiklov.length; i++){
            var artikel={
              id:tabelaArtiklov[i].id,
              ime_artikla:tabelaArtiklov[i].ime,
              redna_cena:tabelaArtiklov[i].cena,
              kolicina:tabelaArtiklov[i].kolicina,
              slika_url:ref.root_url+"api/slike/"+tabelaArtiklov[i].thumbnail,
            };
            ref.narocilo.tabelaArtiklov.push(artikel);
          }
          ref.narocilo.pridobilPodatke=true;
        });
        request.addEventListener("error", function() {
            console.log("NAPAKA!");
        });
      },
      pridobiPodatkeNarocnika: function(){
        var request = new XMLHttpRequest();
        var ref=this;
        request.open('GET', this.root_url+'api/profil', true);
        request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
        request.send();

        request.addEventListener("load", function() {
          var response = JSON.parse(request.responseText);
          ref.narocilo.narocnik={
            ime:response.uporabnik.ime,
            priimek:response.uporabnik.priimek,
            naslov:response.uporabnik.naslov,
            tel_stevilka:response.uporabnik.telefon
          }
        });
        request.addEventListener("error", function() {
            console.log("NAPAKA!");
        });
      }
    }

  });

});
