<!DOCTYPE html>
<html>
   <head>
      <title>Big shope</title>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

      <link href="<?= LIB_URL .  "bootstrap/css/bootstrap.css" ?>" rel="stylesheet" type="text/css" media="all" />
      <link href="<?= CSS_URL .  "style.css" ?>" rel="stylesheet" type="text/css" media="all" />
      <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>

      <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
      <script src="<?= LIB_URL .  "jquery/jquery.min.js"  ?>"></script>
      <script src="<?= LIB_URL .  "vue/vue.js"  ?>"></script>
      <script src="<?= LIB_URL .  "bootstrap/js/bootstrap.js"  ?>"></script>
      <script src="<?= JS_URL .  "vue_components.js"  ?>"></script>

      <script src="<?= JS_URL .  "index.js"  ?>"></script>


      <style>
        [v-cloak] {
          display: none;
        }
      </style>
   </head>
   <body>
      <div id="app" v-cloak>
         <input type="hidden" value="<?= ROOT_URL ?>" id="rootUrl"/>
         <glava root_url="<?=ROOT_URL?>"></glava>
         <div class="container" >
            <navigacijski-menu-wrapper root_url="<?= ROOT_URL ?>"></navigacijski-menu-wrapper>
            <div class="shoes-grid">
               <div class="products">
                  <h5 class="latest-product">NAŠE STRANKE KUPUJEJO</h5>
               </div>
               <div class="product-left" v-for="(artikel,i) in mnoziceArtiklov.slideShow">
                  <artikel-domaca-stran root_url="<?= ROOT_URL ?>" v-bind:st_slike="i" :artikel="artikel" ></artikel-domaca-stran>
               </div>

               <div class="products">
                  <h5 class="latest-product">ZADNJI ARTIKLI</h5>

               </div>
               <div class="product-left" v-for="(artikel,i) in mnoziceArtiklov.zadnjiArtikli">
                  <artikel-domaca-stran root_url="<?= ROOT_URL ?>" v-bind:st_slike="i" :artikel="artikel" ></artikel-domaca-stran>
               </div>

               <div class="clearfix"> </div>
            </div>
            <div class="clearfix"> </div>
         </div>
         <noga></noga>
      </div>
   </body>
</html>
