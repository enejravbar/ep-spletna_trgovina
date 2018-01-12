

Vue.component('glava', {
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
            <div class="search" style="margin-top:26px;">
               <input type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" >
               <input type="submit"  value="ISKANJE">
            </div>
            <div class="clearfix"> </div>
         </div>
         <div class="header-bottom-right">

            <div style="display:block;">

              <div class="cart" style="display:inline-block;float:right; margin-left:10px;">
                <a href="cart.html">
                  <button class="btn btn-default" type="button" ><span> </span>KOŠARICA
                  </button>
                </a>
              </div>

              <div class="dropdown" style="display:inline-block; float:right; margin-left:10px; ">
               <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" style=" padding: 9px 9px 9px 9px ">Pozdravljeni Enej

               <span class="caret"></span></button>
               <ul class="dropdown-menu">
                <li ><a href="customerOrders.html"><span >Pregled naročil</span> </a></li>
                 <li ><a :href="root_url+'profil'"><span >Upravljaj račun</span> </a></li>
                 <li ><a :href="root_url+'odjava'">Odjava</a></li>
               </ul>
              </div>

              <div style="display:inline-block; float:right; margin-left:10px;">
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
</div>`
});

Vue.component('glava-prodajalec', {
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
               <a href="index.html"><img src="images/logo.png" alt=" " /></a>
            </div>

            <div class="clearfix"> </div>
         </div>
         <div class="header-bottom-right">

            <div style="display:block;">

              <div class="dropdown" style="display:inline-block; float:right; margin-left:10px; ">
               <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" style=" padding: 9px 9px 9px 9px ">Pozdravljen/a Enej

               <span class="caret"></span></button>
               <ul class="dropdown-menu">
                 <li ><a href="sellerOrders.html"><span >Pregled naročil</span> </a></li>
                 <li ><a href="sellerManageCustomers.html"><span >Upravljanje strank</span> </a></li>
                 <li ><a href="sellerManageProducts.html"><span >Upravljanje artiklov</span> </a></li>
                 <li ><a href="sellerManageAccount.html"><span >Upravljaj račun</span> </a></li>
                 <li ><a href="/odjava">Odjava</a></li>
               </ul>
              </div>

            </div>
            <div class="clearfix"> </div>
         </div>
         <div class="clearfix"> </div>
      </div>
   </div>
</div>`
});

