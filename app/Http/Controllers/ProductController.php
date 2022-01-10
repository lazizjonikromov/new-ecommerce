<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    // public function index()
    // {
    //     $products = Product::with('category')->paginate(2);
    //     return view('wel', ['products' => $products]);
    // }

    public function create()
    {
        $categories = Category::all();
        return view('admin.add-product', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $product = new Product;

        $product->title = $request->input('title');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->category_id = $request->input('category_id');
        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $new_name = rand() . "_" . $image->getClientOriginalname();
            $image->move(public_path('uploads/images/'), $new_name);
            $product->image = $new_name;
        }

        $product->save();
        return redirect('/admin/dashboard');
    }

    public function edit($product)
    {
        $categories = Category::all();
        $product = Product::find($product);

        return view('admin.edit-product', ['product' => $product, 'categories' => $categories]);
    }

    public function update(Request $request, $product)
    {
        $product = Product::find($product);
        $product->title = $request->input('title');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->category_id = $request->input('category_id');
        if ($request->hasfile('image')) {
            $destination = 'uploads/images/' . $product->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $image = $request->file('image');
            $new_name = rand() . "_" . $image->getClientOriginalname();
            $image->move(public_path('uploads/images/'), $new_name);
            $product->image = $new_name;
        }

        $product->update();
        return redirect('/admin/dashboard');
    }



    public function delete($product)
    {
        $product = Product::find($product);
        $destination = 'uploads/images/' . $product->image;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $product->delete();
        return redirect()->back();
    }

    public function search()
    {
        $search_text = $_GET['query'];

        $products = Product::where('title', 'LIKE', '%' . $search_text . '%')
            ->with('category')->paginate(3);

        return view('admin.search', compact('products'));
    }



    public function getCategoryProduct($product)
    {
        if(Auth::id()){
            $user=auth()->user();
            $cart=cart::where('phone',$user->phone)->get();
            $count=cart::where('phone',$user->phone)->count();
            $arr = Product::where('category_id', $product)->get();

            $product_ids = null;

            foreach ($arr as $pc)
                $product_ids[] = $pc->id;
            $products = Product::whereIn('id', $product_ids)->paginate(9);
            return view('welcome', compact('products', 'cart', 'count')); 
        }
        else{
            $arr = Product::where('category_id', $product)->get();

            $product_ids = null;

            foreach ($arr as $pc)
                $product_ids[] = $pc->id;
            $products = Product::whereIn('id', $product_ids)->paginate(9);
            return view('welcome', compact('products')); 
        }
    }

    public function getShopCategoryProduct($product)
    {
        if(Auth::id()){
            $user=auth()->user();
            $cart=cart::where('phone',$user->phone)->get();
            $count=cart::where('phone',$user->phone)->count();
            $arr = Product::where('category_id', $product)->get();

            $product_ids = null;

            foreach ($arr as $pc)
                $product_ids[] = $pc->id;
            $products = Product::whereIn('id', $product_ids)->paginate(9);
            return view('middle_page.shop', compact('products', 'cart', 'count')); 
        }
        else{
            $arr = Product::where('category_id', $product)->get();

            $product_ids = null;

            foreach ($arr as $pc)
                $product_ids[] = $pc->id;
            $products = Product::whereIn('id', $product_ids)->paginate(9);
            return view('middle_page.shop', compact('products')); 
        }
        
    }
    
    
    public function getProductDetail($product)
    {
        if(Auth::id()){
            $user=auth()->user();
            $cart=cart::where('phone',$user->phone)->get();
            $count=cart::where('phone',$user->phone)->count();
            $productDetail = Product::find($product);

            $related = Product::where('category_id', '=', $productDetail->category->id)
                ->where('id', '!=', $productDetail->id)
                ->get();

            return view('middle_page.product_detail',compact('productDetail', 'related', 'cart', 'count'));
        }
        else{
            $productDetail = Product::find($product);

            $related = Product::where('category_id', '=', $productDetail->category->id)
                ->where('id', '!=', $productDetail->id)
                ->get();

            return view('middle_page.product_detail',compact('productDetail', 'related'));
        }
        
    }


    public function addcart(Request $request, $id){
        if(Auth::id()){
            $user = auth()->user();

            $product = product::find($id);

            $cart = new cart;

            $cart->name=$user->name;
            $cart->phone=$user->phone;
            $cart->address=$user->address;

            $cart->product_title=$product->title;
            $cart->price=$product->price;
            $cart->quantity=$request->quantity;

            $totalprice = (($cart->price=$product->price)*($cart->quantity=$request->quantity));

            $cart->totalprice=$totalprice;

            $cart->image=$product->image;


            $cart->save();

            return redirect('/');
        }
        else{
            return redirect('login');
        }
    }


    public function showcart(){
        if(Auth::id()){
           $user=auth()->user();

            $products = product::all();

            $cart=cart::where('phone',$user->phone)->get();

            $count=cart::where('phone',$user->phone)->count();

            return view('middle_page.cart', compact('products', 'count', 'cart')); 
        }
        else{
            return redirect('login');
        }
        
    }

    public function deletecart($id){
        $products = cart::find($id);
        $products->delete();
        return redirect()->back();  
    }

    public function checkout(){
        if(Auth::id()){
            $user=auth()->user();
 
            $products = product::all();
 
            $cart=cart::where('phone',$user->phone)->get();
 
            $count=cart::where('phone',$user->phone)->count();
 
            return view('middle_page.checkout', compact('products', 'count', 'cart')); 
        }
        else{
            return redirect('login');
        }           
    }

    public function confirmorder(Request $request){

        foreach($request->productname as $key=>$productname){
            $order = new order;

            $order->product_name=$request->productname[$key];
            $order->price=$request->price[$key];
            $order->quantity=$request->quantity[$key];


            $totalprice = (($order->price=$request->price[$key])*($order->quantity=$request->quantity[$key]));

            $order->totalprice=$totalprice;



            $order->name = $request->name; 
            $order->email = $request->email; 
            $order->phone = $request->phone; 
            $order->address = $request->address; 
            $order->country = $request->country; 
            $order->city = $request->city; 
            
            $order->status = 'not delivered'; 


            $order->save();

        }       
    
        $user=auth()->user();

        $phone = $user->phone; 

        DB::table('carts')->where('phone', $phone)->delete();
        return redirect('/thankyou');  
        
    }

    public function thankyou(){
        if(Auth::id()){
            $user=auth()->user();

            $cart=cart::where('phone',$user->phone)->get();

            $count=cart::where('phone',$user->phone)->count();

            return view('middle_page.thankyou', compact('count' , 'cart'));
        }
        else{
            return redirect('login');
        }
        
    }

    public function showorder(){
        $order = order::paginate(4);

        return view('admin.showorder', compact('order'));
    }
    
    public function updatestatus($id){
        $order = order::find($id);
        $order->status = 'delivered';
        $order->save();
        return redirect()->back();
    }

    public function search_order(){
        $search_text = $_GET['query'];

        $order = Order::where('product_name' , 'LIKE', '%' . $search_text . '%')->paginate(4);

        return view('admin.search-order', compact('order'));
    }

    






}

