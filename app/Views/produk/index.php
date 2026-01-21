<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<!-- HERO SECTION -->
<div class="bg-brand-gradient rounded-[60px] p-16 text-white mb-10 shadow-2xl relative overflow-hidden group">
    <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-8">
        <div class="max-w-xl text-center md:text-left">
            
            <h2 class="text-6xl font-black mb-6 tracking-tighter italic uppercase">BIKE BIKE AJA <br><span class="text-teal-200">INVETORI DIGITAL</span></h2>
            <p class="text-teal-50 text-lg opacity-80 leading-relaxed font-medium italic underline decoration-teal-300 decoration-2 underline-offset-4">Sistem Manajemen Stok Pusat BIKE BIKE AJA STORE</p>
        </div>
        
    </div>
    <div class="absolute -right-20 -bottom-20 text-[300px] font-black text-white/5 italic select-none pointer-events-none uppercase tracking-tighter">BBA</div>
</div>

<!-- STATS & FILTER -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
    <div class="bg-white p-8 rounded-[40px] border border-slate-100 shadow-sm lg:col-span-2">
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center gap-4">
                <h4 class="text-sm font-black text-slate-800 uppercase tracking-widest italic">Filter Kategori</h4>
            </div>
            <button onclick="toggleModal('modalKategori')" class="bg-emerald-50 text-emerald-600 px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-emerald-600 hover:text-white transition">+ Baru</button>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="<?= base_url('produk') ?>" class="px-5 py-2.5 rounded-2xl text-[10px] font-black uppercase border transition <?= !$cat_active ? 'bg-[#36BFB1] text-white border-[#36BFB1]' : 'bg-slate-50 text-slate-400 border-slate-100 hover:border-teal-300' ?>">Semua</a>
            <?php foreach($kategori as $k) : ?>
                <a href="<?= base_url('produk?kategori='.$k['id_kategori']) ?>" class="px-5 py-2.5 rounded-2xl text-[10px] font-black uppercase border transition <?= $cat_active == $k['id_kategori'] ? 'bg-[#36BFB1] text-white border-[#36BFB1]' : 'bg-slate-50 text-slate-400 border-slate-100 hover:border-teal-300' ?>">
                    <?= $k['nama_kategori']; ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="bg-brand-gradient p-8 rounded-[40px] text-white flex flex-col justify-center text-center shadow-2xl shadow-teal-900/20">
        <button onclick="openAddModal()" class="bg-white text-emerald-900 font-black py-5 rounded-3xl text-xs uppercase tracking-[0.2em] shadow-xl hover:scale-105 transition active:scale-95">
            + Tambah Stok Unit
        </button>
    </div>
</div>

<!-- DATABASE TABLE-->
<div id="database-inventori" class="bg-white rounded-[50px] shadow-sm border border-slate-100 overflow-hidden mb-10">
    <div class="px-12 py-10 border-b border-slate-50 bg-slate-50/20 flex flex-col md:flex-row justify-between items-center gap-6">
        <div>
            <h3 class="text-3xl font-black text-slate-800 tracking-tighter italic uppercase">Database Inventori Kita</h3>
            <p class="text-[10px] text-slate-400 font-bold tracking-widest uppercase mt-1 italic">Status gudang menggunakan Kode Unit sebagai Kunci Utama</p>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-white border-b border-slate-100 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
                <tr>
                    <th class="px-12 py-7">ID Unit</th>
                    <th class="px-12 py-7">Nama & Model</th>
                    <th class="px-12 py-7">Kategori</th>
                    <th class="px-12 py-7 text-center">STOK</th>
                    <th class="px-12 py-7 text-right">Harga (IDR)</th>
                    <th class="px-12 py-7 text-center">Aksi</th>
                </tr>
            </thead>    
            <tbody class="divide-y divide-slate-50">
                <?php if(empty($produk)): ?>
                    <tr><td colspan="6" class="px-12 py-20 text-center font-bold text-slate-300 uppercase tracking-widest italic">Data tidak ditemukan atau kosong</td></tr>
                <?php endif; ?>
                <?php foreach($produk as $p) : ?>
                <tr class="hover:bg-teal-50/20 transition-all group">
                    <td class="px-12 py-8 font-black text-teal-600 font-mono text-xs italic">#<?= $p['kode_sepeda']; ?></td>
                    <td class="px-12 py-8">
                        <p class="font-black text-slate-800 text-base uppercase italic tracking-tight"><?= $p['nama_sepeda']; ?></p>
                    </td>
                    <td class="px-15 py-8">
                        <span class="bg-white border border-slate-200 text-slate-500 px-5 py-2 rounded-2xl text-[9px] font-black uppercase tracking-widest">
                            <?= $p['nama_kategori'] ?? 'Tanpa Kategori'; ?>
                        </span>
                    </td>
                    <td class="px-12 py-8 text-center">
                        <div class="font-black text-slate-800 bg-white border border-slate-100 w-12 h-12 flex items-center justify-center rounded-2xl mx-auto italic shadow-sm">
                            <?= $p['stok']; ?>
                        </div>
                    </td>
                    <td class="px-12 py-8 text-right font-black text-emerald-600 italic text-lg tracking-tighter">
                        <?= number_format($p['harga'], 0, ',', '.'); ?>
                    </td>
                    <td class="px-12 py-8 text-center">
                        <div class="flex items-center justify-center gap-3">
                            <button onclick='editProduk(<?= json_encode($p); ?>)' class="bg-teal-50 text-teal-600 px-6 py-3 rounded-2xl text-[10px] font-black hover:bg-teal-600 hover:text-white transition uppercase italic">Edit</button>
                            <a href="<?= base_url('produk/hapus/'.$p['kode_sepeda']) ?>" onclick="return confirm('Hapus data ini?')" class="bg-red-50 text-red-400 px-6 py-3 rounded-2xl text-[10px] font-black hover:bg-red-500 hover:text-white transition uppercase italic">Hapus</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<!-- MODAL PRODUK (INPUT & UPDATE) -->
