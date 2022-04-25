<?php

namespace App\Http\Controllers;

use App\Models\Style;
use App\Models\Record;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\RecordStoreRequest;

class GproController extends Controller
{

    public function home() {
        $login_id = Auth::user()->id;
        // Fetch data from styles
        $styles = DB::table('styles')->orderBy('id','desc')->get();

        $records = DB::select("SELECT r.*, u.name FROM records AS r RIGHT JOIN users AS u ON r.user_entry_id = u.id WHERE r.isCompleted = false");

        // dd($records);
                            

        return view('dashboard.gpro.record', compact('styles', 'records'));

    }
    public function getModel($id) {
        // $cities = \App\Models\Style::whereHas('models', function ($query) {
        //     $query->whereId(request()->input('style_id', 0));
        // })->pluck('mo', 'id');
        $response = DB::table('model_entries')->where('style_id', $id)->get();

        return response()->json($response);

        // echo json_encode(DB::table('model_entries')->where('style_id', $id)->get());
    }
    public function store(RecordStoreRequest $request) {
        $generatedID = Helper::IDgenerator(new Record, 'uid', 5, 'PROD' );

        $model = DB::table('model_entries')->select('id', 'mo')->where('id', $request->model_id)->first();

        if($request->validated()) {
      
                $r = DB::table('records')
                                ->insert(
                                    [
                                        'uid' => $generatedID,
                                        'bundle_tag' => $request->bundle_tag,
                                        'date_time' => $request->date,
                                        'operation' => $request->operation,
                                        'operator' => $request->operator,
                                        'model' => $model->mo,
                                        'qty' => $request->qty,
                                        'qty_of_bad_item' => $request->bad_qty,
                                        'user_entry_id' => Auth::user()->id,
                                        'status' => $request->status,
                                        'checkedBy' => Auth::user()->name,
                                        'model_id' => $model->id,
                                        'created_at' => Carbon::now()
                                    ]
                                );

            return redirect()->route('gpro.home')->with('message', 'New record has been added.');
        }
        return redirect()->route('gpro.home');
    }

    public function completedRprt($id) {
        $d = DB::select("SELECT model_id, model, qty FROM records WHERE id = $id LIMIT 1");

        DB::table('model_target_quota')->insert(['model_name' => $d[0]->model, 'model_id' => $d[0]->model_id, 'today_qty' => $d[0]->qty, 'date_log' => Carbon::now()]);

        DB::table('records')->where('id', $id)->update(['isCompleted' => true]);
      
        return redirect()->route('gpro.home')->with('message', $id.' has been mark as completed.');
    }
}
