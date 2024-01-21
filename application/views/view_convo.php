    <?php
    if($view == 1){
      $user = $this->db->get_where('users',array('id'=>$user_id))->row();

    }
    ?>
    <div class="msg-box-field card shadow col-md-12">
    <?php if($view ==1){ ?>
          <div class="card-header">
              <h6><?php echo ucwords($user->firstname.' '.$user->lastname) . '-'.$user->email ?></h6>
          </div>
    <?php } ?>
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
                    <input type="hidden" name='user_id' value="<?php echo $user_id ?>">
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

<script>
    $(document).ready(function(){
        load_convo()
        
        $('[name="message"]').keyup(function(e){
              if(isMobile == false){
              if(e.originalEvent.key == 'Enter' && e.originalEvent.shiftKey == false)
              $('#msg-frm').submit();
              }
            })
 $('#msg-frm').submit(function(e){
              e.preventDefault();
              var frmData= $(this).serialize()
              if($('[name="message"]').val() == '')
              return false;
              var txt = $('[name="message"]').val()
              txt = txt.replace(/\n/gi,'<br>')
              var mbox_no = $('#convo-field').length;
              mbox_no++;
              var mbox = $('.msg-box-clone .msg-box.msg-right').clone()
              mbox.attr('data-no',mbox_no)
              mbox.find('.msg').html(txt)
              mbox.find('.msg-datetime').html('sending....')
              $('#convo-field').append(mbox)
              $('[name="message"]').val('')
              $('.msg-box-field .card-body').animate({
                            scrollTop: $('.msg-box-field .card-body')[0].scrollHeight - 10
                        }, 'fast');
              $.ajax({
                url:'<?php echo base_url('admin/message_send') ?>',
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
                        websocket.send(JSON.stringify({type:'message_renew_user',id:resp.data.id,user_id:'<?php echo $user_id ?>'}))
                    }
                  }
                }
              })
            })
    });
    window.read_msg = function(){

      $.ajax({
          url:'<?php echo base_url('admin/read_msg') ?>',
          method:'POST',
          data:{user_id:'<?php echo $user_id ?>'},
          error:err=>{
            console.log(err)
            Dtoast('An error occured','error');
            end_loader()
          },
          success:resp=>{
            if(resp == 1){
            
              if($.isFunction(window.load_msgs))
                load_msgs()

              if($('.msg-convo-link[data-id="<?php echo $user_id ?>"]').length > 0){
              $('.msg-convo-link[data-id="<?php echo $user_id ?>"]').find('.msg_count_unread').html(0)
              $('.msg-convo-link[data-id="<?php echo $user_id ?>"]').removeClass('active')
              }

            }
          }
        })

    }
    function load_convo($id='',$uid='<?php echo $user_id ?>'){
      // console.log('Test')
            if($uid != '<?php echo $user_id ?>')
            return false;
            if($id == ''){
            $('#convo-field').html('<center><i>Loading messages...</i></center>')
            }
            
            
            $.ajax({
              url:'<?php echo base_url('admin/load_convo_messages') ?>',
              method:'POST',
              data:{id:$id,uid:$uid},
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
                    
                  }else{
                    read_msg()
                    Object.keys(resp).map(k=>{
                      var row = resp[k]
                      if(row.type ==0)
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
      
</script>