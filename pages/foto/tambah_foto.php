<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Foto | Tambah Foto</title>
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
            <p class="px-3 py-1 bg-[#92E3A9] text-xl rounded-md">Tambah Foto</p>
        </div>
        <!-- Form Tambah Foto -->
        <form action="../../config/action_foto.php" method="POST" enctype="multipart/form-data">
            <div class="grid grid-cols-2 pb-10 place-content-center gap-y-4">
                <div class="grid justify-items-center gap-y-2">
                    <div class="flex border justify-center items-center border-gray-300 border-dashed rounded-lg w-[400px] bg-[#DEF7E5] min-h-[250px] max-h-[700px]">
                        <p id="uploadText" class="text-center"><i class="fa-solid fa-image fa-2xl"></i><br>Upload Foto</p>
                        <img class="object-contain rounded-lg img-preview">
                    </div>
                    <div class="grid justify-items-center">
                        <input type="file" name="LokasiFile" id="image" onchange="previewImage()" required class="block text-sm bg-[#DEF7E5] rounded-md text-slate-500 w-[400px]
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-md file:border-0
                        file:text-sm file:font-semibold
                        file:bg-[#92E3A9]
                        file:hover:bg-[#4cc56e]
                        cursor-pointer
                        file:cursor-pointer
                    " />
                    </div>
                </div>
                <div>
                    <div class="grid grid-cols-1">
                        <label for="JudulFoto">Judul Foto</label>
                        <input type="text" name="JudulFoto" id="JudulFoto" required autofocus class="w-[500px] bg-[#DEF7E5] border border-gray-500 shadow-sm px-2 py-2 rounded-md focus:outline-none">
                        <?php
                        include('notifikasi_foto.php')
                        ?>
                    </div>
                    <div class="grid grid-cols-1">
                        <label for="DeskripsiFoto">Deskripsi Foto</label>
                        <textarea name="DeskripsiFoto" id="DeskripsiFoto" rows="5" required class="w-[500px] bg-[#DEF7E5] border border-gray-500 shadow-sm px-2 py-2 rounded-md focus:outline-none"></textarea>
                    </div>
                    <div class="grid grid-cols-1">
                        <label for="AlbumID">Album</label>
                        <select name="AlbumID" id="AlbumID" required class="w-[500px] bg-[#DEF7E5] border border-gray-500 shadow-sm px-2 py-2 rounded-md focus:outline-none">
                            <option disabled hidden selected>Silahkan pilih album</option>
                            <?php
                            include "../../config/koneksi.php";
                            $UserID = $_SESSION['UserID'];
                            $sql = mysqli_query($koneksi, "SELECT * FROM album");
                            while ($data = mysqli_fetch_array($sql)) {
                            ?>
                                <option value="<?= $data['AlbumID'] ?>"><?= $data['NamaAlbum'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-between p-10">
                <!-- Button Cancel -->
                <a href="foto.php" class="px-2 py-1 text-white bg-yellow-600 rounded-md"><i class="px-2 fa-solid fa-arrow-left"></i>Cancel</a>
                <!-- Button Cancel -->
                <button type="submit" name="create" class="px-2 py-1 text-white bg-blue-600 rounded-md"><i class="px-2 fa-solid fa-file-arrow-up"></i>Create</button>
            </div>
        </form>
    </section>
    <?php
    include("../../component/footer.php")
    ?>
</body>

</html>