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
                  <h4 class="page-title float-left">Edit Products</h4>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card-box">
                <form action="<?=site_url('admin/Products/update')?>" method="post" id="add-form" enctype="multipart/form-data">
                  <input type="hidden" name="product_id" class="form-control" value="<?=$product->product_id?>">
                   <div class="row">
                      <div class="col-md-6">
                          <div class="">
                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Product Name<span>*</span></p>
                                  <input type="text" maxlength="25" name="name" class="form-control" value="<?php echo @$product->product_name;?>" required>
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Category<span>*</span></p>
                                  <select id="category" class="form-control" name="category_id" required>
                                    <?php foreach ($category as $cat) { ?>
                                      <option value="<?=$cat->category_id?>" <?php if($product->category_id == $cat->category_id){ echo "selected"; }?>><?=$cat->category_name?></option>
                                    <?php } ?>
                                 </select>
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Quantity<span>*</span></p>
                                  <input type="text" maxlength="15" name="quantity" class="form-control" value="<?php echo @$product->quantity;?>" required>
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Price<span>*</span></p>
                                  <input type="number" min="0" name="price" value="<?php echo @$product->price;?>" class="form-control" required>
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">B2B Percentage<span>*</span></p>
                                  <input type="text" maxlength="25" id="b2b_percentage" name="b2b_percentage" class="form-control" value="<?php echo @$product->b2b_percentage;?>" required>
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">B2B Price<span>*</span></p>
                                  <input type="text" maxlength="25" id="b2b_price" name="b2b_price" value="<?php echo @$product->b2b_price;?>" class="form-control" required>
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Description<span>*</span></p>
                                   <textarea id="description" required="required" name="description" class="form-control col-md-7 col-xs-12" rows="5"><?php echo @$product->product_description;?></textarea>
                              </div>

                               <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Indication<span>*</span></p>
                                   <textarea id="indication" required="required" name="indication" class="form-control col-md-7 col-xs-12" rows="5"><?php echo @$product->indication;?></textarea>
                               </div>
                               <br>
                              <div>
                                <img src="<?=base_url() . $product->image?>" height="250px" width="300px"><br><br>
                                <input type="file" id="image" name="image" class="form-control col-md-7 col-xs-12" onchange="preview_image(this)">
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Status<span>*</span></p>
                                  <select  name="status" class="form-control">
                                    <option value="Active" <?php if($product->status == 'Active'){?>selected<?php } ?> >Active</option>
                                    <option value="Disabled" <?php if($product->status == 'Disabled'){?>selected<?php } ?> >Blocked</option>
                                  </select>
                              </div>

                              <br><br>
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

  <script type="text/javascript">
    function preview_image(id)
      {
        var id = id.id;
        var x = document.getElementById(id);
        var size = x.files[0].size;
        if (size > 5000000) {
          alert('Please select an image with size less than 5 mb.');
          document.getElementById(id).value = "";
        }
        else {
          var val = x.files[0].type;
          var type = val.substr(val.indexOf("/") + 1);
          s_type = ['jpeg','jpg','png'];
          var flag = 0;
          for (var i = 0; i < s_type.length; i++) {
            if (s_type[i] == type) {
              flag = flag + 1;
            }
          }
          if (flag == 0) {
            alert('This file format is not supported.');
            document.getElementById(id).value = "";
          }
          else {
            var reader = new FileReader();
            reader.onload = function()
            {
              var cn = id.substring(3);
              var preview = 'preview' + cn;
              var output = document.getElementById(preview);
              output.src = reader.result;
            }
            reader.readAsDataURL(x.files[0]);
          }
        }
      }
  </script>

  <script type="">
      $('#b2b_price').on('change',function(){
          var cat_id = $("#b2b_price option:selected").val();
          document.getElementById("b2b_percentage").disabled = true;
          
       });
       
        $('#b2b_percentage').on('change',function(){
         var cat_id = $("#b2b_percentage option:selected").val();
           document.getElementById("b2b_price").disabled = true;
          
       });
    </script>
</html>
