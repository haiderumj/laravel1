<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Image;
use Carbon\Carbon;
use Auth;
class HomeController extends Controller
{
    public function homeSlider()
    {
        $sliders = Slider::latest()->get(); // Corrected variable name

        return view('admin.slider.index', compact('sliders'));
    }


    public function AddSlider(){
        return view('admin.slider.create'); 
    }

    public function StoreSlider(Request $request)
{
    $slider_image = $request->file('image');
    $name_gen = uniqid().'.'.$slider_image->getClientOriginalExtension();
    Image::make($slider_image)->resize(1920,1088)->save('image/slider/'.$name_gen);

    $last_image = 'image/slider/'.$name_gen;

    Slider::insert([
        'title' => $request->title,
        'description' => $request->description,
        'image' =>  $last_image,
        'created_at' => Carbon::now()
    ]);
    

    return redirect()->route('home.slider')->with('success', 'Slider Inserted Successfully');
}



}

