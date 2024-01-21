<div class="col-md-12">
<div class="row">
    <table width="100%" id="convo-all-field">

        <tr>
            <td width="30%">
                <div class="card shadows" id="convo-list-field">
                    <div class="card-header"></div>
                    <div class="card-body">
                        
                    </div>
                </div>
            </td>
            <td width="70%" id="convo-msg-box-field"></td>
        </tr>

    </table>
</div>
</div>
<div id="convo-list-clone" style="display:none">
        <a class="d-flex align-items-center msg-convo-link" href="javascript:void(0)">
            <div class="dropdown-list-image mr-3">
            <span class="btn btn-circle btn-primary"><i class="fas fa-user fa-fw"></i></span>
            </div>
            <div class="font-weight-bold">
            <span class="badge badge-danger badge-counter pull-right msg_count_unread" style="display:none">0</span>
            <div class="text-truncate user">Carlo Montero</div>
            <div class="text-truncate text-gray-600 msg">hey</div>
            <div class="small text-gray-500 datetime">May 08,2020 02:27 PM</div>
            </div>
        </a>
</div>
<style>
    #convo-all-field .card{
        height:100%
    }
    #convo-all-field .card-body{
        height:100%;
        overflow:auto
    }
    #convo-all-field a{
        color:unset;
        text-decoration:unset;
        border-bottom:1px solid #1717171f;
        background:#1717171f;
        padding: 5px 8px;
    }
    #convo-all-field .user{
        color:#585858;
       
    }
    a.d-flex.align-items-center.msg-convo-link.active {
    background: lightblue !important;
}
.msg-box-field{
    height:100% !important;
    width:100% !important;
}

</style>

<script>
    $('#convo-all-field td').height($(window).height()-$('#main_nav').height()-$('.page-title-field').height()-50)
    $(window).on('resize',function(e){
        $('#convo-all-field td').height($(window).height()-$('#main_nav').height()-$('.page-title-field').height()-50)
    })
    $(document).ready(function(){
        load_convo_list()
        resize_cards();
        var countInterval=function(){
            $('.msg_count_unread').each(function(){
                if($(this).html() > 0){
                    $(this).show()
                }else{
                    $(this).hide()
                }
            })
        }
        setInterval(countInterval,500)
    })

    function load_convo_list($id=''){
        if($id=='')
            $('#convo-list-field .card-body').html('<center><i>Loading convo list...</i></center>');
        $.ajax({
            url:'<?php echo base_url('admin/load_convo_list') ?>',
            method:'POST',
            data:{id:$id},
            error:err=>{
                console.log(err)
                $('#convo-list-field .card-body').html('<center><i>An error occured while loading convo list.</i></center>');
            },
            success:resp=>{
            // console.log('test')
                if(typeof resp != 'undefined'){
                    resp = JSON.parse(resp)
                    // console.log(resp)
                    if(Object.keys(resp).length <= 0){
                        if($id == ''){
                             $('#convo-list-field .card-body').html('<center><i>No past conversation.</i></center>');
                        }
                    }else{
                        if($id == ''){
                             $('#convo-list-field .card-body').html('');
                            }
                        Object.keys(resp).map(k=>{
                            
                            var li = $('#convo-list-clone .msg-convo-link').clone()
                            var row =resp[k]
                            li.attr('data-id',row.user_id)
                            if(row.unread_count > 0)
                            li.addClass('active')
                            li.find('.user').html(row.uname)
                            if(row.type == 0)
                            li.find('.msg').html(row.message)
                            else
                            li.find('.msg').html('You:'+row.message)

                            li.find('.datetime').html(row.date_created)
                            li.find('.msg_count_unread').html(row.unread_count)
                            if($('#convo-list-field  .msg-convo-link[data-id="'+row.user_id+'"]').length > 0)
                            $('#convo-list-field  .msg-convo-link[data-id="'+row.user_id+'"]').remove()
                            $('#convo-list-field .card-body').prepend(li)


                        })
                    }
                }
            },
            complete:()=>{
                convo_link()
            }
        })
    }
    window.convo_link = function(){
       $('.msg-convo-link').each(function(){
       $(this).click(function(){
        display_convo($(this).attr('data-id'))
       })
       })
    }
    function display_convo($user_id){
        $('#convo-msg-box-field').html('<center><i>Loading convo....</i</center>');
            $.ajax({
                url:'<?php echo base_url('admin/view_convo/') ?>'+$user_id+'/'+1,
                error:err=>{
                    console.log(err)
                    $('#convo-msg-box-field').html('<center><i>An error occured</i</center>');
                },
                success:resp=>{
                    if(resp){
                        $('#convo-msg-box-field').html(resp);
                    }
                },complete:()=>{
                    resize_cards();
                }
            })
    }

    
    function resize_cards(){
        $('#convo-list-field .card-body').height( $('#convo-list-field').height() - $('#convo-list-field .card-header').height() -100)
        if($('#convo-msg-box-field .card').length > 0){
            $('#convo-msg-box-field .card-body').height( $('#convo-msg-box-field .card').height() - $('#convo-msg-box-field .card-header').height() -  $('#convo-msg-box-field .card-footer').height() -145)
        }
    }
</script>