Vue.component('glava', {
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
            <div class="search" style="margin-top:26px;">
               <input type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" >
               <input type="submit"  value="ISKANJE">
            </div>
            <div class="clearfix"> </div>
         </div>
         <div class="header-bottom-right">
            <!--<div class="account" style="dislay:none"><a href="login.html"><span> </span>Pozdravljeni Enej</a></div>-->

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
                 <li ><a href="customerManageAccount.html"><span >Upravljaj račun</span> </a></li>
                 <li ><a href="/odjava">Odjava</a></li>
               </ul>
              </div>

              <div style="display:inline-block; float:right; margin-left:10px;">
                 <ul class="login" >
                    <li>
                      <div>
                        <a href="login.html">
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
    <artikel-posebna-ponudba slot="artikel-posebna-ponudba" ></artikel-posebna-ponudba>
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
