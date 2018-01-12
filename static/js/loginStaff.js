$(document).ready(function(){

  var app = new Vue({
    el: '#app',
    data: {
      root_url: document.getElementById("rootUrl").value,
      osebje:{
          email: document.getElementById("email").value,
          geslo:"",
      },
      prijavaUspesna:true,
      klikNaGumbPrijava:false,
    },
    methods: {
      prijaviOsebje: function(){
        console.log("Zaznan klik na prijavi osebje!")
        var ref=this;
        var data="email="+this.osebje.email+"&geslo="+this.osebje.geslo;

        var request = new XMLHttpRequest();
        request.open('POST', this.root_url+'osebje/prijava', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        request.send(data);

        request.addEventListener("load", function() {
        	var response = JSON.parse(request.responseText);
          if(response.prijavljen){
            console.log("PRIJAVA USPEŠNA!!!")
            ref.prijavaUspesna=true;
            ref.klikNaGumbPrijava=true;
            window.location.href=ref.root_url;

          }else{
            ref.prijavaUspesna=false;
            ref.klikNaGumbPrijava=true;
            console.log("PRIJAVA NI BILA USPEŠNA!!!")
          }
        });
        request.addEventListener("error", function() {
            console.log("NAPAKA!");
        });


      }

    }

  });

});
