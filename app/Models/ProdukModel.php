<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table            = 'produk';
    // Menggunakan kode_sepeda sebagai Primary Key
    protected $primaryKey       = 'kode_sepeda';
    // Karena PK bukan angka Auto Increment, matikan fitur ini
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['kode_sepeda', 'nama_sepeda', 'id_kategori', 'stok', 'harga'];

    public function getProdukWithKategori()
    {
        return $this->select('produk.*, kategori.nama_kategori')
                    ->join('kategori', 'kategori.id_kategori = produk.id_kategori', 'left')
                    ->findAll();
    }

    public function search($keyword)
    {
        return $this->select('produk.*, kategori.nama_kategori')
                    ->join('kategori', 'kategori.id_kategori = produk.id_kategori', 'left')
                    ->like('nama_sepeda', $keyword)
                    ->orLike('kode_sepeda', $keyword)
                    ->findAll();
    }

    public function filterByCategory($id_kategori)
    {
        return $this->select('produk.*, kategori.nama_kategori')
                    ->join('kategori', 'kategori.id_kategori = produk.id_kategori', 'left')
                    ->where('produk.id_kategori', $id_kategori)
                    ->findAll();
    }
}