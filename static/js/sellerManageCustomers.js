$(document).ready(function(){

  var app = new Vue({
    el: '#app',
    data: {
      tabelaStrank:[
        { id:1, ime:"Jože", priimek:"Gorišek", naslov:"Dolenja vas 34", email_naslov:"joze.gorisek@gmail.com", tel_stevilka:"031436341", statusActive:false},
        { id:2, ime:"Luka", priimek:"Tavčar", naslov:"Dolenja vas 22",email_naslov:"luka.tavcar@gmail.com", tel_stevilka:"031436341", statusActive:true}

      ],
    }
  });

});
