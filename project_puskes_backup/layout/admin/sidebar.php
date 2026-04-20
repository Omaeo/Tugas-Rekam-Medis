<div class="w-72 bg-[#0f172a] min-h-screen p-6 text-white shrink-0 shadow-2xl">
    <div class="flex items-center justify-center gap-3 mb-12 mt-4">
        <div class="bg-blue-600 p-2 rounded-lg">
            <i class="fas fa-hospital-symbol text-xl text-white"></i>
        </div>
        <h2 class="text-xl font-bold tracking-wider text-slate-100 uppercase">PuskesCare</h2>
    </div>

    <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-4 px-3">Menu Utama</p>
    
    <nav class="space-y-2">
        <a href="home_admin.php" class="flex items-center gap-3 p-3 rounded-xl transition-all <?= basename($_SERVER['PHP_SELF']) == 'home_admin.php' ? 'bg-gradient-to-r from-blue-600 to-blue-500 text-white shadow-lg shadow-blue-900/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/50' ?>">
            <i class="fas fa-th-large text-lg"></i>
            <span class="font-medium">Dashboard</span>
        </a>

        <a href="data_dokter.php" class="flex items-center gap-3 p-3 rounded-xl transition-all <?= basename($_SERVER['PHP_SELF']) == 'data_dokter.php' ? 'bg-gradient-to-r from-blue-600 to-blue-500 text-white shadow-lg shadow-blue-900/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/50' ?>">
            <i class="fas fa-user-md text-lg"></i>
            <span class="font-medium font-bold">Data Dokter</span>
        </a>

        <a href="data_pasien.php" class="flex items-center gap-3 p-3 rounded-xl transition-all <?= basename($_SERVER['PHP_SELF']) == 'data_pasien.php' ? 'bg-gradient-to-r from-blue-600 to-blue-500 text-white shadow-lg shadow-blue-900/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/50' ?>">
            <i class="fas fa-user-injured text-lg"></i>
            <span class="font-medium">Data Pasien</span>
        </a>
    </nav>

    <div class="my-8 border-t border-slate-800 px-3"></div>

    <nav class="space-y-2">
        <a href="../account/logout.php" class="flex items-center gap-3 p-3 text-rose-400 hover:bg-rose-500/10 rounded-xl transition-all mt-10">
            <i class="fas fa-power-off text-lg"></i>
            <span class="font-bold">Keluar Sistem</span>
        </a>
    </nav>
</div>