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
          ['id' => '#ORD-001', 'pelanggan' => 'Andi',  'produk' => 'iPhone 15',   'nominal' => 8500000,  'tanggal' => '2026-04-01', 'jumlah' => 1],
          ['id' => '#ORD-002', 'pelanggan' => 'Budi',  'produk' => 'Mouse Logitech 305', 'nominal' => 450000,   'tanggal' => '2026-04-02', 'jumlah' => 2],
          ['id' => '#ORD-003', 'pelanggan' => 'Citra', 'produk' => 'Monitor Samsung 24"', 'nominal' => 2800000,  'tanggal' => '2026-04-03', 'jumlah' => 1],
          ['id' => '#ORD-004', 'pelanggan' => 'Deni',  'produk' => 'Keyboard Mechanical',    'nominal' => 750000,   'tanggal' => '2026-04-04', 'jumlah' => 3],
          ['id' => '#ORD-005', 'pelanggan' => 'Eka',   'produk' => 'Sony WH-1000XM5',     'nominal' => 1200000,  'tanggal' => '2026-04-05', 'jumlah' => 1],
          ['id' => '#ORD-006', 'pelanggan' => 'Fajar', 'produk' => 'MacBook Pro', 'nominal' => 25000000, 'tanggal' => '2026-03-28', 'jumlah' => 1],
          ['id' => '#ORD-007', 'pelanggan' => 'Gita',  'produk' => 'iPad Pro',    'nominal' => 12000000, 'tanggal' => '2026-03-15', 'jumlah' => 2],   
          ['id' => '#ORD-008', 'pelanggan' => 'Hani',   'produk' => 'Apple Watch Series 9', 'nominal' => 5500000,  'tanggal' => '2026-03-20', 'jumlah' => 1],
          ['id' => '#ORD-009', 'pelanggan' => 'Irvan',  'produk' => 'Samsung Galaxy S24',   'nominal' => 11000000, 'tanggal' => '2026-03-25', 'jumlah' => 2],
          ['id' => '#ORD-010', 'pelanggan' => 'Jasmine','produk' => 'AirPods Pro',         'nominal' => 3200000,  'tanggal' => '2026-04-06', 'jumlah' => 1],
          ['id' => '#ORD-011', 'pelanggan' => 'Kamil',  'produk' => 'USB-C Hub',           'nominal' => 850000,   'tanggal' => '2026-04-07', 'jumlah' => 4],
          ['id' => '#ORD-012', 'pelanggan' => 'Lina',   'produk' => 'External SSD 1TB',    'nominal' => 1500000,  'tanggal' => '2026-04-08', 'jumlah' => 1],
          ['id' => '#ORD-013', 'pelanggan' => 'Mawan',  'produk' => 'Webcam Logitech 4K',  'nominal' => 2200000,  'tanggal' => '2026-03-30', 'jumlah' => 2],
          ['id' => '#ORD-014', 'pelanggan' => 'Nina',   'produk' => 'Microphone Condenser', 'nominal' => 1800000,  'tanggal' => '2026-04-09', 'jumlah' => 1],
          ['id' => '#ORD-015', 'pelanggan' => 'Oscar',  'produk' => 'NVIDIA RTX 4090',     'nominal' => 35000000, 'tanggal' => '2026-03-22', 'jumlah' => 1]
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
