<!-- Footer Website -->
<?php
include '../../config/koneksi.php';

$UserID = $_SESSION['UserID'];

$query_album = mysqli_query($koneksi, "SELECT * FROM album WHERE UserID='$UserID'");
$query_foto = mysqli_query($koneksi, "SELECT * FROM foto WHERE UserID='$UserID'");

$num_album = mysqli_num_rows($query_album);
$num_foto = mysqli_num_rows($query_foto);

$mt = $num_album == 0 && $num_foto == 0 ? 'mt-[440px]' : 'mt-20';
?>

<div class="flex items-center justify-center w-full py-4 <?php echo $mt; ?> border-t border-gray-300">
    <p class="text-lg font-semibold">Copyright &#169;2024 By Muhammad Luthfi</p>
</div>
