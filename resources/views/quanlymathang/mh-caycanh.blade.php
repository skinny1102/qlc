@extends('layout.layout')
@section('noidung')
<div class="row ">
  <div class="col-3">
    <div class="p-3 border bg-ligh mt-3 ml-3 menu-hover-active-li"><a href="/ql-mathang/loaicay">Loại cây</a></div>
    <div class="p-3 border bg-light mt-3 ml-3 menu-hover-active-li"> <a href="/ql-mathang/caycanh">Cây cảnh</a> </div>
  </div>
  <div class="col-8">
    <div class="d-flex justify-content-between">
      <h4 class=" mt-3">Bảng Cây Cảnh</h4>
      <div class="justify-content-between mt-3 ">
        <form action="/searchcaycanh" method="POST">
          @csrf
          <input type="hidden" name="_token" value="{{ csrf_token() }}" />
          <div class="row">
            <input type="text" class="form-control col-6" id="search" name="keyword">
            <button type="submit" class="btn btn-success ml-1">Tìm kiếm</button>
          </div>
        </form>
      </div>
      <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#modalcreate">Thêm cây Cảnh</button>
    </div>
    <table class="table mt-3 table-bordered">
      <thead>
        <tr>
          <th scope="col">STT</th>
          <th scope="col">Mã cây</th>
          <th scope="col">Tên cây</th>
          <th scope="col">Loại cây</th>
          <th scope="col">Số lượng</th>
          <th scope="col">Đơn giá bán</th>
          <th scope="col">Xuất xứ</th>
          <th scope="col">Mô tả</th>
          <th scope="col">Hành đông</th>
        </tr>
      </thead>
      <tbody>
        <?php $number = 1; ?>
        @foreach ($caycanhAll as $caycanh)
        <tr>
          <th scope="row">{{ $number }}</th>
          <?php $number++; ?>
          <td>{{$caycanh->MaCay}}</td>
          <td>{{$caycanh->TenCay}}</td>
          <td>{{$caycanh->TenLoaiCay}}</td>
          <td>{{$caycanh->SoLuong}}</td>
          <td>{{$caycanh->DonGiaBan}}</td>
          <td>{{$caycanh->XuatXu}}</td>
          <td>{{$caycanh->MoTa}}</td>
          <td>
            <button type="button" class="btn btn-danger btn-delete-caycanh" data-id="{{$caycanh->MaCay}}">Xóa</button>
            <a type="submit" class="btn btn-success" href="caycanh/{{$caycanh->MaCay}}">Chỉnh sửa</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<form action="/xoacaycanh" method="GET" hidden id="form-delete">
  @csrf
  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
  <input type="text" class="form-control" id="deleteMaCay" name="MaCay">
</form>
<!-- Modal -->
<div class="modal fade" id="modalcreate" tabindex="-1" aria-labelledby="modalCreateLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCreateLabel">Thêm mới cây cảnh</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="model-themcaycanh">
        <form method="POST" action="/themcaycanh" id="themmoicaycanh">
          @csrf
          <input type="hidden" name="_token" value="{{ csrf_token() }}" />
          <div class="form-group">
            <label for="tenloaicay">Tên cây</label>
            <input type="text" class="form-control" id="TenCay" name="TenCay">
          </div>
          <div class="form-group">
            <label for="SoLuong">Số lượng </label>
            <input type="text" class="form-control" id="SoLuong" name="SoLuong">
          </div>
          <div class="form-group">
            <label for="DonGiaBan">Đơn giá bán </label>
            <input type="text" class="form-control" id="DonGiaBan" name="DonGiaBan">
          </div>
          <div class="form-group">
            <label for="XuatXu">Xuất Xứ</label>
            <input type="text" class="form-control" id="XuatXu" name="XuatXu">
          </div>

          <div class="form-group">
            <label for="Mota">Mô tả</label>
            <input type="text" class="form-control" id="MoTa" name="MoTa">
          </div>

          <div class="form-group">
            <label for="HuongDan">Hướng dẫn</label>
            <input type="text" class="form-control" id="HuongDan" name="HuongDan">
          </div>

          <div class="form-group">
            <label for="MaLoaiCay">Loại cây</label>
            <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="MaLoaiCay" name="MaLoaiCay">
              @foreach ($loaicayAll as $loaicay)
              <option value="{{$loaicay->MaLoaiCay}}">{{$loaicay->TenLoaiCay}}</option>
              @endforeach
            </select>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close-model-caycanh">Đóng</button>
        <button type="submit" class="btn btn-success" id="btn-themmoicaycanh">Thêm mới </button>
      </div>
    </div>
  </div>
</div>

<form action="/xoaloaicay" method="GET" hidden id="form-delete">
  @csrf
  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
  <input type="text" class="form-control" id="deleteMaloaicay" name="MaLoaiCay">
</form>

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