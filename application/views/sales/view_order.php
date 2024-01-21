<style>
thead th{
    text-align:center
}


</style>
<?php 

$qry = $this->db->query("SELECT o.*,Concat(u.firstname,' ',lastname) as uname FROM orders o inner join users u on o.user_id = u.id where o.id = '".$oid."' ")->row();
$qry_list = $this->db->query("SELECT ol.*,p.name as pname FROM order_list ol inner join product p on ol.product_id = p.id where ol.order_id = '".$oid."' ")->result_array();
$chk_sale = $this->db->get_where('sales',array('order_id'=>$oid))->num_rows();
$meta= array();
$chk_move = $this->db->get_where('for_delivery',array('order_id'=>$oid))->num_rows();

foreach($qry as $key => $val){
    if($key == 'type'){
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
    <?php if(empty($queue)){ ?>
    <div class="row form-group">
        <div class="col-md-2"><label for="for" class="control-label">Reference no.:</label></div>
        <div class="col-md-4"><label for="for" class="control-label"><b><?php echo $meta['ref_id'] ?></b></label></div>
    </div>
    <?php }else{ ?>
    <div class="row form-group">
        <div class="col-md-2"><label for="for" class="control-label">Queue:</label></div>
        <div class="col-md-4"><label for="for" class="control-label"><b><?php echo $queue?></b></label></div>
    </div>
    <?php } ?>
    <div class="row form-group">
        <div class="col-md-2"><label for="for" class="control-label">For:</label></div>
        <div class="col-md-4"><label for="for" class="control-label"><b><?php echo $meta['type'] ?></b></label></div>
    </div>
    <?php if($meta['type'] == 'Delivery'): ?>
        <div class="row form-group">
        <div class="col-md-2"><label for="loc" class="control-label">Location:</label></div>
        <div class="col-md-4"><label for="loc" class="control-label"><b><?php echo $meta['location'] ?></b></label></div>
    </div>
    <?php endif ?>
    <div class="row form-group">
        <table class="table-bordered table-striped table-hovered col-md-12">
            <colgroup>
                <col width="5%">
                <col width="25%">
                <col width="15%">
                <col width="15%">
                <col width="25%">
                <col width="15%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total Amount</th>
                        <th>Status</th>
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
                            <td><center><?php echo $i ?></center></td>
                            <td><?php echo $row['pname'] ?></td>
                            <td class="text-right">Php <?php echo number_format($row['price']) ?></td>
                            <td><center><?php echo $row['qty'] ?></center></td>
                            <td class="text-right">Php <?php echo number_format($row['total_amount']) ?></td>
                            <td><center>
                                <?php
                                    if($row['status'] == 1)
                                        echo '<span class="badge badge-primary">Pending</span>';
                                    elseif($row['status'] == 2)
                                        echo '<span class="badge badge-success">Served</span>';
                                      
                                ?>
                                </center>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4"><center>Grand Total</center></th>
                        <th colspan="2" class="text-right">Php <?php echo number_format($meta['total_amount'],2) ?></th>
                    </tr>
                </tfoot>
            </colgroup>
        </table>
    </div>
    <div class="row form-group">
        <div class="col-md-3"><label for="" class="control-label">Order was created by:</label></div>
        <div class="col-md-4"><label for="" class="control-label"><b><?php echo $meta['uname'] ?></b></label></div>
    </div>
    <br>
    <hr>
    <?php if(!empty($queue)){ ?>
    <div class="row">
        <div class="col-md-12">
            <?php if($chk_sale <= 0): ?>
            <button class="btn btn-info pull-right this-btns" id='pay_now'>Pay</button>
            <?php endif; ?>
            <?php if($qry->type == 3): ?>
            <?php if($qry->status != 1): ?>
            <?php if($chk_move <= 0 ): ?>
            <!-- <button class="btn btn-info pull-right this-btns" id='move_to_delivery'>Move to Delivery</button> -->
            <?php endif; ?>
            <?php else: ?>
            <span class="badge badge-success">Delivered</span>
            <?php endif; ?>
            <?php endif; ?>
            <?php if($qry->type == 4): ?>
            <?php if($qry->status != 1): ?>
            <button class="btn btn-info pull-right this-btns" id='change_ostat'>Mark as Picked-up</button>
            <?php else: ?>
            <span class="badge badge-success">Picked-up</span>
            <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
    <?php } ?>
</div>


<div class="modal"  role="dialog" id="pay_modal">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Pay</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="form-group row">
        <div class="col-md-4">
            <label for="" class="control-label">Amount to Pay</label>
        </div>
        <div class="col-md-8 text-right" id="amount_to_pay">
        0.00
        </div>
      </div>
      <div class="form-group row">
        <div class="col-md-4">
            <label for="" class="control-label">Amount rendered</label>
        </div>
        <div class="col-md-8 text-right">
            <input type="text" class="form-control text-right number" step='any' id="a_rendered" autocomplete="off" placeholder="0.00">
        </div>
      </div>

      <div class="form-group row">
        <div class="col-md-4">
            <label for="" class="control-label">Change</label>
        </div>
        <div class="col-md-8 text-right" id="amount_change">
        0.00
        </div>
      </div>
    </div>
       
      <div class="modal-footer">
        <button type="button" onclick="pay_now()" class="btn btn-primary" id="pay_mdl_btn">Pay</button>
      </div>
    </div>
  </div>
</div>
<div class="modal"  role="dialog" id="move_modal">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Move to delivery</h5>
        <button type="button" class="close" onclick="$('#move_modal').modal('hide')">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="form-group row">
        <div class="col-md-4">
            <label for="driver_id" class="control-label">Driver</label>
        </div>
        <div class="col-md-8" >
            <select id="driver_id" class="form-control">
            <option value="" selected disabled>Choose Driver</option>
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
        <button type="button" onclick="move_to_delivery()" class="btn btn-primary" >Move</button>
      </div>
    </div>
  </div>
</div>
<style>
#pay_modal .modal-dialog.modal-dialog-centered,#move_modal .modal-dialog.modal-dialog-centered {
    width: 35% !important;
}
#change_ostat{
    margin-right:10px;
}
</style>
<script>
    $(document).ready(function(){
    var websocket = new WebSocket("ws://<?php echo $_SERVER['SERVER_NAME'] ?>:8090/rios/php-socket.php"); 
        $('#a_rendered').keypress(function(e){
            if(e.which == 13){
                pay_now()
            }
        })
        $('#pay_now').click(function(){
            $('#amount_to_pay').html('<?php echo number_format(str_replace(',','',$meta['total_amount']),2) ?>')
            $('#amount_change').html('0.00')
            $('#a_rendered').val('')
            // $('.modal').modal('show')
            $('#pay_modal').modal('show')
            setTimeout(function(){
                $('#a_rendered').focus()
            },350)
        })
        
        $('#a_rendered').keyup(function(){
        var rendered = $(this).val();
        var amount = $('#amount_to_pay').html().replace(/,/g,'');
        amount = parseFloat(amount);
        var change = parseFloat(rendered) - amount;
        if(!isNaN(change)){
            $('#amount_change').html(parseFloat(change).toLocaleString('en-US',{style:'decimal','maximumFractionDigits' : 2,'minimumFractionDigits' : 2}))
        }else{
            $('#amount_change').html('0.00') 
        }
    })

    $('#move_to_delivery').click(function(){
            $('#move_modal').modal('show')
    })

    $('#change_ostat').off().on('click',function(){
        $('.this-btns').attr('disabled',true)
        $(this).html('Please wait...');
        $.ajax({
            url:'<?php echo base_url('sales/change_ostatus') ?>',
            method:'POST',
            data:{id:'<?php echo $oid ?>'},
            error:err=>{
                console.log(err)
                Dtoast('An error occured.','error')
            },
            success:resp=>{
                if(typeof resp != undefined){
                    resp= JSON.parse(resp)

                    if(resp.status =='success'){
                        Dtoast('Order successfully placed.','success')
                        var change_stat = {type:'order_update',id:resp.id,otype:'<?php echo $qry->type ?>'}
                        if(typeof change_stat != undefined && change_stat != null)
                            websocket.send(JSON.stringify(change_stat));
                        setTimeout(()=>{ location.reload() },750)
                    }
                }
            }
        })
    })
    })
    window.pay_now = function(){
        $('#pay_mdl_btn').attr('disabled',true).html('Please wait...')
        if($('#a_rendered').val() <= 0){
            Dtoast('Please enter amount rendered');
            $('#pay_mdl_btn').removeAttr('disabled').html('Pay')
            return false;
        }
        // console.log($('#amount_change').html() <= -1)
        var change = $('#amount_change').html().replace(/,/g,'')
        change = parseFloat(change)
        if(change <= -1){
            Dtoast('Amount to pay is greater than rendered.');
            $('#pay_mdl_btn').removeAttr('disabled').html('Pay')
            return false;
        }
        pay_submit();
    }
    
    window.pay_submit = function(){
        $.ajax({
            url:'<?php echo base_url().'sales/pay_saved' ?>',
            method:'POST',
            data:{id:'<?php echo $oid ?>',amount_tendered:$('#a_rendered').val()},
            error:(err)=>{
                console.log(err)
                Dtoast('An error occured')
                $('#pay_mdl_btn').removeAttr('disabled').html('Pay')
            },
            success:resp=>{
                if(resp == 1){
                    Dtoast('Order successfully Paid')
                    var nw = window.open("<?php echo base_url('sales/receipt/').$oid ?>","_blank","width=900,height=700")
                    start_loader()
                    nw.print()
                    setTimeout(function(){
                    nw.close()
                    $('.modal').modal('hide')
                    $('#filter_order').trigger('click')
                    end_loader()
                    },700)
                }else{
                    Dtoast('An error occured')
                $('#pay_mdl_btn').removeAttr('disabled').html('Pay')
                }
            }
        })
    }

    function move_to_delivery(){
        var user_id = $('#driver_id').val();
        start_loader()
        if($('.err').length > 0){
            $('.err').remove()
        }
        if(user_id <= 0){
            $('#move_modal .modal-body').prepend('<div class="err row"><div class="alert alert-danger">Select Driver First.</div></div>')
            end_loader()
            return false;
        }
        $.ajax({

            url:'<?php echo base_url('admin/move_order') ?>',
            method:'POST',
            data:{user_id:user_id,order_id:'<?php echo $oid ?>'},
            error:err=>{
                console.log(err)
                Dtoast('An error occured while moving order.','error')
                end_loader()
            },
            success:resp=>{
                if(resp == 1){
                    Dtoast('Order moved successfully','success');
                    websocket.send(JSON.stringify({type:'delivery_update',user_id:user_id,id:'<?php echo $oid ?>'}))
                    setTimeout(()=>{
                        location.reload()
                    },750)
                }

            }
            
        })
    }
</script>