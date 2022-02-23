<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class DBBackupController extends Controller
{

	public function index()
	{
		$data = [
			'databases' => Storage::disk('db_backup')->allFiles()
		];

		return view('db_backup.index', $data);
	}

	public function backup()
	{
		Artisan::call('db:backup');
		return back()->with('success', __('alert.message.success.backup'));
	}

	public function download($filename)
	{
		$path = 'db_backup/'. $filename;
		$zip_path = zipFile( $filename , $path, storage_path('db_backup/'), false);
		return response()->download($zip_path)->deleteFileAfterSend(true);
	}

	public function destroy($filename)
	{
		$path = storage_path('db_backup/'. $filename);
		if(File::exists($path)){
			File::delete($path);
		}
		return back()->with('success', __('alert.message.success.crud.delete'));
	}

}
