<?php

namespace App\Http\Controllers;

use App\Models\FourLevelAddress;
use Illuminate\Http\Request;

class FourLevelAddressController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}

	public function index(Request $request)
	{
		$code_length = $request->addr ? strlen($request->addr) : 0;
		$this->data = [
			'address' => $code_length == 2 ? $this->District($request->addr) : ($code_length == 4 ? $this->Commune($request->addr) : ($code_length == 6 ? $this->Village($request->addr) : $this->Province())),
			'addr' => $request->addr
		];
		return view('4_level_address.index', $this->data);
	}

	public function BSSFullAddress($code = '08021103', $return_type = 'selection')
	{
		if (!$code) $code = '08021103';
		return array_map(function ($length, $level) use ($code, $return_type) {
			return $this->Platform($this->$level(substr($code, 0, $length - 2)), $return_type, substr($code, 0, $length));
		}, [2, 4, 6, 8], ['Province', 'District', 'Commune', 'Village']);
	}

	public function Province($code = null, $return_type = 'array')
	{
		return $this->Platform($this->Address([__FUNCTION__, 'Capital'], $code), $return_type);
	}

	public function District($code = null, $return_type = 'array')
	{
		return $this->Platform($this->Address([__FUNCTION__, 'Municipality', 'Khan'], $code), $return_type);
	}

	public function Commune($code = null, $return_type = 'array')
	{
		return $this->Platform($this->Address([__FUNCTION__, 'Sangkat'], $code), $return_type);
	}

	public function Village($code = null, $return_type = 'array')
	{
		return $this->Platform($this->Address(__FUNCTION__, $code), $return_type);
	}

	public function Address($level_type = 'Province', $code = null, $order_by = '_name_en')
	{
		// When Ajax request with 4 level address
		$code = $_POST['parent_code'] ?? $code;

		if (is_array($level_type)) $province = FourLevelAddress::whereIn('_type_en', $level_type);
		else $province = FourLevelAddress::where('_type_en', $level_type);

		if ($code) $province->where('_code', 'like',  $code . '%');
		return $province->orderBy($order_by)->limit(100)->get()->toArray();
	}

	// array|selection|datalist|option|array_selection
	public function Platform($address, $return_type = 'array', $selected = null)
	{
		// When Ajax request with 4 level address
		$return_type = isset($_POST['parent_code']) ? 'option' : $return_type;

		if ($return_type == 'selection') {
			$html_elements = '<select __ATTRIBUTES__>';
			foreach ($address as $addr) {
				$html_elements .= '<option ' . (($selected && $selected == $addr['_code']) ? 'selected' : '') . ' value="' . $addr['_code'] . '">' . render_synonyms_name($addr['_name_en'], $addr['_name_kh']) . '</option>';
			}
			$html_elements .= '</select>';
			return $html_elements;
		} else if ($return_type == 'option') {
			$html_elements = '<option value="">---- None ----</option>';
			foreach ($address as $addr) {
				$html_elements .= '<option ' . (($selected && $selected == $addr['_code']) ? 'selected' : '') . ' value="' . $addr['_code'] . '">' . render_synonyms_name($addr['_name_en'], $addr['_name_kh']) . '</option>';
			}
			return $html_elements;
		} else if ($return_type == 'array_selection') {
			$html_elements = [];
			foreach ($address as $addr) {
				$html_elements[$addr['_code']] = render_synonyms_name($addr['_name_en'], $addr['_name_kh']);
			}
			return [$html_elements, $selected];
		} else if ($return_type == 'datalist') {
			$html_elements = '<datalist __ATTRIBUTES__>';
			foreach ($address as $addr) {
				$html_elements .= '<option value="' . $addr['_name_kh'] . '">' . $addr['_name_en'] . '</option>';
			}
			$html_elements .= '</datalist>';
			return $html_elements;
		}
		return $address;
	}
}
