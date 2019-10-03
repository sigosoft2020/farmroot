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
                  <h4 class="page-title float-left">Vendors</h4>
                  <ol class="breadcrumb float-right">
                    <button type="button" class="btn btn-gradient btn-rounded waves-light waves-effect w-md" data-toggle="modal" data-target="#add-vendor">Add Vendor</button>
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
                        <th width="15%">Vendor name</th>
                        <th width="10%">Phone</th>
                        <th width="10%">Email</th>
                        <th width="10%">GST No</th>
                        <th width="20%">Address</th>
                        <th width="10%">City</th>
                        <th width="10%">State</th>
                        <th width="10%">PIN Code</th>
                        <th width="5%">Status</th>
                        <th width="5%">Edit</th>
                        <th width="5%">Block/Enable</th>
                      </tr>
                    </thead>
                  </table>
                </div>
            </div>
          </div>
        </div>
      </div>
      <?php $this->load->view('admin/includes/footer.php'); ?>

      <div id="add-vendor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog">
              <div class="modal-content">

                  <div class="modal-body">
                      <h2 class="text-uppercase text-center m-b-30">
                          <span><h4>Add Vendor</h4></span>
                      </h2>
                      <form class="form-horizontal" action="<?=site_url('admin/vendor/addVendor')?>" method="post">
                          <div class="form-group m-b-25">
                              <div class="col-12">
                                  <label for="select">Vendor Name</label>
                                  <input type="text" name="vendor_name" id="vendor_name" class="form-control" required>
                              </div>
                          </div>

                           <div class="form-group m-b-25">
                              <div class="col-12">
                                  <label for="select">Phone</label>
                                  <input type="text" id="Phone" name="Phone" pattern="[6-9]{1}[0-9]{9}"  placeholder="Phone" title="Enter valid phone number" maxlength="10" class="form-control" required>
                              </div>
                          </div>

                          <div class="form-group m-b-25">
                              <div class="col-12">
                                  <label for="select">Email</label>
                                  <input type="email" id="Email" name="Email" placeholder="Email" class="form-control" required>
                              </div>
                          </div>

                          <div class="form-group m-b-25">
                              <div class="col-12">
                                  <label for="select">GST Number</label>
                                  <input type="text" id="GSTNo" name="GSTNo" placeholder="GST NO" class="form-control" required>
                              </div>
                          </div>
                          
                          <div class="form-group m-b-25">
                              <div class="col-12">
                                  <label for="select">Address</label>
                                  <textarea id="Address" required="required" name="Address" class="form-control" rows="5"></textarea>
                              </div>
                          </div>

                          <div class="form-group m-b-25">
                              <div class="col-12">
                                  <label for="select">City</label>
                                  <input type="text" id="City" name="City" placeholder="City" class="form-control" required>
                              </div>
                          </div>

                          <div class="form-group m-b-25">
                              <div class="col-12">
                                  <label for="select">Pin code</label>
                                  <input  type="number" id="PINCode" name="PINCode" placeholder="Pin code" min="0" class="form-control" required>
                              </div>
                          </div>

                          <div class="form-group m-b-25">
                              <div class="col-12">
                                  <label for="select">State</label>
                                  <input type="text" id="State" name="State" placeholder="State" class="form-control" required>
                              </div>
                          </div>
                        
                          <div class="form-group account-btn text-center m-t-10">
                              <div class="col-12">
                                  <button type="reset" class="btn btn-primary btn-rounded waves-light waves-effect w-md " data-dismiss="modal">Back</button>
                                  <button class="btn btn-success btn-rounded waves-light waves-effect w-md " type="submit">Add</button>
                              </div>
                          </div>
                      </form>
                 </div>
              </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
      </div>


     <div id="edit-vendor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog">
              <div class="modal-content">

                  <div class="modal-body">
                      <h2 class="text-uppercase text-center m-b-30">
                          <span><h4>Edit Vendor</h4></span>
                      </h2>
                      <form class="form-horizontal" action="<?=site_url('admin/vendor/update')?>" method="post">
                           <input type="hidden" name="vendor_id" id="vendor_id" class="form-control">
                          <div class="form-group m-b-25">
                              <div class="col-12">
                                  <label for="select">Vendor Name</label>
                                  <input type="text" name="vendor" id="name" class="form-control" required>
                              </div>
                          </div>

                           <div class="form-group m-b-25">
                              <div class="col-12">
                                  <label for="select">Phone</label>
                                  <input type="text" id="phone" name="Phone" pattern="[6-9]{1}[0-9]{9}"  placeholder="Phone" title="Enter valid phone number" maxlength="10" class="form-control" required>
                              </div>
                          </div>

                          <div class="form-group m-b-25">
                              <div class="col-12">
                                  <label for="select">Email</label>
                                  <input type="email" id="email" name="Email" placeholder="Email" class="form-control" required>
                              </div>
                          </div>

                          <div class="form-group m-b-25">
                              <div class="col-12">
                                  <label for="select">GST Number</label>
                                  <input type="text" id="gstno" name="GSTNo" placeholder="GST NO" class="form-control" required>
                              </div>
                          </div>
                          
                          <div class="form-group m-b-25">
                              <div class="col-12">
                                  <label for="select">Address</label>
                                  <textarea id="address" required="required" name="Address" class="form-control" rows="5"></textarea>
                              </div>
                          </div>

                          <div class="form-group m-b-25">
                              <div class="col-12">
                                  <label for="select">City</label>
                                  <input type="text" id="city" name="City" placeholder="City" class="form-control" required>
                              </div>
                          </div>

                          <div class="form-group m-b-25">
                              <div class="col-12">
                                  <label for="select">Pin code</label>
                                  <input  type="number" id="pincode" name="PINCode" placeholder="Pin code" min="0" class="form-control" required>
                              </div>
                          </div>

                          <div class="form-group m-b-25">
                              <div class="col-12">
                                  <label for="select">State</label>
                                  <input type="text" id="state" name="State" placeholder="State" class="form-control" required>
                              </div>
                          </div>
                        
                          <div class="form-group account-btn text-center m-t-10">
                              <div class="col-12">
                                  <button type="reset" class="btn btn-primary btn-rounded waves-light waves-effect w-md " data-dismiss="modal">Back</button>
                                  <button class="btn btn-success btn-rounded waves-light waves-effect w-md " type="submit">Update</button>
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
          url:"<?=site_url('admin/vendor/get')?>",
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
      if (confirm('Are you sure to delete this banner ?')) {
        return true;
      }
      else {
        return false;
      }
    }

    function edit(id)
    {
      $('#vendor_id').val(id);
      // alert(id);
      $.ajax({
          method: "POST",
          url: "<?php echo site_url('admin/vendor/getVendorById');?>",
          dataType : "json",
          data : { id : id },
          success : function( data ){
            $('#name').val(data.VendorName);
            $('#phone').val(data.Phone);
            $('#email').val(data.Email);
            $('#gstno').val(data.GSTNo);
            $('#address').val(data.Address);
            $('#city').val(data.City);  
            $('#state').val(data.State);
            $('#pincode').val(data.PINCode);  
            $('#edit-vendor').modal('show');
            // alert(data);
          }
        });
    }

  </script>
</html>
