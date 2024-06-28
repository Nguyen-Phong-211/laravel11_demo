<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    //Hiển trang sản phẩm
    public function index(){
        $product = Product::orderBy('created_at', 'DESC')->get();
        return view('products.list', [
            'products' => $product
        ]);
    }

    // Tạo sản phẩm
    public function create(){
        return view('products.create');
    }
    // Lưu sản phẩm
    // min:5 bắt buộc nhập hơn 5 kí tự
    public function store(Request $request){
        $rules = [
            'name' =>'required|min:5',
            'sku' => 'required|min:3',
            'price' =>'required|numeric'
        ];

        if ($request->image != ""){
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return redirect()->route('products.create')->withInput()->withErrors($validator);
        }
        // Lưu vào CSDL
        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if ($request->image != ""){
            // Xử lý hình
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time().'.'.$ext; 
            // Tên ảnh là duy nhất

            // Lưu ảnh vào thư mục
            $image->move(public_path('uploads/products'), $imageName);

            // Lưu tên ảnh vào CSDL
            $product->image = $imageName;
            $product->save();
        }

        return redirect()->route('products.index')->with('success', 'Product added successfully.');

    }
    // Chỉnh sửa sản phẩm
    public function edit($id){
        $product = Product::findOrFail($id);
        return view('products.edit', [
            'product'=> $product
        ]);
    }
    // Cập nhật sản phẩm
    public function update($id, Request $request){

        $product = Product::findOrFail($id);

        $rules = [
            'name' =>'required|min:5',
            'sku' => 'required|min:3',
            'price' =>'required|numeric'
        ];

        if ($request->image != ""){
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return redirect()->route('products.edit', $product->id)->withInput()->withErrors($validator);
        }
        // update
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if ($request->image != ""){

            File::delete(public_path('uploads/products/'.$product->image));

            // Xử lý hình
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time().'.'.$ext; 
            // Tên ảnh là duy nhất

            // Lưu ảnh vào thư mục
            $image->move(public_path('uploads/products'), $imageName);

            // Lưu tên ảnh vào CSDL
            $product->image = $imageName;
            $product->save();
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }
    // Xoá sản phẩm
    public function destroy($id){
        $product = Product::findOrFail($id);

        // Xoá ảnh
        File::delete(public_path('uploads/products/'.$product->image));
        // Xoá sản phẩm
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

}
