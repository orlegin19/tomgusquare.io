<?php
if(!empty($id)){
    $qry = $this->db->get_where('product_type',array('id'=>$id));
    if($qry->num_rows() > 0){
        foreach($qry->row() as $key => $val){
            $$key = $val;
        }
    }
}
?>

<form action="" id="pg_frm" class="form-horizontal">
    <div class="col-md-12">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <div class="row">
            <div class="col-sm-4">
                <label for="name" class="control-label">Category name:</label>
            </div>
            <div class="col-sm-8">
                <input type="text" id="name" class="form-control" name="name"
                    value="<?php echo isset($name) ? $name : '' ?>" required>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <!-- <label for="name" class="control-label">Group name:</label> -->
            </div>
            <div class="col-sm-8">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="status" name="status"
                        <?php echo !isset($status) || (isset($status) && $status == 1) ? 'checked': '' ?>>
                    <label class="custom-control-label" for="status">Available</label>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-sm btn-primary pull-right" type="submit">Save</button>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript" src="<?php echo base_url() ?>assets/main2.js"></script>
<script>
$(document).ready(function() {
    $('#pg_frm').submit(function(e) {
        e.preventDefault()
        if ($('.err').length > 0)
            $('.err').remove()
        $('#pg_frm button[type="submit"]').attr('disabled', true).html('Saving data...');
        $.ajax({
            url: '<?php echo base_url().'products/save_pg' ?>',
            method: 'POST',
            data: $(this).serialize(),
            error: (err) => {
                console.log(err)
                Dtoast("An error occured.");
            },
            success: (resp) => {
                if (resp) {
                    var data = JSON.parse(resp)
                    if (data.status == 'success') {
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Data successfully updated",
                            showConfirmButton: false,
                            timer: 2500
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 2500)
                    } else if (data.status == 'exist') {
                        $('#name').parent().append(
                            '<p class="err alert alert-danger" style="margin-top:3px">Category name already exist.</p>'
                            );
                    } else {
                        Dtoast("An error occured.");
                    }
                    $('#pg_frm button[type="submit"]').removeAttr('disabled').html('Save');

                }
            }
        })
    })
})
</script>