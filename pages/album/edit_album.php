<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Foto | Edit Album</title>
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
            <p class="px-3 py-1 bg-[#92E3A9] text-lg rounded-md">Edit Album</p>
        </div>
        <!-- Form Edit Album -->
        <form action="../../config/action_album.php" method="POST">
            <?php
            include "../../config/koneksi.php";
            $AlbumID = $_GET['AlbumID'];
            $sql = mysqli_query($koneksi, "SELECT * FROM album WHERE AlbumID='$AlbumID'");
            while ($data = mysqli_fetch_array($sql)) {
            ?>
                <div class="flex flex-col items-center justify-center pb-10 gap-y-4">
                    <input type="text" name="AlbumID" value="<?= $data['AlbumID'] ?>" hidden>
                    <div class="grid grid-cols-1">
                        <label for="NamaAlbum">Nama Album</label>
                        <input type="text" name="NamaAlbum" id="NamaAlbum" value="<?= $data['NamaAlbum'] ?>" autofocus class="w-[500px] bg-[#DEF7E5] border border-gray-500 shadow-sm px-2 py-2 rounded-md focus:outline-none" onfocus="moveCursorToEnd(this)">
                        <?php
                        include('notifikasi_album.php')
                        ?>
                        <script>
                            function moveCursorToEnd(input) {
                                input.setSelectionRange(input.value.length, input.value.length);
                            }
                        </script>
                    </div>
                    <div class="grid grid-cols-1">
                        <label for="Deskripsi">Deskripsi Album</label>
                        <textarea name="Deskripsi" id="Deskripsi" rows="5" class="w-[500px] bg-[#DEF7E5] border border-gray-500 shadow-sm px-2 py-2 rounded-md focus:outline-none"><?= $data['Deskripsi'] ?></textarea>
                    </div>
                </div>
                <div class="flex items-center justify-between p-10">
                    <!-- Button Cancel -->
                    <a href="album.php" class="px-2 py-1 text-white bg-yellow-600 rounded-md"><i class="px-2 fa-solid fa-arrow-left"></i>Cancel</a>
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