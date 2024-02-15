<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.author.index',[
            'authors'=>Author::orderBy('position', 'asc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.author.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

//            abort_if(!auth()->user()->can('category.create'),403,__('User does not have the right permissions.'));

            $request->validate(["title" => "required"], [
                "title.required" => __("Author name is required")
            ]);

            $input = array_filter($request->all());
//            return $input;
            $input['description'] = clean($request->description);

            $cat = new Author();

            if ($request->image != null) {

                // if(!str_contains($request->image, '.png') && !str_contains($request->image, '.jpg') && !str_contains($request->image, '.jpeg') && !str_contains($request->image, '.webp') && !str_contains($request->image, '.gif')){

                //     return back()->withInput()->withErrors([
                //         'image' => __('Invalid image type for category thumbnail')
                //     ]);

                // }
                if($request->hasFile('image')){
                    $imageName = $request->name.'-'.time().'.'.$request->image->extension();
                    $path = $request->image->move(public_path('/images/Author/'), $imageName);
                }
                $input['image'] = $imageName;

            }

//            if ($request->icon != null) {
//                if($request->hasFile('icon')){
//                    $iconName = time().'.'.$request->icon->extension();
//                    $path = $request->icon->move(public_path('/images/category/'), $iconName);
//                }
//                $input['icon'] = $iconName;
//            }

            $input['position'] = (Author::count() + 1);
            $input['featured'] = $request->featured=='on'?'1':'0';
            $cat->create($input);

            return redirect()->route('author.index')->with("added", __("Author has been added !"));


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        return view('admin.author.edit',[
            'author'=>Author::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


//        abort_if(!auth()->user()->can('category.edit'),403,__('User does not have the right permissions.'));

        $request->validate(
            [
                "title" => "required"
            ],[
                "title.required" => __("Title is required !")
            ]
        );

        $cat = Author::findOrFail($id);

        $category = Author::findOrFail($id);
        $input = array_filter($request->all());

        $input['description'] = clean($request->description);

        if ($request->image) {

            if($request->hasFile('image')){
                $imageName = $request->name.'-'.time().'.'.$request->image->extension();
                $path = $request->image->move(public_path('/images/Author/'), $imageName);
            }
            $input['image'] = $imageName;

        }

//        if ($request->icon != null) {
//            if($request->hasFile('icon')){
//                $iconName = time().'.'.$request->icon->extension();
//                $path = $request->icon->move(public_path('/images/category/'), $iconName);
//            }
//            $input['icon'] = $iconName;
//        }

        $input['featured'] = $request->featured=='on'?'1':'0';
        $category->update($input);

        return redirect()->route('author.index')->with('updated', __('Author has been updated'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

//        abort_if(!auth()->user()->can('category.delete'),403,__('User does not have the right permissions.'));

        $aut= Author::find($id);

//        if (count($category->products) > 0) {
//            return back()
//                ->with('warning', __('Category can\'t be deleted as its linked to products !'));
//        }

        if ($aut->image != '' && file_exists(public_path() . '/images/Author/'.$aut->image)) {
            unlink(public_path() . '/images/Author/'.$aut->image);
        }

        $value = $aut->delete();
        if ($value) {
            session()->flash("deleted", __("Author has been deleted"));
            return redirect()->route('author.index');
        }
    }
}
