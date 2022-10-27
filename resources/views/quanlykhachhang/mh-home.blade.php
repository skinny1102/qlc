@extends('layout.layout')
@section('noidung')
<div class="row ">
  <div class="col-3">
    <div class="p-3 border bg-dark mt-3 ml-3 menu-hover-active-li"><a href="/ql-khachhang">Quản lý Khách hàng</a></div>
  </div>
  <div class="col-8">

    <div class="d-flex justify-content-between">
      <h4 class=" mt-3">Bảng Khách hàng</h4>
      <div class="justify-content-between mt-3 ">
        <form action="/searchkhachhang" method="POST">
          @csrf
          <input type="hidden" name="_token" value="{{ csrf_token() }}" />
          <div class="row">
            <input type="text" class="form-control col-6" id="search" name="keyword">
            <button type="submit" class="btn btn-success ml-1">Tìm kiếm</button>
          </div>
        </form>
      </div>
      <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#modalcreate">Thêm Khách hàng</button>
    </div>
    <table class="table mt-3 table-bordered">
      <thead>
        <tr>
          <th scope="col">STT</th>
          <th scope="col">Mã Khách hàng</th>
          <th scope="col">Tên Khách hàng</th>
          <th scope="col">Giới Tính</th>
          <th scope="col">Địa Chỉ</th>
          <th scope="col">Điện Thoại</th>
          <th scope="col">Hành Động</th>
        </tr>
      </thead>
      <tbody>
      <tbody>
        <tr>
          <?php $number = 1; ?>
          @foreach ($khachhangAll as $khachhang)
          <td scope="row">1</td>
          <?php $number++; ?>
          <td>{{$khachhang->MaKhachHang}}</td>
          <td>{{$khachhang->TenKhachHang}}</td>
          <td>{{$khachhang->GioiTinh}}</td>
          <td>{{$khachhang->DiaChi}}</td>
          <td>{{$khachhang->DienThoai}}</td>
          <td>
            <button type="button" class="btn btn-danger btn-delete-khachhang" data-id="{{$khachhang->MaKhachHang}}">Xóa</button>
            <a type="submit" class="btn btn-success" href="editkhachhang/{{$khachhang->MaKhachHang}}">Chỉnh sửa</a>

          </td>
        </tr>
        @endforeach
      </tbody>
      </tbody>
    </table>
  </div>
</div>
<form action="/xoakhachhang" method="GET" hidden id="form-delete">
  @csrf
  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
  <input type="text" class="form-control" id="deleteKhachhang" name="MaKhachHang">
</form>
<!-- Modal -->
<div class="modal fade" id="modalcreate" tabindex="-1" aria-labelledby="modalCreateLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCreateLabel">Thêm mới Khách hàng</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="model-themcay">
        <form method="POST" action="/themkhachhang" id="themmoikhachhang">
          @csrf
          <input type="hidden" name="_token" value="{{ csrf_token() }}" />
          <div class="form-group">
            <label for="TenKhachHang">Tên Khách hàng</label>
            <input type="text" class="form-control" id="TenKhachHang" name="TenKhachHang">
          </div>
          <div class="form-group">
            <label for="GioiTinh">Giới Tính</label>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="GioiTinh" id="inlineRadio1" value="Nữ">
              <label class="form-check-label" for="inlineRadio1">Nữ</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="GioiTinh" id="inlineRadio2" value="Nam">
              <label class="form-check-label" for="inlineRadio2">Nam</label>
            </div>
          </div>
          <div class="form-group">
            <label for="DiaChi">Địa Chỉ</label>
            <input type="text" class="form-control" id="DiaChi" name="DiaChi">
          </div>
          <div class="form-group">
            <label for="DienThoai">Điện Thoại</label>
            <input type="text" class="form-control" id="DienThoai" name="DienThoai">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close-model-khachhang">Đóng</button>
        <button type="submit" class="btn btn-success" id="btn-themmoikhachhang">Thêm mới </button>
      </div>
    </div>
  </div>
</div>
<!-- MODAL SUCESS -->
<button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#modalsuccess" id="btn-sucess" hidden>Thêm loại cây</button>
<div class="modal fade" id="modalsuccess" tabindex="-1" aria-labelledby="modalCreateLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCreateLabel">Thêm mới thành công</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" id="btn-themmoiloaicay">Hoàn thành </button>
      </div>
    </div>
  </div>
</div>
<!--EDIT Modal -->
<div class="modal fade" id="modalcreate" tabindex="-1" aria-labelledby="modalCreateLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCreateLabel">Thêm mới loại cây</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="model-themcay">
        <form method="POST" action="/themloaicay" id="themmoiloaicay">
          @csrf
          <input type="hidden" name="_token" value="{{ csrf_token() }}" />
          <div class="form-group">
            <label for="tenloaicay">Tên loại cây</label>
            <input type="text" class="form-control" id="tenloaicay">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close-model-loaicay">Đóng</button>
        <button type="submit" class="btn btn-success" id="btn-themmoiloaicay">Thêm mới </button>
      </div>
    </div>
  </div>
</div>
@endsection