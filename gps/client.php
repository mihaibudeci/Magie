<?php
error_reporting(E_ALL);

echo "<h2>Connection TCP/IP</h2>\n";


$service_port = 8005;

$address = gethostbyname('127.0.0.1');

/* Create TCP/IP. */
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($socket === false) {
    echo "Can't connect socket_create(): issue: " . socket_strerror(socket_last_error()) . "\n";
} else {
    echo "OK \n";
}

echo "Try to connect '$address' port '$service_port'...";
$result = socket_connect($socket, $address, $service_port);
if ($result === false) {
    echo "Can't run socket_connect().\nIssue: ($result) " . socket_strerror(socket_last_error($socket)) . "\n";
} else {
    echo "OK.\n";
}

$in = "HEAD / HTTP/1.1\n";
$in .= "Host: localhost\n";
$in .= "Connection: Close\n\n";
$out = '';

echo "Sending HTTP...";
socket_write($socket, $in, strlen($in));
echo "OK.\n";

echo "Reading answer:\n\n";
while ($out = socket_read($socket, 2048)) {
    echo $out;
}

echo "Closing socket...";
socket_close($socket);
echo "OK.\n\n";
?>