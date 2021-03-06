function JSON_to_URLEncoded(element,key,list){
  var list = list || [];
  if(typeof(element)=='object'){
    for (var idx in element)
      JSON_to_URLEncoded(element[idx],key?key+'['+idx+']':idx,list);
  } else {
    list.push(key+'='+encodeURIComponent(element));
  }
  return list.join('&');
}

Vue.component('glava', {
  props:['root_url'],
  data: function(){
    return {
      prijavljen:false,
      uporabnik:null,
      iskalniNiz:"",
      prijavaPreverjena:false,
    }
  },
  template:`
  <div class="header">
   <div class="top-header">
      <div class="container" style="height:15px;">
      </div>
   </div>
   <div class="bottom-header">
      <div class="container">
         <div class="header-bottom-left">
            <div class="logo">
               <a :href="root_url">
                <img :src="root_url+'static/images/logo.png'" alt=" " />
               </a>
            </div>
            <div class="search" style="margin-top:26px;" v-if=" (prijavljen && uporabnik.vloga==3) || !prijavljen && prijavaPreverjena">
               <input type="text" value="" v-model="iskalniNiz" >
               <input type="submit"  value="ISKANJE" v-on:click=isciArtikle()>
            </div>
            <div class="clearfix"> </div>
         </div>
         <div class="header-bottom-right">

            <div style="display:block;">

              <div class="cart" style="display:inline-block;float:right; margin-left:10px;" v-if="(prijavljen  && uporabnik.vloga==3)">
                <a :href="root_url+'kosarica'">
                  <button class="btn btn-default" type="button" ><span> </span>KOŠARICA
                  </button>
                </a>
              </div>

              <div class="dropdown" style="display:inline-block; float:right; margin-left:10px; " v-if="prijavljen">
               <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" style=" padding: 9px 9px 9px 9px ">Pozdravljen/a {{uporabnik.ime}}

               <span class="caret"></span></button>

               <ul class="dropdown-menu" v-if="uporabnik.vloga==3">
                <li ><a :href="root_url+'narocila'"><span >Pregled naročil</span> </a></li>
                 <li ><a :href="root_url+'profil'"><span >Upravljaj račun</span> </a></li>
                 <li ><a :href="root_url+'odjava'">Odjava</a></li>
               </ul>

               <ul class="dropdown-menu" v-if="uporabnik.vloga==2">
                 <li ><a :href="root_url+'prodaja/narocila'"><span >Pregled naročil</span> </a></li>
                 <li ><a :href="root_url+'prodaja/stranke'"><span >Upravljanje strank</span> </a></li>
                 <li ><a :href="root_url+'prodaja/izdelki'"><span >Upravljanje artiklov</span> </a></li>
                 <li ><a :href="root_url+'profil'"><span >Upravljaj račun</span> </a></li>
                 <li ><a :href="root_url+'odjava'">Odjava</a></li>
               </ul>

               <ul class="dropdown-menu" v-if="uporabnik.vloga==1">
                 <li ><a :href="root_url+'admin'"><span >Upravljanje prodajalcev</span> </a></li>
                 <li ><a :href="root_url+'profil'"><span >Upravljaj račun</span> </a></li>
                 <li ><a :href="root_url+'odjava'">Odjava</a></li>
               </ul>

              </div>

              <div style="display:inline-block; float:right; margin-left:10px;" v-if="!prijavljen && prijavaPreverjena">
                 <ul class="login" >
                    <li>
                      <div>
                        <a :href="root_url+'prijava'">
                         <button class="btn btn-default" type="button" ><span> </span>PRIJAVA</button>
                       </a>

                      </div>
                    </li>
                 </ul>
               </div>

            </div>
            <div class="clearfix"> </div>
         </div>
         <div class="clearfix"> </div>
      </div>
   </div>
</div>`,
mounted: function(){
  this.preveriPrijavo();
},
methods:{
  preveriPrijavo: function(){
    var request = new XMLHttpRequest();
    var ref=this;
    request.open('GET', this.root_url+'api/profil', true);
    request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
    request.send();

    request.addEventListener("load", function() {
      var response = JSON.parse(request.responseText);
      console.log("Response "+response);

      if(response.prijavljen){
        ref.prijavljen=true;
        ref.uporabnik=response.uporabnik;
      }else{
        ref.prijavljen=false;
        ref.uporabnik=null;
      }
      ref.prijavaPreverjena=true;
    });
    request.addEventListener("error", function() {
        console.log("NAPAKA!");
    });
  },
  isciArtikle: function(){
    window.location.href = this.root_url+"izdelki?q="+this.iskalniNiz;
  }
}

});

