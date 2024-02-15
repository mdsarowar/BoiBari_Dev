<?php

namespace App\Http\Controllers;
use App\BestSellerFilter;


use Illuminate\Http\Request;

class BestSellerController extends Controller
{
    public function index()
    {
        return view('admin.bestseller.index');
    }

    public function update(Request $request)
    {
        $data = BestSellerFilter::first();
        
        $input = $request->all();

        if(isset($data))
        {
        
            $data->filter_by =  $request->filter_by;
            $data->save();
            // $data->update($input);
        }
        else
        {
            $data = BestSellerFilter::create($input);
            $data->save();
        }
        return back()->with('success',trans('flash.UpdatedSuccessfully'));
    }
}