<div class="col-lg-12 mt-4 mb-2">
        
    <div class="row wow fadeIn">
    <div class="col-md-2"></div>
    <div class="col-md-8" >
        <ul class="list-group mb-2 mt-2 z-depth-1" id="list-holder">
        
        
        </ul>
    </div>
    </div>
         
</div>

<div id="order_list_clone" style="display:none">
<li class="list-group-item d-flex justify-content-between lh-condensed col-md-12 order-list">
        <table width="100%">
            <tr>
                <td width="80%">
                <div>
                        <h6 class="my-0 ref-field">Product name</h6>
                        <small class="text-muted">
                           <p class="mt-2">Items: <span class="items-count">3</span></p>
                           <p class="mt-1">Total Amount: <span class="total-amount">1500</span></p>
                        </small>
                    </div>
                </td>
                <td width="20%">
                <span class="text-muted total_amount col-sm-3 olist-right">
                    <span class="badge status"></span>
                    <span class='list-angle'><i class="fa fa-angle-right mb-4 mt-4 ml-2"></i></span>
                    </span>
                </td>
            </tr>
        </table>
                  
                    
        </li>
</div>
    

    <div id="od_li_clone" style="display:none">
        <li class="list-group-item d-flex justify-content-between lh-condensed col-md-12 od-list">
            <table width="100%">
            <tr>
                <td  width="20%" rowspan='2'>
                    <img class='p_img' width="75px" height="75px">
                </td>
                <td width="100%" colspan="2">
                    <div class="text-muted"><h4 class="pname">Product Name</h4></div>
                </td>
            </tr>
            <tr>
                
                <td width="40%">
                    <div class="text-muted">Price:</div>
                    <div class="text-muted"><small class="price">1500</small></div>
                    <div class="text-muted"><small class="qty badge badge-danger">x3</small></div>
                </td>
                <td width="40%">
                    <div class="text-muted">Total Amount:</div>
                    <div class="text-muted"><small class="t-Amount">4,500</small></div>
                </td>
            </tr>
            </table>
        </li>
    </div>
<style>
span.text-muted.total_amount.olist-right {
    display: flex;
    align-items: center;
}
.olist-right span {
    margin: auto;
}
.list-angle i {
    font-size: 35px;
}
.order-list {
    cursor:pointer
}
.order-list:hover{
    background:#d4fdff
}
#order_details .modal-body {
    height: 43vw;
    min-height: inherit;
    max-height: inherit;
    padding-bottom: 0;
    margin-bottom: 0;
    overflow: auto;
}
</style>
<div class="modal fade left" id="order_details" tabindex="-3" role="dialog" aria-labelledby="od_modal"
        aria-hidden="true">

      <div class="modal-dialog modal-full-height modal-left" role="document">


        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title w-100" id="od_modal">Order Details</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true"><i class="fa fa-arrow-left"></i></span>
            </button>
          </div>
          <div class="modal-body">
            <div id="content-field">
                <table width="100%">
                    <tr>
                        <td width="50%" style="vertical-align:top">
                            <div class="text-muted"><small>Reference :</small></div>
                             <h5><b class="ref_no">asdad asdasd</b></h5>

                            <div class="text-muted"><small>Status :</small></div>
                            <div class="status"></div>

                            <div class="text-muted"><small> Remarks :</small></div>
                            <div><b class="remarks"></b></div>

                        </td>
                        <td width="50%" style="vertical-align:top">
                        <div class="text-muted"><small>Order Type :</small></div>
                        <div><b class="otype"></b></div>
                        <div class="del_only">
                        <div class="text-muted"><small> Location :</small></div>
                        <div><b class="loc"></b></div>
                        <div class="text-muted"><small> Landmark :</small></div>
                        <div><b class="land"></b></div>
                        </div>
                        </td>
                    </tr>
                </table>
                


                <hr>
                <div class="col-md-12">
                    <ul class="list-group mb-2 mt-2 z-depth-1" id="od-field">
                        
                        <li class="list-group-item d-flex justify-content-between lh-condensed col-md-12 total">
                                <table width="100%">
                                    <tr>
                                        <td width="30%"><h5><b>Grand Total</b></h5></td>
                                        <td width="70%" class='text-right'><h4 class="text-muted gtotal">&#8369; 0.00</h4></td>
                                    </tr>
                                </table>
                        </li>
                    </ul>
                </div>
            </div>
            
          </div>
          <div class="modal-footer justify-content-center">
            </div>
          
        </div>
      </div>
    </div>
