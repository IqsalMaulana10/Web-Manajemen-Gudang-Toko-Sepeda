<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<!-- 3. HERO SECTION (REKAP VERSION - PREMIUM LOOK) -->
<div class="bg-brand-gradient rounded-[60px] p-12 text-white mb-10 shadow-2xl shadow-teal-300/30 relative overflow-hidden group border border-white/10">
    <div class="relative z-10 flex flex-col lg:flex-row justify-between items-center gap-10">
        <div class="max-w-2xl text-center lg:text-left">
            <div class="inline-block bg-white/20 backdrop-blur-md px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-[0.3em] mb-6 border border-white/30 italic">
               ARSIP DIGITAL  
            </div>
            <h2 class="text-6xl font-black mb-4 tracking-tighter leading-none italic uppercase">
                RIWAYAT PERGERAKAN  <span class="text-teal-200">STOK</span>
            </h2>
            <p class="text-teal-50 text-base opacity-80 leading-relaxed font-medium italic max-w-lg">
               Halaman ini merangkum seluruh aktivitas keluar-masuk unit secara transparan. Pastikan seluruh data telah disinkronkan untuk kebutuhan laporan.</p>
        </div>
        
        <!-- Stats Card Glassmorphism -->
        <div class="grid grid-cols-2 gap-4 w-full lg:w-auto">
            <div class="bg-white/10 backdrop-blur-xl p-8 rounded-[40px] border border-white/20 shadow-2xl flex flex-col items-center justify-center min-w-[160px]">
                <p class="text-[9px] font-black text-teal-100 uppercase tracking-widest mb-2 italic">Total Aktivitas</p>
                <p class="text-4xl font-black italic text-white leading-none"><?= count($riwayat); ?></p>
            </div>
            <div class="bg-teal-400/20 backdrop-blur-xl p-8 rounded-[40px] border border-teal-300/20 shadow-2xl flex flex-col items-center justify-center min-w-[160px]">
                <p class="text-[9px] font-black text-teal-100 uppercase tracking-widest mb-2 italic">Status</p>
                <div class="flex items-center gap-2">
                    <div class="w-2 h-2 rounded-full bg-teal-300 animate-pulse"></div>
                    <span class="text-xs font-black uppercase tracking-tighter italic text-white">Aktif</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Watermark Background -->
    <div class="absolute -right-10 -bottom-10 text-[240px] font-black text-white/5 italic select-none pointer-events-none uppercase tracking-tighter">BBA</div>
</div>

