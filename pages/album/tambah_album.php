<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Foto | Tambah Album</title>
    <?php
    include("../../component/style_script.php");
    ?>
</head>

<body>
    <!-- Navbar -->
    <?php
    include("../../component/navbar.php")
    ?>

    <!-- Content -->
    <section class="px-4 py-16">
        <div class="flex items-center justify-center pb-10">
            <p class="px-3 py-1 bg-[#92E3A9] rounded-md">Tambah Album</p>
        </div>
        <!-- Form Tambah Album  -->
        <form action="../../config/action_album.php" method="POST">
            <div class="flex flex-col items-center justify-center pb-10 gap-y-4">
                <div class="grid grid-cols-1">
                    <label for="NamaAlbum">Nama Album</label>
                    <input type="text" name="NamaAlbum" id="NamaAlbum" required autofocus class="w-[500px] bg-[#DEF7E5] border border-gray-500 shadow-sm px-2 py-2 rounded-md focus:outline-none">
                    <?php
                    include('notifikasi_album.php')
                    ?>
                </div>
                <div class="grid grid-cols-1">
                    <label for="Deskripsi">Deskripsi Album</label>
                    <textarea name="Deskripsi" id="Deskripsi" rows="5" required class="w-[500px] bg-[#DEF7E5] border border-gray-500 shadow-sm px-2 py-2 rounded-md focus:outline-none"></textarea>
                </div>
            </div>
            <div class="flex items-center justify-between p-10">
                <!-- Button Cancel -->
                <a href="album.php" class="px-2 py-1 text-white bg-yellow-600 rounded-md"><i class="px-2 fa-solid fa-arrow-left"></i>Cancel</a>
                <!-- Button Tambah -->
                <button type="submit" name="create" class="px-2 py-1 text-white bg-blue-600 rounded-md"><i class="px-2 fa-solid fa-file-arrow-up"></i>Create</button>
            </div>
        </form>
    </section>
    <?php
    include("../../component/footer.php")
    ?>
</body>

</html>