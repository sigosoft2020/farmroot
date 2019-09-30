<!DOCTYPE html>
<html>
  <head>
    <?php $this->load->view('owner/includes/includes.php'); ?>
    <?php $this->load->view('owner/includes/table-css.php'); ?>
    <link rel="stylesheet" href="<?=base_url()?>assets/css/vendor/select2.min.css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/css/vendor/select2-bootstrap.min.css" />
  </head>
  <body>
    <div id="wrapper">
      <?php $this->load->view('owner/includes/sidebar.php'); ?>
      <div class="content-page">
        <div class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="page-title-box">
                  <h4 class="page-title float-left">DASHBOARD</h4>
                  <!-- <ol class="breadcrumb float-right">
                    <button type="button" class="btn btn-gradient btn-rounded waves-light waves-effect w-md">Add amenity</button>
                  </ol> -->
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Enter mobile number of customer</label>
                        <input type="number" min="0" max="9999999999" name="mobile" class="form-control">
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      <?php $this->load->view('owner/includes/footer.php'); ?>
    </div>
  </body>
  <?php $this->load->view('owner/includes/scripts.php'); ?>
  <?php $this->load->view('owner/includes/table-script.php'); ?>

  <script src="<?=base_url()?>assets/js/vendor/select2.full.js"></script>
</html>
