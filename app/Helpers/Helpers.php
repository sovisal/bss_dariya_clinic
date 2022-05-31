<?php

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Models\Address_linkable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;

function InternetIsConnected(){
	$connected = @fsockopen("www.google.com", 80);
	if ($connected) {
		fclose($connected);
		return true;
	}
	return false;
}

function can($ability)
{
	return auth()->user()->can($ability);
}

function mainMenuActive($active)
{
	return ($active == mainActive());
}
function subMenuActive($active, $sub = '')
{
	if ($sub!='') {
		$sub = $sub .'.';
	}
	if (is_array($active)) {
		foreach ($active as $key => $act) {
			if ($sub . $act== module() .'.'. subModule()) {
				return true;
			}
		}
	}else{
		return ($sub . $active == module() .'.'. subModule());
	} 
}

function module()
{
	$routename = explode('.', Route::currentRouteName());
	return $routename[count($routename) > 1 ? count($routename)-2 : count($routename)-1];
}

function mainActive()
{
	$routename = explode('.', Route::currentRouteName());
	if (count($routename) > 0) {
		return $routename[0];
	}
}

function subModule()
{
	$routename = explode('.', Route::currentRouteName());
	return $routename[count($routename)-1];
}

function breadCrumb()
{
	$routename = explode('.', Route::currentRouteName());
	$i = 0;
	$li = '';
	$active = '';
	foreach ($routename as $key => $value) {
		// GET First
		if ( ++$i === count($routename) ) {

			$crud = ['index','create','edit','show','image'];
			// Last Active
			if (in_array($value, $crud)) {
				$active .= __('breadcrumb.crud.'. $value);
			}else{
				$active .= __('breadcrumb.module.'. $value);
			}
			$li .= '<li class="breadcrumb-item active">'. $active .'</li>';
		} else if( $key === 0 ) {
			// Firtst Home
			if ($value == 'home') {
				$li .= '<li class="breadcrumb-item"><a href="'. route('home') .'"><i class="fa fa-user-shield"></i> '. __('breadcrumb.module.'. $value) .'</a></li>';
			}else if ($value == 'setting') {
				$li .= '<li class="breadcrumb-item"><a href="'. route('home') .'"> '. __('breadcrumb.module.'. $value) .'</a></li>';
			}else{
				$li .= '<li class="breadcrumb-item"><a href="'. route($value.'.index') .'">'. __('breadcrumb.module.'. $value) .'</a></li>';
			}
		}else if ( count($routename) > 3) {
			// if length 3 Level deep
			$li .= '<li class="breadcrumb-item"><a href="'. route($routename[1].'.'.$routename[2].'.index') .'">'. __('breadcrumb.module.'. $value) .'</a></li>';
		}else if ( count($routename) > 4) {
			// if length 4 Level deep
			$li .= '<li class="breadcrumb-item"><a href="'. route($routename[1].'.'.$routename[2].'.'.$routename[3].'.index') .'">'. __('breadcrumb.module.'. $value) .'</a></li>';
		}else{
			// if length normal crud
			$li .= '<li class="breadcrumb-item"><a href="'. route($value.'.index') .'">'. __('breadcrumb.module.'. $value) .'</a></li>';
		}
		// End if
	}
	// End Foreach
	return $li;
}

function round_up ( $value, $precision ) { 
	$pow = pow ( 10, $precision ); 
	return ( ceil ( $pow * $value ) + ceil ( $pow * $value - ceil ( $pow * $value ) ) ) / $pow; 
}

function is_decimal( $val ){
	return is_numeric( $val ) && floor( $val ) != $val;
}

function filter_unit_attr($attributes){
	$filtered_attributes = [];
	foreach($attributes as $key => $value){
		if (substr($key, strpos($key, "_unit") + 1) != 'unit') {
			$filtered_attributes[$key] = $value . ((array_key_exists($key.'_unit', $attributes))? ' '. $attributes[$key.'_unit'] : '');
		}
	}
	return $filtered_attributes;
}

