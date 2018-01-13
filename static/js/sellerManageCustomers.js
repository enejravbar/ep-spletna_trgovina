$(document).ready(function(){

  var app = new Vue({
    el: '#app',
    data: {
      root_url:document.getElementById("rootUrl").value,
      tabelaStrank:[
        /*
        { id:1,
          ime:"Jože",
          priimek:"Gorišek",
          naslov:"Dolenja vas 34",
          email_naslov:"joze.gorisek@gmail.com",
          tel_stevilka:"031436341",
          statusActive:false
        }
        */
      ],
      novUporabnik:{
        ime:"",
        priimek:"",
        naslov:"",
        email:"",
        posta:"",
        telefon:"",
        geslo1:"",
        geslo2:"",
      },
      tabelaPosta:[],
      ustvarjenaNovaStranka:false,
      pritisnjenGumb:false

    },
    mounted: function(){
      this.getData();
      this.getDataPoste();
    },
    methods:{
      getData: function(){
        var request = new XMLHttpRequest();
        var ref=this;
        request.open('GET', this.root_url+'api/stranke', true);
        request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
        request.send();

        request.addEventListener("load", function() {
          var response = JSON.parse(request.responseText);
          var tabelaStrank=response.uporabniki;
          ref.posodobiTabeloStrank(tabelaStrank);
        });
        request.addEventListener("error", function() {
            console.log("NAPAKA!");
        });
      },
      getDataPoste: function(){
        var request = new XMLHttpRequest();
        var ref=this;

        //console.log(data);
        request.open('GET',this.root_url+'api/poste' ,true);
        request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
        request.send();

        request.addEventListener("load", function() {
          var response = JSON.parse(request.responseText);
          ref.tabelaPosta=response
        });
        request.addEventListener("error", function() {
            console.log("NAPAKA!");
        });
      },
      spremeniStatusStranke: function(stranka){
        //204
        console.log("Zaznan klik za AKTIVACIJO/DEAKTIVACIJO!")
        var request = new XMLHttpRequest();
        var ref=this;
        console.log("STATUS STRANKE: "+ stranka.statusActive);
        if(stranka.statusActive==1){
          request.open('PUT', this.root_url+'api/uporabniki/'+stranka.id+"/deaktiviraj", true);
        }else if(stranka.statusActive==2 || stranka.statusActive==3){
          request.open('PUT', this.root_url+'api/uporabniki/'+stranka.id+"/aktiviraj", true);
        }
        request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
        request.send();

        request.addEventListener("load", function() {
          if(request.status==204){
            console.log("Aktivacija/deaktivacija uspešna!!!");
            ref.getData();
          }else{
            console.log("Napaka pri aktivaciji/deaktivaciji");
            ref.getData();
          }
        });
        request.addEventListener("error", function() {
            console.log("NAPAKA!");
        });

      },
      posodobiTabeloStrank: function(tabelaStrank){
        this.tabelaStrank=[];
        for(var i=0; i<tabelaStrank.length; i++){
          var stranka={
            id:tabelaStrank[i].id,
            ime:tabelaStrank[i].ime,
            priimek:tabelaStrank[i].priimek,
            naslov:tabelaStrank[i].naslov,
            email_naslov:tabelaStrank[i].email,
            tel_stevilka:tabelaStrank[i].telefon,
            statusActive:tabelaStrank[i].status,
          }
          this.tabelaStrank.push(stranka);
        }
      },
      registrirajNovoStranko:function(){
        var request = new XMLHttpRequest();
        this.pritisnjenGumb=true;
        var ref=this;
        var uporabnik=this.novUporabnik;
        var data=JSON_to_URLEncoded(uporabnik);

        request.open('POST', this.root_url+'api/stranke', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        request.send(data);

        request.addEventListener("load", function() {
          var response = JSON.parse(request.responseText);
          if(request.status==201){
            ref.ustvarjenaNovaStranka=true;

          }else{

            ref.ustvarjenaNovaStranka=false;
          }
          ref.getData();
        });
        request.addEventListener("error", function() {
            console.log("NAPAKA!");
        });
      }
    }
  });

});
