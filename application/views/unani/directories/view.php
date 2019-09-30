<!DOCTYPE html>
<html>
  <head>
    <?php $this->load->view('unani/includes/includes.php'); ?>
    <?php $this->load->view('unani/includes/table-css.php'); ?>
  </head>
  <body>
    <div id="wrapper">
      <?php $this->load->view('unani/includes/sidebar.php'); ?>
      <div class="content-page">
        <div class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="page-title-box">
                  <h4 class="page-title float-left">DIRECTORIES</h4>
                  <!-- <ol class="breadcrumb float-right">
                    <button type="button" class="btn btn-gradient btn-rounded waves-light waves-effect w-md">Add amenity</button>
                  </ol> -->
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
                        <th width="10%">Image</th>
                        <th width="10%">Name</th>
                        <th width="10%">Designation</th>
                        <th width="10%">Mobile</th>
                        <th width="10%">Email address</th>
                        <th width="40%">Description</th>
                        <th width="5%">Status</th>
                        <th width="5%">Edit</th>
                      </tr>
                    </thead>
                  </table>
                </div>
            </div>
          </div>
        </div>
      </div>
      <?php $this->load->view('unani/includes/footer.php'); ?>
    </div>
    <div id="change-pass" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body">
                    <h2 class="text-uppercase text-center m-b-30">
                      <span><h4>Change password</h4></span>
                    </h2>
                    <form class="form-horizontal" action="<?=site_url('unani/directories/changePassword')?>" method="post" onsubmit="return check()">
                        <div class="form-group m-b-25">
                            <div class="col-12">
                                <label for="select">Password</label>
                                <input type="password" name="password" id="pass1" class="form-control" required>
                            </div>
                        </div>
                        <input type="hidden" name="user_id" id="user_id">
                        <div class="form-group m-b-25">
                            <div class="col-12">
                                <label for="select">Confirm password</label>
                                <input type="password"  id="pass2" class="form-control" required>
                            </div>
                        </div>
                        <div class="" style="text-align:center;color:red;padding-bottom:10px;" id="message">
                        </div>
                        <div class="form-group account-btn text-center m-t-10">
                            <div class="col-12">
                                <button type="reset" class="btn w-lg btn-rounded btn-light waves-effect m-l-5" data-dismiss="modal">Back</button>
                                <button class="btn w-lg btn-rounded btn-primary waves-effect waves-light" type="submit">Change</button>
                            </div>
                        </div>
                    </form>
                  </div>
              </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
      </div>
  </body>
  <?php $this->load->view('unani/includes/scripts.php'); ?>
  <?php $this->load->view('unani/includes/table-script.php'); ?>
  <script type="text/javascript">
    $(document).ready(function(){
      var dataTable = $('#user_data').DataTable({
        "processing":true,
        "serverSide":true,
        "order":[],
        "ajax":{
          url:"<?=site_url('unani/directories/get')?>",
          type:"POST"
        },
        "columnDefs":[
          {
            "target":[0,3,4],
            "orderable":true
          }
        ],
        dom: 'lBfrtip',
        buttons: [
             'csv', 'excelHtml5', 'pdf'
        ],
        lengthMenu: [[25, 100, -1], [25, 100, "All"]],
        pageLength: 25,

      });

    });
  </script>
  <script>
    function change_password(key)
    {
      $('#user_id').val(key);
      $('#change-pass').modal('show');
    }
    function check()
    {
      var pass1 = $('#pass1').val();
      var pass2 = $('#pass2').val();
      if (pass1 == pass2) {
        return true;
      }
      else {
        $('#message').text('Password mismatch');
        return false;
      }
    }
    function showImage(param)
      {
        var modalImg = document.getElementById("modal-image");
        modalImg.src = param.src;
        $('#imagemodal').modal('show');
      }
  </script>
</html>