<script>
$(document).ready(function(){
    load_orders();

    
   
})

window.order_details = ()=>{
    $('#list-holder .order-list').each(function(){
        $(this).click(function(){
            // $('#order_details #content-field').html()
            // $('#order_details #content-field').html($(this).attr('data-id'))
            var id = $(this).attr('data-id')
            start_loader();
            $.ajax({
                url:'<?php echo base_url('order/order_details') ?>',
                method:'POST',
                data:{id:id},
                error:(err)=>{
                    console.log(err)
                    Dtoast('An error occured','error')
                },
                success:resp=>{
                    if(typeof resp != undefined){
                        resp = JSON.parse(resp)

                        $('#order_details #content-field .ref_no').html(resp.details.ref_id)
                        if(resp.details.status == 1 && resp.details.type == 3)
                        $('#order_details .status').html('<span class="badge badge-success">Delivered<span>')
                        if(resp.details.status == 1 && resp.details.type == 4)
                        $('#order_details .status').html('<span class="badge badge-success">Picked-up<span>')
                        if(resp.details.status == 0)
                        $('#order_details .status').html('<span class="badge badge-primary">Pending<span>')
                        resp.details.total_amount = resp.details.total_amount.replace(/,/g,'')
                        if(resp.details.total_amount > 0)

                        if(resp.details.type == 3){
                        $('#order_details .otype').html('For Delivery')
                        $('#order_details .del_only').show()
                        }
                        if(resp.details.type == 4){
                        $('#order_details .otype').html('For Pick-up')
                        $('#order_details .del_only').hide()
                        }


                        $('#order_details .loc').html(resp.details.location)
                        $('#order_details .land').html(resp.details.landmark)
                        resp.details.remarks = resp.details.remarks != '' ? resp.details.remarks : 'N/A'
                        $('#order_details .remarks').html(resp.details.remarks)



                        $('#order_details #content-field .gtotal').html('&#8369; '+(parseFloat(resp.details.total_amount).toLocaleString('en-US',{style:'decimal', minimumFractionDigits:2, maximumFractionDigits:2 })))
                        $('#order_details #content-field #od-field .od-list').remove()

                        if(Object.keys(resp.list).length > 0){
                            Object.keys(resp.list).map(k=>{
                        resp.list[k].total_amount = resp.list[k].total_amount.replace(/,/g,'')
                                var li = $('#od_li_clone .od-list').clone()
                                li.find('.p_img').attr('src','<?php echo base_url() ?>'+resp.list[k].img_path)
                                li.find('.pname').html(resp.list[k].pname)
                                li.find('.price').html('&#8369; '+parseFloat(resp.list[k].price).toLocaleString('en-US'))
                                li.find('.qty').html('x'+resp.list[k].qty)
                                li.find('.t-Amount').html('&#8369; '+ parseFloat(resp.list[k].total_amount).toLocaleString('en-US',{style:'decimal', minimumFractionDigits:2, maximumFractionDigits:2 }))
                                // console.log(li)
                                $('#order_details #content-field .total').before(li)
                            })

                        }


                    }
                },
                complete:()=>{
                    end_loader()
                }
            })
            $('#order_details').modal('show')
        })
    })
}

window.load_orders = ()=>{
    $.ajax({
        url:'<?php echo base_url('order/load_orders') ?>',
        method:'POST',
        data:{},
        error:err=>{
            console.log(err)
        },
        success:resp=>{
            if(typeof resp != undefined){
                resp = JSON.parse(resp)

                if(Object.keys(resp).length >0 ){
                    Object.keys(resp).map((k)=>{
                        var li = $('#order_list_clone .order-list').clone()
                            li.find('.ref-field').html(resp[k].ref_id)
                            li.find('.items-count').html(resp[k].item_count)
                            if(resp[k].status == 1){
                                if(resp[k].type == 3)
                                li.find('.status').addClass('badge-success').html('<i>Delivered</i>')
                                if(resp[k].type == 4)
                                li.find('.status').addClass('badge-success').html('<i>Picked-up</i>')
                            }else{
                            li.find('.status').addClass('badge-primary').html('<i>Pending</i>')
                            }
                            li.find('.total-amount').html('&#8369; '+parseFloat(resp[k].total_amount).toLocaleString('en-US',{ style :'decimal','maximumFractionDigits':2,minimumFractionDigits:2 }))
                            li.attr('data-id',resp[k].id)
                        $('#list-holder').append(li)
                    })
                }
            }
        },
        complete:()=>{
            order_details()
        }
    })

}
</script>