<?php
include 'connection.php';
include 'cipher.php';
$username = $_POST["username"];
$password = $_POST["password"];
$password_salt = $password . $username;
$password_enk = enkripsi($password_salt);
echo $password_enk;

$sql = "SELECT `cust_id`, `username`, `password` FROM `customer` WHERE `username`='$username' AND `password`='$password_enk' LIMIT 1";
$data = mysqli_query($conn, $sql);

if ($data->num_rows > 0)
{
    $result = mysqli_fetch_assoc($data);
    session_start();
    $_SESSION["id"]  = $result['cust_id'];
    echo("<script LANGUAGE='JavaScript'>
    window.alert('Login Succesfully');
    window.location.href='../uts/dashboard.php';
    </script>
    ");
}
else
{
    echo("<script LANGUAGE='JavaScript'>
    window.alert('Login gagal');
    window.location.href='../uts/login.php';
    </script>");
}

$conn->close();