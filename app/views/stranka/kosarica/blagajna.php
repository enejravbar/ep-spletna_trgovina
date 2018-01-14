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

      <script src="<?= JS_URL .  "confirmPurchase.js"  ?>"></script>

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


               <div class=" login-right">

                 <div style="margin-top:40px;" v-if="gumbKliknjenNarociloOddano">

                   <div class="alert alert-success" v-if="narociloOddano">
                    <h2>{{sporocilo}}</h2>
                  </div>
                  <div class="alert alert-danger" v-if="!narociloOddano">
                   <h2>{{sporocilo}}</h2>
                 </div>
                  <td><a :href="root_url" class="btn btn-md btn-warning"><i class="fa fa-angle-left"></i> Nadaljuj z nakupovenjem</a></td>
                 </div>

                 <div style="margin-top:40px;" v-else>

                  <h2>Zaključek naročila</h2>

                    <narocilo :narocilo="narocilo"></narocilo>

                    <td><a  class="btn btn-success" style="padding:10px; float:right" v-on:click="oddajNarocilo()" >Oddaj naročilo</a></td>
                    <td><a :href="root_url+'kosarica'" class="btn btn-warning"><i class="fa fa-angle-left"></i> Nazaj na košarico</a></td>
                 </div>

              </div>
               <div class="clearfix"> </div>
         </div>

         <noga></noga>
      </div>
   </body>
</html>
