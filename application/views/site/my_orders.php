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
    <title>HERMAS | Order History</title>
     <link href="<?=base_url()?>site/css/bootstrap.min.css" rel="stylesheet">
      <link href="<?=base_url()?>site/css/style.default.css" rel="stylesheet">
     <link href="<?=base_url()?>site/css/style.css" rel="stylesheet">
     <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!--  <link href="carousel.css" rel="stylesheet"> -->
  </head>

<body>
 <?php $this->load->view('site/includes/header');?>

    <div id="all" class="basket">
        <div id="content">
            <div class="container">

                <div class="col-md-12" id="basket">

                    <div class="box">
                       <div class="box-header">
                                <div class="pull-left col-md-6">
                                    <div class="col-md-4">
                                    <!-- <?php $dated=$rower['timestamp'];
                            $date=date("jS F, Y", strtotime("$dated")); ?>
                            <h5>ORDER PLACED<br><?php echo $date; ?></h5> -->
                                    </div>
                                    <div class="col-md-4">
                                   <!-- <h5>TOTAL<br><?php echo $rower['grand_total']; ?></h5> -->
                                    </div>
                                    <div class="col-md-4">
                                   <!-- <h5>SHIP TO<br><?php echo $name; ?></h5> -->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-6">
                                  <!-- <h5 class="pull-right">ORDER No<br> <?php echo $rower['order_no']; ?></h5> -->
                                   </div>
                                   <div class="col-md-6">
                                  <!-- <h5 class="pull-right"><?php echo $rower['status']; ?><br></h5> -->
                                  </div>
                                </div>
                            </div>

            
                           <div class="content">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Product</th>
                                                <th>Quantity</th>
                                                <th>Unit price</th>
                                         
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                  
                                        <tr>
                                            <td>
                                                <a href="#">
                                                    <!-- <img src="uploads/products/<?php echo $data['product_image']; ?>" alt="Product"> -->
                                                </a>
                                            </td>
                                            <!-- <td><a href="#"><?php echo $data['product_name']; ?></a></td>
                                            <td><?php echo $data['quantity']; ?></td>
                                            <td><?php echo $data['product_price']; ?></td>    <td><?php echo $data['total']; ?></td>
                                            </td> -->
                                        </tr>

                                        </tbody>
                                    </table>

                                </div>
                                <!-- /.table-responsive -->
                            </div>
                           </div>
                </div>

            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->

    </div>
    <!-- /#all -->
 <?php include 'includes/footer.php';?>
   
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