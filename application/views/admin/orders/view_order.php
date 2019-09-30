<!DOCTYPE html>
<html>
  <head>
    <?php $this->load->view('admin/includes/includes.php'); ?>
    <?php $this->load->view('admin/includes/table-css.php'); ?>
  </head>
  <body>
    <div id="wrapper">
      <?php $this->load->view('admin/includes/sidebar.php'); ?>
      <div class="content-page">
        <div class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="page-title-box">
                  <h4 class="page-title float-left">View Orders</h4>
                  
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                  <table id="user_data" class="table">
                    <tbody>
                       <tr>
                        <td>Order Number</td>
                        <td><?=$order->order_no?></td>
                      </tr>
                       <tr>
                        <td>Invoice Number</td>
                        <td><?=$order->invoice_no?></td>
                      </tr>
                      <tr>
                        <td>Name</td>
                        <td><?=$order->name?></td>
                      </tr>
                      <tr>
                        <td>Phone</td>
                        <td><?=$order->phone?></td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td><?=$order->email?></td>
                      </tr>
                      <tr>
                        <td>Address</td>
                        <td><?=$order->address_1?><br><?=$order->address_2?></td>
                      </tr>
                      <tr>
                        <td>City</td>
                        <td><?=$order->city?></td>
                      </tr>
                      
                    </tbody>
                  </table>


                  <table class="table">
                   <thead>
                       <th>Product Name</th>
                       <th>Price</th>
                       <th>Quantity</th>
                       <th>Total Price</th>
                   </thead>
                   
                   <tbody>
                       <?php 
                       
                       foreach($order->items as $item)
                       {
                       ?>
                       <tr>
                         <td><?=$item->product_name?></td>
                         <td><?=$item->product_price?></td>
                         <td><?=$item->quantity?></td>
                         <td><?=$item->total?></td>
                    
                       </tr>
                     
                     <?php };?>  
                   </tbody>
                   
                    <tfoot>
                        <tr>
                          <td colspan="3" style="text-align:right"><b>Grand Total:</b></td><td><b>&#8377; <?php echo $order->grand_total;?></b></td>
                        </tr>
                      
                     <!--    <tr>
                           <td colspan="4" style="text-align:right"><b>GRAND TOTAL:</b></td>
                           <td><b>&#8377; <?php echo $total;?>  </b></td>
                        </tr> -->
                  </tfoot>
                 </table>

                </div>
            </div>
          </div>
        </div>
      </div>
      <?php $this->load->view('admin/includes/footer.php'); ?>

    </div>
  </body>
  <?php $this->load->view('admin/includes/scripts.php'); ?>
  <?php $this->load->view('admin/includes/table-script.php'); ?>
 
</html>
