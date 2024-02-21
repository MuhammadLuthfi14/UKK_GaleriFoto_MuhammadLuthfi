<!-- Action Login -->
<?php
session_start();
include "koneksi.php";

$Username = $_POST['Username'];
$Password = md5($_POST['Password']);

$sql = mysqli_query($koneksi, "SELECT * FROM user WHERE Username='$Username' AND Password='$Password'");
$cek = mysqli_num_rows($sql);

if ($cek == 1) {
    while ($data = mysqli_fetch_array($sql)) {
        $_SESSION['UserID'] = $data['UserID'];
        $_SESSION['NamaLengkap'] = $data['NamaLengkap'];
    }
    $_SESSION['login_success'] = true;
    header("location:../pages/home/home.php");
    exit;
} else {
    $cekUsername = mysqli_query($koneksi, "SELECT * FROM user WHERE Username='$Username'");
    $cekPassword = mysqli_query($koneksi, "SELECT * FROM user WHERE Password='$Password'");
    if (mysqli_num_rows($cekUsername) > 0) {
        $_SESSION['login_failed_password'] = true;
        header("location:../index.php");
        exit;
    }
    if (mysqli_num_rows($cekPassword) > 0) {
        $_SESSION['login_failed_username'] = true;
        header("location:../index.php");
        exit;
    }
    $_SESSION['login_failed_username'] = true;
    $_SESSION['login_failed_password'] = true;
    header("location:../index.php");
    exit;
}

?>