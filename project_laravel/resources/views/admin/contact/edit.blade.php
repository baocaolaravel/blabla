@extends('admin.master')
@section('controller','Contact')
@section('action','Edit')
@section('content')
    <style>
        .img_current {width: 150px;}
        .img_detail {width: 200px; margin-bottom: 20px;}
        .icon_del {position: relative;margin-left: -20px; margin-top: -70px;}
        #insert {margin-top: 20px;}
    </style>
    <form action="{!! route('admin.contact.getEdit') !!}" method="POST">
    <div class="col-lg-7" style="padding-bottom:120px">
            @include('admin.blocks.error')
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" name="txtName" placeholder="Please Enter Username" value="{!! old('txtName'),isset($contact) ? $contact['name']:null !!}" />
            </div>
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" name="txtEmail" placeholder="Please Enter Email" value="{!! old('txtEmail'),isset($contact) ? $contact['email']:null !!}"/>
            </div>
            <div class="form-group">
                 <label>Tel.No.</label>
                 <input class="form-control" name="txtTelno" placeholder="Please Enter Tel.No." value="{!! old('txtTelno'),isset($contact) ? $contact['telno']:null !!}"/>
            </div>
            <div class="form-group">
                 <label>Address</label>
                 <input class="form-control" name="txtAddress" placeholder="Please Enter Address " value="{!! old('txtAddress'),isset($contact) ? $contact['address']:null !!}"/>
            </div>
            <div class="form-group">
                <label>Content</label>
                <textarea class="form-control" rows="3" name="txtContent">{!! old('txtContent'),isset($contact) ? $contact['content']:null !!}</textarea>
                <script type="text/javascript">ckeditor('txtContent')</script>
            </div>
            <button type="submit" class="btn btn-default">Contact Edit</button>
            <button type="reset" class="btn btn-default">Reset</button>
        </div>
    </form>
@endsection()
