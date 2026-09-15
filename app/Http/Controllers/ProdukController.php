<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Produk;
use App\Models\Category;
use App\Models\ProdCata;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    //
    public function produkview(Request $request)
    {
        if($request->has('search')){
            $produk = Produk::where('name','like','%'.$request->search.'%')->get();
        }else{
            $produk = Produk::paginate(10);
        }

        return view('produk/produk',[
            "activeProduk"=>"active",
            "produk"=>$produk
        ]);
    }

    public function tambahprodukview()
    {
        $brands = Brand::all();
        $kategori = Category::all();
        return view('produk/tambahproduk',[
            "activeProduk"=>"active",
            "brands"=>$brands,
            "kategori"=>$kategori
        ]);
    }

    public function editprodukview(Produk $p)
    {
        $produkedit = Produk::where('id',$p->id)->first();

        $brands = Brand::all();

        $kategori = Category::all();

        $lastProdCatas = $p->pcs()->latest()->first();
        if ($lastProdCatas) {
            $kategori2 = $lastProdCatas->category();
        }

        return view('produk/editproduk',
        [
            "activeProduk"=>"active",
        ],
        compact('produkedit','brands','kategori','kategori2'));
    }


    public function updateproduk(Request $request, Produk $produkedit){
        $validate=$request->validate([
            'image'=>'image',
            'name'=>'required|max:255',
            'sku'=>'required|max:255',
            'brand'=>'required',
            'tags'=>'required|max:255',
            'description'=>'',
            'kategori'=>''

        ]);

        if($request->file('image')){
            if($produkedit->image){
                Storage::disk('public')->delete($produkedit->image);
            }

            $validate['image'] = $request->file('image')->store('images',['disk'=>'public']);

        $produkedit->update([
            'image'=>$validate['image'],
            'name'=>$validate['name'],
            'sku'=>$validate['sku'],
            'brand'=>$validate['brand'],
            'tags'=>$validate['tags'],
            'description'=>$validate['description'],
        ]);
        }else{
        $produkedit->update([
            'name'=>$validate['name'],
            'sku'=>$validate['sku'],
            'brand'=>$validate['brand'],
            'tags'=>$validate['tags'],
            'description'=>$validate['description'],
        ]);
    }

        $produkedit->pcs()->latest()->update([
            'produk_id'=>$produkedit->id,
            'category_id'=>$request->kategori
        ]);


        return redirect()->route('admin.daftarproduk');
    }


    public function tambahproduk(Request $request)
    {
        $validate=$request->validate([
            'image'=>'image',
            'name'=>'required|max:255',
            'sku'=>'required|max:255',
            'brand'=>'required',
            'kategori'=>'required',
            'tags'=>'required|max:255',
            'description'=>'',

        ]);

        if($request->file('image')){
            $validate['image'] = $request->file('image')->store('images',['disk'=>'public']);

        $newProduct = produk::create([
            'image'=>$validate['image'],
            'name'=>$validate['name'],
            'sku'=>$validate['sku'],
            'brand'=>$validate['brand'],
            'tags'=>$validate['tags'],
            'description'=>$validate['description'],
        ]);

        }else{
            $newProduct = produk::create([
            'name'=>$validate['name'],
            'sku'=>$validate['sku'],
            'brand'=>$validate['brand'],
            'tags'=>$validate['tags'],
            'description'=>$validate['description'],
        ]);
    }

    if($newProduct){
        ProdCata::create([
            'produk_id'=>$newProduct->id,
            'category_id'=>$request->kategori,
        ]);
    }

        return redirect()->route('admin.daftarproduk');

    }

    public function hapusproduk(Produk $p){

        $p->pcs()->delete();


        if($p->image){
            if(Storage::disk('public')->exists($p->image)){
                Storage::disk('public')->delete($p->image);
            }
        }

        $p->delete();

        return redirect()->route('admin.daftarproduk');
    }

    public function detailproduk(Produk $p){
        $produk = Produk::where('id',$p->id)->first();

        $category = $produk->pcs()->latest()->first();
        $kategori = $category ? $category->category : null;
        $kategori1 = Category::all();

        $brand = $p->BrandProduk();

        return view('produk/detailproduk',
        [
            "activeProduk"=>"active",
        ],
        compact('produk','brand','kategori1','kategori'));

    }



}
