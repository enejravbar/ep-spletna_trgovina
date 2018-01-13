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
        <input type="hidden" value="<?= ROOT_URL ?>" id="rootUrl"/>
        <glava root_url="<?=ROOT_URL?>"></glava>
         <div class="container" >

               <div class=" login-right">

                 <div style="margin-top:40px;">

                   <div class="panel panel-default">
                    <div class="panel-body">
                      <div style="display:block;">
                        <div style="display:inline-block;"><span style="font-size:20px; margin-top:8px;">DODAJANJE/UREJANJE ARTIKLOV</span></div>
                      </div>
                    </div>
                  </div>

                  <button id="open_btn" class="btn btn-lg btn-info" style="float:right;">Dodaj slike</button>

                  <table id="cart" class="table table-hover table-condensed" style="margin-top: 20px;">
                       <thead>
                       <tr>
                         <th style="width:50%">Slika artikla</th>


                         <th style="width:50%"></th>
                       </tr>
                     </thead>
                     <tbody>

                        <tr v-for="slika_url in artikel.tabela_urljev" >

                           <td data-th="Izdelek">
                             <div class="row">
                               <div class="col-sm-2 hidden-xs"><a :href="slika_url"><img :src="artikel.slika_url" alt="..." class="img-responsive" style="margin-top:12px; width:50px;"/></a></div>
                               <div class="col-sm-8">

                               </div>
                             </div>
                           </td>

                           <td class="actions" data-th="">

                             <div style="display:block;" style="">
                               <button type="button" class="btn btn-danger" style="display: inline-block; float:right;  width:40.5%;  margin-top:20px;" >Odstrani</button>

                             </div>
                           </td>

                       </tr>

                     </tbody>

                   </table>



                   <div class="panel panel-default" style="">
                     <div class="panel-heading">
                       <h4>PODATKI O ARTIKLU</h4>
                     </div>
                     <div class="panel-body">
                       <div class="">

                          <div class="form-group">
                            <label for="ime">Naziv</label>
                            <input type="text" class="form-control" id="ime" placeholder="" name="pwd" value="">
                          </div>
                          <div class="form-group">
                            <label for="priimek">Cena</label>
                            <input type="text" class="form-control" id="cena" placeholder="" name="pwd" value="">
                          </div>

                          <button  class="btn btn-success" style="display:inline-block">Shrani spremembe</button>
                          <span class="label label-success"  style="display:inline-block; float:right; padding:6px;">Podatki uspešno posodobljeni!</span>
                       </div>
                       <div class="clearfix"> </div>
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
