  <style>
    #main_nav{
      height: 50px;
      /*
      background-color: gray;
      */
    }
  </style>
  <!-- Topbar -->
  <nav class="navbar navbar-expand navbar-light bg-black topbar mb-4 static-top shadow" id="main_nav">

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
  <i class="fa fa-bars"></i>
</button>

<!-- Topbar Search -->
<!-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
  <div class="input-group">
    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
    <div class="input-group-append">
      <button class="btn btn-primary" type="button">
        <i class="fas fa-search fa-sm"></i>
      </button>
    </div>
  </div>
</form> -->

<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

  <!-- Nav Item - Search Dropdown (Visible Only XS) -->
  <li class="nav-item dropdown no-arrow d-sm-none">
    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-search fa-fw"></i>
    </a>
   <!-- Dropdown - Messages -->
    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
      <form class="form-inline mr-auto w-100 navbar-search">
        <div class="input-group">
          <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-primary" type="button">
              <i class="fas fa-search fa-sm"></i>
            </button>
          </div>
        </div>
      </form>
    </div>
  </li>

  <!-- Nav Item - Alerts -->
  <!--<li class="nav-item dropdown no-arrow mx-1 admin_only">
    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-bell fa-fw"></i>-->
      <!-- Counter - Alerts -->
      <!--<span class="badge badge-danger badge-counter" id="oo_count">0</span>
    </a>-->
    <!-- Dropdown - Alerts -->
    <!--<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
      <h6 class="dropdown-header">
        Online Orders Alert
      </h6>
      <div id="ooa_field"></div>
      <a class="dropdown-item text-center small text-gray-500" href="javascript:void(0)" id="ooa_markall_read">Mark All Read</a>
    </div>-->
  </li>

  <!-- Nav Item - Messages -->
 <!-- <li class="nav-item dropdown no-arrow mx-1 admin_only">
    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-envelope fa-fw"></i>-->
      <!-- Counter - Messages -->
      <!--<span class="badge badge-danger badge-counter" id="msg-notif-count">0</span>
    </a>-->
    <!-- Dropdown - Messages -->
   <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
      <h6 class="dropdown-header">
        Message Center
      </h6>
     <div id="msg-notif-field">


     </div>

      <a class="dropdown-item text-center small text-gray-500" href="<?php echo base_url('admin/view_all_convo') ?>">View All Conversation</a>
    </div>
  </li>

  <div class="topbar-divider d-none d-sm-block"></div>

  <!-- Nav Item - User Information -->
  <li class="nav-item dropdown no-arrow">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo ucwords(strtolower($_SESSION['firstname'].' '.$_SESSION['lastname'])) ?></span>
      <div class="btn btn-circle btn-sm btn-primary"><i class="fa fa-user"></i></div>
    </a>
    <!-- Dropdown - User Information -->
    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
      <?php if($_SESSION['type'] != 6) : ?>
      <a class="dropdown-item" href="javascript:void(0)" id="manage_account">
        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400" ></i>
        Account
      </a>
    <?php endif; ?>
      <?php if($_SESSION['type'] == 1) : ?>
      <!--<a class="dropdown-item" href="<?php echo base_url() ?>cogs/">
        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
        Settings
      </a>-->
    <?php endif; ?>
      <!-- <a class="dropdown-item" href="#">
        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
        Activity Log
      </a> -->
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="<?php echo base_url('login/logout') ?>" >
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
        Logout
      </a>
    </div>
  </li>

</ul>

</nav>

<!-- End of Topbar -->

<div id="" class="msg_notif_clone" style="display:none">
    <a class="dropdown-item d-flex align-items-center msg_notif" href="javascript:void(0)">
        <div class="dropdown-list-image mr-3">
          <span class="btn btn-circle btn-primary"><i class="fas fa-envelope fa-fw"></i></span>
          <!-- <div class="status-indicator bg-success"></div> -->
        </div>
        <div class="font-weight-bold">
          <div class="text-truncate user"></div>
          <div class="text-truncate text-gray-600 msg"></div>
          <div class="small text-gray-500 datetime"></div>
        </div>
      </a>
</div>

<div id="oo_alert_clone" style="display:none">
      <a class="dropdown-item d-flex align-items-center oo_alert" href="javascript:void(0)">
        <div class="mr-3">
          <div class="icon-circle bg-primary">
            <i class="fas fa-bell text-white alert-icon"></i>
          </div>
        </div>
        <div>

          <div class="small text-gray-500 datetime">December 12, 2019</div>
          <span class="font-weight-bold msg">A new monthly report is ready to download!</span>
        </div>
      </a>
</div>

<style>
.oo_alert.active,.msg_notif.active {
    background: #718fe6;
}
.oo_alert.active .datetime,.oo_alert.active .msg {
    color: white;
}
</style>
<script>
function displayNotification() {
  if (Notification.permission == 'granted') {
    navigator.serviceWorker.getRegistration().then(function(reg) {
      var options = {
        body: 'Here is a notification body!',
        icon: 'images/example.png',
        vibrate: [100, 50, 100],
        data: {
          dateOfArrival: Date.now(),
          primaryKey: 1
        }
      };
      reg.showNotification('Hello world!', options);
    });
  }
}

