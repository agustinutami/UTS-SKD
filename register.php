<?php
include 'connection.php';
include 'cipher.php';
$fullname = $_POST["fullname"];
$username = $_POST["username"];
$password = $_POST["password"];
$password_salt = $password . $username;
$password_enk = enkripsi($password_salt);

$sql = "INSERT INTO customer (fullname, username, password) VALUES ('$fullname', '$username', '$password_enk')";

if ($conn->query($sql) ===TRUE)
{ 
    echo "New Record Created Successfully";
}
else
{
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location:login.php");