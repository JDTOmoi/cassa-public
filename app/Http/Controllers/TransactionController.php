<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function transactionview()
    {
        $transaction = Transaction::all();

        return view('transaction/transaction',[
            "activeTransaction" => 'active',
            "transaction" => $transaction
        ]);
    }

    public function listtransactionview(){
        $user = User::where('id', Auth::user()->id)->first();
        $transaction = $user->transactions()->get();

        return view('transaction/viewtransaction',[
            "transaction" => $transaction
        ]);
    }


    public function tambahtransactionview()
    {
        $users = User::all();

        return view('transaction/tambahtransaction',[
            "activeTransaction" => 'active',
            "users" => $users
        ]);
    }

    public function edittransactionview(Transaction $t)
    {
        $transactionedit = Transaction::where('id',$t->id)->first();
        $users = User::all();
        return view('transaction/edittransaction',[
            "activeTransaction" => 'active',
            "users" => $users
        ],
        compact('transactionedit'));
    }

    public function updatetransaction(Request $request, Transaction $transactionedit){
        
        $validate=$request->validate([
            'user_id' => 'required',
            'amount_paid' => 'required|integer',
            'tips'=>'required|integer'
        ]);

        $transactionedit->update([
            'user_id' => $validate['user_id'],
            'amount_paid' => $validate['amount_paid'],
            'tips'=> $validate['tips']
        ]);

        return redirect()->route('admin.kirimtransaksi');
    }

    public function tambahtransaction(Request $request){

        $validate=$request->validate([
            'user_id' => 'required',
            'amount_paid' => 'required|integer',
            'tips'=>'required|integer'
        ]);

        Transaction::create([
            'user_id' => $validate['user_id'],
            'amount_paid' => $validate['amount_paid'],
            'tips'=> $validate['tips']
        ]);

        return redirect()->route('admin.kirimtransaksi');
    }

    public function hapustransaction(Transaction $t){
        $t->delete();

        return redirect()->route('admin.kirimtransaksi');
    }
}
