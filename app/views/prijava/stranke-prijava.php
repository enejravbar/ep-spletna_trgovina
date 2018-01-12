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
     <script src="<?= JS_URL .  "login.js"  ?>"></script>

      <style>
        [v-cloak] {
          display: none;
        }
      </style>
   </head>
   <body>
      <div id="app" v-cloak >
        <input type="hidden" value="<?= BASE_URL ?>" id="baseUrl"/>
         <glava base_url="<?=BASE_URL?>"></glava>
         <div class="container">
            <navigacijski-menu-wrapper></navigacijski-menu-wrapper>
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
                     <input type="submit" value="PRIJAVA" v-on:click="prijaviStranko()" style="margin-top:10px;">

               </div>
               <div class=" login-left">
                  <h3>NOVI UPORABNIKI</h3>
                  <p>Če še nimate uporabniškega računa pri nas, ga lahko ustvarite na spodnji povezavi.
                  </p>
                     <a class="acount-btn" href="register.html">USTVARI NOV RAČUN</a>
               </div>
               <div class=" login-right">
                  <h3>PRIJAVA ZA OSEBJE</h3>
                  <p>Če se želite prijaviti kot osebje, prosim sledite spodnji povezavi.</p>

                     <a class="acount-btn" href="register.html">PRIJAVA ZA OSEBJE</a>
               </div>
               <div class="clearfix"> </div>
            </div>
            <div class="clearfix"> </div>
         </div>
         <noga></noga>
      </div>
   </body>
</html>
