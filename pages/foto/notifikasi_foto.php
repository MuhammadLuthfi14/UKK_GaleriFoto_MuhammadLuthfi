<!-- Notifikasi Tambah Foto -->
<?php
$create_success = isset($_SESSION['create_success']) && $_SESSION['create_success'];
if ($create_success) {
    echo "<p class='px-3 py-2 w-[350px] text-center mx-auto m-4 text-white bg-[#268EFF] rounded-md'>Data foto telah ditambahkan</p>";
    unset($_SESSION['create_success']);
    echo ("<script>
    setTimeout(function(){
        window.location.reload();
        }, 1000);
    </script>");
}
?>

<!-- Notifikasi Edit Foto -->
<?php
$edit_success = isset($_SESSION['edit_success']) && $_SESSION['edit_success'];
if ($edit_success) {
    echo "<p class='px-3 py-2 w-[350px] text-center mx-auto m-4 text-white bg-[#268EFF] rounded-md'>Data foto berhasil diedit</p>";
    unset($_SESSION['edit_success']);
    echo ("<script>
    setTimeout(function(){
        window.location.reload();
        }, 1000);
    </script>");
}
?>

<!-- Notifikasi Hapus Foto -->
<?php
$delete_success = isset($_SESSION['delete_success']) && $_SESSION['delete_success'];
if ($delete_success) {
    echo "<p class='px-3 py-2 w-[350px] text-center mx-auto m-4 text-white bg-[#268EFF] rounded-md'>Data foto berhasil dihapus</p>";
    unset($_SESSION['delete_success']);
    echo ("<script>
    setTimeout(function(){
        window.location.reload();
        }, 1000);
    </script>");
}
?>

<!-- Notifikasi Judul Foto -->
<?php
$create_failed_judul_foto_exists = isset($_SESSION['create_failed_judul_foto_exists']) && $_SESSION['create_failed_judul_foto_exists'];
if ($create_failed_judul_foto_exists) {
    echo "<p class='py-2 text-red-500 rounded-md'>Judul foto sudah ada!</p>";
    unset($_SESSION['create_failed_judul_foto_exists']);
}
?>

<!-- Notifikasi Edit Judul Foto -->
<?php
$edit_failed_judul_foto_exists = isset($_SESSION['edit_failed_judul_foto_exists']) && $_SESSION['edit_failed_judul_foto_exists'];
if ($edit_failed_judul_foto_exists) {
    echo "<p class='py-2 text-red-500 rounded-md'>Judul foto sudah ada!</p>";
    unset($_SESSION['edit_failed_judul_foto_exists']);
}
?>