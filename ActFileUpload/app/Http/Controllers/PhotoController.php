<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $getimage = Photo::all();

        return view('fileupload', compact('getimage'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeSingle(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $image = $request->file('image');
        $name = time().'_'.$image->getClientOriginalName();
        $image->move(public_path('images'), $name);

        Photo::create(['image' => $name]);

        return redirect()->route('photos.create');
    }

    public function storeMultiple(Request $request){
        $request->validate([
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        foreach($request->file('images') as $image){
            $name = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('images'), $name);
            
            Photo::create(['image' => $name]);
        }

        return redirect()->route('photos.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $photos = Photo::findOrFail($id);
        $photos->delete();

        return redirect()->route('photos.create');
    }
}
