<script src="<?php echo base_url() ?>assets/js/jquery.table2excel.min.js"></script>
<div class="col-md-12">
    <div class="row form-group justify-content-start align-items-center">
            <label id="l" for="date_start" class="control-label mr-1">Date Start :</label>
            <input type="text" class="form-control form-control-sm datepick_input col-md-3" id="date_start" value="<?php echo date("Y-m-d") ?>">
            <label id="l" for="date_start" class="control-label mx-1">End Date :</label>
            <input type="text" class="form-control form-control-sm datepick_input col-md-3" id="end_date" value="<?php echo date("Y-m-d") ?>">&nbsp;&nbsp;
            <button id="print_receipt" class="btn btn-primary btn-sm" data-id='' ><i class="fa fa-print"></i> Print</button>
            <div class="col-md-3">
            <button class="btn btn-primary btn-sm" id="filter_order" onclick="load_report()"><i class="fa fa-filter"></i> Filter</button>
        <button class="btn btn-primary btn-sm" id="export_report"><i class="fa fa-file-excel"></i> Export to Excel</button><br>
        
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-12 mb-4">
            <table class="table table-bordered table-striped" id="report-field">
                <thead>
                    <tr>
                        <td class="text-center">#</td>
                        <td class="text-center">Referrence #</td>
                        <td class="text-center">Date</td>
                        <td class="text-center">Amount</td>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <td class="text-center" colspan="3"><b>Total Sales</b></td>
                        <td class="text-right" colspan="3"><b id="gTotal"></b></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<script>
// start print
$(document).ready(function(){
        $('#print_receipt').click(function(){
            var nw = window.open("<?php echo base_url('./sales/report/') ?>"+$(this).attr('data-id'),"_blank","width=900,height=700")
            // console.log(nw)
            if(nw.document.readyState === 'complete'){
                  start_loader()
                    nw.print()
                    setTimeout(function(){
                    nw.close()
                        end_loader()
                    },750)
            }
          
        })
    })
// end print
$(document).ready(function(){
    load_report();
    $('#export_report').click(function(){
        var fname = 'Sales_report('+$('#date_start').val()+'-'+$('#date_start').val()+')';
        start_loader()
        tablesToExcel('#report-field',fname+'.xls','<style>tr,td,th{ border: 1px solid black;}</style>')
        setTimeout(()=>{ end_loader() },1500)
    })
    
})

window.load_report = function(){
    start_loader()
    var start_date  = $('#date_start').val();
    var end_date  = $('#end_date').val();
    $('#filter_order').click(function(){
     ($('#start_date').val(),$('#end_date').val());
    })
     
    $('#gTotal').html('Php '+'0.00')
    $('#report-field tbody').html('<tr><td colspan="4">Loading data...</td></tr>')

    $.ajax({
        url:'<?php echo base_url('admin/load_sales_report') ?>',
        method:'POST',
        data:{start_date:start_date,end_date:end_date},
        error:err=>{
            console.log(err);
            Dtoast('An error occured.','error')
            end_loader();
        },
        success:resp=>{
            if(typeof resp != undefined && typeof resp != null){
                resp = JSON.parse(resp)
            $('#report-field tbody').html('');

                var total = 0;
            if(Object.keys(resp).length > 0){
                var i = 0;
                Object.keys(resp).map(k=>{
                    i++;
                    var tr = $('<tr></tr>').clone()

                    tr.append('<td>'+i+'</td>')
                    tr.append('<td>'+resp[k].ref_id+'</td>')
                    tr.append('<td>'+resp[k].sale_date+'</td>')
                    tr.append('<td class="text-right">Php '+parseFloat(resp[k].total_amount).toLocaleString('en-US',{style:'decimal', minimumFractionDigits:2, maxmumFractionDigits:2})+'</td>')

                    total += parseFloat(parseFloat(resp[k].total_amount).toLocaleString('en-US',{style:'decimal', minimumFractionDigits:2, maxmumFractionDigits:2, useGrouping:false}))

                    $('#report-field tbody').append(tr)

                })

                $('#gTotal').html('Php '+parseFloat(total).toLocaleString('en-US',{style:'decimal', minimumFractionDigits:2, maxmumFractionDigits:2}))


            }else{
                 $('#report-field tbody').html('<tr><td colspan="4">No data to be display.</td></tr>')

            }

            }else{
                Dtoast('An error occured.','error')
                $('#report-field tbody').html('<tr><td colspan="4">An error occured while fetching data.</td></tr>')
            }
        },
        complete:()=>{
            end_loader()
        }
    })

}
</script>