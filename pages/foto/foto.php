<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Foto | Foto</title>
    <?php
    include("../../component/style_script.php");
    ?>
</head>

<body>
    <!-- Navbar -->
    <?php
    include("../../component/navbar.php")
    ?>

    <!-- Notifikasi Foto -->
    <?php
    include('notifikasi_foto.php')
    ?>

    <!-- Content -->
    <section class="px-4 py-16">
        <div class="flex items-center justify-center pb-10">
            <a href="tambah_foto.php" class="px-3 py-1 text-gray-100 bg-gray-500 rounded-md"><i class="px-2 fa-solid fa-upload"></i>Upload Foto</a>
        </div>
        <div class="columns-4">
            <?php
            include "../../config/koneksi.php";
            $UserID = $_SESSION['UserID'];
            $sql = mysqli_query($koneksi, "SELECT foto.*, album.NamaAlbum FROM foto LEFT JOIN album ON foto.AlbumID = album.AlbumID WHERE foto.UserID='$UserID'");
            while ($data = mysqli_fetch_array($sql)) {
            ?>
                <div class="grid p-4 mb-4 break-inside-avoid gap-y-4 bg-[#7DDE99] shadow-lg rounded-md">
                    <div class="flex justify-between text-white">
                        <?php
                        if ($data['NamaAlbum'] !== null) {
                            echo '<p class="px-3 py-1 rounded-md bg-[#268EFF]">' . $data['NamaAlbum'] . '</p>';
                        } else {
                            echo '<p>' . '</p>';
                        }
                        ?>
                        <p class="px-3 py-1 rounded-md text-black/40"><?= $data['TanggalUnggah'] ?></p>
                    </div>
                    <div class="flex items-center justify-center">
                        <p class="px-3 py-1 text-white bg-gray-500 rounded-md"><?= $data['JudulFoto'] ?></p>
                    </div>
                    <div>
                        <img src="../../assets/images/<?= $data['LokasiFile'] ?>" alt="<?= $data['JudulFoto'] ?>" class="rounded-lg">
                    </div>
                    <div>
                        <p class="text-justify"><?= $data['DeskripsiFoto'] ?></p>
                    </div>
                    <div class="grid grid-cols-2">
                        <!-- Button Edit -->
                        <div class="flex items-center justify-center">
                            <a href="edit_foto.php?FotoID=<?= $data['FotoID'] ?>" class="px-2 py-1 text-yellow-500 rounded-md hover:bg-gray-500"><i class="px-2 fa-solid fa-pen-to-square"></i>Edit</a>
                        </div>
                        <!-- Button Hapus -->
                        <form action="../../config/action_foto.php" method="POST" class="flex items-center justify-center">
                            <input type="text" name="FotoID" value="<?= $data['FotoID'] ?>" hidden>
                            <button type="submit" name="delete" onclick="return confirm('Apakah anda yakin akan menghapus foto <?= $data['JudulFoto'] ?>')" class="px-2 py-1 text-red-600 rounded-md hover:bg-gray-500"><i class="px-2 fa-solid fa-trash"></i>Hapus</button>
                        </form>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </section>
    <?php
    include("../../component/footer.php")
    ?>
</body>

</html>