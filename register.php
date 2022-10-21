<?php
include 'connection.php';
include 'cipher.php';
$nisn = $_POST["nisn"];
$fullname = $_POST["fullname"];
$school = $_POST["school"];
$fullname = $_POST["fullname"];
$username = $_POST["username"];
$password = $_POST["password"];
$password_salt = $password . $username;
$password_enk = enkripsi($password_salt);

$sql = "INSERT INTO `customer` (`nisn`, `school` ,`fullname`, `username`, `password`) VALUES ('$nisn', '$school' ,'$fullname', '$username', '$password_enk')";

if ($conn->query($sql) ==TRUE)
{ 
    echo "New Record Created Successfully";
}
else
{
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location:login.php");