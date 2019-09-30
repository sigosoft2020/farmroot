<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Hermas has been in business which is run from two distribution centers in India. We are a global leader in bringing the best overall value in natural products to our customers all over the world.">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="<?=base_url()?>assets/images/favicon.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

     <title>HERMAS | HOME</title>
     <link href="<?=base_url()?>site/css/bootstrap.min.css" rel="stylesheet">
     <link href="<?=base_url()?>site/css/style.css" rel="stylesheet">
    <!--  <link href="carousel.css" rel="stylesheet"> -->
    <style type="text/css">
    .custom-tab-content{
    color:#fff;
    font-family: 'Open Sans', sans-serif;
    }
    </style>
</head>

  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  
  <script>
    (adsbygoogle = window.adsbygoogle || []).push({
      google_ad_client: "ca-pub-1126577024424811",
      enable_page_level_ads: true
    });
  </script>
<!-- NAVBAR
================================================== -->
      <?php if(!empty($this->session->flashdata('Message')))  {?>
        <div class="alert alert-success" id="warn">
          <strong>Success!
          </strong>&nbsp;&nbsp;&nbsp;
          <?php echo $this->session->flashdata('Message'); ?>.
        </div>
      <?php } ?>

  <body>
  <?php $this->load->view('site/includes/header.php'); ?>
     
    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>

       <div class="carousel-inner" role="listbox">
          <div class="item active">
             <div class="slider_txt">
             <h1>Hermas Unani</h1>
             <span>Greek Health Concept</span>
             </div>
            <img class="first-slide" src="<?=base_url()?>site/images/banner3.png" alt="First slide" class="img-responsive">
          </div>

          <div class="item">
            <img class="first-slide" src="<?=base_url()?>site/images/banner1.png" alt="First slide" class="img-responsive">
          </div>

          <div class="item">
            <img class="first-slide" src="<?=base_url()?>site/images/banner2.png" alt="First slide" class="img-responsive">
          </div>

          <div class="item">
            <img class="first-slide" src="<?=base_url()?>site/images/banner4.png" alt="First slide" class="img-responsive">
          </div>
      </div>

      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="fas fa-chevron-left position" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="fas fa-chevron-right position" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div><!-- /.carousel -->


<section class="padding-sec">
  <div class="container">
     <div class="first-head">
        <h4>POPULAR PRODUCTS</h4>
        <p>UNANI- A Deep Rooted System Of Medicine With a 5000 Year Old History</p>
     </div><br>

     <div class="container">
       <div class="row">
       
        <div>
            <!-- Wrapper for slides -->
            <div>
                <div class="adj">
                    <div class="row">    

                    <?php foreach($featured as $feat) {?>              
                       <a href="<?=site_url('store/product/'.$feat->product_id) ;?>"><div class="col-sm-3"> 
                            <div class="col-item">
                                <div class="photo">
                                    <img src="<?=base_url().$feat->image?>" class="img-responsive" alt="a" />
                                </div></a>
                                 <div class="info">
                                      <div class="row">
                                          <div class="col-md-12 text-center">
                                               <h5 class="price">
                                                  <?php echo $feat->product_name;?>
                                               </h5>
                                               <h5 class="price-text-color">
                                                  <?php echo $feat->price;?> INR
                                               </h5>
                                          </div>
                                      </div>
                                   
                                    <div class="clearfix">
                                    </div>
                                 </div>
                            </div>
                        </div>
                    <?php };?>     
                  </div>
              </div>
        </div>
     </div>
   </div>
</section>

<section class="padding-sec">
    <div class="container">
      <div class="first-head">
        <h4>LATEST PRODUCTS</h4>
        <p>UNANI- A Deep Rooted System Of Medicine With a 5000 Year Old History</p>
      </div><br>


    <div class="container">
      <div class="row">
       <div>
            <!-- Wrapper for slides -->
            <div>
                <div class="adj">
                    <div class="row">
                      <?php foreach($latest as $lat) {?>    
                         <a href="<?=site_url('store/product/'.$lat->product_id) ;?>"><div class="col-sm-3">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="<?=base_url().$lat->image?>" class="img-responsive" alt="a" /> 
                                </div></a>
                                <div class="info">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <h5 class="price">
                                              <?php echo $lat->product_name;?>
                                             </h5>
                                              <h5 class="price-text-color">
                                                <?php echo $lat->price;?> INR
                                              </h5>
                                        </div>                                       
                                     </div>
                                   
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div> 
                     <?php };?>                
                    </div>
                </div>
             </div>
          </div>
       </div>
     </div>
 </section>     

<section class="second-sec padding-sec">
  <div class="container">
    <div class="col-md-6 box1">
      <h2>ROGHAN LAMANI</h2>
       <h3>599 INR</h3>
       <div class="whit-box">
        <p>It cleans the scalp, improves the texture of hair and prevent hair fall.</p>
       </div><br>
       <a  class="mybtn2" href="<?=site_url('store')?>">BUY NOW</a>
    </div>
  </div>
</section>

