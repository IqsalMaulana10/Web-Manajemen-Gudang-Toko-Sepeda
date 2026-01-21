<?php

namespace App\Controllers;

use App\Models\ProdukModel;

class Produk extends BaseController
{
    protected $produkModel;

    public function __construct()
    {
        helper(['url', 'form']);
        $this->produkModel = new ProdukModel();
    }

    private function checkAuth()
    {
        if (!session()->get('logged_in')) {
            header('Location: ' . base_url('login'));
            exit();
        }
    }

    public function index()
    {
        $this->checkAuth();
        $db = \Config\Database::connect();
        
        $keyword = $this->request->getGet('keyword');
        $id_kategori = $this->request->getGet('kategori');

        if ($keyword) {
            $produk = $this->produkModel->search($keyword);
        } elseif ($id_kategori) {
            $produk = $this->produkModel->filterByCategory($id_kategori);
        } else {
            $produk = $this->produkModel->getProdukWithKategori();
        }

        $data = [
            'title'      => 'Dashboard | BIKE BIKE AJA STORE',
            'produk'     => $produk,
            'kategori'   => $db->table('kategori')->get()->getResultArray(),
            'keyword'    => $keyword,
            'cat_active' => $id_kategori,
            'username'   => session()->get('username')
        ];

        return view('produk/index', $data);
    }

    public function rekap()
    {
        $this->checkAuth();
        $db = \Config\Database::connect();

        $keyword = $this->request->getGet('keyword');   

        $builder = $db->table('riwayat_stok')
            ->select('riwayat_stok.*, produk.nama_sepeda')
            ->join('produk', 'produk.kode_sepeda = riwayat_stok.kode_sepeda');

        if ($keyword) {
            $builder->groupStart()
                    ->like('produk.nama_sepeda', $keyword)
                    ->orLike('riwayat_stok.kode_sepeda', $keyword)
                    ->orLike('riwayat_stok.keterangan', $keyword)
                    ->groupEnd();
        }

        $riwayat = $builder->orderBy('tanggal', 'DESC')->get()->getResultArray();

        $data = [
            'title'    => 'Rekap Data | BIKE BIKE AJA STORE',
            'riwayat'  => $riwayat,
            'keyword'  => $keyword, 
            'username' => session()->get('username')
        ];

        return view('produk/rekap', $data);
    }

    public function laporan()
    {
        $this->checkAuth();
        $db = \Config\Database::connect();
        $kode = $this->request->getPost('kode_sepeda');
        $jumlah = (int)$this->request->getPost('jumlah_terjual');

        $produk = $this->produkModel->find($kode);
        
        if ($produk) {
            $stok_baru = $produk['stok'] - $jumlah;
            if ($stok_baru < 0) {
                return redirect()->to(base_url('produk'))->with('error', 'Stok tidak mencukupi untuk dilaporkan!');
            }

            $this->produkModel->update($kode, ['stok' => $stok_baru]);
            
            $db->table('riwayat_stok')->insert([
                'kode_sepeda'=> $kode,
                'tipe'       => 'Keluar',
                'jumlah'     => $jumlah,
                'keterangan' => 'Penjualan Unit',
                'tanggal'    => date('Y-m-d H:i:s')
            ]);

            return redirect()->to(base_url('produk'))->with('success', 'Laporan Berhasil: Stok diperbarui.');
        }
        return redirect()->to(base_url('produk'));
    }

    public function save()
    {
        $this->checkAuth();
        $db = \Config\Database::connect();
        
        $kode = $this->request->getPost('kode_sepeda');
        $stokInput = (int)$this->request->getPost('stok');

        $produkExist = $this->produkModel->find($kode);

        if ($produkExist) {
            $stokTotal = $produkExist['stok'] + $stokInput;
            $this->produkModel->update($kode, ['stok' => $stokTotal]);
            $keterangan = "Penambahan Stok Unit (Restock)";
        } else {
            $this->produkModel->insert([
                'kode_sepeda' => $kode,
                'nama_sepeda' => $this->request->getPost('nama_sepeda'),
                'id_kategori' => $this->request->getPost('id_kategori'),
                'stok'        => $stokInput,
                'harga'       => $this->request->getPost('harga'),
            ]);
            $keterangan = "Daftar Unit Baru di Gudang";
        }

        $db->table('riwayat_stok')->insert([
            'kode_sepeda' => $kode,
            'tipe'        => 'Masuk',
            'jumlah'      => $stokInput,
            'keterangan'  => $keterangan,
            'tanggal'     => date('Y-m-d H:i:s')
        ]);

        return redirect()->to(base_url('produk'))->with('success', 'Data Berhasil Diproses.');
    }

    public function update()
    {
        $this->checkAuth();
        $db = \Config\Database::connect();
        $kode = $this->request->getPost('kode_sepeda');
        $stokBaru = (int)$this->request->getPost('stok');
        
        $produkLama = $this->produkModel->find($kode);

        $this->produkModel->update($kode, [
            'nama_sepeda' => $this->request->getPost('nama_sepeda'),
            'id_kategori' => $this->request->getPost('id_kategori'),
            'stok'        => $stokBaru,
            'harga'       => $this->request->getPost('harga'),
        ]);

        if ($stokBaru > $produkLama['stok']) {
            $db->table('riwayat_stok')->insert([
                'kode_sepeda' => $kode,
                'tipe'        => 'Masuk',
                'jumlah'      => $stokBaru - $produkLama['stok'],
                'keterangan'  => 'Koreksi Data / Update Manual',
                'tanggal'     => date('Y-m-d H:i:s')
            ]);
        }

        return redirect()->to(base_url('produk'))->with('success', 'Data Berhasil Diperbarui.');
    }

    public function delete($kode)
    {
        $this->checkAuth();
        $this->produkModel->delete($kode);
        return redirect()->to(base_url('produk'))->with('success', 'Unit Berhasil Dihapus dari Database.');
    }

    public function saveKategori()
    {
        $this->checkAuth();
        $db = \Config\Database::connect();
        $db->table('kategori')->insert(['nama_kategori' => $this->request->getPost('nama_kategori')]);
        return redirect()->to(base_url('produk'))->with('success', 'Kategori Ditambahkan.');
    }
}