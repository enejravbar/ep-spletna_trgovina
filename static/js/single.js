$(document).ready(function(){

  var app = new Vue({
    el: '#app',
    data: {
      root_url: document.getElementById("rootUrl").value,
      /*artikel:{
        tabelaUrlSlik:["images/s3.jpg","images/s3.jpg","images/s3.jpg","images/s4.jpg"],
        ime_artikla:"Usnjena torba",
        redna_cena:"400",
        znizana_cena:"300",
        opis_artikla:"V spletni trgovini mimovrste=) lahko izbirate med širokim naborom oblačil in obutve za ženske, moške in otroke. Na voljo so oblačila in obutev številnih priznanih blagovnih znamk, ki zagotavljajo kakovost svojih izdelkov. Na izbiro so modni in športni izdelki v različnih barvah in velikostih. V široki ponudbi oblačil in obutve boste brez težav našli nekaj zase."
      }*/
    },
    mounted: function(){
      this.getData(this);
    },
    methods:{
      getData: function(ref){
        console.log("PRIDOBIVAM PODATKE!!!!!!!!!!!!!")
        var request = new XMLHttpRequest();
        request.open('GET', this.root_url+'api/izdelki/index', true);
        request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
        request.send();

        request.addEventListener("load", function() {
          var response = JSON.parse(request.responseText);
          var tabelaZadnjihArtiklov=response.zadnji;
          var tabelaOcenjenihArtiklov=response.ocenjeni;
          ref.posodobiZadnjeArtikle(tabelaZadnjihArtiklov);
          ref.posodobiSlideShow(tabelaOcenjenihArtiklov);

        });
        request.addEventListener("error", function() {
            console.log("NAPAKA!");
        });
      }

    }
  });

});
