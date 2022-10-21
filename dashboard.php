<?php
session_start();

if (!isset($_SESSION['id'])) {
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Anda belum login');
    window.location.href='login.php';
    </script>");
} else {
    include 'connection.php';
    include 'decrypt.php';
    $id = $_SESSION['id'];
    $query = "SELECT * FROM `customer` WHERE `cust_id` = '$id' LIMIT 1";
    $data = mysqli_query($conn, $query);
    $result = mysqli_fetch_assoc($data);
    $username = $result['username'];
    $password_enc = $result['password'];
    $password_dec = dekripsi($password_enc);
    $shown_pass = explode($username, strtolower($password_dec));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">Dashboard Site</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <a class="nav-link bg-dark shadow-none px-3" data-bs-toggle="modal" data-bs-target="#showLogoutModal">Logout</a>
            </div>
        </div>
    </header>

    <div class="modal fade" id="showLogoutModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="showLogoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="showLogoutModalLabel">Logout</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Anda yakin untuk logout?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a type="submit" class="btn btn-danger logoutModalButton" id="logoutModalButton" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3 sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">
                                <span data-feather="home" class="align-text-bottom"></span>
                                Dashboard
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                </div>
                <div class="h-100 p-5 bg-light border rounded-3">
                    <h2>Selamat Datang!</h2>
                    <table style="font-size:large;">
                        <tr>
                            <td><b>NISN</b></td>
                            <td>&nbsp;</td>
                            <td><?php echo $result['nisn']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Nama</b></td>
                            <td>&nbsp;</td>
                            <td><?php echo $result['fullname']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Asal Sekolah</b></td>
                            <td>&nbsp;</td>
                            <td><?php echo $result['school']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Username</b></td>
                            <td>&nbsp;</td>
                            <td><?php echo $result['username']; ?></td>
                        </tr>
                    </table>
                    <br>
                    <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#showPasswordModal">Lihat password</button>
                    <div class="modal modal-sm fade" id="showPasswordModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="showPasswordModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="showPasswordModalLabel">Info Login</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <table>
                                        <tr>
                                            <td><b>Username</b></td>
                                            <td>&nbsp;</td>
                                            <td><?php echo $result['username']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Password</b></td>
                                            <td>&nbsp;</td>
                                            <td><?php echo $shown_pass[0]; ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>