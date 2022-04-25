<?php

namespace App\Http\Controllers;

use App\Http\Requests\DateValidationRequest;
use App\Models\User;
use App\Models\Group;
use App\Models\ModelEntry;
use App\Models\Style;
use App\Models\Record;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
    }

    public function home() {

        $models = DB::select("SELECT * FROM styles");
        return view('dashboard.admin.index', compact('models'));

    }

    public function storeUser(Request $request) {
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
            'quota' => ['required'],
        ]);
        $style = DB::table('styles')->insert([
            'style_code' => $request->style_code, 'quota' => $request->quota, 'author_id' => Auth::user()->id , 'created_at' => Carbon::now()
        ]);
        return $style ? redirect()->route('admin.styles')->with('success', 'New style has been added.') : redirect()->route('admin.styles')->with('error', 'Ops something wrong.');
    }

    public function showStyle(Request $request) {
        
        $styles = DB::select("SELECT s.id, s.style_code, s.quota, s.status, u.name 
                                FROM styles AS s
                                INNER JOIN users AS u
                                ON s.author_id = u.id
                                GROUP BY s.id
                            ");
        return view('dashboard.admin.styles', compact('styles'));
    }

    public function deleteStyle($id) {
        
        DB::delete("DELETE FROM styles WHERE id = $id");

        return redirect()->back();
    }

    public function showUser() {
       $users = DB::select('SELECT u.name, u.email, u.id, g.group_name as department FROM users AS u INNER JOIN groups AS g ON u.assigned_id = g.id ORDER BY u.id DESC');
        return view('dashboard.admin.user', compact('users'));
    }

    public function deleteUser($id) {

        DB::delete("DELETE FROM users WHERE id = $id");
        return redirect()->back();
    }

    public function record() { 
        return view('dashboard.admin.group'); 
    }

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

    public function deleteGroup($id) {
        DB::delete("DELETE FROM groups WHERE id = $id");
        return redirect()->back();
    }

    public function CreateUserAndattachGroup() {
        $groups = DB::select('SELECT * FROM groups ORDER BY created_at DESC ');
        return view('dashboard.admin.register')->with(compact('groups'));
    }

    public function showModel($id) {

        $models = DB::table('model_entries as mt')
                    ->leftJoin('styles as s', 'mt.style_id', '=', 's.id')
                    ->select('mt.*', 's.style_code')
                    ->get();

        return view('dashboard.admin.mo', compact('models', 'id'));        
    }

    public function createModel($id, Request $request) {
        
        $so = DB::select("SELECT id, style_code AS SO FROM styles WHERE id = $id LIMIT 1");
        return view('dashboard.admin.create_new_model', compact('so'));

    }

    public function storeModel(Request $request, $id) {
        $style = DB::select("SELECT quota FROM styles WHERE id = $id LIMIT 1");
       $request->validate([
           'mo' => ['required', 'string', 'unique:model_entries'],
       ]);

        \App\Models\ModelEntry::insert(['mo'=>$request->mo, 'style_id' => $id, 'target_quota' => $style[0]->quota]);

        return redirect()->route('admin.show.model', $id)->with('success', 'New model has been added.');
    }

    public function editModel($id) {
        $model = DB::select(
            "SELECT m.*, s.style_code
            FROM model_entries AS m
            INNER JOIN styles AS s
            ON m.style_id = s.id WHERE m.id = $id 
            GROUP BY m.id
            "
        );
        
        return view('dashboard.admin.edit_model', compact('model'));

    }

    public function updateModel($id, Request $request) {
        DB::update("UPDATE model_entries SET mo = '$request->mo' WHERE id = $id");
        return redirect()->route('admin.show.model', $id);
    }

    public function deleteModel($id) {
        DB::delete("DELETE FROM model_entries WHERE id = $id");

        return redirect()->back();
    }

    // REPORT
    public function viewReport(Request $request) {
        $reports = DB::select("SELECT r.*, u.name FROM records AS r INNER JOIN users AS u ON r.user_entry_id = u.id WHERE isCompleted = true AND date_time BETWEEN '$request->fromdate' AND '$request->todate'");

        return view('dashboard.admin.report', compact('reports'));
    }
    
    // Quota
    public function viewQuota() {

        $models = DB::select("SELECT m.*, mt.*
                    FROM model_entries AS m 
                        INNER JOIN (
                            SELECT id, 
                            model_id, 
                            SUM(today_qty) AS total, 
                            date_log
                            FROM model_target_quota
                            GROUP BY id
                        ) AS mt ON m.id = mt.model_id");

        return view('dashboard.admin.quota', compact('models'));
    }
    // Chart
    public function chart() {
        $data = DB::select("SELECT * FROM records");

        dd($data);
    }

}
