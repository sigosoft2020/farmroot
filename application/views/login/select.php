<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8" />
        <title>Hermas | Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="#" name="description" />
        <meta content="Hermas unani" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="<?=base_url()?>assets/images/logo_sm.png">

        <!-- App css -->
        <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>assets/css/style.css" rel="stylesheet" type="text/css" />

        <script src="<?=base_url()?>assets/js/modernizr.min.js"></script>

    </head>
    <?php $message = $this->session->flashdata('message'); ?>

    <body class="bg-accpunt-pages">

        <!-- HOME -->
        <section class="dp">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2 col-xs-12">
                    </div>
                    <div class="col-sm-4 col-xs-12">
                        <div class="ss">
						    <img src="<?=base_url()?>assets/images/owner.png" class="img-fluid">
						    <a href="<?=site_url('users/login/admin')?>"><button type="button" class="btn btn-light waves-effect w-md"> Admin Login </button></a>
						</div>
					</div>
					<div class="col-sm-4 col-xs-12">
					    <div class="ss">
						    <img src="<?=base_url()?>assets/images/staff.png" class="img-fluid">
						    <a href="<?=site_url('users/login/unani')?>"><button type="button" class="btn btn-light btn-lg waves-effect w-md"> Unani Login </button></a>
						</div>
					</div>
					<div class="col-sm-2 col-xs-12">
                    </div>
                </div>
            </div>
        </section>
        <!-- END HOME -->
        <style>
            .ss{
                border: 1px solid #fff;
                margin: 30px;
                padding-bottom: 40px;
            }
            .ss .btn-light{
                border-radius: 10em;
                background-color: #fff  !important;
                color: #0ba974;
            }
            @media only screen and (max-width: 767px) {
                .dp {
                margin-top: 0px;
            }
        }
        </style>

        <!-- jQuery  -->
        <script src="<?=base_url()?>assets/js/jquery.min.js"></script>
        <script src="<?=base_url()?>assets/js/popper.min.js"></script>
        <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
        <script src="<?=base_url()?>assets/js/waves.js"></script>
        <script src="<?=base_url()?>assets/js/jquery.slimscroll.js"></script>

        <!-- App js -->
        <script src="<?=base_url()?>assets/js/jquery.core.js"></script>
        <script src="<?=base_url()?>assets/js/jquery.app.js"></script>
    </body>
</html>
