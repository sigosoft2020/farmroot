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
    <title>HERMAS | PRODUCT_VIEW</title>
     <link href="<?=base_url()?>site/css/bootstrap.min.css" rel="stylesheet">
     <link href="<?=base_url()?>site/css/style.css" rel="stylesheet">
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
    <!--  <link href="carousel.css" rel="stylesheet"> -->
    <style>
    .w50{width:50px; text-align:center;}
    </style>
  </head>
<!-- NAVBAR
================================================== -->
  <body>
    <div class="green-5 clearfix">
      <?php $this->load->view('site/includes/header.php'); ?>
    </div>
   <section class="product-view-sec">
     <div class="container">

      <div class="col-md-6">


    <div id='carousel-custom' class='carousel slide' data-ride='carousel'>
          <div class='carousel-outer '>
              <!-- me art lab slider -->
              <div class='carousel-inner'>
                  <div class='item active height'>
                      <img src="<?=base_url().$product->image?>" alt="" id="zoom_05"  />
                  </div>

                <?php foreach($product->images as $img) {?>
                  <div class='item height'  id="zoom_05">
                      <img src="<?=base_url().$img->Image?>" alt='' data-zoom-image="http://images.asos-media.com/inv/media/8/2/3/3/5313328/image2xxl.jpg" />
                  </div>
                <?php };?>

                  <script>
                    $("#zoom_05").elevateZoom({ zoomType    : "inner", cursor: "crosshair" });
                  </script>
              </div>
                  
              <!-- sag sol -->
              <a class='left carousel-control' href='#carousel-custom' data-slide='prev'>
                  <span class='glyphicon fas fa-chevron-left carosal-icon-right'></span>
              </a>
              <a class='right carousel-control' href='#carousel-custom' data-slide='next'>
                  <span class='fas fa-chevron-right carosal-icon-right'></span>
              </a>
          </div>
    
    <!-- thumb -->
          <ol class='carousel-indicators mCustomScrollbar meartlab'>
              <li data-target='#carousel-custom' data-slide-to='0' class='active'><img src="<?=base_url().$product->image?>" alt='' /></li>
              <?php foreach($product->images as $img) {?>
                <li data-target='#carousel-custom' data-slide-to='1'><img src="<?=base_url().$img->Image?>" alt='' /></li>
              <?php };?>
          </ol>

        </div>
     </div>

  <div class="col-md-6">

    <div class="product-discription">
        <h3><?php echo @$product->product_name;?></h3>
       
        <form action="" class="line">
          <label>Weight</label>
          <h4><?php echo @$product->quantity;?> </h4>
        </form>

         <h3><?php echo @$product->price;?> INR</h3>
        
      <?php if($stock->num_rows()>0) {?>
        <div class="item-footer">      
         <ul>
          <li><button class="btn-3" onclick="minuscount()"><i class="fa fa-minus" aria-hidden="true"></i></button></li>
        
          <li>
           <!-- <p class="pd">5</p> -->
           <input type="text" name="quantity" id="quantity" class="pd w50" value="1" readonly>
          </li>

          <li><button class="btn-3" onclick="addcount()"><i class="fa fa-plus" aria-hidden="true"></i></button></li>
         </ul>

         <?php 
          if ($this->session->userdata('site_user')) 
           {
         ?>
            <button class="add-cart" onclick="addcart('<?php echo $product->product_id; ?>')">Add to cart</button>
         <?php } else {?>
            <button class="add-cart" onclick="return confirm('Please login')">Add to cart</button>
         <?php };?>

          <input type="hidden" name="maximum" id="maximumcc" value="<?php echo $stock_qty; ?>">        
        </div>
      <?php } else {?> 
        <div class="item-footer">          
           <ul>
            <li>Out Of Stock</li>
           </ul>            
        </div>
      <?php };?>
         <h4 class="line"> Details</h4>  
         <div class="row">
           <div class="col-md-12">
             <p><?php echo @$product->product_description;?> </p>          
           </div>       
        </div>
 
        <h4 class="line"> Indication</h4>
        <div class="row">
           <div class="col-md-12">
              <p><?php echo @$product->indication;?> </p>           
           </div>       
       </div>
      </div>

    </div>
  </div>
</section>

<section class="padding-sec">
  <div class="container">
     <div class="first-head">
    <h4>Featured</h4>
    <p>text of the printing and typesetting industry</p>
  </div>

<div class="container">
    <div class="row">
        <div>
            <!-- Wrapper for slides -->
            <div>
                <div class="item active adj">
                    <div class="row">
                      <?php foreach($featured as $feat) {?>
                         <a href="<?=site_url('store/product/'.$feat->product_id) ;?>"><div class="col-sm-3"> 
                            <div class="col-item">
                                <div class="photo">
                                    <img src="<?=base_url().$feat->image?>" class="img-responsive" alt="a" />
                                </div></a>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-12 text-center">
                                            <h5>
                                                 <?php echo @$feat->product_name; ?>
                                            </h5> 
                                            <h5 class="price-text-color">
                                                 <?php echo @$feat->price;?> INR 
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

<?php $this->load->view('site/includes/footer.php'); ?>
   

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  <script>
   
 function addcart(product_id)
 {
   var quantity = document.getElementById("quantity").value; 
   var test=product_id;

   $.ajax({
            url: "<?php echo base_url('cart/add'); ?>", // complete url from siteurl/constroller/function
            method: 'POST',                       
             data:
                  {
                      product_id: product_id,
                      quantity: quantity

                  },
            success:function(data)
            { 
                alert('Item added to cart');
                //toastr.success('Data Successfully inserted!');
               // clearAllmale();
            },
            error: function(ts) { alert(ts.responseText) }
        });

   // alert(product_id);

//   xhr = new XMLHttpRequest();
//   xhr.open('POST' , 'cart/add' , true);

//   xhr.setRequestHeader('Content-Type', 'application/json');
//   xhr.send(JSON.stringify({
//     product_id:product_id,
//     quantity:quantity
   
//   }));

// xhr.onreadystatechange = function() {
  
//   if (this.readyState == 4 && this.status == 200) {
//     document.getElementById("demo").innerHTML = this.responseText;
//   }
// };


// alert("ITEM ADDED TO CART");
  
}

</script>


<script>
 function addcount()
 {
 
  
  var gt = document.getElementById('quantity').value;



  var max = document.getElementById('maximumcc').value;



 if( +gt < +max)
 {


  var add=1; 
 
 var total = +gt + +add;

  document.getElementById('quantity').value=total;
 }
 
 else
 {
  alert("THE REQUESTED QUANTITY IS NOT AVAILABLE FOR THIS PRODUCT")
    
 }




 }


 function minuscount()
 {
 

  var gt = document.getElementById('quantity').value;



  var add=1; 

 if(gt<=1)
 {

 var total = 1;
 
 }

 else
 {

 var total = +gt - +add;
 

 }
 

  document.getElementById('quantity').value=total;

 }



</script>




<script type="text/javascript">

$(document).ready(function() {
    $(".mCustomScrollbar").mCustomScrollbar({axis:"x"});
});

function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
</script>


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