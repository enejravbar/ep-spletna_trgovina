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

     <script src="<?= JS_URL .  "customerOrders.js"  ?>"></script>

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
                        <div style="display:inline-block;"><span style="font-size:20px; margin-top:8px;">Pregled naročil</span></div>
                        <div class="dropdown" style="display:inline-block; float:right; margin-left:10px; ">
                         <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" style=" padding: 9px 9px 9px 9px ">Vsa naročila</button>
                         <ul class="dropdown-menu">
                          <li ><a href="#"><span >Oddana</span> </a></li>
                          <li ><a href="#"><span >Potrjena</span> </a></li>
                          <li ><a href="#"><span >Stornirana</span> </a></li>
                         </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <table id="cart" class="table table-hover table-condensed">
                    				<thead>
                						<tr>
                							<th >Datum naročila</th>
                							<th class="text-center">Status naročila</th>
                							<th class="text-center">Cena naročila</th>
                              <th style="text-align:right;"></th>
                						</tr>
                					</thead>
                					<tbody>

                              <tr v-for="narocilo in tabelaNarocil" >

                    							<td data-th="Datum naročila">
                    								{{narocilo.datum_narocila}}
                    							</td>

                    							<td data-th="Status naročila" >
                                    <span class="label label-warning text-center">{{narocilo.status_narocila}}</span>
                                  </td>

                    							<td data-th="Cena naročila" class="text-center">
                                    {{narocilo.cena_narocila}}
                                  </td>

                                  <td>
                                      <button type="button" class="btn btn-info" style="float:right;" data-toggle="modal" :data-target="'#narocilo-modal'+narocilo.id_narocila">Ogled naročila</button>
                                      <div :id="'narocilo-modal'+narocilo.id_narocila" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                          <!-- Modal content-->
                                          <div class="modal-content" >
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              <h4 class="modal-title">Podrobnosti naročila</h4>
                                            </div>
                                            <div class="modal-body">
                                              <narocilo :narocilo="narocilo"></narocilo>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-default" data-dismiss="modal">Zapri</button>
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
