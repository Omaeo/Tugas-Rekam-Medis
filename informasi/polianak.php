<?php include "../layout/user/header_user.php"; ?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Poli Anak</title>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
body{
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(to bottom, #e6f0ff, #cfe0ff);
}

.glass-card{
    background: rgba(255,255,255,0.85);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
}

.section-title{
    background:#3b82f6;
    color:white;
    padding:8px 16px;
    border-radius:12px 12px 0 0;
    font-weight:600;
}
</style>
</head>
<body>

<div class="max-w-6xl mx-auto py-10 px-6">

    <!-- HEADER -->
    <div class="relative mb-10">
        <h1 class="text-3xl font-bold text-blue-900">POLI ANAK</h1>
        <p class="text-gray-600 font-semibold">Layanan Kesehatan Anak</p>

        <div class="hidden md:block absolute right-0 top-0 w-56 h-40 overflow-hidden rounded-xl shadow-lg">
            <img src="../assets/img/poli_anak.png" 
                 class="w-full h-full object-cover">
        </div>
    </div>

    <!-- CONTENT GRID -->
    <div class="grid md:grid-cols-3 gap-6">

        <!-- LEFT -->
        <div class="md:col-span-2 space-y-6">

            <!-- LAYANAN PEMERIKSAAN -->
            <div class="glass-card p-6">
                <div class="section-title mb-4">Layanan Pemeriksaan</div>
                <ul class="list-disc pl-5 text-gray-700 space-y-2 text-sm">
                    <li>Pemeriksaan tumbuh kembang anak</li>
                    <li>Pemeriksaan imunisasi rutin</li>
                    <li>Pemeriksaan demam, batuk, pilek</li>
                    <li>Pemeriksaan gangguan pencernaan anak</li>
                    <li>Pemeriksaan alergi pada anak</li>
                    <li>Pemeriksaan kesehatan bayi dan balita</li>
                </ul>

                <hr class="my-6">

                <div class="section-title mb-4 bg-pink-500">Tindakan & Pengobatan</div>
                <ul class="list-disc pl-5 text-gray-700 space-y-2 text-sm">
                    <li>Pemberian obat sesuai diagnosis dokter</li>
                    <li>Penanganan infeksi ringan pada anak</li>
                    <li>Pemberian vitamin dan suplemen</li>
                    <li>Edukasi pola makan sehat anak</li>
                    <li>Penanganan gangguan tumbuh kembang</li>
                    <li>Rujukan jika diperlukan</li>
                </ul>
            </div>

            <!-- TENAGA MEDIS -->
            <div class="glass-card p-6 bg-gradient-to-r from-blue-100 to-blue-200">
                <h3 class="font-semibold text-blue-900 mb-2">Tenaga Medis</h3>
                <ul class="list-disc pl-5 text-gray-700 text-sm">
                    <li>Dokter Anak</li>
                    <li>Perawat Poli Anak</li>
                </ul>
            </div>

            <!-- DESKRIPSI -->
            <div class="glass-card p-6">
                <p class="text-gray-700 text-sm">
                    <strong>Poli Anak</strong> melayani pemeriksaan dan pengobatan kesehatan anak 
                    mulai dari bayi hingga remaja, termasuk imunisasi, konsultasi tumbuh kembang, 
                    serta penanganan penyakit ringan hingga tindak lanjut pengobatan.
                </p>
            </div>

        </div>

        <!-- RIGHT -->
        <div class="space-y-6">

            <!-- ALAT -->
            <div class="glass-card p-6">
                <div class="section-title mb-4">Alat Yang Digunakan</div>
                <ul class="list-disc pl-5 text-gray-700 space-y-2 text-sm">
                    <li>Timbangan bayi dan anak</li>
                    <li>Alat ukur tinggi badan</li>
                    <li>Termometer</li>
                    <li>Stetoskop</li>
                    <li>Alat pemeriksaan dasar medis</li>
                </ul>
            </div>

            <!-- KONSULTASI -->
            <div class="glass-card p-6 bg-blue-100">
                <div class="section-title mb-4 bg-blue-500">Konsultasi</div>
                <ul class="list-disc pl-5 text-gray-700 space-y-2 text-sm">
                    <li>Konsultasi tumbuh kembang anak</li>
                    <li>Konsultasi imunisasi</li>
                    <li>Edukasi pencegahan penyakit anak</li>
                    <li>Konsultasi pola makan dan nutrisi</li>
                    <li>Konsultasi tindak lanjut pengobatan</li>
                </ul>
            </div>

                <!-- Tombol Kembali -->
            <button onclick="history.back()" 
                class="mb-6 inline-flex items-center gap-2 bg-white/70 backdrop-blur-md 
                    hover:bg-white text-blue-900 font-medium 
                    px-5 py-2 rounded-xl shadow-md 
                    transition duration-300 hover:scale-105">
                ← Kembali
            </button>

        </div>
    </div>

</div>

</body>
</html>

<?php include "../layout/user/footer_user.php"; ?>
