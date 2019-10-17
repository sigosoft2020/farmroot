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
                  <h4 class="page-title float-left">Tele order Payments</h4>
                  
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                  <form method="post" action="<?=site_url('admin/payment/tele_orders')?>">
                    <div class="row">                   
                      <div class="col-md-3">
                        <div class="form-group">
                          <input type="date" name="date" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <button type="submit" name="submit" class="btn btn-success btn-rounded waves-light waves-effect w-md">Submit</button>
                      </div>                   
                    </div>
                  </form>  
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
                          <th>Grand Total</th>                                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php $total =0; foreach($tele_orders as $tele) {?>
                        <tr>
                          <td><?php echo $tele->OrderNO;?></td>
                          <td><?php echo $tele->InvoiceNO;?></td>
                          <td><?php echo $tele->BillingDet_Name?></td>
                          <td><?php echo $tele->BillingDet_Email;?></td>
                          <td><?php echo $tele->BillingDet_Phone;?></td>
                          <td><?php echo $tele->GrandTotal; ?></td>
                       </tr>

                      <?php  $total += $tele->GrandTotal; };?>
                    </tbody>
                  </table>
                  
                  <div class="p-0 col-md-2 col-sm-12 col-xs-12 float-right">
                     <label>Total</label>
                     <input class="form-control float-right" name="Total" placeholder="" type="text" id="Total" value="<?php echo $total; ?>">
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
