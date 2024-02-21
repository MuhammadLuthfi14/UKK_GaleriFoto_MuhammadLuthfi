<!-- Proses Komentar -->
<?php
session_start();
include 'koneksi.php';

// Kirim Komentar
if (isset($_POST['kirim-komentar'])) {
    $FotoID = $_POST['FotoID'];
    $UserID = $_SESSION['UserID'];
    $IsiKomentar = $_POST['IsiKomentar'];
    $TanggalKomentar = date('Y-m-d');

    $query = mysqli_query($koneksi, "INSERT INTO komentarfoto VALUES('', '$FotoID', '$UserID', '$IsiKomentar', '$TanggalKomentar')");

    header("location: {$_SERVER['HTTP_REFERER']}");
}

// Hapus Komentar
if (isset($_POST['delete-komentar'])) {
    $KomentarID = $_POST['KomentarID'];

    $sql = mysqli_query($koneksi, "DELETE FROM komentarfoto WHERE KomentarID='$KomentarID'");

    header("location: {$_SERVER['HTTP_REFERER']}");
}

?>