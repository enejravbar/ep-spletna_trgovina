<!DOCTYPE html>
<html>
   <head>
     <title>Big shope</title>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

     <link href="<?= LIB_URL .  "bootstrap/css/bootstrap.css" ?>" rel="stylesheet" type="text/css" media="all" />
     <link href="<?= CSS_URL .  "style.css" ?>" rel="stylesheet" type="text/css" media="all" />
     <link href="<?= CSS_URL .  "search.css" ?>" rel="stylesheet" type="text/css" media="all" />
     <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>

     <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
     <script src="<?= LIB_URL .  "jquery/jquery.min.js"  ?>"></script>
     <script src="<?= LIB_URL .  "vue/vue.js"  ?>"></script>
     <script src="<?= LIB_URL .  "bootstrap/js/bootstrap.js"  ?>"></script>
     <script src="<?= JS_URL .  "vue_components.js"  ?>"></script>

    <script src="<?= JS_URL .  "sellerManageProducts.js"  ?>"></script>
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
                        <div style="display:inline-block;"><span style="font-size:20px; margin-top:8px;">Upravljanje artiklov</span></div>

                      </div>
                    </div>
                  </div>

                  <a href="<?= ROOT_URL ?>prodaja/izdelki/novo"><button class="btn btn-success" data-toggle="modal" data-target="#dodajStranko" style="float:right; padding-top:8px; padding-bottom:8px;">Dodaj artikel</button></a>

                   <table id="cart" class="table table-hover table-condensed" style="margin-top: 20px;">
                            <thead>
                            <tr>
                              <th style="width:50%">Artikel</th>
                              <th style="">Cena</th>

                              <th style=""></th>
                            </tr>
                          </thead>
                          <tbody>

                             <tr v-for="artikel in tabelaArtiklov" >

                                <td data-th="Izdelek">
                                  <div class="row">
                                    <div class="col-sm-2 hidden-xs">
                                    <a :href="artikel.povezava_artikel">
                                      <img :src="artikel.slika_url" alt="..." class="img-responsive" style="margin-top:12px; width:50px;"/>
                                    </a>
                                    </div>
                                    <div class="col-sm-8">
                                      <h4 style="padding-top:30px;">{{artikel.ime_artikla}}</h4>
                                      <p></p>
                                    </div>
                                  </div>
                                </td>
                                <td data-th="Cena"><span style="margin-top:20px;">{{artikel.redna_cena}} €</span></td>


                                <td class="actions" data-th="">

                                  <div style="display:block;" style="">
                                    <button type="button" class="btn btn-danger" style="display: inline-block; float:right;  width:40.5%;  margin-top:20px;"  v-on:click="odstraniIzdelek(artikel)" >Odstrani</button>
                                    <a :href="root_url+'prodaja/izdelki/'+artikel.id+'/uredi'"><button type="button" class="btn btn-warning" style="display: inline-block; float:right;  width:40.5%; margin-right:1%; margin-top:20px;">Uredi</button></a>

                                  </div>
                                </td>

                            </tr>

                          </tbody>

                        </table>
                 </div>
               </div>

               <div class="clearfix"> </div>
         </div>

         <noga></noga>
      </div>
   </body>
</html>
