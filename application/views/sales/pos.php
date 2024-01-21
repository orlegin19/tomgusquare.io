<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" src="<?php echo base_url() ?>assets/mobile.css">
    <link rel="stylesheet" src="<?php echo base_url() ?>assets/w3.css">
    <link rel="stylesheet" src="<?php echo base_url() ?>assets/family.css">
    <link rel="stylesheet" src="<?php echo base_url() ?>assets/js.css">
</head>
<style>
div#product_holder {
    height: 30vw;
    overflow: auto;
}

div#pg-holder {
    border-left: 1px solid white;
}

.card .price-field {
    position: absolute;
    background: #dc354585;
    border-radius: 5px;
    padding: 0px 5px;
    right: 2%;
    top: 1%;
    font-weight: 600;
    color: #000000fc;
}

.card-data {
    float: left;
    cursor: pointer;
}

#list_holder {
    display: contents;
}

.pg-btns {
    margin: 4px 4px;
}

div#gtotal_field {
    position: absolute;
    width: 90%;
    bottom: 12px;
}

div#order_field {
    height: 25vw;
    overflow: auto;
}

.loc_field {
    display: none;
}

#order_frm {
    width: 100%
}

.card-data .card-body {
    padding: .3rem;
}

@media (min-height: 960px) {
    div#order_field {
        height: 48rem;
        overflow: auto;
    }

    div#product_holder {
        height: 48rem;
        overflow: auto;
    }

    @media (min-height: 760px) {
        div#order_field {
            height: 30rem;
            overflow: auto;
        }

        div#product_holder {
            height: 30rem;
            overflow: auto;
        }


    }
}
</style>

<body>
    <form action="" id="order_frm">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-md-1 text-right"><label for="otype" class="control-label">Order Type</label></div>
                <div class="col-md-2">
                    <input type="hidden" name="save_as" value="">
                    <input type="hidden" name="amount_tendered" value="0">
                    <select name="order_type" id="otype" required class="form-control">
                        <option value="1" selected>Dine-in</option>
                        <option value="2">Take out</option>
                        <!-- <option value="3">Delivery</option>
                <option value="4">Pick-up</option> -->
                    </select>
                </div>
                <div class="col-md-1 text-right loc_field"><label for="loc" class="control-label">Location</label></div>
                <div class="col-md-3 loc_field">
                    <textarea name="location" id="loc" cols="30" rows="2" required class="form-control"></textarea>
                </div>
                <div class="col-sm-20" id="pg-holder">
                    <div class="row" style="margin:-1px; padding-left:0px;">
                        <div class="col-md-12" style="display:flex" id="pg-field">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-3">
                <div class="card card-default" style="height:calc(99%);width:calc(110%)">
                    <div class="card-body" style="position:relative">
                        <b>
                            <h5>Order/s</h5>
                        </b>
                        <div id="order_field">
                            <table class="table table-condensed table-striped" id="orders_tbl">
                                <colgroup>
                                    <col width="5%">
                                    <col width="35%">
                                    <col width="10%">
                                    <col width="20%">
                                    <col width="30%">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th><i class="fa fa-trash" style="color:black"></i></th>
                                        <th class="text-left">Product</th>
                                        <th class="text-left">QTY</th>
                                        <th class="text-left">Price</th>
                                        <th class="text-left">Total</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <div id="gtotal_field">
                            <div class="row">
                                <div class="col-md-4 pull-right">
                                    <button type="button" class="pull-right btn btn-sm btn-primary submit_btns"
                                        style="margin:0 -35px; width:140px;height: 45px;" onclick="submit_frm(1)"
                                        id="save_btn"><?php echo ($_SESSION['type'] != 6) ? "Save" : "Submit Order" ?></button>
                                    <?php if($_SESSION['type'] != 6) : ?>
                                    <button type="button" class="pull-right btn btn-sm btn-primary submit_btns"
                                        style="margin:0 5px; width:140px;height: 45px;"
                                        onclick="submit_frm(2)">Pay</button>
                                    <?php endif; ?>
                                </div>
                                <table class="col-md-7">
                                    <thead>
                                        <tr>
                                            <th style="" class="text-right text-black"><b>All Total</b> <input
                                                    type="hidden" name="gTotal" val="0.00"></th>
                                            <th style="" class="text-right text-black" id="gTotal">0.00</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9 card card-default bg-dark">
                <div class="row card-body">
                    <div class="col-sm-12" id="product_holder">
                        <div class="row">
                            <div class="div col-md-12" id="list_holder">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>

    <div class="modal" role="dialog" id="pay_modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
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
                            <label for="" class="control-label">Amount Tendered</label>
                        </div>
                        <div class="col-md-8 text-right">
                            <input type="text" class="form-control text-right number" step='any' id="a_rendered"
                                placeholder="0.00">
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

    <div class="modal" role="dialog" id="queue_modal" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <!-- <div class="modal-header">
        <h5 class="modal-title">Queue Number</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> -->
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <h4><b>Ref. No. :</b></h4>
                        </div>
                        <div class="col-md-8">
                            <b>
                                <h4 id="ref_field"></h4>
                            </b>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <h5><b>Queue No. :</b></h5>
                        </div>
                        <div class="col-md-8">
                            <b>
                                <h5 id="queue_field"></h5>
                            </b>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" id="print_receipt" class="btn btn-success" data-id=''><i
                                class="fa fa-print"></i> Print Receipt</button>
                        <button type="button" onclick="location.reload()" class="btn btn-primary">New Order</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="card_holder_clone" style="display: none">
            <div class="card-data px-1" style="width: 50%;">
                <div class="card mb-1 text-dark bg-gradient-white" style="border: 2px solid black;">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img class="card-img-top" src="" alt="Card image cap"
                                style="height:10vw;object-fit: cover;width:20vw; border:3px solid gray;">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body " style="color:black !important">
                                <div class="price-field" style="top:0.1vw;padding-left: 20px;height:30px;"
                                    align-text="center"></div>
                                <div class="avail-status" style="top:8vw;padding-left: 128px;"></div>
                                <b>
                                    <p class="card-title" style="padding-top:26px;padding-left: 128px;"></p>
                                </b>
                                <p style="padding-left:128px;font-family:bold;">Category:<span class="card-text"
                                        style="padding-left:5px;"></span></p>
                                <div class="pull-right">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>
