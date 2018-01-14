<!DOCTYPE html>
<html>
   <head>
     <title>Big shope</title>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

     <link href="<?= LIB_URL .  "bootstrap/css/bootstrap.css" ?>" rel="stylesheet" type="text/css" media="all" />
     <link href="<?= CSS_URL .  "style.css" ?>" rel="stylesheet" type="text/css" media="all" />
      <link href="<?= CSS_URL .  "kosarica.css" ?>" rel="stylesheet" type="text/css" media="all" />
     <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>

     <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
     <script src="<?= LIB_URL .  "jquery/jquery.min.js"  ?>"></script>
     <script src="<?= LIB_URL .  "vue/vue.js"  ?>"></script>
     <script src="<?= LIB_URL .  "bootstrap/js/bootstrap.js"  ?>"></script>
     <script src="<?= JS_URL .  "vue_components.js"  ?>"></script>

     <script src="<?= JS_URL .  "cart.js"  ?>"></script>
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
                  <table id="cart" class="table table-hover table-condensed">
                    				<thead>
                						<tr>
                							<th style="width:50%">Artikel</th>
                							<th style="width:15%">Cena</th>
                							<th >Količina</th>
                							<th style="width:20%" class="text-center">Skupna cena</th>
                							<th ></th>
                						</tr>
                					</thead>
                					<tbody>
                            <tr  v-if="tabelaArtiklov.length==0 && pridobilPodatke">
                              <td colspan="5"><span style="text-align:center;">Košarica je prazna</span></td>
                            </tr>
                            <tr v-for="artikel in tabelaArtiklov" >

                  							<td data-th="Izdelek">
                  								<div class="row">
                  									<div class="col-sm-2 hidden-xs"><a :href="root_url+'izdelki/'+artikel.id"><img :src="artikel.slika_url" alt="..." class="img-responsive" style="margin-top:12px; width:50px;"/></a></div>
                  									<div class="col-sm-8">
                  										<h4 style="padding-top:30px;">{{artikel.ime_artikla}}</h4>
                  										<p></p>
                  									</div>
                  								</div>
                  							</td>
                  							<td data-th="Cena">{{artikel.redna_cena}} €</td>
                  							<td data-th="Količina">

                                  <div class="center">
                                    <div class="input-group" style="overflow: auto; width:100">

                                          <input type="text" name="quant[2]" class="form-control input-number"  min="1" v-model.number="artikel.kolicina" style="width:100%; margin-top:10px;margin-right:5px;" disabled >

                                            <span class="input-group-btn" style="width:100%; ">
                                                <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]" v-on:click="povecajKolicino(artikel)" >
                                                    <span class="glyphicon glyphicon-plus"></span>
                                                  </button>
                                              </span>
                                            <span class="input-group-btn" style="width:100%; ">
                                                <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]"  v-if="artikel.kolicina>=2" v-on:click="zmanjsajKolicino(artikel)" >
                                                  <span class="glyphicon glyphicon-minus"></span>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]" v-else disabled>
                                                  <span class="glyphicon glyphicon-minus"></span>
                                                </button>
                                            </span>

                                      </div>
                                  </div>
                                </td>
                  							<td data-th="Skupna cena" class="text-center">{{artikel.skupna_cena}} €</td>
                  							<td class="actions" data-th="">
                  								<button class="btn btn-md btn-danger " v-on:click="odstraniIzdelekIzKosarice(artikel)">Odstrani</button>
                  							</td>

                						</tr>

                					</tbody>
                					<tfoot >
                						<tr class="visible-xs" >
                							<td class="text-center"  ><strong v-if="tabelaArtiklov.length>0">Za plačilo {{skupnaCenaKosarice}} €</strong></td>
                						</tr>
                						<tr style="">
                							<td><a :href="root_url" class="btn btn-warning"><i class="fa fa-angle-left"></i> Nadaljuj z nakupovenjem</a></td>
                							<td class="hidden-xs"></td>
                							<td colspan="2"  class="hidden-xs text-center" style="font-size:20px;"  ><strong v-if="tabelaArtiklov.length>0">Za plačilo: {{skupnaCenaKosarice}}€</strong></td>
                							<td>
                                <a class="btn btn-success btn-block" style="padding:10px;" v-if="tabelaArtiklov.length<=0" disabled>Na blagajno <i class="fa fa-angle-right" ></i>
                                </a>
                                <a :href="root_url+'blagajna'" class="btn btn-success btn-block" style="padding:10px;" v-if="tabelaArtiklov.length>=1">Na blagajno <i class="fa fa-angle-right"></i>
                                </a>
                              </td>
                						</tr>
                					</tfoot>
                				</table>
                    </div>
               </div>

               <div class="clearfix"> </div>
         </div>

         <noga></noga>
      </div>
   </body>
</html>
