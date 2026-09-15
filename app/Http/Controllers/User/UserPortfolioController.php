<?php

namespace App\Http\Controllers\User;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class UserPortfolioController extends Controller
{
    public function index()
    {
        $port = Portfolio::all();

        return view('portofolio/portofolio',[
            'activePort'=>'active',
            'port1'=>$port
        ]);
    }

    public function show($title,Portfolio $port)
    {
        return view('portofolio/portofoliodetail',[
            'activePort'=>'active',
            'port'=>$port
        ]);
    }
}
