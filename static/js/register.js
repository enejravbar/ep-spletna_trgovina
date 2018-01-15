$(document).ready(function(){

  var app = new Vue({
    el: '#app',
    data: {
      root_url:document.getElementById("rootUrl").value,
      novUporabnik:{
        ime:"",
        priimek:"",
        naslov:"",
        email:"",
        posta:"",
        telefon:"",
        geslo1:"",
        geslo2:"",
        captchaVerification:""
      },
      sitekey:"6LdiskAUAAAAAGY5YFT9I0GwQYMJR80KgCaFqFOR",
      tabelaPosta:[],
      ustvarjenaNovaStranka:false,
      pritisnjenGumb:false,
      prikaziSporocilo:false,
      sporocilo:""

    },
    components: {
    'vue-recaptcha': VueRecaptcha
    },
    mounted: function(){
      this.getDataPoste();
    },
    methods:{
      getDataPoste: function(){
        var request = new XMLHttpRequest();
        var ref=this;

        //console.log(data);
        request.open('GET',this.root_url+'api/poste' ,true);
        request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
        request.send();

        request.addEventListener("load", function() {
          var response = JSON.parse(request.responseText);
          ref.tabelaPosta=response;
        });
        request.addEventListener("error", function() {
            console.log("NAPAKA!");
        });
      },

      registrirajNovoStranko:function(){

        var request = new XMLHttpRequest();
        this.pritisnjenGumb=true;
        this.prikaziSporocilo=false;

        var ref=this;
        var uporabnik=this.novUporabnik;
        var data=JSON_to_URLEncoded(uporabnik);

        request.open('POST', this.root_url+'registracija', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        request.send(data);

        request.addEventListener("load", function() {
          var response = JSON.parse(request.responseText);
          ref.prikaziSporocilo=true;

          if(request.status==201){
            ref.ustvarjenaNovaStranka=true;
            console.log("stranka uspešno kreirana!");
            //window.location.href = ref.root_url+'prijava';

          }else if(request.status==409){
            ref.sporocilo="Email že obstaja!";
            ref.ustvarjenaNovaStranka=false;
          }else if(request.status==404){
            ref.sporocilo="Slabi parametri zahteve!";
            ref.ustvarjenaNovaStranka=false;
          }else if(request.status==428){
            ref.sporocilo="Captcha neveljavna!";
            ref.ustvarjenaNovaStranka=false;
          }else if(request.status==500){
            ref.sporocilo="Napaka na strani strežnika!";
            ref.ustvarjenaNovaStranka=false;
          }else{
              ref.sporocilo="Preveri podatke!";
              ref.ustvarjenaNovaStranka=false;
          }
        });
        request.addEventListener("error", function() {
            console.log("NAPAKA!");
        });
      },

      onSubmit: function () {
      this.$refs.invisibleRecaptcha.execute()
      },
      onVerify: function (response) {
        console.log(response);
        this.novUporabnik.captchaVerification=response;
      },
      onExpired: function () {
        console.log('Expired')
      },
      resetRecaptcha () {
        this.$refs.recaptcha.reset() // Direct call reset method
      }
    }
  });

});
