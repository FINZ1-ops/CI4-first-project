<?php

namespace App\Controllers;

class Suplai extends BaseController
{
    public function index()
    {
        $search         = $this->request->getGet('search');
        $dari_tanggal   = $this->request->getGet('dari_tanggal');
        $sampai_tanggal = $this->request->getGet('sampai_tanggal');

    $semua = [
        ['produk' => 'iPhone 15',       'jumlah' => 100, 'supplier' => 'Apple',    'subtotal' => 895000000,  'tanggal' => '2026-06-01'],
        ['produk' => 'MacBook Pro',     'jumlah' => 50,  'supplier' => 'Apple',    'subtotal' => 1181750000, 'tanggal' => '2026-06-03'],
        ['produk' => 'Samsung S24',     'jumlah' => 80,  'supplier' => 'Samsung',  'subtotal' => 808480000,  'tanggal' => '2026-06-05'],
        ['produk' => 'iPad Pro',        'jumlah' => 60,  'supplier' => 'Apple',    'subtotal' => 733500000,  'tanggal' => '2026-06-07'],
        ['produk' => 'Sony WH-1000',    'jumlah' => 120, 'supplier' => 'Sony',     'subtotal' => 430320000,  'tanggal' => '2026-06-10'],
        ['produk' => 'Dell XPS 13',     'jumlah' => 75,  'supplier' => 'Dell',     'subtotal' => 1039125000, 'tanggal' => '2026-06-12'],
        ['produk' => 'Google Pixel',    'jumlah' => 90,  'supplier' => 'Google',   'subtotal' => 704160000,  'tanggal' => '2026-06-14'],
        ['produk' => 'LG OLED TV',      'jumlah' => 40,  'supplier' => 'LG',       'subtotal' => 586800000,  'tanggal' => '2026-06-16'],
        ['produk' => 'Nintendo Switch', 'jumlah' => 110, 'supplier' => 'Nintendo', 'subtotal' => 394460000,  'tanggal' => '2026-06-18'],
        ['produk' => 'Lenovo ThinkPad', 'jumlah' => 65,  'supplier' => 'Lenovo',   'subtotal' => 826410000,  'tanggal' => '2026-06-20'],
    ];

        $suplai = array_filter($semua, function($p) use ($search, $dari_tanggal, $sampai_tanggal) {

            if ($search && stripos($p['produk'], $search) === false) return false;

            if ($dari_tanggal   && $p['tanggal'] < $dari_tanggal)   return false;
            if ($sampai_tanggal && $p['tanggal'] > $sampai_tanggal) return false;

            return true;
        });

        return view('page/suplai', [
            'title'          => 'Data Suplai',
            'suplai'         => $suplai,
            'search'         => $search,
            'dari_tanggal'   => $dari_tanggal,
            'sampai_tanggal' => $sampai_tanggal,
        ]);
    }
}
