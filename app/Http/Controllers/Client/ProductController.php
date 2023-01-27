<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Models\Tag;

class ProductController extends Controller
{
    //Add Product
    public function addProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'thumbnail' => ['required','image'],
            'name' => ['required'],
            'price' => ['required','numeric'],
            'category' => ['required'],
        ]); //validate all the data
        
        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);
        }
        else
        {
            $no = rand(1555,9999);
            $supplier = auth()->guard('client')->user()->id;
            
            $products = new Product;
            $products->no = $no;
            $products->name = $request->input('name');
            $products->price = $request->input('price');
            $products->status = 'active';
            $products->category = $request->input('category');
            $products->description = $request->input('description');
            $products->supplier = $supplier;
            
            $photoPath = request('thumbnail')->store('product','public'); //get image path
            $products->thumbnail = '/'.'storage/'.$photoPath;
            $products->save();
            
            if($request->input('tag') != "")
            {
                //insert tags
                $tags = explode(' ', $request->input('tag'));
                
                foreach ($tags as $tag) {
                    DB::table('tags')->insert([
                        'tag' => $tag, 'product' => $no
                    ]);
                }
            }
            
            return response()->json([
                'status'=>200
            ]);
        }
    }

    public function getProduct($limit)
    {
        $products = Product::where('supplier','=',auth()->guard('client')->user()->id)->orderBy('id', 'DESC')->limit(10)->offSet($limit)->get();
        return response()->json([
            'products'=>$products,
        ]);
    }

    public function searchProduct($search)
    {
        $products = Product::where('supplier','=',auth()->guard('client')->user()->id)
        ->where('name','LIKE','%'.$search.'%')->orWhere('category','LIKE','%'.$search.'%')
        ->orderBy('id', 'DESC')->get();
        return response()->json([
            'products'=>$products,
        ]);
    }

    //change Product status
    public function changeStatus(Request $request)
    {
            $products = Product::where('no','=',$request->input('no'))->first();
            $products->status = $request->input('status');
            $products->save();

            return response()->json([
                'status'=>200
            ]);
    }

    //delete product
    public function deleteProduct(Request $request)
    {
            $products = Product::where('no','=',$request->input('no'))->first();
            $tags = Tag::where('product','=',$request->input('no'))->delete();

            $products->delete();
            
            return response()->json([
                'status'=>200
            ]);
    }

    public function getOneProduct($no)
    {
        $products = Product::where('no','=',$no)->first();
        return response()->json([
            'products'=>$products,
        ]);
    }

    public function getTags($product)
    {
        $tags = Tag::where('product','=',$product)->orderBy('id', 'DESC')->get();
        return response()->json([
            'tags'=>$tags,
        ]);
    }

    //delete tag
    public function deleteTag(Request $request)
    {
            $tags = Tag::where('id','=',$request->input('no'))->delete();
            
            return response()->json([
                'status'=>200
            ]);
    }

    //update Product
    public function updateProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no' => ['exists:products'],
            'name' => ['required'],
            'price' => ['required','numeric'],
            'category' => ['required'],
        ]); //validate all the data
        
        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);
        }
        else
        {
            $products = Product::where('no','=',$request->input('no'))->first();
            $products->name = $request->input('name');
            $products->price = $request->input('price');
            $products->category = $request->input('category');
            $products->description = $request->input('description');

            if(request('thumbnail')!="")
            {
                $photoPath = request('thumbnail')->store('product','public');
                $products->thumbnail = '/'.'storage/'.$photoPath;
            }

            $products->save();


            if($request->input('tag') != "")
            {
                //insert tags
                $tags = explode(' ', $request->input('tag'));
                
                foreach ($tags as $tag) {
                    DB::table('tags')->insert([
                        'tag' => $tag, 'product' => $request->input('no')
                    ]);
                }
            }
            
            return response()->json([
                'status'=>200
            ]);
        }
    }
}
