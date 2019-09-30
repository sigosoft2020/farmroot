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
    <title>HERMAS | About</title>
     <link href="<?=base_url()?>site/css/bootstrap.min.css" rel="stylesheet">
     <link href="<?=base_url()?>site/css/style.css" rel="stylesheet">
    <!--  <link href="carousel.css" rel="stylesheet"> -->
  </head>
<!-- NAVBAR
================================================== -->
  <body>
   
<?php $this->load->view('site/includes/header.php'); ?>

<section class="abou-bg-sec green-1">  
  <div class="container">
    <div class="text-top">
      <h3>UNANI- A Deep Rooted System Of Medicine With a 5000 Year Old History</h3><br><br>
      <p class="hidden-xs">Unani system Of medicine is now the latest form Of relief</p>
    </div>  
  </div>
</section>

<section class="abou-bg-third">  
  <div class="container">
    <div class="text-btm">
      <p>Hermas has been in business since 1996 and is run from two distribution centers in California and Kentucky, USA. We are a global leader in bringing the best overall value in natural products to our customers all over the world.</p>
    </div>
  </div>
</section>

<section class="doted-bg">
  <div class="container">
   <div class="row">
    <div class="col-md-8 col-xs-12 dot-text">
      <h3>History of Unani </h3>
        <P>Unani as a system of medicine originated in Greece. Its founder, the great Physician Hippocrates. Needless to say. Unani is the only system of medicine which still-follows the principles of medicine promoted by  Hippocrates. The fundamentals of Unani system are based on his Humoral Theory. <br><br>Unani medicine, like any other form of medical science strives to find the best possible ways by which a person can lead a healthy life with the least or zero‘ sickness . It prescribes drugs, diet, drinks and other regiments including 3 codes of conduct which are conducive to the maintenance and promotion of poSitive health as well “as the prevention and cure of ”disease. The ultimate aim of these scientific preScriptions is the creation of a healthy society.
      </P>
    </div>
   </div>
  </div>
</section>

<section class="dot-texts">
  <div class="container">
    <div class="col-md-6 aj-image">
    <img src="<?=base_url()?>site/images/ajmal.jpg" class="img-responsive">
    </div>

    <div class="col-md-6">
      <div class="aj-text">
        <h3 class="mt-4">Personal Profile</h3>
            <p class="pt-0">Dr. Ajmal, the visionary and the energy behind
             Calicut Unani Hospital. An Untiring
             entrepreneur and a compassionate doctor,
            Dr. Ajmal along with a team of dedicated 
            professionals has turned the hospital into a
            leading player in the realm of Unani in a very
            short span of time. He is one of the pioneering 
            Unani physicians to infuse cutting edge
            technology into the age old wisdom of Unani,
            thereby making it contemporary and
            accessible to the masses. <br>As a committed Unani physician he has been
            propagating the goodness of Unani among
            the masses. He considers this more than a
            social commitment rather than a mere
            business proposition.<br>Dr.Ajmal kiran Thodika has graduated in Unani
            from University of Poona in 1992. the first 
            degree holder in Unani from the state of Kerala.
          </p>
      </div>
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
}); </script>

    <?php $this->load->view('site/includes/scripts.php'); ?>
  </body>

</html>