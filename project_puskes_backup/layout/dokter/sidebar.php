<?php
// Cek halaman aktif
$current_page = basename($_SERVER['PHP_SELF']);
?>

<aside class="w-[260px] bg-white h-screen fixed top-0 left-0 border-r border-slate-100 shadow-sm flex flex-col">
    <div class="p-8">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-200">
                <i class="fas fa-hand-holding-medical text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-xl font-black text-slate-800 tracking-tight">Puskes<span class="text-blue-600">Care</span></h1>
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Medical Staff</p>
            </div>
        </div>
    </div>

    <nav class="flex-1 px-4 space-y-2">
        <p class="px-4 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-4">Main Menu</p>
        
        <a href="dashboard.php" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition group <?= $current_page == 'dashboard.php' ? 'bg-blue-600 text-white shadow-lg shadow-blue-100' : 'text-slate-500 hover:bg-blue-50 hover:text-blue-600' ?>">
            <i class="fas fa-th-large text-lg"></i>
            <span class="font-bold text-sm">Dashboard Antrian</span>
        </a>

        <a href="riwayat_pasien.php" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition group <?= $current_page == 'riwayat_pasien.php' ? 'bg-blue-600 text-white shadow-lg shadow-blue-100' : 'text-slate-500 hover:bg-blue-50 hover:text-blue-600' ?>">
            <i class="fas fa-history text-lg"></i>
            <span class="font-bold text-sm">Riwayat Pasien</span>
        </a>

        <a href="profil_dokter.php" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition group <?= $current_page == 'profil_dokter.php' ? 'bg-blue-600 text-white shadow-lg shadow-blue-100' : 'text-slate-500 hover:bg-blue-50 hover:text-blue-600' ?>">
            <i class="fas fa-user-circle text-lg"></i>
            <span class="font-bold text-sm">Profil Saya</span>
        </a>
    </nav>

    <div class="p-4 border-t border-slate-50">
        <div class="bg-slate-50 p-4 rounded-2xl mb-4">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center font-bold text-xs uppercase">
                    <?= substr($_SESSION['nama'], 0, 2) ?>
                </div>
                <div class="overflow-hidden">
                    <p class="text-xs font-bold text-slate-800 truncate"><?= $_SESSION['nama'] ?></p>
                    <p class="text-[10px] text-slate-400 uppercase tracking-tighter italic">Dokter Spesialis</p>
                </div>
            </div>
        </div>
        
        <a href="../account/logout.php" onclick="return confirm('Yakin ingin keluar?')" class="flex items-center justify-center gap-3 w-full py-3 rounded-xl bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition font-bold text-sm">
            <i class="fas fa-sign-out-alt"></i>
            Keluar
        </a>
    </div>
</aside>