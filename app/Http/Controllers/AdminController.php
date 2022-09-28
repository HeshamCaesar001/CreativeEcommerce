<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;
use PDF;
use Notification;
use App\Notifications\sendEmailNotificaiton;
class AdminController extends Controller
{
    public function viewCategory()
    {
        $categories = Category::all();
        return view('admin.category',['categories'=> $categories]);
    }

    public function addCategory(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'category_name' => 'unique:categories',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator);
        }


        $data = new Category();
        $data->category_name = $request->category_name;
        $data->save();
       return redirect()->back()->with('message','category added successfully');
    }

    public function categoryDestroy (Category $category)
    {
//        dd($category);
        $category = Category::find($category->id);
        $category->delete();
        return redirect()->back();
    }

    public function allProducts()
    {
        $products = Product::all();
        return view('admin.products',['products'=>$products]);
    }

    public function AddProduct()
    {
        $categories = Category::all();
        return view('admin.addProduct',['categories'=>$categories]);

    }

    public function saveProduct(Request $request)
    {
        $product = new Product();
        $product->title= $request->title;
        $product->description= $request->description;
        $product->price= $request->price;
        $image= $request->image;
        $product->discount_price= $request->discount_price;
        $product->category= $request->category;
        $product->quantity= $request->quntity;
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $request->image->move('products',$imageName);
        $product->image= $imageName;
        $product->save();
        return redirect()->back();
    }

    public function productDestroy(Product $product)
    {
        $product = Product::find($product->id);
        $product->delete();
        return redirect()->back();
    }

    public function EditProduct(Product $product)
    {
        $editableProduct = Product::find($product->id);
        $categories = Category::all();

        return view('admin.editProduct',compact('editableProduct','categories'));
    }

    public function updateProduct(Request $request,  $product)
    {
        $updatedProduct = Product::find($product);
        $updatedProduct->title = $request->title;
        $updatedProduct->description = $request->description;
        $updatedProduct->price = $request->price;
        $updatedProduct->quantity = $request->quantity;
        $updatedProduct->discount_price = $request->discount_price;
        $updatedProduct->category = $request->category;
        if($request->image)
        {
            $image = $request->image;
            $imageName= time().'.'.$image->getClientOriginalExtension();
            $request->image->move('products',$imageName);
            $updatedProduct->image= $imageName;
        }
        $updatedProduct->save();
        return redirect()->route('montagat');
    }

    public function ShowOrders()
    {
        $orders = Order::all();
        return view('admin.orders',compact('orders'));
    }

    public function DeliveredOrder($id)
    {
        $order = Order::find($id);
        $order->delivery_statud = "Delieverd";
        $order->payment_status = "Paid";
        $order->save();
        return redirect()->back();
    }

    public function PrintPDF($id)
    {
        $order = Order::find($id);
        $pdf = PDF::loadView('admin.pdf',compact('order'));
        return $pdf->download('oreder_details.pdf');
    }

    public function SendEmail($id)
    {
        $order = Order::find($id);
            return view('admin.emailInfo',compact('order'));
    }

    public function notifyUser(Request $request,$id)
    {
        $order = Order::find($id);
        $details= [
            'message'=>$request->emailContent,
        ];
        Notification::send($order,new sendEmailNotificaiton($details));
    }

    public function searchOrder(Request $request)
    {
        $searchText = $request->search;
        $orders= Order::where('name','LIKE',"%$searchText%")->orWhere('phone','LIKE',"%$searchText%")->orWhere('product_title','LIKE',"%$searchText%")->get();
        return view('admin.orders',compact('orders'));
    }
}
