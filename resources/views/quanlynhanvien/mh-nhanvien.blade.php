@extends('layout.layout')
@section('noidung')
<div class="row ">
  <div class="col-3">
    <div class="p-3 border bg-dark mt-3 ml-3 menu-hover-active-li"><a href="/ql-nhanvien">Quản lý  Nhân viên</a></div>
  </div>
  <div class="col-8">

    <div class="d-flex justify-content-between">
      <h4 class=" mt-3">Bảng Nhân viên</h4>
      <div class="justify-content-between mt-3 ">
        <form action="/searchnhanvien" method="POST">
          @csrf
          <input type="hidden" name="_token" value="{{ csrf_token() }}" />
          <div class="row">
            <input type="text" class="form-control col-6" id="search" name="keyword">
            <button type="submit" class="btn btn-success ml-1">Tìm kiếm</button>
          </div>
        </form>
      </div>
      <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#modalcreate">Thêm Nhân viên</button>
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
          <th scope="col">Điện Thoại</th>
          <th scope="col">Hành Động</th>
        </tr>
      </thead>
      <tbody>
      <tbody>
        <tr>
          <?php $number = 1; ?>
          @foreach ($nhanvienAll as $nhanvien)
          <td scope="row">1</td>
          <?php $number++; ?>
          <td>{{$nhanvien->MaNhanVien}}</td>
          <td>{{$nhanvien->TenNhanVien}}</td>
          <td>{{$nhanvien->GioiTinh}}</td>
          <td>{{$nhanvien->DiaChi}}</td>
          <td>{{$nhanvien->DienThoai}}</td>
          <td>{{$nhanvien->NgaySinh}}</td>
          <td>
            <button type="button" class="btn btn-danger btn-delete-nhanvien" data-toggle="modal" data-target="#modalDelete" data-id="{{$nhanvien->MaNhanVien}}">Xóa</button>
            <a type="submit" class="btn btn-success" href="editnhanvien/{{$nhanvien->MaNhanVien}}">Chỉnh sửa</a>
          </td>
        </tr>
        @endforeach
      </tbody>
      </tbody>
    </table>
  </div>
</div>
<form action="/xoanhanvien" method="GET" hidden id="form-delete">
  @csrf
  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
  <input type="text" class="form-control" id="deleteNhanvien" name="MaNhanVien">
</form>
<!-- Modal -->
<div class="modal fade" id="modalcreate" tabindex="-1" aria-labelledby="modalCreateLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCreateLabel">Thêm mới Nhân Viên</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="model-themnhanvien">
        <form method="POST" action="/themnhanvien" id="themmoinhanvien">
          @csrf
          <input type="hidden" name="_token" value="{{ csrf_token() }}" />
          <div class="form-group">
            <label for="TenNhanVien">Tên Nhân viên</label>
            <input type="text" class="form-control" id="TenNhanVien" name="TenNhanVien">
          </div>
          <div class="form-group">
            <label for="GioiTinh">Giới Tính</label>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="GioiTinh" id="inlineRadio1" value="Nữ" checked>
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
          <div class="form-group">
            <label for="NgaySinh">Ngày Sinh</label>
            <input type="date" class="form-control" id="NgaySinh" name="DienThoai">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close-model-nhanvien">Đóng</button>
        <button type="submit" class="btn btn-success" id="btn-themmoinhanvien">Thêm mới </button>
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
<!--------Modal Xóa --->

<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="modalDelete" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Xác nhận xóa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- <div class="modal-body">
        ...
      </div> -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary " id="confirm-xoa">Xóa</button>
            </div>
        </div>
    </div>
</div>

@endsection