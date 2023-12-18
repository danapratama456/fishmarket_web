<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class LandingpageController extends Controller
{
    //
    public function index()
	{

		return view('landingpage.index');
	}

	public function scan_table()
	{

		return view('landingpage.order.scan');
	}


	// ===================================================================================================================

	public function upload_menu()
	{

		$menu = Menu::orderBy('id', 'DESC')->where('is_deleted','0')->get();

		return view('landingpage.upload_menu.upload', compact('menu'));
	}


	public function upload_menu_add(Request $request)
	{

		// $kode_produk = mt_rand(1000000000, 9999999999);
		$data_add = new Menu();
		$data_add->id_restaurant = '1';
		$data_add->id_category = '1';
		$data_add->name = $request->input('name');
		$data_add->price = $request->input('price');
		
		$data_add->is_deleted = '0';

		if ($request->hasFile('image')) {
			$file = $request->file('image');
			$filename = $file->getClientOriginalName();
			$file->move('uploads/menu/', $filename);
			$data_add->image = $filename;
		} else {
			echo "Gagal upload gambar";
		}

		$data_add->save();

		return redirect()->back()->with('success', 'Produk Berhasil Ditambahkan');
	}

	public function upload_menu_delete(Request $request, $id)
	{


		$data_update = Menu::where('id', $id)->first();

		$input = [
			'is_deleted' => '1',
			
		];
		
		$data_update->update($input);


		return redirect()->back()->with('success', 'Berhasil Dihapus');
	}
}
