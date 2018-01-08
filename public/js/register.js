$(document).ready(function(){

  var app = new Vue({
    el: '#app',
    data: {
      tabelaKategorij:[
        {ime:"Računalništvo", url:"product.html"},
        {ime:"Bela Tehnika", url:"product.html"},
        {ime:"Vrtnarstvo", url:"product.html"},
        {ime:"Obleke", url:"product.html"}
      ],
      artikel:{
        slika_url:"images/ba.jpg",
        ime_artikla:"Usnjena torba",
        redna_cena:"400",
        znizana_cena:"300"
      }
    }
  });

});
