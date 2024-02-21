<!-- Notifikasi Tambah Album -->
<?php
$create_success = isset($_SESSION['create_success']) && $_SESSION['create_success'];
if ($create_success) {
    echo "<p class='px-3 py-2 w-[350px] text-center mx-auto m-4 text-white bg-[#268EFF] rounded-md'>Data album telah ditambahkan</p>";
    unset($_SESSION['create_success']);
    echo ("<script>
    setTimeout(function(){
        window.location.reload();
        }, 1000);
    </script>");
}
?>

<!-- Notifikasi Edit Album -->
<?php
$edit_success = isset($_SESSION['edit_success']) && $_SESSION['edit_success'];
if ($edit_success) {
    echo "<p class='px-3 py-2 w-[350px] text-center mx-auto m-4 text-white bg-[#268EFF] rounded-md'>Data album berhasil diedit</p>";
    unset($_SESSION['edit_success']);
    echo ("<script>
    setTimeout(function(){
        window.location.reload();
        }, 1000);
    </script>");
}
?>

<!-- Notifikasi Hapus Album -->
<?php
$delete_success = isset($_SESSION['delete_success']) && $_SESSION['delete_success'];
if ($delete_success) {
    echo "<p class='px-3 py-2 w-[350px] text-center mx-auto m-4 text-white bg-[#268EFF] rounded-md'>Data album berhasil dihapus</p>";
    unset($_SESSION['delete_success']);
    echo ("<script>
    setTimeout(function(){
        window.location.reload();
        }, 1000);
    </script>");
}
?>

<!-- Notifikasi Nama Album -->
<?php
$namaalbum_exists_error = isset($_SESSION['namaalbum_exists_error']) && $_SESSION['namaalbum_exists_error'];
if ($namaalbum_exists_error) {
    echo "<p class='py-2 text-red-500 rounded-md'>Nama album sudah ada!</p>";
    unset($_SESSION['namaalbum_exists_error']);
}
?>

<!-- Notifikasi Edit Nama Album -->
<?php
$edit_failed_nama_album = isset($_SESSION['edit_failed_nama_album']) && $_SESSION['edit_failed_nama_album'];
if ($edit_failed_nama_album) {
    echo "<p class='py-2 text-red-500 rounded-md'>Nama album sudah ada!</p>";
    unset($_SESSION['edit_failed_nama_album']);
}
?>