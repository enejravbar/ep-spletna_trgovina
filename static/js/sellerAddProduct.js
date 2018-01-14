var form_data = new FormData();

$(document).ready(function(){

  var app = new Vue({
    el: '#app',
    data: {
      root_url: document.getElementById("rootUrl").value,
      artikel:{
            ime:"",
            opis:"",
            cena:"",
            status:"",
            kategorija:"",
            files:[],
      },
      tabelaKategorij:[],
      tabelaStatusov:[],
      ustvarjenNovIzdelek:false,
      pritisnjenGumb:false,
      prikaziSporocilo:false,
    },
    mounted: function(){
      this.getDataKategorije();
      this.getDataStatus();
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

        form_data.append("ime", this.artikel.ime);
        form_data.append("opis", this.artikel.opis);
        form_data.append("cena", this.artikel.cena);
        form_data.append("status", this.artikel.status);
        form_data.append("kategorija", this.artikel.kategorija);

        $.ajax({
          url: ref.root_url+"api/izdelki",
          data: form_data,
          enctype: "multipart/form-data",
          processData: false,
          contentType: false,
          type: "POST",
          statusCode: {
             404: function() {
                 console.log("-1-1-1-1 WE GOT 404!");
             },
             201: function() {
               ref.ustvarjenNovIzdelek=true;
               ref.prikaziSporocilo=true;
             }
          },
          success: function(response, textStatus, xhr){
            console.log("Status je "+xhr.status)
            if(xhr.status==201){
              ref.ustvarjenNovIzdelek=true;
              ref.prikaziSporocilo=true;
            }else{
              ref.ustvarjenNovIzdelek=false;
              ref.prikaziSporocilo=true;
            }
          },
          error: function(textStatus, xhr){
            console.log("Status je "+xhr.status)
              ref.ustvarjenNovIzdelek=false;
              ref.prikaziSporocilo=true;

          }
        });
      }

    }
  });

  handleImageUploads();

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



          for ( var i in files ) {
              form_data.append("files[]", files[i]);
          }

        });

    }).on('cancel.bs.filedialog', function(ev) {
      //window.location.replace("/sellerManageProduct")
    });
}
