<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class OnlyController extends Controller
{
    public function import()
    {
    	return view('import');
    }

    public function show(Product $product) 
    {
    	return view('product', compact('product'));
    }


}
