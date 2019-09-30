<!DOCTYPE html>
<html>
  <head>
    <?php $this->load->view('unani/includes/includes.php'); ?>
    <?php $this->load->view('unani/includes/table-css.php'); ?>
    <link rel="stylesheet" href="<?=base_url()?>plugins/image-crop/croppie.css">
  </head>
  <body>
    <div id="wrapper">
      <?php $this->load->view('unani/includes/sidebar.php'); ?>
      <div class="content-page">
        <div class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="page-title-box">
                  <h4 class="page-title float-left">Add Library</h4>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card-box">
                <form action="<?=site_url('unani/library/addLibrary')?>" method="post" id="add-form" enctype="multipart/form-data">

                  <div class="row">
                      <div class="col-md-4">
                          <div class="">
                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Tile<span>*</span></p>
                                  <input id="name" class="form-control" name="name" placeholder="Name" required="required" type="text" required>
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Description<span>*</span></p>
                                   <textarea id="description" required="required" name="description" class="form-control col-md-7 col-xs-12" rows="5" required></textarea>
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Attachment(Full)<span>*</span></p>
                                    <input type="file" class="form-control" name="full" id="full" onchange="preview_file(this)" required>
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Attachment(Preview)<span>*</span></p>
                                    <input type="file" class="form-control" name="preview" id="preview" onchange="preview_file(this)" required>
                              </div>
                              
                               <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Cover Image<span>*</span></p>
                                  <input type="file" class="form-control" id="upload">
                                  <!-- <input class="sample_input" type="hidden" name="test[image]"> -->
                              </div>

                          </div>
                      </div>

                      <div class="col-md-8">
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
                        <button type="submit" class="btn btn-success btn-rounded waves-light waves-effect w-md pull-right" id="submit-button" style="display:none;">Add</button>
                      </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php $this->load->view('unani/includes/footer.php'); ?>
    </div>
  </body>
  <?php $this->load->view('unani/includes/scripts.php'); ?>
  <script src="<?=base_url()?>plugins/image-crop/croppie.js"></script>
  <script type="">
  function preview_file(id)
     {
       var id = id.id;
       var x = document.getElementById(id);
       var size = x.files[0].size;
       if (size > 50000000) {
         alert('Please select a file with size less than 5 mb.');
         document.getElementById(id).value = "";
       }
       else {
         var val = x.files[0].type;
         var type = val.substr(val.indexOf("/") + 1);
         s_type = ['pdf','doc','docx'];
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

       }
     }
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
