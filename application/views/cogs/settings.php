<div class="container-fluid">
	<div class="card card-outline card-primary">
		<div class="card-body">
			<form action="" id="settings-frm">
				<div class="col-lg-12">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="system_name" class="control-label">System Name</label>
								<input type="text" name="system_name" id="system_name" class="form-control form-control-sm" required value="<?php echo isset($_SESSION['system']['name']) ? $_SESSION['system']['name'] : '' ?>">
							</div>
							<div class="form-group">
								<label for="system_title" class="control-label">System Title</label>
								<input type="text" name="system_title" id="system_title" class="form-control form-control-sm" required value="<?php echo isset($_SESSION['system']['title']) ? $_SESSION['system']['title'] : '' ?>">
							</div>
							<div class="form-group">
								<label for="system_address" class="control-label">Business Address</label>
								<textarea cols="30" rows="4" name="system_address" id="system_address" class="form-control form-control-sm" required><?php echo isset($_SESSION['system']['address']) ? $_SESSION['system']['address'] : '' ?></textarea>
							</div>
							<div class="form-group">
								<label for="system_fb_url" class="control-label">Business Facebook Page</label>
								<input type="text" name="system_fb_url" id="system_fb_url" class="form-control form-control-sm" required value="<?php echo isset($_SESSION['system']['fb_url']) ? $_SESSION['system']['fb_url'] : '' ?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="system_email" class="control-label">Business Email</label>
								<input type="text" name="system_email" id="system_email" class="form-control form-control-sm" required value="<?php echo isset($_SESSION['system']['email']) ? $_SESSION['system']['email'] : '' ?>">
							</div>
							<div class="form-group">
								<label for="img_path">Business Logo</label>
								<div class="input-group">
				                    <div class="custom-file">
				                        <input type="file" class="custom-file-input" id="img_path" name="img_path" aria-describedby="img_path" onchange="readURL(this)">
				                        <label class="custom-file-label" for="img_path" id="img_path_label">Choose file</label>
				                    </div>
				                </div>
							</div>
							<div class="form-group">
								<div class="d-flex w-100 justify-content-center">
									<img src="<?php echo isset($_SESSION['system']['logo']) ? base_url().$_SESSION['system']['logo'] : '' ?>" alt="Logo Viewer" id='img_viewer' class="img-fluid img-thumbnail" style="object-fit: cover;">
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	function readURL(input) {
	  if (input.files && input.files[0]) {
	    var reader = new FileReader();
	    
	    reader.onload = function(e) {
	      $('#img_viewer').attr('src', e.target.result);
	      $('#img_path_label').text(input.files[0].name);
	    }
	    reader.readAsDataURL(input.files[0]); // convert to base64 string
	  }
	}
$(document).ready(function(){
$('#settings-frm').submit(function(e){
    e.preventDefault()
    start_loader()
    if($('.err').length > 0)
    $('.err').remove();
    var formData = new FormData($(this)[0]);
    $.ajax({
        url:'<?php echo base_url().'cogs/save_settings' ?>',
        type:'POST',
        enctype: 'multipart/form-data',
        data:formData,
        contentType: false, 
        processData: false,
        error:(err)=>{
            console.log(err)
                Dtoast('An error occured');
                end_loader()
            
        },
        success:function(resp){
            if(resp == 1){
                    Dtoast('Data successfully saved');
                   end_loader()
            }else{
        	  	Dtoast('An error occured');
                end_loader()
            }
        }

    })
})
})
</script>