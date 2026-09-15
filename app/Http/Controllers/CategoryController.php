<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function categoryview()
    {
        $category = Category::all();

        return view('category/category',[
            "activeCategory" => "active",
            "category" => $category
        ]);
    }
    
    
    public function tambahcategoryview()
    {
        return view('category/tambahcategory',[
            "activeCategory" => "active"
        ]);
    }

    public function editcategoryview(Category $c)
    {
        $categoryedit = Category::where('id',$c->id)->first();

        return view('category/editcategory',[
            "activeCategory" => "active"
        ],
        compact('categoryedit'));
    }

    public function updatecategory(Request $request, Category $categoryedit){
        $categoryedit->update([
            'category_name' => $request->category_name
        ]);

        return redirect()->route('admin.daftarcategory');
    }

    public function tambahcategory(Request $request){
        Category::create([
            'category_name' => $request->category_name
        ]);

        return redirect()->route('admin.daftarcategory');
    }

    public function hapuscategory(Category $c){
        $c->delete();

        return redirect()->route('admin.daftarcategory');
    }
}
