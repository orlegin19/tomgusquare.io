<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Tomgu Square - <?php echo $page_title ?></title>
  <link rel="shortcut icon" href="<?php echo base_url().'uploads/rios_logo.ico' ?>" type="image/x-icon"/>
  <!-- Font Awesome -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/font-awesome/css/font-awesome.min.css">
  <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css"> -->
  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url() ?>assets/mobile/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="<?php echo base_url() ?>assets/mobile/css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="<?php echo base_url() ?>assets/mobile/css/style.css" rel="stylesheet">
  <script type="text/javascript" src="<?php echo base_url() ?>assets/mobile/js/jquery-3.4.1.min.js"></script>

  <style type="text/css">
    html,
    body,
    header,
    .carousel {
      height: 60vh;
    }

    @media (max-width: 740px) {

      html,
      body,
      header,
      .carousel {
        height: 100vh;
      }
    }

    @media (min-width: 800px) and (max-width: 850px) {

      html,
      body,
      header,
      .carousel {
        height: 100vh;
      }
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

<body class="grey lighten-3">
<div role="alert" aria-live="assertive" aria-atomic="true" class="toast"  id="dynamic_toast" auto-hide="true">
  
  <div class="toast-body badge-success badge-type">
    <span class="mr-2"><i class="fa fa-check badge-success badge-type icon-place"></i></span>
    <span class="msg-field"></span>
  </div>
</div>
  <?php include 'nav_bar.php'; ?>


  <?php if((strtolower($page_title)) == 'home'){ 
        include 'carousel.php';
   } ?>
  <!--Main layout-->
  
  <main>
    <div class="container wow fadeIn" style='padding-bottom:20px'>

        <?php include $page_name.".php"; ?>

    </div>
  </main>
  <div class="modal"  role="dialog" id="loader" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
      <div class="mloader">
            <div class="loader"></div>
          </div>
      </div>
    </div>
  </div>
  <!-- Universal Modal  -->
<div class="modal modal-full-height modal-right"  role="dialog" id="universal_modal" backdrop="static">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="body-content"></div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div> -->
    </div>
    </div>
  </div>
</div>
  <!--Main layout-->

  <!--Footer-->
  <!-- <footer class="page-footer text-center font-small mt-4 wow fadeIn">

    <div class="pt-4">
      <a class="btn btn-outline-white" href="https://mdbootstrap.com/docs/jquery/getting-started/download/" target="_blank"
        role="button">Download MDB
        <i class="fas fa-download ml-2"></i>
      </a>
      <a class="btn btn-outline-white" href="https://mdbootstrap.com/education/bootstrap/" target="_blank" role="button">Start
        free tutorial
        <i class="fas fa-graduation-cap ml-2"></i>
      </a>
    </div>

    <hr class="my-4"> -->

    <!-- Social icons 
    <div class="pb-4">
      <a href="https://www.facebook.com/mdbootstrap" target="_blank">
        <i class="fab fa-facebook-f mr-3"></i>
      </a>

      <a href="https://twitter.com/MDBootstrap" target="_blank">
        <i class="fab fa-twitter mr-3"></i>
      </a>

      <a href="https://www.youtube.com/watch?v=7MUISDJ5ZZ4" target="_blank">
        <i class="fab fa-youtube mr-3"></i>
      </a>

      <a href="https://plus.google.com/u/0/b/107863090883699620484" target="_blank">
        <i class="fab fa-google-plus-g mr-3"></i>
      </a>

      <a href="https://dribbble.com/mdbootstrap" target="_blank">
        <i class="fab fa-dribbble mr-3"></i>
      </a>

      <a href="https://pinterest.com/mdbootstrap" target="_blank">
        <i class="fab fa-pinterest mr-3"></i>
      </a>

      <a href="https://github.com/mdbootstrap/bootstrap-material-design" target="_blank">
        <i class="fab fa-github mr-3"></i>
      </a>

      <a href="http://codepen.io/mdbootstrap/" target="_blank">
        <i class="fab fa-codepen mr-3"></i>
      </a>
    </div> -->
    <!-- Social icons -->

    <!--Copyright
    <div class="footer-copyright py-3">
      © 2019 Copyright:
      <a href="https://mdbootstrap.com/education/bootstrap/" target="_blank"> MDBootstrap.com </a>
    </div>
    <!--/.Copyright

  </footer>
  <!--/.Footer-->

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <!-- Bootstrap tooltips -->
  <script src="<?php echo base_url() ?>assets/js/jquery-ui.js"></script> 
  <script type="text/javascript" src="<?php echo base_url() ?>assets/mobile/js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="<?php echo base_url() ?>assets/mobile/js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="<?php echo base_url() ?>assets/mobile/js/mdb.min.js"></script>
  <!-- Initializations -->
  <script type="text/javascript">
    var websocket = new WebSocket("ws://<?php echo $_SERVER['SERVER_NAME'] ?>:8090/tomgu/php-socket.php"); 
    websocket.onopen = function(event){
        
          }
          websocket.onclose = function(event){
            // showMessage("<div class='error'>Problem due to some Error</div>");
            connect();
          };
          
          websocket.onmessage = function(event){
              var Data = JSON.parse(event.data);
              if(typeof Data !=undefined && typeof Data != null){
                if(typeof Data.type !=undefined && Data.type == 'message_renew_user' &&  Data.user_id == '<?php echo $_SESSION['user_id'] ?>' ){
                  if($.isFunction(window.load_msgs))
                  load_msgs(Data.id)
                  if($.isFunction(window.update_msg_unread))
                  update_msg_unread();
                  if($('#msg-box-field').length > 0){
                    if($('#msg-box-field').is(':visible') == true){
                      if($.isFunction(window.update_msg_to_read))
                      update_msg_to_read()
                    }
                  }
                }

                if(Data.type == 'new_cart' && Data.user_id == '<?php echo $_SESSION['user_id'] ?>'){
                   var cur_count = $('#cart_count').html();
                   cur_count++;
                  //  console.log(cur_count);
                   $('#cart_count').html(cur_count);
                   $('#cart_count').show();
               }

               if(Data.type == 'order_update'){
                   if($('.order-list[data-id="'+Data.id+'"]').length > 0){
                       var badge = $('.order-list[data-id="'+Data.id+'"]').find('.status')
                       badge.removeClass('badge-success')
                       badge.removeClass('badge-primary')
                       if(Data.otype == 3){
                           badge.addClass('badge-success').html('Delivered')
                       }else{
                            badge.addClass('badge-success').html('Picked-up')
                       }
                   }
               }

              }
            }
    // Animations initialization
    // new WOW().init();
    var isMobile = false; //initiate as false
    // device detection
    if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
      || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) { 
      isMobile = true;
    }
   $(document).ready(function(){
    // start_loader()
    $('.toast').each(function(){
      $(this).on('hidden.bs.toast', function () {
        $(this).hide()
      })
      $(this).on('show.bs.toast, shown.bs.toast', function () {
        $(this).show()
      })
    })
      $('.modal .modal-dialog').height($(window).height())
    if(isMobile == true){
      $('.modal').height($(window).height())
      $('.modal .modal-content , .modal .modal-dialog').height('100%')
      $('.modal .modal-dialog').width($(window).width())

                if($(window).width() <= 760)
              $('.msg-box-field').width($(window).width())
                if($(window).height() <= 900)
              $('.msg-box-field').height($(window).height()-$('#main_nav').height()-20)
              $('.msg-box-field').css({'z-index':9999,bottom:'5px','left':0})
    }
    $(window).on('resize',()=>{
      $('.modal').height($(window).height())
      $('.modal .modal-content , .modal .modal-dialog').height('100%')
      $('.modal .modal-dialog').width($(window).width())
    })
   
    
   })
    window.Dtoast = ($message='',type='info')=>{
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
  window.start_loader = function(){
    $('body').prepend('<div id="preloader2"></div>')
  }
  window.end_loader = function(){
    $('#preloader2').fadeOut('fast', function() {
          $(this).remove();
        })
  }
  function AjaxUniModal(url='',title=''){
    start_loader()
  $('#universal_modal .modal-title').html(title);
         
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
          $('#universal_modal').modal('show');
          end_loader()
        }else{

        }
      }
    })
  }
}
  </script>
</body>

</html>
