@extends('admin.master')
@section('controller','Contact')
@section('action','Add')
@section('content')
    <form action="{!! route('admin.contact.getAdd') !!}" method="POST">
    <div class="col-lg-7" style="padding-bottom:120px">
        @include('admin.blocks.error')
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <div class="form-group">
                <label>Họ tên</label>
                <input class="form-control" name="txtName" placeholder="Nhập tên khách hàng" value="{!! old('txtName') !!}"/>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" name="txtEmail" placeholder="Nhập Email của khách hàng" value="{!! old('txtEmail') !!}" />
            </div>
            <div class="form-group">
                <label>Số điện thoại</label>
                <input class="form-control" name="txtTelno" placeholder="Nhập số điện thoại của khách hàng" value="{!! old('txttelno') !!}" />
            </div>
            <div class="form-group">
                <label>Địa chỉ</label>
                <input class="form-control" name="txtAddress" placeholder="Nhập số điện thoại của khách hàng" value="{!! old('txtAddress') !!}" />
            </div>
            <div class="form-group">
                 <label>Phản hồi</label>
                <textarea class="form-control" rows="3" name="txtContent">{!! old('txtContent') !!}</textarea>
                <script type="text/javascript">ckeditor ("txtContent")</script>
             </div>
            <button type="submit" class="btn btn-primary">Gửi</button>
            <button type="reset" class="btn btn-default">Làm lại</button>
    </div>
    </form>
@endsection()


