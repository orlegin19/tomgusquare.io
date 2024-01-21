<?php
    $product = $this->db->query("SELECT p.*,pt.name as cat_name  from product p inner join product_type pt on p.pt_id = pt.id where p.id = ".$id." ");
    $meta= array();
    foreach($product->row() as $key => $val){
        $meta[$key]= $val;
    }
    // echo "SEESSIOn ID:".$this->session->userdata('user_id');
    $chk = $this->db->get_where('cart_list',array('user_id'=>$_SESSION['user_id'],'product_id'=>$id))->num_rows();
?>
<form action="" id="prod_add">
<div class="col-lg-12">
     <?php if($chk > 0): ?>
    <div class="row">
    <div class="col-md-12">
            <div class="alert alert-warning">This product is already on your cart list.</div>
    </div>
    </div>
    <hr>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-6">
        <input type="hidden" name='pid' value="<?php echo $id ?>">
        <input type="hidden" name='user_id' value="<?php echo $this->session->userdata('user_id') ?>">
        <input type="hidden" name='price' value="<?php echo $meta['price'] ?>">
            <img src="<?php echo base_url().$meta['img_path'] ?>" alt="" id="prod_img">
        </div>
        <div class="col-md-6" id="prod_name">
            <h5><b><?php echo $meta['name'] ?></b></h5>
        </div>
    </div>
    <hr>
    <div class="row">
    <div class="col-md-4">
        <label for="">Price</label>
    </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php echo '&#8369; '. number_format($meta['price'],2) ?> 
        </div>
    </div>
    <hr>
    <div class="row">
    <div class="col-md-4">
        <label for="">Description</label>
    </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php echo $meta['description'] ?> 
        </div>
    </div>
    <hr>
    <div class="row">
    <div class="col-md-4">
        <label for="">Quantity:</label>
    </div>
    <div class="col-md-8">
            <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
                <button class="btn btn-primary" id="min-qty" type="button"><i class="fa fa-minus"></i></button>
            </div>
            <input type="number" class="text-center" required name="qty" id="qty" value='1' readonly>
            <div class="input-group-append">
                <button class="btn btn-primary" id="qty-plus" type="button"><i class="fa fa-plus"></i></button>
            </div>
            </div>
    </div>
    </div>
   
</div>
</form>
<style>
#prod_img {
    max-width: 100%;
}
#prod_name {
    align-items: center;
    display: flex;
}

input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
#min-qty,#qty-plus{
    margin:0;
}
#qty{
    width:40px
}
#prod_add{
    height:100%
}
</style>

<script>
$(document).ready(function(){

    if('<?php echo $chk ?>' > 0)
    $('#cart_btn').attr('disabled',true);
    else
    $('#cart_btn').removeAttr('disabled');

    $('#min-qty').off().on('click',function(e){
        e.preventDefault()
        var qty = $('#qty').val();
            qty = parseInt(qty) -1;
        if(qty <= 0 )
            qty = 1;
    $('#qty').val(qty)
    })
    $('#qty-plus').off().on('click',function(e){
        e.preventDefault()
        var qty = $('#qty').val();
          qty++;
     $('#qty').val(qty)
    })

    $('#prod_add').off().submit(function(e){
        e.preventDefault();
        var frm_data = $(this).serialize();
        // console.log(frm_data)
        $.ajax({
            url:'<?php echo base_url('order/save_to_cart') ?>', 
            method:'POST',
            data:frm_data,
            error:err=>{
                console.log(err);
            },
            success:resp=>{
                if(typeof resp != undefined){
                    resp = JSON.parse(resp)
                    if(resp.status == 1 ){
                        $('#order_field').html('');
                        $('.modal').modal('hide');
                        $('#cart_btn').removeAttr('disabled').html('<i class=\'fa fa-plus\'></i> Add to Cart')
                        var cart = {type:'new_cart',user_id:'<?php echo $this->session->userdata('user_id') ?>',data:resp.data};
                        websocket.send(JSON.stringify(cart));


                    }
                }
            }
        })
    })

    $('#cart_btn').off().on('click',function(){
        $(this).attr('disabled',true).html('Adding product to cart...')
        $('#prod_add').submit();
    })
})
</script>