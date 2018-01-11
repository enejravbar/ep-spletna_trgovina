<!DOCTYPE html>
<html>
   <head>
      <title>Big shope</title>
      <link href="<?= CSS_URL .  "bootstrap.css" ?>" rel="stylesheet" type="text/css" media="all" />
      <link href="<?= CSS_URL .  "style.css" ?>" rel="stylesheet" type="text/css" media="all" />
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

      <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
      <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>

      <script src="<?= JS_URL .  "jquery.min.js"  ?>"></script>
      <script src="<?= JS_URL .  "vue.js"  ?>"></script>
      <script src="<?= JS_URL .  "vue_components.js"  ?>"></script>
      <script src="<?= JS_URL .  "bootstrap.js"  ?>"></script>
      <script src="<?= JS_URL .  "jquery.wmuSlider.js"  ?>"></script>
      <script src="<?= JS_URL .  "index.js"  ?>"></script>

      <style>
        [v-cloak] {
          display: none;
        }
      </style>
   </head>
   <body>
      <div id="app" >
        <input type="hidden" value="<?= BASE_URL ?>" id="baseUrl"/>
         <glava base_url="<?=BASE_URL?>"></glava>
         <div class="container" >
            <navigacijski-menu-wrapper></navigacijski-menu-wrapper>
            <div class="shoes-grid">
               <a href="single.html">
                  <div class="wrap-in">
                     <div class="wmuSlider example1 slide-grid">
                        <div class="wmuSliderWrapper" v-for="artikel in mnoziceArtiklov.slideShow">
                           <slide :slika="artikel.slika_url"></slide>
                        </div>
                     </div>
                  </div>
               </a>
               <div class="products">
                  <h5 class="latest-product">ZADNJI ARTIKLI</h5>
                  <a class="view-all" href="product.html">POGLEJ OSTALE<span> </span></a>
               </div>
               <div class="product-left" v-for="(artikel,i) in mnoziceArtiklov.zadnjiArtikli">
                  <artikel-domaca-stran v-bind:st_slike="i" :slika_url="artikel.slika_url" :ime_artikla="artikel.ime_artikla" :redna_cena="artikel.redna_cena" :znizana_cena="artikel.znizana_cena"></artikel-domaca-stran>
               </div>
               <div class="products">
                  <h5 class="latest-product">ZADNJI ARTIKLI</h5>
                  <a class="view-all" href="product.html">POGLEJ OSTALE<span> </span></a>
               </div>
               <div class="product-left" v-for="(artikel,i) in mnoziceArtiklov.zadnjiArtikli">
                  <artikel-domaca-stran v-bind:st_slike="i" :slika_url="artikel.slika_url" :ime_artikla="artikel.ime_artikla" :redna_cena="artikel.redna_cena" :znizana_cena="artikel.znizana_cena"></artikel-domaca-stran>
               </div>
               <div class="clearfix"> </div>
            </div>
            <div class="clearfix"> </div>
         </div>
         <noga></noga>
      </div>
   </body>
</html>
