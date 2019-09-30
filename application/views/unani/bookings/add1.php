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
                  <!-- <ol class="breadcrumb float-right">
                    <button type="button" class="btn btn-gradient btn-rounded waves-light waves-effect w-md">Add amenity</button>
                  </ol> -->
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="card-box" style="min-height:700px;">
                <form action="<?=site_url('owner/bookings/addBooking')?>" method="post">
                  <div class="row">



                    <div class="col-md-4">
                      <label>Select customer</label>
                      <select class="form-control form-control-xs selectpicker" name="user_id" data-size="7" data-live-search="true" data-title="Search mobile number or name" id="" data-width="100%" required>
                        <?php foreach ($users as $user) { ?>
                          <option value="<?=$user->user_id?>" data-subtext="<?=$user->mobile?>" <?php if($user_id == $user->user_id){ ?>selected<?php } ?>><?=$user->username?></option>
                        <?php } ?>
                        </select>
                    </div>

                    <div class="col-md-4">
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

                      <div id="fee-div" style="display:none;" class="col-md-4">
                        <h4 style="border : 1px solid black;border-radius:10px;padding:20px;">BOOKING FEE :  <span id="fee"></span></h4>
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
    $('#turf').on('change',function(){
      $('#slot-div').html('');
      $("#submit-button").css("display", "none");
      $.ajax({
        method: "POST",
        url: "<?=site_url('owner/bookings/getDates');?>",
        dataType : "json",
        success : function( data ){
          $('#date-div').html(data);
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

        $("#fee").text('');
        $("#rate").val('');
        $("#from_time").val('');
        $("#to_time").val('');
        $("#slot").val('');
        $("#date").val('');
        $("#tp_id").val('');
      }
      else {
        $("#fee-div").css("display", "block");
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
          console.log(data);
        }
      });
    }
  </script>
</html>
