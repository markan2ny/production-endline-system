<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GproController extends Controller
{

    public function home() {

        $styles = \App\Models\Style::orderBy('id', 'desc')->get();

        return view('dashboard.gpro.style_table', compact('styles'));
    }

    public function record($id) {
        // Working on style
        $data = \App\Models\Style::where('id', $id)->get();

        $records = DB::select('SELECT r.*, u.id FROM records AS r INNER JOIN users AS u ON r.user_entry_id = u.id ORDER BY r.id DESC');


        return view('dashboard.gpro.record')->with(compact('data'))->with(compact('records'));
    }

    public function storeRecord(Request $request, $id) {

        $request->validate([
            'date' => ['required'],
            'bundle_tag' => ['required'],
            'operator' => ['required'],
            'operation' => ['required'],
            'qty' => ['required']
        ]);

        $insert = \App\Models\Record::insert([
            'date_time' => $request->date,
            'bundle_tag' => $request->bundle_tag,
            'operator' => $request->operator,
            'operation' => $request->operation,
            'qty' => $request->qty,
            'user_entry_id' => Auth::user()->id,
        ]);

        return redirect()->route('gpro.record', $id)->with('success', 'New entry has been added.');

        
    
   
    }
}
