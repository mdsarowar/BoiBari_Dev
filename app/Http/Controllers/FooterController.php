<?php
namespace App\Http\Controllers;

use App\Footer;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class FooterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['permission:site-settings.footer-customize']);
    }

    public function index()
    {
        $row = Footer::first();
        return view("admin.footer.edit", compact("row"));
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $footer = Footer::first();
        $input = $request->all();
        if (empty($footer))
        {
            $data = Footer::create($input);
            $data->save();
            return back()->with("added", __("Footer has been created !"));
        }
        else
        {
            $footer->update($input);
            return back()->with("updated", __("Footer has been updated !"));
        }

    }

    public function news_latter()
    {
        $footer = Footer::first();
        return view("admin.footer.newslatter", compact("footer"));
    }

    public function update_news_latter(Request $request)
    {
        $footer = Footer::first();
        if ($file = $request->file('image')) {

            if ($footer->image !='' && file_exists(public_path() . '/images/newslatter/' . $footer->image)) {
                unlink(public_path() . '/images/newslatter/' . $footer->image);
            }

            $img = Image::make($file);

            $destinationPath = public_path() . '/images/newslatter/';

            $name = time() . $file->getClientOriginalName();

            $img->resize(396, 396, function ($constraint) {
                $constraint->aspectRatio();
            });

            $img->save($destinationPath . $name);
            $input['image'] = $name;
        }

        $input['heading']        = $request->heading;
        $input['sub_heading']    = $request->sub_heading;
        $footer->update($input);
        return back()->with("updated", __("Footer has been updated !"));
    }

    public function update_content(Request $request)
    {
        $footer = Footer::first();
        $data['content'] = $request->content;
        $footer->update($data);
        return back()->with("updated", __("Footer has been updated !"));
    }

}

