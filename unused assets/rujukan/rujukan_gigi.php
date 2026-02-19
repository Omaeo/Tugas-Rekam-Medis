<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Form Pendaftaran Poli Gigi</title>
</head>
<body class="bg-[#f0f4ff] min-h-screen font-sans p-6 overflow-x-hidden relative">

    <div class="fixed top-[-50px] right-[-50px] w-96 h-96 bg-purple-200 rounded-full blur-[80px] opacity-40 -z-10"></div>
    <div class="fixed bottom-[-100px] left-[-50px] w-[500px] h-[500px] bg-blue-200 rounded-full blur-[100px] opacity-30 -z-10"></div>

    <div class="max-w-3xl mx-auto">
        
        <header class="mb-10 pl-2">
            <h1 class="text-4xl font-black text-[#1e4b8a] tracking-tight border-b-4 border-[#1e4b8a] w-fit mb-1">POLI Gigi</h1>
            <p class="text-lg font-bold text-gray-800">Layanan Kesehatan Gigi</p>
        </header>

        <div class="bg-white/80 backdrop-blur-sm rounded-[40px] shadow-2xl p-8 border border-white">
            
            <form action="#" method="POST" class="space-y-8">
                
                <div class="bg-[#f5f8ff] rounded-3xl p-6 shadow-inner border border-blue-50">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="text-2xl">👤</span>
                        <h2 class="font-bold text-[#1e4b8a]">Identitas pasien</h2>
                    </div>
                    <div class="space-y-4">
                        <input type="text" placeholder="Nama Lengkap" 
                               class="w-full bg-white/70 border-none rounded-2xl py-3 px-6 shadow-sm focus:ring-2 focus:ring-blue-400 outline-none placeholder:text-gray-300">
                        <input type="text" placeholder="Nomor BPJS/KTP" 
                               class="w-full bg-white/70 border-none rounded-2xl py-3 px-6 shadow-sm focus:ring-2 focus:ring-blue-400 outline-none placeholder:text-gray-300">
                    </div>
                </div>

                <div class="bg-[#f5f8ff] rounded-3xl p-6 shadow-inner border border-blue-50">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="text-2xl">🏥</span>
                        <h2 class="font-bold text-[#1e4b8a]">Bagian Mana Yang Sakit (Jelaskan)</h2>
                    </div>
                    <textarea rows="4" placeholder="Contoh: Gigi saya berlubang" 
                              class="w-full bg-white/70 border-none rounded-3xl py-4 px-6 shadow-sm focus:ring-2 focus:ring-blue-400 outline-none placeholder:text-gray-300 resize-none"></textarea>
                </div>

                <div class="bg-[#f5f8ff] rounded-3xl p-8 shadow-inner border border-blue-50">
                    <div class="flex flex-col md:flex-row md:items-center gap-4 mb-8">
                        <label class="font-bold text-[#1e4b8a] whitespace-nowrap">Kapan Mau Periksa?</label>
                        <div class="relative flex-1">
                            <input type="date" class="w-full bg-white border-none rounded-full py-3 px-6 shadow-sm focus:ring-2 focus:ring-blue-400 outline-none text-gray-400">
                        </div>
                    </div>

                    <label class="font-bold text-[#1e4b8a] block mb-4">Pilih Jam Kunjungan:</label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <label class="cursor-pointer">
                            <input type="radio" name="jam" class="hidden peer">
                            <div class="bg-white p-4 rounded-3xl shadow-sm border-2 border-transparent peer-checked:border-blue-500 peer-checked:bg-blue-50 transition-all text-center">
                                <span class="block font-bold text-[#1e4b8a]">Pagi</span>
                                <span class="text-xs text-gray-400 italic">08.00 - 11.00</span>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="jam" class="hidden peer">
                            <div class="bg-white p-4 rounded-3xl shadow-sm border-2 border-transparent peer-checked:border-blue-500 peer-checked:bg-blue-50 transition-all text-center">
                                <span class="block font-bold text-[#1e4b8a]">Siang</span>
                                <span class="text-xs text-gray-400 italic">13.00 - 15.20</span>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="jam" class="hidden peer">
                            <div class="bg-white p-4 rounded-3xl shadow-sm border-2 border-transparent peer-checked:border-blue-500 peer-checked:bg-blue-50 transition-all text-center">
                                <span class="block font-bold text-[#1e4b8a]">Sore</span>
                                <span class="text-xs text-gray-400 italic">15.20 - 16.55</span>
                            </div>
                        </label>
                    </div>
                </div>

                <button type="submit" 
                        class="w-full bg-[#1e4b8a] hover:bg-[#163a6d] text-white font-bold py-4 rounded-2xl shadow-xl transition-all active:scale-[0.98] flex justify-center items-center gap-2">
                    Kirim janji kunjungan 📋
                </button>

            </form>
        </div>
    </div>

</body>
</html>