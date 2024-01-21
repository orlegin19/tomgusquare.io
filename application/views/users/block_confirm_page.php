<?php
$qry = $this->db->get_where('users',array('id'=>$id))->row();
?>
<div class="col-md-12">
    <div class="row">
        <p>Are you sure to <?php echo $action.' <b>'.$qry->email.'</b>' ?>?</p>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-12">
        <span class="pull-right">
            <button class="btn btn-primary" id="btn_block" type="button"><?php echo (ucwords($action)) ?></button>
            <button class="btn btn-pill " id="btn_cancel" type="button" data-dismiss="modal" aria-label="Close">Cancel</button>
            </span>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $('#btn_block').click(function(){
        start_loader()
        var status = '2'
        if('<?php echo $action ?>' == 'unblock')
        status =  1

        $.ajax({
            url:'<?php echo base_url('admin/change_user_status') ?>',
            method:'POST',
            data:{status:status,id:'<?php echo $id ?>'},
            error:err=>{
                consoloe.log(err)
                Dtoast('An error occured. Please try agin','error')
                end_loader()
            },
            success:resp=>{
                if(resp == 1){
                    Dtoast('User successfully blocked.','success')
                    setTimeout(()=>{
                        load_users();
                        $('.modal').modal('hide')
                        end_loader();
                    },750)
                }
            }
        })
    })
})
</script>

