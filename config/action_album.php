<!-- Action Album -->
<?php
session_start();
include 'koneksi.php';

//Tambah Album
if (isset($_POST['create'])) {
    $NamaAlbum = $_POST['NamaAlbum'];
    $Deskripsi = $_POST['Deskripsi'];
    $TanggalDibuat = date('Y-m-d');
    $UserID = $_SESSION['UserID'];

    function checkAlbumExists($koneksi, $NamaAlbum)
    {
        $query = mysqli_query($koneksi, "SELECT * FROM album WHERE NamaAlbum='$NamaAlbum'");
        return mysqli_num_rows($query) > 0;
    }

    if (checkAlbumExists($koneksi, $NamaAlbum)) {
        $_SESSION['namaalbum_exists_error'] = true;
        header("location:../pages/album/tambah_album.php");
        exit;
    }

    $sql = mysqli_query($koneksi, "INSERT INTO album VALUES('', '$NamaAlbum', '$Deskripsi', '$TanggalDibuat', '$UserID')");

    if ($sql) {
        $_SESSION['create_success'] = true;
        header("location:../pages/album/album.php");
        exit;
    }
}

//Edit Album
if (isset($_POST['edit'])) {
    $AlbumID = $_POST['AlbumID'];
    $NamaAlbum = $_POST['NamaAlbum'];
    $Deskripsi = $_POST['Deskripsi'];
    $TanggalDibuat = date('Y-m-d');
    $UserID = $_SESSION['UserID'];

    $check_album_query = mysqli_query($koneksi, "SELECT * FROM album WHERE NamaAlbum='$NamaAlbum' AND AlbumID != '$AlbumID'");
    if (mysqli_num_rows($check_album_query) > 0) {
        $_SESSION['edit_failed_nama_album'] = true;
        header("location:../pages/album/edit_album.php?AlbumID=$AlbumID");
        exit;
    }

    $sql = mysqli_query($koneksi, "UPDATE album SET NamaAlbum='$NamaAlbum', Deskripsi='$Deskripsi', TanggalDibuat='$TanggalDibuat' WHERE AlbumID='$AlbumID'");

    if ($sql) {
        $_SESSION['edit_success'] = true;
        header("location:../pages/album/album.php");
        exit;
    }
}

//Hapus Album
if (isset($_POST['delete'])) {
    $AlbumID = $_POST['AlbumID'];

    $sql = mysqli_query($koneksi, "DELETE FROM album WHERE AlbumID='$AlbumID'");

    if ($sql) {
        $_SESSION['delete_success'] = true;
        header("location:../pages/album/album.php");
        exit;
    }
}

?>