<script type="text/javascript" src="<?php echo base_url() ?>assets/main2.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/main.js"></script>
<script>
$(document).ready(function() {
    $('#print_receipt').click(function() {
        var nw = window.open("<?php echo base_url('sales/receipt/') ?>" + $(this).attr('data-id'),
            "_blank", "width=900,height=700")
        // console.log(nw)
        if (nw.document.readyState === 'complete') {
            start_loader()
            nw.print()
            setTimeout(function() {
                nw.close()
                end_loader()
            }, 750)
        }

    })
    $('#sidebarToggle').trigger('click')
    load_pg();
    load_cards();


    $('#order_frm').submit(function(e) {
        e.preventDefault();
        if ($('[name="save_as"]').val() == '')
            return false;
        swal("Please Wait in 10-20 mins.\n\n Cash Only");
        if ($('#orders_tbl').find('.order-row').length <= 0) {
            Dtoast('Order list is empty');
            return false;
        }
        //    console.log('submitted')
        start_loader()
        $.ajax({
            url: '<?php echo base_url().'/sales/save_pos' ?>',
            method: 'POST',
            data: $(this).serialize(),
            error: (err) => {
                console.log(err)
                Dtoast('An error occured', 'error')
                end_loader()
                $('#save_btn').html('save')
            },
            success: (resp) => {
                if (resp) {
                    var data = JSON.parse(resp);
                    if (data.status == 'success') {
                        var renew = {
                            type: 'kitchen_renew',
                            id: data.order_id
                        }
                        websocket.send(JSON.stringify(renew));
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Order successfully placed",
                            showConfirmButton: false,
                            timer: 2500
                        });
                        $('#pay_mdl_btn').removeAttr('disabled').html('Pay');
                        $('.modal').modal('hide');
                        if (data.ins_sale == 1) {
                            $('#print_receipt').attr('data-id', data.order_id)
                            $('#print_receipt').show()
                        } else {
                            $('#print_receipt').hide()
                        }
                        $('#ref_field').html('<b>' + data.ref_no + '</b>')
                        $('#queue_field').html(data.queue)
                        $('#queue_modal').modal('show')
                        end_loader()
                    }
                } else {
                    Dtoast('An error occured', 'error')
                    $('#pay_mdl_btn').removeAttr('disabled').html('Pay');
                    end_loader()
                }
            }
        })

    })

    $('#otype').change(function() {
        if ($(this).val() == 3)
            $('.loc_field').show();
        else
            $('.loc_field').hide();
    })

    $('#a_rendered').on('keyup keypress', function(e) {
        if (e.which == 13) {
            pay_now();
            return false;
        }
        var rendered = $(this).val();
        rendered = rendered.replace(/,/g, '')
        var amount = $('#amount_to_pay').html().replace(/,/g, '');
        amount = parseFloat(amount);
        var change = parseFloat(rendered) - amount;
        if (!isNaN(change)) {
            $('#amount_change').html(parseFloat(change).toLocaleString('en-US', {
                style: 'decimal',
                'maximumFractionDigits': 2,
                'minimumFractionDigits': 2
            }))
        } else {
            $('#amount_change').html('0.00')
        }
    })

})
window.pay_now = function() {
    $('[name="amount_tendered"').val(0)
    if ($('#a_rendered').val() <= 0) {
        Dtoast('Please enter amount rendered');
        return false;
    }
    // console.log($('#amount_change').html() <= -1)
    var change = $('#amount_change').html().replace(/,/g, '')
    change = parseFloat(change)
    if (change <= -1) {
        Dtoast('Amount to pay is greater than rendered.', 'error');
        return false;
    }
    var tendered = $('#a_rendered').val()
    if (tendered <= 0)
        tendered = 0;
    $('[name="amount_tendered"').val(tendered)
    $('#order_frm').submit()
}
window.submit_frm = function(type) {
    if ($('#orders_tbl').find('.order-row').length <= 0) {
        Dtoast('Order list is empty', 'error');
        return false;
    }
    $('[name="save_as"]').val(type);
    // $('#order_frm').submit()
    if (type == 2) {
        $('#amount_to_pay').html($('#gTotal').html())
        $('#amount_change').html('0.00')
        $('#a_rendered').val('')
        $('#pay_modal').modal('show')
        setTimeout(function() {
            $('#a_rendered').focus();
        }, 750)
    } else {
        $('.submit_btns').attr('disabled', true);
        $('#save_btn').html('Please wait ...')
        $('#order_frm').submit()
    }
}

