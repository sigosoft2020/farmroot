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
                        <th width="60%">Product name</th>
                        <th width="20%">Stock</th>
                        <th width="20%">Add Stock</th>

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
                      <input type="number" id="current_stock" name="current_stock" class="form-control" readonly name="current_stock">
                    </div>

                    <div class="col-md-6">
                      <label>New Stock</label>  
                      <input type="number" min="0" name="new_stock" class="form-control" id="new_stock" required>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                          <label>Vendor Name</label>
                          <select id="vendor" class="form-control" name="vendor_id" required>
                               <option value="">---Select Vendor---</option>
                                <?php 
                                foreach($vendors as $vendor)
                                { ?>
                                 <option value="<?=$vendor->vender_id?>"><?=$vendor->vendor_name?></option>
                                <?php }; ?>
                          </select>
                          <p id="warn3" style="color: red;" ></p>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <label>Invoice No</label>  
                      <input type="text" id="invoice_no" class="form-control" name="invoice_no" required>
                    </div>

                    <div class="col-md-6">
                      <label>Purchase Date</label>  
                      <input type="date" id="theDate" class="form-control" name="purchase_date" required>
                    </div>

                    <div class="col-md-6">
                      <label>Expiry Date</label>  
                      <input type="date" id="edate" class="form-control" name="expiry_date" required>
                      <p id="warn4" style="color: red;" ></p>
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