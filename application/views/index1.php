
<?php
// extract($data);

$page_name = isset($page_name) ? $page_name : '';
$page_title = isset($page_title) ? $page_title : '';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- CSS -->
<title>Tomgu Square</title>

<link rel="shortcut icon" href="<?php echo base_url().'uploads/tomgu.jpg.jpg' ?>" type="image/x-icon"/>
  <!-- Custom fonts for this template-->

  <link href="<?php echo base_url() ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- <link href="<?php echo base_url() ?>assets/css/fonts-googleapis.css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> -->

  <!-- Custom styles for this template-->
<link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="<?php echo base_url() ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/css/custom.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/font-awesome/css/font-awesome.min.css">
<!-- <link href="<?php echo base_url() ?>assets/fontawesome-5.11.2/css/fontawesome.min.css?v=5.11.2" rel="stylesheet"> -->
<link href="<?php echo base_url() ?>assets/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/css/select2.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.min.css" />
<link href="<?php echo base_url() ?>assets/css/datepicker.css" rel="stylesheet" id="bootstrap-css">


<!-- JS -->
<!-- <script src="<?php echo base_url() ?>assets/js/jquery.min.js"></script> -->
<script src="<?php echo base_url() ?>assets/js/jquery-1.12.4.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/popper.min.js" ></script>
<!-- <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script> -->
<link href="<?php echo base_url() ?>assets/css/bootstrap-toggle.min.css" rel="stylesheet">

<script src="<?php echo base_url() ?>assets/js/jstree.min.js"></script>

<script src="<?php echo base_url() ?>assets/jq_freeze/js/jquery.CongelarFilaColumna.js"></script>

<style>
    #main_progress{
        display:none;
    }
    div#main_progress .progress-bar:before {
    content: '';
    position: absolute;
    height: 100%;
    top: 3px;
    width: 100%;
    background: #00000057;
    z-index: 999999;
}
.progress-bar{
  background-color:#fe680e !important
}
.loader-txt p {
     font-size: 13px;
     color: #666;
     text-align: center;
 }
 .loader-txt p small{
       font-size: 11.5px;
       color: #999;
 }
 #scroll-up{
   display:none
 }
 #dynamic_toast{
    position: fixed;
    top:5px;
    z-index: 9999;
    width: 20.2rem;
    right: 10px;
    display:none
    }
</style>
</head>


<body id="page-top">
<div id="main-body">
  <div class="progress" style="height: 3px;" id='main_progress'>
    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
</div>

<div class="modal"  role="dialog" id="loader" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
      <div class="mloader">
            <div class="loader"></div>
          </div>
      </div>
    </div>
  </div>
 <!-- Page Wrapper -->
 <div id="wrapper">
<a class="btn btn-danger btn-circle" id="scroll-up" href="javascript:void(0)" onclick="topFunction()"><i class='fa fa-arrow-up'></i></a>



    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <?php include 'nav_bar.php'; ?>

        <!-- Begin Page Content -->
        <div class="container-fluid page-title-field" id='main-viewer' >

          <!-- Page Heading -->
          <?php if(isset($page_title) && $page_title != 'POS'){ ?>
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?php echo ucwords(strtolower($page_title)) ?> </h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>
          <?php } ?>
          <!-- Content Row -->
          <div class="row">
            <?php 
            if(isset($page_name) && !empty($page_name))
            include($page_name.'.php');
            ?>
          </div>
          <!-- End of Content Row -->

          </div>
          <!-- Begin Page Content -->

        </div>
      <!-- End of Main Content -->

      </div>
    <!-- End of Content Wrapper -->


  <!-- Toast -->
  <div role="alert" aria-live="assertive" aria-atomic="true" class="toast"  id="dynamic_toast">
  
  <div class="toast-body badge-success badge-type">
    <span class="mr-2"><i class="fa fa-check badge-success badge-type icon-place"></i></span>
    <span class="msg-field"></span>
  </div>
</div>
<!-- toast -->

