<?php

namespace App\Http\Controllers\User;

use App\Models\Brand;
use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UserProdukController extends Controller
{
    //
    public function produkview(Request $request)
    {
        if($request->has('search')){
            $produk = Produk::where('name','like','%'.$request->search.'%')->get();
        }else{
            $produk = Produk::paginate(10);
        }

        return view('user/produk',[
            "activeProduk"=>"active",
            "produk"=>$produk
        ]);
    }

}
