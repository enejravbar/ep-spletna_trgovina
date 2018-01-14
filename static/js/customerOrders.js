$(document).ready(function(){

  var app = new Vue({
    el: '#app',
    data: {
      root_url:document.getElementById("rootUrl").value,
      tabelaNarocil:[]
    },
    mounted: function(){

      this.getData();


    },
    methods:{
      getData: function(){

        var request = new XMLHttpRequest();
        var ref=this;
        request.open('GET', this.root_url+'api/narocila/stranka', true);
        request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
        request.send();

        request.addEventListener("load", function() {
          var response = JSON.parse(request.responseText);
          ref.tabelaNarocil=[];

          var tabelaNarocil=response;

          for(var i=0; i<tabelaNarocil.length; i++){

            var statusNarocila=tabelaNarocil[i].status;
            var statusNarocilaText="";

            if(statusNarocila==1){
              statusNarocilaText="ODDANO";
            }else if(statusNarocila==2){
              statusNarocilaText="POTRJENO";
            }else if(statusNarocila==3){
              statusNarocilaText="STORNIRANO";
            }else if(statusNarocila==4){
              statusNarocilaText="PREKLICANO";
            }

            var narocilo={
              id_narocila:tabelaNarocil[i].id,
              datum_narocila:tabelaNarocil[i].datum,
              status_narocila:statusNarocilaText,
            }

            ref.tabelaNarocil.push(narocilo)
          }


        });
        request.addEventListener("error", function() {
            console.log("NAPAKA!");
        });
      },
      pridobiPodatkeNarocnika: function(callback){
        var request = new XMLHttpRequest();
        request.open('GET', this.root_url+'api/profil', true);
        request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
        request.send();

        request.addEventListener("load", function() {
          var response = JSON.parse(request.responseText);
          callback(null, response);
        });
        request.addEventListener("error", function() {
            console.log("NAPAKA!");
            callback({"msg": "napaka!"});
        });
      },

      pridobiArtikleNarocila: function(narocilo,idNarocila,callback){
        var request = new XMLHttpRequest();
        request.open('GET', this.root_url+"api/narocila/"+idNarocila+"/podrobnosti", true);
        request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
        request.send();

        request.addEventListener("load", function() {
          var response = JSON.parse(request.responseText);
          callback(null, response);
        });
        request.addEventListener("error", function() {
            console.log("NAPAKA!");
            callback({"msg": "napaka!"});
        });
      }

    }

  });

});
