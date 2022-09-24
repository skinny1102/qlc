$("#btn-themmoikhachhang").click(function () {
    
    const TenKhachHang = $("#TenKhachHang").val();
    const GioiTinh = $('input[name="inlineRadioOptions"]:checked').val();
    const DiaChi = $("#DiaChi").val();
    const DienThoai = $("#DienThoai").val();
    console.log(GioiTinh);
    const data = {
        TenKhachHang: TenKhachHang,
        GioiTinh: GioiTinh,
        DiaChi: DiaChi,
        DienThoai: DienThoai,
    };

    $.ajax({
        method: "POST",
        url: "/themkhachhang",
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
