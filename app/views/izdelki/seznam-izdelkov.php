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

     <script src="<?= JS_URL .  "product.js"  ?>"></script>
      <!--script-->
      <style>
        [v-cloak] {
          display: none;
        }
      </style>
   </head>
   <body>
      <div id="app" v-cloak>
        <input type="hidden" value="<?= ROOT_URL ?>" id="rootUrl"/>
        <input type="hidden" value="<?= isset($query)?$query:"" ?>" id="query"/>
        <input type="hidden" value="<?= isset($kategorija)?$kategorija:"" ?>" id="kategorija"/>
        <glava root_url="<?=ROOT_URL?>"></glava>

         <div class="container">
            <navigacijski-menu-wrapper root_url="<?= ROOT_URL ?>"></navigacijski-menu-wrapper>
            <div class="women-product">
               <div class=" w_content">
                  <div class="women">
                     <a href="#">
                        <h4>Ime kategorije - <span>X Izdelkov</span> </h4>
                     </a>

                     <div class="clearfix"> </div>
                  </div>
               </div>
               <div  class="grid-product" >
                  <div v-for="artikel in tabelaArtiklov">
                     <artikel-product-stran  :artikel="artikel" ></artikel-product-stran>
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
