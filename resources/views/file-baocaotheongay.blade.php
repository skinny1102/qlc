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
        <p class="text-center header-receipt mb-0" style="font-size: 30px;">Báo Cáo Thống Bán Hàng Theo Ngày</p>
        <p class="text-center">Ngày : <?php echo date('Y-m-d', strtotime($dateChoose)); ?>  </p>
        <p class="text-center">Ngày lập báo cáo  :  <?php echo date('d-m-Y'); ?></p>
       
      </div>
    </div>

    <div>
      <div class="row justify-content-center">
        <table class="table mt-1 table-bordered" style="width: 700px;">
          <thead>
            <tr>
              <th scope="col" class="text-center">Ngày Bán</th>
              <th scope="col" class="text-center">Mã Hóa Đơn</th>
              <th scope="col" class="text-center">Tổng Tiền</th>
              <th scope="col" class="text-center">Số Lượng</th>
              <th scope="col" class="text-center">Người bán</th>
            </tr>
          </thead>
          <tbody>
          <?php $tt = 0  ;$sl=0 ?>
            @foreach ($hoadon as $hoadonE)
            <tr>
              <th scope="row">
                <p class="text-center m-0"> <?php echo date('d-m-Y', strtotime($hoadonE->NgayBan)); ?></p>
              </th>
              <td>
                <p class="text-center m-0"> {{$hoadonE->MaHoaDon}}</p>
              </td>

              <td>
                <p class="text-center m-0"> {{$hoadonE->TongTien}}</p>
              </td>
              <td>
                <p class="text-center m-0"> {{$hoadonE->SoLuong}}</p>
              </td>
              <td>
                <p class="text-center m-0"> {{$hoadonE->TenNhanVien}}</p>
              </td>
            </tr><?php $tt +=$hoadonE->TongTien  ; $sl +=$hoadonE->SoLuong ?>
            @endforeach
          </tbody>
          <tbody id="table-body">
            <tr>
              <th scope="row" colspan="2">
                <p class="text-center m-0"> Tổng : </p>
              </th>
              <th>
              <p class="text-center m-0">  {{$tt}}</p>
              </th>
              <th>
              <p class="text-center m-0">  {{$sl}}</p>
              </th>
            </tr>
          </tbody>
        </table>
      </div>

    </div>
    <div class=" row justify-content-end mb-2">
      <div class="col-6" style="padding-left: 450px">
        <p class="text-left  mb-1"><b> Người Lập</b> </p>
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