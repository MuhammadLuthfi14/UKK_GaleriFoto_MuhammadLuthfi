<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Foto | Detail Foto</title>
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
        include "../../config/koneksi.php";
        $FotoID = $_GET['FotoID'];
        $query = mysqli_query($koneksi, "SELECT foto.*, album.NamaAlbum, user.NamaLengkap FROM foto LEFT JOIN album ON foto.AlbumID = album.AlbumID LEFT JOIN user ON foto.UserID = user.UserID WHERE FotoID='$FotoID'");
        while ($data = mysqli_fetch_array($query)) {
        ?>
            <div class="grid grid-cols-2 gap-4">
                <!-- Button Cancel -->
                <div class="flex col-span-2 pb-4">
                    <a href="home.php" class="px-3 py-1 font-semibold text-white bg-yellow-600 rounded-md"><i class="px-2 fa-solid fa-arrow-left fa-lg"></i>Kembali</a>
                </div>
                <div class="w-full max-h-[700px]">
                    <img src="../../assets/images/<?= $data['LokasiFile'] ?>" class="object-contain w-full h-full rounded-md" alt="<?= $data['JudulFoto'] ?>">
                </div>
                <div class="flex flex-col gap-y-5">
                    <p class="text-xl font-bold"><?= $data['JudulFoto'] ?></p>
                    <div class="flex gap-x-3">
                        <p class="px-3 py-1 text-white rounded-md bg-black/40"><?= $data['NamaLengkap'] ?></p>
                        <p class="px-3 py-1 text-white rounded-md bg-black/40"><?= $data['TanggalUnggah'] ?></p>
                        <p class="bg-[#268EFF] text-white rounded-md px-3 py-1"><?= $data['NamaAlbum'] ?></p>
                    </div>
                    <p><?= $data['DeskripsiFoto'] ?></p>
                </div>
                <div class="flex flex-col gap-y-8">
                    <div class="flex items-center justify-between">
                        <p class="font-semibold">Komentar :</p>
                        <div class="flex gap-x-4">
                            <div class="flex items-center justify-center gap-x-2">
                                <?php
                                $FotoID = $data['FotoID'];
                                $UserID = $_SESSION['UserID'];
                                $ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE FotoID='$FotoID' AND UserID='$UserID'");
                                if (mysqli_num_rows($ceksuka) == 1) { ?>
                                    <a href="../../config/proses_like.php?FotoID=<?= $data['FotoID'] ?>" type="submit" name='batalsuka'>
                                        <i class="px-1 text-red-500 fa fa-heart fa-lg"></i></a>

                                <?php } else { ?>
                                    <a href="../../config/proses_like.php?FotoID=<?= $data['FotoID'] ?>" type="submit" name='suka'>
                                        <i class="px-1 text-red-500 fa-regular fa-heart fa-lg"></i></a>

                                <?php }
                                $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE FotoID='$FotoID'");
                                echo mysqli_num_rows($like) . ' Suka';
                                ?>
                            </div>
                            <div class="flex items-center justify-center gap-x-2">
                                <p><i class="px-1 fa-solid fa-comment-dots fa-lg text-sky-500"></i></p>
                                <?php
                                $jumlahkomen = mysqli_query($koneksi, "SELECT * FROM komentarfoto WHERE FotoID='$FotoID'");
                                echo mysqli_num_rows($jumlahkomen) . ' Komentar';
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-y-3">
                        <?php
                        $FotoID = $data['FotoID'];
                        $UserID = $_SESSION['UserID'];
                        $komentar = mysqli_query($koneksi, "SELECT * FROM komentarfoto JOIN user ON komentarfoto.UserID = user.UserID WHERE FotoID='$FotoID'");
                        while ($row = mysqli_fetch_array($komentar)) {
                            $isCurrentUserComment = $row['UserID'] == $UserID;
                        ?>
                            <div class="flex flex-col px-3 py-2 bg-gray-200 rounded-lg gap-y-1">
                                <div class="flex justify-between">
                                    <div>
                                        <div class="flex gap-x-2">
                                            <p><i class="fa-solid fa-circle-user"></i></p>
                                            <p class="font-semibold"><?= $row['NamaLengkap'] ?></p>
                                            <p class="text-black/40"><?= $row['TanggalKomentar'] ?></p>
                                        </div>
                                        <p class="text-black/60"><?= $row['IsiKomentar'] ?></p>
                                    </div>

                                    <?php if ($isCurrentUserComment) : ?>
                                        <form action="../../config/proses_komentar.php" method="POST" class="flex items-center justify-center">
                                            <input type="hidden" name="KomentarID" value="<?= $row['KomentarID'] ?>">
                                            <!-- Button Hapus Komentar -->
                                            <button type="submit" name="delete-komentar" class="px-2 py-1 text-white bg-red-500 rounded-md"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    <?php endif; ?>

                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <form action="../../config/proses_komentar.php" method="POST">
                        <div class="flex gap-x-4">
                            <input type="hidden" name="FotoID" value="<?= $data['FotoID'] ?>">
                            <input type="text" name="IsiKomentar" autofocus class="w-full px-2 py-1 border border-gray-300 rounded-md bg-black/10 focus:outline-none" placeholder="Tambahkan komentar...">
                            <button type="sumbit" name="kirim-komentar" class="border border-gray-400 hover:bg-[#268EFF] hover:text-white text-[#268EFF] px-3 py-1 rounded-md font-medium">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php
        }
        ?>

    </section>
    <?php
    include("../../component/footer.php")
    ?>
</body>

</html>