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
    <title>Galeri Foto | Login</title>
    <?php
    include("./component/style_script.php");
    ?>
</head>

<body>
    <!-- Content -->
    <section class="grid w-full h-screen bg-gray-100 place-items-center">
        <?php
        $registration_success = isset($_SESSION['registration_success']) && $_SESSION['registration_success'];
        if ($registration_success) {
            echo "<p class='px-3 py-2 w-[350px] text-center mx-auto text-white bg-[#268EFF] rounded-md'>Pendaftaran akun berhasil!</p>";
            unset($_SESSION['registration_success']);
            echo ("<script>
            setTimeout(function(){
                window.location.reload();
                }, 1000);
            </script>");
        }
        ?>

        <div class="bg-[#92E3A9] rounded-2xl md:w-[800px] lg:w-[800px] xl:w-[1000px] h-[500px] lg:h-[550px] shadow-2xl grid grid-cols-1 md:grid-cols-2 overflow-hidden">
            <div class="hidden md:w-[400px] lg:w-[400px] xl:w-[500px] h-full bg-[#92E3A9] md:block mx-auto">
                <img src="./assets/images/material/background-login.png" alt="gambar" class="my-auto w-[500px] h-[500px]">
            </div>

            <div class="flex flex-col md:w-[400px] lg:w-[400px] xl:w-[500px] h-full px-10 bg-[#92E3A9] py-7">
                <div class="pb-10 text-center">
                    <h1 class="text-2xl font-semibold text-black capitalize font-poppins">Selamat Datang !</h1>
                    <p class="text-base text-black/80">Silahkan login | Masukkan data anda</p>
                </div>
                <!-- Form Login -->
                <form action="config/action_login.php" method="POST">
                    <div>
                        <div class="grid items-start w-full grid-cols-1 gap-y-4">
                            <div class="grid grid-cols-1">
                                <label class="text-base text-black" for="Username">Username</label>
                                <input type="text" name="Username" id="Username" required autofocus placeholder="Masukan username" class="w-full bg-[#DEF7E5] border border-gray-500 shadow-sm px-2 py-2 rounded-md focus:outline-none">
                                <?php
                                $login_failed_username = isset($_SESSION['login_failed_username']) && $_SESSION['login_failed_username'];
                                if ($login_failed_username) {
                                    echo "<p class='py-2 text-red-500 rounded-md'>Username yang anda masukan salah!</p>";
                                    unset($_SESSION['login_failed_username']);
                                }
                                ?>
                            </div>

                            <div class="grid grid-cols-1">
                                <label class="text-base text-black" for="Password">Password</label>
                                <input type="password" name="Password" id="Password" required placeholder="********" class="w-full bg-[#DEF7E5] border border-gray-500 px-2 py-2 rounded-md focus:outline-none">
                                <?php
                                $login_failed_password = isset($_SESSION['login_failed_password']) && $_SESSION['login_failed_password'];
                                if ($login_failed_password) {
                                    echo "<p class='py-2 text-red-500 rounded-md'>Password yang anda masukan salah!</p>";
                                    unset($_SESSION['login_failed_password']);
                                }
                                ?>
                            </div>

                            <div class="grid max-w-full grid-cols-5">
                                <div id="angkaPertama" class="grid w-full border border-gray-500 rounded-md place-items-center bg-[#DEF7E5]">
                                </div>
                                <div id="jenisAritmatika" class="grid w-full py-1 place-items-center">
                                </div>
                                <div id="angkaKedua" class="grid w-full border border-gray-500 rounded-md place-items-center bg-[#DEF7E5]">
                                </div>
                                <div class="grid w-full py-1 font-semibold place-items-center">
                                    =
                                </div>
                                <div>
                                    <input id="finalHasil" type="number" class="block w-full bg-[#DEF7E5] border border-gray-500 py-1 text-center rounded-md focus:outline-none">
                                </div>
                            </div>

                            <!-- Button Login -->
                            <div class="w-full">
                                <button type="submit" id="tombolSubmit" class="bg-[#263238] cursor-no-drop w-full rounded-md text-white font-semibold uppercase text-sm py-2 hover:scale-105 transition-all duration-300">Login</button>
                            </div>

                            <!-- Button Register -->
                            <div class="flex items-center justify-between text-xs">
                                <p class="text-black/80">kamu belum memilki akun ?</p>
                                <a class="py-2 px-3 md:px-5 bg-[#263238] text-white rounded-md text-xs font-semibold uppercase shadow-md hover:scale-110 duration-300" href="register.php">Register
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script>
        // Function Captcha Aritmatika
        function jalanKanScript() {
            const angkaPertama = document.getElementById('angkaPertama');
            const jenisAritmatika = document.getElementById('jenisAritmatika');
            const angkaKedua = document.getElementById('angkaKedua');
            const finalHasil = document.getElementById('finalHasil');
            const tombolSubmit = document.getElementById('tombolSubmit');

            // medendapatkan random angka pertama
            function getRandomData(param) {
                return Math.floor(Math.random() * param);
            }

            function cekKondisiAritmatika(param = false) {
                let isfinalHasilFill = finalHasil.value;
                if (isfinalHasilFill && param) {
                    //ada isi
                    tombolSubmit.classList.remove('cursor-no-drop');
                    tombolSubmit.classList.add(
                        'active:bg-[#263238]', 'hover:bg-[#263238]', 'focus:outline-none'
                    );
                    tombolSubmit.type = 'submit';
                } else {
                    tombolSubmit.classList.add('bg-[#263238]', 'cursor-no-drop');
                    tombolSubmit.classList.remove(
                        'active:bg-[#263238]', 'hover:bg-[#263238]', 'focus:outline-none'
                    );
                    tombolSubmit.type = 'button';
                }
            }
            cekKondisiAritmatika();

            let isfinalHasilFill = finalHasil.textContent;
            if (isfinalHasilFill) {
                tombolSubmit.classList
            }

            // medendapatkan random angka pertama
            let countFirst = getRandomData(90);

            // medendapatkan random angka kedua
            let countSecond = getRandomData(10);

            // medendapatkan random operator aritmatika
            const aritmatikaOperator = ['+', '-'];
            const RandomAritmatikaOperator = Math.floor(Math.random() * aritmatikaOperator.length);

            // operasi aritmatika dan penyimoanan hasil akhir
            let hasilAkhirTrue;
            hasilAkhirTrue = aritmatikaOperator[RandomAritmatikaOperator] == '+' ? countFirst + countSecond :
                aritmatikaOperator[RandomAritmatikaOperator] == '-' ? countFirst - countSecond : '';
            console.info(hasilAkhirTrue);

            // memasukan ke tampilan
            angkaPertama.textContent = countFirst;
            jenisAritmatika.textContent = aritmatikaOperator[RandomAritmatikaOperator];
            angkaKedua.textContent = countSecond;

            // mendapatkan hasil user
            finalHasil.addEventListener('change', (e) => jalan(e));
            finalHasil.addEventListener('keyup', (e) => jalan(e));

            function jalan(e) {
                console.info('jalan')
                if (e.target.value == hasilAkhirTrue) {

                    cekKondisiAritmatika(true)
                } else {
                    cekKondisiAritmatika(false)
                }

            }

        }
        jalanKanScript();
    </script>
</body>

</html>