<section class="padding-sec">
  <div class="container">
    <div class="first-head">
    <h4 class="">PRODUCTS</h4>
  </div><br>
  <div class="container">
  <div class="row">

  <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header" align="center">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <!-- <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> -->
            <p><span class="glyphicon glyphicon-remove"></span></p>
          </button>
        </div>
                
          <div class="modal-body">
                <!-- Begin # DIV Form -->
            <div id="div-forms">                
              <!-- Begin # Login Form -->
              <form id="login-form" method="post" action="<?=site_url('store/bulk_order')?>">
                  <div id="div-login-msg">                               
                      <span id="text-login-msg">PRODUCT</span>
                  </div>

                  <input id="product" class="form-control" name="product" type="text" placeholder="" required readonly>
                  <input id="product_id" class="form-control" name="product_id" type="hidden" placeholder="" required readonly>
                               
                  <div id="div-login-msg">
                      <span id="text-login-msg">PRODUCT PRICE</span>
                  </div>
                  <input id="price" class="form-control" type="text" name="price" readonly required>

                  <div id="div-login-msg">
                      <span id="text-login-msg">REQUIRED QTY</span>
                  </div>
                  <input id="qty" class="form-control" type="number" name="qty" placeholder="" min="1" required oninput="show_total();" autocomplete="off">
                           
                  <div id="div-login-msg">
                      <span id="text-login-msg">TOTAL</span>
                  </div>
                  <input id="total" class="form-control" type="text" name="total" placeholder="" required readonly>

                  <div id="div-login-msg">
                      <span id="text-login-msg">NAME</span>
                  </div>
                  <input id="name" class="form-control" type="text" name="name" placeholder="" required autocomplete="off">

                  <div id="div-login-msg">
                      <span id="text-login-msg">EMAIL</span>
                  </div>
                  <input id="email" class="form-control" type="text" name="email" placeholder="" autocomplete="off">
                  <p id="warn1" style="color:red;"></p>
                         
                  <div id="div-login-msg">
                      <span id="text-login-msg">PHONE</span>
                  </div>
                  <input id="phone" class="form-control" type="text" name="phone" placeholder=""  autocomplete="off">
                  <p id="warn2" style="color:red;"></p>
                      
                  <div id="div-login-msg">
                      <span id="text-login-msg">ADDRESS</span>
                  </div>
                  <input id="address" class="form-control" type="text" name="address" placeholder="" required autocomplete="off">
              
                  <div id="div-login-msg">
                     <span id="text-login-msg">CITY</span>
                  </div>
                  <input id="city" class="form-control" type="text" name="city" placeholder="" required autocomplete="off">
              
                  <div id="div-login-msg">
                      <span id="text-login-msg">STATE</span>
                  </div>
                  <input id="state" class="form-control" type="text" name="state" placeholder="" required autocomplete="off">
              
                  <div id="div-login-msg">
                      <span id="text-login-msg">PINCODE</span>
                  </div>
                  <input id="pincode" class="form-control" type="text"  name="pincode" placeholder=""   autocomplete="off" >
                  <p id="warn3" style="color:red;"></p>
                  <br>
                           
                  <button type="submit" class="btn btn-primary btn-lg btn-block" name="submit" onclick="book_now();">BOOK NOW</button>
                  </div>
                  <br>
              </form>
            </div>

            <style>
              .btn-primary {
                color: #fff;
                background-color: #036b3a;
                border-color: #40560f;
                  }
            </style>
            <!-- End # Login Form -->
                    
                    <!-- Begin | Lost Password Form -->
            <form id="lost-form" style="display:none;">

                <div class="modal-body">
                  <div id="div-lost-msg">
                    <div id="icon-lost-msg" class="glyphicon glyphicon-chevron-right"></div>
                    <span id="text-lost-msg">Type your e-mail.</span>
                  </div>
                  <input id="lost_email" class="form-control" type="text" placeholder="E-Mail (type ERROR for error effect)" required>
                </div>

                <div class="modal-footer">
                  <div>
                      <button type="submit" class="btn btn-primary btn-lg btn-block">Send</button>
                  </div>
                  <div>
                      <button id="lost_login_btn" type="button" class="btn btn-link">Log In</button>
                      <button id="lost_register_btn" type="button" class="btn btn-link">Register</button>
                  </div>
                </div>
            </form>
                    <!-- End | Lost Password Form -->
                    
                    <!-- Begin | Register Form -->
            <form id="register-form" style="display:none;">
                <div class="modal-body">
                    <div id="div-register-msg">
                        <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
                        <span id="text-register-msg">Register an account.</span>
                    </div>
                    <input id="register_username" class="form-control" type="text" placeholder="Username (type ERROR for error effect)" required>
                    <input id="register_email" class="form-control" type="text" placeholder="E-Mail" required>
                    <input id="register_password" class="form-control" type="password" placeholder="Password" required>
                </div>

                <div class="modal-footer">
                  <div>
                      <button type="submit" class="btn btn-primary btn-lg btn-block">Register</button>
                  </div>
                  <div>
                      <button id="register_login_btn" type="button" class="btn btn-link">Log In</button>
                      <button id="register_lost_btn" type="button" class="btn btn-link">Lost Password?</button>
                  </div>
                </div>
            </form>
                    <!-- End | Register Form -->
        </div>
                <!-- End # DIV Form -->                
      </div>
    </div>
  </div>

    <?php foreach($products as $product) {?> 
      <div class="col-md-3 col-sm-6">
          <span class="thumbnail">
           <img src="<?=base_url().$product->image?>" alt="...">
      
            <div class="block2-overlay trans-0-4">
              <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
              </a>

              <div class="block2-btn-addcart w-size1 trans-0-4">
                <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" data-toggle="modal" data-target="#login-modal" onclick="bulk_order('<?php echo $product->product_id;?>','<?php echo $product->product_name;?>','<?php echo $product->image;?>','<?php echo $product->quantity;?>','<?php echo $product->price;?>' )">
                      BULK ORDER BOOKING
                </button>
              </div>
            </div>
                
            <div class="row merg">
                <div class="col-md-12 green1">
                 <h4><?php echo $product->product_name;?></h4>
                </div>

                <div class="col-md-6 col-sm-6 green2">
                  <p class="price"><?php echo $product->price;?> INR</p>
                </div>

                <div class="col-md-6 col-sm-6 green3">
                    <a class="mybtn3" href="<?=site_url('store/product/'.$product->product_id) ;?>"> BUY NOW</a>
                </div>              
            </div>
          </span>
      </div>
    <?php };?>
    </div>
  </div>