<!-- 4. MAIN CONTENT (Tabel Mutasi) -->
<div class="bg-white rounded-[60px] shadow-sm border border-slate-100 overflow-hidden relative">
    <div class="px-12 py-12 border-b border-slate-50 bg-slate-50/30 flex flex-col md:flex-row justify-between items-center gap-6">
        <div class="flex items-center gap-6">
            <div class="w-16 h-16 bg-brand-gradient rounded-3xl flex items-center justify-center text-2xl shadow-xl shadow-teal-200">📑</div>
            <div>
                <h3 class="text-3xl font-black text-slate-800 tracking-tighter italic uppercase leading-none">Laporan Mutasi Stok</h3>
                <p class="text-[10px] text-slate-400 font-bold tracking-widest uppercase mt-2 italic flex items-center gap-2">
                    <span class="w-1 h-1 bg-teal-500 rounded-full"></span> Sinkronisasi Real-time Database
                </p>
            </div>
        </div>
        <button onclick="window.print()" 
        class="bg-slate-900 text-white px-10 py-4 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] hover:bg-black transition-all hover:scale-105 
        active:scale-95 shadow-2xl shadow-slate-300 flex items-center gap-3 italic cta-print-hide">
            <span>🖨️</span> Cetak Laporan
        </button>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-white border-b border-slate-100 text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">
                <tr>
                    <th class="px-12 py-8">Waktu Transaksi</th>
                    <th class="px-12 py-8 text-center">Proses</th>
                    <th class="px-12 py-8">Jenis Unit</th>
                    <th class="px-12 py-8 text-center">Jumlah</th>      
                    <th class="px-12 py-8">Catatan Gudang</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                <?php if(empty($riwayat)): ?>
                    <tr>
                        <td colspan="5" class="px-12 py-32 text-center">
                            <div class="flex flex-col items-center opacity-20">
                                <span class="text-6xl mb-4">📭</span>
                                <p class="font-black text-slate-400 uppercase tracking-[0.5em] italic">Database Kosong</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>    
                <?php foreach($riwayat as $r) : ?>
                <tr class="hover:bg-teal-50/20 transition-all group">
                    <td class="px-12 py-10">
                        <div class="flex items-center gap-3">
                            <div class="w-1.5 h-10 <?= $r['tipe'] == 'Masuk' ? 'bg-blue-400' : 'bg-orange-400' ?> rounded-full"></div>
                            <div>
                                <p class="font-black text-slate-800 text-sm uppercase italic leading-none mb-1"><?= date('d M Y', strtotime($r['tanggal'])); ?></p>
                                <p class="text-[10px] text-slate-400 font-bold tracking-widest"><?= date('H:i', strtotime($r['tanggal'])); ?> WIB</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-12 py-10 text-center">
                        <?php if($r['tipe'] == 'Masuk'): ?>
                            <span class="bg-blue-50 text-blue-600 px-6 py-2.5 rounded-2xl text-[9px] font-black uppercase tracking-widest border border-blue-100 italic shadow-sm">
                                📥 MASUK
                            </span>
                        <?php else: ?>
                            <span class="bg-orange-50 text-orange-600 px-6 py-2.5 rounded-2xl text-[9px] font-black uppercase tracking-widest border border-orange-100 italic shadow-sm">
                                📤 KELUAR
                            </span>
                        <?php endif; ?>
                    </td>
                    <td class="px-12 py-10">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-white border border-slate-100 rounded-2xl flex items-center justify-center text-xl shadow-sm group-hover:scale-110 transition italic">🚲</div>
                            <div>
                                <p class="font-black text-teal-600 font-mono text-[10px] italic leading-none mb-1">ID: <?= $r['kode_sepeda']; ?></p>
                                <p class="font-black text-slate-700 text-base uppercase italic leading-none tracking-tighter"><?= $r['nama_sepeda']; ?></p>
                            </div>
                        </div>
                    </td>
                    <td class="px-12 py-10 text-center">
                        <div class="inline-flex items-center justify-center <?= $r['tipe'] == 'Masuk' ? 'bg-blue-50 text-blue-700' : 'bg-orange-50 text-orange-700' ?> px-5 py-3 rounded-2xl font-black text-lg italic shadow-inner border <?= $r['tipe'] == 'Masuk' ? 'border-blue-100' : 'border-orange-100' ?>">
                            <?= $r['tipe'] == 'Masuk' ? '+' : '-' ?><?= $r['jumlah']; ?>
                        </div>
                    </td>
                    <td class="px-12 py-10">
                        <p class="text-[11px] font-bold text-slate-500 uppercase tracking-tight italic bg-slate-50 px-4 py-2 rounded-xl border border-dashed border-slate-200"><?= $r['keterangan'] ?: 'Otoritas Manual'; ?></p>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- 6. CALL TO ACTION (CTA) SECTION -->
<div class="mt-12 bg-slate-900 p-16 rounded-[60px] text-white flex flex-col lg:flex-row items-center justify-between gap-10 shadow-3xl relative overflow-hidden border border-slate-800">
    <div class="flex items-center gap-10 relative z-10 text-center lg:text-left">
        <div class="w-30 h-30  rounded-[35px] flex items-center justify-center text-5xl  shadow-teal-500/40 transform -rotate-6 group-hover:rotate-0 transition-all italic"><img src="<?= base_url('assets/log0.png') ?>" class="h-24 w-auto object-contain" alt="Logo"></div>
        <div>
            <h5 class="font-black uppercase italic text-3xl tracking-tighter leading-none mb-3">Data Stok Gudang</h5>
            <p class="text-sm text-slate-400 italic font-medium max-w-md">Data mutasi ini bersifat final dan tidak dapat diubah oleh staf biasa. Digunakan untuk sinkronisasi inventaris bulanan.</p>
        </div>
    </div>
    <div class="flex gap-4 relative z-10 w-full lg:w-auto">
        <a href="<?= base_url('produk') ?>" class="w-full lg:w-auto bg-brand-gradient text-white px-12 py-6 rounded-[30px] font-black text-xs uppercase tracking-[0.3em] hover:scale-105 transition-all shadow-2xl shadow-teal-900/50 text-center italic">
            Balik Ke Dashboard anjay
        </a>
    </div>
    <div class="absolute right-0 top-0 text-[180px] font-black text-white/5 italic select-none pointer-events-none uppercase tracking-tighter">ARSIP</div>
</div>

<?= $this->endSection(); ?>