<!DOCTYPE html>
<html>
  <head>
    <?php $this->load->view('owner/includes/includes.php'); ?>
    <?php $this->load->view('owner/includes/table-css.php'); ?>
  </head>
  <body>
    <div id="wrapper">
      <?php $this->load->view('owner/includes/sidebar.php'); ?>
      <div class="content-page">
        <div class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="page-title-box">
                  <h4 class="page-title float-left">BOOKING DETAILS</h4>
                  <!-- <ol class="breadcrumb float-right">
                    <button type="button" class="btn btn-gradient btn-rounded waves-light waves-effect w-md">Add amenity</button>
                  </ol> -->
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="card-box">
                  <h4 class="header-title m-t-0 m-b-30">Booking details</h4>
                  <table class="table table-borderless">
                      <tbody>
                        <tr>
                          <td>Date</td>
                          <td><?=date('d/m/Y',strtotime($book->date));?></td>
                        </tr>
                        <tr>
                          <td>Slot</td>
                          <td><?=$book->slot?></td>
                        </tr>
                        <tr>
                          <td>Pitch</td>
                          <td><?=$book->pitch?></td>
                        </tr>
                        <tr>
                          <td>Fee</td>
                          <td><?=$book->rate?></td>
                        </tr>
                        <tr>
                          <td>Voucher applied</td>
                          <td>
                            <?php
                              if ($book->voucher_status == '1') {
                                echo "Yes";
                              }
                              else {
                                echo "No";
                              }
                            ?>
                          </td>
                        </tr>
                        <tr>
                          <td>Voucher amount</td>
                          <td><?=$book->voucher_amount?></td>
                        </tr>
                        <tr>
                          <td>Subtotal</td>
                          <td><?=$book->subtotal?></td>
                        </tr>
                        <tr>
                          <td>Payment type</td>
                          <td><?php if($book->payment_type == 'cod'){ ?>Cash on delivery<?php }else{ ?> Online transaction <?php } ?></td>
                        </tr>
                        <?php if($book->payment_type == 'online'){ ?>
                            <tr>
                              <td>Cash received via online</td>
                              <td><?=$book->cash_received_online?></td>
                            </tr>
                        <?php } ?>
                        <tr>
                          <td>Total Cash recieved</td>
                          <td><?=$book->cash_recieved?></td>
                        </tr>
                        <tr>
                          <td>Payment ID</td>
                          <td><?=$book->payment_id?></td>
                        </tr>
                        <tr>
                          <td>Booked date</td>
                          <td><?=date('d/m/Y',strtotime($book->booked_date));?></td>
                        </tr>
                        <tr>
                          <td>Booked time</td>
                          <td><?=$book->booked_time?></td>
                        </tr>
                        <tr>
                          <td>Booking status</td>
                          <td><?=$book->booking_status?></td>
                        </tr>
                    </tbody>
                  </table>
              </div>
            </div>
            <div class="col-md-6">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">Turf details</h4>
                    <img src="<?=base_url() . $turf->cover_image?>" width="100px">
                    <table class="table table-borderless">
                        <tbody>
                          <tr>
                            <td>Name</td>
                            <td><?=$turf->turf_name?></td>
                          </tr>
                          <tr>
                            <td>Place</td>
                            <td><?=$turf->place?></td>
                          </tr>

                      </tbody>
                    </table>
                </div>
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">Customer details</h4>

                    <img src="<?=base_url() . $user->image?>" width="100px">
                    <table class="table table-borderless">
                        <tbody>
                          <tr>
                            <td>Name</td>
                            <td><?=$user->username?></td>
                          </tr>
                          <tr>
                            <td>Mobile</td>
                            <td><?=$user->mobile?></td>
                          </tr>
                          <tr>
                            <td>Email</td>
                            <td><?=$user->email?></td>
                          </tr>
                      </tbody>
                    </table>
                </div>
            </div>
          </div>
        </div>
      </div>
      <?php $this->load->view('owner/includes/footer.php'); ?>
    </div>
  </body>
  <?php $this->load->view('owner/includes/scripts.php'); ?>
  <?php $this->load->view('owner/includes/table-script.php'); ?>
</html>
