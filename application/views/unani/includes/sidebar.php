  <?php $owner = $this->session->userdata['unani']; ?>
  <div class="topbar">
      <!-- LOGO -->
      <div class="topbar-left">
          <a href="<?=site_url('admin/dashboard')?>" class="logo">
            <span>

               <img src="<?=base_url()?>assets/images/footer-logo.png" alt="" height="50">
            </span>
            <i>
              <img src="<?=base_url()?>assets/images/logo.png" alt="" height="30px">
            </i>
          </a>

      </div>

      <nav class="navbar-custom">

          <ul class="list-unstyled topbar-right-menu float-right mb-0">

              <li class="dropdown notification-list">
                  <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                     aria-haspopup="false" aria-expanded="false">
                       <span class="ml-1"><?=$owner['name']?><i class="mdi mdi-chevron-down"></i> </span>

                  </a>
                  <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                      <a href="<?=site_url('users/logoutUnani')?>" class="dropdown-item notify-item">
                          <i class="fi-power"></i> <span>Logout</span>
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
                      <a href="<?=site_url('unani/dashboard')?>">
                          <i class="fa fa-dashcube"></i><span> Dashboard </span>
                      </a>
                  </li>

                  <li>
                      <a href="#"><i class="fa fa-image"></i> <span> Sliders </span> <span class="menu-arrow"></span></a>
                      <ul class="nav-second-level" aria-expanded="false">
                          <li><a href="<?=site_url('unani/sliders')?>">View sliders</a></li>
                          <li><a href="<?=site_url('unani/sliders/add')?>">Add slider</a></li>
                      </ul>
                  </li>

                  <li>
                      <a href="#"><i class="fa fa-newspaper-o"></i> <span> News </span> <span class="menu-arrow"></span></a>
                      <ul class="nav-second-level" aria-expanded="false">
                          <li><a href="<?=site_url('unani/news')?>">View</a></li>
                          <li><a href="<?=site_url('unani/news/add')?>">Add news</a></li>
                      </ul>
                  </li>

                  <li>
                      <a href="#"><i class="fa fa-image"></i> <span> Gallery </span> <span class="menu-arrow"></span></a>
                      <ul class="nav-second-level" aria-expanded="false">
                          <li><a href="<?=site_url('unani/gallery')?>">View gallery</a></li>
                          <li><a href="<?=site_url('unani/gallery/add')?>">Add gallery</a></li>
                      </ul>
                  </li>

                  <li>
                      <a href="#"><i class="fa fa-user"></i> <span> Directory </span> <span class="menu-arrow"></span></a>
                      <ul class="nav-second-level" aria-expanded="false">
                          <li><a href="<?=site_url('unani/directories')?>">View directory</a></li>
                          <li><a href="<?=site_url('unani/directories/add')?>">Add directory</a></li>
                      </ul>
                  </li>

                  <li>
                      <a href="<?=site_url('unani/events')?>"><i class="fa fa-gift"></i> <span> Events </span><span class="menu-arrow"></span></a>
                      <ul class="nav-second-level" aria-expanded="false">
                          <li><a href="<?=site_url('unani/events')?>">View events</a></li>
                          <li><a href="<?=site_url('unani/events/add')?>">Add events</a></li>
                      </ul>
                  </li>

                  <li>
                      <a href="#"><i class="fa fa-book"></i> <span> Library </span> <span class="menu-arrow"></span></a>
                      <ul class="nav-second-level" aria-expanded="false">
                          <li><a href="<?=site_url('unani/library')?>">View library</a></li>
                          <li><a href="<?=site_url('unani/library/add')?>">Add library</a></li>
                      </ul>
                  </li>
                 
                  <li>
                      <a href="#"><i class="fa fa-gift"></i> <span> Library Slider </span> <span class="menu-arrow"></span></a>
                      <ul class="nav-second-level" aria-expanded="false">
                          <li><a href="<?=site_url('unani/library_slider')?>">View slider</a></li>
                          <li><a href="<?=site_url('unani/library_slider/add')?>">Add slider</a></li>
                      </ul>
                  </li>
                 
                  <li>
                      <a href="<?=site_url('unani/ask_doctor')?>"><i class="fa fa-user-md"></i> <span> Ask Doctor </span></a>
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