$(document).ready(function(){
  // displayNotification()
  load_alerts()
  load_msgs();

        $('#manage_account').click(function(e){
          e.preventDefault()
             AjaxUniModal('35','<?php echo base_url('admin/manage_user/').$_SESSION['user_id'].'/my_account' ?>','Manage Account')
        })

    $('#ooa_markall_read').click(function(){
      start_loader()
      $.ajax({
        url:'<?php echo base_url('admin/alert_allread') ?>',
        error:err=>{
          console.log(err)
          Dtoast('An error occured','error')
          end_loader()
        },success:resp=>{
          if(resp == 1){
            end_loader()
            websocket.send(JSON.stringify({type:'renew_alert'}))
          }
        }
      })
    })
})
window.load_msgs = function($id=''){
  if($id == '')
  $('#msg-notif-field').html('<center class="when_load_notif"><i>Loading messages...</i></center>');

  $.ajax({
    url:'<?php echo base_url('admin/load_messages') ?>',
    method:'POST',
    data:{id:$id},
    error:err=>{
      console.log(err)
      $('#msg-notif-field').html('<center class="when_load_notif"><i>An erro occured.</i></center>')
    },
    success:resp=>{
      if(typeof resp != undefined && typeof resp != null){
        resp = JSON.parse(resp)
        $('#msg-notif-count').html(resp.unread_count)
        if(Object.keys(resp.data).length <= 0){
          if($id == '')
          $('#msg-notif-field').html('<center class="when_load_notif"><i>No messages.</i></center>');
        }else{
          var data = resp.data;
          var msg_count = $('#msg-notif-field .msg_notif').length;
          Object.keys(data).map(k=>{
            msg_count++;
            var row = data[k]
            var notif  = $('.msg_notif_clone .msg_notif').clone()
            if(row.status == 0)
            notif.addClass('active')

            notif.attr({'data-no':msg_count,'data-id':row.id,'data-uid':row.user_id,'data-email':row.email,'data-uname':row.uname})
            notif.find('.msg').html(row.message)
            notif.find('.user').html(row.uname)
            notif.find('.datetime').html(row.date_created)
            if(msg_count <= 1){
              $('#msg-notif-field').html(notif);
            }else{
              $('#msg-notif-field').prepend(notif);
            }
          })
        }
      }
    },
    complete:()=>{
      view_convo()
    }
  })
}
window.view_convo = function (){
  // console.log('test')

  $('#msg-notif-field .msg_notif').each(function(){
    $(this).click(function(){
      var _this = $(this)
      if($.isFunction(window.display_convo)){
        display_convo(_this.attr('data-uid'))
      }else{
        AjaxUniModal(40,'<?php echo base_url().'/admin/view_convo/' ?>'+_this.attr('data-uid'),_this.attr('data-uname')+' - '+_this.attr('data-'))
      }


    })
  })
}

window.load_alerts = function($id=''){
  if($id == '')
  $('#ooa_field').html('<center class="when_load">Loading alerts.</center>')

  $.ajax({
    url:'<?php echo base_url('admin/load_alerts') ?>',
    method:'POST',
    data:{id:$id},
    error:err=>console.log(err),
    success:resp=>{
      if(typeof resp != undefined && typeof resp != null){
        resp = JSON.parse(resp)
          if(Object.keys(resp.list).length > 0){
              $('#oo_count').html(resp.unread)
              Object.keys(resp.list).map(k=>{
                var div = $('#oo_alert_clone .oo_alert').clone()
                var row = resp.list[k]
                div.attr('data-id',row.id)
                div.attr('data-form-id',row.form_id)
                div.find('.datetime').html(row.date_created)
                div.find('.msg').html(row.message)
                if(row.status == 0)
                div.addClass('active')
                $('#ooa_field').find('.when_load').remove()
                $('#ooa_field').prepend(div)
              })

          }else{
            if($id == '' )
                $('#ooa_field').html('<center class="when_load">No alerts.</center>')
          }
      }
    },
    complete:()=>{
      alert_funct()
    }
  })
}

window.alert_funct = function (){
  $('#ooa_field .oo_alert').each(function(){
    $(this).click(function(e){
      e.preventDefault()
      start_loader()
      $.ajax({
        url:'<?php echo base_url('admin/read_alert') ?>',
        method:'POST',
        data:{id:$(this).attr('data-id')},
        error:err=>{
          console.log(err)
          Dtoast('An error occured','error')
          end_loader()
        },
        success:resp=>{
          if(resp==1){
            end_loader()
            websocket.send(JSON.stringify({type:'renew_alert'}))
           AjaxUniModal(60,'<?php echo base_url().'/sales/view_order/' ?>'+$(this).attr('data-form-id'),'Alert')

          }
        }
      })
    })
  })


}
</script>
