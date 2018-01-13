var slikeFormData=null;

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
            slika:[],
      },
      tabelaKategorij:[],
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
              url: this.root_url+"izdelki?kategorija="+tabelaKategorij[i].id,
            };
            this.tabelaKategorij.push(kategorija);
          }
      },
      posodobiStatuse: function(tabelaKategorij){
        /*this.tabelaKategorij=[];
        for(var i=0; i< tabelaKategorij.length; i++){
            var kategorija=  {
              id: tabelaKategorij[i].id,
              ime: tabelaKategorij[i].ime,
              url: this.root_url+"izdelki?kategorija="+tabelaKategorij[i].id,
            };
            this.tabelaKategorij.push(kategorija);
          }*/
      },

      dodajIzdelek: function(){
        var request = new XMLHttpRequest();
        //this.pritisnjenGumb=true;
        var ref=this;
        var uporabnik=this.uporabnik;
        var data=JSON_to_URLEncoded(uporabnik);

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
              console.log("Slike"+file)
          }
          slikeFormData = form_data
          console.log(slikeFormData);

    /*      $.ajax({
          	url: "/upload",
          	type: "POST",
          	data:  form_data,
          	contentType: "multipart/form-data",
          	cache: false,
          	processData:false,
          	success: function(data){
          	   window.location.replace("sellerManageProduct.html");
          	},
          	error: function(){
              console.log("Slike niso bile uspešno naložene")
              //window.location.replace("sellerManageProduct.html")
            }
          });*/

        });

    }).on('cancel.bs.filedialog', function(ev) {
      //window.location.replace("/sellerManageProduct")
    });
}
