<?php

namespace App\Controllers;

class PelangganController extends BaseController
{
    public function index(): string
    {
        return view('pages/pelanggan');
    }
}
