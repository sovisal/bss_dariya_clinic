<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class HomeController extends Controller
{
	public function index()
	{
		// return redirect()->route('sale.index');
		return view('home');
	}

	public function git_pull()
	{
		if(!empty(env('GIT_USR')) && !empty(env('GIT_TOKEN')) && !empty(env('GIT_PATH')) && InternetIsConnected()){
			Artisan::call('git:pull');
		}
		return redirect()->back();
	}

	public function deleteSelected(Request $request)
	{
		if ($request->table && $request->ids) {
			DB::table($request->table)->whereIn('id', $request->ids)->delete();
			return response()->json([
				'success' => true,
				'error' => ''
			]);
		}else{
			return response()->json([
				'success' => false,
				'error' => __('alert.message.error.data_not_found')
			]);
		}
	}
}
