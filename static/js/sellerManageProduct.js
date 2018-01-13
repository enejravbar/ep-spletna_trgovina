var slikeFiles=null;

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
        var request = new XMLHttpRequest();
        //this.pritisnjenGumb=true;
        var ref=this;
        this.artikel.files=slikeFiles;

        var data=JSON_to_URLEncoded(this.artikel);
        console.log(data);
        request.open('POST', this.root_url+'api/izdelki', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        request.send(data);

        request.addEventListener("load", function() {
          var response = JSON.parse(request.responseText);
          if(request.status>=200 && request.status<300){
            //ref.posodobljeniPodatki=true;
          }else{
            //ref.posodobljeniPodatki=false;
          }
        });
        request.addEventListener("error", function() {
            console.log("NAPAKA!");
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

          var form_data = new FormData();

          for ( var file in files ) {
              form_data.append(file, files[file]);
          }
          //console.log( JSON.stringify(files) )
          slikeFiles=files;
        });

    }).on('cancel.bs.filedialog', function(ev) {
      //window.location.replace("/sellerManageProduct")
    });
}
