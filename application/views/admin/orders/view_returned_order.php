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
                        <td><?=$order->OrderNO?></td>
                      </tr>
                       <tr>
                        <td>Invoice Number</td>
                        <td><?=$order->InvoiceNO?></td>
                      </tr>
                      <tr>
                        <td>Name</td>
                        <td><?=$order->BillingDet_Name?></td>
                      </tr>
                      <tr>
                        <td>Phone</td>
                        <td><?=$order->BillingDet_Phone?></td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td><?=$order->BillingDet_Email?></td>
                      </tr>
                      <tr>
                        <td>Address</td>
                        <td><?=$order->BillingDet_Address?><br>
                            <?=$order->BillingDet_Land?>
                        </td>
                      </tr>
                      <tr>
                        <td>City</td>
                        <td><?=$order->BillingDet_City?></td>
                      </tr>
                      <tr>
                        <td>Delivery date</td>
                        <td><?=$order->delivery_date?></td>
                      </tr>
                      <tr>
                        <td>Status</td>
                        <td><?=$order->status?></td>
                      </tr>
                    </tbody>
                  </table>

                  <table class="table">
                   <thead>
                       <th>Product Name</th>
                       <th>Product Price</th>
                       <th>Offer Price</th>
                       <th>Quantity</th>
                       <th>SGST</th>
                       <th>CGST</th>
                       <th>Total Price</th>
                   </thead>
                   
                    <tbody>
                       <?php 
                           $total=0;
                           $cgst=0;
                           $sgst=0;
                           $gst_amt=0;
                           $g=0;
                       foreach($order->items as $item)
                       {
                       ?>
                       <tr>
                         <td><?=$item->ProductName?></td>
                         <td><?=$item->ProductPrice?></td>
                         <td><?=$item->offer_price?></td>
                         <td><?=$item->Quantity?></td>
                         <td><?=$item->sgst?></td>
                         <td><?=$item->cgst?></td>
                         <td><?=$item->Total?></td>
                       </tr>
                     
                     <?php 
                          $total1= $item->Total;
                          $total=$total+$total1;
                          
                          $sgst_amt= $item->sgst;
                          $sgst=$sgst+$sgst_amt;
                          
                          
                          $cgst_amt= $item->cgst;
                          $cgst=$cgst+$cgst_amt;
                          
                          $gst=$sgst+$cgst;
                          
                          $gst_amt= ($total*100)/($gst+100);
                          $g=$total-$gst_amt;
                          
                          $gamount=$gst_amt*($gst/100);
                     };?>  
                    </tbody>
                   
                    <tfoot>
                         <tr><td colspan="6" style="text-align:right">Sub Total:</td><td><?php echo $total; ?></td></tr>
                         <tr><td colspan="6" style="text-align:right">Delivery Charge:</td><td>  <?php echo 20; ?></td></tr>                    
                         <tr><td colspan="6" style="text-align:right">SGST:</td><td><?php echo round(($gamount/2),2); ?></td></tr>
                         <tr><td colspan="6" style="text-align:right">CGST:</td><td><?php echo round(($gamount/2),2); ?></td></tr>                           
                         <tr><td colspan="6" style="text-align:right">Grand Total:</td><td><?php echo $total+20; ?></td></tr>
                    </tfoot>
                 </table>
                 
                  <div class="col-md-12">
                    <a href="<?=site_url('admin/orders/invoice/'.$order->OrderID)?>"><button class="btn btn-success" type="button" name="print" style="margin-top: 23px">Print</button></a>
                  </div>

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
