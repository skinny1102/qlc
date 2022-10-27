$("#btn-themmoikhachhang").click(function () {
    const TenKhachHang = $("#TenKhachHang").val();
    const GioiTinh = $('input[name="GioiTinh"]:checked').val();
    const DiaChi = $("#DiaChi").val();
    const DienThoai = $("#DienThoai").val();
    const data = {
        TenKhachHang: TenKhachHang,
        GioiTinh: GioiTinh,
        DiaChi: DiaChi,
        DienThoai: DienThoai,
    };
    console.log(data);
    $.ajax({
        method: "POST",
        url: "/themkhachhang",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: data,
        success: function (data) {
            if (
                window.location.toString() == "http://127.0.0.1:8000/ql-hoadon"
            ) {
                $.ajax({
                    method: "GET",
                    url: "/listkhachhang",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    success: function (data) {
                        $(".es-visible").remove();
                        data.forEach((element) => {
                            console.log(element);
                            $(".es-list").append(
                                $(
                                    `<li value=${element.MaKhachHang} class="es-visible"> ${element.MaKhachHang} - ${element.TenKhachHang} -${element.DienThoai}  </li>`
                                )
                            );
                        });
                    },
                    error: function (err) {
                        console.log(err);
                    },
                });

                $("#close-model-khachhang").click();
            } else {
                location.reload();
            }
        },
        error: function (err) {
            console.log(err);
        },
    });
});
