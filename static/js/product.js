$(document).ready(function(){

  var app = new Vue({
    el: '#app',
    data: {
      root_url: document.getElementById("rootUrl").value,
      kategorijaId:document.getElementById("kategorija").value,
      query:document.getElementById("query").value,
      //kategorijaId:2,
      tabelaArtiklov:[]
    },
    mounted: function(){

      this.getData();

    },
    methods:{
      getData: function(){
        var ref=this;
        var request = new XMLHttpRequest();

        if(this.query!=""){
          request.open('GET', this.root_url+"api/izdelki?q="+this.query, true);
        }else if(this.kategorijaId!=""){
          request.open('GET', this.root_url+"api/izdelki?kategorija="+this.kategorijaId, true);
        }else{
          request.open('GET', this.root_url+"api/izdelki"+this.query, true);
        }

        request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
        request.send();

        request.addEventListener("load", function() {
          var response = JSON.parse(request.responseText);
          ref.posodobiTabeloArtiklov(response);

        });
        request.addEventListener("error", function() {
            console.log("NAPAKA!");
        });
      },
      posodobiTabeloArtiklov: function(tabelaArtiklov){

        this.tabelaArtiklov=[];

        for(var i=0; i<tabelaArtiklov.length; i++){
            artikel={
              povezava_artikel:this.root_url+"izdelki/"+tabelaArtiklov[i].id,
              slika_url:this.root_url+"data/images/izdelek5-2.jpeg",
              ime_artikla: tabelaArtiklov[i].ime,
              redna_cena:tabelaArtiklov[i].cena,
            }
            this.tabelaArtiklov.push(artikel);
        }
      }

    }

  });

});
