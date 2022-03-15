<?php 
echo '<body>';
echo '<h1>Hello</h1>';
echo '<script>';
echo "const conn = new WebSocket('wss://ws.localhost');";
echo 'conn.onopen = function (e) {';
echo 'console.log("Connection established!");';
echo '};';
echo 'conn.onmessage = function (e) {';
echo 'console.log(e.data);';
echo '};';
echo '</script>';
echo '</body>';
?>