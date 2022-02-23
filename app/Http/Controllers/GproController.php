<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GproController extends Controller
{

    public function home() {

        $styles = \App\Models\Style::orderBy('id', 'desc')->get();

        return view('dashboard.gpro.style_table', compact('styles'));
    }

    public function record($id) {
        // Working on style
        $data = \App\Models\Style::findOrFail($id)->first();

        return view('dashboard.gpro.record', compact('data'));
    }

    public function storeRecord(Request $request) {
        dd($request->all());
    }
}
