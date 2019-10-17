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
                  <h4 class="page-title float-left">Sales Reports</h4>
                  
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>

          

          <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                  <table id="datatable" class="table table-bordered table-striped table-responsive">
                    <thead>
                      <tr>
                          <th>Order No</th>
                          <th>Invoice No</th>  
                          <th>Date</th>                        
                          <th>Name</th>
                          <th>Email</th>
                          <th>Mobile</th>
                          <th>SALE FRESH</th>
                          <th>SALE VEG</th>
                          <th>SALE GROCERY</th>
                          <th>SALE FRUITS</th>
                          <th>SALE BABYFOODS</th>
                          <th>Delivery Charge</th>
                          <th>Grand Total</th>                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($sales as $sale) {?>
                        <tr>
                          <td><?php echo $sale->OrderNO;?></td>
                          <td><?php echo $sale->InvoiceNO;?></td>
                          <td><?php echo date('d M Y',strtotime($sale->timestamp));?></td>
                          <td><?php echo $sale->BillingDet_Name;?></td>
                          <td><?php echo $sale->BillingDet_Email;?></td>
                          <td><?php echo $sale->BillingDet_Phone;?></td>
                          <td><?php echo $sale->fresh_total;?></td>
                          <td><?php echo $sale->veg_total;?></td>
                          <td><?php echo $sale->grocery_total;?></td>
                          <td><?php echo $sale->fruits_total;?></td>
                          <td><?php echo $sale->babyfood_total;?></td>
                          <td><?php echo 20;?></td>
                          <td><?php echo $sale->GrandTotal;?></td>
                        </tr>
                      <?php };?>
                    </tbody>
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
   <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable').DataTable();

            //Buttons examples
            var table = $('#datatable-buttons').DataTable({
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf']
            });

            table.buttons().container()
                    .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
        } );

    </script>
     <script>
         $('#datatable').DataTable({
            "order": [[ 0, "desc" ]], //or asc 
            "columnDefs" : [{"targets":3, "type":"date-eu"}],
        });
    </script>
  
</html>
