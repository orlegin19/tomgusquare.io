<?php 

if(!empty($id)){
    $p_qry = $this->db->get_where('product',array('id'=>$id));
    if($p_qry->num_rows() > 0){
        foreach($p_qry->row() as $key => $val)
        $$key = $val;
    }
}

?>
<form action="" class="form-horizontal" id="product_frm">
    <div class="col-md-12">
        <input type="hidden" value="<?php echo $id ?>" name='id'>
        <div class="row form-group">
            <div class="col-sm-4">
                <label for="name" class="control-label">Product name:</label>
            </div>
            <div class="col-sm-8">
                <input type="text" id="name" class="form-control" name="name" value="<?php echo isset($name) ? $name : '' ?>" required>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-sm-4">
                <label for="description" class="control-label">Description:</label>
            </div>
            <div class="col-sm-8">
                <textarea colspan="10" rowspan="5" type="text" id="description" class="form-control" name="description" required><?php echo isset($description) ? $description : '' ?></textarea>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-sm-4">
                <label for="type" class="control-label">Menu Category:</label>
            </div>
            <div class="col-sm-8">
                <?php
                    $pg = $this->db->get_where('product_type');
                ?>
                    <select name="type" id="type" class="form-control" required>
                    <?php 
                        if($pg->num_rows() <= 0){
                            echo '<option disabled selected>No available product group.</option>';
                        }else{
                            echo '<option disabled selected>Please select here.</option>';
                            foreach($pg->result_array() as $row){
                                echo '<option value="'.$row['id'].'" '.(isset($pt_id) && $pt_id == $row['id'] ? 'selected': '').'>'.$row['name'].'</option>';
                            }
                        }
                    ?>
                    </select>

            </div>
        </div>

        <div class="row form-group">
            <div class="col-sm-4">
                <label for="price" class="control-label">Price:</label>
            </div>
            <div class="col-sm-8">
            <input type="number" step='any' id="price" class="form-control" name="price" value="<?php echo isset($price) ? $price : '' ?>" required>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-sm-4">
                <!-- <label for="name" class="control-label">Group name:</label> -->
            </div>
            <div class="col-sm-8">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="status" name="status" <?php echo !isset($status) || (isset($status) && $status == 1) ? 'checked': '' ?> >
                    <label class="custom-control-label" for="status">Available</label>
                </div>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-sm-4">
                <label for="img_path" class="control-label">Image:</label>
            </div>
            <div class="col-sm-8">
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="img_path" name="img_path" aria-describedby="img_path">
                        <label class="custom-file-label" for="img_path">Choose file</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-8">
                <img src="<?php echo isset($img_path) ? base_url().$img_path :'' ?>" alt="Image" id='img_viewer'>
            </div>
        </div>
        <hr>
        <div class="row form-group">
            <div class="col-md-12">
                <button class="btn btn-sm btn-primary pull-right">Update</button>
            </div>
        </div>
        


    </div>
</form>
<style>
#img_viewer{
    max-height: 150px;
}
</style>
<script type="text/javascript" src="<?php echo base_url() ?>assets/main2.js"></script>
<script>
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#img_viewer').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$("#img_path").change(function() {
  readURL(this);
});
document.querySelector('.custom-file-input').addEventListener('change',function(e){
  var fileName = document.getElementById("img_path").files[0].name;
  var nextSibling = e.target.nextElementSibling
  nextSibling.innerText = fileName
})
$(document).ready(function(){
$('#product_frm').submit(function(e){
    e.preventDefault()
    $('#product_frm button[type="submit]').attr('disabled',true).html('Saving data...')
    if($('.err').length > 0)
    $('.err').remove();
    var formData = new FormData($(this)[0]);
    $.ajax({
        url:'<?php echo base_url().'products/save_product/add' ?>',
        type:'POST',
        enctype: 'multipart/form-data',
        data:formData,
        contentType: false, 
        processData: false,
        error:(err)=>{
            console.log(err)
                Dtoast('An error occured');
                $('#product_frm button[type="submit]').removeAttr('disabled').html('Save')
            
        },
        success:function(resp){
            if(resp){
                var data = JSON.parse(resp)
                if(data.status == 'success' ){
                    $('.modal').modal('hide');
                    Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Data successfully updated",
                    showConfirmButton: false,
                    timer: 2500
            });
                    start_loader();
                    setTimeout(()=>{
                        location.reload();
                    },2500)
                }else if(data.status == 'exist'){
                    $('#name').parent().append('<p class="alert alert-danger err" style="margin-top:3px">Product name already exist.</p>')
                }
                $('#product_frm button[type="submit]').removeAttr('disabled').html('Save')
            }
        }

    })
})
})
</script>