Vue.component('glava-login', {
  props:['root_url'],
  template:`
  <div class="header">
   <div class="top-header">
      <div class="container" style="height:15px;">
      </div>
   </div>
   <div class="bottom-header">
      <div class="container">
         <div class="header-bottom-left">
            <div class="logo">
            <a :href="root_url">
               <img :src="root_url+'static/images/logo.png'" alt=" " />
            </a>
            </div>

            <div class="clearfix"> </div>
         </div>
         <div class="header-bottom-right">

         </div>
         <div class="clearfix"> </div>
      </div>
   </div>
</div>`
});

Vue.component('noga', {
  template:`<div></div>`

});


Vue.component('artikel-domaca-stran', {
  props:['root_url','artikel','slika_url','ime_artikla','redna_cena','znizana_cena','st_slike'],
  data: function(){
    return{
          napis:"V KOŠARICO",
          prijavljen:false,
          uporabnik:null,
          iskalniNiz:"",
          prijavaPreverjena:false,
    }
  },
  template:`
  <div v-if="st_slike<=1" class="col-md-4 chain-grid ">
     <a :href="root_url+'izdelki/'+artikel.id"><img class="img-responsive chain" :src="artikel.slika_url" alt=" " /></a>
     <div class="grid-chain-bottom">
        <h6><a href="single.html">{{artikel.ime_artikla}}</a></h6>
        <div class="star-price">
           <div class="dolor-grid">
              <span >CENA:</span>
              <span class="actual">{{artikel.redna_cena}}€</span>
              <span class="rating">

              </span>
           </div>
           <a class="now-get get-cart"  v-on:click="dodajVKosarico()" v-if="prijavljen && uporabnik.vloga == 3" >{{napis}}</a>
           <div class="clearfix"> </div>
        </div>
     </div>
  </div>

  <div v-else class="col-md-4 chain-grid grid-top-chain">
     <a :href="root_url+'izdelki/'+artikel.id"><img class="img-responsive chain" :src="artikel.slika_url" alt=" " /></a>
     <div class="grid-chain-bottom">
        <h6><a href="single.html">{{artikel.ime_artikla}}</a></h6>
        <div class="star-price">
           <div class="dolor-grid">
              <span >CENA:</span>
              <span class="actual">{{artikel.redna_cena}}€</span>
              <span class="rating">

              </span>
           </div>
           <a class="now-get get-cart" v-on:click="dodajVKosarico()" v-if="prijavljen && uporabnik.vloga == 3" >{{napis}}</a>
           <div class="clearfix"> </div>
        </div>
     </div>
  </div>
  `,
  mounted: function(){
    this.preveriPrijavo();
  },
  methods: {
    preveriPrijavo: function(){
      var request = new XMLHttpRequest();
      var ref=this;
      request.open('GET', this.root_url+'api/profil', true);
      request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
      request.send();

      request.addEventListener("load", function() {
        var response = JSON.parse(request.responseText);
        console.log("Response "+response);

        if(response.prijavljen){
          ref.prijavljen=true;
          ref.uporabnik=response.uporabnik;
        }else{
          ref.prijavljen=false;
          ref.uporabnik=null;
        }
        ref.prijavaPreverjena=true;
      });
      request.addEventListener("error", function() {
          console.log("NAPAKA!");
      });
    },
    isciArtikle: function(){
      window.location.href = this.root_url+"izdelki?q="+this.iskalniNiz;
    },
    dodajVKosarico: function(){
      var ref=this;
      var request = new XMLHttpRequest();
      var data = {
        id_izdelka: this.artikel.id,
        kolicina:1,
      };

      data=JSON_to_URLEncoded(data);

      request.open('POST', this.root_url+'api/kosarica', true);
      request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
      request.send(data);

      request.addEventListener("load", function() {
        var response = JSON.parse(request.responseText);

        ref.prikazObvestila();
      });
      request.addEventListener("error", function() {
          console.log("NAPAKA!");
      });

    },
    prikazObvestila: function(){
      var ref=this;
      ref.napis="V KOŠARICI"
      setTimeout(function(){ ref.napis="V KOŠARICO" }, 1300);

    }
  }

});

Vue.component('kategorija', {
  props:['url','ime_kategorije'],
  template:`<li><a :href="url">{{ime_kategorije}}</a></li>`
});

Vue.component('navigacijski-menu', {
  props:[],
  template:`
  <div class="sub-cate">
    <div class=" top-nav rsidebar span_1_of_left">
       <h3 class="cate">KATEGORIJE</h3>
       <ul class="menu">
          <ul class="kid-menu " >
            <slot name="kategorija" >
            </slot>
          </ul>
       </ul>
    </div>
    <slot name="artikel-posebna-ponudba">
    </slot>
    <slot></slot>
  </div>
  `
});

