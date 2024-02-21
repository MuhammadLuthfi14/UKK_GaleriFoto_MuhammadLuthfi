<!-- Action Foto -->
<?php
session_start();
include 'koneksi.php';

// Tambah Foto
if (isset($_POST['create'])) {
    $JudulFoto = $_POST['JudulFoto'];
    $DeskripsiFoto = $_POST['DeskripsiFoto'];
    $TanggalUnggah = date('Y-m-d');
    $AlbumID = $_POST['AlbumID'];
    $UserID = $_SESSION['UserID'];
    $foto = $_FILES['LokasiFile']['name'];
    $tmp = $_FILES['LokasiFile']['tmp_name'];
    $lokasi = '../assets/images/';
    $namafoto = rand() . '-' . $foto;

    $check_judul_query = mysqli_query($koneksi, "SELECT * FROM foto WHERE JudulFoto='$JudulFoto'");
    if (mysqli_num_rows($check_judul_query) > 0) {
        $_SESSION['create_failed_judul_foto_exists'] = true;
        header("location:../pages/foto/tambah_foto.php");
        exit;
    }

    move_uploaded_file($tmp, $lokasi . $namafoto);

    if ($AlbumID == null) {
        $sql = mysqli_query($koneksi, "INSERT INTO foto (FotoID, JudulFoto, DeskripsiFoto, TanggalUnggah, LokasiFile, UserID) VALUES('', '$JudulFoto', '$DeskripsiFoto', '$TanggalUnggah', '$namafoto', '$UserID')");
    } else {
        $sql = mysqli_query($koneksi, "INSERT INTO foto VALUES('', '$JudulFoto', '$DeskripsiFoto', '$TanggalUnggah', '$namafoto', '$AlbumID', '$UserID')");
    }


    if ($sql) {
        $_SESSION['create_success'] = true;
        header("location:../pages/foto/foto.php");
        exit;
    }
}

// Edit Foto
if (isset($_POST['edit'])) {
    $FotoID = $_POST['FotoID'];
    $JudulFoto = $_POST['JudulFoto'];
    $DeskripsiFoto = $_POST['DeskripsiFoto'];
    $TanggalUnggah = date('Y-m-d');
    $UserID = $_SESSION['UserID'];
    $foto = $_FILES['lokasifile']['name'];
    $tmp = $_FILES['lokasifile']['tmp_name'];
    $lokasi = '../assets/images/';
    $namafoto = rand() . '-' . $foto;

    $AlbumID = isset($_POST['AlbumID']) && $_POST['AlbumID'] !== '' ? $_POST['AlbumID'] : null;

    $check_judul_query = mysqli_query($koneksi, "SELECT * FROM foto WHERE JudulFoto='$JudulFoto' AND FotoID != '$FotoID'");
    if (mysqli_num_rows($check_judul_query) > 0) {
        $_SESSION['edit_failed_judul_foto_exists'] = true;
        header("location:../pages/foto/edit_foto.php?FotoID=$FotoID");
        exit;
    }

    if ($foto == '') {
        $sql  = mysqli_query($koneksi, "UPDATE foto SET JudulFoto='$JudulFoto', DeskripsiFoto='$DeskripsiFoto', TanggalUnggah='$TanggalUnggah' " .
            ($AlbumID !== null ? ", AlbumID='$AlbumID'" : "") .
            " WHERE FotoID='$FotoID'");
    } else {
        $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE FotoID='$FotoID'");
        $data = mysqli_fetch_array($query);
        if (is_file('../assets/images/' . $data['LokasiFile'])) {
            unlink('../assets/images/' . $data['LokasiFile']);
        }
        move_uploaded_file($tmp, $lokasi . $namafoto);
        $sql  = mysqli_query($koneksi, "UPDATE foto SET JudulFoto='$JudulFoto', DeskripsiFoto='$DeskripsiFoto', TanggalUnggah='$TanggalUnggah', LokasiFile='$namafoto' " .
            ($AlbumID !== null ? ", AlbumID='$AlbumID'" : "") .
            " WHERE FotoID='$FotoID'");
    }

    $_SESSION['edit_success'] = true;
    header("location:../pages/foto/foto.php");
    exit;
}

// Hapus Foto
if (isset($_POST['delete'])) {
    $FotoID = $_POST['FotoID'];
    $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE FotoID='$FotoID'");
    $data = mysqli_fetch_array($query);
    if (is_file('../assets/images/' . $data['LokasiFile'])) {
        unlink('../assets/images/' . $data['LokasiFile']);
    }

    $sql = mysqli_query($koneksi, "DELETE FROM foto WHERE FotoID='$FotoID'");

    if ($sql) {
        $_SESSION['delete_success'] = true;
        header("location:../pages/foto/foto.php");
        exit;
    }
}

?>