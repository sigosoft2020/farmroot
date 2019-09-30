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
                  <h4 class="page-title float-left">Product Details</h4>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-8">
                <div class="card-box table-responsive">
                  <table id="user_data" class="table">
                    <tbody>
                      <tr>
                        <td><b>Product Name</b></td>
                        <td><?php echo @$product->product_name;?></td>
                      </tr>
                      <tr>
                        <td><b>Quantity</b></td>
                        <td><?php echo @$product->quantity;?></td>
                      </tr>
                        <tr>
                        <td><b>Price</b></td>
                        <td><?php echo @$product->price;?></td>
                      </tr>
                        <tr>
                        <td><b>Category</b></td>
                        <td><?php echo @$product->categoty;?></td>
                      </tr>
                        <tr>
                        <td><b>Description</b></td>
                        <td><?php echo @$product->product_description;?></td>
                      </tr>
                      <tr>
                        <td><b>Status</b></td>
                        <td><?php echo @$product->status;?></td>
                      </tr>
                       
                    </tbody>
                  </table>
                </div>
            </div>
            
            <div class="col-md-4">
               <div id="current-image">
                  <img src="<?=base_url() . $product->image?>" height="250px" width="300px">
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