</div>  
</div>

<div class="new-file"> 

</section>
 <?php $this->load->view('site/includes/footer.php'); ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
    
     <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <script type="text/javascript">
    $(document).ready(function(){

/**
 * This object controls the nav bar. Implement the add and remove
 * action over the elements of the nav bar that we want to change.
 *
 * @type {{flagAdd: boolean, elements: string[], add: Function, remove: Function}}
 */
var myNavBar = {

    flagAdd: true,

    elements: [],

    init: function (elements) {
        this.elements = elements;
    },

    add : function() {
        if(this.flagAdd) {
            for(var i=0; i < this.elements.length; i++) {
                document.getElementById(this.elements[i]).className += " fixed-theme";
            }
            this.flagAdd = false;
        }
    },

    remove: function() {
        for(var i=0; i < this.elements.length; i++) {
            document.getElementById(this.elements[i]).className =
                    document.getElementById(this.elements[i]).className.replace( /(?:^|\s)fixed-theme(?!\S)/g , '' );
        }
        this.flagAdd = true;
    }

};

/**
 * Init the object. Pass the object the array of elements
 * that we want to change when the scroll goes down
 */
myNavBar.init(  [
    "header",
    "header-container",
    "brand"
]);

/**
 * Function that manage the direction
 * of the scroll
 */
function offSetManager(){

    var yOffset = 0;
    var currYOffSet = window.pageYOffset;

    if(yOffset < currYOffSet) {
        myNavBar.add();
    }
    else if(currYOffSet == yOffset){
        myNavBar.remove();
    }

}

/**
 * bind to the document scroll detection
 */
window.onscroll = function(e) {
    offSetManager();
}

/**
 * We have to do a first detectation of offset because the page
 * could be load with scroll down set.
 */
offSetManager();
});


 </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../../assets/js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        function bulk_order(id,prod,img,qty,price){
            
            var product = prod;
            var price = price;
            document.getElementById("product").value=product;
            document.getElementById("price").value=price;
            document.getElementById("product_id").value=id;
        }
        
        function show_total(){
            var price = document.getElementById("price").value;
            var qty = document.getElementById("qty").value;
            total = price*qty;
            document.getElementById("total").value = total;
        }
        function book_now(){
          var pincode=$("#pincode").val();
          var email=$("#email").val();
          var phone=$("#phone").val();
          var reg = /^[0-9]+$/;
         var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
           if (pincode == ''){
          document.getElementById('warn3').innerHTML = "Pincode is required";
          event.preventDefault();
          }
          if ((pincode.length)< 6 || (pincode.length)>6 ){
          document.getElementById('warn3').innerHTML = "Pincode should be 6 digits";
          event.preventDefault();
          }
          if (!reg.test(pincode)){
          document.getElementById('warn3').innerHTML = "Digits Only";
          event.preventDefault();
          }
          if (email == ''){
          document.getElementById('warn1').innerHTML = "Email is required";
          event.preventDefault();
          }
         if (!filter.test(email)) {
           document.getElementById('warn1').innerHTML = "Not a Valid Email";
            event.preventDefault();
            }
            if (phone == ''){
               document.getElementById('warn2').innerHTML = "Phone is required";
               event.preventDefault();
          }
             else if ((phone.length)< 10 || (phone.length)>10 ){
               document.getElementById('warn2').innerHTML = "Phone should be 10 digits";
               event.preventDefault();
          }
          else if (!reg.test(phone)){
          document.getElementById('warn2').innerHTML = "Digits Only";
          event.preventDefault();
          }
        }
    </script>
    <script type="">
      $("#warn").show();
      setTimeout(function() 
      {
         $("#warn").hide();
      }, 3000);
    </script>
    
  </body>

</html>