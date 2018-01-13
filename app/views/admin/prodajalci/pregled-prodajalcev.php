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

     <script src="<?= JS_URL .  "adminManageSellers.js"  ?>"></script>

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
                        <div style="display:inline-block;"><span style="font-size:20px; margin-top:8px;">Upravljanje prodajalcev</span></div>
                      </div>
                    </div>
                  </div>

                  <div id="dodajStranko" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" >&times;</button>
                          <h4 class="modal-title">Dodaj prodajalca</h4>
                        </div>
                        <div class="modal-body">

                          <div>
                            <div class="panel panel-default" style="">
                              <div class="panel-heading">
                                <h3>OSEBNI PODATKI</h3>
                              </div>
                              <div class="panel-body">
                                <div class="">

                                   <div class="form-group">
                                     <label for="ime">IME</label>
                                     <input type="text" class="form-control" placeholder=""  value="" v-model="novUporabnik.ime">
                                   </div>
                                   <div class="form-group">
                                     <label for="priimek">PRIIMEK</label>
                                     <input type="text" class="form-control"  placeholder="" value="" v-model="novUporabnik.priimek">
                                   </div>

                                  <div class="form-group">
                                     <label for="email">ELEKTRONSKI NASLOV</label>
                                     <input type="email" class="form-control"  placeholder=""  value="" v-model="novUporabnik.email" >
                                   </div>


                                   <div class="form-group">
                                     <label >NOVO GESLO</label>
                                     <input type="password" class="form-control"  placeholder="Vpiši novo geslo" value="" v-model="novUporabnik.geslo1">
                                   </div>
                                   <div class="form-group">
                                     <label >POTRDI NOVO GESLO</label>
                                     <input type="password" class="form-control" placeholder="Potrdi novo geslo" value=""  v-model="novUporabnik.geslo2">
                                   </div>

                                </div>
                                <div class="clearfix"> </div>
                              </div>
                            </div>
                          </div>
                          <div class="clearfix"> </div>


                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-success" style="float:left;" v-on:click="registrirajNovoStranko()">Potrdi</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal" style=" float:right;">Prekliči</button>
                          <span class="label label-success"  style="display:inline-block; float:left; padding:6px; margin-left:10px; margin-top:5px;" v-if="ustvarjenaNovaStranka && pritisnjenGumb && prikaziSporocilo">Stranka je bila uspešno registrirana!</span>
                          <span class="label label-danger"  style="display:inline-block; float:left; padding:6px; margin-left:10px; margin-top:5px;" v-if="!ustvarjenaNovaStranka && pritisnjenGumb && prikaziSporocilo">{{sporocilo}}</span>

                        </div>
                      </div>

                    </div>
                  </div>

                  <div style="display:block; margin-top:20px;">

                    <button class="btn btn-success" data-toggle="modal" data-target="#dodajStranko" style="float:right; padding-top:8px; padding-bottom:8px;" v-on:click="gumbDodaj()">Dodaj prodajalca</button>
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
                                      <button type="button" class="btn btn-warning" data-toggle="modal" :data-target="'#urediStranko'+stranka.id" style="display: inline-block; float:right; margin-right:1%;" >Uredi</button>

                                      <div :id="'urediStranko'+stranka.id" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                          <!-- Modal content-->
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              <h4 class="modal-title">Uredi prodajalca</h4>
                                            </div>
                                            <div class="modal-body">

                                              <prodajalec-forma-podatki-admin root_url="<?=ROOT_URL?>" :stranka_id="stranka.id"></prodajalec-forma-podatki-admin>

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
