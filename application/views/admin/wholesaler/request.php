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
                  <h4 class="page-title float-left">Wholesaler Requests</h4>
                 
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
                        <th width="30%">Name</th>
                        <th width="20%">Phone</th>
                        <th width="20%">Email</th>
                        <th width="20%">City</th>
                        <th width="5%">Approve</th>
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
          url:"<?=site_url('admin/wholesaler/get_request')?>",
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
      if (confirm('Are you sure to delete this wholesaler ?')) {
        return true;
      }
      else {
        return false;
      }
    }

    function approve()
    {
      if (confirm('Are you sure to approve this wholesaler ?')) {
        return true;
      }
      else {
        return false;
      }
    }

    function view(id)
    {
      
      $.ajax({
          method: "POST",
          url: "<?php echo site_url('admin/wholesaler/getWholesalerById');?>",
          dataType : "json",
          data : { id : id },
          success : function( data ){
            $('#name').val(data.name);
            $('#phone').val(data.phone);
            $('#email').val(data.email);
            $('#address').val(data.address);
            $('#city').val(data.city);
            $('#pincode').val(data.pincode);
            $('#show-wholesaler').modal('show');
            // alert(data);
          }
        });
    }

  </script>
</html>
