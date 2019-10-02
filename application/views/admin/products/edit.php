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
                  <h4 class="page-title float-left">Edit Product</h4>
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

                <form action="<?=site_url('admin/Products/update')?>" method="post" id="add-form" enctype="multipart/form-data">

                   <div class="row">
                      <div class="col-md-6">
                          <div class="">
                              <input type="hidden" name="product_id" value="<?php echo $product->ProductID;?>">
                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Category<span>*</span></p>
                                  <select id="category" class="form-control" name="category_id" required>
                                    <?php 
                                      foreach($category as $cat) {
                                    ?>
                                       <option value="<?=$cat->Category_Id?>" <?php if($product->CategoryID == $cat->Category_Id){ echo "selected"; }?>><?php echo @$cat->Category_Title;?></option>
                                       
                                    <?php }; ?>
                                 </select>
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Subcategory<span>*</span></p>
                                  <select id="subcategory" class="form-control" name="subcategory_id">
                                   <?php if($product->Subcategory_ID !='') 
                                   {
                                     foreach ($subcategory as $sub) { ?>
                                    <option value="<?=$sub->subcategory_id?>" <?php if($product->Subcategory_ID == $sub->subcategory_id){ echo "selected"; }?>><?=$sub->subcategory_title?></option>
                                  <?php }  
                                    } 
                                    else {?>
                                      <option value="">---Select Subcategory---</option>
                                      <?php foreach ($subcategory as $sub) { ?>
                                      <option value="<?=$sub->subcategory_id?>" <?php if($product->Subcategory_ID == $sub->subcategory_id){ echo "selected"; }?>><?=$sub->subcategory_title?></option>
                                  <?php } };?>
                                   </select>
                              </div>

                               <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Brand<span>*</span></p>
                                  <select id="brand" class="form-control" name="brand_id" required>
                                    <?php 
                                      foreach($brand as $br) {
                                    ?>
                                       <option value="<?=$br->BrandID?>" <?php if($product->BrandID==$br->BrandID) { echo "selected"; }?>><?php echo @$br->BrandName;?></option>
                                    <?php }; ?>
                                 </select>
                              </div>
                               
                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Product Name<span>*</span></p>
                                  <input type="text" maxlength="25" id="ProductName" name="ProductName" placeholder="ProductName" value="<?php echo @$product->ProductName;?>" class="form-control" required><br>

                                  <input type="text" maxlength="25" id="ProductName1" name="ProductName1" placeholder="Product Name in Malayalam(Press Enter)" class="form-control" value="<?php echo @$product->malayalam_name;?>" required>
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Product Name(Manglish)<span></span></p>
                                  <input type="text" maxlength="25" id="manglish_name" name="manglish_name" class="form-control" placeholder="Manglish Name" value="<?php echo @$product->manglish_name;?>" required>
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Product Type<span>*</span></p>
                                  <select class="form-control" name="product_type">
                                    <option value="vegetables" <?php if($product->product_type=='vegetables'){ echo "selected"; }?>>Vegetables</option>
                                    <option value="nonvegetables" <?php if($product->product_type=='nonvegetables'){ echo "selected"; }?>>Non Vegetables</option>
                                  </select>
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Prduct MRP<span>*</span></p>
                                  <input type="number" min="0" name="price" class="form-control" placeholder="Product Price" value="<?php echo @$product->ProductMRP;?>" required>
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Quantity<span>*</span></p>
                                  <input type="text" name="Quantity" placeholder="Quantity" class="form-control" value="<?php echo @$product->ProductStock;?>" required>
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">SGST<span>*</span></p>
                                  <input type="text" id="sgst" name="sgst" placeholder="SGST" class="form-control" value="<?php echo @$product->sgst;?>" onkeypress="return isNumberKey(event)" required>
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">CGST<span>*</span></p>
                                  <input type="text" id="cgst" name="cgst" placeholder="CGST" class="form-control" value="<?php echo @$product->cgst;?>" onkeypress="return isNumberKey(event)" required>
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
                                           <input type="text" class="form-control" name="Unit" placeholder="Unit" step="any" value="<?php echo @$product->Unit;?>" required>
                                        </td>
                                        <td>
                                          <select id="Unit1" class="form-control" name="Unit1" >
                                              <option value="gram" <?php if($product->unit1=='gram'){ echo "selected"; }?>>GRAM</option>
                                              <option value="KG" <?php if($product->unit1=='KG'){ echo "selected"; }?>>KG</option>
                                              <option value="liter" <?php if($product->unit1=='liter'){ echo "selected"; }?>>LITRE</option>
                                              <option value="numbers" <?php if($product->unit1=='numbers'){ echo "selected"; }?>>NUMBERS</option>
                                          </select>
                                        </td>
                                      </tr>
                                  </table>    
                              </div>

                             <!--  <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Net Weight<span></span></p>
                                  <input type="text" id="Netweight" maxlength="25" name="Netweight" placeholder="Net weight" class="form-control">
                              </div> -->

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Manufacturing Date<span>*</span></p>
                                  <input id="manufacturing_date" class="form-control" name="manufacturing_date" value="<?php echo @$product->manufacturing_date;?>" placeholder="Manufacturing Date" type="date" required>
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Expiry Date<span>*</span></p>
                                  <input id="expiry_date" class="form-control" name="expiry_date" placeholder="Expiry Date" value="<?php echo @$product->expiry_date;?>" type="date" required>
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Batch Number<span>*</span></p>
                                  <input id="batch_number" class="form-control col-md-7 col-xs-12" name="batch_number" value="<?php echo @$product->batch_number;?>" placeholder="Batch Number" type="text" required>
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Description<span>*</span></p>
                                  <textarea id="description" required="required" name="description" placeholder="Description" class="form-control col-md-7 col-xs-12" rows="4"><?php echo @$product->description;?></textarea>
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Recipe<span>*</span></p>
                                  <textarea id="recipe" required="required" placeholder="Recipe" name="recipe" class="form-control col-md-7 col-xs-12" rows="4"><?php echo @$product->recipe;?></textarea>
                              </div><br>

                              <div>
                                  <img src="<?=base_url() . $product->ProductImage?>" height="250px" width="300px"><br><br>
                                  <input type="file" id="image" name="image" class="form-control col-md-7 col-xs-12" onchange="preview_image(this)">
                              </div>
                               
                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Status<span>*</span></p>
                                  <select class="form-control" name="status">
                                    <option value="Active" <?php if($product->ProductStatus=='Active'){ echo "selected"; }?>>Active</option>
                                    <option value="Blocked" <?php if($product->ProductStatus=='Blocked'){ echo "selected"; }?>>Blocked</option>
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
