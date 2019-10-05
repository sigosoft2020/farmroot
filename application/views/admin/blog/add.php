<!DOCTYPE html>
<html>
  <head>
    <?php $this->load->view('admin/includes/includes.php'); ?>
    <?php $this->load->view('admin/includes/table-css.php'); ?>
    <link rel="stylesheet" href="<?=base_url()?>plugins/image-crop/croppie.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
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
                  <h4 class="page-title float-left">Add Blog</h4>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card-box">
                <form action="<?=site_url('admin/blog/addBlog')?>" method="post" id="add-form">

                   <div class="row">
                      <div class="col-md-6">
                          <div class="">
                             <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Blog Category</p>
                                  <select name="category" class="form-control" required>
                                    <option value="">---Select Category---</option>
                                    <?php foreach($category as $cat) {?>
                                    <option value="<?php echo $cat->cat_id;?>"><?php echo $cat->cat_name;?></option>
                                    <?php };?>
                                  </select>
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Products</p>
                                  <select class="js-example-basic-multiple" name="products[]" multiple="multiple" required>
                                    <option value="">---Select Products---</option>
                                    <?php foreach($products as $pr) {?>
                                    <option value="<?php echo $pr->ProductID;?>"><?php echo $pr->ProductName;?></option>
                                    <?php };?>
                                  </select>
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Blog Name</p>
                                  <input type="text" maxlength="25" name="name" class="form-control" placeholder="Blog Name" required>
                              </div>
                              
                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Short Description</p>
                                  <textarea type="text" rows="3" name="short_description" class="form-control" placeholder="Short Description" required></textarea>
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Long Description</p>
                                  <textarea type="text" rows="5" name="long_description" class="form-control" placeholder="Long Description" required></textarea>
                              </div>

                               <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Blog Image</p>
                                  <input type="file" class="form-control" id="upload">
                                  <!-- <input class="sample_input" type="hidden" name="test[image]"> -->
                              </div>

                              
                              <br><br>
                          </div>
                      </div>

                      <div class="col-md-6">
                          <div class="upload-div" style="display:none;">
                            <div id="upload-demo"></div>
                            <div class="col-12 text-center">
                              <a href="#" class="btn btn-primary btn-flat" style="border-radius : 5px;" id="crop-button">Crop</a>
                            </div>
                          </div>
                          <div class="upload-result text-center" id="upload-result" style="display : none; margin-bottom:10px;">

                          </div>
                          <input type="hidden" name="image" id="ameimg" >
                        </div>

                        <div class="col-md-12 mt-4">
                          <button type="submit" class="btn btn-success btn-rounded waves-light waves-effect w-md pull-left" id="submit-button" style="display:none;">Add</button>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
  <script src="<?=base_url()?>plugins/image-crop/croppie.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
  </script>
  <script type="text/javascript">
  $uploadCrop = $('#upload-demo').croppie({
      enableExif: true,
      viewport: {
          width: 450,
          height: 250,
          type: 'rectangle'
      },
      boundary: {
          width: 500,
          height: 500
      }
  });


  $('#upload').on('change', function () {
    $("#submit-button").css("display", "none");
    var file = $("#upload")[0].files[0];
    var val = file.type;
    var type = val.substr(val.indexOf("/") + 1);
    if (type == 'png' || type == 'jpg' || type == 'jpeg') {
      $(".upload-div").css("display", "block");
      $("#submit-button").css("display", "none");
      var reader = new FileReader();
        reader.onload = function (e) {
          $uploadCrop.croppie('bind', {
            url: e.target.result
          }).then(function(){
            console.log('jQuery bind complete');
          });

        }
        reader.readAsDataURL(this.files[0]);
    }
    else {
      alert('This file format is not supported.');
      document.getElementById("upload").value = "";
      $("#upload-result").css("display", "none");
      $("#submit-button").css("display", "none");
    }
  });


  $('#crop-button').on('click', function (ev) {
      $("#submit-button").css("display", "block");
    $uploadCrop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function (resp) {
      html = '<img src="' + resp + '" />';
      $("#upload-result").html(html);
      $("#upload-result").css("display", "block");
      $(".upload-div").css("display", "none");
      $("#submit-button").css("display", "block");
      $('#ameimg').val(resp);
    });
  });
  
  $('#add-form').on('submit', function(e){
    e.preventDefault();
    $('#submit-button').attr('disabled',true);
    document.getElementById("add-form").submit();
  });
  </script>
</html>
