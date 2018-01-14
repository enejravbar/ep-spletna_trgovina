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
        email:"",
        geslo1:"",
        geslo2:"",
      },
      tabelaPosta:[],
      ustvarjenaNovaStranka:false,
      pritisnjenGumb:false,
      prikaziSporocilo:false,
      sporocilo:""

    },
    mounted: function(){
      this.getData();
    },
    events: {
       urejanjeStranke: function () {
         console.log("Stranka posodobljena!")
         this.getData();
       },
     },
    methods:{
      getData: function(){
        var request = new XMLHttpRequest();
        var ref=this;
        request.open('GET', this.root_url+'api/prodajalci', true);
        request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
        request.send();

        request.addEventListener("load", function() {
          var response = JSON.parse(request.responseText);
          var tabelaStrank=response.uporabniki;
          ref.posodobiTabeloStrank(tabelaStrank);
        });
        request.addEventListener("error", function() {
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
      gumbDodaj: function(){
        console.log("Zaznan klik na gumb dodaj")
        var uporabnik={
          ime:"",
          priimek:"",
          naslov:"",
          email:"",
          posta:"",
          telefon:"",
          geslo1:"",
          geslo2:"",
        };
        this.novUporabnik=uporabnik;
        this.prikaziSporocilo=false;
      },
      registrirajNovoStranko:function(){

        var request = new XMLHttpRequest();
        this.pritisnjenGumb=true;
        this.prikaziSporocilo=false;

        var ref=this;
        var uporabnik=this.novUporabnik;
        var data=JSON_to_URLEncoded(uporabnik);

        request.open('POST', this.root_url+'api/prodajalci', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        request.send(data);

        request.addEventListener("load", function() {
          //var response = JSON.parse(request.responseText);
          ref.prikaziSporocilo=true;

          if(request.status==201){
            ref.ustvarjenaNovaStranka=true;
            console.log("stranka uspešno kreirana!");

          }else if(request.status==409){
            ref.sporocilo="Email že obstaja!";
            ref.ustvarjenaNovaStranka=false;
          }else if(request.status==404){
            ref.sporocilo="Slabi parametri zahteve!";
            ref.ustvarjenaNovaStranka=false;
          }else if(request.status==500){
            ref.sporocilo="Napaka na strani strežnika!";
            ref.ustvarjenaNovaStranka=false;
          }else{
              ref.sporocilo="Preveri podatke!";
              ref.ustvarjenaNovaStranka=false;
          }
          ref.getData();
        });
        request.addEventListener("error", function() {
            ref.getData();
            console.log("NAPAKA!");
        });
      }
    }
  });

});
