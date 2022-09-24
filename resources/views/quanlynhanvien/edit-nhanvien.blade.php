@extends('layout.layout')
@section('noidung')
<div class="row ">
  <div class="col-3">
  <div class="p-3 border bg-ligh mt-3 ml-3 menu-hover-active-li"><a href="/ql-nhanvien">Quản lý Khách hàng</a></div>
  </div>
  <div class="col-8">
    <div class="d-flex justify-content-center">
      <h4 class="w-100 mt-3">Chỉnh sửa Nhân Viên</h4>
      <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#modalcreate">Thêm cây Cảnh</button>
    </div>
    <form method="POST" action="/suanhanvien/{{$nhanvien->MaNhanVien}}" >
      @csrf
      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      <div class="form-group">
        <label for="TenNhanVien">Tên Khách hàng</label>
        <input type="text" class="form-control" id="TenNhanVien" name="TenNhanVien" value="{{$nhanvien->TenNhanVien}}">
      </div>
      <div class="form-group">
        <label for="GioiTinh">Giới Tính</label>
        <div class="form-check form-check-inline">
          @if($nhanvien->GioiTinh =='Nữ')
          <input class="form-check-input" type="radio" name="GioiTinh" id="inlineRadio1" value="Nữ" checked>
          @else
          <input class="form-check-input" type="radio" name="GioiTinh" id="inlineRadio1" value="Nữ">
          @endif
          <label class="form-check-label" for="inlineRadio1">Nữ</label>
        </div>
        <div class="form-check form-check-inline">
          @if($nhanvien->GioiTinh =='Nam')
          <input class="form-check-input" type="radio" name="GioiTinh" id="inlineRadio2" value="Nam" checked>
          @else
          <input class="form-check-input" type="radio" name="GioiTinh" id="inlineRadio2" value="Nam">
          @endif
          <label class="form-check-label" for="inlineRadio2">Nam</label>
        </div>
      </div>
      <div class="form-group">
        <label for="DiaChi">Địa Chỉ</label>
        <input type="text" class="form-control" id="DiaChi" name="DiaChi" value="{{$nhanvien->DiaChi}}">
      </div>
      <div class="form-group">
        <label for="DienThoai">Điện Thoại</label>
        <input type="text" class="form-control" id="DienThoai" name="DienThoai" value="{{$nhanvien->DienThoai}}">
      </div>
      <div class="form-group">
        <label for="NgaySinh">Ngày sinh</label>
        <input type="date" class="form-control" id="DienThoai" name="NgaySinh" value="{{$nhanvien->NgaySinh}}">
      </div>
      <button type="submit" class="btn btn-success">Chỉnh sửa</button>
    </form>
  </div>
</div>


@endsection