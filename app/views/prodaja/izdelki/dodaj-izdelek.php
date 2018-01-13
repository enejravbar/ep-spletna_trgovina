<!DOCTYPE html>
<html>
   <head>
      <title>Big shope</title>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

      <link href="<?= CSS_URL .  "style.css" ?>" rel="stylesheet" type="text/css" media="all" />
      <link href="<?= CSS_URL .  "search.css" ?>" rel="stylesheet" type="text/css" media="all" />
      <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>

      <link href="<?= LIB_URL .  "bootstrap/css/bootstrap.css" ?>" rel="stylesheet" type="text/css" media="all" />
      <link href="<?= LIB_URL .  "bootstrap/css/bootstrap-theme.css" ?>" rel="stylesheet" type="text/css" media="all" />
      <link href="<?= LIB_URL .  "bootstrap/dist/bootstrap.fd.css" ?>" rel="stylesheet" type="text/css" media="all" />

      <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
      <script src="<?= LIB_URL .  "jquery/jquery.min.js"  ?>"></script>
      <script src="<?= LIB_URL .  "bootstrap/js/bootstrap.js"  ?>"></script>
      <script src="<?= LIB_URL .  "bootstrap/dist/bootstrap.fd.js"  ?>"></script>
      <script src="<?= LIB_URL .  "vue/vue.js"  ?>"></script>
      <script src="<?= JS_URL .  "vue_components.js"  ?>"></script>

      <script src="<?= JS_URL .  "sellerManageProduct.js"  ?>"></script>

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

                 <div style="margin-top:40px;">

                   <div class="panel panel-default">
                    <div class="panel-body">
                      <div style="display:block;">
                        <div style="display:inline-block;"><span style="font-size:20px; margin-top:8px;">DODAJANJE ARTIKLOV</span></div>
                      </div>
                    </div>
                  </div>

                   <div class="panel panel-default" style="">
                     <div class="panel-heading">
                       <h4>PODATKI O ARTIKLU</h4>
                     </div>
                     <div class="panel-body">

                       <div class="">

                          <div class="form-group">
                            <label for="ime">Ime</label>
                            <input type="text" class="form-control" v-model="artikel.ime">
                          </div>
                          <div class="form-group">
                            <label for="comment">Opis</label>
                            <textarea class="form-control" rows="5" id="comment" v-model="artikel.opis"></textarea>
                          </div>
                          <div class="form-group">
                            <label for="sel1">Status</label>
                            <select class="form-control" id="sel1" v-model="artikel.status">

                            </select>
                          </div>
                          <div class="form-group">
                            <label for="sel1">Kategorija</label>
                            <select class="form-control" id="sel1" v-model="artikel.kategorija">
                              <option v-for="kategorija in tabelaKategorij" :value="kategorija.id">{{kategorija.ime}}</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="priimek">Cena</label>
                            <input type="text" class="form-control" id="cena" placeholder="" name="pwd" value="" v-model="artikel.cena">
                          </div>



                          <div style="display:block;" class="row">
                            <div style="display:block;" class="col-mg-12" style="padding-top:20px;">
                              <button id="open_btn" class="btn btn-md btn-info" style="margin-left:15px;">Dodaj slike</button>
                            </div>
                          </div>


                       </div>
                       <div class="clearfix"> </div>
                     </div>
                     <div class="panel-footer">

                       <div style="display:block;" class="row" style="">
                         <div style="display:block;" class="col-mg-12" style="">
                           <button  class="btn btn-success" style="margin-left:15px;padding-left:15px;" v-on:click="dodajIzdelek()">Shrani spremembe</button>
                           <span class="label label-success"  style="display:inline-block; float:right; padding:6px; margin-right:5px,">Podatki uspešno posodobljeni!</span>
                         </div>
                       </div>

                     </div>
                   </div>



                 </div>
               </div>

               <div class="clearfix"> </div>
         </div>

         <noga></noga>
      </div>
   </body>
</html>
