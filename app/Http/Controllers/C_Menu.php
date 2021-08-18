<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use App\M_Barang;

use Illuminate\Http\Request;

class C_Menu extends Controller
{
    public function index()
    {
        $menus = M_Barang::all();

        return view('index', compact('menus'));
    }
}
