$(document).ready(function(){

  var app = new Vue({
    el: '#app',
    data: {
      root_url: document.getElementById("rootUrl").value,
      kategorijaId:document.getElementById("kategorija").value,
      query:document.getElementById("query").value,
      //kategorijaId:2,
      tabelaArtiklov:[],
      st_izdelkov:0,
      nalozeno:false,
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
          console.log("Artikli so: "+ response);
          ref.posodobiTabeloArtiklov(response.izdelki);
          ref.nalozeno=true;
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
            this.st_izdelkov=tabelaArtiklov.length;
        }
      }

    }

  });

});
