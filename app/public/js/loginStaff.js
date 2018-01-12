$(document).ready(function(){

  var app = new Vue({
    el: '#app',
    data: {
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
