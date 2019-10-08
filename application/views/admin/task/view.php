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
                  <h4 class="page-title float-left">Tasks</h4>
                  
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
                          <th>Order No</th>
                          <th>Invoice No</th>
                          <th>Name</th>
                          <th>Address</th>
                          <th>Landmark</th>
                          <th>City</th>
                          <th>Mobile</th>
                          <th>Delivery Date</th>
                          <th>Type Of Sale</th>
                          <th>Assign Tasks</th>
                          <th>Assigned Staff</th>
                          <th>Assigned Date</th>
                      </tr>
                    </thead>
                  </table>
                </div>
            </div>
          </div>
        </div>
      </div>
      <?php $this->load->view('admin/includes/footer.php'); ?>

      <div id="add-task" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog">
              <div class="modal-content">

                  <div class="modal-body">
                      <h2 class="text-uppercase text-center m-b-30">
                          <span><h4>Assign Task</h4></span>
                      </h2>
                      <form class="form-horizontal" action="<?=site_url('admin/task/assign_task')?>" method="post">
                          <input type="hidden" name="order_id" id="Order_id">
                          <input type="hidden" name="user_id" id="User_id">

                          <div class="form-group m-b-25">
                              <div class="col-12">
                                  <label for="select">Staff</label>
                                  <select class="form-control" id="staff" name="staff" required>
                                      <option value="">---Select Staff---</option>
                                    <?php foreach($staffs as $staff) {?>
                                      <option value="<?=$staff->staff_id?>"><?=$staff->name?></option>
                                    <?php };?>
                                  </select>
                              </div>
                          </div>

                           <div class="form-group m-b-25">
                              <div class="col-12">
                                  <label for="select">Notes</label>
                                  <textarea class="form-control" name="notes" id="notes" rows="2" placeholder="Notes" required></textarea>
                              </div>
                          </div>

                          <div class="form-group m-b-25">
                              <div class="col-12">
                                  <label for="select">Start Date</label>
                                  <input type="date" id="start_date" name="start_date" placeholder="Start Date" class="form-control" required>
                              </div>
                          </div>

                          <div class="form-group m-b-25">
                              <div class="col-12">
                                  <label for="select">End Date</label>
                                  <input type="date" id="end_date" name="end_date" placeholder="End Dtae" class="form-control" required>
                              </div>
                          </div>
                          
                          <div class="form-group m-b-25">
                              <div class="col-12">
                                  <label for="select">Time</label>
                                  <input type="text" id="time" name="time" placeholder="Time" class="form-control" required>
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
          url:"<?=site_url('admin/task/get')?>",
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
    function edit(order_id,user_id)
    {
      $('#Order_id').val(order_id);
      $('#User_id').val(user_id);
      // alert(id);
      $('#add-task').modal('show');
    }

  </script>
</html>
