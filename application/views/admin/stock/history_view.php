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
                  <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                          <th>Vendor</th>
                          <th>Product</th>
                          <th>Invoice</th>
                          <th>Old Stock</th>
                          <th>New Stock</th>
                          <th>Purchase Date</th>
                          <th>Expiry Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($history as $his) {?>
                        <tr>
                          <td><?php echo @$vendor;?></td>
                          <td><?php echo @$his->product;?></td>
                          <td><?php echo @$his->history_invoice_no;?></td>
                          <td><?php echo @$his->history_old_stock;?></td>
                          <td><?php echo @$his->history_new_stock;?></td>
                          <td><?php echo @$his->history_pur_date;?></td>
                          <td><?php echo @$his->history_exp_date;?></td>
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

</html>