$(document).ready(function(){

  var app = new Vue({
    el: '#app',
    data: {
      root_url:document.getElementById("rootUrl").value,
      id_narocila:document.getElementById("id_narocila").value,

      narocilo:{
        id_narocila:id_narocila,
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

    },
    mounted: function(){

      //this.pridobiPodatkeNarocnika();
      this.pridobiArtikleNarocila();
    },
    methods:{

      pridobiPodatkeNarocnika: function(idStranke){
        var request = new XMLHttpRequest();
        var ref=this;
        request.open('GET', this.root_url+'api/stranke/'+idStranke, true);
        request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
        request.send();

        request.addEventListener("load", function() {
          var response = JSON.parse(request.responseText);
          var narocnik={
            ime:response.ime,
            priimek:response.priimek,
            naslov:response.naslov,
            tel_stevilka:response.telefon,
          }
          ref.narocilo.narocnik=narocnik;
        });
        request.addEventListener("error", function() {

        });
      },
      pridobiArtikleNarocila: function(){
        var request = new XMLHttpRequest();
        var ref=this;
        request.open('GET', this.root_url+"api/narocila/"+this.id_narocila+"/podrobnosti", true);
        request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
        request.send();

        request.addEventListener("load", function() {
          var response = JSON.parse(request.responseText);
          var tabelaArtiklov=response.izdelki;
          ref.narocilo.cena_narocila=response.vrednost;
//  {slika_url:"api/slike/2", ime_artikla:"Usnjena torba", redna_cena:"400", znizana_cena:"300"},


          for(var i=0; i<tabelaArtiklov.length; i++){
            var artikel={
              ime_artikla:tabelaArtiklov[i].ime,
              slika_url: ref.root_url+"api/slike/"+tabelaArtiklov[i].thumbnail,
              redna_cena: tabelaArtiklov[i].cena,
              skupna_cena: tabelaArtiklov[i].skupaj_izdelek,
              kolicina:tabelaArtiklov[i].kolicina,
            }
            ref.narocilo.tabelaArtiklov.push(artikel);
          }
          ref.pridobiPodatkeNarocnika(response.podrobnosti.kupec)
        });
        request.addEventListener("error", function() {
            console.log("NAPAKA!");
            callback({"msg": "napaka!"});
        });
      }

    }

  });

});
