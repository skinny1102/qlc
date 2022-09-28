@extends('layout.layout')
@section('noidung')
<div class="row ">
    <div class="col-3">
        <div class="p-3 border bg-ligh mt-3 ml-3 menu-hover-active-li"><a href="/ql-nhanvien">Hóa Đơn</a></div>
    </div>
    <div class="col-8">

        <div class="d-flex justify-content-between">
            <h4 class=" mt-3">Danh sách hóa đơn</h4>
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
            <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#modalcreate">Lập Hóa Đơn</button>
        </div>
        <table class="table mt-3 table-bordered">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Mã Hóa Đơn</th>
                    <th scope="col">Tên Nhân Viên</th>
                    <th scope="col">Tên Khách hàng</th>
                    <th scope="col">Ngày lập</th>
                    <th scope="col">Tổng tièn</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Hành Động</th>
                </tr>
            </thead>
            <tbody>
            <tbody>
                <tr>
                    <td scope="row">1</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <button type="button" class="btn btn-danger btn-delete-nhanvien" data-id="">Xóa</button>
                        <a type="submit" class="btn btn-success" href="editnhanvien/">Chỉnh sửa</a>

                    </td>
                </tr>
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
<div class=" modal fade " id="modalcreate" tabindex="-1" aria-labelledby="modalCreateLabel" aria-hidden="true">
    <div class="modal-dialog " style="max-width: 1000px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateLabel">Lập Hóa Đơn Mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="model-themnhanvien">
                <form method="POST" action="/themnhanvien" id="themmoinhanvien">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="MaHoaDon">Mã Hóa Đơn</label>
                            <input type="text" class="form-control" id="MaHoaDon" name="MaHoaDon" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label for="MaNhanVien">Tên Nhân Viên</label>
                            <select class="form-control" aria-label=".form-select-sm example" id="MaNhanVien" name="MaNhanVien">
                                <option value="" selected>Nhân Viên</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="NgayBan">Ngày lập</label>
                            <input type="date" class="form-control" id="NgayBan" name="NgayBan" readonly value="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="form-group col-6">
                            <label for="TongTien">Tổng tiền</label>
                            <input type="text" class="form-control" id="TongTien" name="TongTien" readonly>
                        </div>
                    </div>
                    <hr>
                    <div class="row justify-content-between">
                        <h5 class="ml-4">Danh sách cây</h5>
                        <div class="btn btn-primary mr-4 add-cay" id="add-cay">Thêm cây</div>
                    </div>
                    <div class="row justify-content-center">
                        <table class="table mt-1 table-bordered" style="width: 830px;">
                            <thead>
                                <tr>
                                    <th scope="col">Tên Cây</th>
                                    <th scope="col">Mã Cây</th>
                                    <th scope="col">Giá</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Đơn Giá</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                <tr id="tr-body">
                                    <th scope="row">
                                        <select class="form-control ten-cay" aria-label=".form-select-sm example" id="MaLoaiCay" name="MaNhanVien">
                                            <option value="" selected></option>
                                        </select>
                                    </th>
                                    <td>
                                        <input type="text" class="form-control" id="TenCay" name="TenCay" style="width: 141px;" readonly>
                                    </td>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="Gia" name="Gia" style="width: 100px;" readonly>
                                    </td>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="SoLuong" style="width:100px;">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="DonGia" style="width: 100px;">
                                    </td>
                                    </td>
                                    <td>
                                        <div class="btn btn-danger" data-id="">Xóa</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
@endsection