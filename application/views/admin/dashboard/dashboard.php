<!DOCTYPE html>
<html>
    <head>
      <?php $this->load->view('admin/includes/includes'); ?>
      <style media="screen">
        .button {
          color: black;
          padding: 20px;
          text-align: center;
          text-decoration: none;
          display: inline-block;
          font-size: 16px;
          margin: 4px 2px;
          border-radius: 50%;
        }
        .button-pitch{
          color: black;
          padding: 20px;
          text-align: center;
          text-decoration: none;
          display: inline-block;
          font-size: 16px;
          margin: 4px 2px;
        }
        .button-slot {
          color: black;
          text-align: center;
          text-decoration: none;
          display: inline-block;
          font-size: 16px;
          padding-top:25px;
          padding-bottom:25px;
          border-radius: 100%;
        }
        .class-ul li{
          list-style: none;
          display: inline;
        }
        
      </style>
    </head>
    <body>
        <div id="wrapper">
            <?php $this->load->view('admin/includes/sidebar'); ?>

            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title float-left">Dashboard</h4>
                                    <ol class="breadcrumb float-right">
                                        <li class="breadcrumb-item"><a href="#">Farmroot</a></li>
                                        <li class="breadcrumb-item active">Dashboard</li>
                                    </ol>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                                <a style="text-decoration:none;color:#797979;" href="<?=site_url('admin/bookings/upcoming')?>"><div class="card-box tilebox-one">
                                    <i class="fi-box float-right"></i>
                                    <h6 class="text-muted text-uppercase mb-3">Pending Orders</h6>
                                    <!-- <h4 class="mb-3" data-plugin="counterup"><?=$pending?></h4> -->
                                    <!-- <span class="badge badge-primary"> +11% </span> <span class="text-muted ml-2 vertical-middle">From previous period</span> -->
                                </div></a>
                            </div>

                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                                <a style="text-decoration:none;color:#797979;" href="<?=site_url('admin/bookings/upcoming')?>"><div class="card-box tilebox-one">
                                    <i class="fi-layers float-right"></i>
                                    <h6 class="text-muted text-uppercase mb-3">Cancelled </h6>
                                   <!-- <h4 class="mb-3" data-plugin="counterup"><?=$cancelled?></h4> -->
                                    <!-- <span class="badge badge-primary"> -29% </span> <span class="text-muted ml-2 vertical-middle">From previous period</span> -->
                                </div></a>
                            </div>

                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                                <a style="text-decoration:none;color:#797979;" href="<?=site_url('admin/turfs')?>"><div class="card-box tilebox-one">
                                    <i class="fi-tag float-right"></i>
                                    <h6 class="text-muted text-uppercase mb-3">Delivered Orders</h6>
                                    <!-- <h4 class="mb-3" data-plugin="counterup"><?=$delivered?></h4> -->
                                    <!-- <span class="badge badge-primary"> 0% </span> <span class="text-muted ml-2 vertical-middle">From previous period</span> -->
                                </div></a>
                            </div>

                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                                <a style="text-decoration:none;color:#797979;" href="<?=site_url('admin/customers')?>"><div class="card-box tilebox-one">
                                    <i class="fi-briefcase float-right"></i>
                                    <h6 class="text-muted text-uppercase mb-3">Total Orders</h6>
                                    <!-- <h4 class="mb-3" data-plugin="counterup"><?=$total?></h4> -->
                                    <!-- <span class="badge badge-primary"> +89% </span> <span class="text-muted ml-2 vertical-middle">Last year</span> -->
                                </div></a>
                            </div>

                        </div>
                        
                    </div> <!-- container -->

                </div> <!-- content -->

                <?php $this->load->view('admin/includes/footer') ?>

            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


        </div>
        <?php $this->load->view('admin/includes/scripts') ?>
       
    </body>
</html>
