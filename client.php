


<html>
<script src="./assets/js/jquery-1.12.4.min.js"></script>

    <body>
        <div align="center">
            <form id="frmChat">
                <table>
                    <tr>
                        <td>
                            <label for="">Enter MSG:</label>
                            <input type="text" id="msg">
                            <input type="submit" name="btnSend" value="send">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <textarea name="" id="" cols="30" rows="10"><?php echo isset($reply) ?$reply :''; ?></textarea>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>
<script>

$(document).ready(function(){
    var websocket = new WebSocket("ws://localhost:8090/rios/php-socket.php"); 
		// websocket.onopen = function(event) { 
		// 	showMessage("<div class='chat-connection-ack'>Connection is established!</div>");		
		// }

    $('#frmChat').on("submit",function(event){
			event.preventDefault();
			// $('#chat-user').attr("type","hidden");		
			var messageJSON = {
                type:'chat',
				chat_user: "carlo",
				chat_message: $('#msg').val()
			};
			websocket.send(JSON.stringify(messageJSON));

            $('#msg').val('')
		});
})
</script>