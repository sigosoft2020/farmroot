<!DOCTYPE html>
<html>
  <head>
    <?php $this->load->view('owner/includes/includes.php'); ?>
    <link href="<?=base_url()?>plugins/select/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>plugins/select/select.css" rel="stylesheet" type="text/css" />
    <style media="screen">
      .button {
        color: black;
        padding: 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        border-radius: 50%;
      }
      .button-pitch{
        color: black;
        padding: 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
      }
      .button-slot {
        color: black;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        padding-top:25px;
        padding-bottom:25px;
        border-radius: 100%;
      }
    </style>
  </head>
  <body>
    <div id="wrapper">
      <?php $this->load->view('owner/includes/sidebar.php'); ?>
      <div class="content-page">
        <div class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="page-title-box">
                  <h4 class="page-title float-left">ADD BOOKING</h4>
                  <ol class="breadcrumb float-right">
                    <button type="button" class="btn btn-gradient btn-rounded waves-light waves-effect w-md" data-toggle="modal" data-target="#add-customer">Add customer</button>
                  </ol>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="card-box" style="min-height:700px;">
                <form action="<?=site_url('owner/bookings/addBooking')?>" method="post" id="add-form">
                  <div class="row">



                    <div class="col-md-4" id="search-div-1">
                      <div class="fomr-group">
                        <label>Search customer</label>
                        <input type="text" class="form-control" id="customer-mobile">
                        <p style="color:red;font-style:italic;" id="search-errors"></p>
                      </div>
                    </div>
                    <div class="col-md-6" id="search-div-2">
                      <div class="form-group">
                          <button type="button" class="btn btn-success" id="customer-mobile-search" name="button" style="margin-top:30px;">Search</button>
                      </div>
                    </div>

                    <div class="col-md-12" id="user-details" style="display:none;">
                      <input type="hidden" name="user_id" id="user_id">
                      <h6>User Id : <span id="user-id" style="color:green;"></span></h6>
                      <h6>Name : <span id="user-name" style="color:green;"></span></h6>
                      <h6>Mobile number : <span id="user-mobile" style="color:green;"></span></h6>
                      <hr>
                    </div>

                    <div class="col-md-4" id="turf-div" style="display:none;">
                      <label>Select turf</label>
                      <select class="form-control form-control-xs selectpicker" name="turf_id" data-size="7" data-live-search="true" data-title="Search turfname" id="turf" data-width="100%" required>
                        <?php foreach ($turfs as $turf) { ?>
                          <option value="<?=$turf->turf_id?>" data-subtext="<?=$turf->place?>"><?=$turf->turf_name?></option>
                        <?php } ?>
                      </select>
                    </div>

                    <div class="col-md-12 mt-3">
                      <div id="date-div">

                      </div>
                    </div>

                    <div class="col-md-12 mt-3">
                      <div id="pitch-div" class="button-list">

                      </div>
                    </div>

                    <div class="col-md-12 mt-3">
                      <div id="slot-div" class="button-list">

                      </div>
                      <p style="font-style:italic;color:red;padding-top:20px;" id="slot-error"></p>
                      <div id="fee-div" style="display:none;">
                        <div class="row">
                          <div class="col-md-6">
                            <h4 style="border : 1px solid black;border-radius:10px;padding:20px;text-align:center;">TOTAL FEE :  <span id="fee"></span></h4>
                          </div>
                          <div class="col-md-6">
                            <h4 style="border : 1px solid black;border-radius:10px;padding:20px;text-align:center;">BOOKING FEE :  <span id="booking-fee"></span></h4>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Advance amount received</label>
                              <input type="number" min="0" id="advance_amount" step="any" class="form-control" name="cash_recieved" required>
                            </div>
                          </div>
                        </div>
                      </div>

                      <input type="hidden" name="tp_id" id="tp_id">
                      <input type="hidden" name="from_time" id="from_time">
                      <input type="hidden" name="to_time" id="to_time">
                      <input type="hidden" name="date" id="date">
                      <input type="hidden" name="slot" id="slot">
                      <input type="hidden" name="rate" id="rate">

                      <button id="submit-button" type="submit" class="btn btn-success waves-light waves-effect w-md pull-right" style="display:none;">Book</button>
                    </div>


                  </div>
                </form>

              </div>
            </div>

          </div>
        </div>
      </div>
      <?php $this->load->view('owner/includes/footer.php'); ?>
    </div>
    <div class="modal fade" id="add-customer" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">ADD CUSTOMER</h4>
        </div>
        <div class="modal-body">
          <form action="<?=site_url('owner/bookings/addCustomer')?>" method="post" id="add-form-customer">

            <div class="form-group">
                <p class="mb-1 font-weight-bold">Username <span style="color:red">*</span></p>
                <p class="text-muted font-14">
                      (Enter customer name here)
                </p>
                <input type="text" maxlength="50" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <p class="mb-1 font-weight-bold">Mobile <span style="color:red">*</span></p>
                <p class="text-muted font-14">
                      (Mobile number must contain 10 digits)
                </p>
                <input type="text" maxlength="10" name="mobile" id="mo" class="form-control" required>
                <p id="mobile_error" style="display:none;color:red">Invalid mobile number</p>
            </div>
            <div class="form-group">
                <p class="mb-1 font-weight-bold">Email address</p>
                <p class="text-muted font-14">
                      (Format : someone@domain.com)
                </p>
                <input type="email" maxlength="100" name="email" id="em" class="form-control">
                <p id="email_error" style="display:none;color:red">Invalid mobile number</p>
            </div>
            <div class="form-group">
                <p class="mb-1 font-weight-bold">Password <span style="color:red">*</span></p>
                <p class="text-muted font-14">
                      (Default password will be wooslot , password must contains 6 to 12 characters)
                </p>
                <input type="text" pattern=".{6,12}" class="form-control" value="wooslot" id="password" required>
                <!-- <input class="sample_input" type="hidden" name="test[image]"> -->
            </div>
            <input type="hidden" name="image" value="">

        </div>
        <div class="modal-footer">

          <button type="submit" class="btn btn-success" id="submit-customer-button">Add</button>
        </form>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
  </body>
  <?php $this->load->view('owner/includes/scripts.php'); ?>
  <!-- <script src="<?=base_url()?>plugins/select/slim.min.js"></script> -->
  <script src="<?=base_url()?>plugins/select/popper.min.js"></script>
  <script src="<?=base_url()?>plugins/select/select.js"></script>
  <script>
    var selected_button = 0;
    var selected_pitch = 0;
    var date = '';
    var day_id  = '';
    var slots = [];
    var ts_ids = [];
    var tp_id = 0;
    var percentage = 0;
    $('#turf').on('change',function(){
      $('#slot-div').html('');
      $("#submit-button").css("display", "none");
      var turf_id = $('#turf').val();
      $.ajax({
        method: "POST",
        url: "<?=site_url('owner/bookings/getDates');?>",
        data : { turf_id : turf_id },
        dataType : "json",
        success : function( data ){
          $('#date-div').html(data.string);
          window.percentage = data.percentage;
        }
      });
    });
    function getPitches(id)
    {
      $("#submit-button").css("display", "none");
      $("#fee-div").css("display", "none");
      $('#slot-div').html('');
      $('#pitch-div').html('');

      $('#btn_'+id).addClass('btn-success');
      if (selected_button != 0) {
        $('#btn_'+selected_button).removeClass('btn-success');
      }
      window.selected_button = id;

      var reference = $('#btn_'+id);
      window.date = reference.attr('name');
      window.day_id = reference.val();

      var turf_id = $('#turf').val();

      $.ajax({
        method: "POST",
        url: "<?=site_url('owner/bookings/getPitches');?>",
        data : { turf_id : turf_id },
        dataType : "json",
        success : function( data ){
          $('#pitch-div').html(data);
        }
      });
    }
    function getSlots(id){
      $("#fee-div").css("display", "none");
      $('#pitch_'+id).addClass('btn-success');
      if (selected_pitch != 0) {
        $('#pitch_'+selected_pitch).removeClass('btn-success');
      }
      selected_pitch = id;

      var reference = $('#pitch_'+id);
      window.tp_id = reference.attr('name');
      var turf_id = $('#turf').val();

      $.ajax({
        method: "POST",
        url: "<?=site_url('owner/bookings/getTimeSlots');?>",
        data : { turf_id : turf_id , tp_id : tp_id , date : date},
        dataType : "json",
        success : function( data ){
          $('#slot-div').html(data);
        }
      });

    }
    function setSlots(param)
    {
      $("#submit-button").css("display", "block");
      var length = slots.length;
      if (length == 0) {
        slots.push(param);
        $('#slot_'+param).addClass('btn-success');
      }
      else {
        if (slots.includes(param)) {
          if(param == slots[0] || param == slots[slots.length-1])
          {
            $('#slot-error').text('');
            $('#slot_'+param).removeClass('btn-success');

            var index = slots.indexOf(param);
            slots.splice(index, 1);
          }
          else {
            $('#slot-error').text('You cant remove this slot..!');
          }
        }
        else {
          var length = slots.length;
          for (var i = 0; i < length; i++) {
            if (slots[i] - 1 == param || +slots[i] + +1 == param) {
              $('#slot-error').text('');
              slots.push(param);
              $('#slot_'+param).addClass('btn-success');
              slots.sort();
            }
            else {
              $('#slot-error').text('Please choose adjacent slots..!');
            }
          }
        }
      }
      if (slots.length == 0) {
        $("#submit-button").css("display", "none");
        $("#fee-div").css("display", "none");
        $("#booking-fee-div").css("display", "none");

        $("#fee").text('');
        $("#booking-fee").text('');
        $("#rate").val('');
        $("#from_time").val('');
        $("#to_time").val('');
        $("#slot").val('');
        $("#date").val('');
        $("#tp_id").val('');
      }
      else {
        $("#fee-div").css("display", "block");
        $("#booking-fee-div").css("display", "block");
        price();
      }
    }
    function price()
    {
      var k=0;
      var array = [];
      for (var k = 0; k < slots.length; k++) {
        ts_id = $('#slot_'+slots[k]).val();
        array.push(ts_id);
      }
      var jsonString = JSON.stringify(array);
      $.ajax({
        method: "POST",
        url: "<?=site_url('owner/bookings/getTotalFee');?>",
        data : { ts_ids : jsonString , tp_id : tp_id , day_id : day_id , date : date },
        dataType : "json",
        success : function( data ){
          $("#fee").text(data.fee);
          $("#rate").val(data.fee);
          $("#from_time").val(data.from);
          $("#to_time").val(data.to);
          $("#slot").val(data.slot);
          $("#date").val(date);
          $("#tp_id").val(tp_id);

          book_fee = ( data.fee * percentage )/100;
          $("#booking-fee").text(book_fee);
          
          $('#advance_amount').attr('max',data.fee);
          console.log(data);
        }
      });
    }
    $('#add-form-customer').on('submit', function(e){
      e.preventDefault();
      $('#submit-customer-button').attr('disabled',true);
      
      var flag = true;
      var email = $('#em').val();
      var mobile = $('#mo').val();
      
      var format = /[ !@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
      var special = format.test(mobile);

      if (isNaN(mobile) || mobile.length != 10 || special) {
        $("#mobile_error").css("display", "none");
        $("#email_error").css("display", "none");
        if (isNaN(mobile)) {
          $("#mobile_error").text("Invalid Mobile number");
          $("#mobile_error").css("display", "block");
        }
        if (mobile.length != 10) {
          $("#mobile_error").text("Mobile number must contain 10 digits");
          $("#mobile_error").css("display", "block");
        }
        if (special) {
          $("#mobile_error").text("Please enter a valid mobile number..!");
          $("#mobile_error").css("display", "block");
        }
        $('#submit-customer-button').attr('disabled',false);
      }
      else {
        $("#mobile_error").css("display", "none");
        $("#email_error").css("display", "none");
        $.ajax({
            method: "POST",
            url: "<?php echo site_url('owner/customers/validation');?>",
            dataType : "json",
            data : { mobile : mobile , email : email },
            success : function( data ){

              if (data.mobile) {
                $("#mobile_error").text("Mobile number already registered..!");
                $("#mobile_error").css("display", "block");
                flag = false;
              }

              if (data.email) {
                $("#email_error").text("Email address already registered..!");
                $("#email_error").css("display", "block");
                flag = false;
              }
              if (flag) {
                document.getElementById("add-form-customer").submit();
              }
              else
              {
                  $('#submit-customer-button').attr('disabled',false);
              }
            }
          });
      }
    });
    
    $('#customer-mobile-search').on('click',function(){
      $('#search-errors').text('');
      var mobile = $('#customer-mobile').val();
      if (isNaN(mobile)) {
        $('#search-errors').text('Invalid mobile number..!');
      }
      else {
        if (mobile.length != 10) {
          $('#search-errors').text('Please enter a 10 digit mobile number..!');
        }
        else {
          $.ajax({
            method: "POST",
            url: "<?=site_url('owner/customers/getCustomerDetails');?>",
            data : { mobile : mobile },
            dataType : "json",
            success : function( data ){
              if (data.user) {
                $("#user-details").css("display", "block");
                $('#user-id').text(data.user_id);
                $('#user-name').text(data.name);
                $('#user-mobile').text(data.mobile);

                $('#user_id').val(data.user_id);

                $("#turf-div").css("display", "block");
                $("#search-div-1").css("display", "none");
                $("#search-div-2").css("display", "none");
              }
              else {
                $('#search-errors').text('Customer not registered yet , Please register and try again..!');
              }
            }
          });
        }
      }
    });
    $('#add-form').on('submit', function(e){
        e.preventDefault();
        $('#submit-button').attr('disabled',true);
        document.getElementById("add-form").submit();
    });
  </script>
</html>
