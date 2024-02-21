<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Foto | Home</title>
    <?php
    include("../../component/style_script.php");
    ?>
</head>

<body>
    <!-- Navbar -->
    <?php
    include("../../component/navbar.php")
    ?>

    <!-- Notifikasi Login Berhasil -->
    <?php
    $login_success = isset($_SESSION['login_success']) && $_SESSION['login_success'];
    if ($login_success) {
        $NamaLengkap = isset($_SESSION['NamaLengkap']) ? $_SESSION['NamaLengkap'] : '';
        echo "<p class='px-3 py-2 w-[350px] text-center mx-auto m-4 text-white bg-[#268EFF] rounded-md'>Selamat datang $NamaLengkap</p>";
        unset($_SESSION['login_success']);
        echo ("<script>
        setTimeout(function(){
            window.location.reload();
            }, 1000);
        </script>");
    }
    ?>

    <!-- Content -->
    <section class="px-4 py-16">

        <div class="flex items-center justify-center px-4 pb-8 gap-x-4">
            <?php
            include "../../config/koneksi.php";
            $activeAllClass = !isset($_GET['AlbumID']) ? 'bg-[#268EFF] text-white' : '';
            echo '<a href="home.php" class="py-2 px-4 border hover:bg-[#268EFF] hover:text-white border-[#268EFF] rounded-md ' . $activeAllClass . '">All</a>';

            $album = mysqli_query($koneksi, "SELECT * FROM album");
            while ($row = mysqli_fetch_array($album)) {
                $AlbumID = $row['AlbumID'];
                $activeClass = isset($_GET['AlbumID']) && $_GET['AlbumID'] == $AlbumID ? 'bg-[#268EFF] text-white' : ''; ?>
                <a href="home.php?AlbumID=<?= $row['AlbumID'] ?>" class="py-2 px-4 border hover:bg-[#268EFF] hover:text-white border-[#268EFF] <?= $activeClass ?> rounded-md">
                    <?= $row['NamaAlbum'] ?>
                </a>
            <?php } ?>
        </div>

        <div class="columns-4">
            <?php
            if (isset($_GET['AlbumID'])) {
                $AlbumID = $_GET['AlbumID'];
                $query = mysqli_query($koneksi, "SELECT foto.*, album.NamaAlbum, user.NamaLengkap FROM foto LEFT JOIN album ON foto.AlbumID = album.AlbumID LEFT JOIN user ON foto.UserID = user.UserID WHERE album.AlbumID='$AlbumID'");
            } else {
                $query = mysqli_query($koneksi, "SELECT foto.*, album.NamaAlbum, user.NamaLengkap FROM foto LEFT JOIN album ON foto.AlbumID = album.AlbumID LEFT JOIN user ON foto.UserID = user.UserID");
            }
            while ($data = mysqli_fetch_array($query)) {
            ?>
                <div class="flex flex-col p-4 mb-4 rounded-lg shadow-lg break-inside-avoid gap-y-3">
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
                    <div class="relative">
                        <img src="../../assets/images/<?= $data['LokasiFile'] ?>" alt="<?= $data['JudulFoto'] ?>" class="object-contain duration-100 ease-in-out rounded-lg cursor-zoom-in hover:brightness-50" onclick="redirect('detail_foto.php?FotoID=<?= $data['FotoID'] ?>')" onmouseover="showText('<?= $data['FotoID'] ?>')" onmouseout="hideText('<?= $data['FotoID'] ?>')">
                        <p id="userText<?= $data['FotoID'] ?>" class="absolute bottom-0 invisible px-3 py-1 text-white"><?= $data['NamaLengkap'] ?></p>
                        <script>
                            function showText(FotoID) {
                                var userText = document.getElementById("userText" + FotoID);
                                userText.classList.remove("invisible");
                            }

                            function hideText(FotoID) {
                                var userText = document.getElementById("userText" + FotoID);
                                userText.classList.add("invisible");
                            }
                        </script>
                    </div>
                    <div class="flex items-center justify-center">
                        <p class="text-center"><?= $data['JudulFoto'] ?></p>
                    </div>
                    <div class="grid grid-cols-2">
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
                            <a href="detail_foto.php?FotoID=<?= $data['FotoID'] ?>"><i class="px-1 fa-solid fa-comment-dots fa-lg text-sky-500"></i></a>
                            <?php
                            $jumlahkomen = mysqli_query($koneksi, "SELECT * FROM komentarfoto WHERE FotoID='$FotoID'");
                            echo mysqli_num_rows($jumlahkomen) . ' Komentar';
                            ?>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>

    </section>
    <?php
    include("../../component/footer.php")
    ?>
</body>

</html>