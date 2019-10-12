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
                                    <h4 class="page-title float-left">Invoice</h4>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-box">
                                    <div class="clearfix">
                                        <div class="pull-left">
                                            <img src="assets/images/logo_dark.png" alt="" height="20">
                                        </div>
                                        <div class="pull-right">
                                            <h4 class="m-0 d-print-none">Invoice</h4>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="pull-left mt-3">
                                                <p class="m-b-10"><strong><h6>FARM ROOT ORGANIC AND NATURALS LLP</h6></strong></p>
                                                <p class="m-b-10"><strong><h7>KOTTULI, CALICUT-16<br>MOB : 9061300900<br>www.farmroot.in<br>
                                                 info@farmroot.in<br>
                                                 GSTIN:32AAFFF9075P1ZV</h7></strong></p>
                                            </div>
                                        </div><!-- end col -->
                                        <div class="col-4 offset-2">
                                            <div class="mt-3 pull-right">
                                                <p class="m-b-10"><strong>Invoice Date: </strong> <?php echo date('d-M-Y');?></p>
                                                <p class="m-b-10"><strong>Order ID: </strong>#<?php echo $order->OrderNO;?></p>
                                                <p class="m-b-10"><strong>Invoice ID: </strong> #<?php echo $order->InvoiceNO;?></p>
                                                <p class="m-b-10"><strong>Order Status: </strong> <span class="badge badge-success"><?php echo $order->status;?></span></p>
                                                
                                            </div>
                                        </div><!-- end col -->
                                    </div>
                                    <!-- end row -->

                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <h6>Billing Address</h6>
                                            <address class="line-h-24">
                                                <?php echo $order->BillingDet_Name;?><br>
                                                <?php echo $order->BillingDet_Address;?><br>
                                                <?php echo $order->BillingDet_Land;?><br>
                                                <?php echo $order->BillingDet_City;?><br>
                                                <?php echo $order->BillingDet_PIN;?><br>
                                                PH:<?php echo $order->BillingDet_Phone;?>
                                            </address>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table mt-4">
                                                  <thead>
                                                    <tr>
                                                       <th>Product Name</th>
                                                       <th>Product Price</th>
                                                       <th>Offer Price</th>
                                                       <th>Quantity</th>
                                                       <th>SGST</th>
                                                       <th>CGST</th>
                                                       <th>Total Price</th>
                                                    </tr>
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
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="clearfix pt-5">
                                            </div>

                                        </div>
                                        <div class="col-5">
                                            <div class="float-right">
                                                <p><b>Sub-total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> ₹ <?php echo $total; ?></p>
                                                <p><b>SGST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> ₹ <?php echo round(($gamount/2),2); ?></p>
                                                <p><b>CGST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> ₹ <?php echo round(($gamount/2),2); ?></p>
                                                <p><b>Delivery Charge:</b>₹ 20</p>
                                                <h3>₹ <?php echo $total+20; ?></h3>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>

                                    <div class="hidden-print mt-4 mb-4">
                                        <div class="text-right">
                                            <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i class="fa fa-print m-r-5"></i> Print</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- container -->
                </div> <!-- content -->
                <?php $this->load->view('admin/includes/footer.php'); ?>
            </div>
        </div>
        <?php $this->load->view('admin/includes/scripts.php'); ?>
       <?php $this->load->view('admin/includes/table-script.php'); ?>
    </body>
</html>