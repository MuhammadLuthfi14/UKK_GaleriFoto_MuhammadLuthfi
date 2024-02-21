<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Foto | Detail Album</title>
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
    <section class="px-4 py-4">
        <?php
        include('notifikasi_album.php')
        ?>

        <?php
        include "../../config/koneksi.php";
        $AlbumID = $_GET['AlbumID'];

        $query_album = mysqli_query($koneksi, "SELECT NamaAlbum FROM album WHERE AlbumID='$AlbumID'");
        $nama_album = "";
        if ($row_album = mysqli_fetch_assoc($query_album)) {
            $nama_album = $row_album['NamaAlbum'];
        }
        ?>

        <!-- Button Cancel -->
        <div class="flex pb-4">
            <a href="album.php" class="px-3 py-1 font-semibold text-white bg-yellow-600 rounded-md"><i class="px-2 fa-solid fa-arrow-left fa-lg"></i>Kembali</a>
        </div>

        <div class="flex items-center justify-center text-center pb-14">
            <p class="px-3 py-1 bg-[#92E3A9] text-lg font-medium rounded-md">Album <?= $nama_album ?></p>
        </div>
        <div class="columns-4">
            <?php
            $UserID = $_SESSION['UserID'];
            $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE AlbumID='$AlbumID' AND UserID='$UserID'");
            while ($data = mysqli_fetch_array($query)) {
            ?>
                <div class="grid p-4 mb-4 break-inside-avoid gap-y-4 bg-[#7DDE99] border border-gray-300 rounded-md">
                    <div class="flex justify-end text-white">
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
                        <div class="flex items-center justify-center">
                            <a href="../../pages/foto/edit_foto.php?FotoID=<?= $data['FotoID'] ?>" class="px-2 py-1 text-yellow-500 rounded-md hover:bg-gray-500"><i class="px-2 fa-solid fa-pen-to-square"></i>Edit</a>
                        </div>
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