<!DOCTYPE html>
<html>
  <head>
    <?php $this->load->view('admin/includes/includes.php'); ?>
    <?php $this->load->view('admin/includes/table-css.php'); ?>
    <link rel="stylesheet" href="<?=base_url()?>plugins/image-crop/croppie.css">
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
                  <h4 class="page-title float-left">Add Expense</h4>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card-box">
                <form action="<?=site_url('admin/expense/addExpense')?>" method="post" id="add-form">

                   <div class="row">
                      <div class="col-md-6">
                          <div class="">
                             <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Expense Category</p>
                                  <select name="category" class="form-control" required>
                                    <option value="">---Select Category---</option>
                                    <?php foreach($category as $cat) {?>
                                    <option value="<?php echo $cat->exp_id;?>"><?php echo $cat->category_name;?></option>
                                    <?php };?>
                                  </select>
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Expense Name</p>
                                  <input type="text" maxlength="25" name="name" class="form-control" placeholder="Expense Name" required>
                              </div>
                              
                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Description</p>
                                  <textarea type="text" rows="4" name="description" class="form-control" placeholder="Description" required></textarea>
                              </div>

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Amount</p>
                                  <input type="number" min="0" name="amount" class="form-control" placeholder="Amount" required>
                              </div>  

                              <div>
                                  <p class="mb-1 mt-4 font-weight-bold">Date</p>
                                  <input type="date" name="exp_date" class="form-control" placeholder="Date" required>
                              </div>  
                              
                              <br><br>
                          </div>
                      </div>

                      <div class="col-md-12 mt-4">
                        <button type="submit" class="btn btn-success btn-rounded waves-light waves-effect w-md pull-left" id="submit-button">Add</button>
                      </div>
                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php $this->load->view('admin/includes/footer.php'); ?>
    </div>
  </body>
  <?php $this->load->view('admin/includes/scripts.php'); ?>
  <script src="<?=base_url()?>plugins/image-crop/croppie.js"></script>

</html>
