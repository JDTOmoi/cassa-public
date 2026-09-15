<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Produk;
use App\Models\Prodreq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function orderview()
    {
        $order = Order::all();

        return view('order/order',[
            "activeDaftarOrder"=>"active",
            "order"=>$order
        ]);
    }

    public function listorderview(){
        $user = User::where('id',Auth::user()->id)->first();
        $order = $user->orders()->get();

        return view('order/vieworder',[
            "order"=>$order
        ]);
    }

    public function tambahorderview()
    {
        $produks = Produk::all();

        return view('order/tambahorder',[
            "activeOrder" => "active"
        ], compact('produks'));
    }

    public function tambahorder(Request $request)
    {
        $validate=$request->validate([
            'user_id' => '',
            'ord_message' => 'required',
            'phone_number'=>'required', //TODO: validate phone number, product, quantity, notes
            'produk_id' => 'required',
            'quantity' => 'required',
            'notes' => 'required'
        ]);

        $user_id = 1;

        if (Auth::check()) {
            $user_id = Auth::user()->id;
        }

        $order = Order::create([
            'user_id' => $user_id,
            'ord_message' => $validate['ord_message'],
            'phone_number' => $validate['phone_number'],
            'status'=> '0'
        ]);

        $productions = collect($validate['produk_id']);
        $quants = collect($validate['quantity']);
        $notes = collect($validate['notes']);

        for ($i = 0; $i < $productions->count(); $i++) {
            Prodreq::create([
                'produk_id' => $validate['produk_id'][$i],
                'order_id' => $order->id,
                'quantity' => $validate['quantity'][$i],
                'notes' => $validate['notes'][$i]
            ]);
        }
        

        return redirect()->route('vieworder');
    }

    public function editorder(Request $request)
    {
        $orderStatuses = json_decode($request->input('order_statuses'), true);
        
        if ($orderStatuses != null) {
            foreach ($orderStatuses as $orderStatus) {
                Order::where('id', $orderStatus['id'])->update(['status' => $orderStatus['status']]);
            }
        }
        
        return redirect()->route('admin.daftarorder');
    }

    public function hapusorder(Order $o){
        $o->delete();

        return redirect()->route('admin.daftarorder');
    }
}
