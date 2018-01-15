$(document).ready(function(){

  var app = new Vue({
    el: '#app',
    data: {
      root_url: document.getElementById("rootUrl").value,
      artikel_id: document.getElementById("idArtikla").value,
      napis:"V KOŠARICO",
      artikel:{

      },
      prijavljen:false,
      uporabnik:null,
      iskalniNiz:"",
      prijavaPreverjena:false,
    },
    mounted: function(){
      this.getData(this);
      this.preveriPrijavo();
    },
    methods:{
      preveriPrijavo: function(){
        var request = new XMLHttpRequest();
        var ref=this;
        request.open('GET', this.root_url+'api/profil', true);
        request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
        request.send();

        request.addEventListener("load", function() {
          var response = JSON.parse(request.responseText);
          console.log("Response "+response);

          if(response.prijavljen){
            ref.prijavljen=true;
            ref.uporabnik=response.uporabnik;
          }else{
            ref.prijavljen=false;
            ref.uporabnik=null;
          }
          ref.prijavaPreverjena=true;
        });
        request.addEventListener("error", function() {
            console.log("NAPAKA!");
        });
      },
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
        var statusArtiklaText="";
        var statusArtiklaId=response.izdelek.status;

        if(statusArtiklaId=="1"){
          statusArtiklaText="Na zalogi";
        }else if(statusArtiklaId=="2"){
          statusArtiklaText="Zadnji kosi";
        }else if(statusArtiklaId=="3"){
          statusArtiklaText="Ni na voljo";
        }else if(statusArtiklaId=="4"){
          statusArtiklaText="Neaktiven";
        }

        var artikel={
          id:response.izdelek.id,
          ime_artikla:response.izdelek.ime,
          redna_cena:response.izdelek.cena,
          opis_artikla:response.izdelek.opis,
          status_artikla:statusArtiklaText,
          tabelaUrlSlik:[],
        };

        for(var i=0; i<response.slike.length; i++){
          artikel.tabelaUrlSlik.push( this.root_url+((response.slike)[i].lokacija) );
        }
        this.artikel=artikel;
        console.log("ARTIKEL----------"+artikel);
      },
      dodajVKosarico: function(){
        var ref=this;
        var request = new XMLHttpRequest();
        var data = {
          id_izdelka: this.artikel.id,
          kolicina:1,
        };

        data=JSON_to_URLEncoded(data);

        request.open('POST', this.root_url+'api/kosarica', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        request.send(data);

        request.addEventListener("load", function() {
          //var response = JSON.parse(request.responseText);
          ref.prikazObvestila();
        });
        request.addEventListener("error", function() {
            console.log("NAPAKA!");
        });

      },
      prikazObvestila: function(){
        var ref=this;
        ref.napis="V KOŠARICI"
        setTimeout(function(){ ref.napis="V KOŠARICO" }, 1300);

      }
    }
  });

});