<div id="modalProduk" class="fixed inset-0 bg-emerald-950/70 backdrop-blur-xl z-[100] hidden items-center justify-center p-6">
    <div class="bg-white w-full max-w-xl rounded-[60px] p-12 shadow-2xl">
        <div class="mb-10 text-center">
            <h4 id="modalTitle" class="text-4xl font-black text-slate-800 tracking-tighter uppercase italic">TAMBAH BARANG</h4>
            <p class="text-[10px] text-slate-400 font-bold mt-2 uppercase tracking-widest">BBA Store</p>
        </div>
        <form action="<?= base_url('produk/simpan') ?>" method="post" id="formProduk" class="space-y-6">
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2 text-left">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-5 italic">ID Unit </label>
                    <input type="text" name="kode_sepeda" id="f_kode" required class="w-full bg-slate-50 border border-slate-100 rounded-[30px] px-8 py-5 outline-none focus:ring-4 focus:ring-teal-100 transition font-black text-slate-700">
                </div>
                <div class="space-y-2 text-left">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-5 italic">Nama Unit</label>
                    <input type="text" name="nama_sepeda" id="f_nama" required class="w-full bg-slate-50 border border-slate-100 rounded-[30px] px-8 py-5 outline-none focus:ring-4 focus:ring-teal-100 transition font-black text-slate-700">
                </div>
            </div>
            <div class="space-y-2 text-left">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-5 italic">Kategori</label>
                <select name="id_kategori" id="f_kategori" class="w-full bg-slate-50 border border-slate-100 rounded-[30px] px-8 py-5 outline-none focus:ring-4 focus:ring-teal-100 transition font-black text-slate-700 appearance-none">
                    <?php foreach($kategori as $k) : ?>
                        <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="grid grid-cols-2 gap-6 text-left">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-5 italic">Jumlah Stok</label>
                    <input type="number" name="stok" id="f_stok" required class="w-full bg-slate-50 border border-slate-100 rounded-[30px] px-8 py-5 outline-none focus:ring-4 focus:ring-teal-100 transition font-black text-slate-700">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-5 italic">Harga Jual</label>
                    <input type="number" name="harga" id="f_harga" required class="w-full bg-slate-50 border border-slate-100 rounded-[30px] px-8 py-5 outline-none focus:ring-4 focus:ring-teal-100 transition font-black text-slate-700">
                </div>
            </div>
            <div class="flex gap-4 pt-8">
                <button type="button" onclick="toggleModal('modalProduk')" class="flex-1 py-5 font-black text-slate-400 uppercase text-xs italic tracking-widest">Batal</button>
                <button type="submit" class="flex-[2] bg-brand-gradient text-white py-5 rounded-[35px] font-black shadow-2xl shadow-teal-900/30 uppercase text-xs tracking-widest">Simpan Data</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL LAPORAN HARIAN -->
