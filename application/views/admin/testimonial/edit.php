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
                  <h4 class="page-title float-left">Edit Testimonial</h4>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card-box">
                <form action="<?=site_url('admin/testimonial/update')?>" method="post" id="add-form" enctype="multipart/form-data">
                   <input type="hidden" name="testimonial_id" value="<?=$testimonial->id?>">
                  <div class="row">
                      <div class="col-md-4">
                          <div class="">
                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Name</p>
                                  <input id="name" class="form-control" name="name" placeholder="Name" required="required" value="<?php echo @$testimonial->name;?>" type="text">
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Position</p>
                                   <input id="position" class="form-control" name="position" placeholder="Position" value="<?php echo @$testimonial->position;?>" required="required" type="text">
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Description</p>
                                   <textarea id="description" required="required" name="description" class="form-control col-md-7 col-xs-12" rows="5"><?php echo @$testimonial->description;?></textarea>
                              </div>

                                <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Status</p>
                                  <select class="form-control" name="status">
                                    <option value="Active" <?php if($testimonial->status){?>selected<?php } ?>>Active</option>
                                    <option value="Blocked" <?php if(!$testimonial->status){?>selected<?php } ?>>Blocked</option>
                                  </select>
                                  <!-- <input class="sample_input" type="hidden" name="test[image]"> -->
                              </div>

                              
                               <div>
                                  <p class="mb-1 mt-4 font-weight-bold"> Image</p>
                                  <input type="file" class="form-control" id="upload">
                                  <!-- <input class="sample_input" type="hidden" name="test[image]"> -->
                              </div>

                          </div>
                      </div>

                      <div class="col-md-8">
                        <div id="current-image">
                          <img src="<?=base_url() . $testimonial->image?>" height="250px" width="450px">
                        </div>
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
                        <button type="submit" class="btn btn-success btn-rounded waves-light waves-effect w-md pull-right" id="submit-button">Update</button>
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
  $uploadCrop = $('#upload-demo').croppie({
      enableExif: true,
      viewport: {
          width: 450,
          height: 250,
          type: 'rectangle'
      },
      boundary: {
          width: 600,
          height: 600
      }
  });


  $('#upload').on('change', function () {
    $("#submit-button").css("display", "none");
    var file = $("#upload")[0].files[0];
    var val = file.type;
    var type = val.substr(val.indexOf("/") + 1);
    if (type == 'png' || type == 'jpg' || type == 'jpeg') {

      $("#current-image").css("display", "none");
      $("#submit-button").css("display", "none");

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
      $("#current-image").css("display", "block");
      $('#ameimg').val('');
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
  </script>
 
</html>
