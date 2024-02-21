<?php
session_start();
if (isset($_SESSION['UserID'])) {
    header("location:./pages/home/home.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Foto | Register</title>
    <?php
    include("./component/style_script.php");
    ?>
</head>

<body>
    <!-- Content -->
    <section class="grid w-full h-screen bg-gray-100 place-items-center">
        <div class="bg-[#92E3A9] rounded-2xl md:w-[900px] lg:w-[900px] xl:w-[1000px] h-[600px] shadow-2xl grid grid-cols-1 md:grid-cols-2 overflow-hidden">
            <div class="hidden md:w-[450px] lg:w-[450px] xl:w-[500px] h-full bg-[#92E3A9] justify-center items-center md:flex mx-auto">
                <img src="./assets/images/material/background-register.png" alt="Background Register" class="my-auto w-[500px] h-[500px]">
            </div>

            <div class="flex flex-col md:w-[450px] lg:w-[450px] xl:w-[500px] h-full px-10 bg-[#92E3A9] py-7">
                <div class="pb-6 text-center">
                    <h1 class="text-2xl font-semibold text-black capitalize font-poppins">Selamat Datang !</h1>
                    <p class="text-base text-black/80">Silahkan register | Masukkan data anda</p>
                </div>

                <!-- Form register -->
                <form action="config/action_register.php" method="POST">
                    <div>
                        <div class="grid items-start w-full grid-cols-1 gap-y-3">
                            <div class="grid grid-cols-1">
                                <label class="text-base text-black" for="NamaLengkap">Nama Lengkap</label>
                                <input type="text" name="NamaLengkap" id="NamaLengkap" required autofocus placeholder="Masukan nama lengkap" class="w-full bg-[#DEF7E5] border border-gray-500 shadow-sm px-2 py-2 rounded-md focus:outline-none">
                                <?php
                                $registration_failed_nama_lengkap = isset($_SESSION['registration_failed_nama_lengkap']) && $_SESSION['registration_failed_nama_lengkap'];
                                if ($registration_failed_nama_lengkap) {
                                    echo "<p class='pt-2 text-red-500 rounded-md'>Nama lengkap sudah ada!</p>";
                                    unset($_SESSION['registration_failed_nama_lengkap']);
                                }
                                ?>
                            </div>

                            <div class="grid grid-cols-2 gap-x-2">
                                <div class="">
                                    <label class="text-base text-black" for="Username">Username</label>
                                    <input type="text" name="Username" id="Username" required placeholder="Masukan username" class="w-full bg-[#DEF7E5] border border-gray-500 shadow-sm px-2 py-2 rounded-md focus:outline-none">
                                    <?php
                                    $registration_failed_username = isset($_SESSION['registration_failed_username']) && $_SESSION['registration_failed_username'];
                                    if ($registration_failed_username) {
                                        echo "<p class='pt-2 text-red-500 rounded-md'>Username sudah ada!</p>";
                                        unset($_SESSION['registration_failed_username']);
                                    }
                                    ?>
                                </div>
                                <div class="">
                                    <label class="text-base text-black" for="Email">Email</label>
                                    <input type="email" name="Email" id="Email" required placeholder="contoh@gmail.com" class="w-full bg-[#DEF7E5] border border-gray-500 shadow-sm px-2 py-2 rounded-md focus:outline-none">
                                    <?php
                                    $registration_failed_email = isset($_SESSION['registration_failed_email']) && $_SESSION['registration_failed_email'];
                                    if ($registration_failed_email) {
                                        echo "<p class='pt-2 text-red-500 rounded-md'>Email sudah ada!</p>";
                                        unset($_SESSION['registration_failed_email']);
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="grid grid-cols-1">
                                <label class="text-base text-black" for="Password">Password</label>
                                <input type="password" name="Password" id="Password" required placeholder="********" class="w-full bg-[#DEF7E5] border border-gray-500 px-2 py-2 rounded-md focus:outline-none">
                            </div>

                            <div class="grid grid-cols-1">
                                <label class="text-base text-black" for="Alamat">Alamat</label>
                                <textarea type="textarea" name="Alamat" id="Alamat" rows="2" required placeholder="Masukan alamat" class="w-full bg-[#DEF7E5] border border-gray-500 px-2 py-2 rounded-md focus:outline-none"></textarea>
                            </div>

                            <!-- Button Register -->
                            <div class="w-full">
                                <button type="submit" class="bg-[#263238] w-full rounded-md text-white font-semibold uppercase text-sm py-2 hover:scale-105 transition-all duration-300">Register</button>
                            </div>

                            <!-- Button Login -->
                            <div class="flex items-center justify-between text-xs">
                                <p class="text-black/80">kamu sudah memilki akun ?</p>
                                <a class="py-2 px-3 md:px-5 bg-[#263238] text-white rounded-md text-xs font-semibold uppercase shadow-md hover:scale-110 duration-300" href="index.php">Login
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>

</html>