<div id="modalLaporan" class="fixed inset-0 bg-emerald-950/70 backdrop-blur-xl z-[100] hidden items-center justify-center p-6 transition-all">
    <div class="bg-white w-full max-w-lg rounded-[60px] p-12 shadow-2xl">
        <div class="mb-10 text-center">
            <h4 class="text-4xl font-black text-slate-800 tracking-tighter uppercase italic">Laporan Harian</h4>
            <p class="text-[10px] text-slate-400 font-bold mt-2 uppercase tracking-widest">Input Penjualan Unit</p>
        </div>
        <form action="<?= base_url('produk/laporan') ?>" method="post" class="space-y-6">
            <div class="space-y-2 text-left">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-5 italic">Pilih Barang Yang Terjual</label>
                <select name="kode_sepeda" required class="w-full bg-slate-50 border border-slate-100 rounded-[30px] px-8 py-5 outline-none focus:ring-4 focus:ring-teal-100 transition font-black text-slate-700 appearance-none">
                    <option value=""> Pilih Produk </option>
                    <?php foreach($produk as $p) : ?>
                        <option value="<?= $p['kode_sepeda']; ?>"><?= $p['nama_sepeda']; ?> (Sisa: <?= $p['stok']; ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="space-y-2 text-left">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-5 italic">Jumlah Barang Terjual</label>
                <input type="number" name="jumlah_terjual" required min="1" placeholder="Masukan Angka" class="w-full bg-slate-50 border border-slate-100 rounded-[30px] px-8 py-5 outline-none focus:ring-4 focus:ring-teal-100 transition font-black text-slate-700">
            </div>
            <div class="flex gap-4 pt-8">
                <button type="button" onclick="toggleModal('modalLaporan')" class="flex-1 py-5 font-black text-slate-400 uppercase text-xs italic tracking-widest">Batal</button>
                <button type="submit" class="flex-[2] bg-brand-gradient text-white py-5 rounded-[35px] font-black shadow-2xl shadow-teal-900/30 uppercase text-xs tracking-widest">Simpan Laporan</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL KATEGORI -->
<div id="modalKategori" class="fixed inset-0 bg-emerald-950/70 backdrop-blur-xl z-[110] hidden items-center justify-center p-6">
    <div class="bg-white w-full max-w-md rounded-[50px] p-12 shadow-2xl">
        <h4 class="text-3xl font-black text-slate-800 tracking-tighter uppercase italic mb-8 text-center">Kategori baru</h4>
        <form action="<?= base_url('kategori/simpan') ?>" method="post" class="space-y-6">
            <div class="space-y-2 text-left">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-5 italic">Nama Kategori</label>
                <input type="text" name="nama_kategori" required placeholder="" class="w-full bg-slate-50 border border-slate-100 rounded-[30px] px-8 py-5 outline-none focus:ring-4 focus:ring-teal-100 transition font-black text-slate-700">
            </div>
            <button type="submit" class="w-full bg-brand-gradient text-white py-5 rounded-[30px] font-black shadow-xl shadow-teal-900/20 uppercase text-xs italic">Simpan</button>
        </form>
    </div> 
</div>
<script>
    function editProduk(data) {
        document.getElementById('modalTitle').innerText = 'Edit Barang';
        document.getElementById('formProduk').action = '<?= base_url('produk/update') ?>';
        const codeInput = document.getElementById('f_kode');
        codeInput.value = data.kode_sepeda;
        codeInput.setAttribute('readonly', true);
        codeInput.classList.add('bg-slate-200', 'cursor-not-allowed');
        document.getElementById('f_nama').value = data.nama_sepeda;
        document.getElementById('f_kategori').value = data.id_kategori;
        document.getElementById('f_stok').value = data.stok;
        document.getElementById('f_harga').value = data.harga;
        toggleModal('modalProduk');
    }
    function openAddModal() {
        document.getElementById('modalTitle').innerText = 'TAMBAH BARANG';
        document.getElementById('formProduk').action = '<?= base_url('produk/simpan') ?>';
        document.getElementById('formProduk').reset();
        const codeInput = document.getElementById('f_kode');
        codeInput.removeAttribute('readonly');
        codeInput.classList.remove('bg-slate-200', 'cursor-not-allowed');
        toggleModal('modalProduk');
    }
</script>

<?= $this->endSection(); ?>