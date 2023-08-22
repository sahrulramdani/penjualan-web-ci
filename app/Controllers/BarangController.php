<?php

namespace App\Controllers;

class BarangController extends BaseController
{
    public function index(): string
    {
        return view('pages/barang');
    }
}
