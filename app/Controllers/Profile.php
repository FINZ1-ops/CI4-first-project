<?php

namespace App\Controllers;

class Profile extends BaseController
{
    public function index()
    {
        return view('page/profile',[
            'title'=>'Profile saya',
        ]);
    }
}
