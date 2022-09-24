// const btn_themmoiloaicay = document.getElementById("btn-themmoiloaicay")
// console.log(btn_themmoiloaicay);
$("#btn-themmoiloaicay").click(function () {
    const tenloaicay = $("#tenloaicay").val();
    $.ajax({
        method: "POST",
        url: "/themloaicay",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {"TenLoaiCay":tenloaicay},
        success: function (data) {
            if(typeof data == 'string'){	
                $('#error-tencay').remove();
                $( "#model-themcay" ).append( "<p class='text-danger' id='error-tencay'>Tên loại cây này đã tồn tại </p>" );
            }else{
                $('#error-tencay').remove();
                // $('#close-model-loaicay').click();
                // $('#btn-sucess').click();
                location.reload();
            }
        },
        error: function (err) {
            console.log(err);
        },
    });
});


$("#btn-themmoicaycanh").click(function () {
    const TenCay = $("#TenCay").val();
    const SoLuong = $("#SoLuong").val();
    const DonGiaBan = $("#DonGiaBan").val();
    const XuatXu = $("#XuatXu").val(); 
    const MoTa = $("#MoTa").val(); 
    const HuongDan = $("#HuongDan").val(); 
    const MaLoaiCay = $("#MaLoaiCay").val(); 
    const data = {
        "TenCay":TenCay,
        "SoLuong":SoLuong,
        "DonGiaBan":DonGiaBan,
        "XuatXu":XuatXu,
        "MoTa":MoTa,
        "HuongDan":HuongDan,
        "MaLoaiCay":MaLoaiCay,
    }

    $.ajax({
        method: "POST",
        url: "/themcaycanh",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: data ,
        success: function (data) {
            console.log(data);
            if(typeof data == 'string'){	
                $('#error-tencay').remove();
                $( "#model-themcaycanh" ).append( "<p class='text-danger' id='error-tencay'>Tên cây này đã tồn tại </p>" );
            }else{
                $('#error-tencay').remove();
                // $('#close-model-loaicay').click();
                // $('#btn-sucess').click();
                location.reload();
            }
        },
        error: function (err) {
            console.log(err);
        },
    });
});


