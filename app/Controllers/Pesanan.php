<?php

namespace App\Controllers;

class Pesanan extends BaseController
{
    public function index()
    {
        $min_nominal    = $this->request->getGet('min_nominal');
        $max_nominal    = $this->request->getGet('max_nominal');
        $dari_tanggal   = $this->request->getGet('dari_tanggal');
        $sampai_tanggal = $this->request->getGet('sampai_tanggal');

        $semua = [
          ['id' => '#ORD-001', 'pelanggan' => 'Andi',  'produk' => 'iPhone 15',   'nominal' => 8500000,  'tanggal' => '2026-04-01'],
          ['id' => '#ORD-002', 'pelanggan' => 'Budi',  'produk' => 'Mouse Logitech 305', 'nominal' => 450000,   'tanggal' => '2026-04-02'],
          ['id' => '#ORD-003', 'pelanggan' => 'Citra', 'produk' => 'Monitor Samsung 24"', 'nominal' => 2800000,  'tanggal' => '2026-04-03'],
          ['id' => '#ORD-004', 'pelanggan' => 'Deni',  'produk' => 'Keyboard Mechanical',    'nominal' => 750000,   'tanggal' => '2026-04-04'],
          ['id' => '#ORD-005', 'pelanggan' => 'Eka',   'produk' => 'Sony WH-1000XM5',     'nominal' => 1200000,  'tanggal' => '2026-04-05'],
          ['id' => '#ORD-006', 'pelanggan' => 'Fajar', 'produk' => 'MacBook Pro', 'nominal' => 25000000, 'tanggal' => '2026-03-28'],
          ['id' => '#ORD-007', 'pelanggan' => 'Gita',  'produk' => 'iPad Pro',    'nominal' => 12000000, 'tanggal' => '2026-03-15'],
        ];
        
        $pesanan = array_filter($semua, function($p) use ($min_nominal, $max_nominal, $dari_tanggal, $sampai_tanggal) {
    
            // filter nominal
            if ($min_nominal && $p['nominal'] < $min_nominal) return false;
            if ($max_nominal && $p['nominal'] > $max_nominal) return false;

            // filter tanggal
            if ($dari_tanggal && $p['tanggal'] < $dari_tanggal) return false;
            if ($sampai_tanggal && $p['tanggal'] > $sampai_tanggal) return false;

            return true;
        });

        return view('page/pesanan', [
            'title'          => 'Data Pesanan',
            'pesanan'        => $pesanan,
            'min_nominal'    => $min_nominal,
            'max_nominal'    => $max_nominal,
            'dari_tanggal'   => $dari_tanggal,
            'sampai_tanggal' => $sampai_tanggal,
        ]);
    }
}
