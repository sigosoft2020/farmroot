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
     <title>HERMAS | Order Review</title>
     <link href="<?=base_url()?>site/css/bootstrap.min.css" rel="stylesheet">
     <link href="<?=base_url()?>site/css/style.default.css" rel="stylesheet">
     <link href="<?=base_url()?>site/css/style.css" rel="stylesheet">
     <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!--  <link href="carousel.css" rel="stylesheet"> -->
  </head>

 <?php if(!empty($this->session->flashdata('message')))  {?>
    <div class="alert alert-success" id="warn">
      <strong>Success!
      </strong>&nbsp;&nbsp;&nbsp;
      <?php echo $this->session->flashdata('message'); ?>.
    </div>
  <?php } ?>

<body>
 <?php $this->load->view('site/includes/header.php');?>

    <div id="all" class="basket">
        <div id="content">
            <div class="container">
                <div class="col-md-12" id="checkout">
                    <div class="box">
                        <form method="post">
                            <h1>Order Review</h1>
                            <ul class="nav nav-pills nav-justified">
                                <li class="disabled"><a href="#"><i class="fa fa-map-marker"></i><br>Address</a>
                                </li>
                                <li class="active"><a href="#"><i class="fa fa-eye"></i><br>Order Review</a>
                                </li>
                            </ul>

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
                                         <?php 
                                         foreach($order_items as $item)
                                         {
                                         ?>
                                        <tr>
                                        <td>
                                            <a href="#">
                                                <img src="<?=base_url().$item->product_image?>" alt="Product">

                                            </a>
                                        </td>
                                        <td><a href="#"><?php echo @$item->product_name; ?></a></td>
                                        <td><?php echo @$item->quantity; ?></td>
                                        <td><?php echo @$item->product_price; ?></td>
                                        <td><?php echo @$item->total; ?></td>
                                        </td>
                                    </tr>
                                      <?php }; ?>  
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4">Total</th>
                                            <th><?php echo $order->grand_total; ?></th>
                                        </tr>
                                    </tfoot>
                                </table>

                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.content -->

                            <div class="box-footer">
                               
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->

                </div>

            </div>
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
    <script type="">
      $("#warn").show();
      setTimeout(function() 
      {
         $("#warn").hide();
      }, 3000);
    </script>
  </body>

</html>