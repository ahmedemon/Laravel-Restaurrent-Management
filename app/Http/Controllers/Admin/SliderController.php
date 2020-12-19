<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Carbon\Carbon;
class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|min:3',
            'sub_title' => 'required|min:4',
            'image' => 'required|mimes:jpeg,jpg,png',
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->title);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'.'.$image->getClientOriginalExtension();

            if (!file_exists('uploads/sliders')) {
                mkdir('uploads/sliders', 077, true);
            }
            $image->move('uploads/sliders', $imageName);
        }else{
            $imageName = 'default.png';
        }

        $slider = new Slider();
        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->image = $imageName;
        $slider->save();

        return redirect()->route('slider.index')->with('success', 'Slider added successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $slider = Slider::find($id);
        return view('admin.slider.show', compact('slider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Slider::find($id);
        return view('admin.slider.edit', compact('data'));
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
        $this->validate($request,[
            'title' => 'required|min:3',
            'sub_title' => 'required|min:4',
            'image' => 'mimes:jpeg,jpg,png',
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->title);
        if ($image) {
            if (isset($image)) {
                $currentDate = Carbon::now()->toDateString();
                $imageName = $slug.'-'.$currentDate.'.'.$image->getClientOriginalExtension();

                if (!file_exists('uploads/sliders')) {
                    mkdir('uploads/sliders', 077, true);
                }
                $image->move('uploads/sliders', $imageName);
            }else{
                $imageName = 'default.png';
            }

            $slider = Slider::find($id);
            $old = $slider->image;
        $image = $request->file('image');
            unlink('uploads/sliders/'.$old);
            $slider->title = $request->title;
            $slider->sub_title = $request->sub_title;
            $slider->image = $imageName;
            $slider->save();
        }else{
            $slider = Slider::find($id);
            $slider->title = $request->title;
            $slider->sub_title = $request->sub_title;
            $slider->save();
        }

        return redirect()->route('slider.index')->with('success', 'Slider added successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::find($id);
        if (file_exists('uploads/sliders/'.$slider->image)) {
            unlink('uploads/sliders/'.$slider->image);
        }
        $slider->delete();
        return redirect()->route('slider.index')->with('success', 'Slider deleted successfully!');
    }
}
