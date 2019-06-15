<?php
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if (!$socket) {
    die('create socket failed!');
}
socket_bind($socket, '0.0.0.0', 8899);
socket_listen($socket);
$sock = socket_accept($socket);

$str = socket_read($sock, 1024);

echo $str . "\n";

socket_write($sock, 'hello client!');

socket_close($sock);

