<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class TambahPesanController extends Controller
{
    //Show makanan
    public function pilih_makanan()
    {

        $menu = Menu::orderBy('id', 'DESC')
            ->where('is_deleted', '0')
            ->where('id_category', '1')
            ->get();
        return view('landingpage.order.order_makanan', compact('menu'));
    }
    public function pilih_minuman()
    {

        $menu = Menu::orderBy('id', 'DESC')
            ->where('is_deleted', '0')
            ->where('id_category', '2')
            ->get();
        return view('landingpage.order.order_makanan', compact('menu'));
    }
    public function order()
    {
        return view('landingpage.order.order_makanan');
    }
}
