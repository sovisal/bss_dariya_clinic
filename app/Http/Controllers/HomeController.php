<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class HomeController extends Controller
{
	public function index()
	{
		return redirect(route('patient.index'));
		// return view('home');
	}

	public function git_pull()
	{
		if(!empty(env('GIT_USR')) && !empty(env('GIT_TOKEN')) && !empty(env('GIT_PATH')) && InternetIsConnected()){
			Artisan::call('git:pull');
		}
		return redirect()->back();
	}

	public function setting()
	{
		$setting = Setting::first();
		if (!$setting) {
			$setting = Setting::Create([
									'clinic_name_kh' => 'Clinic KH',
									'clinic_name_en' => 'Clinic EN',
									'sign_name_kh' => 'Name KH',
									'sign_name_en' => 'Name EN',
									'phone' => 'Phone',
									'address' => 'Address',
									'description' => 'Description',
								]);
		}
		$data = [
			'setting' => $setting
		];
		return view('setting', $data);
	}

	public function setting_update(Request $request)
	{
		$request->validate([
			'clinic_name_kh' => ['required', 'min:3', 'max:255', 'string'],
			'clinic_name_en' => ['required', 'min:3', 'max:255', 'string'],
			'address' => ['required', 'min:3', 'string'],
			'description' => ['required', 'min:3', 'string'],
		]);

		$setting = Setting::first();
		$setting->update([
			'clinic_name_kh' => $request->clinic_name_kh,
			'clinic_name_en' => $request->clinic_name_en,
			'sign_name_kh' => $request->sign_name_kh,
			'sign_name_en' => $request->sign_name_en,
			'address' => $request->address,
			'description' => $request->description,
		]);

		if ($request->logo && $request->logo != '/images/browse-image.jpg') {
			$data = $request->logo;
			list(, $data) = explode(';', $data);
			list(, $data)= explode(',', $data);
			$data = base64_decode($data);
			$path = public_path('images/site/logo.png');
			if(!File::exists(public_path('images/site'))) {
				File::makeDirectory(public_path('images/site'), $mode = 0777, true, true);
			}
			file_put_contents($path, $data);
		}
		return redirect(route('setting.edit'))->with('success', __('alert.message.success.crud.update'));

	}
}
