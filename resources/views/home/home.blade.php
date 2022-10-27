@extends('layout.layout')
@section('noidung')
<div class="container">
  <div class="d-flex justify-content-center mt-4">
    <div class="card text-white bg-primary mb-3 ml-3" style="max-width: 18rem;">
      <a href="/ql-hoadon" class="text-a-style-display text-light" rel="noopener noreferrer">
        <div class="card-header">Quản lý hóa đơn</div>
        <div class="card-body">
          <h6 class="card-title">Tổng hóa đơn: </h6>
          <p class="card-text">{{$counthoadon}}</p>
        </div>
      </a>
    </div>

    <div class="card text-white bg-secondary mb-3 ml-3" style="max-width: 18rem;">
      <a href="/ql-mathang" class="text-a-style-display text-light" rel="noopener noreferrer">
        <div class="card-header">Quản lý mặt hàng </div>
        <div class="card-body">
          <h6 class="card-title">Tổng số mặt hàng: </h6>
          <p class="card-text">{{$countcaycanh}}</p>
        </div>
      </a>
    </div>

    <div class="card text-white bg-success mb-3 ml-3" style="max-width: 18rem;">
      <a href="/ql-nhanvien" class="text-a-style-display text-light" target="" rel="noopener noreferrer">
        <div class="card-header">Quản lý Nhân viên</div>
        <div class="card-body">
          <h6 class="card-title">Số lượng nhân viên : </h6>
          <p class="card-text">{{$countnhanvien}}</p>
        </div>
      </a>
    </div>
    <div class="card text-white bg-warning mb-3 ml-3" style="max-width: 18rem;">
      <a href="/ql-khachhang" class="text-a-style-display text-light" target="" rel="noopener noreferrer">
        <div class="card-header">Quản lý Khách hàng</div>
        <div class="card-body">
          <h6 class="card-title">Số lượng Khách hàng : </h6>
          <p class="card-text">{{$countkhachhang}}</p>
        </div>
      </a>
    </div>
  </div>
</div>
@endsection