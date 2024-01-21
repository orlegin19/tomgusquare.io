
<style>

@keyframes check {0% {height: 0;width: 0;}
25% {height: 0;width: 10px;}
50% {height: 20px;width: 10px;}
}
.checkbox{background-color:#fff;display:inline-block;height:28px;margin:0 .25em;width:28px;border-radius:4px;border:1px solid #ccc;float:right}
.checkbox span{display:block;height:28px;position:relative;width:28px;padding:0}
.checkbox span:after{-moz-transform:scaleX(-1) rotate(135deg);-ms-transform:scaleX(-1) rotate(135deg);-webkit-transform:scaleX(-1) rotate(135deg);transform:scaleX(-1) rotate(135deg);-moz-transform-origin:left top;-ms-transform-origin:left top;-webkit-transform-origin:left top;transform-origin:left top;border-right:4px solid #fff;border-top:4px solid #fff;content:'';display:block;height:20px;left:3px;position:absolute;top:15px;width:10px}
.checkbox span:hover:after{border-color:#999}
.checkbox input{display:none}
.checkbox input:checked + span:after{-webkit-animation:check .8s;-moz-animation:check .8s;-o-animation:check .8s;animation:check .8s;border-color:#555}
.checkbox input:checked + .default:after{border-color:#444}
.checkbox input:checked + .primary:after{border-color:#f86601}
.checkbox input:checked + .success:after{border-color:#8bc34a}
.checkbox input:checked + .info:after{border-color:#3de0f5}
.checkbox input:checked + .warning:after{border-color:#FFC107}
.checkbox input:checked + .danger:after{border-color:#f44336}
</style>
<form action="" id="eorder-frm">
    <input type="hidden" name="oid" value="<?php echo $oid ?>">

    <style>
    thead th{
        text-align:center
    }
    </style>
    <?php 

    $qry = $this->db->query("SELECT * FROM orders o where o.id = '".$oid."' ")->row();
    $qry_list = $this->db->query("SELECT ol.*,p.name as pname FROM order_list ol inner join product p on ol.product_id = p.id where ol.order_id = '".$oid."' ")->result_array();

    $meta= array();

    foreach($qry as $key => $val){
        if($key == 'type'){
            $meta['o_type'] = $val;
            if($val == 1)
                $val = 'Dine-in';
                elseif($val == 2)
                $val = 'Take-out';
                elseif($val == 3)
                $val = 'Delivery';
                elseif($val == 2)
                $val = 'Pickup';
        }

        if(in_array($key,array('amount','total_amount')))
        $val = str_replace(',','',$val);
        $meta[$key] = $val;
    }


    ?>

    <div class="col-lg-12 form-horizontal">
    <div id="not_kitchen">
    <div class="row form-group">
            <div class="col-md-2"><label for="for" class="control-label">Queue:</label></div>
            <div class="col-md-4"><label for="for" class="control-label"><b><?php echo $queue?></b></label></div>
        </div>
        <div class="row form-group" >
            <div class="col-md-2"><label for="type" class="control-label">For:</label></div>
            <div class="col-md-4">
                <select name="type" id="type" class="form-control">
                    <option value="1" <?php echo $meta['o_type'] == 1 ? 'selected' : '' ?>>Dine-in</option>
                    <option value="2" <?php echo $meta['o_type'] == 2 ? 'selected' : '' ?>>Take-out</option>
                    <option value="3" <?php echo $meta['o_type'] == 3 ? 'selected' : '' ?>>Delivery</option>
                    <option value="4" <?php echo $meta['o_type'] == 4 ? 'selected' : '' ?>>Pickup></option>
                </select>
            </div>
        </div>
            <div class="row form-group" id="loc_field" <?php echo $meta['o_type'] != 3 ? "style='display :none'" : '' ?>>
            <div class="col-md-2"><label for="loc" class="control-label">Location:</label></div>
            <div class="col-md-4"><textarea name="location" id="loc" cols="10" rows="2" class="form-control"><?php echo $meta['location'] ?></textarea></b></label></div>
        </div>
            <hr>
        <div class="row form-group">
            <div class="col-md-2"><label for="prod" class="control-label">Product:</label></div>
            <div class="col-md-4">
                <select name="prod" id="prod" class="form-control" >
                <option value="" disabled selected> Please select here</option>
                    <?php
                        $qry = $this->db->order_by('name',asc)->get_where('product',array('status'=>1));
                        foreach($qry->result_array() as $row):
                    ?>
                    <option value="<?php echo $row['id'] ?>" data-price="<?php echo $row['price'] ?>"><?php echo $row['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <button id="new_prod" type="button" class="btn btn-sm btn-primary"><i class="fa fa-plus"> </i> Add product to list</button>
            </div>
        </div>
        </div>
        <div class="row form-group">
            <table class="table-bordered table-striped table-hovered col-md-12" id="olist">
                <colgroup>
                    <col width="5%">
                    <col width="25%">
                    <col width="15%">
                    <col width="15%">
                    <col width="25%">
                    <col width="5%">
                    <thead>
                        <tr>
                            <th><center>
                            <label class="checkbox">
                                <input type="checkbox" id="chk_all">
                                <span class="primary"></span>
                            </label>
                            </center></th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i =0 ;
                            foreach($qry_list as $row):
                                $i++;

                                $row['price'] = str_replace(',','',$row['price']);
                                $row['total_amount'] = str_replace(',','',$row['total_amount']);
                        ?>
                            <tr>
                                <td><center>
                                
                                <label class="checkbox">
                                    <input type="checkbox"  class="chk_data" value='<?php echo $row['id'] ?>' name="chk_data[<?php echo $i ?>]" <?php echo $row['status'] == 2 ? 'checked="checked"' : '' ?>>
                                    <span class="primary"></span>
                                </label>
                                    
                                </center></td>
                                <td><input type="hidden" name="lid[<?php echo $i ?>]" value="<?php echo $row['id'] ?>"><input type="hidden" name="product_id[<?php echo $i ?>]" value="<?php echo $row['product_id'] ?>"><?php echo $row['pname'] ?></td>
                                <td class="text-right">
                                <input type="hidden" name="price[<?php echo $i ?>]" value="<?php echo $row['price'] ?>" class="price">
                                Php <?php echo number_format($row['price']) ?></td>
                                <td><center> <input type="number" name="qty[<?php echo $i ?>]" value="<?php echo $row['qty'] ?>"  class="text-right form-control" style="width:50px" <?php echo ($kitchen == 1) ? 'readonly' : '' ?>></center></td>
                                <td class="text-right">
                                <input type="hidden" name="total_amount[<?php echo $i ?>]" value="<?php echo $row['total_amount'] ?>" class="total_amount">
                                <span class="t-amount">Php <?php echo number_format($row['total_amount']) ?></span></td>
                                <?php if($kitchen != 1): ?>
                               <td><center><a href="javascript:void(0)" onclick="$(this).closest('tr').remove()"><i class="fa fa-times" style='color:red'></i></a></center></td>
                                <?php endif; ?>
                            </tr>
                            <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3"><center>Grand Total</center><input type="hidden" name="gTotal" value="<?php echo number_format($meta['total_amount'],2) ?>"></th>
                            <th colspan="2" class="text-right" id="gTotal">Php <?php echo number_format($meta['total_amount'],2) ?></th>
                        </tr>
                    </tfoot>
                </colgroup>
            </table>
        </div>
    </div>
<hr>
<div class="col-lg-12">
    <button class="btn btn-primary btn-sm pull-right">Save</button>
</div>
</form>
<?php if($kitchen == 1): ?>
<style>
#not_kitchen{
    display:none;
}
</style>
<?php endif; ?>
<script>
function chk_f(){
        $('.chk_data').each(function(){
            $(this).change(function(){
                var chk_length = $('.chk_data').length
                var chkd_length = $('.chk_data:checked').length
                        console.log(chk_length,chkd_length)
                if(chk_length == chkd_length)
                    $('#chk_all').prop('checked',true)
                    else
                    $('#chk_all').prop('checked',false)

            })
        })

}
function chk_click(){
    if($('#chk_all').is(':checked') == true){
            $('.chk_data').each(function(){
                $(this).prop('checked',true)
            })
        }else{
            $('.chk_data').each(function(){
                $(this).prop('checked',false)
            })
        }
        chk_f()
}
window.update_calc =function(){
    $('[name="qty[]"]').each(function(){
        $(this).on('keyup change',function(){
            var price = $(this).closest('tr').find('.price').val();
            var qty = $(this).val();
            // console.log(price,qty)
            price = price.replace(/,/g,'');
            var tprice = parseInt(qty) * parseFloat(price);
            $(this).closest('tr').find('.total_amount').val(tprice)
            $(this).closest('tr').find('.t-amount').html('Php '+parseFloat(tprice).toLocaleString('en-US',{'style':'decimal', maximumFractionDigits:2,minimumFractionDigits:2}))
            
            cal_gtotal()
        })
    })
}
window.cal_gtotal = function(){
    var total = 0;
    $('#olist .total_amount').each(function(){
        // if($(this).val() > 0)
        total += parseFloat($(this).val());
    })
    // console.log(total)

    $('[name="gTotal"]').val(parseFloat(total).toLocaleString('en-US',{'style':'decimal', maximumFractionDigits:2,minimumFractionDigits:2}))
    $('#gTotal').html('Php '+parseFloat(total).toLocaleString('en-US',{'style':'decimal', maximumFractionDigits:2,minimumFractionDigits:2}))
    
}
$(document).ready(function(){

    chk_f()
    update_calc()
    var chk_length = $('.chk_data').length
    var chkd_length = $('.chk_data:checked').length
            // console.log(chk_length,chkd_length)
    if(chk_length == chkd_length)
        $('#chk_all').prop('checked',true)
        else
        $('#chk_all').prop('checked',false)
    $('#chk_all').click(function(){
        chk_click()
    })
    $('#prod').select2({
        placeholder:'Select Product here.',
        width:'resolve'
    })
    $('#type').change(function(){
        if($(this).val() == 3){
            $('#loc_field').show()
        }else{
            $('#loc_field').hide()

        }
    })

    $('#eorder-frm').submit(function(e){
        e.preventDefault()
        $('#eorder-frm button[type="submit"]').attr('disabled',true).html('Saving Data..')
        $.ajax({
            url:'<?php echo base_url().'sales/save_pos' ?>',
            method:'POST',
            data:$(this).serialize(),
            error:err=>{
                console.log(err)
                Dtoast('An error occured')
                $('#eorder-frm button[type="submit"]').removeAttr('disabled').html('Save')
            },
            success:resp=>{
                if(resp){
                    var data = JSON.parse(resp);
                    if(data.status == 1){
                        var renewStatus = {type:'kitchen_renewStatus',id:data.order_id,status:data.order_status}
                        websocket.send(JSON.stringify(renewStatus));
                        Dtoast('Data successfully updated');
                        setTimeout(()=>{ location.reload(); },750)
                    }else{
                        Dtoast('An error occured')
                        $('#eorder-frm button[type="submit"]').removeAttr('disabled').html('Save')
                    }
                    
                }else{
                    Dtoast('An error occured')
                    $('#eorder-frm button[type="submit"]').removeAttr('disabled').html('Save')
                }
            }
        })
    })

    $('#new_prod').click(function(){
        var id = $('#prod').val();
        var i = '<?php echo $i ?>' 
        i = parseInt(i);
        i++;
        if(id == null){
            Dtoast('Please select product first')
            return false;
        }

        var price = $('#prod option[value="'+id+'"]').attr('data-price');
        var pname = $('#prod option[value="'+id+'"]').html();
        
        html = '';
        var chk_prod = $('[name="product_id[]"][value="'+id+'"]').length
        if(chk_prod > 0){
            Dtoast("Product is already on the list.");
            return false;
        }

        html += '<tr>'
               html +=  '<td><center><label class="checkbox"><input type="checkbox" class="chk_data" value="" name="chk_data['+i+']"><span class="primary"></span></label></center></td>'
               html +=  '<td><input type="hidden" name="lid['+i+']" value="0"><input type="hidden" name="product_id['+i+']" value="'+id+'">'+pname+'</td>'
                html += '<td class="text-right">'
                html += '<input type="hidden" name="price['+i+']" value="'+price+'" class="price">'
                html += 'Php '+price+'</td>'
              html +=  ' <td><center> <input type="number" name="qty['+i+']" value="1"  class="text-right form-control" style="width:50px"></center></td>'
                html += '<td class="text-right">'
               html +=  '<input type="hidden" name="total_amount['+i+']" value="'+price+'" class="total_amount">'
                html += '<span class="t-amount">Php '+price+'</span></td>'
               html +=  '<td><center><a href="javascript:void(0)" onclick="$(this).closest(\'tr\').remove()"><i class="fa fa-times" style=\'color:red\'></i></a></center></td>'
        html += '</tr>'

        $('#olist tbody').prepend(html)
        chk_f()
        update_calc()
        cal_gtotal()
        $('#prod').val('').trigger('change')
        var chk_length = $('.chk_data').length
        var chkd_length = $('.chk_data:checked').length
                // console.log(chk_length,chkd_length)
        if(chk_length == chkd_length)
            $('#chk_all').prop('checked',true)
            else
            $('#chk_all').prop('checked',false)
        $('#chk_all').click(function(){
            chk_click()
        })

    })
})
</script>