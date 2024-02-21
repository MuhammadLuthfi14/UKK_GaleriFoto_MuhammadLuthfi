<!-- Navbar Website -->
<div class="flex items-center justify-between py-5 border-b border-gray-300 shadow-sm">
    <div class="flex items-center justify-center px-5 gap-x-2">
        <img src="../../assets/images/material/logo.png" class="w-14 h-14" alt="Logo Website">
        <p class="text-2xl">Galeri Foto</p>
    </div>
    <div class="flex gap-x-10">
        <a href="../home/home.php" class="px-4 py-2 rounded-md hover:bg-[#4cc56e] <?php if (basename($_SERVER['REQUEST_URI']) == "home.php") {echo ("bg-[#92E3A9] hover:bg-[#4cc56e]");} ?>"><i class="px-2 fa-solid fa-house"></i>Home</a>
        <a href="../album/album.php" class="px-4 py-2 rounded-md hover:bg-[#4cc56e] <?php $currentPage = basename($_SERVER['REQUEST_URI']); if ($currentPage == "album.php" || $currentPage == "tambah-album.php" || $currentPage == "edit-album.php") {echo ("bg-[#92E3A9] hover:bg-[#4cc56e]");} ?>"><i class="px-2 fa-regular fa-images"></i>Album</a>
        <a href="../foto/foto.php" class="px-4 py-2 rounded-md hover:bg-[#4cc56e] <?php $currentPage = basename($_SERVER['REQUEST_URI']); if ($currentPage == "foto.php" || $currentPage == "tambah-foto.php" || $currentPage == "edit-foto.php") {echo ("bg-[#92E3A9] hover:bg-[#4cc56e]");} ?>"><i class="px-2 fa-solid fa-image"></i>Foto</a>
    </div>
    <div class="px-5">
        <a href="../../config/action_logout.php" class="px-4 py-2 rounded-md bg-[#92E3A9] hover:bg-[#4cc56e]"><i class="px-2 fa-solid fa-right-from-bracket"></i>Logout</a>
    </div>
</div>

<?php
    session_start();
    if(!isset($_SESSION['UserID'])){
        header("location:../../index.php");
    }
?>