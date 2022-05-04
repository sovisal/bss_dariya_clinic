<?php

namespace App\Http\Controllers;

use App\Models\LaborItem;
use App\Models\LaborType;
use App\Http\Requests\StoreLaborItemRequest;
use App\Http\Requests\UpdateLaborItemRequest;
use Illuminate\Http\Request;

class LaborItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['rows'] = LaborItem::where('labor_items.status', 1)
                                ->select(['labor_items.*', 'labor_types.name_en as type_en'])
                                ->leftJoin('labor_types', 'labor_types.id', '=', 'labor_items.type')
                                ->orderBy('labor_items.index', 'asc')
                                ->get();
        return view('labor_item.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['type'] = LaborType::where('status', 1)->orderBy('index', 'asc')->get();
        return view('labor_item.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLaborItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataParent = new LaborItem();
        if ($dataParent->create([
            'name_en' => $request->name_en,
            'name_kh' => $request->name_kh,
            'min_range' => $request->min_range,
            'max_range' => $request->max_range,
            'unit' => $request->unit,
            'type' => $request->type,
            'index' => $request->index ?: 999,
            'other' => $request->other,
            'status' => 1,
        ])) {
            return redirect()->route('setting.labor-item.index')->with('success', 'Data created success');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LaborItem  $laborItem
     * @return \Illuminate\Http\Response
     */
    public function show(LaborItem $laborItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LaborItem  $laborItem
     * @return \Illuminate\Http\Response
     */
    public function edit(LaborItem $laborItem)
    {
        $data['type'] = LaborType::where('status', 1)->orderBy('index', 'asc')->get();
        $data['row'] = $laborItem;
        return view('labor_item.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLaborItemRequest  $request
     * @param  \App\Models\LaborItem  $laborItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LaborItem $laborItem)
    {
        $request['status'] = 1;
        if ($laborItem->update($request->all())) {
            return redirect()->route('setting.labor-item.index')->with('success', 'Data update success');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LaborItem  $laborItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(LaborItem $laborItem)
    {
        $laborItem->status = 0;
        if ($laborItem->update()) {
            return redirect()->route('setting.labor-item.index')->with('success', 'Data delete success');
        }
    }
}
