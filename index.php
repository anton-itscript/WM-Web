<?php

$conn = new mysqli("db", "root", "", "mysql");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
$result = $conn->query("show tables");
print_r($result);
$conn->close();

?>
