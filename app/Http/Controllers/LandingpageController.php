<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
