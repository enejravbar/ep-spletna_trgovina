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

     <script src="<?= JS_URL .  "login.js"  ?>"></script>

      <style>
        [v-cloak] {
          display: none;
        }
      </style>
   </head>
   <body>
      <div id="app" v-cloak >
        <input type="hidden" value="<?= ROOT_URL ?>" id="rootUrl"/>
        <glava root_url="<?=ROOT_URL?>"></glava>
         <div class="container">
            <navigacijski-menu-wrapper root_url="<?= ROOT_URL ?>"></navigacijski-menu-wrapper>
            <div class="account_grid">
               <div class=" login-right">
                  <h3>REGISTRIRANI UPORABNIKI</h3>
                  <p>Če že imate uporabniški račun pri nas, se prosim prijavite.</p>

                     <div>
                        <span>ELEKTRONSKI NASLOV <label>*</label></span>
                        <input type="text" v-model="stranka.email">
                     </div>
                     <div>
                        <span>GESLO <label>*</label></span>
                        <input type="password" v-model="stranka.geslo">
                     </div>

                       <input type="submit" value="PRIJAVA" v-on:click="prijaviStranko()" style="margin-top:10px; ">
                       <span class="label label-warning"  style="display:inline-block; float:right; padding:10px; margin-top:10px; margin-left:10px;" v-if="prijavaUspesna==false">Prijava ni bila uspešna!</span>
                       <span class="label label-success"  style="display:inline-block; float:right; padding:10px; margin-top:10px; margin-left:10px;" v-if="prijavaUspesna==true && klikNaGumbPrijava==true">Prijava uspešna!</span>
               <div class=" login-left">
                  <h3>NOVI UPORABNIKI</h3>
                  <p>Če še nimate uporabniškega računa pri nas, ga lahko ustvarite na spodnji povezavi.
                  </p>
                     <a class="acount-btn" :href="root_url+'registracija'">USTVARI NOV RAČUN</a>
               </div>
               <div class=" login-right">
                  <h3>PRIJAVA ZA OSEBJE</h3>
                  <p>Če se želite prijaviti kot osebje, prosim sledite spodnji povezavi.</p>

                     <a class="acount-btn" :href="root_url+'osebje/prijava'">PRIJAVA ZA OSEBJE</a>
               </div>
               <div class="clearfix"> </div>
            </div>
            <div class="clearfix"> </div>
         </div>

      </div>
      <noga></noga>
    </div>
   </body>
</html>
