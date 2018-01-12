<!DOCTYPE html>
<html>
   <head>
     <title>Big shope</title>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

     <link rel="stylesheet" href="<?= LIB_URL . "jquery/etalage.min.css" ?>" type="text/css" media="all" />
     <link href="<?= LIB_URL .  "bootstrap/css/bootstrap.css" ?>" rel="stylesheet" type="text/css" media="all" />
     <link href="<?= CSS_URL .  "style.css" ?>" rel="stylesheet" type="text/css" media="all" />
     <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>

     <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
     <script src="<?= LIB_URL .  "jquery/jquery.min.js"  ?>"></script>
     <script src="<?= LIB_URL .  "jquery/jquery.flexisel.js"  ?>"></script>
     <script src="<?= LIB_URL .  "jquery/jquery.etalage.min.js"  ?>"></script>
     <script src="<?= LIB_URL .  "vue/vue.js"  ?>"></script>
     <script src="<?= LIB_URL .  "bootstrap/js/bootstrap.js"  ?>"></script>
     <script src="<?= JS_URL .  "vue_components.js"  ?>"></script>

     <script src="<?= JS_URL .  "single.js"  ?>"></script>

      <script>
         jQuery(document).ready(function($){

         	$('#etalage').etalage({
         		thumb_image_width: 300,
         		thumb_image_height: 400,
         		source_image_width: 900,
         		source_image_height: 1200,
         		show_hint: true
         	});

         });
      </script>
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
         <div class="container">
            <navigacijski-menu-wrapper root_url="<?= ROOT_URL ?>"></navigacijski-menu-wrapper>
            <div class=" single_top">
               <div class="single_grid">
                  <div class="grid images_3_of_2">
                     <ul id="etalage" >
                        <artikel-slika-single-stran v-for="url in artikel.tabelaUrlSlik" :slika_url="url"> </artikel-slika-single-stran>
                     </ul>
                     <div class="clearfix"> </div>
                  </div>
                  <div class="desc1 span_3_of_2">
                     <h4>{{artikel.ime_artikla}}</h4>
                     <div class="cart-b">
                        <div class="left-n ">{{artikel.znizana_cena}}€</div>
                        <a class="now-get get-cart-in" href="#">V KOŠARICO</a>
                        <div class="clearfix"></div>
                     </div>
                     <h6>Na zalogi</h6>
                     <p class="m_text">{{artikel.opis_artikla}}</p>
                     <div class="share">
                        <h5>Ocenite artikel :</h5>
                        <div class="rating">
                           <span>☆</span>
                           <span>☆</span>
                           <span>☆</span>
                           <span>☆</span>
                           <span>☆</span>
                        </div>
                     </div>
                  </div>
                  <div class="clearfix"> </div>
               </div>
            </div>
            <div class="clearfix"> </div>
         </div>
         <noga></noga>
      </div>
   </body>
</html>
