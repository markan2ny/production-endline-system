<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GproController extends Controller
{
    public function group(){
        // Group of Production
        $groups = DB::select('SELECT * FROM groups WHERE isHide = 0 ORDER BY created_at DESC');
        return view('dashboard.gpro.group', compact('groups'));
    }
    public function storeGroup(Request $request) {
        $request->validate([
            'group_name' => ['required'],
            'group_desc' => ['required'],
        ]);


    }

    public function record($id) {
        // Working on style
        $data = DB::select("SELECT * FROM styles WHERE id = $id LIMIT 1");
        return view('dashboard.gpro.record', compact('data'));
    }
}
