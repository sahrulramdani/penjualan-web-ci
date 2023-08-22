<?php

namespace App\Controllers;

class PenjualanController extends BaseController
{
    public function index(): string
    {
        return view('pages/penjualan');
    }
}
