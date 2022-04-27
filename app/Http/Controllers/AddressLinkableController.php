<?php

namespace App\Http\Controllers;

use App\Models\FourLevelAddress;
use Illuminate\Http\Request;
use App\Models\Address_linkable;
use App\Http\Requests\StoreAddress_linkableRequest;
use App\Http\Requests\UpdateAddress_linkableRequest;

class AddressLinkableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAddress_linkableRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $insertable = [];
        $insertable['type'] = 'general';

        if ($request->pt_province_id && $request->pt_province_id > 0) {
            $obj = FourLevelAddress::where('_code', $request->pt_province_id)->first();
            if ($obj) {
                $insertable['province_en'] = $obj->_name_en;
                $insertable['province_kh'] = $obj->_name_kh;
                $insertable['province_code'] =$obj->_code; 
            }
        }

        if ($request->pt_district_id && $request->pt_district_id > 0) {
            $obj = FourLevelAddress::where('_code', $request->pt_district_id)->first();
            if ($obj) {
                $insertable['district_en'] = $obj->_name_en;
                $insertable['district_kh'] = $obj->_name_kh;
                $insertable['district_code'] = $obj->_code; 
            }
        }

        if ($request->pt_commune_id && $request->pt_commune_id > 0) {
            $obj = FourLevelAddress::where('_code', $request->pt_commune_id)->first();
            if ($obj) {
                $insertable['commune_en'] = $obj->_name_en;
                $insertable['commune_kh'] = $obj->_name_kh;
                $insertable['commune_code'] = $obj->_code; 
            }
        }

        if ($request->pt_village_id && $request->pt_village_id > 0) {
            $obj = FourLevelAddress::where('_code', $request->pt_village_id)->first();
            if ($obj) {
                $insertable['village_en'] = $obj->_name_en;
                $insertable['village_kh'] = $obj->_name_kh;
                $insertable['village_code'] = $obj->_code; 
            }
        }

        if (sizeof($insertable) > 0) {
            $address = Address_linkable::create($insertable);
            if ($address) {
                return $address->id;
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Address_linkable  $address_linkable
     * @return \Illuminate\Http\Response
     */
    public function show(Address_linkable $address_linkable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Address_linkable  $address_linkable
     * @return \Illuminate\Http\Response
     */
    public function edit(Address_linkable $address_linkable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAddress_linkableRequest  $request
     * @param  \App\Models\Address_linkable  $address_linkable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $address_id)
    {
        $old = Address_linkable::findOrFail($address_id);

        $updateable = [];
        $updateable['type'] = 'general';

        if ($request->pt_province_id && $request->pt_province_id > 0 && $old->province_code != $request->pt_province_id) {
            $obj = FourLevelAddress::where('_code', $request->pt_province_id)->first();
            if ($obj) {
                $updateable['province_en'] = $obj->_name_en;
                $updateable['province_kh'] = $obj->_name_kh;
                $updateable['province_code'] =$obj->_code; 
            }
        }

        if ($request->pt_district_id && $request->pt_district_id > 0 && $old->district_code != $request->pt_district_id) {
            $obj = FourLevelAddress::where('_code', $request->pt_district_id)->first();
            if ($obj) {
                $updateable['district_en'] = $obj->_name_en;
                $updateable['district_kh'] = $obj->_name_kh;
                $updateable['district_code'] = $obj->_code; 
            }
        }

        if ($request->pt_commune_id && $request->pt_commune_id > 0 && $old->commune_code != $request->pt_commune_id) {
            $obj = FourLevelAddress::where('_code', $request->pt_commune_id)->first();
            if ($obj) {
                $updateable['commune_en'] = $obj->_name_en;
                $updateable['commune_kh'] = $obj->_name_kh;
                $updateable['commune_code'] = $obj->_code; 
            }
        }

        if ($request->pt_village_id && $request->pt_village_id > 0 && $old->village_code != $request->pt_village_id) {
            $obj = FourLevelAddress::where('_code', $request->pt_village_id)->first();
            if ($obj) {
                $updateable['village_en'] = $obj->_name_en;
                $updateable['village_kh'] = $obj->_name_kh;
                $updateable['village_code'] = $obj->_code; 
            }
        }

        if (sizeof($updateable) > 0) {
            if ($old->update($updateable)) {
                return $address_id;
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address_linkable  $address_linkable
     * @return \Illuminate\Http\Response
     */
    public function destroy($address_id)
    {
        $old = Address_linkable::findOrFail($address_id);
        $old->delete();
    }
}
