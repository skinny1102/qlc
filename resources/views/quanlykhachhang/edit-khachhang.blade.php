@extends('layout.layout')
@section('noidung')
<div class="row ">
  <div class="col-3">
    <div class="p-3 border bg-dark mt-3 ml-3 menu-hover-active-li"><a href="/ql-mathang/loaicay">Loại cây</a></div>
    <div class="p-3 border bg-dark mt-3 ml-3 menu-hover-active-li"> <a href="/ql-mathang/caycanh">Cây cảnh</a> </div>
  </div>
  <div class="col-8">
    <div class="d-flex justify-content-center">
      <h4 class="w-100 mt-3">Chỉnh sửa khách hàng</h4>
      <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#modalcreate">Thêm cây Cảnh</button>
    </div>
    <form method="POST" action="/suakhachhang/{{$khachhang->MaKhachHang}}" >
      @csrf
      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      <div class="form-group">
        <label for="TenKhachHang">Tên Khách hàng</label>
        <input type="text" class="form-control" id="TenKhachHang" name="TenKhachHang" value="{{$khachhang->TenKhachHang}}">
      </div>
      <div class="form-group">
        <label for="GioiTinh">Giới Tính</label>
        <div class="form-check form-check-inline">
          @if($khachhang->GioiTinh =='Nữ')
          <input class="form-check-input" type="radio" name="GioiTinh" id="inlineRadio1" value="Nữ" checked>
          @else
          <input class="form-check-input" type="radio" name="GioiTinh" id="inlineRadio1" value="Nữ">
          @endif
          <label class="form-check-label" for="inlineRadio1">Nữ</label>
        </div>
        <div class="form-check form-check-inline">
          @if($khachhang->GioiTinh =='Nam')
          <input class="form-check-input" type="radio" name="GioiTinh" id="inlineRadio2" value="Nam" checked>
          @else
          <input class="form-check-input" type="radio" name="GioiTinh" id="inlineRadio2" value="Nam">
          @endif
          <label class="form-check-label" for="inlineRadio2">Nam</label>
        </div>
      </div>
      <div class="form-group">
        <label for="DiaChi">Địa Chỉ</label>
        <input type="text" class="form-control" id="DiaChi" name="DiaChi" value="{{$khachhang->DiaChi}}">
      </div>
      <div class="form-group">
        <label for="DienThoai">Điện Thoại</label>
        <input type="text" class="form-control" id="DienThoai" name="DienThoai" value="{{$khachhang->DienThoai}}">
      </div>
      <button type="submit" class="btn btn-success">Chỉnh sửa</button>
    </form>
  </div>
</div>


@endsection