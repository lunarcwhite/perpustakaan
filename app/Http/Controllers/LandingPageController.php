<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaranaPrasarana;

class LandingPageController extends Controller
{
    function getSaranaPrasarana()
    {
        return SaranaPrasarana::with('kategori')->get();
    }
    public function index()
    {
        $data['saranas'] = $this->getSaranaPrasarana();
        return view('landing_page.index')->with($data);
    }
}
