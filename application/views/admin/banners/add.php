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
                  <h4 class="page-title float-left">Add Banner</h4>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card-box">
                <form action="<?=site_url('admin/banner/addBanner')?>" method="post" id="add-form" enctype="multipart/form-data">

                  <div class="row">
                      <div class="col-md-4">
                          <div class="">
                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Select Item</p>
                                   <select name="slt" id="slt" class="form-control" >
                                      <option value="">---Select Item---</option> 
                                      <option value="1">Product</option> 
                                      <option value="0">Category</option>                    </select> 
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Item</p>
                                   <select name="data" id="data" class="form-control" >
                                      <option value="">---Select Item---</option> 
                                    
                                  </select> 
                              </div>

                               <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Possition</p>
                                    <select class="form-control col-md-7 col-xs-12" name="position" >
                                      <option  value="1">1</option>
                                      <option  value="2">2</option>
                                      <option  value="3">3</option>
                                      <option  value="4">4</option>
                                      <option  value="5">5</option>
                                      <option  value="6">6</option>
                                      <option  value="7">7</option>
                                      <option  value="8">8</option>
                                      <option  value="9">9</option>
                                      <option  value="10">10</option>
                                    </select>
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Image URL</p>
                                   <input type="text" name="image_url" id="image_url" placeholder="Image URL" class="form-control" required>
                              </div>
                              
                               <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Banner Image</p>
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
  <script>
       $('#slt').on('change',function(){
         var cat_id = $("#slt option:selected").val();

          $.ajax({
          method: "POST",
          url: "<?=site_url('admin/banner/getData');?>",
          data : { cat_id : cat_id },
          dataType : "json",
          success : function( data ){
            var opt = "<option value=''>---Select Item---</option>";
            opt = opt + data;
            $('#data').html(opt);
              }
          });
       });
   </script>
</html>
