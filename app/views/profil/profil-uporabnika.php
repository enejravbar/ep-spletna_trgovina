<!DOCTYPE html>
<html>
   <head>
      <title>Big shope</title>
      <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
      <!--theme-style-->
      <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
      <link href="css/kosarica.css" rel="stylesheet" type="text/css" media="all" />
      <!--//theme-style-->
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
      <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
      <!--fonts-->
      <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
      <!--//fonts-->
      <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.js"></script>
      <script src="js/vue.js"></script>
      <script src="js/vue_components.js"></script>
      <script src="js/customerManageAccount.js"></script>
      <style>
        [v-cloak] {
          display: none;
        }
      </style>
   </head>
   <body>
      <div id="app" v-cloak>
         <glava></glava>
         <div class="container" >

               <div class=" login-right">

                 <div style="margin-top:40px;">

                   <stranka-forma-podatki ></stranka-forma-podatki>

                 </div>
               </div>

               <div class="clearfix"> </div>
         </div>

         <noga></noga>
      </div>
   </body>
</html>
