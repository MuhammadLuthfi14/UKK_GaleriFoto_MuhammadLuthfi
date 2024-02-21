<!-- Proses Like -->
<?php
session_start();
include 'koneksi.php';

$FotoID = $_GET['FotoID'];
$UserID = $_SESSION['UserID'];

$ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE FotoID='$FotoID' AND UserID='$UserID'");

// Kirim Like
if (mysqli_num_rows($ceksuka) == 1) {
    while ($row = mysqli_fetch_array($ceksuka)) {
        $LikeID = $row['LikeID'];
        $query = mysqli_query($koneksi, "DELETE FROM likefoto WHERE LikeID='$LikeID'");
        header("location: {$_SERVER['HTTP_REFERER']}");
    }
}

// Batal Like
else {
    $TanggalLike = date('Y-m-d');
    $query = mysqli_query($koneksi, "INSERT INTO likefoto VALUES('', '$FotoID', '$UserID', '$TanggalLike')");
    header("location: {$_SERVER['HTTP_REFERER']}");
}

?>