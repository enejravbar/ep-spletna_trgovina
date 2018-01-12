$(document).ready(function(){

  var app = new Vue({
    el: '#app',
    data: {
      root_url:document.getElementById("rootUrl").value,
      email:"",
      geslo:"",
    },
    methods:{
      prijaviOsebje: function(){
        console.log("email: "+ this.email + " geslo: "+ this.geslo);
      }
    }
  });

});
