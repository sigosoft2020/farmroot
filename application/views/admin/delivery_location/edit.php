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
                  <h4 class="page-title float-left">Edit Delivery Slot</h4>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card-box">
                <form action="<?=site_url('admin/delivery_slot/update')?>" method="post" id="add-form" enctype="multipart/form-data">

                   <div class="row">
                      <div class="col-md-6">
                          <div class="">
                              <input type="hidden" name="slot_id" value="<?php echo $slot->slot_id;?>">
                              <div>
                                  <label for="select">Category</label>
                                  <select class="form-control" name="category" required>
                                     <option value="Vegetables" <?php if($slot->category=='Vegetables'){?>selected <?php }; ?>>Vegetables</option>
                                     <option value="Non Vegetables" <?php if($slot->category=='Non Vegetables'){?> selected <?php }; ?>>Non Vegetables</option>
                                  </select>
                              </div>
                              <br>
                              <div>
                                  <label for="select">Delivery Slot</label>
                                  <input type="text" value="<?php echo $slot->delivery_slot;?>" name="delivery_slot" id="delivery_slot" class="form-control" required>
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
</html>
