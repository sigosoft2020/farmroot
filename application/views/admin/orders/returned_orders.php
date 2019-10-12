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
                  <h4 class="page-title float-left">Returned Orders</h4>
                  
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                  <table id="user_data" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                          <th>Order No</th>
                          <th>Invoice No</th>                          
                          <th>Name</th>
                          <th>Email</th>
                          <th>Mobile</th>
                          <th>Grand Total</th>
                          <th>Refund Total</th>
                          <th>Payment Mode</th>
                          <th>Reason</th>
                          <th>Payment Id</th>
                          <th>Order View</th>
                          <th>Refund</th>
                      </tr>
                    </thead>
                  </table>
                </div>
            </div>
          </div>

        </div>
      </div>
      <?php $this->load->view('admin/includes/footer.php'); ?>

      <div class="modal fade" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
              <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Update Status</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

              <!-- Modal body -->
            <div class="modal-body">
              <form method="POST" action="<?=site_url('admin/orders/refund_update')?>">
                  <input type="hidden" name="order_id" id="o_id">
                  <select class="form-control" name="status">
                      <option value="Returned">Refunded</option>       
                  </select>  
            </div>

              <!-- Modal footer -->
            <div class="modal-footer">
              <button type="submit" class="btn btn-success" name="update">Update</button>
            </div>
            </form>
            
            </div>
          </div>
      </div>

    </div>
  </body>
  <?php $this->load->view('admin/includes/scripts.php'); ?>
  <?php $this->load->view('admin/includes/table-script.php'); ?>
  <script type="text/javascript">
    $(document).ready(function(){
      var dataTable = $('#user_data').DataTable({
        "processing":true,
        "serverSide":true,
        "order":[],
        "ajax":{
          url:"<?=site_url('admin/orders/get_returned')?>",
          type:"POST"
        },
        "columnDefs":[
          {
            "target":[0,3,4],
            "orderable":true
          }
        ]
      });
    });
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
</html>
