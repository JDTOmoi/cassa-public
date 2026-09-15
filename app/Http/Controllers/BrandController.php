<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    public function brandview()
    {
        $brand = Brand::all();

        return view('brand/brand',[
            "activeBrand" => "active",
            "brand" => $brand
        ]);
    }


    public function tambahbrandview()
    {
        return view('brand/tambahbrand',[
            "activeBrand" => "active"
        ]);
    }

    public function editbrandview(Brand $b)
    {
        $brandedit = Brand::where('id',$b->id)->first();

        return view('brand/editbrand',[
            "activeBrand" => "active"
        ],
        compact('brandedit'));
    }

    public function updatebrand(Request $request, Brand $brandedit){
        $validate=$request->validate([
            'brand_name'=>'required|max:255'
        ]);

        $brandedit->update([
            'brand_name' => $validate['brand_name']
        ]);

        return redirect()->route('admin.daftarbrand');
    }

    public function tambahbrand(Request $request){

        $validate=$request->validate([
            'brand_name'=>'required|unique:brands|max:255'
        ]);

        Brand::create([
            'brand_name' => $validate['brand_name']
        ]);

        return redirect()->route('admin.daftarbrand');
    }

    public function hapusbrand(Brand $b){
        $b->delete();

        return redirect()->route('admin.daftarbrand');
    }

}
