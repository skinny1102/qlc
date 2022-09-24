$("#btn-themmoinhanvien").click(function () {
    
    const TenNhanVien = $("#TenNhanVien").val();
    const GioiTinh = $('input[name="GioiTinh"]:checked').val();
    const DiaChi = $("#DiaChi").val();
    const DienThoai = $("#DienThoai").val();
    const NgaySinh = $("#NgaySinh").val();
    const data = {
        TenNhanVien: TenNhanVien,
        GioiTinh: GioiTinh,
        DiaChi: DiaChi,
        DienThoai: DienThoai,
        NgaySinh:NgaySinh
    };

    $.ajax({
        method: "POST",
        url: "/themnhanvien",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: data,
        success: function (data) {
            location.reload();
        },
        error: function (err) {
            console.log(err);
        },
    });
});
