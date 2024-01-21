<?php
$host = "127.0.0.1";
$port = 2306;
// don't timeout!
set_time_limit(0);
// create socket
$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
// bind socket to port
$result = socket_bind($socket, $host, $port) or die("Could not bind to socket\n");
// start listening for connections
$result = socket_listen($socket, 3) or die("Could not set up socket listener\n");
echo "Listening for connections...\n";

class Chat{
    function readLine(){
        return rtrim(fgets(STDIN));
    }
}
do{
    $accept = socket_accept($socket)or die("Could not accept incoming connection");
    // echo $accept;
    $msg = socket_read($accept,1024);
    if(!$msg){
        echo "could not read input.\n";
    }else{
        
    $msg= trim($msg);
    echo "Client Says:\t".$msg."\n\n";
    // echo "Enter Reply:\t";

    $line = new Chat();
    // echo "Enter Reply:\t";
    // $reply =$line->readline();

    socket_write($accept,$msg,strlen($msg)) or die("could not write output.\n");
    }
}while(true);
socket_close($accept,$socket);