Vue.component('glava-login', {
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
               <a href="index.html"><img src="images/logo.png" alt=" " /></a>
            </div>

            <div class="clearfix"> </div>
         </div>
         <div class="header-bottom-right">

            <div style="display:block;">

              <div class="dropdown" style="display:inline-block; float:right; margin-left:10px; ">
               <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" style=" padding: 9px 9px 9px 9px ">Pozdravljen/a Enej

               <span class="caret"></span></button>
               <ul class="dropdown-menu">
                 <li ><a href="sellerOrders.html"><span >Pregled naročil</span> </a></li>
                 <li ><a href="sellerManageCustomers.html"><span >Upravljanje strank</span> </a></li>
                 <li ><a href="sellerManageProducts.html"><span >Upravljanje artiklov</span> </a></li>
                 <li ><a href="sellerManageAccount.html"><span >Upravljaj račun</span> </a></li>
                 <li ><a href="/odjava">Odjava</a></li>
               </ul>
              </div>

            </div>
            <div class="clearfix"> </div>
         </div>
         <div class="clearfix"> </div>
      </div>
   </div>
</div>`
});

Vue.component('noga', {
  template:`
  <div class="footer" style="position:fixed; width:100%; bottom:0px;;">
   <div class="footer-top">
      <div class="container">
         <div class="latter">
            <h6>NEWS-LETTER</h6>
            <div class="sub-left-right">
               <form>
                  <input type="text" value="Vaš elektronski naslov" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Vaš elektronski naslov';}" />
                  <input type="submit" value="NAROČI SE" />
               </form>
            </div>
            <div class="clearfix"> </div>
         </div>
         <div class="latter-right">

         </div>
         <div class="clearfix"> </div>
      </div>
   </div>
   <div class="header">
      <div class="top-header" >
         <div class="container" style="height:15px;">
         </div>
      </div>
   </div>
</div>`
});

Vue.component('slide', {
  props:['slika'],
  template:`
  <article style="position: absolute; width: 100%; opacity: 0;">
     <div class="banner-matter">
        <div class="col-md-5 banner-bag">
           <img class="img-responsive " :src="slika" alt=" " />
        </div>
        <div class="col-md-7 banner-off">
          <h2>FLAT 50% 0FF</h2>
          <label>FOR ALL PURCHASE <b>VALUE</b></label>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et </p>
          <span class="on-get">KUPI SEDAJ</span>
        </div>
        <div class="clearfix"> </div>
     </div>
  </article>`
});

Vue.component('artikel-domaca-stran', {
  props:['slika_url','ime_artikla','redna_cena','znizana_cena','st_slike'],
  template:`
  <div v-if="st_slike<=1" class="col-md-4 chain-grid ">
     <a href="single.html"><img class="img-responsive chain" :src="slika_url" alt=" " /></a>
     <div class="grid-chain-bottom">
        <h6><a href="single.html">{{ime_artikla}}</a></h6>
        <div class="star-price">
           <div class="dolor-grid">
              <span >CENA:</span>
              <span class="actual">{{znizana_cena}}€</span>
              <span class="rating">

              </span>
           </div>
           <a class="now-get get-cart" href="#">V KOŠARICO</a>
           <div class="clearfix"> </div>
        </div>
     </div>
  </div>

  <div v-else class="col-md-4 chain-grid grid-top-chain">
     <a href="single.html"><img class="img-responsive chain" :src="slika_url" alt=" " /></a>
     <div class="grid-chain-bottom">
        <h6><a href="single.html">{{ime_artikla}}</a></h6>
        <div class="star-price">
           <div class="dolor-grid">
              <span >CENA:</span>
              <span class="actual">{{znizana_cena}}€</span>
              <span class="rating">

              </span>
           </div>
           <a class="now-get get-cart" href="#">V KOŠARICO</a>
           <div class="clearfix"> </div>
        </div>
     </div>
  </div>
  `
});

Vue.component('artikel-posebna-ponudba', {

  template:`
  <div class=" chain-grid menu-chain">
    <a href="single.html"><img class="img-responsive chain" :src="slika_url" alt=" " /></a>
    <div class="grid-chain-bottom chain-watch" >
      <h6 style="display:block;""><a href="single.html">{{ime_artikla}}</a></h6>
      <div style="display:block; margin-top:5px; padding-bottom:20px;">

         <span style="float:right; "class="actual " ><span> CENA: </span>{{redna_cena}}€</span>
      </div>
    </div>
  </div>`,
  data: function(){
    return {
      slika_url:"images/ba.jpg",
      ime_artikla:"Usnjena torba",
      redna_cena:"410",
      znizana_cena:"310"
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
  props:[],
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
        {ime:"Računalništvo", url:"product.html"},
        {ime:"Bela Tehnika", url:"product.html"},
        {ime:"Vrtnarstvo", url:"product.html"},
        {ime:"Obleke", url:"product.html"}
      ]
    }
  },
  computed:{
  }

});

Vue.component('artikel-product-stran', {
  props:['povezava_artikel','slika_url','ime_artikla','redna_cena','znizana_cena'],
  template:`
  <div class="product-grid">
   <div class="content_box">
      <a :href="povezava_artikel">
         <div class="left-grid-view grid-view-left">
            <img :src="slika_url" class="img-responsive watch-right" alt=""/>
         </div>
      </a>
      <a :href="povezava_artikel"><h4>{{ime_artikla}}</h4></a>
      <p>It is a long established fact that a reader</p>
      <div class="star-price">
         <div class="dolor-grid">
            <span >CENA:</span>
            <span class="actual">{{redna_cena}}€</span>
            <span class="rating">

            </span>
         </div>
         <a class="now-get get-cart" href="#">V KOŠARICO</a>
         <div class="clearfix"> </div>
      </div>
   </div>
</div>`
});

Vue.component('artikel-slika-single-stran', {
  props:['slika_url'],
  template:`
  <li>
      <img class="etalage_thumb_image " :src="slika_url"  />
      <img class="etalage_source_image " :src="slika_url" title="" />
  </li>
  `
});

Vue.component('stranka-forma-podatki', {
  props:['stranka'],
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
           <input type="text" class="form-control" id="ime" placeholder="" name="pwd" :value="stranka.ime">
         </div>
         <div class="form-group">
           <label for="priimek">PRIIMEK</label>
           <input type="text" class="form-control" id="priimek" placeholder="" name="pwd" :value="stranka.priimek">
         </div>
         <div class="form-group">
           <label for="email">ELEKTRONSKI NASLOV</label>
           <input type="text" class="form-control" id="email" placeholder="" name="pwd" :value="stranka.email_naslov">
         </div>
         <div class="form-group">
           <label for="email">NASLOV</label>
           <input type="text" class="form-control" id="naslov" placeholder="" name="pwd" :value="stranka.naslov">
         </div>
         <div class="form-group">
           <label for="email">TELEFONSKA ŠTEVILKA</label>
           <input type="text" class="form-control" id="tel_stevilka" placeholder="" name="pwd" :value="stranka.tel_stevilka">
         </div>
         <button  class="btn btn-success" style="display:inline-block">Shrani spremembe</button>
         <span class="label label-success"  style="display:inline-block; float:right; padding:6px;">Podatki uspešno posodobljeni!</span>
      </div>
      <div class="clearfix"> </div>
    </div>
  </div>

  <div class="panel panel-default" style="margin-top:25px;">
    <div class="panel-heading">
      <h3>PRIJAVNI PODATKI</h3>
    </div>
    <div class="panel-body">
      <div class="">

        <div class="form-group">
          <label for="pwd">NOVO GESLO</label>
          <input type="password" class="form-control" id="pwd" placeholder="Vpiši novo geslo" name="pwd">
        </div>
        <div class="form-group">
          <label for="pwd1">POTRDI NOVO GESLO</label>
          <input type="password" class="form-control" id="pwd1" placeholder="Potrdi novo geslo" name="pwd">
        </div>

        <button  class="btn btn-success" style="display:inline-block">Shrani spremembe</button>
        <span class="label label-success"  style="display:inline-block; float:right; padding:6px;">Podatki uspešno posodobljeni!</span>

      </div>
      <div class="clearfix"> </div>
    </div>
  </div>
</div>
  `
});

