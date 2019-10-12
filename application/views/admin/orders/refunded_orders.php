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
                  <h4 class="page-title float-left">Refunded Orders</h4>
                  
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
                          <th width="10%">Order No</th>
                          <th width="10%">Invoice No</th>                          
                          <th width="10%">Name</th>
                          <th width="10%">Email</th>
                          <th width="10%">Mobile</th>
                          <th width="5%">Grand Total</th>
                          <th width="5%">Refund Total</th>
                          <th width="5%">Payment Mode</th>
                          <th width="15%">Reason</th>
                          <th width="10%">Payment Id</th>
                          <th width="5%">Order View</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($refunded as $ref) {?>
                       <tr>
                          <td><?php echo $ref->order_no;?></td>
                          <td><?php echo $ref->invoice_no;?></td>
                          <td><?php echo $ref->BillingDet_Name;?></td>
                          <td><?php echo $ref->BillingDet_Email;?></td>
                          <td><?php echo $ref->BillingDet_Phone;?></td>
                          <td><?php echo $ref->GrandTotal;?></td>
                          <td><?php echo $ref->refund_total;?></td>
                          <td><?php echo $ref->mode_of_pay;?></td>
                          <td><?php echo $ref->reason;?></td>
                          <td><?php echo $ref->payment_code;?></td>
                           <td><a href="<?=site_url('admin/orders/refunded_order_view/'.$ref->order_no)?>"><i class="fa fa-eye"></i></a></td>
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
    function del()
    {
      if (confirm('Are you sure to delete this banner ?')) {
        return true;
      }
      else {
        return false;
      }
    }

   function updater(order_id)
    {
      document.getElementById('o_id').value = order_id;
    }

  </script>
   <script>
         $('#datatable').DataTable({
            "order": [[ 0, "desc" ]], //or asc 
            "columnDefs" : [{"targets":3, "type":"date-eu"}],
        });
    </script>
</html>
