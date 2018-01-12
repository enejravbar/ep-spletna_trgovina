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

     <script src="<?= JS_URL .  "single.js"  ?>"></script>

      <style>
        [v-cloak] {
          display: none;
        }
      </style>
   </head>
   <body>
      <div id="app" v-cloak>
        <input type="hidden" value="<?= ROOT_URL ?>" id="rootUrl"/>
        <input type="hidden" value="<?= $id ?>" id="idArtikla"/>
        <glava root_url="<?=ROOT_URL?>"></glava>
         <div class="container">
            <navigacijski-menu-wrapper root_url="<?= ROOT_URL ?>"></navigacijski-menu-wrapper>
            <div class=" single_top">

               <div class="single_grid">
                  <div class="grid images_3_of_2">

                    <div v-for="(url,i) in artikel.tabelaUrlSlik"  v-if="i==0">
                        <img  :src="url"  width="100%" />
                    </div>

                  </div>
                  <div class="desc1 span_3_of_2">
                     <h4>{{artikel.ime_artikla}}</h4>
                     <div class="cart-b">
                        <div class="left-n ">{{artikel.redna_cena}}€</div>
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
               <div class="row" style="display:block; margin-top:30px;">
                 <div v-for="(url,i) in artikel.tabelaUrlSlik" class="col-md-4" v-if="i!=0">
                   <img  :src="url"  width="100%" />
                 </div>
               </div>

            </div>


            <div class="clearfix"> </div>
         </div>
         <noga></noga>
      </div>
   </body>
</html>
