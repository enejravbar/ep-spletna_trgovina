$(document).ready(function(){

  var app = new Vue({
    el: '#app',
    data: {
      base_url:document.getElementById("baseUrl").value,
      stranka:{
          email:"",
          geslo:"",
      }
    },
    methods: {
      prijaviStranko: function(){
        var data="email="+this.stranka.email+"&geslo="+this.stranka.geslo;

        var request = new XMLHttpRequest();
        request.open('POST', this.base_url+'prijava', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        request.addEventListener("load", function() {
        	var response = JSON.parse(request.responseText);
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
