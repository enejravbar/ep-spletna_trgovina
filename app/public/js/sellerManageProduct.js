$(document).ready(function(){

  var app = new Vue({
    el: '#app',
    data: {
      artikel:{
            id:1,
            kolicina:1,
            povezava_artikel:"single.html",
            tabela_urljev:["images/ba.jpg","images/ba.jpg"],
            slika_url:"images/ba.jpg",
            ime_artikla:"Usnjena torba",
            redna_cena:"400",
            znizana_cena:"300"
      },
    },
    methods:{
      odstraniIzdelek: function(artikel){
        for(var i = this.tabelaArtiklov.length; i--;) {
            if(this.tabelaArtiklov[i] === artikel) {
                this.tabelaArtiklov.splice(i, 1);
            }
        }
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
          console.log(form_data);

          $.ajax({
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
              window.location.replace("sellerManageProduct.html")
            }
          });

        });

    }).on('cancel.bs.filedialog', function(ev) {
      //window.location.replace("/sellerManageProduct")
    });
}
