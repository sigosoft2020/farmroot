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
    <title>HERMAS | Contact</title>
     <link href="<?=base_url()?>site/css/bootstrap.min.css" rel="stylesheet">
     <link href="<?=base_url()?>site/css/style.css" rel="stylesheet">
    <!--  <link href="carousel.css" rel="stylesheet"> -->
  </head>
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

  <section>  
      <?php $this->load->view('site/includes/header.php'); ?>
  </section>

  <section class="contact-banner green-4">
    <div class="container">
      <div class="row">
        <div class="col-md-3 contact-head">
          <h2>Contact</h2>
        </div>
      </div>
    </div>
  </section>

  <section>
    <div class="container">
       <div class="col-md-6">
        <div class="form-head">
          <h2>Quick Enquiry</h2>
        </div>
                
         <form id="demo-form2" action="<?=site_url('contact/send_enquiry')?>" method="POST" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
            <div class="form-group">
              <input type="text" name="name" class="form-controler" id="email" placeholder="Enter Your Name" required>
            </div>
            <div class="form-group">
              <input type="number" name="phone" class="form-controler" id="email" placeholder="Enter Your Phone Number" required>
            </div>
            <div class="form-group">
              <input type="email" name="email" class="form-controler" id="email" placeholder="Enter Your Id" required>
            </div>
            <div class="form-group">
               <textarea rows="0" cols="0" name="notes" class=" form-controlerr" placeholder="Enter Your Message" required>
                </textarea>
            </div>
           <!-- <button class="sub-btn" type="submit">Submit</button> -->
            <input type="submit" name="submit" class="btn btn-success" value="Submit">
        </form> 
      </div>

        <div class="col-md-6">
          <div class="row">
            <div class="form-head">
              <h2>Address</h2>           
            </div>
             <ul class="adres">
               <li>Near Kallai Bridge, Kallai Road, Calicut, Kerala, India</li>
               <li>+91 4952700640, +91 4952304818</li>
               <li>Fax : +91 495 2303422</li>
             <li>info@hermasunani.com</li>
             </ul>
          </div>  
        </div> 
  </section>
  <br><br>

  <section>
    <div class="container-fluid">
      <div class="row">
          <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15653.19552767049!2d75.7865439!3d11.2394099!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb396f81e2beec22a!2sCalicut+Unani+Hospital+And+Research+Centre!5e0!3m2!1sen!2sin!4v1457598074738" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>
    </div>
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
<script>window.jQuery || document.write('<script src="<?=base_url()?>assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="<?=base_url()?>site/js/bootstrap.min.js"></script>
<!-- Just to make our placeholder images work. Don't actually copy the next line! -->
<script src="<?=base_url()?>assets/js/vendor/holder.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="<?=base_url()?>assets/js/ie10-viewport-bug-workaround.js"></script>
 <script type="">
    $("#warn").show();
    setTimeout(function() 
    {
       $("#warn").hide();
    }, 3000);
  </script>
  
 </body>

</html>