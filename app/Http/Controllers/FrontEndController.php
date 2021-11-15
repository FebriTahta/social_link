<?php

namespace App\Http\Controllers;
use App\Models\Aplikasi;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function fe_landing_page(Request $request, $slug_aplikasi)
    {
        $data = Aplikasi::where('slug', $slug_aplikasi)->first();
        return view('fe.index',compact('data'));
    }
}
