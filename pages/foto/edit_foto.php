<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Foto | Edit Foto</title>
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
            <p class="px-3 py-1 bg-[#92E3A9] text-xl rounded-md">Edit Foto</p>
        </div>
        <!-- Form Edit Foto -->
        <form action="../../config/action_foto.php" method="POST" enctype="multipart/form-data">
            <?php
            include "../../config/koneksi.php";
            $FotoID = $_GET['FotoID'];
            $sql = mysqli_query($koneksi, "SELECT * FROM foto WHERE FotoID='$FotoID'");
            while ($data = mysqli_fetch_array($sql)) {
            ?>
                <div class="grid grid-cols-2 pb-10 place-content-center gap-y-4">
                    <div class="grid justify-items-center gap-y-2">
                        <div class="flex border justify-center items-center border-gray-300 border-dashed rounded-lg w-[400px] bg-[#DEF7E5] min-h-[250px] max-h-[700px]">
                            <img class="object-contain rounded-lg img-preview-edit" src="../../assets/images/<?= $data['LokasiFile'] ?>">
                        </div>
                        <div class="grid justify-items-center">
                            <input type="file" name="LokasiFile" id="image-edit" onchange="previewImageEdit()" class="block text-sm bg-[#DEF7E5] rounded-md text-slate-500 w-[400px]
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
                        <input type="text" name="FotoID" value="<?= $data['FotoID'] ?>" hidden>
                        <div class="grid grid-cols-1">
                            <label for="JudulFoto">Judul Foto</label>
                            <input type="text" name="JudulFoto" id="JudulFoto" value="<?= $data['JudulFoto'] ?>" autofocus class="w-[500px] bg-[#DEF7E5] border border-gray-500 shadow-sm px-2 py-2 rounded-md focus:outline-none" onfocus="moveCursorToEnd(this)">
                            <?php
                            include('notifikasi_foto.php')
                            ?>
                            <script>
                                function moveCursorToEnd(input) {
                                    input.setSelectionRange(input.value.length, input.value.length);
                                }
                            </script>
                        </div>
                        <div class="grid grid-cols-1">
                            <label for="DeskripsiFoto">Deskripsi Foto</label>
                            <textarea name="DeskripsiFoto" id="DeskripsiFoto" rows="5" class="w-[500px] bg-[#DEF7E5] border border-gray-500 shadow-sm px-2 py-2 rounded-md focus:outline-none"><?= $data['DeskripsiFoto'] ?></textarea>
                        </div>
                        <div class="grid grid-cols-1">
                            <label for="AlbumID">Album</label>
                            <select name="AlbumID" id="AlbumID" class="w-[500px] bg-[#DEF7E5] border border-gray-500 shadow-sm px-2 py-2 rounded-md focus:outline-none">
                                <option disabled hidden selected>Silahkan pilih album</option>
                                <?php
                                $UserID = $_SESSION['UserID'];
                                $sql2 = mysqli_query($koneksi, "SELECT * FROM album");
                                while ($data2 = mysqli_fetch_array($sql2)) {
                                ?>
                                    <option value="<?= $data2['AlbumID'] ?>" <?php if ($data2['AlbumID'] == $data['AlbumID']) {
                                                                                    echo 'selected';
                                                                                } ?>><?= $data2['NamaAlbum'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between p-10">
                    <!-- Button Cancel -->
                    <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="px-2 py-1 text-white bg-yellow-600 rounded-md"><i class="px-2 fa-solid fa-arrow-left"></i>Cancel</a>
                    <!-- Button Edit -->
                    <button type="submit" name="edit" class="px-2 py-1 text-white bg-blue-600 rounded-md"><i class="px-2 fa-solid fa-file-arrow-up"></i>Edit</button>
                </div>
            <?php
            }
            ?>
        </form>
    </section>
    <?php
    include("../../component/footer.php")
    ?>
</body>

</html>