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
                  <h4 class="page-title float-left">Delivery Date</h4>
                  <ol class="breadcrumb float-right">
                    <button type="button" class="btn btn-gradient btn-rounded waves-light waves-effect w-md" data-toggle="modal" data-target="#add-date">Add Delivery Date</button>
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
                        <th width="30%">Delivery Date</th>
                        <th width="30%">Category</th>
                        <th width="10%">Edit</th>
                        <th width="10%">Delete</th>
                      </tr>
                    </thead>
                  </table>
                </div>
            </div>
          </div>
        </div>
      </div>
      <?php $this->load->view('admin/includes/footer.php'); ?>

      <div id="add-date" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog">
              <div class="modal-content">

                  <div class="modal-body">
                      <h2 class="text-uppercase text-center m-b-30">
                          <span><h4>Add Delivery Date</h4></span>
                      </h2>
                      <form class="form-horizontal" action="<?=site_url('admin/delivery_date/addData')?>" method="post" onsubmit="return finalize()">
                          
                           <div class="form-group m-b-25">
                              <div class="col-12">
                                  <label for="select">Category</label>
                                  <select class="form-control" name="category" required>
                                     <option value="">---Select Category---</option>
                                     <option value="Vegetables">Vegetables</option>
                                     <option value="Non Vegetables">Non Vegetables</option>
                                  </select>
                              </div>
                          </div>

                          <div class="form-group m-b-25">
                              <div class="col-12">
                                  <label for="select">Delivery Date</label>
                                  <input type="date" name="delivery_date" id="delivery_date" class="form-control" required>
                              </div>
                          </div>

                          <div class="form-group m-b-25">
                            <div class="col-12">
                                <p id="error-message" style="color:red;"></p>
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
          url:"<?=site_url('admin/delivery_date/get')?>",
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

    function finalize()
    {
        var end    = $('#delivery_date').val();
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

  </script>
</html>
