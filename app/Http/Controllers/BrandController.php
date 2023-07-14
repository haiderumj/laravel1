<?php

namespace App\Http\Controllers;
use App\Models\Brand;
use App\Models\Multipic;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
class BrandController extends Controller
{

    public function __construct()
{
    $this->middleware('auth');
}


   public function AllBrand(){
    $brands = Brand::latest()->paginate(5);
     return view('admin.brand.index' , compact('brands'));  
   }
   
//////////stor//////////////
public function StoreBrand(Request $request)
{
    $validatedData = $request->validate([
        'brand_name' => 'required|unique:brands|min:4',
        'brand_image' => 'required|mimes:jpg,jpeg,png'
    ], [
        'brand_name.required' => 'Please input Brand Name',
        'brand_image.required' => 'Please input image file',
    ]);

    $brand_image = $request->file('brand_image');
    $name_gen = uniqid().'.'.$brand_image->getClientOriginalExtension();
    Image::make($brand_image)->resize(300,200)->save('image/brand/'.$name_gen);

    $last_image = 'image/brand/'.$name_gen;

    Brand::insert([
        'brand_name' => $request->brand_name,
        'brand_image' => $last_image,
        'created_at' => Carbon::now()
    ]);

    return redirect()->back()->with('success', 'Brand Inserted Successfully');
}



/////////////eidt///////////////


   public function Edit($id){
    $brands = Brand::find($id);
    return view('admin.brand.edit',compact('brands'));
 }

 //////////update/////////////


 public function Update(Request $request, $id)
 {
    $validatedData = $request->validate([
        'brand_name' => 'required|min:4',
        
    ], [
        'brand_name.required' => 'Please input Brand Name',
        'brand_image.required' => 'Please input image file',
    ]);
       $old_image = $request->old_image;
       $brand_image = $request->file('brand_image');
       if($brand_image){
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $up_location = 'image/brand/';
        $last_img = $up_location.$img_name;
        $brand_image->move($up_location,$img_name);
        unlink($old_image);
        Brand::find($id)->update([
            'brand_name' => $request->brand_name,
            'brand_image' =>  $last_img,
            'created_at' => Carbon::now()
        ]);

        return redirect()->back()->with('success', 'Brand update Successfully');
    }
     else{
        Brand::find($id)->update([
            'brand_name' => $request->brand_name,
            'brand_image' =>  $last_img,
            'created_at' => Carbon::now()
        ]);

        return redirect()->back()->with('success', 'Brand update Successfully'); 

     }
    
    }

    ///////////delete//////////////


    public function Delete($id)
    {
        $image = Brand::find($id);
        $old_image = $image->brand_image;
        unlink($old_image);
         Brand::find($id)->delete();
        return redirect()->back()->with('success', 'Brand delete successfully');
    }

    /////////////////// Multi image ////////////////////

    public function Multipic(){
        $images = Multipic::all();
        return view ('admin.multipic.index',compact('images'));
    }

    public function storeImg(Request $request)
{
    

    $images = $request->file('image');

    if ($images) {
        foreach ($images as $image) {
            $name_gen = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move('image/multi/', $name_gen);
        
            $last_image = 'image/multi/' . $name_gen;

            // Resize the image
        $resizedImage = Image::make(public_path($last_image))->fit(300, 200);
        $resizedImage->save();
        
            Multipic::create([
                'image' => $last_image,
                'created_at' => Carbon::now()
            ]);
        }
    }
    
    
    

    return redirect()->back()->with('success', 'Brand Inserted Successfully');
}

public function Logout(){
    Auth::logout();
    return Redirect()->route('login')->with('success','User Logout');
}

}