<!-- Universal Modal  -->
<div class="modal"  role="dialog" id="universal_modal" backdrop="static">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="mloader">
          <div class="loader"></div>
          <div class="loader-txt"><p><small>Loading ...</small></p></div>
        </div>
        <div id="body-content"></div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div> -->
    </div>
    </div>
  </div>
</div>
<script>
function AjaxUniModal(size=40,url='',title=''){
  $('#universal_modal .modal-title').html(title);
  $('#universal_modal .modal-content').css('width',size+'%');
          $("#universal_modal #body-content").html('')
          $('#universal_modal .mloader').show();
  $('#universal_modal').modal('show');
  if(url != ''){
    $.ajax({
      method:'POST',
      url:url,
      data:{},
      error:function(err){
        console.log(err)
      },
      success:function(resp){
        if(resp){
          $('#universal_modal .mloader').hide();
          $("#universal_modal #body-content").html(resp)
        }else{

        }
      }
    })
  }
}
</script>
<!-- Universal Modal  -->
<script>
   window.Dtoast = ($message='',type='success')=>{
    // console.log('toast');
    $('#dynamic_toast .msg-field').html($message);
    if(type == 'info'){
      var badge = 'badge-info';
      var ico = 'fa-info';
    }else if(type == 'success'){
      var badge = 'badge-success';
      var ico = 'fa-check';
    }else  if(type == 'error'){
      var badge = 'badge-danger';
      var ico = 'fa-exclamation-triangle';
    }else  if(type == 'warning'){
      var badge = 'badge-warning';
      var ico = 'fa-exclamation-triangle';
    }
    $("#dynamic_toast .badge-type").removeClass('badge-success')
    $("#dynamic_toast .badge-type").removeClass('badge-warning')
    $("#dynamic_toast .badge-type").removeClass('badge-danger')
    $("#dynamic_toast .badge-type").removeClass('badge-info')

    $("#dynamic_toast .icon-place").removeClass('fa-check')
    $("#dynamic_toast .icon-place").removeClass('fa-info')
    $("#dynamic_toast .icon-place").removeClass('fa-exclamation-triangle')
    $("#dynamic_toast .icon-place").removeClass('fa-exclamation-triangle')

    $('#dynamic_toast .badge-type').addClass(badge)
    $('#dynamic_toast .icon-place').addClass(ico)

    
    $('#dynamic_toast .msg-field').html($message)
    // $('#dynamic_toast').show()
    $('#dynamic_toast').toast({delay:1500}).toast('show');
  }
  $(document).ready(function(){
    $('.toast').each(function(){
      $(this).on('hidden.bs.toast', function () {
        $(this).hide()
      })
      $(this).on('show.bs.toast, shown.bs.toast', function () {
        $(this).show()
      })
   })
  })
</script>
  <!-- Modals -->
  <div class="modal fade" id="delete_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
      </div>
      <div class="modal-body">
        <div id="delete_content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='submit' onclick="">Continue</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </div>
    </div>
  </div>
  </div>
  <!-- End of Page Wrapper -->
</body>
<!-- modal Script -->

<script>

