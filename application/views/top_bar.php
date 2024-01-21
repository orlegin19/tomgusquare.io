<?php 
  $dash = isset($page_title) && strtolower($page_title) == 'dashboard' ?  'active' : '';
  if(isset($page_title) && (strtolower($page_title) == 'product list' || strtolower($page_title) == 'product group')){
    $product = 'active';
  }else{
    $product = '';
  }
  $sales = '';
  if(isset($page_title) && (strtolower($page_title) == 'pos'))
  $sales = 'active';
  $product_list = isset($page_title) && strtolower($page_title) == 'product list' ?  'active' : '';
  $users = isset($page_title) && strtolower($page_title) == 'users' ?  'active' : '';
  $report = isset($page_title) && strtolower($page_title) == 'sales report' ?  'active' : '';
  $delivery = isset($page_title) && strtolower($page_title) == 'orders to deliver' ?  'active' : '';
?>
<style>
.pic {
    border-radius: 50%;
}
</style>


<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url() ?>">
        <div class="sidebar-brand-icon rotate-n-1">
            <!-- <i class="fas fa-laugh-wink"></i> -->
            <img class="pic" src="<?php echo base_url().$_SESSION['system']['logo'] ?>" width="80" alt="">
        </div>
        &nbsp;
        <div>Tomgu Square</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0 admin_only">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php echo $dash ?> admin_only">
        <a class="nav-link anc" href="<?php echo base_url() ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider admin_only">

    <!-- Heading -->
    <!-- <div class="sidebar-heading">
  Maintenance
</div> -->

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?php echo $product ?>  admin_only">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#products_collapse"
            aria-expanded="true" aria-controls="products_collapse">
            <i class="fa fa-list"></i>
            <span>Menu</span>
        </a>
        <div id="products_collapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item anc" href="<?php echo base_url().'products/product_list' ?>">Menu List</a>
                <a class="collapse-item anc" href="<?php echo base_url().'products/product_type' ?>">Menu Category</a>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <li class="nav-item <?php echo $sales ?> ">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#sales_collapse" aria-expanded="true"
            aria-controls="sales_collapse">
            <i class="fa fa-money"></i>
            <span>Sales</span>
        </a>
        <div id="sales_collapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item anc" href="<?php echo base_url().'sales/pos1' ?>">POS</a>
                <?php if($_SESSION['type'] != 6) : ?>
                <a class="collapse-item anc" href="<?php echo base_url().'sales/order_list' ?>">Order List</a>
                <!-- <a class="collapse-item anc"  href="<?php echo base_url().'products/product_type' ?>"></a> -->
                <?php endif; ?>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider admin_only">
    <li class="nav-item <?php echo $report ?> admin_only">
        <a class="nav-link anc" href="<?php echo base_url('admin/sales_report') ?>">
            <i class="fa fa-file-alt"></i>
            <span>Sales Report</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider admin_only">
    <li class="nav-item <?php echo $users ?> admin_only">
        <a class="nav-link anc" href="<?php echo base_url('admin/users') ?>">
            <i class="fa fa-fw fa-users"></i>
            <span>Users</span></a>
    </li>
    <!-- <hr class="sidebar-divider admin_only">
<li class="nav-item <?php echo $delivery ?> admin_only">
  <a class="nav-link anc"  href="<?php echo base_url('admin/delivery_list') ?>">
    <i class="fa fa-fw fa-send"></i>
    <span>Delivery List</span></a>
</li> -->

    <!--<hr class="sidebar-divider admin_only">
<li class="nav-item  admin_only">
  <a class="nav-link anc"  href="<?php echo base_url('kitchen') ?>" target="_blank">
     <i class="fa fa-fw fa-users"></i> 
    <span>Kitchen Side</span></a>
</li>-->


    <!-- Divider -->
    <hr class="sidebar-divider">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<script>
$(document).ready(function() {
    $('.anc').each(function() {
        $(this).click(function(e) {
            e.prevenDefault();
            location.replace($(this).attr('href'));
        })
    })


})
</script>