Vue.component('prodajalec-forma-podatki', {
  props:['prodajalec'],
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
           <input type="text" class="form-control" id="ime" placeholder="" name="pwd" :value="prodajalec.ime">
         </div>
         <div class="form-group">
           <label for="priimek">PRIIMEK</label>
           <input type="text" class="form-control" id="priimek" placeholder="" name="pwd" :value="prodajalec.priimek">
         </div>
         <div class="form-group">
           <label for="email">ELEKTRONSKI NASLOV</label>
           <input type="text" class="form-control" id="email" placeholder="" name="pwd" :value="prodajalec.email_naslov">
         </div>
         <button  class="btn btn-success" style="display:inline-block">Shrani spremembe</button>
         <span class="label label-success"  style="display:inline-block; float:right; padding:6px;">Podatki uspešno posodobljeni!</span>
      </div>
      <div class="clearfix"> </div>
    </div>
  </div>

  <div class="panel panel-default" style="margin-top:25px;">
    <div class="panel-heading">
      <h3>PRIJAVNI PODATKI</h3>
    </div>
    <div class="panel-body">
      <div class="">

        <div class="form-group">
          <label for="pwd">NOVO GESLO</label>
          <input type="password" class="form-control" id="pwd" placeholder="Vpiši novo geslo" name="pwd">
        </div>
        <div class="form-group">
          <label for="pwd1">POTRDI NOVO GESLO</label>
          <input type="password" class="form-control" id="pwd1" placeholder="Potrdi novo geslo" name="pwd">
        </div>

        <button  class="btn btn-success" style="display:inline-block">Shrani spremembe</button>
        <span class="label label-success"  style="display:inline-block; float:right; padding:6px;">Podatki uspešno posodobljeni!</span>

      </div>
      <div class="clearfix"> </div>
    </div>
  </div>
</div>
  `
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
            <td data-th="Cena">{{artikel.redna_cena}} €</td>
            <td data-th="Količina">
              <p class="text-center"style=" margin-top:24px;">{{artikel.kolicina}}</p>
            </td>
            <td data-th="Skupna cena" class="text-center" >{{artikel.kolicina*artikel.redna_cena}} €</td>
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
    },
  computed:{
      skupnaCenaNarocila:function(){
          var skupnaCenaKosarice=0;
          var artikel=null;
          console.log(this.narocilo)
          for (var i=0; i< this.narocilo.tabelaArtiklov.length; i++) {
            artikel=this.narocilo.tabelaArtiklov[i];
            skupnaCenaKosarice+= parseInt(this.narocilo.kolicina)*parseFloat(artikel.redna_cena);
          }
          return skupnaCenaKosarice;

      }
  }

});
