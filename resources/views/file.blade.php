<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Document</title>
  <!-- CSS only -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="/css/menu-custom.css">
  <style>
body {
font-family: times-new-roman;
}
</style>
</head>
<body>
  <div class="m-4" style="width: 500px;">
    <div class="row justify-content-end">
      <div class="col-12 pt-3"  style="margin-left: 490px;">
        <p class="modal-title" >CỬA HÀNG BÁN CÂY CẢNH </p>
        <p class="" style="margin-left: 90px;"> TG</p>
      </div>
    </div>

    <div class=" row justify-content-center">
      <div class="col-12" style="margin-left: 80px;">
        <p class="text-center header-receipt mb-0" style="font-size: 30px;">HÓA ĐƠN BÁN HÀNG </p>
        <p class="text-center">Mã hóa đơn : {{$hoadon->MaHoaDon}} </p>
        <p class="text-center">Ngày lập hóa đơn : <?php echo date('Y-m-d', strtotime($hoadon->NgayBan)); ?> </p>
      </div>
    </div>
    <div class=" row justify-content-start">
      <div class="col-6" style="margin-left: 20px">
        <p class="text-left  mb-1"> <b>Mã Khách Hàng </b>: {{$hoadon->MaKhachHang}} </p>
        <p class="text-left mb-1"> <b>Tên Khách Hàng </b>: {{$hoadon->TenKhachHang}} </p>
        <p class="text-left mb-1"> <b>Địa Chỉ</b> : {{$hoadon->DiaChi}} </p>
        <p class="text-left mb-1"> <b>SĐT </b>: {{$hoadon->DienThoai}} </p>
      </div>
    </div>
    <div>
      <div class="row justify-content-center">
        <table class="table mt-1 table-bordered" style="width: 700px;">
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
      <div class="col-6" style="padding-left: 450px">
        <p class="text-left  mb-1"><b> Người Lập hóa đơn</b> </p>
        <p class="text-left mb-1">{{$hoadon->TenNhanVien}} </p>
      </div>
    </div>

  </div>
  </div>
</body>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


</html>