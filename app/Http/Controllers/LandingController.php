<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Product;
use App\Models\UmkmProfile;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $products = Product::latest()->take(6)->get();
        $contents = Content::all()->groupBy('type');
        $umkm = UmkmProfile::first();

        return view('landing', compact(
            'products',
            'contents',
            'umkm'
        ));
    }
}