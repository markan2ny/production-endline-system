<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index() {

        $styles = DB::select('SELECT * FROM styles ORDER BY id DESC');

        return view('dashboard.user.index', compact('styles'));
    }
    public function gproStyles() {

        return view('dashboard.user.style');

    }
}
