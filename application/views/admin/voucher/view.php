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
                  <h4 class="page-title float-left">Voucher</h4>
                  <ol class="breadcrumb float-right">
                    <button type="button" class="btn btn-gradient btn-rounded waves-light waves-effect w-md" data-toggle="modal" data-target="#add-voucher">Add Voucher</button>
                  </ol>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                  <table id="user_data" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                          <th width="20%">Name</th>
                          <th width="15%">Code</th>
                          <th width="5%">Amount</th>
                          <th width="15%">Start date</th>
                          <th width="15%">End date</th>
                          <th width="10%">Time from</th>
                          <th width="10%">Time to</th>
                          <th width="10%">Minimum Cart Value</th>
                          <th width="5%">Edit</th>
                          <th width="5%">Delete</th>
                      </tr>
                    </thead>
                  </table>
                </div>
            </div>
          </div>
        </div>
      </div>
      <?php $this->load->view('admin/includes/footer.php'); ?>

    <div id="add-voucher" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
             <div class="modal-dialog">
                 <div class="modal-content">

                     <div class="modal-body">
                         <h2 class="text-uppercase text-center m-b-30">
                             <span><h4>Add Voucher</h4></span>
                         </h2>


                         <form class="form-horizontal" action="<?=site_url('admin/voucher/addVoucher')?>" method="post" onsubmit="return finalize()">
                             
                             <div class="form-group m-b-25">
                                 <div class="col-12">
                                     <label for="select">Voucher name</label>
                                     <input type="text" class="form-control" name="voucher_name" required>
                                 </div>
                             </div>

                             <div class="form-group m-b-25">
                                 <div class="col-12">
                                     <label for="select">Voucher code</label>
                                     <label class="pull-right"><button type="button" class="btn btn-link" style="padding:0px;margin:0px;" onclick="generate()">Change</button></label>
                                     <input type="text" class="form-control" name="code" id="code" required readonly>
                                 </div>
                             </div>

                             <div class="form-group m-b-25">
                                 <div class="col-12">
                                     <label for="select">Amount</label><br>
                                     <input type="number" min="0" class="form-control" name="amount" placeholder="Amount" required>
                                 </div>
                             </div>

                             <div class="form-group m-b-25">
                                 <div class="col-12">
                                     <label for="select">Date From</label>
                                     <input type="date" class="form-control" name="date_from" placeholder="" required>
                                 </div>
                             </div>

                             <div class="form-group m-b-25">
                                <div class="col-12">
                                    <label for="select">End date</label>
                                    <input type="date" class="form-control" name="end_date" id="end_date">
                                </div>
                             </div>

                             <div class="form-group m-b-25">
                                 <div class="col-12">
                                     <label for="select">Time from</label>
                                     <input type="time" class="form-control" name="time_from" placeholder="" required>
                                 </div>
                             </div>
                             
                            <div class="form-group m-b-25">
                                 <div class="col-12">
                                     <label for="select">Time to</label>
                                     <input type="time" class="form-control" name="time_to" placeholder="" required>
                                 </div>
                             </div>
                             
                             <div class="form-group m-b-25">
                                 <div class="col-12">
                                     <label for="select">Minimun Cart Value</label>
                                     <input type="number" min="0" class="form-control" name="cart_value" placeholder="Minimun cart value" required>
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


     <div id="edit-voucher" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog">
              <div class="modal-content">

                  <div class="modal-body">
                      <h2 class="text-uppercase text-center m-b-30">
                          <span><h4>Edit Voucher</h4></span>
                      </h2>
                    <form class="form-horizontal" action="<?=site_url('admin/voucher/update')?>" method="post" onsubmit="return checking()">
                       
                       <input type="hidden" class="form-control" name="voucher_id" id="voucher_id">      
                       <div class="form-group m-b-25">
                           <div class="col-12">
                               <label for="select">Voucher name</label>
                               <input type="text" class="form-control" name="voucher_name" id="voucher_name" required>
                           </div>
                       </div>

                       <div class="form-group m-b-25">
                           <div class="col-12">
                               <label for="select">Voucher code</label>
                               <input type="text" class="form-control" name="code" id="voucher_code" required readonly>
                           </div>
                       </div>

                       <div class="form-group m-b-25">
                           <div class="col-12">
                               <label for="select">Amount</label><br>
                               <input type="number" min="0" id="amount" class="form-control" name="amount" placeholder="Amount" required>
                           </div>
                       </div>

                       <div class="form-group m-b-25">
                           <div class="col-12">
                               <label for="select">Date From</label>
                               <input type="date" class="form-control" id="from_date" name="date_from" placeholder="" required>
                           </div>
                       </div>

                       <div class="form-group m-b-25">
                          <div class="col-12">
                              <label for="select">End date</label>
                              <input type="date" class="form-control" name="end_date" id="last_date">
                          </div>
                       </div>

                       <div class="form-group m-b-25">
                           <div class="col-12">
                               <label for="select">Time from</label>
                               <input type="time" class="form-control" id="time_start" name="time_from" placeholder="" required>
                           </div>
                       </div>
                       
                      <div class="form-group m-b-25">
                           <div class="col-12">
                               <label for="select">Time to</label>
                               <input type="time" class="form-control" id="last_time" name="time_to" placeholder="" required>
                           </div>
                       </div>
                       
                       <div class="form-group m-b-25">
                           <div class="col-12">
                               <label for="select">Minimun Cart Value</label>
                               <input type="number" min="0" class="form-control" name="cart_value" id="cart_value" placeholder="Minimun cart value" required>
                           </div>
                       </div>

                      <div class="form-group m-b-25">
                        <div class="col-12">
                            <p id="error-message1" style="color:red;"></p>
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
  <script type="text/javascript">
    $(document).ready(function(){
      var dataTable = $('#user_data').DataTable({
        "processing":true,
        "serverSide":true,
        "order":[],
        "ajax":{
          url:"<?=site_url('admin/voucher/get')?>",
          type:"POST"
        },
        "columnDefs":[
          {
            "target":[0,3,4],
            "orderable":true
          }
        ]
      });
    });
  </script>
  <script>
    function del()
    {
      if (confirm('Are you sure to delete this voucher ?')) {
        return true;
      }
      else {
        return false;
      }
    }

    function edit(id)
    {
      $('#voucher_id').val(id);
      // alert(id);
      $.ajax({
          method: "POST",
          url: "<?php echo site_url('admin/voucher/getVoucherById');?>",
          dataType : "json",
          data : { id : id },
          success : function( data ){
            $('#voucher_name').val(data.voucher_name);
            $('#voucher_code').val(data.voucher_code);
            $('#amount').val(data.amount);
            $('#from_date').val(data.valid_from);
            $('#last_date').val(data.valid_to);
            $('#time_start').val(data.time);
            $('#last_time').val(data.time_to);
            $('#cart_value').val(data.minimum_cart_value);
            $('#edit-voucher').modal('show');
            // alert(data);
          }
        });
    }

    function makeid() {
        var text = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

        for (var i = 0; i < 10; i++)
          text += possible.charAt(Math.floor(Math.random() * possible.length));

        return text;
      }
      function generate()
      {
        var random = makeid();
        $('#code').val(random);
      }

      function finalize()
      {
        var end    = $('#end_date').val();
        var myDate = new Date(end);
        var today  = new Date();
        
        if (myDate < today) {
          $('#error-message').text('Please select valid date');
          $('#error-message').fadeIn().delay(1500).fadeOut(1200);
          return false;
        }
        else {
          $('#error-message').text('');
          return true;
          
          }
      }

      function checking()
      {
        var end    = $('#last_date').val();
        var myDate = new Date(end);
        var today  = new Date();
        
        if (myDate < today) {
          $('#error-message1').text('Please select valid date');
          $('#error-message1').fadeIn().delay(1500).fadeOut(1200);
          return false;
        }
        else {
          $('#error-message1').text('');
          return true;
          
          }
      }

  </script>
</html>
