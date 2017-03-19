<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Product;
use Auth;
use App\ProductImages;
use App\Cate;
use App\Http\Requests\ProductRequest;
use Input,File;
use Request;


class ProductController extends Controller {

    public function getList(){
        $data = Product::select('id','name','price','cate_id','created_at')->orderBy('id','DESC')->get()->toArray();
        return view('admin.product.list',compact('data'));
    }
    public function getAdd(){
        $cate = Cate::select('id','name','parent_id')->get()->toArray();
        return view('admin.product.add',compact('cate'));
    }
    public function postAdd(ProductRequest $product_request){
        $file_name = $product_request->file('fImages')->getClientOriginalName();
        $product = new Product();
        $product->name = $product_request->txtName;
        $product->alias = changeTitle($product_request->txtName);
        $product->price = $product_request->txtPrice;
        $product->intro = $product_request->txtIntro;
        $product->content = $product_request->txtContent;
        $product->image = $file_name;
        $product->keywords = $product_request->txtKeywords;
        $product->description = $product_request->txtDescription;
        $product->user_id = Auth::user()->id;
        $product->cate_id = $product_request->sltParent;
        $product_request->file('fImages')->move('resources/upload/',$file_name);
        $product->save();
        $product_id = $product->id;
        if(Input::hasFile('fProductDetail')){
            foreach (Input::file('fProductDetail')as $file){
                $product_img = new ProductImages();
                if(isset($file)){
                    $product_img->image = $file->getClientOriginalName();
                    $product_img->product_id = $product_id;
                    $file->move('resources/upload/detial/',$file->getClientOriginalName());
                    $product_img->save();
                }
            }
        }
        return redirect()->route('admin.product.list')->with(['flash_level'=>'success','flash_message'=>'Success! Complete Add Product']);
    }
    public function getDelete ($id){
        $product_detail = Product::find($id)->pimages->toArray();
        foreach ($product_detail as $value){
            File::delete('resources/upload/detial/'.$value["image"]);
        }
        $product = Product::find($id);
        File::delete('resources/upload/'.$product->image);
        $product->delete();
        return redirect()->route('admin.product.list')->with(['flash_level'=>'success','flash_message'=>'Success! Complete Delete Product']);
    }
    public function getEdit($id){
        $cate = Cate::select('id','name','parent_id')->get()->toArray();
        $product = Product::find($id);
        $product_image = Product::find($id)->pimages;
        return view('admin.product.edit',compact('cate','product','product_image'));
    }
    public function postEdit(){

    }
    public function getDelImg($id){
        if(Request::ajax()){
            $idHinh = (int)Request::get('idHinh');
            $image_detial = ProductImages::find($idHinh);
            if(!empty($image_detial)){
                $img = 'resources/upload/detial'.$image_detial->image;
                if(File::exists($img)){
                    File::delete($img);
                }
                $image_detial->delete();
            }
            return "Oke";
        }
    }

}
