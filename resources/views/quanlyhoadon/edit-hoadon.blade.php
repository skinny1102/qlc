@extends('layout.layout')
@section('noidung')
<div class="row ">
    <div class="col-2">
        <div class="p-3 border bg-ligh mt-3 ml-3 menu-hover-active-li"><a href="/ql-nhanvien">Hóa Đơn</a></div>
    </div>
    <div class="col-9">
        <div class="d-flex justify-content-between">
            <h4 class=" mt-3">Chỉnh sửa</h4>
        </div>
        <div class="d-flex justify-content-between">
            <a class="btn btn-dark mt-3" href="/xuatpdf/{{$hoadon->MaHoaDon}}">In Hóa Đơn</a>
        </div>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateLabel">Chỉnh Sửa Hóa Đơn Mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="model-themnhanvien">
                <form method="POST" action="/suahoadon/{{$hoadon->MaHoaDon}}" id="themmoinhanvien">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="MaHoaDon">Mã Hóa Đơn</label>
                            <input type="text" class="form-control" id="MaHoaDon" name="MaHoaDon" readonly value="{{$hoadon->MaHoaDon}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="MaNhanVien">Tên Nhân Viên</label>
                            <select class="form-control" aria-label=".form-select-sm example" name="MaNhanVien" readonly>
                                @foreach ($nhanvienAll as $nhanvien)
                                @if ( $hoadon-> MaNhanVien == $nhanvien->MaNhanVien )
                                <option value="{{$nhanvien->MaNhanVien}}" selected>{{$nhanvien->TenNhanVien}}</option>
                                @else
                                <!-- <option value="{{$nhanvien->MaNhanVien}}">{{$nhanvien->TenNhanVien}}</option> -->
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="NgayBan">Ngày lập </label>
                            <input type="date" class="form-control" id="NgayBan" name="NgayBan" readonly value="<?php echo date('Y-m-d', strtotime($hoadon->NgayBan)); ?>">
                        </div>
                        <div class="form-group col-6">
                            <label for="MaKhachHang">Tên Khách hàng</label>
                            <select class="form-control" aria-label=".form-select-sm example" name="MaKhachHang">
                                @foreach ($khachhangAll as $khachhang)
                                @if ( $hoadon-> MaKhachHang == $khachhang->MaKhachHang )
                                <option value="{{$khachhang->MaKhachHang}}" selected>{{$khachhang->TenKhachHang}}</option>
                                @else

                                <option value="{{$khachhang->MaKhachHang}}">{{$khachhang->TenKhachHang}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="TongTien">Tổng tiền</label>
                            <input type="text" class="form-control" name="TongTien" readonly value="{{$hoadon->TongTien}}">
                        </div>
                    </div>
                    @if ( $hoadon-> inhoadon == 1 )
                    <button type="submit" class="btn btn-success" disabled>Sửa </button>
                    @else
                    <button type="submit" class="btn btn-success">Sửa </button>
                    @endif

                </form>
            </div>

            <div class="row justify-content-between">
                <h5 class="ml-4">Danh sách cây</h5>
                @if ( $hoadon-> inhoadon == 1 )
                <button type="button" class="btn btn-primary mr-4" data-toggle="modal" data-target="#exampleModal" disabled>
                    @else
                    <button type="button" class="btn btn-primary mr-4" data-toggle="modal" data-target="#exampleModal">
                        @endif
                        Thêm cây
                    </button>
            </div>
            <div class="row justify-content-center">
                <table class="table mt-1 table-bordered" style="width: 930px;">
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
                        @foreach ($chitietAll as $chitiet)
                        <tr id="tr-body1" data-id="tr-body1">
                            <th scope="row">
                                <input type="text" class="form-control" style="width: 141px;" readonly value="{{$chitiet->TenCay}}">
                            </th>
                            <td>
                                <input type="text" class="form-control" name="MaCay" style="width: 141px;" readonly value="{{$chitiet->MaCay}}">
                            </td>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="Gia" style="width: 100px;" readonly value="{{$chitiet->DonGiaBan}}">
                            </td>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="SoLuong" style="width:100px;" value="{{$chitiet->SoLuong}}" readonly>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="DonGia" style="width: 100px;" readonly value="{{$chitiet->DonGia}}">
                            </td>
                            </td>
                            <td>
                                @if ( $hoadon-> inhoadon == 1 )

                                <button type="button" class="btn btn-success" disabled>
                                    Chỉnh sửa
                                </button>
                                <button type="button" class="btn btn-danger" disabled>
                                    Xóa
                                </button>
                                @else

                                <button type="button" class="btn btn-success btn-suachitiethoadon" data-toggle="modal" data-target="#editModal" data-id="{{$chitiet->MaChiTietHoaDon}}">
                                    Chỉnh sửa
                                </button>
                                <button type="button" class="btn btn-danger btn-delete-chitiethoadon" data-id="{{$chitiet->MaChiTietHoaDon}}">
                                    Xóa
                                </button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
<form action="/xoachitiethoadon" method="GET" hidden id="form-delete">
    @csrf
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <input type="text" class="form-control" id="deletechitiethoadon" name="MaChiTietHoaDon">
</form>
<!-- Modal Them cay -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm cây</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="modal-body" id="model-themnhanvien">
                    <form method="POST" action="/themchitiet">
                        @csrf
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="row">
                            <input type="hidden" name="MaHoaDon" value="{{$hoadon->MaHoaDon}}" />
                            <div class="form-group col-6">
                                <label for="MaKhachHang">Tên Cây </label>
                                <select class="form-control" aria-label=".form-select-sm example" name="MaCay">
                                    @foreach ($caycanhAll as $caycanh)
                                    <option value="{{$caycanh->MaCay}}">{{$caycanh->TenCay}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="TongTien">Số lượng</label>
                                <input type="text" class="form-control" name="SoLuong">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Thêm </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sửa cấy</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-body" id="model-themnhanvien">
                    <form method="POST" action="/suachitiethoadon">
                        @csrf
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" class="form-control" id='id-chitiet' name="MaChiTietHoaDon">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="MaKhachHang">Tên Cây</label>
                                <select class="form-control" aria-label=".form-select-sm example" name="MaCay" id="caycanh-chitiet">
                                    @foreach ($caycanhAll as $caycanh)
                                    <option value="{{$caycanh->MaCay}}">{{$caycanh->TenCay}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-6">
                                <label for="TongTien">Số lượng</label>
                                <input type="text" class="form-control" id='sl-chitiet' name="SoLuong">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection