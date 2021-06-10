<?php
$servername = "localhost";
$username = "username";
$password = "password";
$conn = mysql_connect($servername, $username, $password);

if (! $conn ) {
  die("Connection failed: " .  . mysql_error());
}

$sql = "CREATE DATABASE myDB";
$retval = mysql_query( $sql, $conn );
if (! $retval) {
      die('Could not create database: ' . mysql_error());
   }
      echo "Database test_db created successfully\n";
$conn->close();
?>
