@extends('layout.layout')
@section('noidung')
<div class="row bg-clg">
    <div class="col-2">
        <div class="p-3 border bg-ligh mt-3 ml-3 menu-hover-active-li"><a href="/ql-hoadon">Hóa Đơn</a></div>
    </div>
    <div class="col-9">
        <div class="d-flex justify-content-between">
            <h4 class=" mt-3">In Hóa đơn</h4>
            <a class="btn btn-primary mt-3" href="/xuatpdf/{{$hoadon->MaHoaDon}}">Xuất File</a>
        </div>
        <div class="modal-content ftm m-4" style="width: 1074px;">
            <div class="row justify-content-end">
                <div class="col-3 pt-3">
                    <p class="modal-title">CỬA HÀNG BÁN CÂY CẢNH </p>
                    <p class="text-center"> TG</p>
                </div>
            </div>
            <div class=" row justify-content-center">
                <div class="col-12">
                    <p class="text-center header-receipt mb-0">HÓA ĐƠN BÁN HÀNG </p>
                    <p class="text-center">Mã hóa đơn : {{$hoadon->MaHoaDon}} </p>
                    <p class="text-center">Ngày lập hóa đơn : <?php echo date('Y-m-d', strtotime($hoadon->NgayBan)); ?> </p>
                </div>
            </div>
            <div class=" row justify-content-start">
                <div class="col-6" style="margin-left: 100px">
                    <p class="text-left  mb-1"> <b>Mã Khách Hàng </b>: {{$hoadon->MaKhachHang}} </p>
                    <p class="text-left mb-1"> <b>Tên Khách Hàng </b>: {{$hoadon->TenKhachHang}} </p>
                    <p class="text-left mb-1"> <b>Địa Chỉ</b> : {{$hoadon->DiaChi}} </p>
                    <p class="text-left mb-1"> <b>SĐT </b>: {{$hoadon->DienThoai}} </p>
                </div>
            </div>
            <div>
                <div class="row justify-content-center">
                    <table class="table mt-1 table-bordered" style="width: 930px;">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">Tên Cây</th>
                                <th scope="col" class="text-center">Giá</th>
                                <th scope="col" class="text-center">Số lượng</th>
                                <th scope="col" class="text-center">Đơn Giá</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($chitietAll as $chitiet)
                            <tr>
                                <th scope="row">
                                    <p class="text-center m-0"> {{$chitiet->TenCay}}</p>
                                </th>
                                <td>
                                    <p class="text-center m-0"> {{$chitiet->DonGiaBan}}</p>
                                </td>

                                <td>
                                    <p class="text-center m-0"> {{$chitiet->SoLuong}}</p>
                                </td>
                                <td>
                                    <p class="text-center m-0"> {{$chitiet->DonGia}}</p>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tbody id="table-body">
                            <tr>
                                <th scope="row" colspan="3">
                                    <p class="text-center m-0"> Tổng tiền : </p>
                                </th>
                                <th>
                                    <p class="text-center m-0"> {{$hoadon->TongTien}} </p>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class=" row justify-content-end mb-2">
                <div class="col-6" style="padding-left: 230px">
                    <p class="text-left  mb-1"><b> Người Lập hóa đơn</b> </p>
                    <p class="text-left mb-1">{{$hoadon->TenNhanVien}} </p>
                </div>
            </div>

        </div>

    </div>
</div>



@endsection