<?php

namespace App\Http\Controllers;

use App\Models\DataParent;
use App\Http\Requests\StoreDataParentRequest;
use App\Http\Requests\UpdateDataParentRequest;
use Illuminate\Http\Request;

class DataParentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type = $request->parent ?: session('data_parent_type') ?? 'blood_type';
        $this->data['parent'] = $type;
        $this->data['rows'] = DataParent::where('type', $type)->where('status', 1)->get();
        session(['data_parent_type' => $type]);
        return view('data_parent.index', $this->data);
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('data_parent.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\StoreDataParentRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
        $dataParent = new DataParent();
        $type = session('data_parent_type') ?? 'other';

        if ($dataParent->create([
            'title_en' => $request->title_en,
            'title_kh' => $request->title_kh,
            'description' => $request->description,
            'type' => $type,
            'status' => 1
        ])) {
            return redirect()->route('setting.data-parent.index')->with('success', 'Data created success');
        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\DataParent  $dataParent
	 * @return \Illuminate\Http\Response
	 */
	public function show(DataParent $dataParent)
	{
		//
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataParent  $dataParent
     * @return \Illuminate\Http\Response
     */
    public function edit(DataParent $dataParent)
    {
        $data = [];
        $data['row'] = $dataParent;
        return view('data_parent.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDataParentRequest  $request
     * @param  \App\Models\DataParent  $dataParent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataParent $dataParent)
    {
        $type = session('data_parent_type') ?? 'other';
        $request['status'] = 1;
        if ($dataParent->update($request->all())) {
            return redirect()->route('setting.data-parent.index')->with('success', 'Data update success');
        }
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\DataParent  $dataParent
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request, DataParent $dataParent)
	{
		$dataParent->status = 0;
        if ($dataParent->update()) {
            return redirect()->route('setting.data-parent.index')->with('success', 'Data delete success');
        }
	}

    /* Function to get value of data-parent (For table display)
    * Can be used in table display
    * example :  {{ (\App\Http\Controllers\DataParentController::getParentDataByType('nationality', 1)) }} type + id
    * this function is store in session for performance purpose
    */
    static function getParentDataByType($type, $id) {
        if (empty($type) || empty($id)) {
            return '';
        }

        $backup_type = session('backup_type') ?? '';
        $backup_rows = session('backup_rows') ?? [];
        if ($type && $backup_rows && $type == $backup_type && sizeof($backup_rows) > 0) {
            $rows = $backup_rows;
        } else {
            $rows = [];
            array_map(function ($obj) use (&$rows) {
                $rows[$obj['id']] = $obj;
            }, DataParent::where('type', $type)->get()->toArray());
            session(['backup_type' => $type]);
            session(['backup_rows' => $rows]);
        }

        if (sizeof($rows) > 0)  {
            // return array_key_exists($id, $rows) ? ($rows[$id]['title_en'] . ' :: ' . $rows[$id]['title_kh']) : '';
            return array_key_exists($id, $rows) ? $rows[$id]['title_en'] : '';
        }
        return '';
    }

    /* Function to get value of data-parent (For dropdown selection)
    * Can be used in form selection
    * example :  {{ (\App\Http\Controllers\DataParentController::getParentDataSelection('nationality')) }} type
    */
    static function getParentDataSelection($type = '') {
        if (!$type) {
            return [];
        }

        $rows = [];
        array_map(function ($obj) use (&$rows) {
            $rows[$obj['id']] = $obj['title_en'] . ' :: ' . $obj['title_kh'];
        }, DataParent::where('type', $type)->where('status', 1)->orderBy('title_en', 'ASC')->get()->toArray());

        return $rows;
    }
}
