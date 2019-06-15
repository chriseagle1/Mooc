<?php
$handle = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

socket_connect($handle, '127.0.0.1', 8899);

socket_write($handle, 'hello server!');

echo socket_read($handle, 1024);
socket_close($handle);