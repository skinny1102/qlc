@extends('layout.layout')
@section('noidung')
<div class="row ">
    <div class="col-2">
        <div class="p-3 border bg-dark mt-3 ml-3 menu-hover-active-li"><a href="/ql-nhanvien">Hóa Đơn</a></div>
        <div class="p-3 border bg-dark mt-3 ml-3 menu-hover-active-li"><a href="/ql-baocaothongke">Báo Cáo Thống Kê</a></div>
    </div>
    <div class="col-9">
        <div class="d-flex justify-content-between">
            <h4 class=" mt-3">Báo Cáo Thống kê</h4>
        </div>
        <table class="table mt-3 table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="text-center">STT</th>
                    <th scope="col" class="text-center">Tên Báo Cáo</th>
                    <th scope="col" class="text-center">Người lập</th>
                    <th scope="col" class="text-center">Option</th>

                </tr>
            </thead>
            <tbody>
            <tbody>

                <tr>
                    <form action="/doanhthuthang" method="GET">

                        <td scope="row">1</td>
                        <td>Báo cáo bán hàng theo tháng</td>
                        <td>
                            <div class="row justify-content-center">
                                <input type="date" name="dateTo" class="col-3 p-0">
                                <p class="col-2">đến</p>
                                <input type="date" name="dateFrom" class="col-3 p-0">
                            </div>
                        </td>
                        <td>
                            <button type="submit" class="btn btn-secondary">Xuất Báo cáo</button>
                        </td>

                    </form>

                </tr>
            </tbody>
            </tbody>
        </table>
    </div>
</div>
<form action="/xoahoadon" method="GET" hidden id="form-delete">
    @csrf
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <input type="text" class="form-control" id="deletehoadon" name="MaHoaDon">
</form>

@endsection