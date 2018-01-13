
var app=null;
$(document).ready(function(){

  app = new Vue({
    el: '#app',
    data: {
      root_url: document.getElementById("rootUrl").value,
      artikel_id:document.getElementById("artikel_id").value,
      artikel:{},
      tabelaKategorij:[],
      tabelaStatusov:[],
      ustvarjenNovIzdelek:false,
      pritisnjenGumb:false,
      prikaziSporocilo:false,
    },
    mounted: function(){
      this.getDataKategorije();
      this.getDataStatus();
      this.getDataArtikel();
      handleImageUploads();
    },
    methods:{
      getDataKategorije: function(){

        var request = new XMLHttpRequest();
        var ref=this;
        request.open('GET', this.root_url+'api/kategorije', true);
        request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
        request.send();

        request.addEventListener("load", function() {
          var response = JSON.parse(request.responseText);
          var tabelaKategorij = response;
          ref.posodobiKategorije(tabelaKategorij)
        });
        request.addEventListener("error", function() {
            console.log("NAPAKA!");
        });
      },
      getDataStatus: function(){
        var request = new XMLHttpRequest();
        var ref=this;
        request.open('GET', this.root_url+'api/status', true);
        request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
        request.send();

        request.addEventListener("load", function() {
          var response = JSON.parse(request.responseText);
          ref.posodobiStatuse(response);
        });
        request.addEventListener("error", function() {
            console.log("NAPAKA!");
        });
      },
      getDataArtikel: function(){
        var request = new XMLHttpRequest();
        var ref=this;
        console.log("Id artikla je: "+ this.artikel_id);
        request.open('GET', this.root_url+'api/izdelki/'+this.artikel_id, true);
        request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
        request.send();

        request.addEventListener("load", function() {
          var response = JSON.parse(request.responseText);
          var artikel={
                id:response.izdelek.id,
                ime:response.izdelek.ime,
                opis:response.izdelek.opis,
                cena:response.izdelek.cena,
                status:response.izdelek.status,
                kategorija:response.izdelek.kategorija,
                tabelaSlik:response.slike
          };
          console.log("Id artikla je: "+ artikel.tabelaSlik);
          ref.artikel=artikel;
        });
        request.addEventListener("error", function() {
            console.log("NAPAKA!");
        });
      },
      posodobiKategorije: function(tabelaKategorij){
        this.tabelaKategorij=[];
        for(var i=0; i< tabelaKategorij.length; i++){
            var kategorija=  {
              id: tabelaKategorij[i].id,
              ime: tabelaKategorij[i].ime,
            };
            this.tabelaKategorij.push(kategorija);
          }
      },
      posodobiStatuse: function(tabelaStatusov){
        this.tabelaStatusov=[];
        for(var i=0; i< tabelaStatusov.length; i++){
            var status=  {
              id: tabelaStatusov[i].id,
              ime: tabelaStatusov[i].naziv,
            };
            this.tabelaStatusov.push(status);
          }
      },
      dodajIzdelek: function(){

        var ref=this;
        this.pritisnjenGumb=true;
        this.ustvarjenNovIzdelek=false;
        this.prikaziSporocilo=false;

        var artikel={
          ime:this.artikel.ime,
          opis:this.artikel.opis,
          cena:this.artikel.cena,
          status:this.artikel.status,
          kategorija:this.artikel.kategorija,

        }

        var data=JSON_to_URLEncoded(artikel);
        var request = new XMLHttpRequest();
        request.open('PUT', this.root_url+'api/izdelki/'+this.artikel_id, true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        request.send(data);

        request.addEventListener("load", function() {
          var response = JSON.parse(request.responseText);
          if(request.status>=200 && request.status<300 ){
            ref.ustvarjenNovIzdelek=true;
            ref.prikaziSporocilo=true;
          }else{
            ref.ustvarjenNovIzdelek=false;
            ref.prikaziSporocilo=true;
          }

        });
        request.addEventListener("error", function() {
            console.log("NAPAKA!");
        });

      },

      zapisiNovePodatkeArtikla: function(){
        var ref=this;

      },
      odstraniSliko: function(slika){
        var request = new XMLHttpRequest();
        var ref=this;

        request.open('DELETE', this.root_url+'api/izdelki/'+this.artikel_id+"/slike/"+slika.id, true);
        request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
        request.send();

        request.addEventListener("load", function() {
          //var response = JSON.parse(request.responseText);
          ref.getDataArtikel();
        });
        request.addEventListener("error", function() {
            console.log("NAPAKA!");
            ref.getDataArtikel();
        });
      }
    }
  });



});


function handleImageUploads(){
  $("#open_btn").click(function() {

      $.FileDialog({
      // MIME type of accepted files, e. g. image/jpeg
      accept: "*",
      cancelButton: "Zapri",
      dragMessage: "Povlečite slike sem",
      dropheight: 400,
      errorMessage: "Med nalaganjem je prišlo do napake!",
      multiple: true,
      okButton: "Naloži slike",
      readAs: "DataURL",
      removeMessage: "Odstrani&nbsp;",

      title: "Naloži slike"
      }).on('files.bs.filedialog', function(ev) {

          var files = ev.files;
          var form_data = new FormData();
          for ( var i in files ) {
              form_data.append("files[]", files[i]);
          }
          var root_url= document.getElementById("rootUrl").value;
          var artikel_id= document.getElementById("artikel_id").value;

          $.ajax({
            url: root_url+"api/izdelki/"+artikel_id+"/slike",
            data: form_data,
            enctype: "multipart/form-data",
            processData: false,
            contentType: false,
            type: "POST",
            success: function(response, textStatus, xhr){
              console.log("Uspešno dodajanje slik")
              app.getDataArtikel();
            },
            error: function(textStatus, xhr){
              app.getDataArtikel();
            }
          });

        });

    }).on('cancel.bs.filedialog', function(ev) {
      //window.location.replace("/sellerManageProduct")
    });
}
