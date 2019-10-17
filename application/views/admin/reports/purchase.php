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
                  <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                          <th>Invoice No</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Mobile</th>
                          <th>Grand Total</th>
                          <th>Date</th>
                          <th>View Items</th>                                          
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($purchase as $pur) {?>
                        <tr>
                          <td><?php echo $pur->VInvoiceNO;?></td>
                          <td><?php echo $pur->VendorName;?></td>
                          <td><?php echo $pur->Email?></td>
                          <td><?php echo $pur->Phone;?></td>
                          <td><?php echo $pur->VGrandTotal;?></td>
                          <td><?php $Timed=$pur->Vtimestamp;
                           echo date("jS F, Y", strtotime("$Timed")); ?></td>
                          <td><a href="<?=site_url('admin/reports/view_purchase/'.$pur->VpurchaseID)?>"><li class="fa fa-eye"></li></a></td>
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
