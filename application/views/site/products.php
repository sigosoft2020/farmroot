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
    <title>HERMAS | PRODUCTS</title>
     <link href="<?=base_url()?>site/css/bootstrap.min.css" rel="stylesheet">
     <link href="<?=base_url()?>site/css/style.css" rel="stylesheet">
    <!--  <link href="carousel.css" rel="stylesheet"> -->
  </head>
<!-- NAVBAR
================================================== -->
  <body onload="Getproducts()">

    <section>  
     <?php $this->load->view('site/includes/header.php'); ?>
    </section>

    <section class="contact-banner green-4">
      <div class="container">
        <div class="row">
        <div class="col-md-3 contact-head">
          <h2>Products</h2>
        </div>

        </div>
      </div>
    </section>

    <section class="pad-rwd">
      <div class="container">
        <div class="row">
          
          <div class="col-md-3 side-left">
            <div class="catagory-top">
              <h3>Categories</h3>
                <input type="text" placeholder="Search by Category" name="CategorySearch" id="CategorySearch" onkeydown="GetCategorySearch()">   <br>

                <ul id="Category">
                <?php foreach($category as $cat) {?> 
                  <li style="list-style: none;" id="CategoryIDE<?php echo $cat->category_id; ?>" data-value="<?php echo $cat->category_id; ?>"><a onclick="CategoryFilter(<?php echo $cat->category_id; ?>);"><?php echo $cat->category_name; ?><span> (<?php echo $cat->count; ?>)</span></a>
                  </li>
                 <?php };?>  
                </ul>
            </div>
          </div>

          <div class="col-md-9 side-right">
              <div class="filter-area">
                  <div>
                    <input type="text" placeholder="Search.." id="SearchProduct" name="search" onkeydown="GetproductSearch()">
                    <button type="submit" onclick="GetproductSearch()"><i class="fa fa-search"></i></button>
                  </div>
         
                  <div class="right">
                    <label>Sort By Price</label>
                    <select name="price" id="price" class="myselect" onchange="GetproductFilter()">
                      <option value="lowtohigh">Low to High</option>
                      <option value="hightolow">high to Low</option>                
                    </select>
                  </div>
              </div>

             <div class="row" style="padding-top: 10%;" id="Products">
             </div> 
               <!-- <div class="text-center" style="margin-top: 5%;"><a href="#" class="btn-more">Read More</a></div> -->
          </div> 
        </div>
      </div>
    </section>

    <?php $this->load->view('site/includes/footer.php'); ?>
   
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
    
     <!-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="<?=base_url()?>site/js/bootstrap.min.js"></script>

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

    <script>
       function Getproducts()
       {

           var CategoryID=0;
      
           xhr = new XMLHttpRequest();
           var url = 
           xhr.open('POST' , 'store/get_products' , true);

           xhr.setRequestHeader('Content-Type', 'application/json');
           xhr.send(JSON.stringify({
           CategoryID:CategoryID

           }));


           xhr.onreadystatechange = function() {
  
           if (this.readyState == 4 && this.status == 200) {


            console.log('-------------------------------111--------------------------->>>')
           
           var temp =xhr.responseText;
           if (temp) {
           
           temp= JSON.parse(temp);

     
          document.getElementById('Products').innerHTML =temp;
           
           }

           }
           };
        
       };

// <----------- Search  ------------>

       function GetproductSearch()
       {
           var Key=document.getElementById('SearchProduct').value
      
           xhr = new XMLHttpRequest();
           xhr.open('POST' , 'store/GetProductSearch' , true);

           xhr.setRequestHeader('Content-Type', 'application/json');
           xhr.send(JSON.stringify({
           Key:Key

           }));


           xhr.onreadystatechange = function() {
  
           if (this.readyState == 4 && this.status == 200) {

            console.log('-------------------------------111--------------------------->>>')
           
           var temp =xhr.responseText;
           if (temp) {
           
               temp= JSON.parse(temp);
     
               document.getElementById('Products').innerHTML =temp;           
            }

           }
           };        
       };

// <----------- Filter Price  ------------>

       function GetproductFilter()
       {
           var PFilter=document.getElementById('price').value
      
           xhr = new XMLHttpRequest();
           xhr.open('POST' , 'store/Getproductprice' , true);

           xhr.setRequestHeader('Content-Type', 'application/json');
           xhr.send(JSON.stringify({
           PFilter:PFilter

           }));


           xhr.onreadystatechange = function() {
  
           if (this.readyState == 4 && this.status == 200) {


            console.log('-------------------------------111--------------------------->>>')
           
           var temp =xhr.responseText;
           if (temp) {
           
           temp= JSON.parse(temp);

     
          document.getElementById('Products').innerHTML =temp;
           }

           }
           };
         
       }

// <----------- CATEGORY  SEARCH ------------>
       function GetCategorySearch()
       {
           var Key=document.getElementById('CategorySearch').value
      
           xhr = new XMLHttpRequest();
           xhr.open('POST' , 'store/get_category_search' , true);

           xhr.setRequestHeader('Content-Type', 'application/json');
           xhr.send(JSON.stringify({
           Key:Key

           }));

           xhr.onreadystatechange = function() {
  
           if (this.readyState == 4 && this.status == 200) {

            console.log('-------------------------------111--------------------------->>>')
           
           var temp =xhr.responseText;
           if (temp) 
           {           
             temp= JSON.parse(temp);    
             document.getElementById('Category').innerHTML =temp;           
           }

           }
           };
          
       };

// <----------- CATEGORY  FILTER ------------>

       function CategoryFilter(FilterID)
       {
           
          var GID= FilterID;
         
           var IDE= 'CategoryIDE' + GID;
           var CategoryIDE=document.getElementById(IDE).getAttribute("data-value")
      
           xhr = new XMLHttpRequest();
           xhr.open('POST' , 'store/CategoryFilter' , true);

           xhr.setRequestHeader('Content-Type', 'application/json');
           xhr.send(JSON.stringify({
           CategoryIDE:CategoryIDE

           }));


           xhr.onreadystatechange = function() {
  
           if (this.readyState == 4 && this.status == 200) {


            console.log('-------------------------------111--------------------------->>>')
           
           var temp =xhr.responseText;
           if (temp) {
           
           temp= JSON.parse(temp);

     
          document.getElementById('Products').innerHTML =temp;
           
           }

           }
           };        
       }
   </script>
  </body>

</html>