<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Foto | Album</title>
    <?php
    include("../../component/style_script.php");
    ?>
</head>

<body>
    <!-- Navbar -->
    <?php
    include("../../component/navbar.php")
    ?>

    <!-- Notifikasi Album -->
    <?php
    include('notifikasi_album.php')
    ?>

    <!-- Content -->
    <section class="px-4 py-16">
        <!-- Button Tambah Album -->
        <div class="flex items-center justify-center pb-10">
            <a href="tambah_album.php" class="px-3 py-1 text-gray-100 bg-gray-500 rounded-md"><i class="px-2 fa-solid fa-upload"></i>Upload Album</a>
        </div>
        <div class="columns-4">
            <?php
            include "../../config/koneksi.php";
            $UserID = $_SESSION['UserID'];
            $sql = mysqli_query($koneksi, "SELECT * FROM album WHERE UserID='$UserID'");
            while ($data = mysqli_fetch_array($sql)) {
            ?>
                <div class="grid mb-4 break-inside-avoid p-4 shadow-lg gap-y-2 bg-[#7DDE99] rounded-md cursor-pointer hover:bg-[#4cc56e]" onclick="redirect('detail_album.php?AlbumID=<?= $data['AlbumID'] ?>')">
                    <div class="flex justify-end text-white">
                        <p class="px-3 py-1 rounded-md text-black/40"><?= $data['TanggalDibuat'] ?></p>
                    </div>
                    <div class="flex items-center justify-center">
                        <p class="px-3 py-1 text-white bg-gray-500 rounded-md"><?= $data['NamaAlbum'] ?></p>
                    </div>
                    <?php
                    $AlbumID = $data['AlbumID'];
                    $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE AlbumID='$AlbumID'");
                    $num_photos = mysqli_num_rows($query);

                    $columns = 1;
                    if ($num_photos >= 2 && $num_photos <= 4) {
                        $columns = 2;
                    }
                    $num_photos_to_display = min($num_photos, 4);
                    if ($num_photos == 3) {
                        $num_photos_to_display = 2;
                    }

                    ?>

                    <div class="duration-100 ease-in-out grid grid-cols-<?php echo $columns; ?> hover:brightness-50">
                        <?php
                        $counter = 0;
                        while ($row = mysqli_fetch_array($query)) {
                            if ($counter >= $num_photos_to_display) {
                                break;
                            }
                            $image_class = $num_photos_to_display == 1 ? 'object-contain' : 'object-cover';
                        ?>
                            <div class="flex w-full h-32">
                                <img src="../../assets/images/<?= $row['LokasiFile'] ?>" class="w-full h-full <?= $image_class ?>" alt="<?= $row['JudulFoto'] ?>">
                            </div>
                        <?php
                            $counter++;
                        }
                        ?>
                    </div>


                    <div>
                        <p class="text-justify"><?= $data['Deskripsi'] ?></p>
                    </div>
                    <div class="grid grid-cols-2">
                        <!-- Button Edit Album -->
                        <div class="flex items-center justify-center">
                            <a href="edit_album.php?AlbumID=<?= $data['AlbumID'] ?>" class="px-2 py-1 text-yellow-500 rounded-md hover:bg-gray-500"><i class="px-2 fa-solid fa-pen-to-square"></i>Edit</a>
                        </div>
                        <!-- Button Hapus -->
                        <form action="../../config/action_album.php" method="POST" class="flex items-center justify-center">
                            <input type="text" name="AlbumID" value="<?= $data['AlbumID'] ?>" hidden>
                            <button type="submit" name="delete" onclick="return confirm('Apakah anda yakin akan menghapus album <?= $data['NamaAlbum'] ?>')" class="px-2 py-1 text-red-600 rounded-md hover:bg-gray-500"><i class="px-2 fa-solid fa-trash"></i>Hapus</button>
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