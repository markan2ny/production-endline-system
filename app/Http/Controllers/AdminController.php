<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
    }

    public function storeUser(Request $request) {

        // dd($request->assignedto);
        
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'assignedto' => ['required'],
            'password' => ['required', 'confirmed'],
        ]);

        $data = ['name' => $request->name, 'email' => $request->email, 'password' => Hash::make($request->password), 'assigned_id' => $request->assignedto];

        User::insert($data);

        return redirect()->route('admin.user')->with('success', 'New user has been added.');


    }

    public function storeStyle(Request $request) {

        $request->validate([
            'style_code' => ['required','string'],
            'style_desc' => ['required','string'],
        ]);

        $style = DB::table('styles')->insert([
            'style_code' => $request->style_code, 'style_desc' => $request->style_desc, 'quota' => $request->quota, 'author_id' => Auth::user()->id , 'created_at' => Carbon::now()
        ]);

        return $style ? redirect()->route('admin.styles')->with('success', 'New style has been added.') : redirect()->route('admin.styles')->with('error', 'Ops something wrong.');
    }

    public function showStyle(Request $request) {

        // $data = \App\Models\Style::select(['styles.*', 'all_users' => \App\Models\User::selectRaw('MAX(created_at)')])->whereColumn('id', 'id')->get();

        // $styles = DB::select('SELECT s.*, u.name FROM styles AS s INNER JOIN users AS u ON s.author_id = u.id');
        
        $styles = \App\Models\Style::with('author')
                ->when($request->has('archive'), function($query) {
                    $query->onlyTrashed();
                })

                ->get();
        
        
        // $styles = DB::select('SELECT * FROM styles ORDER BY id DESC');
        return view('dashboard.admin.styles', compact('styles'));

    }

    public function styleSoftdelete(\App\Models\Style $style) {

        $style->delete();

        return redirect()->route('admin.styles')->with('success', $style->style_code. 'has been deleted.');

    }

    public function showUser() {

       $users = DB::select('SELECT u.name, u.email, g.group_name as department FROM users AS u INNER JOIN groups AS g ON u.assigned_id = g.id ORDER BY u.id DESC');

    //    return DataTables::of($users)->make(true);

        return view('dashboard.admin.user', compact('users'));
    }

    public function record() { return view('dashboard.admin.group'); }
    public function storeGroup(Request $request) {

        $request->validate([
            'group_name' => ['required', 'string', 'unique:groups'],
            'group_desc' => ['required', 'string'],
        ]);

        Group::create(['group_name' => $request->group_name, 'group_desc' => $request->group_desc]);

        return redirect()->route('admin.group')->with('success', 'New group has been added.');

    }

    public function createGroup() {
        return view('dashboard.admin.create_new_group');
    }

    public function showGroup() {
        // Select all active groups to our table.
        $groups = DB::select('SELECT * FROM groups ORDER BY id DESC');

        return view('dashboard.admin.group', compact('groups'));
    }

    public function CreateUserAndattachGroup() {
        // This will be attach to select group.
        $groups = DB::select('SELECT * FROM groups ORDER BY created_at DESC ');
        return view('dashboard.admin.register')->with(compact('groups'));
    }


}
