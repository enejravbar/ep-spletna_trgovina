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

     <script src="<?= JS_URL .  "sellerOrders.js"  ?>"></script>
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
                         <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" style=" padding: 9px 9px 9px 9px ">Izberi vrsto</button>
                         <ul class="dropdown-menu">
                          <li ><a v-on:click="getDataNarocilaNeobdelana()"><span >Neobdelana</span> </a></li>
                          <li ><a v-on:click="getDataNarocilaPotrjena()"><span >Potrjena</span> </a></li>
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
                						<!--	<th class="text-center">Cena naročila</th> -->
                              <th style="text-align:right;"></th>
                              <th></th>
                						</tr>
                					</thead>
                					<tbody>

                              <tr v-for="narocilo in tabelaNarocil" >

                    							<td data-th="Datum naročila">
                    								{{narocilo.datum_narocila}}
                    							</td>

                    							<td data-th="Status naročila" >
                                    <span class="label label-success text-center">{{narocilo.status_narocila}}</span>
                                  </td>

        <!--            							<td data-th="Cena naročila" class="text-center">
                                    {{narocilo.cena_narocila}}
                                  </td>
                                -->
                                  <td>

                                      <a :href="root_url+'prodaja/narocila/'+narocilo.id_narocila" target="_blank"><button type="button" class="btn btn-info" style="float:right;" >Ogled naročila</button></a>

                                  </td>

                                  <td>
                                    <button type="button" class="btn btn-danger" style="float:right; width:100%;" v-if="narocilo.status_narocila=='POTRJENO'" v-on:click="stornirajPotrjenoNarocilo(narocilo)">Storniraj</button>
                                    <div style="display:block;">
                                      <button type="button" class="btn btn-danger" style="display: inline-block; float:right;  width:49.5%;" v-if="narocilo.status_narocila=='NEOBDELANO'" v-on:click="prekliciNeobdelanoNarocilo(narocilo)">Prekliči</button>
                                      <button type="button" class="btn btn-success" style="display: inline-block; float:right;  width:49.5%; margin-right:1%;" v-if="narocilo.status_narocila=='NEOBDELANO'" v-on:click="potrdiNeobdelanoNarocilo(narocilo)">Potrdi</button>
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
