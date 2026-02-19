<?php 
include "../layout/user/header_user.php";

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Pilih Antrean Layanan Kesehatan</title>
</head>
<body class="bg-blue-50 min-h-screen font-sans">
    <header class="relative bg-blue-100 py-16 px-8 overflow-hidden">
        <div class="absolute top-[-20px] left-[-20px] w-48 h-48 bg-blue-300 rounded-full opacity-50"></div>
        <div class="absolute top-10 left-40 w-12 h-12 bg-purple-200 rounded-full opacity-60"></div>
        
        <div class="relative z-10 max-w-4xl mx-auto text-left">
            <h1 class="text-4xl font-bold text-gray-800">Pilih Informasi</h1>
            <p class="text-blue-600 font-medium mt-2">Layanan Kesehatan Terpadu untuk anda</p>
        </div>
        <div class="absolute right-0 top-0 h-full w-1/3 hidden md:block opacity-40">
            <img src="assets/img/Group_2.png" alt="Stethoscope" class="object-cover h-full w-full">
        </div>
    </header>
    <main class="max-w-4xl mx-auto px-4 -mt-10 relative z-20 pb-20">
        
        <div class="bg-white rounded-xl shadow-lg p-6 mb-10 border border-blue-50">
            <p class="text-blue-900 text-center text-sm font-semibold leading-relaxed">
                Tombol poli menampilkan layanan sesuai dengan jenis poli, seperti Poli Anak, Poli Lansia, Poli Gigi, dan Poli Umum. 
                Pilih poli yang sesuai dengan kebutuhan Anda.
            </p>
        </div>
        <div class="space-y-6">
            <a href="poliumum.php" class="group block cursor-pointer bg-gradient-to-r from-purple-50 to-white rounded-3xl shadow-md flex overflow-hidden hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 border border-white h-40">
                <div class="flex-1 p-8 flex flex-col justify-center">
                    <h2 class="text-3xl font-bold text-gray-800 border-b-2 border-purple-300 w-fit pb-1">Poli Umum</h2>
                    <p class="text-blue-800 text-xs font-bold mt-2 uppercase tracking-wide">Pemeriksaan Kesehatan & Pengobatan</p>
                </div>
                <div class="w-1/2 overflow-hidden bg-gray-200">
                    <img src="../assets/img/poli_umum.png" alt="Umum" class="object-cover h-full w-full group-hover:scale-110 transition-transform duration-700 ">
                </div>
            </a>
        
            <a href="polianak.php" class="group block cursor-pointer bg-gradient-to-r from-blue-100 to-white rounded-3xl shadow-md flex overflow-hidden hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 border border-white h-40">
                <div class="flex-1 p-8 flex flex-col justify-center">
                    <h2 class="text-3xl font-bold text-gray-800 border-b-2 border-blue-400 w-fit pb-1">Poli Anak</h2>
                    <p class="text-blue-800 text-xs font-bold mt-2 uppercase tracking-wide">Pemeriksaan Kesehatan & Pengobatan</p>
                </div>
                <div class="w-1/2 overflow-hidden bg-gray-200">
                    <img src="../assets/img/poli_anak.png" alt="Anak" class="object-cover h-full w-full group-hover:scale-110 transition-transform duration-700">
                </div>
            </a>
            <a href="polilansia.php" class="group block cursor-pointer bg-gradient-to-r from-purple-50 to-white rounded-3xl shadow-md flex overflow-hidden hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 border border-white h-40">
                <div class="flex-1 p-8 flex flex-col justify-center">
                    <h2 class="text-3xl font-bold text-gray-800 border-b-2 border-purple-300 w-fit pb-1">Poli lansia</h2>
                    <p class="text-blue-800 text-xs font-bold mt-2 uppercase tracking-wide">Pemeriksaan Kesehatan & Pengobatan</p>
                </div>
                <div class="w-1/2 overflow-hidden bg-gray-200">
                    <img src="../assets/img/poli_lansia.png" alt="Lansia" class="object-cover h-full w-full group-hover:scale-110 transition-transform duration-700">
                </div>
            </a>
            <a href="poligigi.php" class="group block cursor-pointer bg-gradient-to-r from-purple-50 to-white rounded-3xl shadow-md flex overflow-hidden hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 border border-white h-40">
                <div class="flex-1 p-8 flex flex-col justify-center">
                    <h2 class="text-3xl font-bold text-gray-800 border-b-2 border-purple-300 w-fit pb-1">Poli Gigi</h2>
                    <p class="text-blue-800 text-xs font-bold mt-2 uppercase tracking-wide">Pemeriksaan Kesehatan & Pengobatan</p>
                </div>
                <div class="w-1/2 overflow-hidden bg-gray-200">
                    <img src="../assets/img/poli_gigi.png" alt="Gigi" class="object-cover h-full w-full group-hover:scale-110 transition-transform duration-700">
                </div>
            </a>
        </div>
    </main>
    <?php
include "../layout/user/footer_user.php";
?>
</body>
</html>

