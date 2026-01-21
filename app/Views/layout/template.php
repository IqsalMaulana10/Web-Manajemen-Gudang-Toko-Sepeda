<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <!-- Tailwind CSS & Google Fonts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            scroll-behavior: smooth;
        }

        .bg-brand-gradient {
            background: linear-gradient(135deg, #36BFB1 0%, #02735E 100%);
        }

        .bg-dark-emerald {
            background-color: #014034;
        }

        #sidebar {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar-closed {
            margin-left: -18rem;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #36BFB1;
            border-radius: 10px;
        }

        /* Navbar Link Hover Effect */
        .nav-link {
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: #36BFB1;
            transition: width 0.3s;
        }

        .nav-link:hover::after {
            width: 100%;
        }
    </style>
</head>

<body class="bg-[#F8FAFB] flex flex-col min-h-screen text-slate-700 overflow-x-hidden">

    <!-- 1. HEADER & NAVBAR -->
    <header
        class="bg-white/80 backdrop-blur-md border-b border-slate-100 h-24 flex items-center justify-between px-10 sticky top-0 z-[60] shadow-sm">
        <div class="flex items-center gap-5">
            <button onclick="toggleSidebar()"
                class="p-3 bg-slate-50 hover:bg-teal-50 rounded-2xl transition-all group shadow-sm border border-slate-100">
                <svg class="w-6 h-6 text-slate-500 group-hover:text-teal-600 transition-colors" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>
            <div class="flex items-center gap-4">
                <div class="">
                    <img src="<?= base_url('assets/log0.png') ?>" class="h-10 w-auto object-contain" alt="Logo">
                </div>
                <div class="hidden lg:block">
                    <h1 class="font-extrabold text-xl tracking-tight leading-none text-slate-800 uppercase italic">Bike
                        Bike Aja</h1>
                    <p class="text-[9px] font-black text-teal-600 tracking-[0.2em] uppercase mt-1 italic">Manajemen Stok
                    </p>
                </div>
            </div>
        </div>
        <div class="w-full md:w-80">
            <?php
            $current_uri = uri_string();
            $search_action = base_url('produk'); 
            $placeholder = "Cari Nama atau Kode Unit...";

            if ($current_uri == 'produk/rekap') {
                $search_action = base_url('produk/rekap');
                $placeholder = "Cari di Rekap Data...";
            }
            ?>
            <div class="hidden md:block w-72">
                <form action="<?= $search_action ?>" method="get" class="relative group">
                    <span
                        class="absolute left-5 top-1/2 -translate-y-1/2 opacity-30 group-focus-within:opacity-100 transition-opacity text-xs">🔍</span>
                    <input type="text" name="keyword" value="<?= @$keyword; ?>" placeholder="<?= $placeholder ?>"
                        class="w-full bg-slate-50 border border-slate-100 rounded-xl pl-12 pr-10 py-3 outline-none focus:ring-4 focus:ring-teal-100 focus:bg-white focus:border-teal-400 transition-all font-bold text-[10px] text-slate-700 shadow-inner">
                    <?php if (@$keyword): ?>
                        <a href="<?= $search_action ?>"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-300 hover:text-red-500 font-bold text-[10px]">✕</a>
                    <?php endif; ?>
                </form>
            </div>
        </div>
        <nav class="hidden xl:flex items-center gap-10">
            <a href="<?= base_url('produk') ?>"
                class="nav-link text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 hover:text-teal-600 transition-colors italic">Dashboard</a>
            <a href="<?= base_url('produk#database-inventori') ?>"
                class="nav-link text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 hover:text-teal-600 transition-colors italic">Inventori</a>
            <a href="<?= base_url('produk/rekap') ?>"
                class="nav-link text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 hover:text-teal-600 transition-colors italic">Rekap Data</a>
        </nav>
        <div class="flex items-center gap-6">
            <div class="flex items-center gap-4 px-4 py-2 bg-slate-50 rounded-2xl border border-slate-100">
                <div class="text-right hidden sm:block">
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest leading-none">Status: Admin
                    </p>
                    <p class="text-sm font-black text-slate-800 italic">
                        <?= session()->get('username') ?: 'Administrator'; ?></p>
                </div>
            </div>
            <a href="<?= base_url('logout') ?>"
                class="bg-red-50 text-red-500 p-3.5 rounded-2xl hover:bg-red-500 hover:text-white transition-all shadow-sm border border-red-100"
                title="Keluar Sistem">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                    </path>
                </svg>
            </a>
        </div>
    </header>

    <div class="flex flex-1 overflow-hidden relative">
        <!-- 4. SIDEBAR (MENU OPSIONAL) -->
        <aside id="sidebar"
            class="w-72 bg-dark-emerald text-teal-100/60 flex flex-col p-8 border-r border-emerald-900/10 shadow-2xl z-50 shrink-0 sidebar-closed">
            <div class="mb-10">
                <p class="text-[10px] font-black text-teal-500/50 uppercase tracking-[0.3em] mb-8 italic">Akses FItur
                </p>
                <nav class="space-y-4">
                    <a href="<?= base_url('produk') ?>"
                        class="flex items-center gap-4 px-6 py-4 rounded-2xl font-bold transition-all transform hover:scale-[1.02] <?= (uri_string() == 'produk' || uri_string() == '') ? 'bg-[#36BFB1] text-white shadow-xl shadow-teal-900/40' : 'hover:bg-emerald-800 text-teal-100' ?>">
                        Dashboard
                    </a>
                    <button onclick="toggleModal('modalLaporan')"
                        class="w-full flex items-center gap-4 px-6 py-4 hover:bg-emerald-800 text-teal-100 rounded-2xl font-bold transition-all text-left">
                        Penjualan Harian
                    </button>
                    <a href="<?= base_url('produk/rekap') ?>"
                        class="flex items-center gap-4 px-6 py-4 rounded-2xl font-bold transition-all <?= (uri_string() == 'produk/rekap') ? 'bg-[#36BFB1] text-white shadow-xl shadow-teal-900/40' : 'hover:bg-emerald-800 text-teal-100' ?>">
                        Rekap Data
                    </a>
                </nav>
            </div>
        </aside>


        <!-- 5. AREA KONTEN UTAMA -->
        <main class="flex-1 overflow-y-auto bg-[#F8FAFB]">
            <div class="px-10 py-10 min-h-[calc(100vh-160px)] max-w-[1600px] mx-auto">

                <!-- Notifikasi -->
                <?php if (session()->getFlashdata('success')): ?>
                    <div
                        class="bg-emerald-50  text-emerald-700 px-8 py-5 rounded-2xl mb-10 font-bold text-sm shadow-sm flex items-center justify-between italic">
                        <div class="flex items-center gap-3">
                            <span>✅ BERHASIL: <?= session()->getFlashdata('success'); ?></span>
                        </div>
                    </div>
                <?php endif; ?>

                <?= $this->renderSection('content'); ?>
            </div>
            <footer class="bg-white border-t border-slate-100 mt-20 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-teal-50 rounded-full -mr-32 -mt-32 opacity-50"></div>
                <div class="max-w-[1600px] mx-auto px-10 pt-20 pb-10 relative z-10">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-16 mb-20">
                        <div class="space-y-6 flex flex-col items-center lg:items-start text-center lg:text-left">
                            <div class="flex items-center gap-3">
                                <img src="<?= base_url('assets/log0.png') ?>" class="h-10 w-auto" alt="Logo">
                                <h2 class="font-black text-slate-800 text-xl tracking-tighter italic uppercase">BIKE
                                    BIKE AJA <span class="text-teal-500">STORE</span></h2>
                            </div>
                            <p class="text-sm text-slate-500 leading-relaxed italic max-w-sm">
                                Solusi manajemen inventori sepeda terpercaya untuk efisiensi gudang Anda. Sistem
                                dikembangkan untuk kebutuhan operasional retail modern.
                            </p>
                            <div class="pt-4">
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em]">&copy; 2025
                                    BIKE BIKE AJA STORE.</p>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em]">Semua Hak
                                    Dilindungi.</p>
                            </div>
                        </div>
                        <div class="flex flex-col items-center text-center">
                            <h4 class="font-black text-slate-800 uppercase italic tracking-widest text-xs mb-8">Link
                                Penting</h4>
                            <ul class="space-y-4">
                                <li><a href="<?= base_url('produk') ?>"
                                        class="text-sm font-bold text-slate-500 hover:text-teal-600 transition-colors flex items-center justify-center gap-2 italic"><span>→</span>
                                        Dashboard Utama</a></li>
                                <li><a href="<?= base_url('produk/rekap') ?>"
                                        class="text-sm font-bold text-slate-500 hover:text-teal-600 transition-colors flex items-center justify-center gap-2 italic"><span>→</span>
                                        Riwayat Stok</a></li>
                                <li><button onclick="toggleModal('modalLaporan')"
                                        class="text-sm font-bold text-slate-500 hover:text-teal-600 transition-colors flex items-center justify-center gap-2 italic"><span>→</span>
                                        Laporan Harian</button></li>
                                <li><a href="#"
                                        class="text-sm font-bold text-slate-500 hover:text-teal-600 transition-colors flex items-center justify-center gap-2 italic"><span>→</span>
                                        Panduan Sistem</a></li>
                            </ul>
                        </div>
                        <div class="flex flex-col items-center lg:items-end text-center lg:text-right">
                            <h4 class="font-black text-slate-800 uppercase italic tracking-widest text-xs mb-8">Kontak
                                Kami</h4>
                            <div class="space-y-5">
                                <div class="flex flex-col lg:flex-row items-center lg:justify-end gap-3">
                                    <p class="text-sm font-bold text-slate-500 leading-tight italic">Jl. Slamet Riyadi
                                        No. 123,<br>Surakarta, Jawa Tengah</p>
                                    <span class="text-lg hidden lg:block">📍</span>
                                </div>
                                <div class="flex items-center justify-center lg:justify-end gap-4">
                                    <p class="text-sm font-bold text-slate-500 italic">info@bikebikeaja.com</p>
                                    <span class="text-lg hidden lg:block">📧</span>
                                </div>
                                <div class="flex items-center justify-center lg:justify-end gap-4">
                                    <p class="text-sm font-bold text-slate-500 italic">+62 812-3456-7890</p>
                                    <span class="text-lg hidden lg:block">📞</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('sidebar-closed');
        }

        function toggleModal(id) {
            const modal = document.getElementById(id);
            if (!modal) return;
            modal.classList.toggle('hidden');
            modal.classList.toggle('flex');
        }
    </script>
</body>

</html>