Vue.component('navigacijski-menu-wrapper', {
  props:['root_url'],
  template:`
  <navigacijski-menu>
    <div slot="kategorija" v-for="kategorija in tabelaKategorij">
      <kategorija  :url="kategorija.url" :ime_kategorije="kategorija.ime"> </kategorija>
    </div>
    <!-- <artikel-posebna-ponudba slot="artikel-posebna-ponudba" ></artikel-posebna-ponudba> -->
  </navigacijski-menu>
  `,
  data: function(){
    return {
      tabelaKategorij:[

      ]
    }
  },
  mounted: function(){
    this.getData(this);

  },
  methods:{
    getData: function(ref){
      console.log("PRIDOBIVAM PODATKE!!!!!!!!!!!!!")
      var request = new XMLHttpRequest();
      request.open('GET', this.root_url+'api/kategorije', true);
      request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
      request.send();

      request.addEventListener("load", function() {
        var response = JSON.parse(request.responseText);
        var tabelaKategorij = response;
        ref.posodobiKategorije(tabelaKategorij)
      });
      request.addEventListener("error", function() {
          console.log("NAPAKA!");
      });
    },
    posodobiKategorije: function(tabelaKategorij){
      this.tabelaKategorij=[];
      for(var i=0; i< tabelaKategorij.length; i++){
          var kategorija=  {
            id: tabelaKategorij[i].id,
            ime: tabelaKategorij[i].ime,
            url: this.root_url+"izdelki?kategorija="+tabelaKategorij[i].id,
          };
          this.tabelaKategorij.push(kategorija);
        }
    },
  }

});

