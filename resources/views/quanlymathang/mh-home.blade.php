@extends('layout.layout')
@section('noidung')
<div class="row ">
  <div class="col-3">
    <div class="p-3 border bg-ligh mt-3 ml-3 menu-hover-active-li"><a href="/ql-mathang/loaicay">Loại cây</a></div>
    <div class="p-3 border bg-light mt-3 ml-3 menu-hover-active-li"> <a href="/ql-mathang/caycanh">Cây cảnh</a> </div>
  </div>
  <div class="col-6">
    <div class="d-flex justify-content-center">
      <h4 class="w-100 mt-3">Bảng loại cây</h4>
      <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#modalcreate">Thêm loại cây</button>
    </div>
    <table class="table mt-3 table-bordered">
      <thead>
        <tr>
          <th scope="col">STT</th>
          <th scope="col">Mã loại cây</th>
          <th scope="col">Tên loại cây</th>
          <th scope="col">Hành động</th>
        </tr>
      </thead>
      <tbody>
        <?php $number = 1; ?>
        @foreach ($loaicayAll as $loaicay)
        <tr>
          <th scope="row">{{ $number }}</th>
          <?php $number++; ?>
          <td>{{$loaicay->MaLoaiCay}}</td>
          <td>{{$loaicay->TenLoaiCay}}</td>
          <td>
            <button type="button" class="btn btn-danger btn-delete-cay" data-id="{{$loaicay->MaLoaiCay}}">Xóa</button>
            <button type="submit" class="btn btn-success">Chỉnh sửa</button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="col-3">
    <form action="/searchloaicay" class="mt-3 pt-1" method="POST">
      @csrf
      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      <div class="form-group mt-3">
        <label for="search">Tìm kiếm </label>
        <div class="row">
          <input type="text" class="form-control col-6" id="search" name="keyword">
          <button type="submit" class="btn btn-success ml-1">Tìm kiếm</button>
        </div>
        <small id="emailHelp" class="form-text text-muted">Tìm kiếm theo Mã loại cây hoặc tên loại cây</small>
      </div>
    </form>
  </div>
</div>
<form action="/xoaloaicay" method="GET" hidden id="form-delete">
  @csrf
  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
  <input type="text" class="form-control" id="deleteMaloaicay" name="MaLoaiCay">
</form>
<!-- Modal -->
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