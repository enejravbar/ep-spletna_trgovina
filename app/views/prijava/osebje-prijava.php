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

      <script src="<?= JS_URL .  "loginStaff.js"  ?>"></script>
      <style>
        [v-cloak] {
          display: none;
        }
      </style>
   </head>
   <body>
      <div id="app" v-cloak>
        <input type="hidden" value="<?= ROOT_URL ?>" id="rootUrl"/>
        <glava-login root_url="<?=ROOT_URL?>"></glava-login>

         <div class="container" >
               <div class=" login-right">

                 <div class="account_grid">
                    <div class=" login-right">
                       <h3>PRIJAVA ZA OSEBJE</h3>

                          <div>
                             <span>ELEKTRONSKI NASLOV <label>*</label></span>
                             <input id="email" type="text" value="<?= $email ?>"  disabled>
                          </div>
                          <div>
                             <span>GESLO <label>*</label></span>
                             <input type="password" v-model="osebje.geslo">
                          </div>
                          <input type="submit" value="PRIJAVA" style="margin-top:10px;" v-on:click="prijaviOsebje()">
                          <span class="label label-warning"  style="display:inline-block; float:right; padding:10px; margin-top:10px; margin-left:10px;" v-if="prijavaUspesna==false">Prijava ni bila uspešna!</span>
                          <span class="label label-success"  style="display:inline-block; float:right; padding:10px; margin-top:10px; margin-left:10px;" v-if="prijavaUspesna==true && klikNaGumbPrijava==true">Prijava uspešna!</span>

                    <div class="clearfix"> </div>
                 </div>

               </div>

               <div class="clearfix"> </div>
         </div>
      </div>
      <noga></noga>
    </div>
   </body>
</html>
