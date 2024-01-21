
<?php

// $accept = socket_accept($socket)or die("Could not accept incoming connection");


// if(socket_read($socket,1024)){
//  $reply = socket_read($socket,1024);

// $reply = trim($reply);
// }
// $reply = socket_read($socket,1024);

// $reply = trim($reply);
?>

<div class="col-lg-12">
    <hr>
        <div class="row">
            <div class="col-md-12" id="order-field">
        </div>
    </div>
</div>

<div id="new_chat"?></div>
<div id="card_holder_clone" style="display: none">
	<div class="col-md-3 card-data">
         <div class="card mb-3 text-white bg-dark">
            <div class="card-body">
               <h5 class="card-title"></h5>
               <p class="card-text"></p>
                <div class="pull-right card-status">
               </div>
            </div>
         </div>
    </div>
</div>
<style>
#order-field{
    display:contents;
}
#order-field .card-data{
    float:left;
    cursor:pointer;
}
</style>
<script>
$(document).ready(function(){
    load_data();



    const check = () => {
    if (!('serviceWorker' in navigator)) {
        throw new Error('No Service Worker support!')
    }else{
        console.log('Has SW')
    }
    if (!('PushManager' in window)) {
        throw new Error('No Push API Support!')
    }else{
        console.log('has PM')
    }
    }
    const registerServiceWorker = async () => {
    const swRegistration = await navigator.serviceWorker.register('assets/js/kitchen_sw.js'); //notice the file name
    return swRegistration;
    }
    const main = async () => {
    check()
    const swRegistration = await registerServiceWorker();
}


    main()

})

window.load_data = function($id=''){
    if($id == '')
         $('#order-field').html('<center>Loading Data.</center>')
        $.ajax({
        url:'<?php echo base_url().'monitor/load_orders' ?>',
        method:'POST',
        data:{id:$id},
        error:err=>{
            console.log(err)
            Dtoast('An error occured')
            if($id == '')
            $('#order-field').html('<center>No data to be display.</center>')

        },
        success:resp=>{
            if(resp){
                var data = JSON.parse(resp);
                if(typeof data != undefined){
                    if(Object.keys(data).length > 0){
                        if($id == '' || $('#order-field').find('.card-data').length <= 0)
                        $('#order-field').html('')
                        Object.keys(data).map(k=>{
                            console.log('data', data[k]);
                            const text = [data[k].ref_id];
                            text.push(data[k].name);
                            text.push(data[k].description);
                            var card = $('#card_holder_clone .card-data').clone();
                            card.find('.card-title').html(data[k].queue)
                            card.find('.card-text').html(text.join('<br>'))
                            card.attr({'data-id':data[k].id,'data-queue':data[k].queue,'data-ref':data[k].ref_id})
                            if(data[k].serve_status == 0)
                                card.find('.card-status').html('<div class="btn btn-danger"><h4 style="color:white;">Waiting</h4></div>')
                            if(data[k].serve_status == 1)
                                card.find('.card-status').html('<div class="btn btn-warning"><h4 style="color:white;">Prapering</h4></div>')
                           else if(data[k].serve_status == 2)
                                card.find('.card-status').html('<div class="badge badge-success">Serve</div>')
                            $('#order-field').append(card);
                            load_f();


                        })
                    }else{
                        if($id == '')
                        $('#order-field').html('<center>No data to be display.</center>')
                    }
                }
            }
        },
        complete:function(){
            if($id > 0)
                notifyMe();
        }
    })
}
window.load_f = function(){
    return;
    $("#order-field .card-data").each(function(){
        $(this).click(function(){
            AjaxUniModal(75,'<?php echo base_url().'/sales/edit_order/' ?>'+$(this).attr('data-id')+'/'+$(this).attr('data-queue')+'/1','order: '+$(this).attr('data-ref'))
        })
    })
}
function renew_status($id,$status){
    if($status == 1){
        $('#order-field').find('.card-data[data-id="'+$id+'"]').find('.card-status').html('<div class="badge badge-success">Partially Served</div>')
    }else if($status == 2){
        $('#order-field').find('.card-data[data-id="'+$id+'"]').remove();
    }

    if($('#order-field').find('.card-data').length <= 0){
        $('#order-field').html('<center>No data to be display.</center>')
    }
}
function showMessage(messageHTML) {
		$('#new_chat').append('<br>'+messageHTML);
	}

	$(document).ready(function(){



		// $('#frmChat').on("submit",function(event){
		// 	event.preventDefault();
		// 	$('#chat-user').attr("type","hidden");
		// 	var messageJSON = {
		// 		chat_user: $('#chat-user').val(),
		// 		chat_message: $('#chat-message').val()
		// 	};
		// 	websocket.send(JSON.stringify(messageJSON));
		// });
        setTimeout(()=>{
            window.location.reload();
        }, 3000)
	});

</script>
