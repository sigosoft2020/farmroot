<section class="footer">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <img src="<?=base_url()?>site/images/footer-logo.png">       
        <p>Hermas has been in business which is run from two distribution centers in India. We are a global leader in bringing the best overall value in natural products to our customers all over the world.</p>
         <div class="social-icon">
            <ul>
              <li><a href="https://www.facebook.com/hermasofficial" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
             
              <li><a href="https://plus.google.com/u/0/114444749487833077764" target="_blank"><i class="fab fa-google-plus-g"></i></a></li>
              <li><a href=""><i class="fab fa-linkedin-in"></i></a></li>
              <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            </ul>
         </div>
       </div>

       <div class="col-md-3 foot-sec-col">
          <div class="tab-content custom-tab-content" align="center">
             <div class="subscribe-panel">
               <h3>Newsletter!!!</h3>
                <p style="color: #5a5a5a;">Subscribe to our weekly Newsletter and stay tuned.</p>

                  <form  method="post" action="<?=site_url('home/newsletter')?>">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i></span>
                          <input type="text" class="form-control" name="sub_email" id="sub_email"  placeholder="Enter your Email"  autocomplete="off" />
                         </div>
                      </div>
                     </div>
                    <div id="errMsg"></div>
                    <br/>
                    <button type="submit" class="btn btn-warning" style="float: left;" name="newsletter" id="newsletter" >Subscribe Now!</button>
                  </form>

               </div>
            </div>
        </div>

        <div class="col-md-3 foot-contact">
           <h3>Contact <span>Us</span></h3>  
           <ul class="adress">
             <li><span><i class="fas fa-map-marker"></i></span> Near Kallai Bridge, Kallai Road, Calicut, Kerala, India</li><br>
             <li><span><i class="fas fa-phone-volume"></i></span>+91 4952700640, +91 4952304818</li><br>
             <li><span><i class="far fa-envelope"></i></span>info@hermasunani.com</li>
           </ul>          
        </div>

        <div class="col-md-2 quik-links">
           <h3>Quick <span>Links</span></h3>
           <ul>
              <li><a href="<?=site_url('home')?>">Home</a></li>
              <li><a href="<?=site_url('about')?>">About</a></li>
              <li><a href="<?=site_url('store')?>">Store</a></li>
              <li><a href="<?=site_url('contact')?>">Contact</a></li>
           </ul>  
        </div>
    </div>  
   </div>  
</section>

<section class="foot-bot">
  <div class="container text-center">
       <p>Copyright © 2018 Hermas . All Rights Reserved</p>
  </div>
</section>

<script>
 // document.getElementById("newsletter").disabled = true;
$("#newsletter").click(function(){
 var email=$("#sub_email").val();
 var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if(email == ''){
     $("div#errMsg").css("background-color", "red");
                            $("div#errMsg").html("Enter a email");
    event.preventDefault();
  }
   else if(!filter.test(email)) {
            $("div#errMsg").css("background-color", "red");
                            $("div#errMsg").html("Enter a valid email");
            event.preventDefault();
            }
});
 
</script>