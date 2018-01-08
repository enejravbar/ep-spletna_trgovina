Vue.component('glava', {
  template:`<div class="header">
   <div class="top-header">
      <div class="container" style="height:15px;">
      </div>
   </div>
   <div class="bottom-header">
      <div class="container">
         <div class="header-bottom-left">
            <div class="logo">
               <a href="index.html"><img src="images/logo.png" alt=" " /></a>
            </div>
            <div class="search">
               <input type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" >
               <input type="submit"  value="ISKANJE">
            </div>
            <div class="clearfix"> </div>
         </div>
         <div class="header-bottom-right">
            <div class="account" style="dislay:none"><a href="login.html"><span> </span>VAŠ RAČUN</a></div>
            <ul class="login">
               <li><a href="login.html"><span> </span>PRIJAVA</a></li>
               |
               <li><a href="register.html">REGISTRACIJA</a></li>
            </ul>
            <div class="cart"><a href="#"><span> </span>KOŠARICA</a></div>
            <div class="clearfix"> </div>
         </div>
         <div class="clearfix"> </div>
      </div>
   </div>
</div>`
});

Vue.component('noga', {
  template:`<div class="footer">
   <div class="footer-top">
      <div class="container">
         <div class="latter">
            <h6>NEWS-LETTER</h6>
            <div class="sub-left-right">
               <form>
                  <input type="text" value="Vaš elektronski naslov" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Vaš elektronski naslov';}" />
                  <input type="submit" value="NAROČI SE" />
               </form>
            </div>
            <div class="clearfix"> </div>
         </div>
         <div class="latter-right">
            <p>SLEDITE NAM</p>
            <ul class="face-in-to">
               <li><a href="#"><span> </span></a></li>
               <li><a href="#"><span class="facebook-in"> </span></a></li>
               <div class="clearfix"> </div>
            </ul>
            <div class="clearfix"> </div>
         </div>
         <div class="clearfix"> </div>
      </div>
   </div>
   <div class="header">
      <div class="top-header">
         <div class="container" style="height:15px;">
         </div>
      </div>
   </div>
</div>`
});
