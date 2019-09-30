<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="<?=base_url()?>assets/images/favicon.ico">
    <title>HERMAS | Profile</title>
    <link href="<?=base_url()?>site/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>site/css/style.default.css" rel="stylesheet">
    <link href="<?=base_url()?>site/css/style.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!--  <link href="carousel.css" rel="stylesheet"> -->
  </head>
<style type="text/css">
    .imedit{top: 0 !important; position: absolute !important;}
</style>

   <?php if(!empty($this->session->flashdata('message')))  {?>
        <div class="alert alert-success" id="warn">
          <strong>Success!
          </strong>&nbsp;&nbsp;&nbsp;
          <?php echo $this->session->flashdata('message'); ?>.
        </div>
      <?php } ?>

<body>
 <?php $this->load->view('site/includes/header.php');?>

    <div id="all" class="basket">

        <div id="content">
            <div class="container">
                <div class="col-md-12" id="checkout">
                    <div class="box">
                      <div class="row">
                    <div class="col-md-3">
        <img src="<?=base_url().$details->image?>" alt="" class="img-rounded img-responsive" />
        <button class="btn btn-primary  imedit" data-toggle="modal" data-target="#dpedit"><i class="far fa-images"></i></button>

            <div class="modal fade" id="dpedit">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="form" action="<?=site_url('profile/update_picture')?>" enctype="multipart/form-data" role="form" method="POST">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title">Upload Photo</h4>
                            </div>
                            <div class="modal-body">
                                <div id="messages"></div>
                                <input type="file" name="image" id="file">
                                <input type="hidden" name="user_id" value="<?php echo $details->user_id;?>">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="save">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
                    </div>
                        <div class="col-md-7">
                            <h4><?php echo @$details->name; ?></h4>
                            <p><?php echo @$details->email; ?><br>
                            <?php echo @$details->phone; ?><p>
                        </div>
                        <div class="col-md-2">
                        <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#profileedit"><i class="fas fa-edit"></i></button><br><br>
                        <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#passwordedit"><i class="fa fa-lock" aria-hidden="true"></i></button>

            <div class="modal fade" id="profileedit">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="form" action="<?=site_url('profile/update')?>" enctype="multipart/form-data" role="form" method="POST">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title">Edit Profile</h4>
                            </div>
                            <div class="modal-body">
                                    <input type="hidden" name="user_id" value="<?php echo $details->user_id;?>">
                                    <div class="form-group">
                                    <input type="text" class="form-controler" id="text"  value="<?php echo $details->name; ?>" placeholder="Enter Your Name" name="name" required>
                                    </div>
                                    <div class="form-group">
                                    <input type="email" class="form-controler" id="email" value="<?php echo $details->email; ?>" placeholder="Enter Your email" name="email" required>
                                    </div>
                                    <div class="form-group">
                                    <input type="number" class="form-controler" id="mn" value="<?php echo $details->phone; ?>" placeholder="Enter Your number" name="phone" required>
                                    </div>
                             
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                <button type="submit" name="update" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="passwordedit">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="form" action="<?=site_url('profile/change_password')?>" enctype="multipart/form-data" role="form" method="POST">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title">Change Password</h4>
                            </div>
                            <div class="modal-body">
                                    <input type="hidden" name="user_id" value="<?php echo $details->user_id;?>">
                                    <div class="form-group">
                                    <input type="password" class="form-controler" id="password" name="old_password" placeholder="Old Password" required>
                                    </div>

                                     <div class="form-group">
                                    <input type="password" class="form-controler" name="password" id="password" placeholder="Password" required>
                                    </div>

                                   <!--  <div class="form-group">
                                    <input type="password" class="form-controler" name="confirm_password" id="conformpassword" placeholder="Confirm Password" required>
                                    </div>    -->                            
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="change">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
                    <!-- /.box -->
               
                <!-- /.col-md-9 -->
                <h3 class="text-center">Addresses</h3>
                <?php if($address_check->num_rows()>0) {?>
                <div class="col-md-4">
                    <div class="box">

                        <h4><?php echo @$address->house; ?></h4>
                        <p><?php echo @$address->address_1; ?> </br>
                        <?php echo @$address->address_2; ?></br>
                        <?php echo @$address->city; ?></br>
                        <?php echo @$address->landmark; ?></br>
                        <?php echo @$address->pincode; ?></br>
                        <?php echo @$address->state; ?></br>
                        </p> 
                        <div class="clearfix">
                        <div class="pull-right"><a href="<?=site_url('profile/delete_address/'.@$address->address_id)?>" onclick="return confirm('Are you sure?')" class="btn btn-primary">Delete</a></div>
                        </div>
                    </div>
                </div>
               <?php } else {?>
                 
               <?php };?>         
            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->
 </div>
 <?php $this->load->view('site/includes/footer.php');?>
   
   <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
    
     <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="<?=base_url()?>site/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../../assets/js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
    <script type="">
      $("#warn").show();
      setTimeout(function() 
      {
         $("#warn").hide();
      }, 3000);
    </script>
  </body>

</html>