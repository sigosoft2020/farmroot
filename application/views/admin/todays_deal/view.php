<!DOCTYPE html>
<html>
  <head>
    <?php $this->load->view('admin/includes/includes.php'); ?>
    <?php $this->load->view('admin/includes/table-css.php'); ?>
     <link rel="stylesheet" href="<?=base_url()?>plugins/image-crop/croppie.css">
     <link href="<?=base_url()?>plugins/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="<?=base_url()?>plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="<?=base_url()?>plugins/clockpicker/css/bootstrap-clockpicker.min.css" rel="stylesheet">
    <link href="<?=base_url()?>plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

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
                  <h4 class="page-title float-left">Todays Deal</h4>
                    <ol class="breadcrumb float-right">
                    <button type="button" class="btn btn-gradient btn-rounded waves-light waves-effect w-md" data-toggle="modal" data-target="#add-offer">Add deal</button>
                  </ol>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                  <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th width="10%">Type</th>
                        <th width="30">Item name</th>
                        <th width="10%">Offer Percentage</th>
                        <th width="10%">Deal Date</th>
                        <th width="10%">Start Time</th>
                        <th width="10%">End Time</th>
                        <th width="5%">Status</th>
                        <th width="5%">Edit</th>
                        <th width="5%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($offers as $offer) {?>
                       <tr>
                         <td><?=$offer->type?></td>
                         <td><?=$offer->data?></td>
                         <td><?=$offer->percentage?></td>
                         <td><?php echo date('d-M-Y',strtotime($offer->deal_date));?></td>
                         <td><?php echo date('h:i A',strtotime($offer->time_from));?></td>
                         <td><?php echo date('h:i A',strtotime($offer->time_to));?></td>
                         <td><?=$offer->status?></td>
                         <td><button type="button" class="btn btn-link" style="font-size:20px;color:blue" onclick="edit('<?=$offer->deal_id?>')"><i class="fa fa-pencil"></i></button></td>
                         <?php if($offer->status=='Active') {?>
                            <td>  <a class="btn btn-link" style="font-size:16px;color:red" href="<?=site_url('admin/todays_deal/disable/'.$offer->deal_id)?>"  onclick="return block()">Block</i></a></td>
                         <?php } else {?>
                            <td>  <a class="btn btn-link" style="font-size:16px;color:red" href="<?=site_url('admin/todays_deal/enable/'.$offer->deal_id)?>"  onclick="return block()">Enable</i></a></td>
                         <?php };?>
                       </tr>
                      <?php };?>
                    </tbody>
                  </table>
                </div>
            </div>
          </div>
        </div>
      </div>
      <?php $this->load->view('admin/includes/footer.php'); ?>

      <div id="add-offer" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
             <div class="modal-dialog">
                 <div class="modal-content">

                     <div class="modal-body">
                         <h2 class="text-uppercase text-center m-b-30">
                             <span><h4>Add Todaysdeal</h4></span>
                         </h2>

                         <form action="<?=site_url('admin/todays_deal/addData')?>" method="post" id="add-form" enctype="multipart/form-data">
                             
                             <div class="form-group m-b-25">
                                 <div class="col-12">
                                     <label for="select">Select Item</label>
                                     <select name="type" id="slt" class="form-control" >
                                      <option value="">---Select Item---</option> 
                                      <option value="Product">Product</option> 
                                      <option value="Category">Category</option> 
                                      <option value="Subcategory">Subategory</option>  
                                      <option value="Brand">Brand</option>
                                    </select> 
                                 </div>
                             </div>

                             <div class="form-group m-b-25">
                                 <div class="col-12">
                                     <label for="select">Item</label>
                                     <select name="data" id="data" class="form-control" >
                                       <option value="">---Select Item---</option> 
                                    
                                     </select> 
                                 </div>
                             </div>

                             <div class="form-group m-b-25">
                                 <div class="col-12">
                                     <label for="select">Offer Percentage(%)</label><br>
                                      <input type="number" min="0" name="percentage" id="percentage" placeholder="Offer Percentage" class="form-control" required>
                                 </div>
                             </div>

                             <div class="form-group m-b-25">
                                 <div class="col-12">
                                     <label for="select">Deal Date</label>
                                     <input type="date" name="date_from" id="date_from" placeholder="Image URL" class="form-control" value="<?php echo date('Y-m-d');?>"  onchange="Checkfromdate()" required>
                                 </div>
                             </div>

                             <div class="form-group m-b-25">
                                <div class="col-12">
                                    <p id="error-message" style="color:red;"></p>
                                </div>
                             </div>

                             <div class="form-group m-b-25">
                                 <div class="col-12">
                                     <label for="select">Time from</label>
                                      <input type="text" name="time_from" id="timepicker" placeholder="Image URL" class="form-control" required>
                                 </div>
                             </div>
                             
                             <div class="form-group m-b-25">
                                 <div class="col-12">
                                     <label for="select">Time to</label>
                                      <input type="text" name="time_to" id="timepicker3"  class="form-control" required>
                                 </div>
                             </div>

                            <div class="form-group m-b-25">
                              <div class="col-12">
                                  <p id="error-message" style="color:red;"></p>
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

        <div id="edit-offer" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
             <div class="modal-dialog">
                 <div class="modal-content">

                     <div class="modal-body">
                         <h2 class="text-uppercase text-center m-b-30">
                             <span><h4>Edit Deal</h4></span>
                         </h2>

                         <form action="<?=site_url('admin/todays_deal/Update')?>" method="post" id="add-form" enctype="multipart/form-data">
                            <input type="hidden" name="deal_id" id="deal_id">
                             
                             <div class="form-group m-b-25">
                                 <div class="col-12">
                                     <label for="select">Offer Percentage(%)</label><br>
                                      <input type="number" min="0" name="percentage" id="offer_percentage" placeholder="Offer Percentage" class="form-control" required>
                                 </div>
                             </div>

                             <div class="form-group m-b-25">
                                 <div class="col-12">
                                     <label for="select">Deal Date</label>
                                     <input type="date" name="date_from" id="start_date" placeholder="Image URL" class="form-control" onchange="Checkfromdate()" required>
                                 </div>
                             </div>

                             <div class="form-group m-b-25">
                                <div class="col-12">
                                    <p id="error-message" style="color:red;"></p>
                                </div>
                             </div>

                             <div class="form-group m-b-25">
                                 <div class="col-12">
                                     <label for="select">Time from</label>
                                      <input type="text" name="time_from" id="start_time" placeholder="Image URL" class="form-control" required>
                                 </div>
                             </div>
                             
                             <div class="form-group m-b-25">
                                 <div class="col-12">
                                     <label for="select">Time to</label>
                                      <input type="text" name="time_to" id="time_to"  class="form-control" required>
                                 </div>
                             </div>

                            <div class="form-group m-b-25">
                              <div class="col-12">
                                  <p id="error-message" style="color:red;"></p>
                              </div>
                            </div>
                             
                             <div class="form-group account-btn text-center m-t-10">
                                 <div class="col-12">
                                     <button type="reset" class="btn w-lg btn-rounded btn-light waves-effect m-l-5" data-dismiss="modal">Back</button>
                                     <button class="btn w-lg btn-rounded btn-primary waves-effect waves-light" type="submit">Update</button>
                                 </div>
                             </div>
                         </form>
                     </div>
                 </div><!-- /.modal-content -->
             </div><!-- /.modal-dialog -->
         </div>

    </div>
  </body>
  <?php $this->load->view('admin/includes/scripts.php'); ?>
  <?php $this->load->view('admin/includes/table-script.php'); ?>
   <script src="<?=base_url()?>plugins/image-crop/croppie.js"></script>
  <script src="<?=base_url()?>plugins/moment/moment.js"></script>
  <script src="<?=base_url()?>plugins/bootstrap-timepicker/bootstrap-timepicker.js"></script>
  <script src="<?=base_url()?>plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
  <script src="<?=base_url()?>plugins/clockpicker/js/bootstrap-clockpicker.min.js"></script>
  <script src="<?=base_url()?>plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script src="<?=base_url()?>assets/pages/jquery.form-pickers.init.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
  </script>

 <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable').DataTable();

            //Buttons examples
            var table = $('#datatable-buttons').DataTable({
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf']
            });

            table.buttons().container()
                    .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
        } );

    </script>
     <script>
         $('#datatable').DataTable({
            "order": [[ 0, "desc" ]], //or asc 
            "columnDefs" : [{"targets":3, "type":"date-eu"}],
        });
    </script>
      <script>
       $('#slt').on('change',function(){
         var cat_id = $("#slt option:selected").val();

          $.ajax({
          method: "POST",
          url: "<?=site_url('admin/offer/getData');?>",
          data : { cat_id : cat_id },
          dataType : "json",
          success : function( data ){
            var opt = "<option value=''>---Select Item---</option>";
            opt = opt + data;
            $('#data').html(opt);
              }
          });
       });

       function Checkfromdate()
       {

          var end    = $('#date_from').val();
          //var myDate = new Date(end);
          //var today  = new Date();
         var today = new Date();
         var dd = today.getDate();
         var mm = today.getMonth()+1;
         var yyyy = today.getFullYear();
        var today_date = yyyy+'-'+mm+'-'+dd;

        if(end < today_date)
        {
           $('#error-message').text('Please select valid date');
           $('#error-message').fadeIn().delay(1500).fadeOut(1200);
           return false;
        }
        else if(end > today_date)
        {
          $('#error-message').text('');
          return true;    
        }
        else
        {
          $('#error-message').text('');
          return true;    
        }
         
       }
     function CheckTodate()
       {

          var end    = $('#date_to').val();
          var start    = $('#date_from').val();
          //var myDate = new Date(end);
          //var today  = new Date();
         var today = new Date();
         var dd = today.getDate();
         var mm = today.getMonth()+1;
         var yyyy = today.getFullYear();
        var today_date = yyyy+'-'+mm+'-'+dd;

        if(end < start)
        {
           $('#error-messagee').text('Please select valid date');
           $('#error-messagee').fadeIn().delay(1500).fadeOut(1200);
           return false;
        }
        else if(end > today_date)
        {
          $('#error-messagee').text('');
          return true;    
        }
        else
        {
          $('#error-messagee').text('');
          return true;    
        }
         
       }

   function edit(id)
    {
      $('#deal_id').val(id);
      // alert(id);
      $.ajax({
          method: "POST",
          url: "<?php echo site_url('admin/todays_deal/getDealById');?>",
          dataType : "json",
          data : { id : id },
          success : function( data ){
            $('#offer_percentage').val(data.percentage);
            $('#start_date').val(data.deal_date);
            $('#start_time').val(data.start_time);
            $('#time_to').val(data.end_time);
           
            $('#edit-offer').modal('show');
            // alert(data);
          }
        });
    }
   </script>
</html>
