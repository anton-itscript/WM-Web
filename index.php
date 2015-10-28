<?php

$conn = new mysqli("db", "wm", "wm_pass", "mysql");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
$result = $conn->query("show tables");
print_r($result);
$conn->close();

?>
