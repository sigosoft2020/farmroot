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
                  <h4 class="page-title float-left">Product Images</h4>
                     <ol class="breadcrumb float-right">
                       <button type="button" class="btn btn-gradient btn-rounded waves-light waves-effect w-md" data-toggle="modal" data-target="#add-image">Add more images</button>
                     </ol>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>

           <div class="row">
            <div class="col-12">
                <div class="card-box">
                  <div class="container">

                    <div class="row text-center text-lg-left">
                      <?php $i=1; foreach ($images as $image) { ?>
                        <div class="col-lg-3 col-md-4 col-xs-6">
                          <a href="#" class="d-block mb-4 h-100">
                            <img class="img-fluid img-thumbnail" id="<?php echo 'image'.$i; ?>" src="<?=base_url().$image->Image?>" alt="record missing" onclick="showImage(this,<?=$image->ImageID?>)">
                          </a>
                        </div>
                      <?php $i++; } ?>
                    </div>

                </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      <?php $this->load->view('admin/includes/footer.php'); ?>
    </div>
    
       <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"><?=$product?></h4>
              </div>
              <div class="modal-body">
                <img src="" id="modal-image" class="img-fluid" >
              </div>
              <div class="modal-footer">
                <form action="<?=site_url('admin/products/deleteImage')?>" method="post" id="delete-form" onsubmit="return deleteConfirm()">
                  <input type="hidden" name="delete_id" id="delete_id">
                  <button type="submit" class="btn btn-danger">Delete</button>
                </form>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <div id="add-image" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
           <div class="modal-dialog">
               <div class="modal-content">

                   <div class="modal-body">
                       <h2 class="text-uppercase text-center m-b-30">
                           <span><h4>Add image</h4></span>
                       </h2>

                       <form class="form-horizontal" action="<?=site_url('admin/products/addImage')?>" method="post" enctype="multipart/form-data">
                           <input type="hidden" name="product_id" value="<?=$product_id?>">
                           <div class="form-group m-b-25">
                               <div class="col-12">
                                   <label for="select">Upload image</label>
                                   <input type="file" name="image" id="image" class="form-control" onchange="preview_image(this)" required>
                               </div>
                           </div>
                           <div class="form-group">
                               <div class="col-12">
                                 <div id="bank-image"><img id="output" width="100%" style="padding-top:5px;"/></div>
                                 <p>(Note - dimensions 600*600)</p>
                               </div>
                           </div>
                           <div class="form-group account-btn text-center m-t-10">
                               <div class="col-12">
                                   <button type="reset" class="btn w-lg btn-rounded btn-light waves-effect m-l-5" data-dismiss="modal">Back</button>
                                   <button class="btn w-lg btn-rounded btn-primary waves-effect waves-light" type="submit">Add</button>
                               </div>
                           </div>
                       </form>

                   </div>
               </div><!-- /.modal-content -->
           </div><!-- /.modal-dialog -->
       </div>

  </body>
  <?php $this->load->view('admin/includes/scripts.php'); ?>
  <?php $this->load->view('admin/includes/table-script.php'); ?>
  <script type="">
     function showImage(param,image_id)
      {
        $('#delete_id').val(image_id);
        var modalImg = document.getElementById("modal-image");
        modalImg.src = param.src;
        $('#imagemodal').modal('show');
      }

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
              var output = document.getElementById('output');
              output.src = reader.result;
            }
            reader.readAsDataURL(x.files[0]);
          }
        }
      }
      function deleteConfirm()
      {
        if (confirm("Are you sure to delete this image?")) {
          return true;
        }
        else {
          return false;
        }
      }
  </script>
  
</html>
