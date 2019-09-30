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
                  <h4 class="page-title float-left">Wholesaler</h4>
                 
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
                        <th width="5%">View</th>
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

     <div id="show-wholesaler" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog">
              <div class="modal-content">

                  <div class="modal-body">
                      <h2 class="text-uppercase text-center m-b-30">
                          <span><h4>View Wholesaler</h4></span>
                      </h2>
                      <form class="form-horizontal" action="" method="">
                          
                          <div class="form-group m-b-25">
                              <div class="col-12">
                                  <label for="select">Name</label>
                                  <input type="text" name="name" id="name" class="form-control" readonly>
                              </div>
                          </div>

                           <div class="form-group m-b-25">
                              <div class="col-12">
                                  <label for="select">Phone</label>
                                  <input type="text" name="phone" id="phone" class="form-control" readonly>
                              </div>
                          </div>

                          <div class="form-group m-b-25">
                              <div class="col-12">
                                  <label for="select">Email</label>
                                  <input type="text" name="email" id="email" class="form-control" readonly>
                              </div>
                          </div>

                           <div class="form-group m-b-25">
                              <div class="col-12">
                                  <label for="select">Address</label>
                                  <textarea id="address"  name="address" class="form-control col-md-7 col-xs-12" rows="5" readonly></textarea>
                              </div>
                          </div>

                           <div class="form-group m-b-25">
                              <div class="col-12">
                                  <label for="select">City</label>
                                  <input type="text" name="city" id="city" class="form-control" readonly>
                              </div>
                           </div>

                           <div class="form-group m-b-25">
                              <div class="col-12">
                                  <label for="select">Pincode</label>
                                  <input type="text" name="pincode" id="pincode" class="form-control" readonly>
                              </div>
                           </div>
                        
                          <div class="form-group account-btn text-center m-t-10">
                              <div class="col-12">
                                  <button type="reset" class="btn btn-primary btn-rounded waves-light waves-effect w-md " data-dismiss="modal">Back</button>
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
          url:"<?=site_url('admin/wholesaler/get')?>",
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
