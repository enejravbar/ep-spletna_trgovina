$(document).ready(function(){

  var app = new Vue({
    el: '#app',
    data: {
      root_url: document.getElementById("rootUrl").value,
      artikel_id: document.getElementById("idArtikla").value,
      artikel:{

      }
    },
    mounted: function(){

      this.getData(this);

    },
    methods:{
      getData: function(ref){
        //console.log("PRIDOBIVAM PODATKE!!!!!!!!!!!!!")
        var request = new XMLHttpRequest();
        request.open('GET', this.root_url+'api/izdelki/'+this.artikel_id, true);
        request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
        request.send();

        request.addEventListener("load", function() {
          var response = JSON.parse(request.responseText);
          console.log(response);
          ref.posodobiPodatkeArtikla(response);

        });
        request.addEventListener("error", function() {
            console.log("NAPAKA!");
        });
      },
      posodobiPodatkeArtikla: function(response){
        var artikel={
          id:response.izdelek.id,
          ime_artikla:response.izdelek.ime,
          redna_cena:response.izdelek.cena,
          opis_artikla:response.izdelek.opis,
          tabelaUrlSlik:[],
        };

        for(var i=0; i<response.slike.length; i++){
          artikel.tabelaUrlSlik.push( this.root_url+((response.slike)[i].lokacija) );
        }
        this.artikel=artikel;
        console.log("ARTIKEL----------"+artikel);
      }

    }
  });

});
