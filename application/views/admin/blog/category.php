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
                  <h4 class="page-title float-left">Blog Category</h4>
                  <ol class="breadcrumb float-right">
                    <button type="button" class="btn btn-gradient btn-rounded waves-light waves-effect w-md" data-toggle="modal" data-target="#add-category">Add Category</button>
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
                        <th width="50%">Category name</th>
                        <th width="20%">Status</th>
                        <th width="10%">Edit</th>
                        <th width="20%">Block/Enable</th>
                      </tr>
                    </thead>
                  </table>
                </div>
            </div>
          </div>
        </div>
      </div>
      <?php $this->load->view('admin/includes/footer.php'); ?>

      <div id="add-category" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog">
              <div class="modal-content">

                  <div class="modal-body">
                      <h2 class="text-uppercase text-center m-b-30">
                          <span><h4>Add Blog Category</h4></span>
                      </h2>
                      <form class="form-horizontal" action="<?=site_url('admin/blog/addCategory')?>" method="post">
                          <div class="form-group m-b-25">
                              <div class="col-12">
                                  <label for="select">Category Name</label>
                                  <input type="text" name="category_name" id="category_name" class="form-control" placeholder="Blog Category" required>
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


     <div id="edit-category" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog">
              <div class="modal-content">

                  <div class="modal-body">
                      <h2 class="text-uppercase text-center m-b-30">
                          <span><h4>Edit Category</h4></span>
                      </h2>
                      <form class="form-horizontal" action="<?=site_url('admin/blog/category_update')?>" method="post">
                           <input type="hidden" name="category_id" id="category_id" class="form-control">
                          <div class="form-group m-b-25">
                              <div class="col-12">
                                  <label for="select">Category Name</label>
                                  <input type="text" name="category" id="category" class="form-control" required>
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
          url:"<?=site_url('admin/blog/get_category')?>",
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
      $('#category_id').val(id);
      // alert(id);
      $.ajax({
          method: "POST",
          url: "<?php echo site_url('admin/blog/getCategoryById');?>",
          dataType : "json",
          data : { id : id },
          success : function( data ){
            $('#category').val(data.cat_name);
            $('#edit-category').modal('show');
            // alert(data);
          }
        });
    }

  </script>
</html>
