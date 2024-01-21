<div class="col-lg-12">
    <div class="row form-group">
        <div class="col-md-1">
            <label for="date_start" class="control-label">Date Start :</label>
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control datepick_input" id="date_start" value="<?php echo date("Y-m-d") ?>">
        </div>
        <div class="col-md-1 col-md-offset-1">
            <label for="date_start" class="control-label">End Date :</label>
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control datepick_input" id="end_date" value="<?php echo date("Y-m-d") ?>">
        </div>
        <div class="col-md-2">
        <button class="btn btn-primary btn-sm" id="filter_order">Filter</button>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12 mb-4 pb-3" id="tbl_holder">
            
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    load_tbl($('#date_start').val(),$('#end_date').val());

    $('#filter_order').click(function(){
     load_tbl($('#date_start').val(),$('#end_date').val());
    })
})
window.load_tbl = function (sdate,edate){
    var tbl_holder = $('#tbl_holder');

    tbl_holder.html('<center><i>Loading data...</i></center>');

    $.ajax({
        url:'<?php echo base_url().'sales/load_olist' ?>',
        method:'POST',
        data:{sdate :sdate,edate:edate},
        error:err=>{
            console.log(err)
            Dtoast("Loading data failed");
        },
        success:resp=>{
            if(resp){

                var html = '';

                var data = JSON.parse(resp);
                var i =1;
                if(typeof data && Object.keys(data).length > 0){

                    html += '<table class="table-bordered table-striped" id="order_tbl">'
                    html += '<colgroup>'
                    html += '<col width="5%">'
                    html += '<col width="15%">'
                    html += '<col width="10%">'
                    html += '<col width="15%">'
                    html += '<col width="10%">'
                    html += '<col width="15%">'
                    html += '<col width="15%">'
                    html += '<col width="15%">'
                    html += '</colgroup>'
                    html += '<thead>'
                    html += '<tr>'
                    html += '<th>#</th>'
                    html += '<th>Date</th>'
                    html += '<th>Ref. no.</th>'
                    html += '<th>For</th>'
                    html += '<th>Queue No.</th>'
                    html += '<th>Status</th>'
                    html += '<th>Total Amount</th>'
                    html += '<th>Action</th>'
                    html += '</tr>'
                    html += '</thead>'
                    html += '<tbody>'
                        
                    html += '</tbody>'
                    html += '</table>'
                    tbl_holder.html(html)
                    // console.log(tbl_holder.find('#order_tbl').length)
                    html = '';
                    Object.keys(data).map(k=>{
                            //  console.log(data)
                            var otype = '';
                            if(data[k].type == 1 )
                                otype = 'Dine-in';
                            if(data[k].type == 2 )
                                otype = 'Take-out';
                            if(data[k].type == 3 )
                                otype = 'Delivery';
                            if(data[k].type == 4 )
                                otype = 'Pick-up';
                            html += '<tr>'
                            html += '<td>'+(i++)+'</td>'
                            html += '<td>'+data[k].odate+'</td>'
                            
                            html += '<td>'+data[k].ref_id+'</td>'
                            html += '<td>'+otype+'</td>'
                            html += '<td>'+data[k].queue+'</td>'
                            html += '<td><center>';
                                if(data[k].sales_status == 1){
                                    html += '<span class="badge badge-success">Paid</span>'
                                }else{
                                    html += '<span class="badge badge-warning">Unpaid</span>'
                                }
                                html += '<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>'
                                if(data[k].serve_status == 0){
                                    html += '<span class="badge badge-primary">Pending</span>'
                                }else if(data[k].serve_status == 1){
                                    html += '<span class="badge badge-info">Prapering</span>'
                                }else if(data[k].serve_status == 2){
                                    html += '<span class="badge badge-success">Served</span>'
                                }
                            html += '</center></td>'
                            html += '<td class="text-right">'+(parseFloat(data[k].total_amount).toLocaleString('en-US',{style:'decimal',maximumFractionDigits:2,minimumFractionDigits:2}))+'</td>'
                            html += '<td><center>'
                            html += '<div class="dropdown">'+
                                    '<button type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded=>Action  </button>'+
                                    // '<button type="button" class="btn btn-primary btn-sm"true">'+
                                    //     '<span class="sr-only">Toggle Dropdown</span>'+
                                    // '</button>'+
                                    '<div class="dropdown-menu">'+
                                        '<a class="dropdown-item view_order" href="javascript:void(0)" data-id="'+data[k].id+'" data-ref="'+data[k].ref_id+'" data-queue="'+data[k].queue+'">View</a>'+
                                        '<div class="dropdown-divider"></div>'+
                                        '<a class="dropdown-item edit_order" href="javascript:void(0)" data-id="'+data[k].id+'" data-ref="'+data[k].ref_id+'" data-queue="'+data[k].queue+'">Edit</a>'+
                                        '<div class="dropdown-divider"></div>'+
                                        '<a class="dropdown-item remove_order" href="javascript:void(0)" data-id="'+data[k].id+'" data-name="'+data[k].ref_id+'" data-ref="'+data[k].ref_id+'" data-queue="'+data[k].queue+'">Delete</a>'+
                                    '</div>'+
                                    '</div>';
                            html += '</center></td>'
                            html += '</tr>'
                            tbl_holder.find('tbody').html(html)
                            load_functions()
                        })
                    

                    tbl_holder.find('#order_tbl').dataTable()

                    load_functions()
                }else{
                tbl_holder.html('<center><i>No data to be display...</i></center>');

            }
            }
        }
    })
}

window.load_functions = function (){
    $('.view_order').each(function(){
        $(this).click(function(){
            AjaxUniModal(60,'<?php echo base_url().'/sales/view_order/' ?>'+$(this).attr('data-id')+'/'+$(this).attr('data-queue'),$(this).attr('data-ref'))
        })
    })

    $('.edit_order').each(function(){
        $(this).click(function(){
            AjaxUniModal(75,'<?php echo base_url().'/sales/edit_order/' ?>'+$(this).attr('data-id')+'/'+$(this).attr('data-queue'),'Edit order: '+$(this).attr('data-ref'))
        })
    })

    $('.remove_order').each(function(){
        $(this).click(function(){
            delete_data('Are you sure to delete order <b>'+$(this).attr('data-ref')+'</b> permanently? This process cannot be undone. ','delete_order',[$(this).attr('data-id')]);
        })
    })
}

function delete_order($id){
    $.ajax({
        url:'<?php echo base_url().'sales/delete_order' ?>',
        method:'POST',
        data:{id:$id},
        error:err=>{
            console.log(err)
            Dtoast('An error occured')
            $('.modal').modal('hide');
        },
        success:resp=>{
            if(resp == 1){
                Dtoast('Order successfully deleted.')
                setTimeout(()=>{ location.reload(); },750)
            }else{
                Dtoast('An error occured')
                $('.modal').modal('hide');
            }
        }
    })
}
</script>