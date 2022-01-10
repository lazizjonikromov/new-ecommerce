<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::id()){
            $user=auth()->user();
            $cart=cart::where('phone',$user->phone)->get();
            $count=cart::where('phone',$user->phone)->count();
            $products = Product::orderBy('created_at', 'DESC')->paginate(9);
            return view('welcome', compact('products', 'cart', 'count'));
        }
        else{
            $products = Product::orderBy('created_at', 'DESC')->paginate(9);
            return view('welcome', compact('products'));
        }
        
    }

    public function search(Request $request){
        if(Auth::id())
        {
            $search=$request->search;
            if($search==''){
                $products = product::paginate(3);
                $user=auth()->user();
                $cart=cart::where('phone',$user->phone)->get();
                $count=cart::where('phone',$user->phone)->count();
                return view('search', compact('products', 'count', 'cart'));            
            }

            $user=auth()->user();
            $cart=cart::where('phone',$user->phone)->get();
            $count=cart::where('phone',$user->phone)->count();
            $products=product::where('title','Like', '%'.$search.'%')->get();
            return view('search', compact('products', 'count', 'cart'));            
        }
        else{
            $search=$request->search;
            if($search==''){
                $products = product::paginate(3);
                return view('search', compact('products'));            
            }

            $products=product::where('title','Like', '%'.$search.'%')->get();
            return view('search', compact('products'));
        }
    }

    public function shop()
    {
        if(Auth::id()){
            $user=auth()->user();
            $cart=cart::where('phone',$user->phone)->get();
            $count=cart::where('phone',$user->phone)->count();
            $products = Product::orderBy('created_at', 'DESC')->paginate(12);
            return view('middle_page.shop', compact('products', 'cart', 'count'));
        }
        else{
            $products = Product::orderBy('created_at', 'DESC')->paginate(12);
            return view('middle_page.shop', compact('products'));
        }
    }

    public function about()
    {
        if(Auth::id()){
            $user=auth()->user();
            $cart=cart::where('phone',$user->phone)->get();
            $count=cart::where('phone',$user->phone)->count();
            return view('middle_page.about_us', compact('cart', 'count'));
        }
        else{
            return view('middle_page.about_us');
        }
    }

    public function contact_us()
    {
        if(Auth::id()){
            $user=auth()->user();
            $cart=cart::where('phone',$user->phone)->get();
            $count=cart::where('phone',$user->phone)->count();
            return view('middle_page.contact_us', compact('cart', 'count'));
        }
        else{
            return view('middle_page.contact_us');
        }
    }

    function getAdminDashboard(){
        $usertype = Auth::user()->usertype;

        if($usertype == '1'){
            $products = Product::with('category')->paginate(3);
            return view('admin.dashboard', compact('products'));
        }else{
            return view('user.dashboard');
        }
    }

    function getUserDashboard(){
        $usertype = Auth::user()->usertype;

        if($usertype == '0'){
            return view('user.dashboard');
        }else{
            $products = Product::with('category')->paginate(3);
            return view('admin.dashboard', compact('products'));        
        }
    }

    public function my_orders(){
        if(Auth::id()){
            $user=auth()->user();

            $order=order::where('phone',$user->phone)->get();

            $orders=order::where('phone',$user->phone)->count();

            return view('user.my_orders', compact('order' , 'orders'));
        }
        else{
            return redirect('login');
        }

    }




    // public function redirect(){
    //     $usertype = Auth::user()->usertype;

    //     if($usertype == '1'){
    //         return view('admin.home');
    //     }else{
    //         return view('dashboard');
    //     }
    // }
}

