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
                  <h4 class="page-title float-left">Add Product</h4>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card-box">

                <script type="text/javascript" src="http://www.google.com/jsapi"></script>
                <script type="text/javascript">
                  google.load("elements", "1", {packages: "transliteration"});
                </script> 
 
                <script>
                  function OnLoad() 
                  {
                    var currValue = document.getElementById("ProductName1");
                     
                    var options = {
                    sourceLanguage:
                    google.elements.transliteration.LanguageCode.ENGLISH,
                    destinationLanguage:
                    [google.elements.transliteration.LanguageCode.MALAYALAM],
                    shortcutKey: 'ctrl+g',
                    transliterationEnabled: true
                    };
                                      
                    var control = new                 
                    google.elements.transliteration.TransliterationControl(options);
                    control.makeTransliteratable(["ProductName1"]);
                    var postValue = document.getElementById("ProductName1");                 
                  }                 
                  google.setOnLoadCallback(OnLoad);                 
                </script> 

                <form action="<?=site_url('admin/Products/addProduct')?>" method="post" id="add-form" enctype="multipart/form-data">

                   <div class="row">
                      <div class="col-md-6">
                          <div class="">
                             
                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Category<span>*</span></p>
                                  <select id="category" class="form-control" name="category_id" required>
                                    <option value="">---Select Category---</option>
                                    <?php 
                                      foreach($category as $cat) {
                                    ?>
                                       <option value="<?=$cat->Category_Id?>"><?php echo @$cat->Category_Title;?></option>
                                    <?php }; ?>
                                 </select>
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Subcategory<span>*</span></p>
                                  <select id="subcategory" class="form-control" name="subcategory_id">
                                    
                                 </select>
                              </div>

                               <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Brand<span>*</span></p>
                                  <select id="brand" class="form-control" name="brand_id" required>
                                    <option value="">---Select Brand---</option>
                                    <?php 
                                      foreach($brand as $br) {
                                    ?>
                                       <option value="<?=$br->BrandID?>"><?php echo @$br->BrandName;?></option>
                                    <?php }; ?>
                                 </select>
                              </div>
                               
                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Product Name<span>*</span></p>
                                  <input type="text" maxlength="25" id="ProductName" name="ProductName" placeholder="ProductName" class="form-control" required><br>

                                  <input type="text" maxlength="25" id="ProductName1" name="ProductName1" placeholder="Product Name in Malayalam(Press Enter)" class="form-control" required>
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Product Name(Manglish)<span></span></p>
                                  <input type="text" maxlength="25" id="manglish_name" name="manglish_name" class="form-control" placeholder="Manglish Name" required>
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Product Type<span>*</span></p>
                                  <select class="form-control" name="product_type">
                                    <option value="">---Select Type---</option>
                                    <option value="vegetables">Vegetables</option>
                                    <option value="nonvegetables">Non Vegetables</option>
                                  </select>
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Prduct MRP<span>*</span></p>
                                  <input type="number" min="0" name="price" class="form-control" placeholder="Product Price" required>
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Quantity<span>*</span></p>
                                  <input type="text" name="Quantity" placeholder="Quantity" class="form-control" required>
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">SGST<span>*</span></p>
                                  <input type="text" id="sgst" name="sgst" placeholder="SGST" class="form-control" onkeypress="return isNumberKey(event)" required>
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">CGST<span>*</span></p>
                                  <input type="text" id="cgst" name="cgst" placeholder="CGST" class="form-control" onkeypress="return isNumberKey(event)" required>
                              </div>
                              
                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Unit<span>*</span></p>
                                  <table id="product-price">
                                    <thead>
                                      <tr>
                                        <td></td>                            
                                        <td></td>
                                      </tr>
                                    </thead>
                                     <tr>
                                        <td>
                                           <input type="text" class="form-control" name="Unit" placeholder="Unit" step="any" required>
                                        </td>
                                        <td>
                                          <select id="Unit1" class="form-control" name="Unit1" >
                                              <option value="gram">GRAM</option>
                                              <option value="KG">KG</option>
                                              <option value="liter">LITRE</option>
                                              <option value="numbers">NUMBERS</option>
                                          </select>
                                        </td>
                                      </tr>
                                  </table>    

                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Net Weight<span></span></p>
                                  <input type="text" id="Netweight" maxlength="25" name="Netweight" placeholder="Net weight" class="form-control">
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Manufacturing Date<span>*</span></p>
                                  <input id="manufacturing_date" class="form-control" name="manufacturing_date" placeholder="Manufacturing Date" type="date" required>
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Expiry Date<span>*</span></p>
                                  <input id="expiry_date" class="form-control" name="expiry_date" placeholder="Expiry Date" type="date" required>
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Batch Number<span>*</span></p>
                                  <input id="batch_number" class="form-control col-md-7 col-xs-12" name="batch_number" placeholder="Batch Number" type="text" required>
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Description<span>*</span></p>
                                   <textarea id="description" required="required" name="description" placeholder="Description" class="form-control col-md-7 col-xs-12" rows="4"></textarea>
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Recipe<span>*</span></p>
                                   <textarea id="recipe" required="required" placeholder="Recipe" name="recipe" class="form-control col-md-7 col-xs-12" rows="4"></textarea>
                               </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Product Image</p><span class="required">(300*200 Pixel) *</span>
                                   <img id="preview0" width="100%" src="" alt=""><br>
                                   <input type="file" id="image" name="image" required="required" class="form-control col-md-7 col-xs-12" onchange="preview_image(this)">
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Product Image</p><span class="">(300*200 Pixel)</span>
                                   <input type="file" id="file-1" name="file-1" class="form-control col-md-7 col-xs-12" onchange="preview_image(this)">
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Product Image</p><span class="">(300*200 Pixel)</span>
                                   <input type="file" id="file-2" name="file-2" class="form-control col-md-7 col-xs-12" onchange="preview_image(this)">
                              </div>
                              <br><br>
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
      $('#category').on('change',function(){
        var cat_id = $("#category option:selected").val();
        $.ajax({
          method: "POST",
          url: "<?=site_url('admin/products/getSubCategories');?>",
          data : { cat_id : cat_id },
          dataType : "json",
          success : function( data ){
            var opt = "<option value=''>---Select Subcategory---</option>";
            opt = opt + data;
            $('#subcategory').html(opt);
              }
        });
      });

      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && ((charCode < 45 && charCode > 47) || charCode > 57))
            return false;

         return true;
      }
    </script>
</html>
