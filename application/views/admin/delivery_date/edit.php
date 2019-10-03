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
                  <h4 class="page-title float-left">Edit Delivery Date</h4>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card-box">
                <form action="<?=site_url('admin/delivery_date/update')?>" method="post" id="add-form" enctype="multipart/form-data" onsubmit="return finalize()">

                   <div class="row">
                      <div class="col-md-6">
                          <div class="">
                              <input type="hidden" name="delivery_id" value="<?php echo $date->delivery_id;?>">
                              <div>
                                  <label for="select">Category</label>
                                  <select class="form-control" name="category" required>
                                     <option value="Vegetables" <?php if($date->category=='Vegetables'){?>selected <?php }; ?>>Vegetables</option>
                                     <option value="Non Vegetables" <?php if($date->category=='Non Vegetables'){?> selected <?php }; ?>>Non Vegetables</option>
                                  </select>
                              </div>
                              <br>
                              <div>
                                  <label for="select">Delivery Date</label>
                                  <input type="date" value="<?php echo $date->delivery_date;?>" name="delivery_date" id="delivery_date" class="form-control" required>
                              </div>
                              
                              <div class="form-group m-b-25">
                                <div class="col-12">
                                    <p id="error-message" style="color:red;"></p>
                                </div>
                              </div>
                          
                          </div>
                      </div>
                      <div class="col-md-12 mt-4">
                        <button type="submit" class="btn btn-success btn-rounded waves-light waves-effect w-md" id="submit-button">Update</button>
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
  <script src="<?=base_url()?>plugins/image-crop/croppie.js"></script>
  <script type="">
    function finalize()
    {
        var end    = $('#delivery_date').val();
        var myDate = new Date(end);
        var today  = new Date();
        
        if (myDate < today) {
          $('#error-message').text('Please select valid date');
          $('#error-message').fadeIn().delay(1500).fadeOut(1200);
          return false;
        }
        else {
          $('#error-message').text('');
          return true;
          
          }
    }
  </script>
</html>