window.load_cards = function($id = 'all', status = '1') {
    $('#list_holder').html('<div class="text-center text-white w-100"><i>Please wait...</i></div>')
    $.ajax({
        url: '<?php echo base_url().'products/get_products' ?>',
        method: 'POST',
        data: {
            id: $id,
            status: status
        },
        error: (err) => {
            console.log(err)
        },
        success: function(resp) {
            if (resp) {
                $('#list_holder').html('')
                var data = JSON.parse(resp);
                // console.log(data)
                if (data.length <= 0) {
                    $('#list_holder').html(
                        '<div class="text-center text-white w-100"><i>No Data...</i></div>')
                }
                data.map(row => {
                    html = $('#card_holder_clone .card-data').clone();
                    html.find('.card-title').html(row.name);
                    html.find('.price-field').html('&#8369; ' + (parseFloat(row.price)
                        .toLocaleString('en-US', {
                            style: 'decimal',
                            'maximumFractionDigits': 2
                        })));
                    if (row.status == 1)
                        html.find('.avail-status').html(
                            '<span class="badge badge-success">Available</span>');
                    else
                        html.find('.avail-status').html(
                            '<span class="badge badge-danger">Not Available</span>');

                    html.find('.card-title').html(row.name);
                    html.attr({
                        'data-name': row.name,
                        'data-id': row.id,
                        'data-price': (parseFloat(row.price).toLocaleString('en-US', {
                            style: 'decimal',
                            'maximumFractionDigits': 2
                        }))
                    });
                    html.find('.card-text').html(row.description);
                    if (row.img_path == '')
                        row.img_path = 'uploads/products/logo.jpg'
                    html.find('.card-img-top').attr('src', '<?php echo base_url() ?>' + row
                        .img_path)
                    $('#list_holder').append(html)

                })
                card_data();

            }



        }

    })
}
window.card_data = function() {
    $('.card-data').each(function() {
        $(this).click(function() {
            // console.log($('#orders_tbl').find('.order-row[id="'+$(this).attr('data-id')+'"]').length )
            if ($('#orders_tbl').find('.order-row[id="' + $(this).attr('data-id') + '"]').length >
                0) {
                Dtoast("Product is already on the list");
                return false;
            }
            html = '';
            html += '<tr class="order-row" id="' + $(this).attr('data-id') + '">';
            html += '<td><center><a href="javascript:void(0)" onclick="rem_prod(' + $(this).attr(
                    'data-id') +
                ')"><i class="fa fa-times" style="color:red"></i></a></center></td>'
            html += '<td>' + $(this).attr('data-name') +
                '<center><input type="hidden" name="pid[]" value="' + $(this).attr('data-id') + '"></center></td>'
            html +=
                '<td><center><input class="qty text-center" type="number" name="qty[]" value="1" style="width:48px" required></center></td>'
            html +=
                '<td class="text-center"><center><input class="price" type="hidden" name="price[]" value="' +
                $(this).attr('data-price') + '" required></center>' + $(this).attr('data-price') + '</td>'
            html +=
                '<td class="text-center"><center><input class="t_price" type="hidden" name="tprice[]" value="' +
                $(this).attr('data-price') + '" required><p  class="t_price">' + $(this).attr(
                    'data-price') + '</p></center></td>'
            html += '</tr>';
            $('#orders_tbl tbody').prepend(html)
            // console.log(html)
            compute_totals();
            $('.qty').on('click', function() {
                $(this).select()
            })
        })


    })
}
window.rem_prod = function(pid) {
    $('.order-row[id="' + pid + '"]').remove()
    compute_totals();
}
window.compute_totals = function() {
    $('.order-row').each(function() {
        var _this = $(this)
        $(this).find('.qty').on('change keyup', function() {
            var qty = $(this).val();
            var price = _this.find('.price').val()

            price = price.replace(/,/g, '')
            price = parseFloat(price);
            var total_price = parseFloat(qty * price).toLocaleString('en-US', {
                style: 'decimal',
                'maximumFractionDigits': 2
            })
            // console.log(price,qty)
            _this.find('input.t_price').val(total_price)
            _this.find('p.t_price').html(total_price)
            compute_totals()
        })
    })

    var _total = 0;
    $('.order-row').find('p.t_price').each(function() {
        var p = $(this).html()
        p = p.replace(/,/g, '')
        p = parseFloat(p)
        _total += p;
    })
    _total = parseFloat(_total).toLocaleString('en-US', {
        style: 'decimal',
        'maximumFractionDigits': 2,
        'minimumFractionDigits': 2
    })
    $('#gTotal').html(_total)
    $('[name="gTotal"]').val(_total)

}

window.load_pg = function(status = 1) {
    $.ajax({
        url: '<?php echo base_url().'products/load_pg' ?>',
        type: 'POST',
        data: {
            status: status
        },
        error: (err) => {
            console.log(err)
        },
        success: (resp) => {
            if (resp) {
                var data = JSON.parse(resp)
                $('#pg-field').html(
                    '<button class="btn btn-info pg-btns pull-left" data-id="all">All</button>')
                if (typeof data != undefined && Object.keys(data).length > 0) {
                    data.map(row => {
                        $('#pg-field').append(
                            '<button type="button" class="btn btn-primary pg-btns pull-left" data-id="' +
                            row.id + '">' + row.name + '</button>')

                    })


                }
                $('.pg-btns').each(function() {
                    $(this).click(function() {
                        $('.pg-btns.btn-info').removeClass('btn-info').addClass(
                            'btn-primary');
                        $(this).removeClass('btn-primary').addClass('btn-info')
                        load_cards($(this).attr('data-id'))
                    })
                })
            }
        }
    })
}
</script>

</html>