  <?php $user = $this->session->userdata['admin']; ?>
  <div class="topbar">
      <!-- LOGO -->
      <div class="topbar-left">
          <a href="<?=site_url('admin/dashboard')?>" class="logo">
            <span>

               <img src="<?=base_url()?>assets/images/farm.jpg" alt="" height="50">
            </span>
            <i>
              <img src="<?=base_url()?>assets/images/logo_sm.png" alt="" height="30">
            </i>
          </a>
      </div>

      <nav class="navbar-custom">

          <ul class="list-unstyled topbar-right-menu float-right mb-0">

              <li class="dropdown notification-list">
                  <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                     aria-haspopup="false" aria-expanded="false">
                       <span class="ml-1"><?=$user['name']?><i class="mdi mdi-chevron-down"></i> </span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <!-- <a href="<?=site_url('admin/settings')?>" class="dropdown-item notify-item">
                        <i class="fi-power"></i> <span>Settings</span>
                    </a> -->
                    <a href="<?=site_url('app/logout')?>" class="dropdown-item notify-item">
                        <i class="fi-power"></i> <span>Log Out</span>
                    </a>
                  </div>
              </li>
          </ul>

          <ul class="list-inline menu-left mb-0 float-left">
              <li class="float-left">
                  <button class="button-menu-mobile open-left waves-light waves-effect">
                      <i class="dripicons-menu"></i>
                  </button>
              </li>
          </ul>
 <!-- <h2 class="page_hd">Vendor</h2> -->
      </nav>

  </div>
  <!-- Top Bar End -->

  <!-- ========== Left Sidebar Start ========== -->
  <div class="left side-menu">
      <div class="slimscroll-menu" id="remove-scroll">

          <!--- Sidemenu -->
          <div id="sidebar-menu">
              <!-- Left Menu Start -->
              <ul class="metismenu" id="side-menu">
                  <li class="menu-title">Navigation</li>
                  <li>
                      <a href="<?=site_url('admin/dashboard')?>">
                          <i class="fa fa-home"></i><span> Dashboard </span>
                      </a>
                  </li>
                  <li>
                      <a href="#"><i class="fa fa-users"></i> <span> Users </span> <span class="menu-arrow"></span></a>
                      <ul class="nav-second-level" aria-expanded="false">
                          <li><a href="<?=site_url('admin/users/add')?>">Create User</a></li>
                          <li><a href="<?=site_url('admin/users')?>">Manage Users</a></li>
                      </ul>
                  </li>
                  <li>
                      <a href="<?=site_url('admin/tele_orders/add')?>"><i class="fa fa-money"></i> <span> Tele Orders </span></a>
                  </li>
                  <li>
                      <a href="#"><i class="fa fa-shopping-bag"></i> <span> Orders </span> <span class="menu-arrow"></span></a>
                      <ul class="nav-second-level" aria-expanded="false">
                          <li><a href="<?=site_url('admin/orders')?>">Live Orders</a></li>
                           <li><a href="<?=site_url('admin/orders/dispatched')?>">Dispatched  Orders</a></li>
                          <li><a href="<?=site_url('admin/orders/delivered')?>">Delivered Orders</a></li>
                          <li><a href="<?=site_url('admin/orders/cancelled')?>">Cancelled Orders</a></li>
                          <li><a href="<?=site_url('admin/orders/returned')?>">Returned  Orders</a></li>
                          <li><a href="<?=site_url('admin/orders/returned_cod')?>">Returned COD  Orders</a></li>
                          <!-- <li><a href="<?=site_url('admin/orders/bulk')?>">Staff Orders</a></li> -->
                          <li><a href="<?=site_url('admin/orders/refunded')?>">Refunded Orders</a></li>
                      </ul>
                  </li>
                  <li>
                      <a href="<?=site_url('admin/stock')?>"><i class="fa fa-cube"></i> <span> Product Stock </span></a>
                  </li>
                  <li>
                      <a href="<?=site_url('admin/task')?>"><i class="fa fa-cube"></i> <span> Tasks </span></a>
                  </li>
                  <li>
                      <a href="<?=site_url('admin/vendor')?>"><i class="fa fa-archive"></i> <span> Purchase Entry </span></a>
                  </li>
                  <li>
                      <a href="#"><i class="fa fa-shopping-bag"></i> <span> Products </span> <span class="menu-arrow"></span></a>
                      <ul class="nav-second-level" aria-expanded="false">
                          <li><a href="<?=site_url('admin/products/add')?>">Add Products</a></li>
                          <li><a href="<?=site_url('admin/products')?>">Manage Products</a></li>
                      </ul>
                   </li>
                   <li>
                      <a href="#"><i class="fa fa-ticket"></i> <span> Category </span> <span class="menu-arrow"></span></a>
                      <ul class="nav-second-level" aria-expanded="false">
                          <li><a href="<?=site_url('admin/category/add')?>">Add Category</a></li>
                          <li><a href="<?=site_url('admin/category')?>">Manage Category</a></li>
                      </ul>
                  </li>
                  <li>
                      <a href="#"><i class="fa fa-ticket"></i> <span> Sub Category </span> <span class="menu-arrow"></span></a>
                      <ul class="nav-second-level" aria-expanded="false">
                          <li><a href="<?=site_url('admin/subcategory/add')?>">Add SubCategory</a></li>
                          <li><a href="<?=site_url('admin/subcategory')?>">Manage SubCategory</a></li>
                      </ul>
                  </li>
                  <li>
                      <a href="#"><i class="fa fa-ticket"></i> <span> Brands </span> <span class="menu-arrow"></span></a>
                      <ul class="nav-second-level" aria-expanded="false">
                          <li><a href="<?=site_url('admin/brands/add')?>">Add Brand</a></li>
                          <li><a href="<?=site_url('admin/brands')?>">Manage Brand</a></li>
                      </ul>
                  </li>
                  <li>
                      <a href="#"><i class="fa fa-users"></i> <span> Vendors </span> <span class="menu-arrow"></span></a>
                      <ul class="nav-second-level" aria-expanded="false">
                          <li><a href="<?=site_url('admin/vendor/add')?>">Add Vendor</a></li>
                          <li><a href="<?=site_url('admin/vendor')?>">Manage Vendor</a></li>
                      </ul>
                  </li>
                  <li>
                      <a href="#"><i class="fa fa-user"></i> <span> Customers </span> <span class="menu-arrow"></span></a>
                      <ul class="nav-second-level" aria-expanded="false">
                          <li><a href="<?=site_url('admin/customer/add')?>">Add Customer</a></li>
                          <li><a href="<?=site_url('admin/customer')?>">Manage Customer</a></li>
                      </ul>
                  </li>
                  <li>
                      <a href="#"><i class="fa fa-clock-o"></i> <span> Delivery Date </span> <span class="menu-arrow"></span></a>
                      <ul class="nav-second-level" aria-expanded="false">
                          <li><a href="<?=site_url('admin/delivery_date/add')?>">Add Delivery date</a></li>
                          <li><a href="<?=site_url('admin/delivery_date')?>">Manage Delivery date</a></li>
                      </ul>
                  </li>
                  <li>
                      <a href="#"><i class="fa fa-file-excel-o"></i> <span> Delivery Slot </span> <span class="menu-arrow"></span></a>
                      <ul class="nav-second-level" aria-expanded="false">
                          <li><a href="<?=site_url('admin/delivery_slot/add')?>">Add Delivery slot</a></li>
                          <li><a href="<?=site_url('admin/delivery_slot')?>">Manage Delivery slot</a></li>
                      </ul>
                  </li>
                  <li>
                      <a href="#"><i class="fa fa-book"></i> <span> Expense </span> <span class="menu-arrow"></span></a>
                      <ul class="nav-second-level" aria-expanded="false">
                          <li><a href="<?=site_url('admin/expense/category')?>">Expense Category</a></li>
                          <li><a href="<?=site_url('admin/expense/add')?>">Add Expense</a></li>
                          <li><a href="<?=site_url('admin/expense')?>">Manage Expense</a></li>
                      </ul>
                  </li>
                  <li>
                      <a href="#"><i class="fa fa-pie-chart"></i> <span> Reports </span> <span class="menu-arrow"></span></a>
                      <ul class="nav-second-level" aria-expanded="false">
                          <li><a href="<?=site_url('admin/stock')?>">Sales Reports</a></li>
                          <li><a href="<?=site_url('admin/stock/history')?>">Purchase Reports</a></li>
                      </ul>
                  </li>
                  <li>
                      <a href="#"><i class="fa fa-image"></i> <span> Banner Images </span> <span class="menu-arrow"></span></a>
                      <ul class="nav-second-level" aria-expanded="false">
                          <li><a href="<?=site_url('admin/banner/add')?>">Create Banner Images</a></li>
                          <li><a href="<?=site_url('admin/banner')?>">Manage Banner Images</a></li>
                      </ul>
                  </li>
                  <li>
                      <a href="#"><i class="fa fa-quote-left"></i> <span> Testimonial </span> <span class="menu-arrow"></span></a>
                      <ul class="nav-second-level" aria-expanded="false">
                          <li><a href="<?=site_url('admin/testimonial/add')?>">Create Testimonial</a></li>
                          <li><a href="<?=site_url('admin/testimonial')?>">Manage Testimonial</a></li>
                      </ul>
                  </li>
                  <li>
                      <a href="#"><i class="fa fa-quote-left"></i> <span> Delivery Locations </span> <span class="menu-arrow"></span></a>
                      <ul class="nav-second-level" aria-expanded="false">
                          <li><a href="<?=site_url('admin/delivery_location/add')?>">Create Delivery location</a></li>
                          <li><a href="<?=site_url('admin/delivery_location')?>">Manage Delivery location</a></li>
                      </ul>
                  </li>
                  <li>
                    <a><i class="fa fa-gift"></i><span>Offers</span><span class="menu-arrow"></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                      <li>
                        <a href="#"><span> Other Offers </span> <span class="menu-arrow"></span></a>
                        <ul class="nav-third-level" aria-expanded="false">
                            <li><a href="<?=site_url('admin/testimonial/add')?>">Create Offer</a></li>
                            <li><a href="<?=site_url('admin/testimonial')?>">Manage Offer location</a></li>
                        </ul>
                      </li>
                      <li>
                        <a href="#"><span> Todays Deal </span> <span class="menu-arrow"></span></a>
                        <ul class="nav-third-level" aria-expanded="false">
                            <li><a href="<?=site_url('admin/testimonial/add')?>">Create Deal</a></li>
                            <li><a href="<?=site_url('admin/testimonial')?>">Manage Deal</a></li>
                        </ul>
                      </li>                    
                    </ul>                    
                  </li>
                  <li>
                      <a href="#"><i class="fa fa-bell"></i> <span> Payments </span> <span class="menu-arrow"></span></a>
                      <ul class="nav-second-level" aria-expanded="false">
                          <li><a href="<?=site_url('admin/wholesaler/request')?>"> Add Payment</a></li>
                          <li><a href="<?=site_url('admin/wholesaler')?>">Manage Payment</a></li>
                          <li><a href="<?=site_url('admin/wholesaler')?>">App Order Payments</a></li>
                          <li><a href="<?=site_url('admin/wholesaler')?>">Tele Order Payments</a></li>
                          <li><a href="<?=site_url('admin/wholesaler')?>">Payments Balanace</a></li>
                      </ul>
                  </li>
                  <li>
                      <a href="#"><i class="fa fa-bell"></i> <span> Notifications </span> <span class="menu-arrow"></span></a>
                      <ul class="nav-second-level" aria-expanded="false">
                          <li><a href="<?=site_url('admin/wholesaler/request')?>"> Send Notifications</a></li>
                          <li><a href="<?=site_url('admin/wholesaler')?>">Notification Images</a></li>
                      </ul>
                  </li>
                  <li>
                      <a href="<?=site_url('admin/voucher')?>"><i class="fa fa-gift"></i> <span> Voucher </span></a>
                  </li>
                  <li>
                      <a href="#"><i class="fa fa-bell"></i> <span> Blog </span> <span class="menu-arrow"></span></a>
                      <ul class="nav-second-level" aria-expanded="false">
                          <li><a href="<?=site_url('admin/blog/add')?>"> Write Blog</a></li>
                          <li><a href="<?=site_url('admin/blog')?>">Manage Blog</a></li>
                          <li><a href="<?=site_url('admin/blog/category')?>">Manage Blog Category</a></li>
                      </ul>
                  </li>
                   <li>
                      <a href="#"><i class="fa fa-bell"></i> <span> Refund </span> <span class="menu-arrow"></span></a>
                      <ul class="nav-second-level" aria-expanded="false">
                          <li><a href="<?=site_url('admin/wholesaler/request')?>"> Pickup Time</a></li>
                      </ul>
                  </li>
              </ul>

          </div>
          <!-- Sidebar -->
          <div class="clearfix"></div>

      </div>
      <!-- Sidebar -left -->

  </div>
  <!-- Left Sidebar End -->

  <style>
    .page_hd {    width: 100%;
    text-align: center;
    color: #FFF;
    font-size: 22px;
    text-transform: uppercase;
    line-height: 70px;}

  </style>
