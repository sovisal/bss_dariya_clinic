<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AbilityModule;
use App\Http\Requests\UserRequest;
use App\Models\Doctor;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$data = [
			'users' => User::where('isWebDev', false)->with('hasRoles')->orderBy('name', 'asc')->get(),
		];
		return view('user.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$data = [
			'positions' => [
				'' => __('form.please_select'),
				'Author' => 'Author',
			],
			'gender' => [
				[
					'id' => 'male',
					'value' => '0',
					'checked' => true,
					'label' => __('form.male')
				],
				[
					'id' => 'female',
					'value' => '1',
					'checked' => false,
					'label' => __('form.female')
				],
			],
			'doctor' => Doctor::orderBy('name_en', 'asc')->get(),
		];
		return view('user.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(UserRequest $request)
	{
		$user = User::create([
			'name' => $request->name,
			'username' => $request->username,
			'password' => Hash::make($request->password),
			'phone' => $request->phone,
			'gender' => $request->gender,
			'position' => $request->position,
			'address' => $request->address,
			'bio' => $request->bio,
			'doctor' => $request->doctor_id ?: 0,
			'color' => bg_random()
		]);
		$url = route('user.index');
		if ($request->save_opt == 'save_create') {
			$url = route('user.create');
		}else if($request->save_opt == 'save_edit'){
			$url = route('user.edit', $user->id);
		}
		return redirect($url)->with('success', __('alert.message.success.crud.create'));
	}
	
	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(User $user)
	{
		$data = [
			'user' => $user,
			'gender' => [
				[
					'id' => 'male',
					'value' => '0',
					'label' => __('form.male')
				],
				[
					'id' => 'female',
					'value' => '1',
					'label' => __('form.female')
				],
			],
			'doctor' => Doctor::orderBy('name_en', 'asc')->get(),
		];
		return view('user.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UserUpdateRequest $request, User $user)
	{
		$user->update([
			'name' => $request->name,
			'phone' => $request->phone,
			'gender' => $request->gender,
			'position' => $request->position,
			'is_suspended' => ($request->is_suspended == 'on' ? true : false),
			'address' => $request->address,
			'bio' => $request->bio,
			'doctor' => $request->doctor_id ?: 0
		]);
		return back()->with('success', __('alert.message.success.crud.update'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function checkUserID(Request $request)
	{
		$user = User::select(['username', 'image'])->where('username', $request->user)->first();
		if ($user) {
			return response()->json([
				'success' => true,
				'username' => $user->username,
				'userimage' => $user->image
			]);
		}

		return response()->json([
			'success' => false,
		]);
		
	}

	public function role(User $user)
	{
		$data = [
			'user' => $user,
			'roles' => Role::orderBy('label', 'asc')->get()
		];
		return view('user.role', $data);
	}

	public function assign_role(Request $request, User $user)
	{
		$user->assignRole($request->role);
		return redirect(route('user.index'))->with('success', __('alert.message.success.crud.update'));
	}

	public function ability(User $user)
	{
		$data = [
			'user' => $user,
			'ability_modules' => AbilityModule::with([
				'abilities' => function ($query){
					$query->orderBy('category', 'asc');
				},
			])
			->orderBy('module', 'asc')
			->get()
		];
		return view('user.ability', $data);
	}

	public function assign_ability(Request $request, User $user)
	{
		$user->allowTo($request->ability);
		return back()->with('success', __('alert.message.success.crud.update'));
	}


	public function password(User $user)
	{
		$data = [
			'user' => $user,
			'gender' => [
				[
					'id' => 'male',
					'value' => '0',
					'label' => __('form.male')
				],
				[
					'id' => 'female',
					'value' => '1',
					'label' => __('form.female')
				],
			]
		];
		return view('user.password', $data);
	}

	public function update_password(Request $request, User $user)
	{
		if (! Auth::guard('web')->validate([
			'username' => $user->username,
			'password' => $request->current_password,
		])) {
			throw ValidationException::withMessages([
				'current_password' => __('auth.password'),
			]);
		}
		$request->validate([
			'password' => ['required','min:8', 'confirmed']
		]);
		
		$user->update([
			'password' => Hash::make($request->password),
		]);
		return back()->with('success', __('alert.message.success.crud.update'));
	}

	
	public function account($type)
	{
		$ability_modules = [];
		if ($type=='ability') {
			$ability_modules = AbilityModule::with([
												'abilities' => function ($query){
													$query->orderBy('category', 'asc');
												},
											])
											->get();
		}
		$data = [
			'type' => $type,
			'gender' => [
				[
					'id' => 'male',
					'value' => '0',
					'label' => __('form.male')
				],
				[
					'id' => 'female',
					'value' => '1',
					'label' => __('form.female')
				],
			],
			'ability_modules' => $ability_modules
		];
		return view('user.account', $data);
	}

	
	public function update_account(Request $request, $type)
	{
		$user = User::find(auth()->user()->id);
		if ($type == 'change_password') {
			if (! Auth::guard('web')->validate([
				'username' => $user->username,
				'password' => $request->current_password,
			])) {
				throw ValidationException::withMessages([
					'current_password' => __('auth.password'),
				]);
			}
			$request->validate([
				'password' => ['required','min:8', 'confirmed']
			]);
			
			$user->update([
				'password' => Hash::make($request->password),
			]);
		}elseif ($type == 'image') {

			if ($request->image) {

				$data = $request->image;
				list($type, $data) = explode(';', $data);
				list(, $data)      = explode(',', $data);
				$data = base64_decode($data);
				if ($user->image) {
					$old_path = public_path('images/users/'. $user->image);
					if(File::exists($old_path)) {
						File::delete($old_path);
					}
				}
				$profileImage = $user->id .'_'. time() . ".png";
				$path = public_path('images/users/'. $profileImage);
				file_put_contents($path, $data);

				$user->update([
					'image' => $profileImage
				]);
				
				
				return response()->json([
					'success' => true
				]);

			}else{
				return response()->json([
					'success' => false,
					'message' => __('validation.required', [ 'attribute' => 'image' ])
				]);
			}

		}else{
			$user->update([
				'name' => $request->name,
				'phone' => $request->phone,
				'position' => $request->position,
				'gender' => $request->gender,
				'address' => $request->address,
				'bio' => $request->bio
			]);
		}
		return back()->with('success', __('alert.message.success.crud.update'));
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(User $user)
	{
		if ($user->delete()) {
			return back()->with('success', __('alert.message.success.crud.delete'));
		}
		return back()->with('error', __('alert.message.error.crud.delete'));
	}
}
