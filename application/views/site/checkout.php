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
    <title>HERMAS | Address</title>
     <link href="<?=base_url()?>site/css/bootstrap.min.css" rel="stylesheet">
      <link href="<?=base_url()?>site/css/style.default.css" rel="stylesheet">
     <link href="<?=base_url()?>site/css/style.css" rel="stylesheet">
     <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!--  <link href="carousel.css" rel="stylesheet"> -->
  </head>

<body>
 <?php $this->load->view('site/includes/header.php');?>

    <div id="all" class="basket">
        <div id="content">
            <div class="container">
               <div class="col-md-12" id="checkout">

                    <div class="box">
                        <form method="POST" action="<?=site_url('checkout/add')?>">
                            <h1>Checkout</h1>
                            <ul class="nav nav-pills nav-justified">
                                <li class="active"><a href="#"><i class="fa fa-map-marker"></i><br>Address</a>
                                </li>
                                <li class="disabled"><a href="#"><i class="fa fa-eye"></i><br>Order Review</a>
                                </li>
                            </ul>

                            <div class="content">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="house">House / Flat No</label>
                                            <input type="text" class="form-control" name="house" id="house" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="address_1">Address 1</label>
                                            <input type="text" class="form-control" name="address_1" id="address_1" required>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.row -->

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="address_2">Address 2</label>
                                            <input type="text" class="form-control" name="address_2" id="address_2" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="city">City</label>
                                            <input type="text" class="form-control" name="city" id="city" required>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.row -->

                                <div class="row">
                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <label for="landmark">LandMark</label>
                                            <input type="text" class="form-control" name="landmark" id="landmark" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <label for="pincode">Pincode</label>
                                            <input type="number" class="form-control" name="pincode" id="pincode" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="state">State</label>
                                            <input type="text" class="form-control" name="state" id="state" required>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </div>

                            <div class="box-footer">
                                <div class="pull-left">
                                    <a href="<?=site_url('cart')?>" class="btn btn-primary">Back to Cart</a>
                                </div>
                                <div class="pull-right">
                                    <button type="submit" name="savecheckout" class="btn btn-primary">Save & Checkout</i></button>&nbsp&nbsp
                                    <button type="submit" name="checkout" class="btn btn-primary">Checkout</i></button>                        </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->
                </div>
    <?php if($address_check->num_rows()>0) {?>        
     <h3 class="text-center">Saved Addresses</h3>
     <div class="row">
              <form method="POST">
                <div class="col-md-4">
                     <div class="box">
                        <div class="radio-holder">
                          <input id="<?php echo $address->address_id; ?>" name="radio" type="radio" class="radio" value="<?php echo $address->address_id; ?>" checked> 
                           <label for="<?php echo $address->address_id; ?>"><h4><?php echo @$address->house; ?></h4>
                           </label>
                        </div>
                        <p><?php echo @$address->address_1; ?> </br>
                        <?php echo @$address->address_2; ?></br>
                        <?php echo @$address->city; ?></br>
                        <?php echo @$address->landmark; ?></br>
                        <?php echo @$address->pincode; ?></br>
                        <?php echo @$address->state; ?></br>
                        </p>
                        </div>
                     </div>
                </div>

                <div class="row">
                      <div class="pull-right">
                        <!-- <button class="btn btn-primary">Update basket</button> -->
                        <button name="place" type="submit" class="btn btn-primary">Proceed to checkout</button>
                      </div>
                </div>
            </form>
         </div>
    <?php };?>     
            <!-- /.container -->
    </div>
        <!-- /#content -->

 <?php $this->load->view('site/includes/footer.php');?>
   
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
    
     <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="<?=base_url()?>site/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../../assets/js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>

</html>