<div class="col-lg-12 mt-5">
    <div class="row">
        <!--Grid column-->
        <div class="col-md-8 mb-4">
        
          <!-- Heading -->
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Your cart</span>
            <span class="badge badge-secondary badge-pill" id="list_count">0</span>
          </h4>

          <!-- Cart -->
          <ul class="list-group mb-3 z-depth-1" id="list-holder">
            
            <li class="list-group-item d-flex justify-content-between" id="total-holder" >
              <span>Total (Php)</span>
              <strong id="gTotal">&#8369; 0.00</strong>
            </li>
          </ul>
          <!-- Cart -->

          <!-- Promo code -->
          <!-- <form class="card p-2">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Promo code" aria-label="Recipient's username" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-secondary btn-md waves-effect m-0" type="button">Redeem</button>
              </div>
            </div>
          </form> -->
          <!-- Promo code -->

        </div>
        <div class="col-md-4 mb-2">
            <form action="" id="place_order">
            <div class="card">
                <div class="card-body">
                    <h5>Details</h5>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="delivery" name="type" value="3" checked>
                            <label class="custom-control-label" for="delivery">Delivery (CoD)</label>
                            </div>

                            
                        </div>
                        <div class="col-sm-6">
                            <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="pick_up" value="4" name="type">
                            <label class="custom-control-label" for="pick_up">Pick-up</label>
                            </div>
                        </div>`
                    </div>
                    <div class="row del_only">
                        <div class="col-sm-12 md-form mb-2 blue-textarea active-blue-textarea">
                            <i class="fa fa-map-marker prefix"></i>
                            <textarea id="location" class="md-textarea form-control" rows="1" name="location" style="resize:none;overflow:auto" required></textarea>
                            <label for="location" class="control-label">Location</label>
                        </div>
                    </div>
                    <div class="row del_only">
                        <div class="col-sm-12 md-form mb-2 blue-textarea active-blue-textarea">
                            <i class="fa fa-building prefix"></i>
                            <textarea id="landmarks" class="md-textarea form-control" rows="1" name="landmarks" style="resize:none;overflow:auto" required></textarea>
                            <label for="landmarks" class="control-label">Landmarks</label>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-sm-12 md-form mb-2 blue-textarea active-blue-textarea">
                            <textarea id="remarks" class="md-textarea form-control" rows="1" name="remarks" style="resize:none;overflow:auto" placeholder="(Optional)"></textarea>
                            <label for="remarks" class="control-label">Remarks</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <button class="btn btn-primary btn-sm pull-right">Place Order</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<div id="cart_list_clone" style="display:none">
<li class="list-group-item d-flex justify-content-between lh-condensed col-md-12 cart-list">
    <div class="row" style="width:100% !important">
            
              <div class="col-sm-7">
              <span class="pull-left" style="margin-right:5px">
                    <i class="fa fa-times rem_list" style="color:red"></i>
                  </span>
                  <span>
                      <img alt="" class="p-img pull-left" width="75px" height="75px">
                  </span>
                <h6 class="my-0 pname">Product name</h6>
                <input type="hidden" name="pid[]">
                <input type="hidden" name="price[]">
                <input type="hidden" name="tAmount[]">
                <small class="text-muted price">
                    
                </small>
              </div>
              <div class='col-sm-3'>
                    <div class="input-group input-group-sm mb-2 pull-right"  style="width:auto">
                    <div class="input-group-prepend">
                        <button class="btn btn-primary min-qty" type="button"><i class="fa fa-minus"></i></button>
                    </div>
                    <input type="number" class="text-center" required name="qty[]" value='1' readonly>
                    <div class="input-group-append">
                        <button class="btn btn-primary qty-plus" type="button"><i class="fa fa-plus"></i></button>
                    </div>
                    </div>
              </div>
              <div class="text-muted total_amount col-sm-2 text-right"></div>
        </div>
</li>
</div>

<style>
    input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
.min-qty,.qty-plus{
    margin:0;
}
[name="qty[]"]{
    width:40px
}
.rem_list{
    cursor:pointer
}
.loader-txt p {
     font-size: 13px;
     color: #666;
     text-align: center;
 }
 .loader-txt p small{
       font-size: 11.5px;
       color: #999;
 }

 
</style>
<script>

$(document).ready(function(){
    load_clist();
    

    $('[name="type"]').off().on('change',()=>{
        $('[name="location"],[name="landmarks"]').removeAttr('required')
        if($('[name="type"]:checked').val() == 3){
            $('.del_only').show();
            $('[name="location"],[name="landmarks"]').attr('required',true)
        }else{
            $('.del_only').hide();
        }
    })
    $('#place_order').on('submit',function(e){
        e.preventDefault()
        var frmData = $(this).serialize();
        // console.log(frmData)
        if($('#list-holder .cart-list').length <= 0){
            alert("No Items");
            return false;
        }
        start_loader()

        $.ajax({
            url:'<?php echo base_url('order/place_order') ?>',
            method:'POST',
            data:frmData,
            error:err=>{
                console.log(err)
                end_loader()

            },
            success:resp=>{
                if(typeof resp != undefined){
                    var data = JSON.parse(resp)
                if(data.status == 'success'){
                    
                    Dtoast('Order successfully placed.','success')
                    try {
                           var ws_status='status'; 
                        if(data.alert_id > 0){
                           ws_status= websocket.send(JSON.stringify({type:'alert_update',id:data.alert_id,oid:data.order_id}));
                        }
                    setTimeout(()=>{ location.replace('<?php echo base_url('order/my_order') ?>') },1500)

                    } catch (error) {
                        console.log(error)
                    };
                    
                }
                }
            },
            complete:()=>{
            }
        })

    })
})
window.load_clist = function (){
    $.ajax({
        url:'<?php echo base_url('order/load_cart_list') ?>',
        method:'POST',
        data:{},
        error:err => {
            console.log(err)
        },
        success:resp=>{
            if(typeof resp != undefined){
                resp = JSON.parse(resp)
                if(Object.keys(resp).length > 0){
                    $("#list_count").html(Object.keys(resp).length)
                    var total = 0;
                    Object.keys(resp).map(k=>{
                        var li = $('#cart_list_clone .list-group-item').clone()
                        li.attr('data-id',resp[k].id)
                        li.find('.pname').html(resp[k].pname)
                        li.find('.p-img').attr('src','<?php echo base_url() ?>'+resp[k].img_path)
                        li.find('.price').html('<span>Price: </span>&#8369; '+resp[k].price)
                        li.find('[name="price[]"]').val(resp[k].price)
                        li.find('[name="pid[]"]').val(resp[k].product_id)
                        li.find('[name="qty[]"]').val(resp[k].qty)
                        var tAmount =  parseInt(resp[k].qty) * parseFloat(resp[k].price);
                        li.find('.total_amount').html('&#8369; '+tAmount)
                        li.find('[name="tAmount[]"]').val(tAmount)
                        total += parseFloat(tAmount);
                        $('#total-holder').before(li)
                    })
                    if(total > 0)
                    $('#gTotal').html('&#8369; '+(parseFloat(total).toLocaleString('en-US',{ style :'decimal','maximumFractionDigits':2 })))
                }
            }
        },
        complete:()=>{
            li_func()
        }
    })
}

window.li_func = function (){
    $('.cart-list').each(function(){
        $(this).find('.rem_list').click(function(){
            $.ajax({
                url:'<?php echo base_url('order/remove_from_cart') ?>',
                method:'POST',
                data:{id:$(this).closest('li').attr('data-id')},
                err:err=>{
                    console.log(err)
                },
                success:resp=>{
                    if(resp == 1 ){
                        var total = 0 ;
                        $(this).closest('li').remove();
                        $('#list-holder [name="tAmount[]"]').each(function(){
                        // console.log($(this).val())
                            total += parseFloat($(this).val());
                        })
                        if(total > 0)
                                $('#gTotal').html('&#8369; '+(parseFloat(total).toLocaleString('en-US',{ style :'decimal','maximumFractionDigits':2 })))
                        var cur_count = $('#list_count').html();
                        cur_count--;
                        $('#list_count').html(cur_count)
                        $('#cart_count').html(cur_count)
                    }
                }
            })
           

        })

        $(this).find('.qty-plus').off().on('click',function(){
            start_loader()

            var cur_val = $(this).closest('li').find('[name="qty[]"]').val()
            cur_val++;
            var li = $(this).closest('li')
            $.ajax({
                url:'<?php echo base_url('order/cart_change_qty') ?>',
                method:'POST',
                data:{id:$(this).closest('li').attr('data-id'),qty:cur_val},
                error:err=>{
                    console.log(err)
                },
                success:resp=>{
                    if(resp == 1){
                        li.find('[name="qty[]"]').val(cur_val)
                        var tAmount  = parseInt(cur_val) * parseFloat(li.find('[name="price[]"]').val());
                        li.find('.total_amount').html('&#8369; '+tAmount)
                        li.find('[name="tAmount[]"]').val(tAmount)
                        var total = 0
                        $('#list-holder [name="tAmount[]"]').each(function(){
                        // console.log($(this).val())
                            total += parseFloat($(this).val());
                        })
                        if(total > 0)
                                $('#gTotal').html('&#8369; '+(parseFloat(total).toLocaleString('en-US',{ style :'decimal','maximumFractionDigits':2 })))
                    }
                },
                complete:()=>{
                    end_loader()
                }
            })
        })

        $(this).find('.min-qty').off().on('click',function(){
            start_loader()

            var cur_val = $(this).closest('li').find('[name="qty[]"]').val()
            cur_val--;
            if(cur_val < 1)
            cur_val = 1;
            var li = $(this).closest('li')
            $.ajax({
                url:'<?php echo base_url('order/cart_change_qty') ?>',
                method:'POST',
                data:{id:$(this).closest('li').attr('data-id'),qty:cur_val},
                error:err=>{
                    console.log(err)
                },
                success:resp=>{
                    if(resp == 1){
                        li.find('[name="qty[]"]').val(cur_val)
                        var tAmount  = parseInt(cur_val) * parseFloat(li.find('[name="price[]"]').val());
                        li.find('.total_amount').html('&#8369; '+tAmount)
                        li.find('[name="tAmount[]"]').val(tAmount)
                        var total = 0
                        $('#list-holder [name="tAmount[]"]').each(function(){
                        // console.log($(this).val())
                            total += parseFloat($(this).val());
                        })
                        if(total > 0)
                                $('#gTotal').html('&#8369; '+(parseFloat(total).toLocaleString('en-US',{ style :'decimal','maximumFractionDigits':2 })))
                    }
                },
                complete:()=>{
                    end_loader()
                }
            })
        })
    })
}
</script>