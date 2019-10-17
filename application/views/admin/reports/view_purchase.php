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
                  <h4 class="page-title float-left">Purchased Itmes</h4>
                  
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                  <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                          <th>Product Name</th>
                          <th>Unit Price</th>
                          <th>Quantity</th>
                          <th>Total</th>                                         
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($items as $item) {?>
                        <tr>
                          <td><?php echo $item->ProductName;?></td>
                          <td><?php echo $item->ProductPrice;?></td>
                          <td><?php echo $item->Quantity?></td>
                          <td><?php echo $item->Total;?></td>
                        </tr>
                      <?php };?>
                    </tbody>
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
        $(document).ready(function() {
            $('#datatable').DataTable();

            //Buttons examples
            var table = $('#datatable-buttons').DataTable({
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf']
            });

            table.buttons().container()
                    .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
        } );

    </script>
     <script>
         $('#datatable').DataTable({
            "order": [[ 0, "desc" ]], //or asc 
            "columnDefs" : [{"targets":3, "type":"date-eu"}],
        });
    </script>
  
</html>
