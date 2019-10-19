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
                  <h4 class="page-title float-left">Tele orders</h4>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card-box">
                <form action="<?=site_url('admin/tele_orders/addData')?>" method="post" enctype="multipart/form-data" onsubmit="return finalize()"> 

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-box">
                                    <h4 class="m-t-0 header-title">Tele Orders</h4>
                
        
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <!-- <label for="inputEmail4" class="col-form-label">Phone</label> -->
                                                <input class="form-control" name="BillingDet_Phone" id="BillingDet_Phone" placeholder="Phone" onchange="GetCustomer();" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength = "10" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <!-- <label for="inputPassword4" class="col-form-label">Customer Name</label> -->
                                                <input type="text" class="form-control" name="BillingDet_Name" id="BillingDet_Name" placeholder="Customer Name">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <!-- <label for="inputPassword4" class="col-form-label">Flat No/Villa No/Residence No</label> -->
                                                <input class="form-control" id="house_no" name="BillingDet_houseno" placeholder="Flat No/Villa No/Residence No"  type="text" required>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <!-- <label for="inputEmail4" class="col-form-label">Flat/Villa/House/Residence Name</label> -->
                                                <input class="form-control" id="BillingDet_Housename" name="BillingDet_Housename" placeholder="Flat/Villa/House/Residence Name"  type="text" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <!-- <label for="inputPassword4" class="col-form-label">Area</label> -->
                                                <input class="form-control" id="BillingDet_Area" name="BillingDet_Area" placeholder="Area" required="required" type="text">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <!-- <label for="inputPassword4" class="col-form-label">Land Mark</label> -->
                                                <input class="form-control" id="BillingDet_Land" name="BillingDet_Land" placeholder="Land Mark" required="required" type="text">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <!-- <label for="inputEmail4" class="col-form-label">Email</label> -->
                                                <input class="form-control" id="Register_Email" name="Register_Email" placeholder="Email" required="required" type="email">

                                                <input type="hidden" name="BillingDet_UserId" id="BillingDet_UserId">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <!-- <label for="inputPassword4" class="col-form-label">Delivery Location</label> -->
                                                <select id="d_location" name="d_location" placeholder="Delivery_location" required="required" class="js-example-basic-single" data-live-search="true">
                                                   <option value="">Select Delivery Location</option>
                                                    <?php foreach($del_locations as $del)
                                                      {?>
                                                   <option value="<?=$del->del_id?>"><?=$del->place_name?></option>      
                                                     <?php };?> 
                                                 </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <!-- <label for="inputPassword4" class="col-form-label">Delivery Date(Veg)</label> -->
                                                 <select id="d_date" name="d_date" placeholder="Delivery_date"  class="form-control">
                                                    <option value="">Select Delivery Date(veg)</option>
                                                     <?php foreach($veg_date as $veg)
                                                      {?>
                                                    <option value="<?=$veg->delivery_date?>"><?=$veg->delivery_date?></option>      
                                                     <?php };?>  
                                                 </select>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <!-- <label for="inputPassword4" class="col-form-label">Delivery Date(Non Veg)</label> -->
                                                 <select id="d_date_other" name="d_date_other" placeholder="Delivery_date_other"  class="form-control">
                                                    <option value="">Select Delivery Date(Non Vegetables)</option>
                                                    <?php foreach($nonveg_date as $nonveg)
                                                      {?>
                                                      <option value="<?=$nonveg->delivery_date?>"><?=$nonveg->delivery_date?></option>      
                                                    <?php };?>  
                                                 </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <!-- <label for="inputPassword4" class="col-form-label">Delivery Slot(Veg)</label> -->
                                                <select id="d_slot" name="d_slot_veg" placeholder="Delivery Slot" class="form-control">
                                                   <option value="">Select Delivery Slot(Veg)</option>
                                                   <?php foreach($veg_slots as $veg)
                                                      {?>
                                                    <option value="<?=$veg->delivery_slot?>"><?=$veg->delivery_slot?></option>      
                                                   <?php };?>  
                                                 </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                
                                                <select id="d_slot" name="d_slot_others" placeholder="Delivery Slot" class="form-control">
                                                    <option value="">Select Delivery Slot(Non Veg)</option>
                                                    <?php foreach($nonveg_slots as $nonveg)
                                                      {?>
                                                     <option value="<?=$nonveg->delivery_slot?>"><?=$nonveg->delivery_slot?></option>      
                                                    <?php };?> 
                                                 </select>
                                            </div>                                            
                                        </div>

                                        <div class="form-group">
                                            <textarea class="form-control" id="notes" name="notes" rows="1" placeholder="Notes"></textarea>
                                        </div>
                                        <br>
                                </div>
                            </div>
                        </div>

                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group m-b-25">
                          <div class="col-12">
                            <table id="product-price">
                              <thead>
                                <tr>
                                  <td>Product Name</td>
                                  <td>Product MRP</td>
                                  <td>Offer Price</td>
                                  <td>Quantity</td>
                                  <td>Total</td>                                  
                                  <td></td>
                                </tr>
                              </thead>
                              <tr>
                                 <td>
                                    <!-- <input class="typeahead" name="ProductName" placeholder="" type="text" id="typeahead" onblur="Getproduct()" onclick="Getproduct()"> -->
                                    <select class="form-control js-example-basic-single" id="typeahead" onchange="Getproduct()">
                                      <option value="">---Select Product---</option>
                                      <?php foreach($products as $pr) {?>
                                        <option value="<?php echo $pr->PsearchName;?>"><?php echo $pr->PsearchName;?></option>
                                      <?php };?>  
                                    </select>
                                    <input type="hidden" name="ProductID" id="ProductID">
                                 </td>
                               
                                 <td><input class="form-control " name="Product_MRP" placeholder="" type="text" id="Product_MRP" readonly></td>
                                 
                                 <td><input class="form-control " name="offerprice" placeholder="" type="text" id="offerprice" readonly></td>
                                 
                                 <td><input class="form-control" name="Quantity" placeholder="" type="number" min="1" id="Quantity" oninput="GetPtotal()"></td>

                                 <td> <input class="form-control " name="Total" placeholder="" type="text" id="Total" onchange="GetPtotal()" readonly></td>
                                  
                                  <input type="hidden" class="form-control" name="ProductStock" id="ProductStock" value="">
                                  <input class="form-control " name="gst_amt" placeholder="" type="hidden" id="gst_amt" >
                                  <input class="form-control " name="cgst_amt" placeholder="" type="hidden" id="cgst_amt" >
                                  <input class="form-control " name="sgst_amt" placeholder="" type="hidden" id="sgst_amt" >                               <input class="form-control " name="gst" placeholder="" type="hidden" id="gst" >
                                  <input class="form-control " name="cgst" placeholder="" type="hidden" id="cgst" >
                                  <input class="form-control " name="sgst" placeholder="" type="hidden" id="sgst" >
                                     
                                 <td><input type="button" class="btn btn-info m-l add_btn_o" name="add" id="add" onclick="insertRow();" value="Add"></td>
                              </tr>
                            </table>
                            
                             <div class="form-group m-b-25">
                              <div class="col-12">
                                  <p id="error-mssg" style="color:red;"></p>
                              </div>
                            </div>
                            
                            <div id="errfn" class="check">   </div>
                           
                              <table id="myTable" cellspacing="10">
                                 <tr>
                                </tr><br>
                              </table><br>
                              
                                <div class="conatiner">
                                  <div class="row">
                                      <div class="col-md-3 col-sm-12 col-xs-12">
                                          <label>Sub Total(₹)</label>
                                          <input class="form-control" type="text" id="subTotal" value="0" readonly>
                                        </div>
                                      
                                        <div class="col-md-3 col-sm-12 col-xs-12 ">
                                          <label>Delivery Charge(₹)</label>
                                          <input class="form-control" type="text" id="delivery_charge" value="20" disabled>
                                        </div>
                                  
                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                          <label>Grand Total(₹)</label>
                                          <input class="form-control" type="text" id="grandTotal" value="20" readonly>
                                       </div>
                                    
                                  </div>
                                </div>
      
                                  <div class="form-group m-b-25">
                                      <div class="col-12">
                                          <p id="error-message" style="color:red;"></p>
                                      </div>
                                  </div>
                                 <br>
                                <div class="row">
                                 <input type="submit" style='margin-right:16px' class="btn btn-success" name="submit" id="Button"  value="Submit">
                                </div>
  
                                  </div>
                                </div>
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
        $('.js-example-basic-single').select2();
    });
  </script>
  <script type="">
    
    function GetCustomer()
    {
      var BillingDet_Phone = document.getElementById('BillingDet_Phone').value;
      // alert(id);
       $.ajax({
          method: "POST",
          url: "<?php echo site_url('admin/tele_orders/get_customer');?>",
          dataType : "json",
          data : { BillingDet_Phone : BillingDet_Phone },
          success : function( data ){
            $('#BillingDet_Name').val(data.BillingDet_Name);
            $('#BillingDet_Land').val(data.BillingDet_Land);
            $('#BillingDet_City').val(data.BillingDet_City);
            $('#BillingDet_State').val(data.BillingDet_State);
            $('#BillingDet_PIN').val(data.BillingDet_PIN);
            $('#BillingDet_Area').val(data.BillingDet_Area);
            $('#BillingDet_Housename').val(data.BillingDet_Housename);
            $('#house_no').val(data.house_no);
            $('#notes').val(data.notes);
            $('#BillingDet_UserId').val(data.BillingDet_UserId); 
            $('#Register_Email').val(data.BillingDet_Email); 
          }
        });
    }

    function Getproduct()
       {
      
        var id = document.getElementById('typeahead').value;

       $.ajax({
          method: "POST",
          url: "<?php echo site_url('admin/tele_orders/get_product');?>",
          dataType : "json",
          data : { id : id },
          success : function( data ){
            $('#ProductID').val(data.ProductID);
            $('#Product_MRP').val(data.ProductMRP);
            $('#ProductStock').val(data.ProductStock);
            $('#gst').val(data.gst);
            $('#cgst').val(data.cgst);
            $('#sgst').val(data.sgst);
            $('#gst_amt').val(data.gst_amt); 

           if(data.offer!="0")
           {
             var perc = data.offer;
             var mrp  = data.ProductMRP;
             var offers=(parseInt(mrp)-(parseInt(mrp)*(parseInt(perc)/100))).toFixed(2);
             document.getElementById('offerprice').value =offers;
           }
           else
           {
              document.getElementById('offerprice').value ="0";
           }
            
          }
        });
       }


    function GetPtotal()
      {
        var vale=document.getElementById('offerprice').value;
        if(vale == "0")
         {        
          var Product_MRP = document.getElementById('Product_MRP').value;
          var Quantity = document.getElementById('Quantity').value;
          //var gst_amt = document.getElementById('gst_amt').value;
          //var gst = document.getElementById('gst').value;
          //var percentage=document.getElementById('percentage').value;
          var sgst = document.getElementById('sgst').value;
          var cgst = document.getElementById('cgst').value;
          var gst =parseFloat(sgst)+parseFloat(cgst);
          
           var ptotal = Product_MRP*Quantity;
           var ptotale = (ptotal).toFixed(2);
           document.getElementById('Total').value = ptotale;
           var offer = (parseFloat(ptotale)*(parseInt(gst)/100)).toFixed(2);
           
           //var cgst1 = parseFloat(ptotale)*(parseInt(cgst)/100);
           var cgst2 =(parseFloat(ptotale)/(parseInt(gst)+100))*100;
           var cgst1 = (parseFloat(cgst2)*(parseInt(cgst)/100))*2;
           
           //var sgst1 = parseFloat(ptotale)*(parseInt(sgst)/100);
           var sgst2 =(parseFloat(ptotale)/(parseInt(gst)+100))*100;
           var sgst1 = (parseFloat(sgst2)*(parseInt(sgst)/100))*2;
           
           document.getElementById('gst_amt').value = (parseFloat(cgst1)+parseFloat(sgst1)).toFixed(2);
           document.getElementById('cgst_amt').value = (parseFloat(cgst1)).toFixed(2);
           document.getElementById('sgst_amt').value = (parseFloat(sgst1)).toFixed(2);
          }
        else
          {
            var Product_MRP = document.getElementById('offerprice').value;
            var Quantity = document.getElementById('Quantity').value;
            //var gst = document.getElementById('gst').value;
            
            var sgst = document.getElementById('sgst').value;
            var cgst = document.getElementById('cgst').value;
            
            var gst =parseFloat(sgst)+parseFloat(cgst);

            var ptotal = Product_MRP*Quantity;
            var ptotale = (ptotal).toFixed(2);
            document.getElementById('Total').value = ptotale;
            
            
            var offer = (parseFloat(ptotale)*(parseInt(gst)/100)).toFixed(2);
            //var cgst1 = (parseFloat(ptotale)*(parseInt(cgst)/100));
            //var sgst1 = (parseFloat(ptotale)*(parseInt(sgst)/100));
            
            var cgst2 =(parseFloat(ptotale)/(parseInt(gst)+100))*100;
            var cgst1 = (parseFloat(cgst2)*(parseInt(cgst)/100));
         
            var sgst2 =(parseFloat(ptotale)/(parseInt(gst)+100))*100;
            var sgst1 = (parseFloat(sgst2)*(parseInt(sgst)/100));
         
            document.getElementById('gst_amt').value = (parseFloat(cgst1)+parseFloat(sgst1)).toFixed(2);
            
            document.getElementById('cgst_amt').value = (parseFloat(cgst1)).toFixed(2);
            document.getElementById('sgst_amt').value = (parseFloat(sgst1)).toFixed(2);
          }
      }
  </script>

  <script type="text/javascript">     
        var list = [];     
        var index = 1;
             function insertRow(){
               var ProductName = document.getElementById('typeahead').value;
               var Product_MRP = document.getElementById('Product_MRP').value;
               var Quantity = document.getElementById('Quantity').value;
               var Stock    = document.getElementById('ProductStock').value;
               var Total    = document.getElementById('Total').value;
               var Product_Id = document.getElementById('ProductID').value;
               var gst = document.getElementById('gst_amt').value;
               var offerprice = document.getElementById('offerprice').value;
               //var gst = document.getElementById('gst_amt').value;               
               var cgstamt = document.getElementById('cgst_amt').value;
               var sgstamt = document.getElementById('sgst_amt').value;

               if(ProductName==null || ProductName=="")
               {
                 alert("Select product")
               }
               else if( Product_MRP==null || Product_MRP=="")
               {
                 alert("Fill the required Field")
               }
               else if( Quantity==null || Quantity=="")
               {
                 alert("Add Quantity")
               }
               else  if( Quantity > Stock)
               {
                alert("Sorry! Only " +Stock+ " items are available ")
               }  
               else
               {           
                var table=document.getElementById("myTable");
                var row=table.insertRow(table.rows.length);
                var cell1=row.insertCell(0);

                var t1=document.createElement("input");
                    t1.id = "index"+index;
                    t1.value=index;
                    t1.name="no[]";
                    t1.className = "form-control col-md-3 col-xs-3";
                    t1.style.marginTop = "10px"

                    cell1.appendChild(t1);

                var cell2=row.insertCell(1);

                var t2=document.createElement("input");
                    t2.id = "ProductName"+index;
                    t2.value=ProductName;
                    t2.name="ProductName[]";
                    t2.className = "form-control col-md-7 col-xs-12";
                    t2.style.marginTop = "10px"

                    cell2.appendChild(t2);

                var cell3=row.insertCell(2);
                var t3=document.createElement("input");
                    t3.id = "Product_MRP"+index;
                    t3.value=Product_MRP;
                    t3.name="Product_MRP[]";
                    t3.className = "form-control col-md-7 col-xs-12";
                    t3.style.marginTop = "10px"

                    cell3.appendChild(t3);
                    
                    var cell4=row.insertCell(3);
                    var t4=document.createElement("input");
                    t4.id = "offerprice"+index;
                    t4.value=offerprice;
                    t4.name="offerprice[]";
                    t4.className = "form-control col-md-7 col-xs-12";
                    t4.style.marginTop = "10px"
                    cell4.appendChild(t4);
                                      
                var cell5=row.insertCell(4);
                var t5=document.createElement("input");
                    t5.id = "Quantity"+index;
                    t5.value=Quantity;
                    t5.name="Quantity[]";
                    t5.className = "form-control col-md-7 col-xs-12";
                    t5.style.marginTop = "10px"

                    cell5.appendChild(t5);
                var cell6=row.insertCell(5);
                var t6=document.createElement("input");
                    t6.id = "Total"+index;
                    t6.value=Total;
                    t6.name="Total[]";
                    t6.className = "form-control col-md-7 col-xs-12";
                    t6.style.marginTop = "10px"

                    cell6.appendChild(t6);

                  var cell7=row.insertCell(6);
                  var t7=document.createElement("BUTTON");
                  var t = document.createTextNode("Remove");
                  t7.appendChild(t);
                  document.body.appendChild(t7);

                  t7.className = "btn btn-success m-l remove";
                  t7.style.marginTop = "10px"

                  cell7.appendChild(t7);

                  var cell8=row.insertCell(7);
                  var t8=document.createElement("input");
                  t8.id = "ProductID"+index;
                  t8.value=Product_Id;
                  t8.name="Product_Id[]";
                  t8.type="Hidden";
                  t8.className = "form-control col-md-7 col-xs-12";
                  t8.style.marginTop = "10px"
                  cell8.appendChild(t8);
                  

                  var cell9=row.insertCell(8);
                  var t9=document.createElement("input");
                  t9.id = "gst"+index;
                  t9.value=gst;
                  t9.name="gst[]";
                  t9.type="Hidden";
                  t9.className = "form-control col-md-7 col-xs-12";
                  t9.style.marginTop = "10px"
                  cell9.appendChild(t9);
                  
                  var cell10=row.insertCell(9);
                  var t10=document.createElement("input");
                  t10.id = "cgstamt"+index;
                  t10.value=cgstamt;
                  t10.name="cgstamt[]";
                  t10.type="Hidden";
                  t10.className = "form-control col-md-7 col-xs-12";
                  t10.style.marginTop = "10px"
                  cell10.appendChild(t10);
                  
                  var cell11=row.insertCell(10);
                  var t11=document.createElement("input");
                  t11.id = "sgstamt"+index;
                  t11.value=sgstamt;
                  t11.name="sgstamt[]";
                  t11.type="Hidden";
                  t11.className = "form-control col-md-7 col-xs-12";
                  t11.style.marginTop = "10px"
                  cell11.appendChild(t11);
                    
          index++;

           document.getElementById('typeahead').value="";
           document.getElementById('Product_MRP').value="";
           document.getElementById('Quantity').value="";
           document.getElementById('Total').value="";
           document.getElementById('ProductID').value="";
           document.getElementById('offerprice').value="";
           
        }
       var arr = document.getElementsByName('Total[]');
        var totalLength = arr.length;
        var subTotal=0;
        var grandTotal=0;
        for(i=0;i<totalLength;i++)
        {
         subTotal = subTotal+parseFloat(arr[i].value);
        }
        document.getElementById('subTotal').value=subTotal;  
        grandTotal=subTotal+20;
        document.getElementById('grandTotal').value=grandTotal; 
        

        var arr = document.getElementsByName('gst[]');
        var totalLength = arr.length;
        var gst=0;
        for(i=0;i<totalLength;i++)
        {
         gst = gst+parseFloat(arr[i].value);
        }
        var gst=(parseFloat(gst)/2).toFixed(2);
        document.getElementById('cgst_value').value=gst;
        document.getElementById('sgst_value').value=gst;
        var gtotal= (parseFloat(gst)*2+parseFloat(grandTotal)).toFixed(2);
        document.getElementById('gtotal').value=gtotal;


        var arr = document.getElementsByName('cgstamt[]');
        var totalLength = arr.length;
        var gst=0;
        for(i=0;i<totalLength;i++)
        {
         gst = gst+parseFloat(arr[i].value);
        }
        var gst=(parseFloat(gst)/2).toFixed(2);
        document.getElementById('cgst_value').value=gst;
        
        var arr = document.getElementsByName('sgstamt[]');
        var totalLength = arr.length;
        var gst=0;
        for(i=0;i<totalLength;i++)
        {
         gst = gst+parseFloat(arr[i].value);
        }
        var gst=(parseFloat(gst)/2).toFixed(2);
        document.getElementById('sgst_value').value=gst;
    }

    $(function()  
    {  
     
    $('body').delegate('.remove','click',function()  
    {  
    $(this).parent().parent().remove();  
    var arr = document.getElementsByName('Total[]');
        var totalLength = arr.length;
        var subTotal=0;
         var grandTotal=0;
         var gst=0;
        for(i=0;i<totalLength;i++)
        {
         subTotal = subTotal+parseFloat(arr[i].value);
        }
        document.getElementById('subTotal').value=subTotal;
         grandTotal=subTotal+20;
        document.getElementById('grandTotal').value=grandTotal;
        
        var arr1 = document.getElementsByName('gst[]');
        var totalLength1 = arr1.length;
        
        for(i=0;i<totalLength1;i++)
        {
         gst = gst+parseFloat(arr1[i].value);
        }
        //document.getElementById('gst_value').value=gst;
        var gst=(parseFloat(gst)/2).toFixed(2);
        document.getElementById('cgst_value').value=gst;
        document.getElementById('sgst_value').value=gst;
        var gtotal= (parseFloat(gst)*2+parseFloat(grandTotal)).toFixed(2);
        document.getElementById('gtotal').value=gtotal;
    });  
    }); 

    $(function(){     
      var d = new Date(),        
          h = d.getHours(),
          m = d.getMinutes();
      if(h < 10) h = '0' + h; 
      if(m < 10) m = '0' + m; 
      $('input[type="time"][value="now"]').each(function(){ 
        $(this).attr({'value': h + ':' + m});
      });
    });
 </script>   
 <script type="">
   function finalize()
      {
       
        var total_amount = $('#subTotal').val();
      
        if (total_amount == '0') {
          $('#error-message').text('Your Sub Total Is 0. Please Click On Add Button');
          $('#error-message').fadeIn().delay(1500).fadeOut(1200);
          return false;
        }
        else {
        //   $('#Button1').attr('disabled','disabled');
          $('#error-message').text('');
          return true;
          
        }
      }
 </script> 
</html>
