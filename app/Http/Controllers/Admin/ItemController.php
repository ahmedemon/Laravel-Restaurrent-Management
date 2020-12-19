<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;
use Carbon\Carbon;
class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        return view('admin.item.index', compact('items') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.item.create', compact('categories'));
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
            'category' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png',
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->name.'-'.$request->category);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'.'.$image->getClientOriginalExtension();

            if (!file_exists('uploads/items')) {
                mkdir('uploads/items', 077, true);
            }
            $image->move('uploads/items', $imageName);
        }else{
            $imageName = 'default.png';
        }

        $item = new Item();
        $item->category_id = $request->category;
        $item->name = $request->name;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->image = $imageName;
        $item->save();

        return redirect()->route('item.index')->with('success', 'Item added successfully!');
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
        $item = Item::find($id);
        $categories = Category::all();
        return view('admin.item.edit', compact('item', 'categories'));
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
            'category' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'mimes:jpeg,jpg,png',
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->name.'-'.$request->category);
        // $slug = str_slug($request->name);
        if ($image) {
            if (isset($image)) {
                $currentDate = Carbon::now()->toDateString();
                // $imageName = $slug.'-'.$currentDate.'.'.$image->getClientOriginalExtension();
                $imageName = $slug.'-'.$currentDate.'.'.'jpg';

                if (!file_exists('uploads/items')) {
                    mkdir('uploads/items', 077, true);
                }
                $image->move('uploads/items', $imageName);
            }else{
                $item = Item::find($id);
                $imageName = $item->image;
            }
            $item = Item::find($id);
            $old = $item->image;
            // unlink('uploads/items/'.$old);
            $item->category_id = $request->category;
            $item->name = $request->name;
            $item->description = $request->description;
            $item->price = $request->price;
            $item->image = $imageName;
            $item->save();
            return redirect()->route('item.index')->with('success', 'Item updated successfully!');
        }else{
            $item = Item::find($id);
            $item->category_id = $request->category;
            $item->name = $request->name;
            $item->description = $request->description;
            $item->price = $request->price;
            $item->save();
            return redirect()->route('item.index')->with('success', 'Item updated successfully!');
        }
        return redirect()->route('item.index')->with('success', 'Item updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        if (file_exists('uploads/items/'.$item->image)) {
            unlink('uploads/items/'.$item->image);
        }
        $item->delete();
        return redirect()->route('item.index')->with('danger', 'Item deleted successfully!');
    }
}
