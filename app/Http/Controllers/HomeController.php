<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use Session;

use Stripe;
class HomeController extends Controller
{
    public function redirect()
    {
        $userType = Auth::user()->usertype;
        if($userType == "1")
        {
            $allProducts = Product::count();
            $allOrders = Order::count();
            $allCustomers = User::where('usertype','0')->count();
            $totalRevenue = Order::sum('price');
            return view('admin.home',compact('allProducts','allOrders','allCustomers','totalRevenue'));
        }
        else{
            $products = Product::all();
            return view('home.userPage',compact('products'));
        }
    }


    public function index()
    {
        if(Auth::user()){
            $userType = Auth::user()->usertype;
            if($userType == "1")
            {
                return view('admin.home');
            }
            else{
                $products = Product::all();
                return view('home.userPage',compact('products'));
            }
        }else{
            $products = Product::all();
            return view('home.userPage',compact('products'));
        }


    }

    public function ShowProduct($id)
    {
        $product = Product::find($id);
        return view('home.showProduct',compact('product'));
    }

    public function AddCart(Request $request  , $id)
    {
        if(Auth()->user())
        {
            $user = Auth()->user();
            $product = Product::find($id);
            $cart = new Cart();
            $cart->name = $user->name;
            $cart->phone = $user->phone;
            $cart->email = $user->email;
            $cart->address = $user->address;
            $cart->user_id = $user->id;
            $cart->Product_title = $product->title;
            $cart->product_id = $product->id;
            $cart->image = $product->image;
            if($request->quantity > $product->quantity)
            {
                $cart->quantity = $product->quantity;

            }else{
                $cart->quantity = $request->quantity;

            }

            if($product->discount_price)
            {
                $cart->price = $product->discount_price* $cart->quantity ;
            }else{
                $cart->price = $product->price* $cart->quantity ;
            }

            $cart->save();
            return redirect()->route('home');

        }else{
            return redirect('login');
        }

    }

    public function showCart()
    {
        if(Auth()->user())
        {
            $user = Auth()->user();
            $carts = Cart::where('user_id',$user->id)->get();
            return view('home.showCart',compact('carts'));
        }else{
            return redirect('login');
        }

    }

    public function DeleteFromCart($id)
    {
        $cart=Cart::find($id);
        $cart->delete();
        return redirect()->back();
    }

    public function CashOrder()
    {
        $user = Auth()->user();
        $data = Cart::where('user_id',$user->id)->get();
        foreach($data as $data)
        {
            $order = new Order();
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->product_id = $data->product_id;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->payment_status ="cach on delivery";
            $order->delivery_statud ="processing";
            $order->save();

            $cart_id = $data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }
        return redirect()->back();
    }

    public function stripe($totalPrice)
    {
        return view('home.stripe',compact('totalPrice'));
    }
    public function stripePost(Request $request , $totalPrice)

    {

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));



        Stripe\Charge::create ([

            "amount" => $totalPrice * 100,

            "currency" => "usd",

            "source" => $request->stripeToken,

            "description" => "Thanks for payment."

        ]);

        $user = Auth()->user();
        $data = Cart::where('user_id',$user->id)->get();
        foreach($data as $data)
        {
            $order = new Order();
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->product_id = $data->product_id;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->payment_status ="Paid online";
            $order->delivery_statud ="processing";
            $order->save();

            $cart_id = $data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }

        Session::flash('success', 'Payment successful!');



        return back();

    }
}
