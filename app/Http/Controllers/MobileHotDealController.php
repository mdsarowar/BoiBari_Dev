<?php

namespace App\Http\Controllers;

use App\MobileHotDeal;
use Illuminate\Http\Request;
use Image;

class MobileHotDealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['hotdeal'] = MobileHotDeal::first();
        return view('admin.mobile_hotdeal.setting',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.mobile_hotdeal.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $img = '';
        if ($file = $request->file('image')) {

            $optimizeImage = Image::make($file);
            $optimizePath = public_path() . '/images/mobile_hotdeal/';
            $image = time() . $file->getClientOriginalName();
            $optimizeImage->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            });
            $optimizeImage->save($optimizePath . $image, 72);

            $img = $image;
        }
        $params['image'] = $img;
        if($request->id){
            MobileHotDeal::whereId($request->id)->update($params);
        } else {
            MobileHotDeal::create($params);
        }
        
        notify()->success(__('Update successfully'));
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MobileHotDeal  $mobileHotDeal
     * @return \Illuminate\Http\Response
     */
    public function show(MobileHotDeal $mobileHotDeal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MobileHotDeal  $mobileHotDeal
     * @return \Illuminate\Http\Response
     */
    public function edit(MobileHotDeal $mobileHotDeal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MobileHotDeal  $mobileHotDeal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MobileHotDeal $mobileHotDeal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MobileHotDeal  $mobileHotDeal
     * @return \Illuminate\Http\Response
     */
    public function destroy(MobileHotDeal $mobileHotDeal)
    {
        //
    }
}
