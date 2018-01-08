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
            <div class="search">
               <input type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" >
               <input type="submit"  value="ISKANJE">
            </div>
            <div class="clearfix"> </div>
         </div>
         <div class="header-bottom-right">
            <div class="account" style="dislay:none"><a href="login.html"><span> </span>VAŠ RAČUN</a></div>

            <ul class="login">
               <li><a href="login.html"><span> </span>PRIJAVA</a></li>
               |
               <li><a href="register.html">REGISTRACIJA</a></li>
            </ul>
            <div class="cart"><a href="#"><span> </span>KOŠARICA</a></div>

            <div class="clearfix"> </div>
         </div>
         <div class="clearfix"> </div>
      </div>
   </div>
</div>`
});

Vue.component('noga', {
  template:`
  <div class="footer">
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
            <p>SLEDITE NAM</p>
            <ul class="face-in-to">
               <li><a href="#"><span> </span></a></li>
               <li><a href="#"><span class="facebook-in"> </span></a></li>
               <div class="clearfix"> </div>
            </ul>
            <div class="clearfix"> </div>
         </div>
         <div class="clearfix"> </div>
      </div>
   </div>
   <div class="header">
      <div class="top-header">
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
     <span class="star"> </span>
     <div class="grid-chain-bottom">
        <h6><a href="single.html">{{ime_artikla}}</a></h6>
        <div class="star-price">
           <div class="dolor-grid">
              <span class="actual">{{znizana_cena}}$</span>
              <span class="reducedfrom">{{redna_cena}}</span>
              <span class="rating">
              <input type="radio" class="rating-input" id="rating-input-1-5" name="rating-input-1">
              <label for="rating-input-1-5" class="rating-star1"> </label>
              <input type="radio" class="rating-input" id="rating-input-1-4" name="rating-input-1">
              <label for="rating-input-1-4" class="rating-star1"> </label>
              <input type="radio" class="rating-input" id="rating-input-1-3" name="rating-input-1">
              <label for="rating-input-1-3" class="rating-star"> </label>
              <input type="radio" class="rating-input" id="rating-input-1-2" name="rating-input-1">
              <label for="rating-input-1-2" class="rating-star"> </label>
              <input type="radio" class="rating-input" id="rating-input-1-1" name="rating-input-1">
              <label for="rating-input-1-1" class="rating-star"> </label>
              </span>
           </div>
           <a class="now-get get-cart" href="#">ADD TO CART</a>
           <div class="clearfix"> </div>
        </div>
     </div>
  </div>

  <div v-else class="col-md-4 chain-grid grid-top-chain">
     <a href="single.html"><img class="img-responsive chain" :src="slika_url" alt=" " /></a>
     <span class="star"> </span>
     <div class="grid-chain-bottom">
        <h6><a href="single.html">{{ime_artikla}}</a></h6>
        <div class="star-price">
           <div class="dolor-grid">
              <span class="actual">{{znizana_cena}}$</span>
              <span class="reducedfrom">{{redna_cena}}</span>
              <span class="rating">
              <input type="radio" class="rating-input" id="rating-input-1-5" name="rating-input-1">
              <label for="rating-input-1-5" class="rating-star1"> </label>
              <input type="radio" class="rating-input" id="rating-input-1-4" name="rating-input-1">
              <label for="rating-input-1-4" class="rating-star1"> </label>
              <input type="radio" class="rating-input" id="rating-input-1-3" name="rating-input-1">
              <label for="rating-input-1-3" class="rating-star"> </label>
              <input type="radio" class="rating-input" id="rating-input-1-2" name="rating-input-1">
              <label for="rating-input-1-2" class="rating-star"> </label>
              <input type="radio" class="rating-input" id="rating-input-1-1" name="rating-input-1">
              <label for="rating-input-1-1" class="rating-star"> </label>
              </span>
           </div>
           <a class="now-get get-cart" href="#">ADD TO CART</a>
           <div class="clearfix"> </div>
        </div>
     </div>
  </div>
  `
});

Vue.component('artikel-posebna-ponudba', {
  props:['slika_url','ime_artikla','redna_cena','znizana_cena'],
  template:`
  <div class=" chain-grid menu-chain">
    <a href="single.html"><img class="img-responsive chain" :src="slika_url" alt=" " /></a>
    <div class="grid-chain-bottom chain-watch">
       <span class="actual dolor-left-grid">{{znizana_cena}}€</span>
       <span class="reducedfrom">{{redna_cena}}€</span>
       <h6><a href="single.html">{{ime_artikla}}</a></h6>
    </div>
  </div>`
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
