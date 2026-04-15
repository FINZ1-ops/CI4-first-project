<?php

namespace App\Controllers;

class Penjualan extends BaseController
{
    public function index()
    {
          $data = [
       'title' => 'Laporan Penjualan',
    'produk_minggu' => [
        ['nama' => 'Sony WH-1000', 'terjual' => 55, 'pendapatan' => 82500000],
        ['nama' => 'iPhone 15',    'terjual' => 48, 'pendapatan' => 408000000],
        ['nama' => 'Samsung S24',  'terjual' => 35, 'pendapatan' => 175000000],
        ['nama' => 'Speaker JBL', 'terjual' => 30, 'pendapatan' => 39000000],
        ['nama' => 'Nintendo Switch OLED', 'terjual' => 25, 'pendapatan' => 125000000],
        ['nama' => 'Smartwatch X', 'terjual' => 22, 'pendapatan' => 22000000],
        ['nama' => 'iPad Pro',     'terjual' => 20, 'pendapatan' => 240000000],
        ['nama' => 'Google Nest Hub', 'terjual' => 18, 'pendapatan' => 23400000],
        ['nama' => 'Laptop ASUS', 'terjual' => 15, 'pendapatan' => 225000000],
        ['nama' => 'MacBook Pro',  'terjual' => 12, 'pendapatan' => 300000000],
    ],
    'produk_bulan' => [
        ['nama' => 'iPhone 15',    'terjual' => 210, 'pendapatan' => 1785000000],
        ['nama' => 'Sony WH-1000', 'terjual' => 240, 'pendapatan' => 360000000],
        ['nama' => 'Samsung S24',  'terjual' => 180, 'pendapatan' => 900000000],
        ['nama' => 'Nintendo Switch OLED', 'terjual' => 150, 'pendapatan' => 750000000],
        ['nama' => 'Speaker JBL', 'terjual' => 120, 'pendapatan' => 156000000],
        ['nama' => 'iPad Pro',     'terjual' => 95,  'pendapatan' => 1140000000],
        ['nama' => 'Smartwatch X', 'terjual' => 88,  'pendapatan' => 88000000],
        ['nama' => 'Google Nest Hub', 'terjual' => 72,  'pendapatan' => 93600000],
        ['nama' => 'Laptop ASUS', 'terjual' => 60,  'pendapatan' => 900000000],
        ['nama' => 'MacBook Pro',  'terjual' => 54,  'pendapatan' => 1350000000],
    ],
    'produk_tahun' => [
        ['nama' => 'iPhone 15',    'terjual' => 2400, 'pendapatan' => 20400000000],
        ['nama' => 'Sony WH-1000', 'terjual' => 2200, 'pendapatan' => 4200000000],
        ['nama' => 'Nintendo Switch OLED', 'terjual' => 2000, 'pendapatan' => 10000000000],
        ['nama' => 'Samsung S24',  'terjual' => 1800, 'pendapatan' => 9000000000],
        ['nama' => 'Speaker JBL', 'terjual' => 1500, 'pendapatan' => 1950000000],
        ['nama' => 'Smartwatch X', 'terjual' => 1200,  'pendapatan' => 1200000000],
        ['nama' => 'iPad Pro',     'terjual' => 1100, 'pendapatan' => 13200000000],
        ['nama' => 'Google Nest Hub', 'terjual' => 900,  'pendapatan' => 1170000000],
        ['nama' => 'Laptop ASUS', 'terjual' => 800,  'pendapatan' => 12000000000],
        ['nama' => 'MacBook Pro',  'terjual' => 620,  'pendapatan' => 15500000000],
    ],
          ];

	    return view('page/penjualan', $data);
    }
}
