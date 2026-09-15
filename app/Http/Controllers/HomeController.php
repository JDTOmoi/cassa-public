<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Category;
use App\Models\ProdCata;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if($request->has('search')){
            $produk = Produk::where('name','like','%'.$request->search.'%')->get();
        }else{
            $produk = Produk::paginate(10);
        }



        if($request->has('kategori')){
            if($request->kategori != "All"){
                $produkByCategory = ProdCata::where('category_id', $request->kategori)->get();
                $produkIds = $produkByCategory->pluck('produk_id')->toArray();
                $produk = Produk::whereIn('id', $produkIds)->paginate(10);
            $nama = Category::firstwhere('id',$request->kategori)->category_name;

        }else{
            $produk = Produk::paginate(10);
            $nama = "All";
        }
        }else{
            $produk = Produk::paginate(10);
            $nama = "All";
        }

        return view('home',["produk"=>$produk,"kategori"=>Category::all(),"nama"=>$nama],
        );
    }
}