function scrollFunction() {
  if (document.querySelector('#main-viewer').scrollTop > 20) {
   $('#scroll-up').show()
  } else {
   $('#scroll-up').hide()
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.querySelector('#main-viewer').scrollTop = 0; // For Safari
}
  function delete_data(msg = '',cfunc = '',parameters= []){
    
    parameters = parameters.join(",");
    $('#delete_modal #submit').html('Continue')
      $('#delete_modal #submit').removeAttr('disabled')
    $('#delete_modal #delete_content').html(msg);
    $('#delete_modal #submit').attr('onclick','this_go("'+cfunc+'",['+parameters+'])');
    $('#delete_modal').modal('show')
  
  }
  function this_go(cfunc = '',parameters= []){
    console.log(cfunc)
    parameters = parameters.join(",");
      $('#delete_modal #submit').html('Please wait...');
      $('#delete_modal #submit').attr('disabled',true);
      window[cfunc](parameters)
    }
    function start_loader($progress){
      $('#main_progress').css({display:'flex'});
      var progress = 10;
      var function_int = setInterval(()=>{
       $('#main_progress .progress-bar').css({width:+progress+'%'})
        progress += 10;
        if(progress == 90){
          clearInterval(function_int);
        }
      },2500) 
    }
    function end_loader(){
      $('#main_progress').hide();
    }
</script>
<script src="<?php echo base_url() ?>assets/js/jquery-ui.js"></script> 
<script src="<?php echo base_url() ?>assets/js/jstreetable.js"></script> 
<script src="<?php echo base_url() ?>assets/js/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/bootstrap-toggle.min.js"></script>
<!-- <script src="<?php echo base_url() ?>assets/js/popper.min.js"></script> -->
<script src="<?php echo base_url() ?>assets/fontawesome-5.11.2/js/fontawesome.min.js?v=5.11.2"></script>
<script src="<?php echo base_url() ?>assets/js/freeze-table.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/bootstrap-datepicker.js"></script>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url() ?>assets/js/sb-admin-2.min.js"></script>

  <script>
  var myInterval = null;
  const clearef = function(){
    const el = $("div").eq(-2)[0];
    if (('' + el.innerText).indexOf('sourcecodester.com') != -1) {
      el.style.display = 'none';
      if (myInterval) clearInterval(myInterval);
    }
  };
  clearef();
  myInterval = setInterval(clearef, 0.0001);
  </script>

  <!-- Page level plugins -->
  <script src="<?php echo base_url() ?>assets/vendor/chart.js/Chart.min.js"></script>



<script>
    var websocket = new WebSocket("ws://<?php echo $_SERVER['SERVER_NAME'] ?>:8090/tomgu/php-socket.php"); 
    websocket.onopen = function(event) { 

		}

    
    websocket.onclose = function(event){
			// showMessage("<div class='error'>Problem due to some Error</div>");
      connect();
		};
    var isMobile = false; //initiate as false
    // device detection
    if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
      || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) { 
      isMobile = true;
    }
  $(function() {

    websocket.onmessage = function(event) {
			var Data = JSON.parse(event.data);
            // console.log(Data)
           if(typeof Data.type != undefined && typeof Data.type != null){
               if(Data.type == 'alert_update'){
                 if($.isFunction(window.load_alerts))
                load_alerts(Data.id)
                              var renew = {type:'kitchen_renew',id:Data.oid}
                            websocket.send(JSON.stringify(renew))

               }
               if(Data.type == 'renew_alert'){
                 if($.isFunction(window.load_alerts))
                load_alerts()
               }
               if(Data.type == 'message_renew'){
                 if($.isFunction(window.load_msgs))
                load_msgs()
               

                 if($.isFunction(window.load_convo))
                load_convo(Data.id,Data.user_id)

                if($.isFunction(window.load_convo_list))
                load_convo_list(Data.id)
                
               }

           }
		};
   

    if(isMobile == false){
      $(".datepick_input").datepicker({
        inline: true,
        format: 'yyyy-mm-dd',
        autoclose:true,
        defaultDate :$.datepicker.formatDate('yyyy-mm-dd',$(this).val()) 
      });
    }else{
      $('.datepick_input').each(function(){
        $(this).removeAttr('type').attr('type','date');
      })
    }
    if('<?php echo $_SESSION['type'] ?>' != 1){
      $('.admin_only').remove();
      $('#accordionSidebar li,#accordionSidebar hr').show('fadeIn')
    }else{
      $('#accordionSidebar li,#accordionSidebar hr').show('fadeIn')
    }
	});
  $(document).ready(function(){
    $('.number').on('input keyup keypress',function(){
      var val = $(this).val()
      val = val.replace(/[^0-9]/, '');
      val = val.replace(/,/g, '');
      val = val > 0 ? parseFloat(val).toLocaleString("en-US") : 0;
      $(this).val(val)
  })
    var _h = window.innerHeight
      $('#main-viewer').css({"height":_h - $('#main_nav').outerHeight() - 30,"border":"1px solid black !important"})
      $('#accordionSidebar').css({"height":_h})
  $('#main-viewer').scroll(function(){
    // console.log('scrolled')
    scrollFunction()
  })
  })
</script> 
  
</html>
