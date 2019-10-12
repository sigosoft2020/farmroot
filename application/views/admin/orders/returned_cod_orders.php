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
                  <h4 class="page-title float-left">Returned COD Orders</h4>
                  
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                  <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                          <th>Order No</th>
                          <th>Invoice No</th>                          
                          <th>Name</th>
                          <th>Email</th>
                          <th>Mobile</th>
                          <th>Refund Total</th>
                          <th>Payment Mode</th>
                          <th>Bank</th>
                          <th>Account Number</th>
                          <th>IFSC Code</th>
                          <th>Order View</th>                          
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($returned_cod as $cod) {?>
                        <tr>
                          <td><?php echo $cod->order_no;?></td>
                          <td><?php echo $cod->invoice_no;?></td>
                          <td><?php echo $cod->BillingDet_Name;?></td>
                          <td><?php echo $cod->BillingDet_Email;?></td>
                          <td><?php echo $cod->BillingDet_Phone;?></td>
                          <td><?php echo $cod->refund_total;?></td>
                          <td><?php echo $cod->mode_of_pay;?></td>
                          <td><?php echo $cod->bank;?></td>
                          <td><?php echo $cod->account_no;?></td>
                          <td><?php echo $cod->ifsc_code;?></td>
                          <td><a href="<?=site_url('admin/orders/returned_order_view/'.$cod->order_no)?>"><i class="fa fa-eye"></i></a></td>
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
