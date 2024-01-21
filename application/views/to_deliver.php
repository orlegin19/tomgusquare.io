<div class="col-md-12">
<div class="row">
    <hr>
</div>
<div class="row">
    <div  class="col-sm-12">
    <table class="table table-bordered table-striped" width="100%"id="delivery_list" >
        <colgroup>
            <col width="10%">
            <col width="25%">
            <col width="25%">
            <col width="25%">
            <col width="15%">
        </colgroup>
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Reference No.</th>
                <th class="text-center">Driver Name</th>
                <th class="text-center">Status</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
    </div>
</div>
</div>
<div id="list_clone" style="display:none">
<table>
        <tr class="list-row">
                <td class="text-center no"></td>
                <td class="ref_id"></td>
                <td class="dname"></td>
                <td class="status text-center"></td>
                <td class="text-center">
                    <div class="dropdown">
                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="">Action  </button>
                        
                        <div class="dropdown-menu">
                            <a class="dropdown-item remove_order" href="javascript:void(0)" data-id="8">Remove</a>
                        <div class="dropdown-divider"></div>
                            <a class="dropdown-item change_driver" href="javascript:void(0)">Change Driver</a>
                        </div>
                    </div>
                </td>
            </tr>
            </table>
</div>
<div class="modal"  role="dialog" id="change_d_modal">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" onclick="$('#move_modal').modal('hide')">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="change-d-frm">
      <div class="modal-body">
      <div class="form-group row">
        <div class="col-md-4">
            <label for="driver_id" class="control-label">Driver</label>
        </div>
        <div class="col-md-8" >
        <input type="hidden" name="id" >
            <select id="driver_id" class="form-control" name="user_id" required>
            <option selected disabled required  value="0">Choose Driver</option>
                <?php
                    $dqry = $this->db->select('*,concat(firstname," ",lastname) as uname')->order_by('uname','asc')->get_where('users',array('type'=>4,'status'=>1));
                    foreach($dqry->result_array() as $row):
                ?>
                    <option value="<?php echo $row['id'] ?>"><?php  echo ucwords($row['uname']) ?></option>
                    <?php endforeach; ?>
            </select>
        </div>
      </div>
    </div>
       
      <div class="modal-footer">
        <button type="submit"  class="btn btn-primary" >Save</button>
      </div>
    </div>
    </form>

  </div>
</div>
<style>
#change_d_modal .modal-dialog.modal-dialog-centered {
    width: 55% !important;
    max-width: inherit;
}
</style>
<script>
$(document).ready(function(){
    load_list();

    $('#change-d-frm').submit(function(e){
        e.preventDefault();
        var user_id = $('#driver_id').val();
        start_loader()
        if($('.err').length > 0){
            $('.err').remove()
        }
        if(user_id <= 0){
            $('#change_d_modal .modal-body').prepend('<div class="err row"><div class="alert alert-danger">Select Driver First.</div></div>')
            end_loader()
            return false;
        }
        $.ajax({
            url:'<?php echo base_url('admin/update_d') ?>',
            method:'POST',
            data:$(this).serialize(),
            error:err=>{
                console.log(err)
                Dtoast('An error occured','error')
                end_loader();
            },
            success:resp=>{
                if(resp == 1){
                    Dtoast('Driver successfully changed.','success');
                    setTimeout(()=>{ location.reload(); },750)
                }
            }
        })
    })
})

window.load_list = function(){
            $('#delivery_list').dataTable().fnDestroy();
    $('#delivery_list tbody').html('<tr><td class="text-center" colspan="5">Loading Data...</td></tr>')

    $.ajax({
        url:'<?php echo base_url('admin/load_del_list') ?>',
        error:err=>{
            console.log(err)
            Dtoast('Ann error occured','error');
             $('#delivery_list tbody').html('')
        },
        success:resp=>{
            if(typeof resp != undefined){
                resp = JSON.parse(resp)
                if(Object.keys(resp).length <= 0){
                $('#delivery_list tbody').html('<tr><td class="text-center" colspan="5">No data to be display.</td></tr>')
                }else{
             $('#delivery_list tbody').html('')

                    var i = 0;
                    Object.keys(resp).map(k=>{
                        i++;
                        var row = resp[k]
                        var tr = $('#list_clone .list-row').clone();
                        tr.find('.no').html(i)
                        tr.find('.ref_id').html(row.ref_id)
                        tr.find('.dname').html(row.dname)
                        if(row.status == 1){
                        tr.find('.status').html('<span class="badge badge-success">Delivered</span>');
                        }else{
                        tr.find('.status').html('<span class="badge badge-primary">Pending</span>');
                        }
                        tr.find('.remove_order, .change_driver').attr({'data-id':row.id,'data-ref':row.ref_id})
                        // console.log(tr[0])
                        $('#delivery_list tbody').append(tr)
                        action_func()
                    })
                    $('#delivery_list').dataTable()
                }
            }
        }
    })
}
function action_func(){
    $('.remove_order').each(function(){
        $(this).click(function(){
            delete_data('Are you sure you want to remove <b></b> from delivery list?','delete_del',[$(this).attr('data-id')])
        })
    })
    
    $('.change_driver').each(function(){
        $(this).click(function(){
            $('[name="id"]').val($(this).attr('data-id'))
            $('#change_d_modal .modal-title').html('Change Driver for:' +$(this).attr('data-ref'))
            $('#change_d_modal').modal('show')
        })
    })
}
function delete_del($id){
    $.ajax({
        url:'<?php echo base_url('admin/delete_del') ?>',
        method:'POST',
        data:{id:$id},
        error:err=>{
            console.log(err)
            Dtoast('Anerror occured','error');
        },
        success:resp=>{
            if(resp == 1){
                Dtoast('Data successfully deleted.','success')
                setTimeout(()=>{ location.reload(); },750)
            }
        }
    })
}
</script>