<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | BIKE BIKE AJA STORE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-brand-gradient { background: linear-gradient(135deg, #36BFB1 0%, #02735E 100%); }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-6">
    <div class="bg-white w-full max-w-md rounded-[50px] p-12 shadow-2xl border border-slate-100">
        <div class="text-center mb-10">
            <div class=""> <img src="<?= base_url('assets/log0.png') ?>" class=" w-24 h-24 rounded-3xl flex items-center justify-center text-white text-3xl mx-auto mb-6 s" alt=""></div>
            <h1 class="text-3xl font-black text-slate-800 tracking-tighter uppercase italic">Akses Admin</h1>
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-2 italic">Bike Bike Aja Store - Manajemen Gudang</p>
        </div>

        <?php if(session()->getFlashdata('msg')): ?>
            <div class="bg-red-50 text-red-500 p-4 rounded-2xl text-xs font-bold mb-6 text-center border border-red-100">
                <?= session()->getFlashdata('msg') ?>
            </div>
        <?php endif; ?>

        <form action="/auth/login" method="post" class="space-y-6">
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Username</label>
                <input type="text" name="username" required placeholder="Masukan Username" class="w-full bg-slate-50 border border-slate-100 rounded-[25px] px-8 py-5 outline-none focus:ring-4 focus:ring-teal-100 transition font-black text-slate-700">
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Password</label>
                <input type="password" name="password" required placeholder="Masukan Password" class="w-full bg-slate-50 border border-slate-100 rounded-[25px] px-8 py-5 outline-none focus:ring-4 focus:ring-teal-100 transition font-black text-slate-700">
            </div>
            <button type="submit" class="w-full bg-brand-gradient text-white py-6 rounded-[30px] font-black shadow-2xl shadow-teal-900/30 hover:shadow-teal-900/40 transition-all transform hover:-translate-y-1 uppercase text-xs tracking-[0.3em]">Masuk Sekarang</button>
        </form>
    </div>
</body>
</html>