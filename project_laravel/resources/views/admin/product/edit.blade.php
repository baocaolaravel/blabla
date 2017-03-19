@extends('admin.master')
@section('controller','Product')
@section('action','Edit')
@section('content')
    <style>
        .img_current {width: 150px;}
        .img_detial {width: 200px; margin-bottom: 20px;}
        .icon_del {position: relative;margin-left: -20px; margin-top: -70px;}
        #insert {margin-top: 20px;}
    </style>
    <form action="{!! route('admin.product.getEdit') !!}" method="POST" enctype="multipart/form-data" name="frmEditProduct">
    <div class="col-lg-7" style="padding-bottom:120px">
            @include('admin.blocks.error')
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <div class="form-group">
                <label>Category Parent</label>
                <select class="form-control" name="sltParent">
                    <option value="">Please Choose Category</option>
                    <?php cate_parent($cate,0,"--",$product["cate_id"])?>
                </select>
            </div>
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" name="txtName" placeholder="Please Enter Username" value="{!! old('txtName'),isset($product) ? $product['name']:null !!}" />
            </div>
            <div class="form-group">
                <label>Price</label>
                <input class="form-control" name="txtPrice" placeholder="Please Enter Password" value="{!! old('txtPrice'),isset($product) ? $product['price']:null !!}"/>
            </div>
            <div class="form-group">
                <label>Intro</label>
                <textarea class="form-control" rows="3" name="txtIntro">{!! old('txtIntro'),isset($product) ? $product['intro']:null !!}</textarea>
                <script type="text/javascript">ckeditor('txtIntro')</script>
            </div>
            <div class="form-group">
                <label>Content</label>
                <textarea class="form-control" rows="3" name="txtContent">{!! old('txtContent'),isset($product) ? $product['content']:null !!}</textarea>
                <script type="text/javascript">ckeditor('txtContent')</script>
            </div>
            <div class="form-group">
                <label>Images Current</label>
                <img src="{!! asset('resources/upload/'.$product['image']) !!}" class="img_current"/>
            </div>
            <div class="form-group">
                <label>Images</label>
                <input type="file" name="fImages">
            </div>
            <div class="form-group">
                <label>Product Keywords</label>
                <input class="form-control" name="txtKeywords" placeholder="Please Enter Category Keywords"value="{!! old('txtKeywords'),isset($product) ? $product['keywords']:null !!}"/>
            </div>
            <div class="form-group">
                <label>Product Description</label>
                <textarea class="form-control" rows="3" name="txtDescription">{!! old('txtDescription'),isset($product) ? $product['description']:null !!}</textarea>
            </div>
            <button type="submit" class="btn btn-default">Product Edit</button>
            <button type="reset" class="btn btn-default">Reset</button>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-4">
            @foreach($product_image as $key => $item)
                <div class="form-group" id="hinh{!! $key !!}">
                    <img src="{!! asset('resources/upload/detial/'.$item['image']) !!}" class="img_detial" idhinh="hinh{!! $key !!}" id="{!! $key !!}"/>
                    <a href="javascript:void(0)" type="button" id="del_img_demo" class="btn btn-danger btn-circle icon_del"><i class="fa fa-times"></i></a>
                    <input type="file" name="fProductDetail[]" />
                </div>
            @endforeach
            <button type="button" class="btn btn-primary" id="addImages">Add Images</button>
                <div id="insert"></div>
        </div>
    </form>
@endsection()
