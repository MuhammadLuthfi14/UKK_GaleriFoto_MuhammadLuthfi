<!-- Action Register -->
<?php
session_start();
include "koneksi.php";

$Username = $_POST['Username'];
$Password = md5($_POST['Password']);
$Email = $_POST['Email'];
$NamaLengkap = $_POST['NamaLengkap'];
$Alamat = $_POST['Alamat'];

$checkNamaLengkap = mysqli_query($koneksi, "SELECT * FROM user WHERE NamaLengkap='$NamaLengkap'");
if (mysqli_num_rows($checkNamaLengkap) > 0) {
    $_SESSION['registration_failed_nama_lengkap'] = true;
}

$checkUsername = mysqli_query($koneksi, "SELECT * FROM user WHERE Username='$Username'");
if (mysqli_num_rows($checkUsername) > 0) {
    $_SESSION['registration_failed_username'] = true;
}

$checkEmail = mysqli_query($koneksi, "SELECT * FROM user WHERE Email='$Email'");
if (mysqli_num_rows($checkEmail) > 0) {
    $_SESSION['registration_failed_email'] = true;
}

if (
    isset($_SESSION['registration_failed_nama_lengkap']) ||
    isset($_SESSION['registration_failed_username']) ||
    isset($_SESSION['registration_failed_email'])
) {
    header("location:../register.php");
    exit;
}

$sql = mysqli_query($koneksi, "INSERT INTO user(UserID, Username, Password, Email, NamaLengkap, Alamat) VALUES('', '$Username', '$Password', '$Email', '$NamaLengkap', '$Alamat')");

if ($sql) {
    $_SESSION['registration_success'] = true;
    header("location:../index.php");
}

?>