Vue.component('artikel-product-stran', {
  props:['artikel','root_url'],
  data: function(){
    return{
          napis:"V KOŠARICO",
          prijavljen:false,
          uporabnik:null,
          iskalniNiz:"",
          prijavaPreverjena:false,
    }
  },
  template:`
  <div class="product-grid">
   <div class="content_box">
      <a :href="artikel.povezava_artikel">
         <div class="left-grid-view grid-view-left">
            <img :src="artikel.slika_url" class="img-responsive watch-right" alt=""/>
         </div>
      </a>
      <a :href="artikel.povezava_artikel"><h4>{{artikel.ime_artikla}}</h4></a>
      <div class="star-price">
         <div class="dolor-grid">
            <span >CENA:</span>
            <span class="actual">{{artikel.redna_cena}}€</span>
            <span class="rating">

            </span>
         </div>
         <a class="now-get get-cart" v-on:click="dodajVKosarico()" v-if="prijavljen  && uporabnik.vloga == 3 ">{{napis}}</a>
         <div class="clearfix"> </div>
      </div>
   </div>
</div>`,
mounted: function(){
  this.preveriPrijavo();
},
methods:{
  preveriPrijavo: function(){
    var request = new XMLHttpRequest();
    var ref=this;
    request.open('GET', this.root_url+'api/profil', true);
    request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
    request.send();

    request.addEventListener("load", function() {
      var response = JSON.parse(request.responseText);
      console.log("Response "+response);

      if(response.prijavljen){
        ref.prijavljen=true;
        ref.uporabnik=response.uporabnik;
      }else{
        ref.prijavljen=false;
        ref.uporabnik=null;
      }
      ref.prijavaPreverjena=true;
    });
    request.addEventListener("error", function() {
        console.log("NAPAKA!");
    });
  },
  dodajVKosarico: function(){
    var ref=this;
    var request = new XMLHttpRequest();
    var data = {
      id_izdelka: this.artikel.id,
      kolicina:1,
    };

    data=JSON_to_URLEncoded(data);

    request.open('POST', this.root_url+'api/kosarica', true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    request.send(data);

    request.addEventListener("load", function() {
      //var response = JSON.parse(request.responseText);
      ref.prikazObvestila();
    });
    request.addEventListener("error", function() {
        console.log("NAPAKA!");
    });

  },
  prikazObvestila: function(){
    var ref=this;
    ref.napis="V KOŠARICI"
    setTimeout(function(){ ref.napis="V KOŠARICO" }, 1300);

  }
}

});


Vue.component('stranka-forma-podatki', {
  props:["root_url"],
  data: function(){
    return {
      uporabnik:{
        ime:"",
        priimek:"",
        email:"",
        naslov:"",
        telefon:"",
        posta:"",
        geslo1:"",
        geslo2:"",
      },
      tabelaPosta:[],
      posodobljeniPodatki:false,
      pritisnjenGumb:false
    }

  },
  template:`
<div>
  <div class="panel panel-default" style="">
    <div class="panel-heading">
      <h3>OSEBNI PODATKI</h3>
    </div>
    <div class="panel-body">
      <div class="">

         <div class="form-group">
           <label for="ime">IME</label>
           <input type="text" class="form-control" placeholder="" name="pwd" value="" v-model="uporabnik.ime">
         </div>
         <div class="form-group">
           <label for="priimek">PRIIMEK</label>
           <input type="text" class="form-control"  placeholder="" name="pwd" v-model="uporabnik.priimek">
         </div>
         <div class="form-group">
           <label for="email">NASLOV</label>
           <input type="text" class="form-control" placeholder="" name="pwd" v-model="uporabnik.naslov">
         </div>
         <div class="form-group" >
           <label for="sel1">POŠTA:</label>
           <select class="form-control"  v-model="uporabnik.posta" >
             <option v-for="posta in tabelaPosta" :value="posta.postna_st">{{posta.postna_st+' '+posta.naziv}}</option>
           </select>
          </div>
         <div class="form-group">
           <label for="email">ELEKTRONSKI NASLOV</label>
           <input type="email" class="form-control"  placeholder="" name="pwd" v-model="uporabnik.email" >
         </div>

         <div class="form-group">
           <label for="email">TELEFONSKA ŠTEVILKA</label>
           <input type="text" class="form-control"  placeholder="" name="pwd" v-model="uporabnik.telefon">
         </div>

         <div class="form-group">
           <label for="pwd">NOVO GESLO</label>
           <input type="password" class="form-control"  placeholder="Vpiši novo geslo" name="pwd" v-model="uporabnik.geslo1">
         </div>
         <div class="form-group">
           <label for="pwd1">POTRDI NOVO GESLO</label>
           <input type="password" class="form-control"  placeholder="Potrdi novo geslo" name="pwd" v-model="uporabnik.geslo2">
         </div>

         <button  class="btn btn-success" style="display:inline-block" v-on:click="posodobiPodatkeStranke()" >Shrani spremembe</button>
         <span class="label label-success"  style="display:inline-block; float:right; padding:6px;" v-if="posodobljeniPodatki" >Podatki uspešno posodobljeni!</span>
         <span class="label label-warning"  style="display:inline-block; float:right; padding:6px;" v-if="!posodobljeniPodatki && pritisnjenGumb" >Preverite pravilnost podatkov!</span>

      </div>
      <div class="clearfix"> </div>
    </div>
  </div>
</div>
  `,
  mounted: function(){
    this.getData();
    this.pridobiTrenutnePodatkeStranke();
  },
  methods:{
    getData: function(){
      var request = new XMLHttpRequest();
      var ref=this;

      //console.log(data);
      request.open('GET',this.root_url+'api/poste' ,true);
      request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
      request.send();

      request.addEventListener("load", function() {
        var response = JSON.parse(request.responseText);
        ref.tabelaPosta=response
      });
      request.addEventListener("error", function() {
          console.log("NAPAKA!");
      });
    },
    posodobiPodatkeStranke: function(){
      var request = new XMLHttpRequest();
      this.pritisnjenGumb=true;
      var ref=this;
      var uporabnik=this.uporabnik;
      var data=JSON_to_URLEncoded(uporabnik);

      request.open('PUT', this.root_url+'api/profil', true);
      request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
      request.send(data);

      request.addEventListener("load", function() {
        var response = JSON.parse(request.responseText);
        if(request.status>=200 && request.status<300){
          ref.posodobljeniPodatki=true;
        }else{
          ref.posodobljeniPodatki=false;
        }
      });
      request.addEventListener("error", function() {
          console.log("NAPAKA!");
      });
    },
    pridobiTrenutnePodatkeStranke: function(){
      var request = new XMLHttpRequest();
      var ref=this;
      request.open('GET', this.root_url+'api/profil', true);
      request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
      request.send();

      request.addEventListener("load", function() {
        var response = JSON.parse(request.responseText);
        console.log("Response "+response);
        var uporabnik=null;

        var uporabnik = {
          ime:response.uporabnik.ime,
          priimek:response.uporabnik.priimek,
          email:response.uporabnik.email,
          naslov:response.uporabnik.naslov,
          telefon:response.uporabnik.telefon,
          posta:response.uporabnik.posta,
          geslo1:"",
          geslo2:"",
        };

        ref.uporabnik=uporabnik;
      });
      request.addEventListener("error", function() {
          console.log("NAPAKA!");
      });
    }



  }

});

Vue.component('stranka-forma-podatki-prodajalec', {
  props:["root_url","stranka_id"],
  data: function(){
    return {
      uporabnik:{
        ime:"",
        priimek:"",
        email:"",
        naslov:"",
        telefon:"",
        posta:"",
        geslo1:"",
        geslo2:"",
      },
      tabelaPosta:[],
      posodobljeniPodatki:false,
      pritisnjenGumb:false
    }

  },
  template:`
<div>
  <div class="panel panel-default" style="">
    <div class="panel-heading">
      <h3>OSEBNI PODATKI</h3>
    </div>
    <div class="panel-body">
      <div class="">

         <div class="form-group">
           <label for="ime">IME</label>
           <input type="text" class="form-control" placeholder="" name="pwd" value="" v-model="uporabnik.ime">
         </div>
         <div class="form-group">
           <label for="priimek">PRIIMEK</label>
           <input type="text" class="form-control"  placeholder="" name="pwd" v-model="uporabnik.priimek">
         </div>
         <div class="form-group">
           <label for="email">NASLOV</label>
           <input type="text" class="form-control"  placeholder="" name="pwd" v-model="uporabnik.naslov">
         </div>
         <div class="form-group" >
           <label for="sel1">POŠTA:</label>
           <select class="form-control"  v-model="uporabnik.posta" >
             <option v-for="posta in tabelaPosta" :value="posta.postna_st">{{posta.postna_st+' '+posta.naziv}}</option>
           </select>
          </div>
         <div class="form-group">
           <label for="email">ELEKTRONSKI NASLOV</label>
           <input type="email" class="form-control"  placeholder="" name="pwd" v-model="uporabnik.email" >
         </div>

         <div class="form-group">
           <label for="email">TELEFONSKA ŠTEVILKA</label>
           <input type="text" class="form-control"  placeholder="" name="pwd" v-model="uporabnik.telefon">
         </div>

         <div class="form-group">
           <label for="pwd">NOVO GESLO</label>
           <input type="password" class="form-control"  placeholder="Vpiši novo geslo" name="pwd" v-model="uporabnik.geslo1">
         </div>
         <div class="form-group">
           <label for="pwd1">POTRDI NOVO GESLO</label>
           <input type="password" class="form-control"  placeholder="Potrdi novo geslo" name="pwd" v-model="uporabnik.geslo2">
         </div>

         <button  class="btn btn-success" style="display:inline-block" v-on:click="posodobiPodatkeStranke()" >Shrani spremembe</button>
         <span class="label label-success"  style="display:inline-block; float:right; padding:6px;" v-if="posodobljeniPodatki" >Podatki uspešno posodobljeni!</span>
         <span class="label label-warning"  style="display:inline-block; float:right; padding:6px;" v-if="!posodobljeniPodatki && pritisnjenGumb" >Preverite pravilnost podatkov!</span>

      </div>
      <div class="clearfix"> </div>
    </div>
  </div>
</div>
  `,
  mounted: function(){
    this.getData();
    this.pridobiTrenutnePodatkeStranke();
  },
  methods:{
    getData: function(){
      var request = new XMLHttpRequest();
      var ref=this;

      //console.log(data);
      request.open('GET',this.root_url+'api/poste' ,true);
      request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
      request.send();

      request.addEventListener("load", function() {
        var response = JSON.parse(request.responseText);
        ref.tabelaPosta=response
      });
      request.addEventListener("error", function() {
          console.log("NAPAKA!");
      });
    },
    posodobiPodatkeStranke: function(){
      //this.pridobiTrenutnePodatkeStranke();
      var request = new XMLHttpRequest();
      this.pritisnjenGumb=true;
      var ref=this;
      var uporabnik=this.uporabnik;
      var data=JSON_to_URLEncoded(uporabnik);

      request.open('PUT', this.root_url+'api/stranke/'+this.stranka_id, true);
      request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
      request.send(data);

      request.addEventListener("load", function() {
        var response = JSON.parse(request.responseText);
        if(request.status>=200 && request.status<300){
          ref.posodobljeniPodatki=true;
          window.location.href = ref.root_url+"prodaja/stranke";
        }else{
          ref.posodobljeniPodatki=false;
        }

      });
      request.addEventListener("error", function() {
          console.log("NAPAKA!");
      });
    },
    pridobiTrenutnePodatkeStranke: function(){
      var request = new XMLHttpRequest();
      var ref=this;
      request.open('GET', this.root_url+'api/stranke/'+this.stranka_id , true);
      request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
      request.send();

      request.addEventListener("load", function() {
        var response = JSON.parse(request.responseText);
        console.log("Response "+response);

        var uporabnik = {
          ime:response.ime,
          priimek:response.priimek,
          email:response.email,
          naslov:response.naslov,
          telefon:response.telefon,
          posta:response.posta,
          geslo1:"",
          geslo2:"",
        };

        ref.uporabnik=uporabnik;
      });
      request.addEventListener("error", function() {
          console.log("NAPAKA!");
      });
    }



  }

});

Vue.component('prodajalec-forma-podatki-admin', {
  props:["root_url","stranka_id"],
  data: function(){
    return {
      uporabnik:{
        ime:"",
        priimek:"",
        email:"",
        geslo1:"",
        geslo2:"",
      },
      tabelaPosta:[],
      posodobljeniPodatki:false,
      pritisnjenGumb:false
    }

  },
  template:`
<div>
  <div class="panel panel-default" style="">
    <div class="panel-heading">
      <h3>OSEBNI PODATKI</h3>
    </div>
    <div class="panel-body">
      <div class="">

         <div class="form-group">
           <label for="ime">IME</label>
           <input type="text" class="form-control" placeholder="" name="pwd" value="" v-model="uporabnik.ime">
         </div>
         <div class="form-group">
           <label for="priimek">PRIIMEK</label>
           <input type="text" class="form-control"  placeholder="" name="pwd" v-model="uporabnik.priimek">
         </div>
         <div class="form-group">
           <label for="email">ELEKTRONSKI NASLOV</label>
           <input type="email" class="form-control"  placeholder="" name="pwd" v-model="uporabnik.email" >
         </div>
         <div class="form-group">
           <label for="pwd">NOVO GESLO</label>
           <input type="password" class="form-control"  placeholder="Vpiši novo geslo" name="pwd" v-model="uporabnik.geslo1">
         </div>
         <div class="form-group">
           <label for="pwd1">POTRDI NOVO GESLO</label>
           <input type="password" class="form-control"  placeholder="Potrdi novo geslo" name="pwd" v-model="uporabnik.geslo2">
         </div>

         <button  class="btn btn-success" style="display:inline-block" v-on:click="posodobiPodatkeStranke()" >Shrani spremembe</button>
         <span class="label label-success"  style="display:inline-block; float:right; padding:6px;" v-if="posodobljeniPodatki" >Podatki uspešno posodobljeni!</span>
         <span class="label label-warning"  style="display:inline-block; float:right; padding:6px;" v-if="!posodobljeniPodatki && pritisnjenGumb" >Preverite pravilnost podatkov!</span>

      </div>
      <div class="clearfix"> </div>
    </div>
  </div>
</div>
  `,
  mounted: function(){
    this.pridobiTrenutnePodatkeStranke();
  },
  methods:{

    posodobiPodatkeStranke: function(){
      //this.pridobiTrenutnePodatkeStranke();
      var request = new XMLHttpRequest();
      this.pritisnjenGumb=true;
      var ref=this;
      var uporabnik=this.uporabnik;
      var data=JSON_to_URLEncoded(uporabnik);

      request.open('PUT', this.root_url+'api/prodajalci/'+this.stranka_id, true);
      request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
      request.send(data);

      request.addEventListener("load", function() {
        var response = JSON.parse(request.responseText);
        if(request.status>=200 && request.status<300){
          ref.posodobljeniPodatki=true;
          window.location.href = ref.root_url+"admin";
        }else{
          ref.posodobljeniPodatki=false;
        }

      });
      request.addEventListener("error", function() {
          console.log("NAPAKA!");
      });
    },
    pridobiTrenutnePodatkeStranke: function(){
      var request = new XMLHttpRequest();
      var ref=this;
      request.open('GET', this.root_url+'api/prodajalci/'+this.stranka_id , true);
      request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
      request.send();

      request.addEventListener("load", function() {
        var response = JSON.parse(request.responseText);
        console.log("Response "+response);

        var uporabnik = {
          ime:response.ime,
          priimek:response.priimek,
          email:response.email,
          geslo1:"",
          geslo2:"",
        };

        ref.uporabnik=uporabnik;
      });
      request.addEventListener("error", function() {
          console.log("NAPAKA!");
      });
    }



  }

});

Vue.component('prodajalec-forma-podatki', {
  props:["root_url"],
  data: function(){
    return {
      uporabnik:{
        ime:"",
        priimek:"",
        email:"",
        geslo1:"",
        geslo2:"",
      },
      posodobljeniPodatki:false,
      pritisnjenGumb:false
    }

  },
  template:`
<div>
  <div class="panel panel-default" style="">
    <div class="panel-heading">
      <h3>OSEBNI PODATKI</h3>
    </div>
    <div class="panel-body">
      <div class="">

         <div class="form-group">
           <label for="ime">IME</label>
           <input type="text" class="form-control" id="ime" placeholder="" name="pwd" value="uporabnik.ime" v-model="uporabnik.ime">
         </div>
         <div class="form-group">
           <label for="priimek">PRIIMEK</label>
           <input type="text" class="form-control" id="priimek" placeholder="" name="pwd" :value="uporabnik.priimek" v-model="uporabnik.priimek">
         </div>
         <div class="form-group">
           <label for="email">ELEKTRONSKI NASLOV</label>
           <input type="email" class="form-control" id="email" placeholder="" name="pwd"  :value="uporabnik.email" v-model="uporabnik.email" >
         </div>
         <div class="form-group">
           <label for="pwd">NOVO GESLO</label>
           <input type="password" class="form-control" id="pwd" placeholder="Vpiši novo geslo" name="pwd" v-model="uporabnik.geslo1">
         </div>
         <div class="form-group">
           <label for="pwd1">POTRDI NOVO GESLO</label>
           <input type="password" class="form-control" id="pwd1" placeholder="Potrdi novo geslo" name="pwd" v-model="uporabnik.geslo2">
         </div>

         <button  class="btn btn-success" style="display:inline-block" v-on:click="posodobiPodatkeStranke()" >Shrani spremembe</button>
         <span class="label label-success"  style="display:inline-block; float:right; padding:6px;" v-if="posodobljeniPodatki" >Podatki uspešno posodobljeni!</span>
         <span class="label label-warning"  style="display:inline-block; float:right; padding:6px;" v-if="!posodobljeniPodatki && pritisnjenGumb" >Preverite pravilnost podatkov!</span>

      </div>
      <div class="clearfix"> </div>
    </div>
  </div>
</div>
  `,
  mounted: function(){
    this.pridobiTrenutnePodatkeStranke();
  },
  methods:{

    posodobiPodatkeStranke: function(){
      var request = new XMLHttpRequest();
      this.pritisnjenGumb=true;
      var ref=this;
      var uporabnik=this.uporabnik;
      var data=JSON_to_URLEncoded(uporabnik);
      console.log("data"+data)
      request.open('PUT', this.root_url+'api/profil', true);
      request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
      request.send(data);

      request.addEventListener("load", function() {
        var response = JSON.parse(request.responseText);
        if(request.status>=200 && request.status<300){
          ref.posodobljeniPodatki=true;
        }else{
          ref.posodobljeniPodatki=false;
        }
      });
      request.addEventListener("error", function() {
          console.log("NAPAKA!");
      });
    },

    pridobiTrenutnePodatkeStranke: function(){
      var request = new XMLHttpRequest();
      var ref=this;
      request.open('GET', this.root_url+'api/profil', true);
      request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
      request.send();

      request.addEventListener("load", function() {
        var response = JSON.parse(request.responseText);
        console.log("Response "+response);
        var uporabnik=null;

        var uporabnik = {
          ime:response.uporabnik.ime,
          priimek:response.uporabnik.priimek,
          email:response.uporabnik.email,
          geslo1:"",
          geslo2:"",
        };

        ref.uporabnik=uporabnik;
      });
      request.addEventListener("error", function() {
          console.log("NAPAKA!");
      });
    }
  }

});

Vue.component('narocilo', {
  props:['narocilo'],
  template:`
<div >
  <div class="panel panel-default" style="margin-top:25px;">
    <div class="panel-heading">
      <b>PODATKI O NAROČNIKU</b>
    </div>
    <div class="panel-body">
    <p style="padding-top:5px; font-size:17px;" >
      Ime: {{narocilo.narocnik.ime}}<br>
      Priimek: {{narocilo.narocnik.priimek}}<br>
      Naslov: {{narocilo.narocnik.naslov}}<br>
      Tel. številka: {{narocilo.narocnik.tel_stevilka}}
    </p>
    </div>
  </div>

  <table id="cart" class="table table-hover table-condensed">
        <thead>
        <tr>
          <th style="width:50%">Artikel</th>
          <th style="width:10%">Cena</th>
          <th style="width:8%">Količina</th>
          <th style="width:22%" class="text-center">Skupna cena</th>
          <th style="width:10%"></th>
        </tr>
      </thead>
      <tbody>

        <tr v-for="artikel in narocilo.tabelaArtiklov">

            <td data-th="Izdelek">
              <div class="row">
                <div class="col-sm-2 hidden-xs"><a :href="artikel.povezava_artikel"><img :src="artikel.slika_url" alt="..." class="img-responsive" style="margin-top:12px; width:50px;"/></a></div>
                <div class="col-sm-8">
                  <h4 style="padding-top:30px;">{{artikel.ime_artikla}}</h4>
                  <p></p>
                </div>
              </div>
            </td>
            <td data-th="Cena" style="padding-top:30px;">{{artikel.redna_cena}} €</td>
            <td data-th="Količina" style="padding-top:30px;">
              <p class="text-center" >{{artikel.kolicina}}</p>
            </td>
            <td data-th="Skupna cena" class="text-center"  style="padding-top:30px;">{{artikel.skupna_cena}} €</td>
            <td class="actions" data-th="">
            </td>

        </tr>

      </tbody>
      <tfoot >
        <tr class="visible-xs">
          <td class="text-center"><strong>Za plačilo {{narocilo.cena_narocila}} €</strong></td>
        </tr>
        <tr style="">

          <td colspan="2" class="hidden-xs"></td>

          <td></td>

          <td class="hidden-xs text-center" style="font-size:20px;"><strong>Za plačilo: {{narocilo.cena_narocila}} €</strong></td>
          <td class="hidden-xs></td>
          <td class="hidden-xs></td>
        </tr>
      </tfoot>
    </table>
  </div>
  `,
  data:function(){
    return{
            /*narocilo:{id_narocila:1,
                      narocnik:{
                        ime:"Jože1",
                        priimek:"Gorišek",
                        naslov:"Ljubljana 232",
                        tel_stevilka:"041232141",
                      },
                      datum_narocila:"12.3.2017 13:33",
                      status_narocila:"POTRJENO",
                      cena_narocila:300,
                      tabelaArtiklov:[
                        {kolicina:1, povezava_artikel:"single.html", slika_url:"images/ba.jpg", ime_artikla:"Usnjena torba", redna_cena:"100", znizana_cena:"300"},
                        {kolicina:1, povezava_artikel:"single.html", slika_url:"images/bag.jpg", ime_artikla:"Usnjena torba1", redna_cena:"100", znizana_cena:"200"},
                        {kolicina:1, povezava_artikel:"single.html", slika_url:"images/bag1.jpg", ime_artikla:"Usnjena torba2", redna_cena:"100", znizana_cena:"100"},
                      ]
                    }*/
      }
    }

});

Vue.component('narocilo-ogled', {
  props:['narociloId'],
  template:`
<div >
  <div class="panel panel-default" style="margin-top:25px;">
    <div class="panel-heading">
      <b>PODATKI O NAROČNIKU</b>
    </div>
    <div class="panel-body">
    <p style="padding-top:5px; font-size:17px;" >
      Ime: {{narocilo.narocnik.ime}}<br>
      Priimek: {{narocilo.narocnik.priimek}}<br>
      Naslov: {{narocilo.narocnik.naslov}}<br>
      Tel. številka: {{narocilo.narocnik.tel_stevilka}}
    </p>
    </div>
  </div>

  <table id="cart" class="table table-hover table-condensed">
        <thead>
        <tr>
          <th style="width:50%">Artikel</th>
          <th style="width:10%">Cena</th>
          <th style="width:8%">Količina</th>
          <th style="width:22%" class="text-center">Skupna cena</th>
          <th style="width:10%"></th>
        </tr>
      </thead>
      <tbody>

        <tr v-for="artikel in narocilo.tabelaArtiklov">

            <td data-th="Izdelek">
              <div class="row">
                <div class="col-sm-2 hidden-xs"><a :href="artikel.povezava_artikel"><img :src="artikel.slika_url" alt="..." class="img-responsive" style="margin-top:12px; width:50px;"/></a></div>
                <div class="col-sm-8">
                  <h4 style="padding-top:30px;">{{artikel.ime_artikla}}</h4>
                  <p></p>
                </div>
              </div>
            </td>
            <td data-th="Cena" style="padding-top:30px;">{{artikel.redna_cena}} €</td>
            <td data-th="Količina" style="padding-top:30px;">
              <p class="text-center" >{{artikel.kolicina}}</p>
            </td>
            <td data-th="Skupna cena" class="text-center"  style="padding-top:30px;">{{artikel.skupna_cena}} €</td>
            <td class="actions" data-th="">
            </td>

        </tr>

      </tbody>
      <tfoot >
        <tr class="visible-xs">
          <td class="text-center"><strong>Za plačilo {{narocilo.cena_narocila}} €</strong></td>
        </tr>
        <tr style="">

          <td colspan="2" class="hidden-xs"></td>

          <td></td>

          <td class="hidden-xs text-center" style="font-size:20px;"><strong>Za plačilo: {{narocilo.cena_narocila}} €</strong></td>
          <td class="hidden-xs></td>
          <td class="hidden-xs></td>
        </tr>
      </tfoot>
    </table>
  </div>
  `,
  mounted: function(){
    //this.getDataArtikli();
  },
  data:function(){
    return{
      narocilo:{},
            /*narocilo:{id_narocila:1,
                      narocnik:{
                        ime:"Jože1",
                        priimek:"Gorišek",
                        naslov:"Ljubljana 232",
                        tel_stevilka:"041232141",
                      },
                      cena_narocila:300,
                      tabelaArtiklov:[
                        {kolicina:1, povezava_artikel:"single.html", slika_url:"images/ba.jpg", ime_artikla:"Usnjena torba", redna_cena:"100", znizana_cena:"300"},
                        {kolicina:1, povezava_artikel:"single.html", slika_url:"images/bag.jpg", ime_artikla:"Usnjena torba1", redna_cena:"100", znizana_cena:"200"},
                        {kolicina:1, povezava_artikel:"single.html", slika_url:"images/bag1.jpg", ime_artikla:"Usnjena torba2", redna_cena:"100", znizana_cena:"100"},
                      ]
                    }*/
      }
    },

    methods:{
      getDataNarocnik: function(){

      },
      getDataArtikli: function(){
        var request = new XMLHttpRequest();
        var ref=this;
        request.open('GET', this.root_url+'api/narocila/'+this.narociloId+"/podrobnosti", true);
        request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
        request.send();

        request.addEventListener("load", function() {
          var response = JSON.parse(request.responseText);
          ref.narocilo={};
          ref.narocilo.cena_narocila=response.vrednost;

          var tabelaArtiklov=response.izdelki;

          for(var i=0; i<tabelaArtiklov.length; i++){
            var artikel={
              id_izdelek:tabelaNarocil[i].id,
              ime_artikla:tabelaNarocil[i].ime,
              redna_cena:tabelaNarocil[i].cena,
              kolicina:tabelaNarocil[i].kolicina,
              skupna_cena:tabelaNarocil[i].skupaj_izdelek
            }
            ref.narocilo.tabelaArtiklov.push(artikel);
          }

        });
        request.addEventListener("error", function() {
            console.log("NAPAKA!");
        });
    }
  }

});
