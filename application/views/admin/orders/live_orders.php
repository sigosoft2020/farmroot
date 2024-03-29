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
                  <h4 class="page-title float-left">Live Orders</h4>
                  
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
                          <th width="5%">Order No</th>
                          <th width="5%">Invoice No</th>
                          <th width="15%">Name</th>
                          <th width="10%">Email</th>
                          <th width="10%">Mobile</th>
                          <th width="5%">Grand Total</th>
                          <th width="5%">Status</th>
                          <th width="10%">Type Of Sale</th>
                          <th width="5%">View</th>
                          <th width="5%">Update</th>
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
              <form method="POST" action="<?=site_url('admin/orders/update')?>">
                  <input type="hidden" name="order_id" id="o_id">
                  <select class="form-control" name="status">
                      <option value="Packed">Packed</option>     
                      <option value="Dispatched">Dispatched</option>        
                      <option value="Delivered">Delivered</option>        
                      <option value="Cancelled">Cancelled</option> 
                      <option value="Returned">Returned</option>        
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
          url:"<?=site_url('admin/orders/get')?>",
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
