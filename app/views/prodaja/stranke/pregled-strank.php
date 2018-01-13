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

     <script src="<?= JS_URL .  "sellerManageCustomers.js"  ?>"></script>

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
                        <div style="display:inline-block;"><span style="font-size:20px; margin-top:8px;">Upravljanje strank</span></div>
                      </div>
                    </div>
                  </div>

                  <div id="dodajStranko" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Dodaj stranko</h4>
                        </div>
                        <div class="modal-body">

                          <form>
                             <div class="  register-top-grid">
                                <h3>OSEBNI PODATKI</h3>
                                <div class="mation">
                                   <span>IME<label>*</label></span>
                                   <input type="text">
                                   <span>PRIIMEK<label>*</label></span>
                                   <input type="text">
                                   <span>ELEKTRONSKI NASLOV<label>*</label></span>
                                   <input type="text">
                                </div>
                                <div class="clearfix"> </div>
                             </div>
                             <div class="  register-bottom-grid">
                                <h3>PRIJAVNI PODATKI</h3>
                                <div class="mation">
                                   <span>GESLO<label>*</label></span>
                                   <input type="text">
                                   <span>POTRDI GESLO<label>*</label></span>
                                   <input type="text">
                                </div>
                             </div>
                          </form>
                          <div class="clearfix"> </div>


                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-success" data-dismiss="modal" style="float:left;">Potrdi</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Prekliči</button>
                        </div>
                      </div>

                    </div>
                  </div>

                  <div style="display:block; margin-top:20px;">

                    <button class="btn btn-success" data-toggle="modal" data-target="#dodajStranko" style="float:right; padding-top:8px; padding-bottom:8px;">Dodaj stranko</button>
                  </div>

                  <table id="cart" class="table table-hover table-condensed" style="margin-top:40px;">
                    				<thead>
                						<tr>
                							<th >Ime in priimek</th>
                							<th class="">Elektronski naslov</th>
                							<th class="">Status računa</th>
                              <th class="text-center">Akcija</th>
                              <th></th>
                						</tr>
                					</thead>
                					<tbody>

                              <tr v-for="stranka in tabelaStrank" >


                                  <td>{{stranka.ime+" "+stranka.priimek}}</td>
                                  <td>{{stranka.email_naslov}}</td>
                                  <td>
                                    <span class="label label-success text-center" v-if="stranka.statusActive==1">Aktiviran</span>
                                    <span class="label label-danger text-center" v-if="stranka.statusActive==2">Neaktiviran</span>
                                    <span class="label label-danger text-center" v-if="stranka.statusActive==3">Nepotrjen</span>
                                  </td>

                                  <td>

                                    <div style="display:block;">
                                      <button type="button" class="btn btn-danger" style="display: inline-block; float:right;   " v-if=" stranka.statusActive==1" v-on:click="spremeniStatusStranke(stranka)" >Deaktiviraj</button>
                                      <button type="button" class="btn btn-success" style="display: inline-block; width:97px; float:right;   " v-if="stranka.statusActive==2 || stranka.statusActive==3" v-on:click="spremeniStatusStranke(stranka)" >Aktiviraj</button>
                                      <button type="button" class="btn btn-warning" data-toggle="modal" :data-target="'#urediStranko'+stranka.id" style="display: inline-block; float:right; margin-right:1%;" v-on:click="spremeniStatusStranke(stranka)" >Uredi</button>

                                      <div :id="'urediStranko'+stranka.id" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                          <!-- Modal content-->
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              <h4 class="modal-title">Uredi stranko</h4>
                                            </div>
                                            <div class="modal-body">

                                              <stranka-forma-podatki-prodajalec root_url="<?=ROOT_URL?>" :stranka_id="stranka.id"></stranka-forma-podatki-prodajalec>

                                              <div class="clearfix"> </div>

                                            </div>

                                          </div>

                                        </div>

                                      </div>
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
