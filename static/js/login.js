$(document).ready(function(){

  var app = new Vue({
    el: '#app',
    data: {
      root_url: document.getElementById("rootUrl").value,
      stranka:{
          email:"",
          geslo:"",
      },
      prijavaUspesna:true,
      klikNaGumbPrijava:false,
    },
    methods: {
      prijaviStranko: function(){

        var ref=this;
        var data="email="+this.stranka.email+"&geslo="+this.stranka.geslo;

        var request = new XMLHttpRequest();
        request.open('POST', this.root_url+'prijava', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        request.addEventListener("load", function() {
        	var response = JSON.parse(request.responseText);
          if(response.prijavljen){
            ref.prijavaUspesna=true;
            ref.klikNaGumbPrijava=true;
            window.location.href=ref.root_url;
            //setCookie("cookieStranka","true",1);
          }else{
            ref.prijavaUspesna=false;
            ref.klikNaGumbPrijava=true;
            //setCookie("cookieStranka","true",1);
            console.log("PRIJAVA NI BILA USPEŠNA!!!")
          }
          console.log(response);
        });
        request.addEventListener("error", function() {
            console.log("NAPAKA!");
        });
        request.send(data);

      }

    }

  });

});
