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
                  <h4 class="page-title float-left">Edit Customer</h4>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card-box">
                <form action="<?=site_url('admin/customer/update')?>" method="post" id="add-form" enctype="multipart/form-data">

                   <div class="row">
                      <div class="col-md-6">
                          <div class="">
                              <input type="hidden" name="customer_id" value="<?php echo $customer->user_id;?>">
                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Name<span>*</span></p>
                                  <input type="text" maxlength="25" name="name" class="form-control" placeholder="Name" value="<?php echo @$customer->name;?>" required>
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Mobile<span>*</span></p>
                                  <input type="text" maxlength="13" name="mobile" class="form-control" placeholder="Mobile" value="<?php echo @$customer->phone;?>" required>
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Email<span>*</span></p>
                                  <input type="email" name="email" placeholder="Email" class="form-control" value="<?php echo @$customer->email;?>" required>
                              </div>
                              
                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Address<span>*</span></p>
                                  <textarea type="text" name="address" placeholder="Address" class="form-control" rows="4" required><?php echo @$customer->address;?></textarea> 
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Status<span>*</span></p>
                                  <select  name="status" class="form-control">
                                    <option value="Active" <?php if($customer->status == 'Active'){?>selected<?php } ?> >Active</option>
                                    <option value="Blocked" <?php if($customer->status == 'Blocked'){?>selected<?php } ?> >Blocked</option>
                                  </select>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-12 mt-4">
                        <button type="submit" class="btn btn-success btn-rounded waves-light waves-effect w-md" id="submit-button">Add</button>
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