function zipFile( $zip_file = 'file-zip.zip', $path, $destination_path, $sub_folder = true ){
	if ($zip_file!='file-zip.zip') {
		$zip_file .='.zip';
	}
	// Initializing PHP class
	$zip = new \ZipArchive();
	$output_path = storage_path('zipfiles/'. $zip_file);
	if ($destination_path!='') {
		$output_path = $destination_path . $zip_file;
	}
	$zip->open($output_path, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

	// Adding file: second parameter is what will the path inside of the archive
	// So it will create another folder called "storage/" inside ZIP, and put the file there.
	if ($sub_folder) {
		$zip->addFile(storage_path($path), $path);
	}else{
		$filename = substr($path, strpos($path, "/") + 1);
		$zip->addFile(storage_path($path), $filename);
	}
	$zip->close();

	return $output_path;
}

// function setting(){
// 	return Setting::first();
// }


function bg_random()
{
	$bg = [
		'blue-',
		'green-',
		'yellow-',
		'red-',
		'purple-',
		'gray-',
		'pink-',
		'indigo-',
	];
	$string_bg = $bg[rand(0, 7)] . rand(3, 9) . '00';
	return $string_bg;
}

function getParaClinicHeaderDetail($row = null)
{
	$row = is_null($row) ? new Collection : $row;
	$status_html = (($row->status==2)? '<span class="badge badge-primary">Completed</span>' : '<span class="badge badge-light">Incompleted</span>');
	$status_html .= (($row->payment_status==2)? '<span class="badge badge-success tw-ml-1">Paid</span>' : '<span class="badge badge-light tw-ml-1">Unpaid</span>');
	return '<table class="table-form table-header-info">
				<thead>
					<tr>
						<th colspan="4" class="text-left tw-bg-gray-100">Patient <span class="tw-pl-2 detail-status">'. $status_html .'</span></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td width="20%" class="text-right tw-bg-gray-100">Form</td>
						<td class="type">'. $row->type_en .'</td>
						<td width="20%" class="text-right tw-bg-gray-100">Code</td>
						<td class="code">'. $row->code .'</td>
					</tr>
					<tr>
						<td class="text-right tw-bg-gray-100">Name</td>
						<td class="name">'. $row->patient_kh .'</td>
						<td class="text-right tw-bg-gray-100">Requested date</td>
						<td class="requested_date">'. date('d/m/Y H:i', strtotime($row->requested_at)) .'</td>
					</tr>
					<tr>
						<td class="text-right tw-bg-gray-100">Requested by</td>
						<td class="reqeusted_by">'. $row->requested_by_name .'</td>
						<td class="text-right tw-bg-gray-100">Physician</td>
						<td class="physician">'. $row->physician .'</td>
					</tr>
					<tr>
						<td class="text-right tw-bg-gray-100">Payment type</td>
						<td class="payment_type">'. $row->payment_type_en .'</td>
						<td class="text-right tw-bg-gray-100">Amount</td>
						<td class="amount">'. $row->amount .' USD</td>
					</tr>
				</tbody>
			</table>';
}

// How to use in view : {{ getParentDataByType('enterprise', 1) }}
function getParentDataByType (...$param) {
	return \App\Http\Controllers\DataParentController::getParentDataByType(...$param);
}

// How to use getParentDataSelection('enterprise')
function getParentDataSelection(...$param) {
	return \App\Http\Controllers\DataParentController::getParentDataSelection(...$param);
}

// 4 Level address selector
function get4LevelAdressSelector (...$param) {
	$_4level_address = new \App\Http\Controllers\FourLevelAddressController();
	$_4level_level = $_4level_address->BSSFullAddress(...$param);
	return $_4level_level;
}

function get4LevelAdressSelectorByID ($id, ...$param) {
	if (Address_linkable::where('id', $id)->count() == 1) {
		$address = Address_linkable::findOrFail($id);
		$param[0] = $address->village_code ?: $address->commune_code ?: $address->district_code ?: $address->province_code ?: 'xx';
	}
	return get4LevelAdressSelector(...$param);
}

function update4LevelAddress ($request) {
	if ($request->address_id) {
		return app('App\Http\Controllers\AddressLinkableController')->update($request, $request->address_id);
	} else {
		return app('App\Http\Controllers\AddressLinkableController')->store($request);
	}
}

function delete4LevelAddress($addres_id) {
	return app('App\Http\Controllers\AddressLinkableController')->destroy($addres_id);
}

function append_array_to_obj (&$obj, $arr) {
	foreach ($arr ?: [] as $index => $val) {
		$obj->{$index} = $obj->{$index} ?: $val ?: '';
	}
	return $obj;
}

function data_parent_selection_conf() {
	return  [
		'gender' => [
			'label' => 'Gender',
			'is_invisible' => false,
		],
		'marital_status' => [
			'label' => 'Marital Status',
		],
		'blood_type' => [
			'label' => 'Blood Type',
		],
		'nationality' => [
			'label' => 'Nationality',
		],
		'enterprise' => [
			'label' => 'Enterprise',
		],
		'payment_type' => [
			'label' => 'Payment Type',
		],
		'evalutaion_category' => [
			'label' => 'Indication Category',
		],
		'indication_disease' => [
			'label' => 'Indication',
			'is_child' => true,
			'child_of' => 'evalutaion_category'
		],
		'comsumption' => [
			'label' => 'Comsumption',
		],
		'time_usage' => [
			'label' => 'Usage Time',
		],
	];
}

function apply_markdown_character($txt = '') {
	$result = [];
	if (!empty($txt)) {
		$result = $txt = str_split($txt);
		foreach ($txt as $key => $val) {
			if ($val == '^') {
				$result[$key] = '';
				$result[$key+1] = '<sup>' . $result[$key+1] . '</sup>';
			}
		}
	}

	return implode($result);
}

function render_readable_date ($date) {
	if ($date ?? false) {
		return date('d-M-Y', strtotime($date));
	}
}

function render_currency ($amn, $digit = 2, $currency = 'USD', $id_suffix_display = false) {
	$amn = $amn ?? 0;
	if ($id_suffix_display) {
		return number_format($amn, $digit) . ' ' . $currency;
	}
	return $currency . ' ' . number_format($amn, $digit);
}

function render_record_status ($st_num = 0) {
	$label = '';
	switch ($st_num) {
		case 0:
			$label = '<span class="badge badge-light">Disabled</span>';
			break;
		case 1:
			$label = '<span class="badge badge-light">Draft</span>';
			break;
		case 2:
			$label = '<span class="badge badge-success">Completed</span>';
			break;
		default :
			$label = '<span class="badge badge-light">' . $st_num . '</span>';
	}
	return $label;
}

function render_payment_status ($st_num = 0) {
	$label = '';
	switch ($st_num) {
		case 0:
			$label = '<span class="badge badge-light">Unpaid</span>';
			break;
		case 1:
			$label = '<span class="badge badge-success">Paid</span>';
			break;
	}
	return $label;
}


function generate_code ($prefix, $table_name) {

	#1, Get info from table
	#2, Check the current code incremet
	#3, Get the value and += 1

	$table_info = DB::select("SELECT TABLE_COMMENT FROM information_schema.TABLES WHERE TABLE_NAME = '{$table_name}';");
	$obj = unserialize(current($table_info)->TABLE_COMMENT);
	$obj['code_increment'] = $obj['code_increment'] ?? 0;
	$code_increment = ++$obj['code_increment'];
	DB::statement("ALTER TABLE {$table_name} COMMENT = '" . serialize($obj) ."';");

	return $prefix . '-' . str_pad($code_increment, 5, "0", STR_PAD_LEFT);
}

function render_synonyms_name($name_en = '', $name_kh = '')
{
	if (!empty($name_en) && !empty($name_kh) && trim(strtolower($name_en)) != trim(strtolower($name_kh))) {
		return $name_en . ' :: ' . $name_kh;
	} else {
		return $name_en ?: $name_kh ?: 'N/A';
	}
}
