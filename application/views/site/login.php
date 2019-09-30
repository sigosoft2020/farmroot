<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="<?=base_url()?>assets/images/favicon.ico">
    <title>HERMAS | HOME</title>
    <link href="<?=base_url()?>site/css/login.css" rel="stylesheet">
    <link href="<?=base_url()?>site/css/style.css" rel="stylesheet">
    <link href="<?=base_url()?>site/css/bootstrap.min.css" rel="stylesheet">
    <!--  <link href="carousel.css" rel="stylesheet"> -->    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">       
           .input-group-addon 
           {
              padding: 6px 12px;
              font-size: 14px;
              font-weight: 400;
              line-height: 1;
              color: #fff;
              text-align: center;
              background-color: #a3cc44;
              border: none;
           }
    </style>
  </head>
<!-- NAVBAR
================================================== -->
<style type="text/css"></style>
  <body>    
      <div class="green-5 clearfix">
        <?php $this->load->view('site/includes/header.php'); ?>
      </div>

     <div class="main">
      <div class="row">
      </div>
    <!--login-profile-->    
    <!--login-profile-->
    <!--signin-form-->
        <div class="w3">
          <div class="signin-form profile">
            <h3>Login</h3>

            <div class="login-form">
              <form method="POST" action="<?=site_url('login/login_check')?>">
                <input type="text" name="username" placeholder="E-mail" >
                <input type="password" name="password" placeholder="Password">

                <div class="form-group row m-b-20 text-center">
                    <div class="col-12" id="warn">
                      <label for="password" style="color:red;"><?php if(!empty($this->session->flashdata('message'))){ echo $this->session->flashdata('message'); } ?></label>
                    </div>
                </div>

                <div class="tp">
                  <input type="submit" name="login" value="LOGIN NOW">
                </div>
              </form>
            </div>
            
             <div class="clearfix">
                <a href="<?=site_url('register')?>"><button type="button" class="btn btn-success">Register</button></a>
             </div>

          </div>
        </div>

       <div class="clear"></div>
    <!--//signin-form-->  
  </div>

  <?php $this->load->view('site/includes/footer.php'); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script type="text/javascript" src="<?=base_url()?>site/js/bootstrap-show-password.min.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>

<script type="text/javascript" src="<?=base_url()?>site/js/main.js"></script>
<script type="text/javascript">
  $("#password").password('toggle');
  </script>

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
}); </script>

  <script type="">
    $("#warn").show();
      setTimeout(function() 
       {
        $("#warn").hide();
       }, 3000);

      $("#warn2").show();
      setTimeout(function() 
       {
        $("#warn2").hide();
       }, 3000);
  </script>
 
  </body>

</html>