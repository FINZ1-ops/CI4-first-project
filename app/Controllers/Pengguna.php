<?php

namespace App\Controllers;

// use App\Controllers\BaseController;

class Pengguna extends BaseController
{
    public function index()
    {
       $search = $this->request->getGet('search');

       $semua =[
            ['name' => 'Alex',  'email' => 'alex@example.com'],
            ['name' => 'Budi',  'email' => 'budi@example.com'],
            ['name' => 'Citra', 'email' => 'citra@example.com'],
            ['name' => 'Deni',  'email' => 'deni@example.com'],
            ['name' => 'Eka',   'email' => 'eka@example.com'],
            ['name' => 'Fajar', 'email' => 'fajar@example.com'],
            ['name' => 'Gita',  'email' => 'gita@example.com'],
       ];

       if ($search){
         $pengguna = array_filter($semua, function($p) use ($search) {
            return stripos($p['name'], $search) !== false;
        });
       } else {
        $pengguna = $semua;

       }

       $data = [
        'title'=>'Data Pengguna',
        'pengguna' => $pengguna,
        'search' => $search,
       ];

       return view('page/pengguna', $data);
    }
}