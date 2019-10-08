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
                  <h4 class="page-title float-left">Vendors</h4>

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
                        <th width="35%">Product Name</th>                                     <th width="10%">Brand</th>
                        <th width="10%">Category</th>   
                        <th width="5%">Product Stock</th>
                        <th width="5%">Rate(₹)</th>
                        <th width="10%">Manufacture Date</th>
                        <th width="10%">Expiry Date</th>
                        <th width="10%">Batch No</th>
                        <!-- <th width="10%">Total Value</th> -->
                        <th width="5%">Add Stock</th>
                      </tr>
                    </thead>
                  </table>
                </div>
            </div>
          </div>
        </div>
      </div>
      <?php $this->load->view('admin/includes/footer.php'); ?>

    <div id="add-stock" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h4 class="modal-title">Add Stock</h4>
          </div>

          <div class="modal-body">
            <div class="form-group clearfix">

             <form method="POST" action="<?=site_url('admin/Stock/addStock')?>">
               <div class="container">
                  <div class="row">
                    <div class="col-md-6">
                      <label>Current Stock</label>  
                      <input type="number" id="current_stock" name="current_stock" class="form-control" readonly>
                    </div>

                    <div class="col-md-6">
                      <label>New Stock</label>  
                      <input type="number" min="0" name="new_stock" class="form-control" id="new_stock" required>
                    </div>
                    <br>

                    <div class="col-md-1">
                      <input type="hidden" id="product_id" name="product_id" class="form-control"><br>
                      <input type="submit" id="add_stock" name="submit" class="btn btn-success" value="Submit"> 
                     <!--  <button type="submit" id="add_stock"  class="btn btn-success" onclick="btn_sub();">Submit</button> -->
                    </div>

                  </div>
                </div>
              </form>
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
          url:"<?=site_url('admin/stock/get')?>",
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
    function add(id,stock)
    {
      $('#product_id').val(id);
      $('#current_stock').val(stock);
      
      $('#add-stock').modal('show');
    }
  </script>
</html>