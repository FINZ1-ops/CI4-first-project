<?php

namespace App\Controllers;

class Produk extends BaseController
{
    public function index()
    {
    /**
     * Query contract (GET):
     * - search: keyword untuk nama produk / kategori
     * - tipe  : kategori produk (contoh: "Laptop"), default "semua"
     *
     * Catatan maintenance:
     * - Gunakan nilai "semua" sebagai sentinel agar controller dan view konsisten.
     * - Normalisasi input dengan trim untuk mencegah spasi kosong dianggap valid filter.
     */
    $search = trim((string) $this->request->getGet('search'));
    $filterTipe = trim((string) $this->request->getGet('tipe'));
    if ($filterTipe === '') {
        $filterTipe = 'semua';
    }

       $semua =[
            ['name_product' => 'Samsung Galaxy S24','category' => 'Smartphone', 'price' => 10999000],
            ['name_product' => 'Apple iPhone 15', 'category' => 'Smartphone', 'price' => 12999000],
            ['name_product' => 'Xiaomi 14 Ultra', 'category' => 'Smartphone', 'price' => 8999000],
            ['name_product' => 'Sony WH-1000XM5', 'category' => 'Headphone', 'price' => 3999000],
            ['name_product' => 'iPad Pro', 'category' => 'Tablet', 'price' => 14999000],
            ['name_product' => 'MacBook Pro', 'category' => 'Laptop', 'price' => 19999000],
            ['name_product' => 'Dell XPS 13', 'category' => 'Laptop', 'price' => 12999000],
            ['name_product' => 'Samsung Galaxy Tab S9', 'category' => 'Tablet', 'price' => 9999000],
            ['name_product' => 'Google Pixel 8', 'category' => 'Smartphone', 'price' => 7999000],
            ['name_product' => 'JBL Flip 6', 'category' => 'Speaker', 'price' => 1299000],
            ['name_product' => 'ASUS VivoBook 15', 'category' => 'Laptop', 'price' => 7999000],
            ['name_product' => 'Apple Watch Series 9', 'category' => 'Smartwatch', 'price' => 4299000],
            ['name_product' => 'Samsung Galaxy Buds2', 'category' => 'Earbuds', 'price' => 999000],
            ['name_product' => 'Microsoft Surface Laptop 5', 'category' => 'Laptop', 'price' => 14999000],
            ['name_product' => 'OnePlus 12', 'category' => 'Smartphone', 'price' => 7999000],
            ['name_product' => 'Google Pixel Buds Pro', 'category' => 'Earbuds', 'price' => 1999000],
            ['name_product' => 'Lenovo ThinkBook 14', 'category' => 'Laptop', 'price' => 8999000],
            ['name_product' => 'Samsung Galaxy Watch 6', 'category' => 'Smartwatch', 'price' => 2499000],
            ['name_product' => 'iPad Air', 'category' => 'Tablet', 'price' => 9999000],
            ['name_product' => 'Beats Solo 4', 'category' => 'Headphone', 'price' => 2999000],
            ['name_product' => 'Honor Magic 6', 'category' => 'Smartphone', 'price' => 6999000],
            ['name_product' => 'Amazon Echo Dot', 'category' => 'Speaker', 'price' => 499000],
            ['name_product' => 'Realme GT 5 Pro', 'category' => 'Smartphone', 'price' => 5999000],
            ['name_product' => 'ASUS ROG Gaming Laptop', 'category' => 'Laptop', 'price' => 18999000],
            ['name_product' => 'Samsung Galaxy Z Fold 6', 'category' => 'Smartphone', 'price' => 18999000],
            ['name_product' => 'Bose QuietComfort 45', 'category' => 'Headphone', 'price' => 3499000],
            ['name_product' => 'Nitendo Switch OLED', 'category' => 'Gaming Console', 'price' => 4999000],
            ['name_product' => 'Apple AirPods Max', 'category' => 'Headphone', 'price' => 6999000],
            ['name_product' => 'HP Spectre x360', 'category' => 'Laptop', 'price' => 15999000],
            ['name_product' => 'Google Nest Hub', 'category' => 'Smart Home', 'price' => 1299000],
            ['name_product' => 'Sony PlayStation 5', 'category' => 'Gaming Console', 'price' => 7999000],
            ['name_product' => 'Microsoft Xbox Series X', 'category' => 'Gaming Console', 'price' => 7999000],
       ];

       /**
        * Pipeline filter:
        * 1) Filter teks (search)
        * 2) Filter kategori (tipe)
        *
        * Urutan ini sengaja dipertahankan agar kombinasi search + kategori
        * menghasilkan subset data yang konsisten.
        */
       $product = $semua;
       if ($search !== '') {
            $product = array_filter($product, function($p) use ($search) {
                return stripos($p['name_product'], $search) !== false || stripos($p['category'], $search) !== false;
            });
       }

       // 2) Filter kategori (tipe)
       if (strtolower($filterTipe) !== 'semua') {
            $product = array_filter($product, function($p) use ($filterTipe) {
                return strcasecmp($p['category'], $filterTipe) === 0;
            });
       }

       /**
        * Dropdown kategori harus selalu memakai data master (`$semua`),
        * bukan hasil filter (`$product`), supaya opsi kategori tidak hilang
        * saat user sedang melakukan pencarian/penyaringan.
        */
       $categories = array_values(array_unique(array_column($semua, 'category')));
       sort($categories);

       // Payload ke view: data hasil filter + state filter untuk render ulang UI.
       $data = [
        'title'=>'Data Produk',
        'product' => $product,
        'category' => $categories,
        'search' => $search,
        'filter_tipe' => $filterTipe,
       ];

       return view('page/produk', $data);
    }
}
