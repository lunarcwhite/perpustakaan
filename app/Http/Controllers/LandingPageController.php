<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class LandingPageController extends Controller
{
    function getBuku()
    {
        return Buku::with('kategori')->get();
    }
    public function index()
    {
        $data['bukus'] = $this->getBuku();
        return view('landing_page.index')->with($data);
    }
}
