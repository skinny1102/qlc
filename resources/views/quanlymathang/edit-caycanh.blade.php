@extends('layout.layout')
@section('noidung')
<div class="row ">
    <div class="col-3">
        <div class="p-3 border bg-ligh mt-3 ml-3 menu-hover-active-li"><a href="/ql-mathang/loaicay">Loại cây</a></div>
        <div class="p-3 border bg-light mt-3 ml-3 menu-hover-active-li"> <a href="/ql-mathang/caycanh">Cây cảnh</a> </div>
    </div>
    <div class="col-8">
        <div class="d-flex justify-content-center">
            <h4 class="w-100 mt-3">Chỉnh sửa cây cảnh</h4>
            <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#modalcreate">Thêm cây Cảnh</button>
        </div>
        <form method="POST" action="/editcaycanh/{{$caycanh->MaCay}}">
            @csrf
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="form-group">
                <label for="tenloaicay">Tên cây</label>
                <input type="text" class="form-control" id="TenCay" name="TenCay" value="{{$caycanh->TenCay}}">
            </div>
            <div class="form-group">
                <label for="SoLuong">Số lượng </label>
                <input type="text" class="form-control" id="SoLuong" name="SoLuong" value="{{$caycanh->SoLuong}}">
            </div>
            <div class="form-group">
                <label for="DonGiaBan">Đơn giá bán </label>
                <input type="text" class="form-control" id="DonGiaBan" name="DonGiaBan" value="{{$caycanh->DonGiaBan}}">
            </div>
            <div class="form-group">
                <label for="XuatXu">Xuất Xứ</label>
                <input type="text" class="form-control" id="XuatXu" name="XuatXu" value="{{$caycanh->XuatXu}}">
            </div>
            <div class="form-group">
                <label for="Mota">Mô tả</label>
                <input type="text" class="form-control" id="MoTa" name="MoTa" value="{{$caycanh->MoTa}}">
            </div>

            <div class="form-group">
                <label for="HuongDan">Hướng dẫn</label>
                <input type="text" class="form-control" id="HuongDan" name="HuongDan" value="{{$caycanh->HuongDan}}">
            </div>

            <div class="form-group">
                <label for="MaLoaiCay">Loại cây</label>
                <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="MaLoaiCay" name="MaLoaiCay">
                    @foreach ($loaicayAll as $loaicay)

                    @if ( $loaicay-> MaLoaiCay ==$caycanh->MaLoaiCay )
                    <option value="{{$loaicay->MaLoaiCay}}" selected>{{$loaicay->TenLoaiCay}}</option>
                    @endif

                    <option value="{{$loaicay->MaLoaiCay}}">{{$loaicay->TenLoaiCay}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success" id="btn-edit"> Sửa</button>
        </form>
    </div>
</div>


@endsection