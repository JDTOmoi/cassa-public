<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $port = Portfolio::all();

        return view('portofolio/portofolio',[
            'activePort'=>'active',
            'port1'=>$port
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('portofolio/tambahportofolio',[
            'activePort'=>'active',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'port_image'=>'image',
            'title'=>'required|max:255',
            'content'=>'',
        ]);

        if($request->file('port_image')){
            $validatedData['port_image'] = $request->file('port_image')->store('images',['disk'=>'public']);

        Portfolio::create([
            'port_image'=>$validatedData['port_image'],
            'title'=>$validatedData['title'],
            'content'=>$validatedData['content'],
        ]);

        }else{
            Portfolio::create([
                'title'=>$validatedData['title'],
                'content'=>$validatedData['content'],
            ]);
        }

        return redirect()->route('admin.portofolio');
    }

    /**
     * Display the specified resource.
     */
    public function show($title,Portfolio $port)
    {
        return view('portofolio/portofoliodetail',[
            'activePort'=>'active',
            'port'=>$port
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Portfolio $port)
    {
        $portedit = Portfolio::where('id',$port->id)->first();
        return view('portofolio/editportofolio', ['activePort' => 'active'], compact('portedit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Portfolio $port)
    {
        $validatedData = $request->validate([
            'port_image'=>'image',
            'title'=>'required|max:255',
            'content'=>'',
        ]);

        if($request->file('port_image')){
            if($port->port_image){
                Storage::disk('public')->delete($port->port_image);
            }


            $validatedData['port_image'] = $request->file('port_image')->store('images',['disk'=>'public']);

        $port->update([
            'port_image'=>$validatedData['port_image'],
            'title'=>$validatedData['title'],
            'content'=>$validatedData['content'],
        ]);

        }else{
            $port->update([
                'title'=>$validatedData['title'],
                'content'=>$validatedData['content'],
            ]);
        }
        return redirect()->route('admin.portofolio');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Portfolio $port)
    {
        if($port->port_image){
            if(Storage::disk('public')->exists($port->port_image)){
                Storage::disk('public')->delete($port->port_image);
            }

        }

        $port->delete();

        return redirect()->route('admin.portofolio');
    }
}
