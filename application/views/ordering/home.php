<style>
#product-holder .card-data{
  cursor:pointer
}
.modal-full-height .modal-body{
  height: 100vw !important;
  overflow: auto;
}
</style>
        <form action="" id="filter">
        <div class="col-md-12">
        <div class="row">
              <div class="md-form col-sm-5 input-group input-group-sm">
                  <input type="search" id="filter-field" class="form-control">
                  <label for="filter-field">  Search Product</label>
                  <div class="input-group-append">
                        <button class="btn btn-pill qty-plus" type="submit" id="filter-btn"><i class="fa fa-search"></i> Filter</button>
                    </div>
              </div>
        </div>
        </div>
        </form>
      <!--Navbar-->
      <nav class="navbar navbar-expand-lg navbar-dark mdb-color lighten-3 mt-3 mb-5" id="nav_cat">

        <!-- Navbar brand -->
        <span class="navbar-brand">Categories:</span>

        <!-- Collapse button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
          aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsible content -->
        <div class="collapse navbar-collapse" id="basicExampleNav">

          <!-- Links -->
          <ul class="navbar-nav mr-auto" id="cat-field">
            <li class="nav-item active">
              <a class="nav-link" href="javascript:void(0)" data-cat='all'>All
                <span class="sr-only">(current)</span>
              </a>
            </li>
          </ul>
          <!-- Links -->

        </div>
        <!-- Collapsible content -->

      </nav>
      <!--/.Navbar-->

      <!--Section: Products v.3-->
      <section class="text-center mb-4">

        <!--Grid row-->
        
        <div class="row wow fadeIn" id="product-holder">

         

        </div>

      </section>
      <!--Section: Products v.3-->
        <div id="clone_card_data" style="display:none">
             <!--Grid column-->
          <div class="col-lg-3 col-md-6 mb-4 card-data">

            <!--Card-->
            <div class="card">

            <!--Card image-->
            <div class="view overlay">
                <img src="" class="card-img-top"
                alt="">
                <a>
                <div class="mask rgba-white-slight"></div>
                </a>
            </div>
            <!--Card image-->

            <!--Card content-->
            <div class="card-body text-center">
                <!--Category & Title-->
                <div class="grey-text">
                <h5 class="cat_name">Shirt</h5>
                </div>
                <h5>
                <strong>
                    <div class="dark-grey-text pname">Denim shirt
                    <span class="badge badge-pill danger-color">NEW</span>
                    </div>
                </strong>
                </h5>

                <h4 class="font-weight-bold blue-text ">
                <strong class="price">120$</strong>
                </h4>

            </div>
            <!--Card content-->

            </div>
            <!--Card-->

            </div>
            <!--Grid column-->
        </div>
      <!--Pagination-->
      <nav class="d-flex justify-content-center wow fadeIn">
        <ul class="pagination pg-blue" id="pagination">

          
        </ul>
      </nav>
      <!--Pagination-->
    <div id="paginate-clone" style="display:none">
    <li class="page-item prev-page">
            <a class="page-link" data-topage="prev" href="javascript:(0)" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
              <span class="sr-only">Previous</span>
            </a>
          </li>

          
         
          <li class="page-item next-page">
            <a class="page-link" data-topage="next" href="javascript:(0)" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
              <span class="sr-only">Next</span>
            </a>
          </li>
    </div>

    <div class="modal fade right" id="product_description" tabindex="-1" role="dialog" aria-labelledby="desc_modal"
  aria-hidden="true">

      <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
      <div class="modal-dialog modal-full-height modal-right" role="document">


        <div class="modal-content">
          <div class="modal-header">
            <!-- <h4 class="modal-title w-100" id="desc_modal">Modal title</h4> -->
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true"><i class="fa fa-arrow-right"></i></span>
            </button>
          </div>
          <div class="modal-body">
            <div id="order_field"></div>
            
          </div>

          <div class="modal-footer justify-content-center" style="width:100%">
            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
            <button type="button" class="btn btn-primary btn-sm pull-right" id="cart_btn"><i class='fa fa-plus'></i> Add to Cart</button>
          </div>
          
        </div>
      </div>
    </div>

    <div class="msg-btn-field">
      <div class="msg-box-field card shadow" style="display:none">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-white">Ask Admin</h6>
            <span class="pull-right close" id="close-msg-box" style="cursor:pointer"><i class="fa fa-minus"></i></span>
          </div>
          
            
          <div class="card-body">
          <div class="msg-box-clone" style="display:none">
              <div class="msg-box msg-left">
                <p class="msg">Hi</p>
                <small class="msg-datetime text-white text-right">December</small>
              </div>
              <div class="msg-box msg-right">
                  <p class="msg">Hello</p>
                <small class=" msg-datetime text-white">December</small>
              </div>
          </div>
          <div id="convo-field">
          </div>
          </div>
            
          <div class="card-footer">
            <form id="msg-frm">
              <div class="col-md-12">
                <div class="row">
                <div class=" input-group input-group-sm">
                <textarea id="nmsg-field" class="md-textarea form-control" name="message" rows="3" style="resize:none;overflow:auto" placeholder="Enter message"></textarea>
                  <div class="input-group-append">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-send"></i></button>
                    </div>
              </div>
                </div>
              </div>
            </form>
          </div>
      </div>
      <button class="btn btn-primary btn-circle" id="open-msg-btn"><i class="fa fa-comment-o"></i>
      <span class="badge badge-danger badge-counter" id="msg_count_unread" style="display:none">0</span>
      </button>
    </div>
      <script>
          $(document).ready(function(){

            $('[name="message"]').keyup(function(e){
              if(isMobile == false){
              if(e.originalEvent.key == 'Enter' && e.originalEvent.shiftKey == false)
              $('#msg-frm').submit();
              }
            })


            $(window).on('resize',function(){
              // alert($(window).height())
              if(isMobile == true){
                if($(window).width() <= 760)
              $('.msg-box-field').width($(window).width())
                if($(window).height() <= 900)
              $('.msg-box-field').height($(window).height()-$('#main_nav').height()-20)
              $('.msg-box-field').css({'z-index':9999,bottom:'5px','left':0})

              $('.msg-box-field .card-body').animate({
                          scrollTop: $('.msg-box-field .card-body')[0].scrollHeight - 10
                      }, 'fast');
              }
            })
            $('#msg-frm').submit(function(e){
              e.preventDefault();
              var frmData= $(this).serialize()
              if($('[name="message"]').val() == '')
              return false;
              var txt = $('[name="message"]').val()
              txt = txt.replace(/\n/gi,'<br>')
              console.log(frmData)
              var mbox_no = $('#convo-field .msg-right').length;
              mbox_no++;
              var mbox = $('.msg-box-clone .msg-box.msg-right').clone()
              mbox.attr('data-no',mbox_no)
              mbox.find('.msg').html(txt)
              mbox.find('.msg-datetime').html('sending....')
              $('#convo-field').append(mbox)
              $('.msg-box-field .card-body').animate({
                            scrollTop: $('.msg-box-field .card-body')[0].scrollHeight - 10
                        }, 'fast');
              $('[name="message"]').val('')

              $.ajax({
                url:'<?php echo base_url('order/message_send') ?>',
                method:'POST',
                data:frmData,
                error:err=>{
                  console.log(err)
                  $('.msg-box[data-no="'+mbox_no+'"]').find('.msg-datetime').html('Sending Failed')
                  $('.msg-box[data-no="'+mbox_no+'"]').find('.msg-datetime').removeClass('text-white').css('color','red')

                  
                },
                success:resp=>{
                  if(typeof resp != undefined && typeof resp != null){
                    resp = JSON.parse(resp)
                    if(resp.status =='success'){
                        $('.msg-box[data-no="'+mbox_no+'"]').find('.msg-datetime').html(resp.data.date_created)
                        websocket.send(JSON.stringify({type:'message_renew',id:resp.data.id,user_id:'<?php echo $_SESSION['user_id'] ?>'}))
                    }
                  }
                }
              })
            })
            $('#open-msg-btn').click(function(){
              $(this).hide()
              $('.msg-box-field').show()
              if(isMobile == true)
              $('.msg-btn-field').css({'left':0,'bottom':0})
              $('.msg-box-field .card-body').animate({
                          scrollTop: $('.msg-box-field .card-body')[0].scrollHeight - 10
                      }, 'fast');
            })
            
            $('#close-msg-box').click(function(){
              $('.msg-box-field').hide()
              $('#open-msg-btn').show()
              if(isMobile == true)
              $('.msg-btn-field').css({'left':'unset','bottom':'15px'})
              update_msg_to_read()
            })
              load_pcards(0,1);
              load_pg();
              load_msgs();
              update_msg_unread();
              $('#filter').on('search',function(){
                load_pcards(0,1);
                $('html, body').animate({
                              scrollTop: $("#product-holder").offset().top - "150"
                          }, 'fast');
              })
              $('#filter').submit(function(e){
                e.preventDefault()
                $('#cat-field').find('.nav-item.active').removeClass('active');
                $('.nav-link[data-cat="all"]').closest('li').addClass('active');
                load_pcards(0,1);
                $('html, body').animate({
                              scrollTop: $("#product-holder").offset().top - "150"
                          }, 'fast');
              })
              // $('#nmsg-field').keyup(function(e){
              //   console.log($(this))
              // })

              var msg_count_interval = function(){
                if($('#msg_count_unread').html() > 0){
                  $('#msg_count_unread').show()
                }else{
                  $('#msg_count_unread').hide()
                }
              }
              setInterval(msg_count_interval,500)
          })

          window.update_msg_to_read = function(){
            $.ajax({
              url:'<?php echo base_url('order/update_msg_to_read') ?>',
              error:err=>console.log(err),
              success:resp=>{
                if(resp == 1){
                  $('#msg_count_unread').html(0)  

                }
              }
            })
          }

          window.update_msg_unread = function(){
            $.ajax({
              url:'<?php echo base_url('order/count_unread_msg') ?>',
              method:'POST',
              data:{user_id:'<?php echo $_SESSION['user_id'] ?>'},
              error:err=>{
                console.log(err)
              },
              success:resp=>{

                if(typeof resp != undefined){
                  resp = JSON.parse(resp)
                  if(resp.status == 'success'){
                    $('#msg_count_unread').html(resp.count)  
                  }
                }
              }
            })
          }

          window.load_msgs = function($id=''){
            if($id == '')
            $('#convo-field').html('<center><i>Loading messages...</i></center>')
            $.ajax({
              url:'<?php echo base_url('order/load_messages') ?>',
              method:'POST',
              data:{id:$id},
              error:err=>{
                console.log(err)
                if($id == '')
                $('#convo-field').html('<center><i>An error occured while loading messages.</i></center>');
                else{
                $('#convo-field').append('<center><i>An error occured while loading new message.</i></center>');

                }
              },
              success:resp=>{
                if(typeof resp != undefined && typeof resp != null){
                  resp = JSON.parse(resp)
                  if(Object.keys(resp).length <= 0){
                    if($id == '' ){
                      var msg_b = $('.msg-box-clone .msg-box.msg-left').clone()
                      msg_b.find('.msg').html('Hi <?php echo $_SESSION['firstname'] ?>!<br> Do you have any question? You can ask the admin by sending your question or message for us. :)');
                      msg_b.find('.msg-datetime').html('')
                      $('#convo-field').html(msg_b)
                    }
                  }else{
                    if($id == ''){
                    var msg_b = $('.msg-box-clone .msg-box.msg-left').clone()
                      msg_b.find('.msg').html('Hi <?php echo $_SESSION['firstname'] ?>!<br> Do you have any question? You can ask the admin by sending your question or message for us. :)');
                      msg_b.find('.msg-datetime').html('')
                      $('#convo-field').html(msg_b)
                      }
                    Object.keys(resp).map(k=>{
                      var row = resp[k]
                      if(row.type ==1)
                      var msg_b = $('.msg-box-clone .msg-box.msg-left').clone();
                      else 
                      var msg_b = $('.msg-box-clone .msg-box.msg-right').clone();
                      var mb_count = $('#convo-field .msg-box').length
                      mb_count++;
                      row.message = row.message.replace(/\n/gi,'<br/>')
                      msg_b.attr({'data-id':row.id,'data-no':mb_count})
                      msg_b.find('.msg').html(row.message)
                      msg_b.find('.msg-datetime').html(row.date_created)
                      if(mb_count <= 1){
                        $('#convo-field').html(msg_b)
                      }else{
                        $('#convo-field').append(msg_b)
                      }
                      $('.msg-box-field .card-body').scrollTop($('.msg-box-field .card-body')[0].scrollHeight - 10)

                    })
                  }
                }
              }
            })
          }
          window.load_pcards = function($offset=0,$reset=0,$search=$('#filter-field').val()){
                $('#product-holder').html('<center><i>Loading data...</i></center>')
                var catId = $('#nav_cat').find('.nav-item.active .nav-link').attr('data-cat');
                // console.log(catId)
                $.ajax({
                    url:'<?php echo base_url('order/p_load') ?>',
                    method:'POST',
                    data:{cat_id:catId ,offset:$offset,search:$search},
                    error:err=>{
                        console.log(err)

                    },
                    success:resp=>{
                        if(resp){
                            if(typeof resp != undefined){
                                var resp = JSON.parse(resp)
                                var html = '';
                                var data = resp.list;
                                // console.log(Object.keys(data).length)
                                if(Object.keys(data).length > 0)
                                $('#product-holder').html('')
                                else
                               $('#product-holder').html('<center><i>No data to be display...</i></center>')


                                Object.keys(data).map(k=>{
                                    var card = $('#clone_card_data .card-data').clone();
                                    card.find('.card-img-top').attr('src','<?php echo base_url() ?>'+data[k].img_path)
                                    card.find('.cat_name').html(data[k].cat_name)
                                    card.find('.pname').html(data[k].name)
                                    card.find('.price').html('&#8369; '+data[k].price)
                                    card.attr('data-id',data[k].id)
                                $('#product-holder').append(card)
                                    // html += card;
                                  pclick_f();
                                })

                                if($reset == 1)
                                {
                                  var pages = parseInt(resp.count) / 8;
                                  pages = parseFloat(pages).toLocaleString('en-US',{style:'decimal',minimumFractionDigits:1,maximumFractionDigits:1,useGrouping:false});
                                  pages = pages.split('.')

                                  if(typeof pages[1] != undefined &&  pages[1] > 0)
                                  pages = parseInt(pages[0]) + 1;
                                  else
                                  pages = pages[0];
                                  // $('#pagination').find('.pg_nums').each(()=>{
                                  // console.log($(this).remove())
                                  //   $(this).remove()
                                  // });
                                  html = $('#paginate-clone').html();
                                  // console.log(html)
                                  $('#pagination').html(html)
                                  html = '';
                                  for(var i = 1;i <= pages;i++ ){
                                    html += '<li class="page-item '+(i == 1 ? 'active' : '')+' pg_nums">'+
                                              ' <a class="page-link" data-topage="'+(i)+'" href="javascript:void(0)">'+
                                              (i)+
                                                '</a>'+
                                            '</li>';
                                  }
                                  $('#pagination .prev-page').after(html);
                                  $('#pagination .prev-page').addClass('disabled');
                                  if(pages == 1)
                                  $('#pagination .next-page').addClass('disabled');
                                  $('#pagination').attr({'data-pages':'true','data-last':pages});

                                }


                                
                            }
                        }
                    },
                    complete:()=>{
                        page_f();
                      }
                })
          }
          window.pclick_f = function(){
            $('#product-holder').find('.card-data').each(function(){
              $(this).click(function(){
                $.ajax({
                  url:'<?php echo base_url('order/get_prod_details') ?>',
                  method:'POST',
                  data:{id:$(this).attr('data-id')},
                  error:err=>{
                    console.log(err)
                  },
                  success:resp=>{
                    if(resp){
                      $('#product_description').find('#order_field').html('')
                      $('#product_description').find('#order_field').html(resp)
                      $('#product_description').modal('show')
                    }
                  }
                })
                
              })
            })
          }
          window.load_pg = function(){
              var html ='';

              $.ajax({
                url:'<?php echo base_url('order/load_pg') ?>',
                method:'POST',
                data:{},
                error:err=>{
                  console.log(err)
                },
                success:resp=>{
                  if(typeof resp != undefined){
                    resp = JSON.parse(resp)
                    Object.keys(resp).map(k=>{
                      html = '<li class="nav-item">'+
                              '<a class="nav-link" href="javascript:void(0)" data-cat="'+resp[k].id+'">'+resp[k].name+
                                '<span class="sr-only">(current)</span>'+
                              '</a>'+
                            '</li>'

                      $('#cat-field').append(html);
                    })
                  }
                },
                complete:()=>{
                  cat_f();
                }
              })
          }
          window.cat_f = function(){
            $('#cat-field').find('.nav-link').each(function(){
              $(this).click(function(){
                $('#filter-field').val('')
                $('#cat-field').find('.nav-item.active').removeClass('active');
                $(this).closest('li').addClass('active');
                load_pcards(0,1)
                $('#basicExampleNav').removeClass('show')
                $('html, body').animate({
                    scrollTop: $("#product-holder").offset().top - "150"
                }, 'fast');
              })
            })
          }
          window.page_f =function(){
            $('#pagination .page-link').each(function(){
              $(this).click(function(){
                var toPage = $(this).attr('data-topage');
                var lastPage = $('#pagination').attr('data-last')
                var a = $('#pagination').find('.page-item.active .page-link').attr('data-topage');

                // console.log(toPage,lastPage,a)
                if(toPage == 'prev'){
                  toPage = parseInt(a) - 1;
                }else if(toPage == 'next'){
                  toPage = parseInt(a) + 1;
                }
                $('#pagination').find('.page-item.active').removeClass('active');
                $('#pagination').find('.page-link[data-topage="'+toPage+'"]').closest('li').addClass('active')

                var offset = (parseInt(toPage) - 1) * 8;
                if(toPage == '1'){
                  $('#pagination').find('.page-item.prev-page').addClass('disabled');
                }else{
                  $('#pagination').find('.page-item.prev-page').removeClass('disabled');
                }
                if(toPage == lastPage){
                  $('#pagination').find('.page-item.next-page').addClass('disabled');
                }else{
                  $('#pagination').find('.page-item.next-page').removeClass('disabled');
                }
                // console.log(toPage == '1',toPage == lastPage)
                load_pcards(offset);
                $('html, body').animate({
                    scrollTop: $("#nav_cat").offset().top
                }, 'fast');

              })
            })
          }
      </script>