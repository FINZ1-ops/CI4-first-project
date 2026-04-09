<?php

namespace App\Controllers;

class Penjualan extends BaseController
{
    public function index()
    {
          $data = [
       'title' => 'Laporan Penjualan',
       'produk_minggu' => [
           ['nama' => 'iPhone 15',    'terjual' => 48, 'pendapatan' => 408000000],
           ['nama' => 'MacBook Pro',  'terjual' => 12, 'pendapatan' => 300000000],
           ['nama' => 'Samsung S24',  'terjual' => 35, 'pendapatan' => 175000000],
           ['nama' => 'iPad Pro',     'terjual' => 20, 'pendapatan' => 240000000],
           ['nama' => 'Sony WH-1000', 'terjual' => 55, 'pendapatan' => 82500000],
       ],
       'produk_bulan' => [
           ['nama' => 'iPhone 15',    'terjual' => 210, 'pendapatan' => 1785000000],
           ['nama' => 'MacBook Pro',  'terjual' => 54,  'pendapatan' => 1350000000],
           ['nama' => 'Samsung S24',  'terjual' => 180, 'pendapatan' => 900000000],
           ['nama' => 'iPad Pro',     'terjual' => 95,  'pendapatan' => 1140000000],
           ['nama' => 'Sony WH-1000', 'terjual' => 240, 'pendapatan' => 360000000],
       ],
       'produk_tahun' => [
           ['nama' => 'iPhone 15',    'terjual' => 2400, 'pendapatan' => 20400000000],
           ['nama' => 'MacBook Pro',  'terjual' => 620,  'pendapatan' => 15500000000],
           ['nama' => 'Samsung S24',  'terjual' => 1800, 'pendapatan' => 9000000000],
           ['nama' => 'iPad Pro',     'terjual' => 1100, 'pendapatan' => 13200000000],
           ['nama' => 'Sony WH-1000', 'terjual' => 2800, 'pendapatan' => 4200000000],
       ],
          ];

	    return view('page/penjualan', $data);
    }
}
