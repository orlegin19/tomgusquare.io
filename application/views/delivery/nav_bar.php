<?php
$home = strtolower($page_title) == 'delivery' ? 'active' : '' ;
$order = strtolower($page_title) == 'my order' ? 'active' : '' ;
$info = '';
function isMobileDevice() {
  return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
$page = strtolower($page_title) == 'home' ? 'Tomgu' : $page_title ;

?>

<!-- Navbar -->
<?php if(!isMobileDevice()){ ?>
<nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar" id="main_nav">
  
    <div class="container">
    
      <!-- Brand -->
      <a class="navbar-brand waves-effect" href="<?php echo base_url() ?>" target="_blank">
      <img src="<?php echo base_url('uploads/rios_logo.ico') ?>" width="35px" height="35px" alt="">
        <strong class="blue-text">Tomgu Square</strong>
      </a>

     

      <!-- Links -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <!-- Left -->
        <!-- <ul class="navbar-nav mr-auto">
          <li class="nav-item <?php echo $home ?> ">
            <a class="nav-link waves-effect" href="<?php echo base_url('order') ?>">Home
            </a>
          </li>
          <li class="nav-item <?php echo $order ?> ">
            <a class="nav-link waves-effect" href="<?php echo base_url('order/my_order') ?>">My Orders
            </a>
          </li>
        </ul> -->
        </div>

        <!-- Right -->
        <ul class="navbar-nav nav-flex-icons pull-right">
          <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="user_dd">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo 'Welcome '. ucwords(strtolower($_SESSION['firstname'].' '.$_SESSION['lastname'])) ?></span>
                <span class="padge badge-pill"><i class="fa fa-user"></i></span>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fa fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Personal Info
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fa fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Account Settings
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo base_url('login/logout') ?>" >
                  <i class="fa fa-power-off fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          <li class="nav-item">
          <!-- Collapse -->
     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
          </li>
        </ul>
     

    </div>
  </nav>
  <!-- Navbar -->

<?php }else{ ?>
<nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar" id="main_nav">

  <div>
  <span class="side-toggler pull-left">
      <button id="toggle-side" type="button"><i class="fa fa-bars"></i></button>
    </span>
  <span class='icon-nav'><img src="<?php echo base_url('uploads/rios_logo.ico') ?>" width="35px" height="35px" alt=""></span>
  <span class="company-name"><h4><?php echo ucwords($page) ?></h4></span>
  </div>
</nav>
  <div class="sidebar-wrapper">
    <div class="sidebar-back"></div>
    <div class="sidebar-field">
      <div class="toggle-hideside"><a href="javascript:void(0)" id='hide-sidebar'><i class="fa fa-arrow-left"></i></a></div>
      <div class="div badge btn btn-primary" style="width:100%;margin:0">
        <span class="btn-circle btn-sm badge-pill"><i class="fa fa-user fa-fw"></i></span>
        <span>Welcome <?php echo ucwords($_SESSION['firstname']) ?></span>
      </div>

      <ul class="list-group sidebar-list">
        <a href="<?php echo base_url('delivery') ?>" class='list-link'><li class="list-group-item list-group-item-action <?php echo $home ?>">
        <i class="fa fa-home sidebar-list-icon"></i> Home
        </li></a>
        <a href="#" class='list-link'><li class="list-group-item list-group-item-action <?php echo $info ?>">
        <i class="fa fa-gear sidebar-list-icon"></i> Account Settings
        </li></a>
        <a href="<?php echo base_url('login/logout') ?>" class='list-link'><li class="list-group-item list-group-item-action">
        <i class="fa fa-power-off sidebar-list-icon"></i> Logout
        </li></a>
        
      </ul>
    </div>
  </div>
<?php } ?>
  <script>
  $(document).ready(function(){
    var nav_height =  $('#main_nav').height() + 35;
    // console.log(nav_height)
    $('main').css('margin-top',nav_height+'px')
    


    $('#toggle-side').click(function(){
      $('.sidebar-wrapper').addClass('active');
      $('.sidebar-field').css('margin-left',0)
      $('body').css({'overflow':'hidden'})
    })
    $('#hide-sidebar, .sidebar-back').click(function(){
      $('.sidebar-field').css('margin-left','-250px')
      setTimeout(()=>{
        $('.sidebar-wrapper').removeClass('active');
      },250)
      $('body').removeAttr('style')

    })
  })
  </script>