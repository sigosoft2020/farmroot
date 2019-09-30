<style type="text/css">
    /*
* Style tweaks
* --------------------------------------------------

 * Custom styles
 */
.navbar-brand {
    font-size: 24px;
}
.navbar-nav>li>a{
 /* color: #fff;*/
}
.green-1{
  background-color: #a6ce39 !important;
}
.green-2{
  background-color: #b9d863 !important;
}
 .green-3{
  background-color: #b9d863 !important;
 }
  .green-4{
  background-color: #b9d863 !important;
 }
 .green-5{
   background-color: #1c6341 !important;
   height: 70px;
 }
.navbar-container {
    padding: 20px 0 20px 0;
}

.navbar.navbar-fixed-top.fixed-theme {
    background-color: #1c6341;
    /*border-color: #88b032;*/
    box-shadow: 0 0 5px rgba(0,0,0,.8);
}

.navbar-brand.fixed-theme {
    font-size: 18px;
}


.navbar-container.fixed-theme {
    padding: 0;
}

.navbar-brand.fixed-theme,
.navbar-container.fixed-theme,
.navbar.navbar-fixed-top.fixed-theme,
.navbar-brand,
.navbar-container{
    transition: 0.8s;
    -webkit-transition:  0.8s;

}  

.navbar-nav > li > a {
    text-transform: uppercase;
    /* line-height: 20px; */
    -webkit-transition: all ease-in-out 0.4s;
    -moz-transition: all ease-in-out 0.4s;
    -o-transition: all ease-in-out 0.4s;
    transition: all ease-in-out 0.4s;
   
    font-family: 'Source Sans Pro', sans-serif;
    font-weight: bold;
}  
.navbar-right {
    margin: 12px 0px!important;
}
#drop_mnu_s{
 
 margin-right: -70px;
}
/*.navbar {
    position: relative;
    min-height: 50px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    background: #a6ce39;
}*/

</style>

<?php
  if (isset($this->session->userdata['site_user'])) 
  {
    $user = $this->session->userdata['site_user'];
  }
?>
    <body>

        <nav id="header" class="navbar navbar-fixed-top " >
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="" href="index.php"><img src="<?=base_url()?>site/images/logo.png"></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse navbar-right ">
                <ul class="nav navbar-nav">
                <li><a href="<?=site_url('home')?>">HOME</a></li>
                <li><a href="<?=site_url('about')?>">ABOUT</a></li>
                <li><a href="<?=site_url('store')?>">STORE</a></li> 
                <li><a href="<?=site_url('contact')?>">CONTACT</a></li>

                <?php if(isset($user)) 
                  { ?>     
                    <li><a href="<?=site_url('cart')?>" id="basket"><i class="fa fa-shopping-cart"></i> Cart <span class="badge" id="counter"></span></a></li>
                <?php } else {?>
                   <li><a href="<?=site_url('login')?>" id="basket"><i class="fa fa-shopping-cart"></i> Cart <span class="badge" id="counter"></span></a></li>
                <?php };?>   

             <?php if(isset($user)) { ?>
                     
             <li class="dropdown"><a href="#" id="cart" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> User <span class="badge"></span></a>
               
            <ul class="dropdown-menu"  id="drop_mnu_s">
               <div class="shopping-cart">
                  <ul class="shopping-cart-items" id="drop_menu_s">
                    <li class="clearfix">                    
                       <a href="<?=site_url('profile')?>"><span class="item-name">My Account</span></a>
                    </li>

                    <li class="clearfix">                     
                        <a href="<?=site_url('orders')?>"><span class="item-name">My Orders</span></a>
                    </li>

                    <li class="clearfix">                     
                      <!--<a href="logout.php"><span class="item-name">Logout</span></a>-->
                      <a data-toggle="modal" data-target=".bd-example-modal-sm"><span class="item-name" style="cursor:pointer">Logout</span></a>
                    </li>
                  </ul>

             <?php }
             else 
             { ?>

            <li><a href="<?=site_url('login')?>"><i class="fas fa-sign-in-alt"></i> Login</a>
           <?php }
            ?> 
              </ul>
            </div>
          </div>
        </nav>

        

     <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                  <p>Are you sure to logout?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary default mb-1" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-success default mb-1" href="<?=site_url('login/logout')?>">Logout</a>
                </div>
            </div>
        </div>
     </div>
