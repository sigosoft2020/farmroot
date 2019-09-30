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
                  <h4 class="page-title float-left">Ask Doctor</h4>
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
                         <th width="20%">Name</th>
                         <th width="15%">Category</th>
                         <th width="50%">Question</th>
                         <th width="10%">Status</th>
                         <th width="5%">Answer</th>
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

     <div id="add-answer" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
              <div class="modal-dialog">
                  <div class="modal-content">

                      <div class="modal-body">
                          <h2 class="text-uppercase text-center m-b-30">
                              <span><h4>Add answer</h4></span>
                          </h2>
                          <form class="form-horizontal" action="<?=site_url('unani/ask_doctor/add_answer')?>" method="post">

                              <div class="form-group m-b-25">
                                  <div class="col-12">
                                      <label for="select">Question</label>
                                      <input type="text" name="question" id="qstn" class="form-control" readonly>
                                      <input type="hidden" name="ask_id" id="ask_id" class="form-control" required>
                                  </div>
                              </div>
                              <div class="form-group m-b-25">
                                  <div class="col-12">
                                      <label for="select">Answer</label>
                                      <textarea type="text" name="answer" class="form-control" required></textarea>
                                  </div>
                              </div>
                              
                              <div class="form-group account-btn text-center m-t-10">
                                  <div class="col-12">
                                      <button type="reset" class="btn w-lg btn-rounded btn-light waves-effect m-l-5" data-dismiss="modal">Back</button>
                                      <button class="btn w-lg btn-rounded btn-success waves-effect waves-light" type="submit">Add</button>
                                  </div>
                             </div>
                          </form>
                      </div>
                  </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
       </div>

      <div id="edit-answer" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
              <div class="modal-dialog">
                  <div class="modal-content">

                      <div class="modal-body">
                          <h2 class="text-uppercase text-center m-b-30">
                              <span><h4>Edit answer</h4></span>
                          </h2>
                          <form class="form-horizontal" action="<?=site_url('unani/ask_doctor/edit_answer')?>" method="post">

                              <div class="form-group m-b-25">
                                  <div class="col-12">
                                      <label for="select">Question</label>
                                      <input type="text" name="question" id="qustn" class="form-control" readonly>
                                      <input type="hidden" name="qst_id" id="qst_id" class="form-control" required>
                                  </div>
                              </div>
                              <div class="form-group m-b-25">
                                  <div class="col-12">
                                      <label for="select">Answer</label>
                                      <textarea type="text" name="answer" id="answer" class="form-control" required></textarea>
                                  </div>
                              </div>
                              
                              <div class="form-group account-btn text-center m-t-10">
                                  <div class="col-12">
                                      <button type="reset" class="btn w-lg btn-rounded btn-light waves-effect m-l-5" data-dismiss="modal">Back</button>
                                      <button class="btn w-lg btn-rounded btn-success waves-effect waves-light" type="submit">Update</button>
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
          url:"<?=site_url('unani/ask_doctor/get')?>",
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
  <script type="">
     function add(id,question)
      {
        // alert(id);
       $('#ask_id').val(id);
       $('#qstn').val(question);
       $('#add-answer').modal('show');
      }

      function edit(id,answer,qstn)
      {
        // alert(res);
       $('#qst_id').val(id);
       $('#qustn').val(qstn);
       $('#answer').val(answer);
       $('#edit-answer').modal('show');
      }
     </script> 
</html>
