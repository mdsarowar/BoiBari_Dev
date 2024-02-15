<?php

namespace App\Http\Controllers;

use App\ShippingCoupan;

use Illuminate\Http\Request;

class ShippingCoupanController extends Controller
{
    public function index()
    {
        $shippingcoupan = ShippingCoupan::first();
        return view('admin.shipping_coupan.index', compact('shippingcoupan'));
    }

    public function create(){
        $global = ShippingCoupan::first();
        return view('admin.shipping_coupan.create',compact('global'));
    }

    public function update(Request $request)
    {
        $data = ShippingCoupan::first();
        $input = $request->all();

        if(isset($data))
        {
            $data->name =  $request->name;
            $data->status = isset($request->shipping_coupan_status) ? '1' : '0';
            $data->coupan_type = $request->filter_by;
            $data->number_of_price = $request->number_of_price;
            $data->save();
            // $data->update($input);
        }
        else
        {
            $params['name'] = $request->name;
            $params['status'] = isset($request->shipping_coupan_status) ? '1' : '0';
            $params['coupan_type'] = $request->filter_by;
            if($request->filter_by=='fix')
            $params['number_of_price'] = $request->number_of_price_fix;
            else
            $params['number_of_price'] = $request->number_of_price;
            $data = ShippingCoupan::create($params);
        }
        return back()->with('success',trans('flash.UpdatedSuccessfully'));
    }
}
