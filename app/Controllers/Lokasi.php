<?php

namespace App\Controllers;

/**
 * Lokasi Controller
 * Handles location (lokasi) data display with map visualization
 *
 * Features:
 * - Display export/import location data
 * - Filter and search functionality
 * - Statistical calculations
 * - Map data aggregation
 */
class Lokasi extends BaseController
{
    /**
     * Display location index page with filtering and map data
     *
     * Query Parameters:
     * - search: Search across city, province, or product names
     * - tipe: Filter by transaction type (semua/ekspor/impor)
     *
     * @return string Rendered location index view
     */
    public function index()
    {
        $search = $this->request->getGet('search');
        $filter_tipe = $this->request->getGet('tipe');

        /**
         * Sample location data
         * Structure: city, province, SVG ID, type, product, quantity, value, date, country
         */
        $semua = [
            // Export transactions
            ['kota' => 'Jakarta',    'provinsi' => 'DKI Jakarta',       'svg_id' => 'ID-JK', 'tipe' => 'ekspor', 'produk' => 'iPhone 15',        'jumlah' => 120, 'nilai' => 1020000000,  'tanggal' => '2026-06-01', 'negara' => 'Malaysia'],
            ['kota' => 'Surabaya',   'provinsi' => 'Jawa Timur',        'svg_id' => 'ID-JI', 'tipe' => 'ekspor', 'produk' => 'MacBook Pro',       'jumlah' => 45,  'nilai' => 1125000000, 'tanggal' => '2026-06-03', 'negara' => 'Singapura'],
            ['kota' => 'Bandung',    'provinsi' => 'Jawa Barat',        'svg_id' => 'ID-JB', 'tipe' => 'ekspor', 'produk' => 'Samsung S24',       'jumlah' => 80,  'nilai' => 680000000,  'tanggal' => '2026-06-05', 'negara' => 'Thailand'],
            ['kota' => 'Medan',      'provinsi' => 'Sumatera Utara',    'svg_id' => 'ID-SU', 'tipe' => 'ekspor', 'produk' => 'Sony WH-1000',      'jumlah' => 200, 'nilai' => 600000000,  'tanggal' => '2026-06-07', 'negara' => 'Vietnam'],
            ['kota' => 'Makassar',   'provinsi' => 'Sulawesi Selatan',  'svg_id' => 'ID-SN', 'tipe' => 'ekspor', 'produk' => 'iPad Pro',          'jumlah' => 60,  'nilai' => 900000000,  'tanggal' => '2026-06-09', 'negara' => 'Filipina'],
            ['kota' => 'Denpasar',   'provinsi' => 'Bali',              'svg_id' => 'ID-BA', 'tipe' => 'ekspor', 'produk' => 'Lenovo ThinkPad',   'jumlah' => 30,  'nilai' => 450000000,  'tanggal' => '2026-06-11', 'negara' => 'Australia'],
            ['kota' => 'Palembang',  'provinsi' => 'Sumatera Selatan',  'svg_id' => 'ID-SS', 'tipe' => 'ekspor', 'produk' => 'Dell XPS 13',       'jumlah' => 25,  'nilai' => 375000000,  'tanggal' => '2026-06-13', 'negara' => 'Jepang'],
            ['kota' => 'Semarang',   'provinsi' => 'Jawa Tengah',       'svg_id' => 'ID-JT', 'tipe' => 'ekspor', 'produk' => 'Google Pixel',      'jumlah' => 70,  'nilai' => 490000000,  'tanggal' => '2026-06-15', 'negara' => 'Korea Selatan'],
            ['kota' => 'Manokwari',   'provinsi' => 'Papua Barat',       'svg_id' => 'ID-PB', 'tipe' => 'ekspor', 'produk' => 'ASUS ROG Laptop',   'jumlah' => 15,  'nilai' => 300000000,  'tanggal' => '2026-06-17', 'negara' => 'Taiwan'],
            ['kota' => 'Mataram',    'provinsi' => 'Nusa Tenggara Barat','svg_id' => 'ID-NB', 'tipe' => 'ekspor', 'produk' => 'Amazon Echo Dot',   'jumlah' => 50,  'nilai' => 250000000,  'tanggal' => '2026-06-19', 'negara' => 'Amerika Serikat'],

            // Import transactions
            ['kota' => 'Jakarta',    'provinsi' => 'DKI Jakarta',       'svg_id' => 'ID-JK', 'tipe' => 'impor',  'produk' => 'iPhone 15',        'jumlah' => 120, 'nilai' => 1020000000,  'tanggal' => '2026-06-01', 'negara' => 'Malaysia'],
            ['kota' => 'Semarang',   'provinsi' => 'Jawa Tengah',       'svg_id' => 'ID-JT', 'tipe' => 'impor',  'produk' => 'Nintendo Switch',   'jumlah' => 150, 'nilai' => 600000000,  'tanggal' => '2026-06-02', 'negara' => 'Jepang'],
            ['kota' => 'Yogyakarta', 'provinsi' => 'DI Yogyakarta',     'svg_id' => 'ID-YO', 'tipe' => 'impor',  'produk' => 'LG OLED TV',        'jumlah' => 40,  'nilai' => 800000000,  'tanggal' => '2026-06-04', 'negara' => 'Korea Selatan'],
            ['kota' => 'Pontianak',  'provinsi' => 'Kalimantan Barat',  'svg_id' => 'ID-KB', 'tipe' => 'impor',  'produk' => 'Google Pixel',      'jumlah' => 90,  'nilai' => 486000000,  'tanggal' => '2026-06-06', 'negara' => 'Amerika Serikat'],
            ['kota' => 'Balikpapan', 'provinsi' => 'Kalimantan Timur',  'svg_id' => 'ID-KI', 'tipe' => 'impor',  'produk' => 'iPhone 15',         'jumlah' => 80,  'nilai' => 680000000,  'tanggal' => '2026-06-08', 'negara' => 'Amerika Serikat'],
            ['kota' => 'Manado',     'provinsi' => 'Sulawesi Utara',    'svg_id' => 'ID-SA', 'tipe' => 'impor',  'produk' => 'Samsung S24',       'jumlah' => 60,  'nilai' => 510000000,  'tanggal' => '2026-06-10', 'negara' => 'Korea Selatan'],
            ['kota' => 'Jayapura',   'provinsi' => 'Papua',             'svg_id' => 'ID-PA', 'tipe' => 'impor',  'produk' => 'MacBook Pro',       'jumlah' => 20,  'nilai' => 500000000,  'tanggal' => '2026-06-12', 'negara' => 'Taiwan'],
            ['kota' => 'Banjarmasin','provinsi' => 'Kalimantan Selatan','svg_id' => 'ID-KS', 'tipe' => 'impor',  'produk' => 'Sony WH-1000',      'jumlah' => 100, 'nilai' => 300000000,  'tanggal' => '2026-06-14', 'negara' => 'Jepang'],
            ['kota' => 'Ngawi',      'provinsi' => 'Jawa Timur',        'svg_id' => 'ID-JI', 'tipe' => 'impor',  'produk' => 'iPad Pro',          'jumlah' => 30,  'nilai' => 450000000,  'tanggal' => '2026-06-16', 'negara' => 'Amerika Serikat'],
            ['kota' => 'Samarinda',  'provinsi' => 'Kalimantan Timur',  'svg_id' => 'ID-KI', 'tipe' => 'impor',  'produk' => 'Dell XPS 13',       'jumlah' => 25,  'nilai' => 375000000,  'tanggal' => '2026-06-18', 'negara' => 'Amerika Serikat'],
            ['kota' => 'Kupang',     'provinsi' => 'Nusa Tenggara Timur','svg_id' => 'ID-NT','tipe' => 'impor',  'produk' => 'Lenovo ThinkPad',   'jumlah' => 15,  'nilai' => 300000000,  'tanggal' => '2026-06-20', 'negara' => 'China'],
        ];

        // Apply search and type filters
        $lokasi = array_filter($semua, function($l) use ($search, $filter_tipe) {
            if ($search && stripos($l['kota'], $search) === false &&
                           stripos($l['produk'], $search) === false &&
                           stripos($l['provinsi'], $search) === false) return false;
            if ($filter_tipe && $filter_tipe !== 'semua' && $l['tipe'] !== $filter_tipe) return false;
            return true;
        });

        $lokasi = array_values($lokasi);

        // Calculate statistics for display cards
        $totalEkspor = array_sum(array_column(array_filter($lokasi, fn($l) => $l['tipe']==='ekspor'), 'nilai'));
        $totalImpor  = array_sum(array_column(array_filter($lokasi, fn($l) => $l['tipe']==='impor'),  'nilai'));
        $totalLokasi = count($lokasi);

        // Aggregate data by province for map visualization
        $peta = [];
        foreach ($lokasi as $l) {
            $id = $l['svg_id'];
            if (!isset($peta[$id])) {
                $peta[$id] = ['tipe' => $l['tipe'], 'kota' => $l['kota'], 'count' => 0, 'nilai' => 0];
            }
            $peta[$id]['count'] += $l['jumlah'];
            $peta[$id]['nilai'] += $l['nilai'];
        }

        return view('page/lokasi', [
            'title'        => 'Data Lokasi',
            'lokasi'       => $lokasi,
            'peta'         => $peta,
            'totalEkspor'  => $totalEkspor,
            'totalImpor'   => $totalImpor,
            'totalLokasi'  => $totalLokasi,
            'search'       => $search,
            'filter_tipe'  => $filter_tipe ?? 'semua',
        ]);
    }
}