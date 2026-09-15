<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Order;
use App\Models\Produk;
use App\Models\Prodreq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function DeleteUserView(User $user){

        $user = User::findOrFail(Auth::id());

        return view('user/deleteuserview',[
            'user'=>$user
        ]);

    }

    public function deleteuser(Request $request){
        $request->validate([
            'password' => 'required', // Add custom password validation rule
            'sure' => 'accepted', // Ensure the checkbox is checked
        ]);

        $user = User::find(Auth::user()->id);

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'The password is incorrect.');
        }


        $deleted = DB::table('users')->where('id', $user->id)->delete();

        if ($deleted) {
            Auth::logout();
            return redirect()->route('login')->with('success', 'Your account has been deleted successfully. You have been logged out.');
        } else {
            return back()->with('error', 'Failed to delete the account. Please try again.');
        }
    }
}
