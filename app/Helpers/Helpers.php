<?php

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

// function sidebarActive($active)
// {
// 	$routename = explode('.', Route::currentRouteName());
// 	if (count($routename) < 1) {
// 		return false;
// 	}elseif (count($routename) == 1){
// 		$i = count($routename)-1;
// 		return ($routename[$i] == $active);
// 	}else{
// 		$i = count($routename)-2;
// 		return ($routename[$i] == $active);
// 	}
// }
function mainMenuActive($active)
{
	return ($active == module());
}
function subMenuActive($active)
{
	return ($active == subModule());
}

function module()
{
	$routename = explode('.', Route::currentRouteName());
	return $routename[count($routename) > 1 ? count($routename)-2 : count($routename)-1];
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