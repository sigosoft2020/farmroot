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
            <div class="col-10">
                <div class="card-box table-responsive">
                  <table id="user_data" class="table">
                    <tbody>
                      <tr>
                        <td><b>Product Name</b></td>
                        <td><?php echo @$product->ProductName;?></td>
                      </tr>
                      <tr>
                        <td><b>Malayalam Name</b></td>
                        <td><?php echo @$product->malayalam_name;?></td>
                      </tr>
                      <tr>
                        <td><b>Manglish Name</b></td>
                        <td><?php echo @$product->manglish_name;?></td>
                      </tr>
                      <tr>
                        <td><b>Price</b></td>
                        <td><?php echo @$product->ProductMRP;?></td>
                      </tr>
                      <tr>
                        <td><b>Product Unit</b></td>
                        <td><?php echo @$product->ProductUnit;?></td>
                      </tr>
                      <tr>
                        <td><b>Category</b></td>
                        <td><?php echo @$product->categoty;?></td>
                      </tr>
                      <tr>
                        <td><b>Subcategory</b></td>
                        <td><?php echo @$product->subcategoty;?></td>
                      </tr>
                      <tr>
                        <td><b>Brand</b></td>
                        <td><?php echo @$product->brand;?></td>
                      </tr>
                      <tr>
                        <td><b>Quantity</b></td>
                        <td><?php echo @$product->ProductStock;?></td>
                      </tr>  
                      <tr>
                        <td><b>SGST</b></td>
                        <td><?php echo @$product->sgst;?></td>
                      </tr>  
                      <tr>
                        <td><b>CGST</b></td>
                        <td><?php echo @$product->cgst;?></td>
                      </tr>                        
                      <tr>
                        <td><b>Description</b></td>
                        <td><?php echo @$product->description;?></td>
                      </tr>
                      <tr>
                        <td><b>Recipe</b></td>
                        <td><?php echo @$product->recipe;?></td>
                      </tr>
                      <tr>
                        <td><b>Product Type</b></td>
                        <td><?php echo @$product->product_type;?></td>
                      </tr>
                      <tr>
                        <td><b>Manufacturing Date</b></td>
                        <td><?php echo @$product->manufacturing_date;?></td>
                      </tr>
                      <tr>
                        <td><b>Expiry Date</b></td>
                        <td><?php echo @$product->expiry_date;?></td>
                      </tr>
                      <tr>
                        <td><b>Status</b></td>
                        <td><?php echo @$product->ProductStatus;?></td>
                      </tr>
                       
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
