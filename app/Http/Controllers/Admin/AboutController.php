<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use Carbon\Carbon;
class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abouts = About::all();
        return view('admin.about.index', compact('abouts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.about.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'name' => 'required',
        //     'about' => 'required',
        //     'image' => 'required|mimes:jpeg,jpg,png',
        // ]);

        // $image = $request->file('image');
        // $slug = str_slug($request->name);

        // if (isset($image)) {
        //     $currentDate = Carbon::now()->toDateString();
        //     $imageName = $slug.'-'.$currentDate.'.'.$image->getClientOriginalExtension();
        //     if (!file_exists('uploads/abouts')) {
        //         mkdir('uploads/abouts');
        //     }
        //     $image->move('uploads/abouts', $imageName);
        // }else{
        //     $imageName = 'default.png';
        // }
        //     $about = new About();
        //     $about->name = $request->name;
        //     $about->about = $request->about;
        //     $about->image = $imageName;
        //     $about->save();

        //     return redirect()->route('about.index')->with('success', 'About added successfully!');
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
        $about = About::find($id);
        return view('admin.about.edit', compact('about'));
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
        $this->validate($request, [
            'name' => 'required',
            'about' => 'required',
            'image' => 'mimes:jpeg,jpg,png',
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->name);

        if ($image) {
            if (isset($image)) {
                $currentDate = Carbon::now()->toDateString();
                $imageName = $slug.'-'.$currentDate.'.'.$image->getClientOriginalExtension();
                if (!file_exists('uploads/abouts')) {
                    mkdir('uploads/abouts');
                }
                $image->move('uploads/abouts', $imageName);
            }else{
                $about = About::find($id);
                $imageName = $about->image;
            }
                $about = About::find($id);
                $old_image = $about->image;
                // unlink('uploads/abouts/'.$old_image);
                $about->name = $request->name;
                $about->about = $request->about;
                $about->image = $imageName;
                $about->save();
        }else{
            $about = About::find($id);
            $about->name = $request->name;
            $about->about = $request->about;
            $about->save();
        }

        return redirect()->route('about.index')->with('success', 'About added successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $about = About::find($id);
        if (file_exists('uploads/abouts/'.$about->image)) {
            unlink('uploads/abouts/'.$about->image);
        }
        $about->delete();
        return redirect()->route('about.index')->with('danger', 'About deleted successfully!');
    }
}
