<!DOCTYPE html>
<html>
  <head>
    <?php $this->load->view('admin/includes/includes.php'); ?>
    <?php $this->load->view('admin/includes/table-css.php'); ?>
    <link rel="stylesheet" href="<?=base_url()?>plugins/image-crop/croppie.css">
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
                  <h4 class="page-title float-left">Stock History</h4>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card-box">
                <form action="<?=site_url('admin/Stock/get_stock')?>" method="post" id="add-form">

                   <div class="row">
                      <div class="col-md-4">
                          <div class="">
                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Select Vendor</p>
                                  <br>
                                  <select id="vendor" class="form-control" name="vendor_id" required>
                                     <option value="">---Select Vendor---</option>
                                      <?php 
                                      foreach($vendors as $vendor)
                                      { ?>
                                       <option value="<?=$vendor->vender_id?>"><?=$vendor->vendor_name?></option>
                                      <?php }; ?>
                                </select>
                              </div>

                          </div>
                      </div>

                      <div class="col-md-12 mt-4">
                        <button type="submit" class="btn btn-success btn-rounded waves-light waves-effect w-md pull-left" id="submit-button">Submit</button>
                      </div>
                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php $this->load->view('admin/includes/footer.php'); ?>
    </div>
  </body>
  <?php $this->load->view('admin/includes/scripts.php'); ?>
 
</html>
