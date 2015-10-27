<?php

$conn = new mysqli("db", "admin", "gfhjkm", "mysql");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
$result = $conn->query("show tables");
print_r($result);
$conn->close();

?>
